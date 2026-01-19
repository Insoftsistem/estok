<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendasAddRequest;
use App\Http\Requests\VendasEditRequest;
use App\Models\Vendas;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendasViewExport;
use Exception;
class VendasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.vendas.list";
		$query = Vendas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Vendas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "vendas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Vendas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Vendas::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, Vendas::viewFields());
		return $this->renderView("pages.vendas.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.vendas.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.vendas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(VendasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate VendasItens form data
		$vendasitensPostData = $request->vendasitens;
		$vendasitensValidator = validator()->make($vendasitensPostData, ["*.produto_id" => "required",
				"*.quantidade" => "required|numeric",
				"*.valor_unitario" => "required|numeric",
				"*.subtotal" => "nullable|numeric"]);
		if ($vendasitensValidator->fails()) {
			return $vendasitensValidator->errors();
		}
		$vendasitensValidData = $vendasitensValidator->valid();
		$vendasitensModeldata = array_values($vendasitensValidData);
		$modeldata['usuario_id'] = auth()->user()->id;
		
		//save Vendas record
		$record = Vendas::create($modeldata);
		$rec_id = $record->id;
		
		// set vendasitens.venda_id to vendas $rec_id
		foreach ($vendasitensModeldata as &$data) {
			$data['venda_id'] = $rec_id;
		}
		
		//Save VendasItens record
		\App\Models\VendasItens::insert($vendasitensModeldata);
		return $this->redirect("vendas", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(VendasEditRequest $request, $rec_id = null){
		$query = Vendas::query();
		$record = $query->findOrFail($rec_id, Vendas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("vendas", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.vendas.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Vendas::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function vendas_view(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.vendas.vendas_view";
		$query = Vendas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Vendas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "vendas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Vendas::vendasViewFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Export single record to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $record
	 * @param string $rec_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportView($query, $rec_id){
		ob_end_clean();// clean any output to allow file download
		$filename ="ViewVendasReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, Vendas::exportViewFields());
			return view("reports.vendas-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, Vendas::exportViewFields());
			$pdf = PDF::loadView("reports.vendas-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new VendasViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new VendasViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
