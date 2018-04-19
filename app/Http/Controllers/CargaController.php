<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CargaClass;
use Illuminate\Support\Facades\View;
use Exception;

class CargaController extends Controller
{

    /**
     *
     * @var CargaClass
     */
    private $cc;

    /**
     *
     * @var array
     */
    private $rules = [
        'file' => 'required|file'
    ];

    public function __construct()
    {
        $this->cc = new CargaClass();
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
     *
     * @return View
     */
    private function indexMsg($msg)
    {
        $clientes = $this->cc->listClientes();
        $view = view('carga')->with('clientes', $clientes)->with('msg', $msg);
        return $view;
    }

    /**
     *
     * @param string $ext
     * @throws Exception
     */
    private function getReader($ext)
    {
        switch ($ext) {
            case 'text/plain':
                break;

            case 'text/csv':
                break;

            default:
                throw new Exception('CSV only');
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
        if ($this->cc->hasDuplicates($row)) {
            throw new Exception('Duplicate Column Names');
        }
        if ($this->cc->badName($row)) {
            throw new Exception('Invalid Column Name');
        }
        if (! in_array('cliente', $row)) {
            throw new Exception('Missing Cliente');
        }
        if (! in_array('numero_de_cuenta', $row)) {
            throw new Exception('Missing Cuenta');
        }
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function cargar(Request $r)
    {
        $this->validate($r, $this->rules);
        if ($r->file('file')->isValid()) {
            $file = $r->file('file');
            $ext = strtolower($file->getMimeType());
            $this->getReader($ext);
            $csv = array_map('str_getcsv', $file);
            array_walk($csv, function(&$a) use ($csv) {
                $a = array_combine($csv[0], $a);
            });
            array_shift($csv); # remove column header
            dd($csv);    
            while ($row = fgetcsv($file, 0, ",")) {
                dd($row);
                if ($firstRow) {
                    dd($row);
                    $this->validateHeader($row);
                    $header = $row;
                    $firstRow = false;
                } else {
                    dd($row);
                    $data[] = $row;
                    $countUpload ++;
                }
            }

            $this->cc->prepareTemp($header);
            $countLoaded = $this->cc->loadData($data, $header);
            $countUpdated = $this->cc->updateResumen($header);
            $countInserted = $this->cc->insertIntoResumen($header);
            $this->cc->updateClientes();
            $this->cc->updatePagos();
            $msg = '<p>Uploaded: ' . $countUpload . '<br>' . 'Loaded: ' . $countLoaded . '<br>' . 'Updated: ' . $countUpdated . '<br>' . 'Updated: ' . $countInserted . '</p>';
            return $this->indexMsg($msg);
        }
    }
}
