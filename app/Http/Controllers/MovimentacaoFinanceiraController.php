<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\MovimentacaoFinanceiraAddRequest;
use App\Http\Requests\MovimentacaoFinanceiraEditRequest;
use App\Models\MovimentacaoFinanceira;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MovimentacaofinanceiraListExport;
use App\Exports\MovimentacaofinanceiraViewExport;
use App\Exports\MovimentacaofinanceiraFinancaViewExport;
use Illuminate\Support\Facades\Validator;
use Exception;
class MovimentacaoFinanceiraController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.movimentacaofinanceira.list";
		$query = MovimentacaoFinanceira::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			MovimentacaoFinanceira::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "movimentacao_financeira.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, MovimentacaoFinanceira::listFields());
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
		MovimentacaoFinanceira::insert($modeldata);
		return $this->redirect(url()->previous(), __('dataImportedSuccessfully'));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = MovimentacaoFinanceira::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, MovimentacaoFinanceira::viewFields());
		return $this->renderView("pages.movimentacaofinanceira.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.movimentacaofinanceira.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.movimentacaofinanceira.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(MovimentacaoFinanceiraAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['usuario_id'] = auth()->user()->id;
		
		//save MovimentacaoFinanceira record
		$record = MovimentacaoFinanceira::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("movimentacaofinanceira", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(MovimentacaoFinanceiraEditRequest $request, $rec_id = null){
		$query = MovimentacaoFinanceira::query();
		$record = $query->findOrFail($rec_id, MovimentacaoFinanceira::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("movimentacaofinanceira", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.movimentacaofinanceira.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = MovimentacaoFinanceira::query();
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
	function financa_view(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.movimentacaofinanceira.financa_view";
		$query = MovimentacaoFinanceira::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			MovimentacaoFinanceira::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "movimentacao_financeira.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportFinancaView($query); // export current query
		}
		$records = $query->paginate($limit, MovimentacaoFinanceira::financaViewFields());
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
		$filename = "ListMovimentacaoFinanceiraReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(MovimentacaoFinanceira::exportListFields());
			return view("reports.movimentacaofinanceira-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(MovimentacaoFinanceira::exportListFields());
			$pdf = PDF::loadView("reports.movimentacaofinanceira-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new MovimentacaofinanceiraListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new MovimentacaofinanceiraListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
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
		$filename ="ViewMovimentacaoFinanceiraReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, MovimentacaoFinanceira::exportViewFields());
			return view("reports.movimentacaofinanceira-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, MovimentacaoFinanceira::exportViewFields());
			$pdf = PDF::loadView("reports.movimentacaofinanceira-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new MovimentacaofinanceiraViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new MovimentacaofinanceiraViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportFinancaView($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "FinancaViewMovimentacaoFinanceiraReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(MovimentacaoFinanceira::exportFinancaViewFields());
			return view("reports.movimentacaofinanceira-financa_view", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(MovimentacaoFinanceira::exportFinancaViewFields());
			$pdf = PDF::loadView("reports.movimentacaofinanceira-financa_view", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new MovimentacaofinanceiraFinancaViewExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new MovimentacaofinanceiraFinancaViewExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
