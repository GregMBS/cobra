<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoadClass;
use PhpOffice\PhpSpreadsheet\Reader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use View;
use Exception;

class LoadController extends Controller
{

    /**
     *
     * @var LoadClass
     */
    private $cc;

    /**
     *
     * @var array
     */
    private $rules = [
        'file' => 'required|file|mimes:csv,txt,ods,xls,xlsx'
    ];

    public function __construct()
    {
        $this->cc = new LoadClass();
    }

    /**
     *
     * @return View
     */
    public function index()
    {
        $clientes = $this->cc->listClientes();
        $view = view('carga')->with('clientes', $clientes);
        return $view;
    }

    /**
     * @param string $msg
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function indexMsg(string $msg)
    {
        $clientes = $this->cc->listClientes();
        $view = view('carga')->with('clientes', $clientes)->with('msg', $msg);
        return $view;
    }

    /**
     *
     * @param string $ext
     * @return Reader\BaseReader
     * @throws Exception
     */
    private function getReader($ext)
    {
        switch ($ext) {
            case 'text/plain':
                $reader = new Reader\Csv();
                return $reader;
                break;

            case 'text/csv':
                $reader = new Reader\Csv();
                return $reader;
                break;

            case 'application/vnd.oasis.opendocument.spreadsheet':
                $reader = new Reader\Ods();
                return $reader;
                break;

            case 'application/vnd.ms-excel':
                $reader = new Reader\Xls();
                return $reader;
                break;

            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                $reader = new Reader\Xlsx();
                return $reader;
                break;

            default:
                throw new Exception('CSV, XLS, XLSX, and ODS only');
                break;
        }
    }

    /**
     *
     * @param array $row
     * @throws Exception
     */
    private function validateHeader(array $row)
    {
        $dupes = $this->cc->checkDuplicates($row);
        if ($dupes['flag']) {
            $names = implode(',', $dupes['columns']);
            throw new Exception('Duplicate Column Names' . $names);
        }
        $badNames = $this->cc->badName($row);
        if ($badNames['flag']) {
            $names = implode(',', $badNames['columns']);
            throw new Exception('Invalid Column Names:' . $names);
        }
        if (!in_array('cliente', $row)) {
            throw new Exception('Missing Cliente');
        }
        if (!in_array('numero_de_cuenta', $row)) {
            throw new Exception('Missing Cuenta');
        }
    }

    /**
     * @param string $filename
     * @param Reader\BaseReader $reader
     * @return array
     * @throws Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function fileToArray(string $filename, Reader\BaseReader $reader)
    {
        $reader->setReadDataOnly(true);
        /** @var Spreadsheet $spreadsheets */
        $spreadsheet = $reader->load($filename);
        $worksheet = $spreadsheet->getActiveSheet();
        $array = $worksheet->toArray();
        return $array;
    }

    /**
     * @param array $array
     * @return array
     * @throws Exception
     */
    private function arrayCommon(array $array)
    {
        $data = [];
        array_walk($array, function (&$a) use ($array) {
            $a = array_combine($array[0], $a);
        });
        array_shift($array); // remove column header
        $firstRow = true;
        $countUpload = 0;
        $header = [];
        foreach ($array as $row) {
            if ($firstRow) {
                $this->validateHeader(array_keys($row));
                $header = array_keys($row);
                $firstRow = false;
            }
            $data[] = $row;
            $countUpload++;
        }
        if ($countUpload === 0) {
            throw new Exception('Empty File');
        }
        return [
            'data' => $data,
            'header' => $header,
            'countUpload' => $countUpload
        ];
    }


    /**
     * @param Request $r
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|View
     * @throws Exception
     */
    public function load(Request $r)
    {
        $this->validate($r, $this->rules);
        if ($r->file('file')->isValid()) {
            $file = $r->file('file');
            $mime = strtolower($file->getMimeType());
            try {
                $reader = $this->getReader($mime);
                $array = $this->fileToArray($file->getRealPath(), $reader);
            } catch (Exception $e) {
                $array = [];
            }
            try {
                $dataHeader = $this->arrayCommon($array);
            } catch (Exception $e) {
                $msg = $e->getMessage();
                return $this->indexMsg($msg);
            }
            $data = $dataHeader['data'];
            $header = $dataHeader['header'];
            $countUpload = $dataHeader['countUpload'];
            $this->cc->prepareTemp($header);
            $countLoaded = $this->cc->loadData($data, $header);
            $countUpdated = $this->cc->updateResumen($header);
            $countInserted = $this->cc->insertIntoResumen($header);
            $this->cc->updateClientes();
            $this->cc->updatePagos();
            $msg = '<p>Uploaded: ' . $countUpload . '<br>' . 'Loaded: ' . $countLoaded . '<br>' . 'Updated: ' . $countUpdated . '<br>' . 'Inserted: ' . $countInserted . '</p>';
            return $this->indexMsg($msg);
        }
        return $this->index();
    }
}
