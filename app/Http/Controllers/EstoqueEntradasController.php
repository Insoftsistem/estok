<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueEntradasAddRequest;
use App\Http\Requests\EstoqueEntradasEditRequest;
use App\Models\EstoqueEntradas;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstoqueentradasListExport;
use App\Exports\EstoqueentradasViewExport;
use App\Exports\EstoqueentradasEntradaViewListExport;
use Illuminate\Support\Facades\Validator;
use Exception;
class EstoqueEntradasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.estoqueentradas.list";
		$query = EstoqueEntradas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			EstoqueEntradas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "estoque_entradas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, EstoqueEntradas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Import csv file data into a table 
     * @return data
     */
	function importdata(Request $request){
		$importSettings = config("upload.import");
		$maxFileSize = intval($importSettings["max_file_size"]) * 1000; //in kilobyte
		$validator = Validator::make($request->all(), 
			[
				"file" => "file|required|max:$maxFileSize|mimes:csv,txt",
			]
		);
		if ($validator->fails()) {
			return back()->withErrors($validator->errors());
		}
		$csvOptions = array(
			'fields' => '', //leave empty to use the first row as the columns
			'delimiter' => ',', 
			'quote' => '"'
		);
		$filePath = $request->file('file')->getRealPath();
		$modeldata = parse_csv_file($filePath, $csvOptions);
		EstoqueEntradas::insert($modeldata);
		return $this->redirect(url()->previous(), __('dataImportedSuccessfully'));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = EstoqueEntradas::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, EstoqueEntradas::viewFields());
		return $this->renderView("pages.estoqueentradas.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.estoqueentradas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(EstoqueEntradasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['usuario_id'] = auth()->user()->id;
		
		//save EstoqueEntradas record
		$record = EstoqueEntradas::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("estoqueentradas", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(EstoqueEntradasEditRequest $request, $rec_id = null){
		$query = EstoqueEntradas::query();
		$record = $query->findOrFail($rec_id, EstoqueEntradas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("estoqueentradas", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.estoqueentradas.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = EstoqueEntradas::query();
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
	function entrada_view_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.estoqueentradas.entrada_view_list";
		$query = EstoqueEntradas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			EstoqueEntradas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "estoque_entradas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportEntradaViewList($query); // export current query
		}
		$records = $query->paginate($limit, EstoqueEntradas::entradaViewListFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ListEstoqueEntradasReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(EstoqueEntradas::exportListFields());
			return view("reports.estoqueentradas-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(EstoqueEntradas::exportListFields());
			$pdf = PDF::loadView("reports.estoqueentradas-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoqueentradasListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoqueentradasListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
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
		$filename ="ViewEstoqueEntradasReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, EstoqueEntradas::exportViewFields());
			return view("reports.estoqueentradas-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, EstoqueEntradas::exportViewFields());
			$pdf = PDF::loadView("reports.estoqueentradas-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoqueentradasViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoqueentradasViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportEntradaViewList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "EntradaViewListEstoqueEntradasReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(EstoqueEntradas::exportEntradaViewListFields());
			return view("reports.estoqueentradas-entrada_view_list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(EstoqueEntradas::exportEntradaViewListFields());
			$pdf = PDF::loadView("reports.estoqueentradas-entrada_view_list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoqueentradasEntradaViewListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoqueentradasEntradaViewListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
