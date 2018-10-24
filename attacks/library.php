<h1>Welcome to your Library</h1>


<div id="showLib">


    <p>Afficher vos propres messages ! <br></p>
    <form method="post" action="welcome.php" enctype="multipart/form-data">
        <input type="file" name="new_xml_file">
        <input type="submit" value="envoyé">
    </form>


    <?php

    libxml_disable_entity_loader(false);
    $xmlfile = file_get_contents('jack.xml');
    $dom = new DOMDocument();
    if (isset($_FILES['new_xml_file']) AND $_FILES['new_xml_file']['error'] == 0) {
        if ($_FILES['new_xml_file']['size'] <= 1000000) {
            $infosfichier = pathinfo($_FILES['new_xml_file']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('xml');
            if (in_array($extension_upload, $extensions_autorisees)) {
                $xmlfile2 = file_get_contents($_FILES['new_xml_file']['name']);
                $dom2 = new DOMDocument();
            }
        }
    }
    if (isset($xmlfile2) && isset($dom2) ){
        $dom2->loadXML($xmlfile2, LIBXML_NOENT | LIBXML_DTDLOAD);
        $biblio = simplexml_import_dom($dom2);
    }else{
        $dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
        $biblio = simplexml_import_dom($dom);
    }

    foreach ($biblio->titre as $title) {
        echo $title . "</br>";
    }

    ?>


</div>

