
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'db_functions.php';

    $success = save_article($_POST);

    if ($success) {

        header("Location: admin.php");
        exit();
    } else {
        die("Error: Could not save the article.");
    }

} else {
    header("Location: admin.php");
    exit();
}

?>
