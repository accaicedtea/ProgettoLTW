<?php require './test_buffi_json.php';
    $conn = db_conn();
    echo getJsonCat($conn);
?>