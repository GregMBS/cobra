<?php
set_time_limit (3000);
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$source=mysql_real_escape_string($_REQUEST['source']);
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
            passthru('rm -f /tmp/c*df');
$querylist="select id_cuenta from cedulas,resumen 
where numero_de_cuenta=id order by auto;";
$rowlist=mysql_query($querylist);
while($answerlist = mysql_fetch_row($rowlist)) {
$id_cuenta=$answerlist[0];
$querycvst="select c_cvst from historia,dictamenes
where dictamen=c_cvst and d_fech>last_day(curdate()-interval 1 month)
and c_cont=".$id_cuenta." 
and c_visit <>'' order by v_cc;";
$resultcvst=mysql_query($querycvst);
while($answercvst = mysql_fetch_row($resultcvst)) {$cvst=$answercvst[0];}
$querymain = "SELECT resumen.*,d1.queue,c_cvst as c_cvst2,'/tmp/bc.pdf' as bc,infextras.*,
trim(concat_ws(' ',tel_1,tel_2,tel_3,tel_4,tel_1_ref_1,tel_1_ref_2,tel_1_laboral)) as tels,
'".$cvst."' as c_cvst
FROM resumen
left join infextras on infextras.cuenta=resumen.numero_de_cuenta
left join dictamenes d1 on d1.dictamen=resumen.status_aarsa 
left join historia on historia.c_cont=resumen.id_cuenta and c_visit is null 
and d_fech>last_day(curdate()-interval 1 month) 
left join dictamenes d2 on d2.dictamen=historia.c_cvst 
WHERE resumen.id_cuenta=".$id_cuenta."
order by d2.v_cc limit 1
;";
$rowmain = mysql_query($querymain);
while ($answer = mysql_fetch_assoc($rowmain)) {
	$i++;
            passthru('barcode -b '.$id_cuenta.' -e code128 -o /tmp/bc.ps');
            passthru('ps2pdf /tmp/bc.ps /tmp/bc.pdf');
            // file name will be <the current timestamp>.fdf
            $fdf_file='cedula'.$i.'.fdf';
            
            // the directory to write the result in
            $fdf_dir='/tmp';
            
            // need to know what file the data will go into
            $pdf_doc=$source;
            
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
			passthru("pdftk /var/www/".$source." fill_form ".$fdf_dir.'/'.$fdf_file." output /tmp/cedula".$i.".pdf flatten");
//            die("pdftk /var/www/cedula.pdf fill_form ".$fdf_dir.'/'.$fdf_file." output /tmp/cedula".$i.".pdf flatten");
  $pdf = new PDF("p", "pt", "letter");

  // Load the base PDF into template
if (file_exists("/tmp/cedula".$i.".pdf")) {
  $pdf->setSourceFile("/tmp/cedula".$i.".pdf");
  $tplidx = $pdf->ImportPage(1);

  // Add new page & use the base PDF as template
  $pdf->AddPage();
  $pdf->useTemplate($tplidx);

  // See pdfb/pdfb.php for parameters on BarCode()
  // Create a Code 128-B barcode
  $pdf->BarCode($id_cuenta, "C128",0,30,240,80,0.5,0.5);

  $pdf->Output('/tmp/cedulass'.$i.'.pdf');
  $pdf->closeParsers();
//passthru("pdftk A=/tmp/c".$i.".pdf cat A1 output /tmp/cedulass".$i.".pdf");
}}}
// We'll be outputting a PDF
header('Content-type: application/pdf');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="'.$source.'"');
			passthru("pdftk /tmp/cedulass*.pdf cat output -");
