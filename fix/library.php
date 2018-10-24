<h1>Welcome to your Library</h1>


<div id="showLib">


    <p>Display your own message <br></p>
    <form method="post" action="welcome.php" enctype="multipart/form-data">
        <input type="file" name="new_json_file">
        <input type="submit" value="envoyé">
    </form>


    <?php

    $string = file_get_contents("data.json");
    $json = json_decode($string, true);
    if (isset($_FILES['new_json_file']) AND $_FILES['new_json_file']['error'] == 0) {

        if ($_FILES['new_json_file']['size'] <= 1000000) {
            $infosfichier = pathinfo($_FILES['new_json_file']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('json');
            if (in_array($extension_upload, $extensions_autorisees)) {
                $string2 = file_get_contents($_FILES['new_json_file']['name']);
                $json2 = json_decode($string2, true);
            }
        }
    }
    if (isset($json2)){
        foreach ($json2['bibliotheque'] as $bilbi) {
                echo $bilbi['titre'] ."</br>";

        }
    }
    else{
        foreach ($json['bibliotheque'] as $bilbi) {
        echo $bilbi['titre'] ."</br>";

    }

    }

    ?>


</div>



