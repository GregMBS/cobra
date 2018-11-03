<?php

namespace App\Http\Controllers;

use App\HistoryClass;
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
     * @var HistoryClass
     */
    private $hc;

    public function __construct()
    {
        $this->uc = new UploadClass();
        $this->hc = new HistoryClass();
    }

    /**
     * @param Request $r
     * @return View
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
        $ic = new InfonavitClass($data);
        $call = $ic->getCall();
        $this->hc->insertCalls($call);
        $view = view('INFONAVITUpload');
        return $view;
    }
}
