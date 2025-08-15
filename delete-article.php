
<?php

require 'db_functions.php';

if (isset($_GET['id'])) {
    
    $id = intval($_GET['id']);

    $success = delete_article($id);

    if (!$success) {
        die("Error: Could not delete the article.");
    }
    
}

header("Location: admin.php");
exit();

?>
