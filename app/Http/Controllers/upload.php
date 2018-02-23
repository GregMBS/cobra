<?php


use App\UploadClass;
use App\InfonavitClass;
use App\HistoriaClass;

$uc = new UploadClass();
$hc = new HistoriaClass();

$capt = filter_input(INPUT_GET, 'capt');
$captp = filter_input(INPUT_POST, 'captp');

if (empty($capt)) {
    $capt=$captp;
}

if (!empty($_FILES['file']['name'])) {

    // Get File extension eg. 'xlsx' to check file is excel sheet
    $pathinfo = pathinfo($_FILES["file"]["name"]);

    // check file has extension xlsx, xls and also check 
    // file is not empty
    if (($pathinfo['extension'] == 'xlsx') && $_FILES['file']['size'] > 0) {

        // Temporary file name
        $inputFileName = $_FILES['file']['tmp_name'];
        $data = $uc->reader($inputFileName);
    } else {
        $data = array();
    }
    $INFONAVIT = new InfonavitClass($data);
    $gestion = $INFONAVIT->getGestion();
    $hc->insertGestiones($gestion);
}
require_once 'views/INFONAVITuploadView.php';
