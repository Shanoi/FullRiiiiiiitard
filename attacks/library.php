<script>
    function saveLib() {
        var cb = function () {
            var show = document.getElementById("showLib");
            show.innerHTML = xmlhttp.responseText;
        };
        var input = document.getElementById("bibli").value;
        var encoded = encodeURI(input);
        var url = "http://attacks/updatelist.php?message=" + encoded + "&username=jack";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = cb;
        xmlhttp.send(null);
    }
</script>

<h1>Welcome to your Library</h1>

<textarea id="bibli" rows="20" cols="100" style="border:none;">
<?xml version = "1.0" encoding="utf-8" ?>

    <!DOCTYPE bibliotheque SYSTEM "bibliotheque.dtd">

<bibliotheque>
    <titre>Teh Lurd Of Teh Reings</titre>
    <titre>The Witcher</titre>
</bibliotheque>
</textarea>


<button onclick='saveLib()'>Leave your list</button>
<h2>Your List </h2>

<div id="showLib">

<?php
libxml_disable_entity_loader(false);
$xmlfile = file_get_contents('jack.xml');
$dom = new DOMDocument();
$dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
$biblio = simplexml_import_dom($dom);
foreach ($biblio->titre as $title) {
    echo $title . "</br>";
}

?>



</div>

