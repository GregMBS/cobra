<?php
namespace App\Http\Controllers;

use App\SegmentAdminClass;
use View;
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
     * @var SegmentAdminClass;
     */
    private $sc;

    /**
     */
    public function __construct()
    {
        $this->sc = new SegmentAdminClass();
    }

    /**
     *
     * @param Request $r
     * @return View
     * @throws \Exception
     */
    public function erase(Request $r)
    {
        $this->sc->eraseSegment($r->cliente, $r->sdc);
        $view = $this->index();
        return $view;
    }

    /**
     *
     * @return View
     */
    public function addAll()
    {
        $this->sc->addAllSegments();
        $view = $this->index();
        return $view;
    }
    
        /**
     *
     * @param Request $r
     * @return View
     */
    public function add(Request $r)
    {
        $clientSegment = explode(';', $r->cliseg);
        $client = $clientSegment[0];
        if (!empty($client)) {
            $segment = '';
            if (count($clientSegment) > 1) {
                $segment = $clientSegment[1];
            }
            $this->sc->addSegment($client, $segment);
        }
        $view = $this->index();
        return $view;
    }

    /**
     *
     * @param Request $r
     * @return View
     * @throws \Exception
     */
    public function inactivate(Request $r)
    {
        $this->sc->inactivateSegment($r->cliente, $r->sdc);
        $view = $this->index();
        return $view;
    }

    /**
     *
     * @return View
     */
    public function index()
    {
        $result = $this->sc->listQueuedSegments();
        $resultU = $this->sc->listUnqueuedSegments();
        $view = view('segments')->with('result', $result)->with('resultU', $resultU);
        return $view;
    }
}

