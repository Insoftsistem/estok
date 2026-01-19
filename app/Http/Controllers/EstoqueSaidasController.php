<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueSaidasAddRequest;
use App\Http\Requests\EstoqueSaidasEditRequest;
use App\Models\EstoqueSaidas;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstoquesaidasListExport;
use App\Exports\EstoquesaidasViewExport;
use App\Exports\EstoquesaidasSaidaViewExport;
use Illuminate\Support\Facades\Validator;
use Exception;
class EstoqueSaidasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.estoquesaidas.list";
		$query = EstoqueSaidas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			EstoqueSaidas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "estoque_saidas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, EstoqueSaidas::listFields());
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
		EstoqueSaidas::insert($modeldata);
		return $this->redirect(url()->previous(), __('dataImportedSuccessfully'));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = EstoqueSaidas::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, EstoqueSaidas::viewFields());
		return $this->renderView("pages.estoquesaidas.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.estoquesaidas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(EstoqueSaidasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['usuario_id'] = auth()->user()->id;
		
		//save EstoqueSaidas record
		$record = EstoqueSaidas::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("estoquesaidas", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(EstoqueSaidasEditRequest $request, $rec_id = null){
		$query = EstoqueSaidas::query();
		$record = $query->findOrFail($rec_id, EstoqueSaidas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("estoquesaidas", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.estoquesaidas.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = EstoqueSaidas::query();
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
	function saida_view(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.estoquesaidas.saida_view";
		$query = EstoqueSaidas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			EstoqueSaidas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "estoque_saidas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportSaidaView($query); // export current query
		}
		$records = $query->paginate($limit, EstoqueSaidas::saidaViewFields());
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
		$filename = "ListEstoqueSaidasReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(EstoqueSaidas::exportListFields());
			return view("reports.estoquesaidas-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(EstoqueSaidas::exportListFields());
			$pdf = PDF::loadView("reports.estoquesaidas-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoquesaidasListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoquesaidasListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
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
		$filename ="ViewEstoqueSaidasReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, EstoqueSaidas::exportViewFields());
			return view("reports.estoquesaidas-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, EstoqueSaidas::exportViewFields());
			$pdf = PDF::loadView("reports.estoquesaidas-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoquesaidasViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoquesaidasViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportSaidaView($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "SaidaViewEstoqueSaidasReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(EstoqueSaidas::exportSaidaViewFields());
			return view("reports.estoquesaidas-saida_view", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(EstoqueSaidas::exportSaidaViewFields());
			$pdf = PDF::loadView("reports.estoquesaidas-saida_view", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoquesaidasSaidaViewExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoquesaidasSaidaViewExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
