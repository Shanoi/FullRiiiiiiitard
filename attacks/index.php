<html>
<meta charset="UTF-8">
<body>

<h1>Login</h1>

<form action="welcome.php" method="POST">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="pwd"><br>
    <input type="submit" value="Login">
</form>


<p>Don't have an account yet? Create one <a href="create_account.php">here</a></p>

<form action="index.php" method="get" role="form">
    <fieldset>
        <label>Recherche : </label>
        <input type="text" class="form-control" name="recherche" value=""></td>
        </br>
        <input type="submit" class="btn" value="Go">
        </br>
    </fieldset>

</form>

<?php

echo "SELECT `name`, `price` FROM items WHERE `name` LIKE '%" . $_GET["recherche"] . "%'";

?>
<table>

    <tr>
        <th> Titre A1</th>
        <th> Titre A2</th>
    </tr>

    <?php
    include("database_config.php");

    if (empty($_GET["recherche"]) || !isset($_GET["recherche"])) {
        $_GET["recherche"] = "%";
    }

    $stmt = $db->query("SELECT `name`, `price` FROM items WHERE `name` LIKE '%" . $_GET["recherche"] . "%'");
    $stmt->setFetchMode(PDO::FETCH_BOTH);


    while ($row = $stmt->fetch()) {
        echo "<tr>";

        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "</tr>";
    }

    ?>

</table>

</body>
</html>
