<?php
$message= $_GET["message"];
$file=$_GET["username"].".xml";
file_put_contents($file, $message);
$messages=file_get_contents($file);

$dom = new DOMDocument();
$dom->loadXML($messages, LIBXML_NOENT | LIBXML_DTDLOAD);
$biblio = simplexml_import_dom($dom);
foreach ($biblio->titre as $title) {
    echo $title . "</br>";
}
?>
