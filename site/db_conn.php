<?php

mysqli_report(MYSQLI_REPORT_OFF);
/* @ is used to suppress warnings */
$conn = @mysqli_connect('localhost', 'root', '', '4Money');
    if (!$conn) {
    /* Use your preferred error logging method here */
        header("Location: ./error.php?error=405");
        exit();   
    }
?>