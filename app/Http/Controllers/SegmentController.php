<?php
namespace App\Http\Controllers;

use App\SegmentadminClass;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

/**
 *
 * @author gmbs
 *        
 */
class SegmentController extends Controller
{

    /**
     *
     * @var SegmentadminClass;
     */
    private $sc;

    /**
     */
    public function __construct()
    {
        $this->sc = new SegmentadminClass();
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function borrar(Request $r)
    {
        $this->sc->borrarSegmento($r->cliente, $r->sdc);
        $view = $this->index();
        return $view;
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function agregartodo(Request $r)
    {
        $this->sc->addAllSegmentos();
        $view = $this->index();
        return $view;
    }
    
        /**
     *
     * @param Request $r
     * @return View
     */
    public function agregar(Request $r)
    {
        $clientesegmento = explode(';', $r->cliseg);
        $cliente = $clientesegmento[0];
        if (!empty($cliente)) {
            if (count($clientesegmento) > 1) {
                $segmento = $clientesegmento[1];
            } else {
                $segmento = '';
            }
            $this->sc->agregarSegmento($cliente, $segmento);
        }
        $view = $this->index();
        return $view;
    }

/**
     *
     * @param Request $r
     * @return View
     */
    public function inactivar(Request $r)
    {
        $this->sc->inactivarSegmento($r->cliente, $r->sdc);
        $view = $this->index();
        return $view;
    }

    /**
     *
     * @return View
     */
    public function index()
    {
        $result = $this->sc->listQueuedSegmentos();
        $resultU = $this->sc->listUnqueuedSegments();
        $view = view('segments')->with('result', $result)->with('resultU', $resultU);
        return $view;
    }
}
