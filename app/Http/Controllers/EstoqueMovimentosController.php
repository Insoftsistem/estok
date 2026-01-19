<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueMovimentosAddRequest;
use App\Http\Requests\EstoqueMovimentosEditRequest;
use App\Models\EstoqueMovimentos;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstoquemovimentosListExport;
use App\Exports\EstoquemovimentosViewExport;
use App\Exports\EstoquemovimentosEstoqueViewExport;
use Illuminate\Support\Facades\Validator;
use Exception;
class EstoqueMovimentosController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.estoquemovimentos.list";
		$query = EstoqueMovimentos::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			EstoqueMovimentos::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "estoque_movimentos.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, EstoqueMovimentos::listFields());
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
		EstoqueMovimentos::insert($modeldata);
		return $this->redirect(url()->previous(), __('dataImportedSuccessfully'));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = EstoqueMovimentos::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, EstoqueMovimentos::viewFields());
		return $this->renderView("pages.estoquemovimentos.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.estoquemovimentos.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(EstoqueMovimentosAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save EstoqueMovimentos record
		$record = EstoqueMovimentos::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("estoquemovimentos", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(EstoqueMovimentosEditRequest $request, $rec_id = null){
		$query = EstoqueMovimentos::query();
		$record = $query->findOrFail($rec_id, EstoqueMovimentos::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("estoquemovimentos", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.estoquemovimentos.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = EstoqueMovimentos::query();
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
	function estoque_view(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.estoquemovimentos.estoque_view";
		$query = EstoqueMovimentos::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			EstoqueMovimentos::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "estoque_movimentos.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportEstoqueView($query); // export current query
		}
		$records = $query->paginate($limit, EstoqueMovimentos::estoqueViewFields());
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
		$filename = "ListEstoqueMovimentosReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(EstoqueMovimentos::exportListFields());
			return view("reports.estoquemovimentos-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(EstoqueMovimentos::exportListFields());
			$pdf = PDF::loadView("reports.estoquemovimentos-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoquemovimentosListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoquemovimentosListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
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
		$filename ="ViewEstoqueMovimentosReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, EstoqueMovimentos::exportViewFields());
			return view("reports.estoquemovimentos-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, EstoqueMovimentos::exportViewFields());
			$pdf = PDF::loadView("reports.estoquemovimentos-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoquemovimentosViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoquemovimentosViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportEstoqueView($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "EstoqueViewEstoqueMovimentosReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(EstoqueMovimentos::exportEstoqueViewFields());
			return view("reports.estoquemovimentos-estoque_view", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(EstoqueMovimentos::exportEstoqueViewFields());
			$pdf = PDF::loadView("reports.estoquemovimentos-estoque_view", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new EstoquemovimentosEstoqueViewExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new EstoquemovimentosEstoqueViewExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
