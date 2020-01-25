<?php

namespace App\Http\Controllers;

use App\HistoriaClass;
use App\InfonavitClass;
use App\UploadClass;
use Illuminate\Http\Request;
use View;

class UploadController extends Controller
{
    /**
     * 
     * @var UploadClass
     */
    private $uc;

    /**
     * @var HistoriaClass
     */
    private $hc;

    public function __construct()
    {
        $this->uc = new UploadClass();
        $this->hc = new HistoriaClass();
    }

    /**
     * @param Request $r
     * @return View|\Illuminate\View\View
     */
    public function update(Request $r)
    {
        $file = $r->file('file');
        $ext = $file->extension();
        $size = $file->getSize();
        $data = [];
        if (($ext == 'xlsx') && ($size > 0)) {
            $filename = $file->getFilename();
            $data = $this->uc->reader($filename);
        }
        $INFONAVIT = new InfonavitClass($data);
        $gestion = $INFONAVIT->getGestion();
        $this->hc->insertGestiones($gestion);
        $view = view('INFONAVITUpload');
        return $view;
    }
}
