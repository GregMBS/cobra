<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$tcapt=$capt;
$C_CVGE=$capt;
include 'createFDF.php';
require("pdfb/pdfb.php"); // Must include this
  class PDF extends PDFB
  {
    function Header()
    {
      // Add your code here to generate
      // Headers on every page
    }

    function Footer()
    {
      // Add your code here to generate
      // Footers on every page
    }
  }
$i=0;
            passthru('rm -f /tmp/enc*df');
$querylist="select id_cuenta from encuesta,resumen 
where numero_de_cuenta=id order by auto;";
$rowlist=mysql_query($querylist);
while($answerlist = mysql_fetch_row($rowlist)) {
$id_cuenta=$answerlist[0];
$querymain = "SELECT resumen.*,queue,c_cvst,'/tmp/bc.pdf' as bc
FROM resumen
left join dictamenes on dictamen=status_aarsa 
left join historia on c_cont=id_cuenta
WHERE id_cuenta=".$id_cuenta."
order by d_fech desc,c_hrin desc limit 1
;";
$rowmain = mysql_query($querymain);
while ($answer = mysql_fetch_assoc($rowmain)) {
	$i++;
            passthru('barcode -b '.$id_cuenta.' -e code128 -o /tmp/bc.ps');
            passthru('ps2pdf /tmp/bc.ps /tmp/bc.pdf');
            // file name will be <the current timestamp>.fdf
            $fdf_file='encuesta'.$i.'.fdf';
            
            // the directory to write the result in
            $fdf_dir='/tmp';
            
            // need to know what file the data will go into
            $pdf_doc='encuesta.pdf';
            
            // generate the file content
            $fdf_data=createFDF($pdf_doc,$answer);

            // this is where you'd do any custom handling of the data
            // if you wanted to put it in a database, email the
            // FDF data, push ti back to the user with a header() call, etc.

            // write the file out
            if($fp=fopen($fdf_dir.'/'.$fdf_file,'w')){
                fwrite($fp,$fdf_data,strlen($fdf_data));
//                echo $fdf_file,' written successfully.';
            }else{
//                die('Unable to create file: '.$fdf_dir.'/'.$fdf_file);
            }
            fclose($fp);
			passthru("pdftk encuesta.pdf fill_form ".$fdf_dir.'/'.$fdf_file." output /tmp/encuesta".$i.".pdf flatten");
  $pdf = new PDF("p", "pt", "letter");

  // Load the base PDF into template
  $pdf->setSourceFile("/tmp/encuesta".$i.".pdf");
  $tplidx = $pdf->ImportPage(1);

  // Add new page & use the base PDF as template
  $pdf->AddPage();
  $pdf->useTemplate($tplidx);

  // See pdfb/pdfb.php for parameters on BarCode()
  // Create a Code 128-B barcode
  $pdf->BarCode($id_cuenta, "C128",400,80,240,80,0.5,0.5);

  $pdf->Output('/tmp/e'.$i.'.pdf');
  $pdf->closeParsers();
passthru("pdftk A=/tmp/e".$i.".pdf B=/tmp/encuesta".$i.".pdf cat A1 B2-4 output /tmp/encuestas".$i.".pdf");
}}
// We'll be outputting a PDF
header('Content-type: application/pdf');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="encuesta.pdf"');
			passthru("pdftk /tmp/encuestas*.pdf cat output -");
