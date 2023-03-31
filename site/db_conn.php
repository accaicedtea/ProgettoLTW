<?php

mysqli_report(MYSQLI_REPORT_OFF);
/* @ is used to suppress warnings */
$link = @mysqli_connect('localhost', 'root', '', 'cd');
    if (!$link) {
    /* Use your preferred error logging method here */
        header("Location: ./error.php?error=405");
        exit();   
    }
?>