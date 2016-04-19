<?php
$host = "localhost";
$user = "admin";
$pswd = "AwRats";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$capt=mysql_real_escape_string($_GET['capt']);
$query = "SELECT auto,fecha,hora,nota,c_cvge,cuenta,c_cont 
FROM cobra4.notas WHERE (c_cvge='.$capt.' OR c_cvge='todos') AND borrado=0 
ORDER BY fecha desc,hora desc";
$result = mysql_query($query);
 
$doc = new DomDocument('1.0');
 
// create root node
$root = $doc->createElement('notas');
$root = $doc->appendChild($root);
 
while($array = mysql_fetch_array($result)) {
 
    // add node for each row
    $occ = $doc->createElement('nota');
    $occ = $root->appendChild($occ);
 
    $child = $doc->createElement('auto');
    $child = $occ->appendChild($child);
    $value = $doc->createTextNode($array['auto']);
    $value = $child->appendChild($value);
 
    $child = $doc->createElement('fecha');
    $child = $occ->appendChild($child);
    $value = $doc->createTextNode($array['fecha']);
    $value = $child->appendChild($value);
 
    $child = $doc->createElement('hora');
    $child = $occ->appendChild($child);
    $value = $doc->createTextNode($array['hora']);
    $value = $child->appendChild($value);
 
    $child = $doc->createElement('texto');
    $child = $occ->appendChild($child);
    $value = $doc->createTextNode($array['nota']);
    $value = $child->appendChild($value);
 
    $child = $doc->createElement('c_cvge');
    $child = $occ->appendChild($child);
    $value = $doc->createTextNode($array['c_cvge']);
    $value = $child->appendChild($value);
 
    $child = $doc->createElement('cuenta');
    $child = $occ->appendChild($child);
    $value = $doc->createTextNode($array['cuenta']);
    $value = $child->appendChild($value);
 
    $child = $doc->createElement('c_cont');
    $child = $occ->appendChild($child);
    $value = $doc->createTextNode($array['c_cont']);
    $value = $child->appendChild($value);
}
$xml_string = $doc->saveXML();
 
header('Content-Type: application/xml; charset=UTF-8');
 
echo $xml_string;
