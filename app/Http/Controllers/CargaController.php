<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CargaClass;
use Illuminate\Support\Facades\View;
use Dotenv\Exception\InvalidFileException;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Reader\ReaderInterface;
use Box\Spout\Reader\SheetInterface;
use Box\Spout\Common\Type;
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
     * @throws InvalidFileException
     * @return ReaderInterface
     */
    private function getReader($ext)
    {
        $rf = new ReaderFactory();
        switch ($ext) {
            case 'text/plain':
                $reader = $rf->create(Type::CSV);
                break;

            case 'text/csv':
                $reader = $rf->create(Type::CSV);
                break;

            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                $reader = $rf->create(Type::XLSX);
                break;

            case 'application/vnd.oasis.opendocument.spreadsheet':
                $reader = $rf->create(Type::ODS);
                break;

            default:
                throw new InvalidFileException('Excel(XLSX), LibreOffice(ODS), o CSV');
                break;
        }
        return $reader;
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
            $filePath = $file->getPath();
            $ext = strtolower($file->getMimeType());
            $reader = $this->getReader($ext);
            $reader->open($filePath);
            $firstRow = true;
            $data = array();
            $countUpload = 0;
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    if ($firstRow) {
                        dd($row);
                        $this->validateHeader($row);
                        $header = $row;
                        $firstRow = false;
                    } else {
                        $data[] = $row;
                        $countUpload ++;
                    }
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
