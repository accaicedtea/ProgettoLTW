<?php include './head.html';
    include './navBar.php';
?>

<?php 
    $error = $_GET['error'];
    $msg = 'ah guarda non sappiamo nemmeno noi che errore sai'; 
    $msg2 = 'eh insomma dai';
    
    if($error==404){
        $msg= 'pagina non trovata';
        $msg2 = 'che pagina stavi cercando?? prova a ritornare alla home mh';
    }
    if($error==405){
        $msg= 'database non funzionante';
        $msg2 = 'quanto ci dispice ma il sito non è al momento disponibile';
    }

?>
<body>
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold"><?php echo $error;
                ?></h1>
                <p class="fs-3"> <span class="text-danger">Opps!</span> <?php echo $msg;?> </p>
                <p class="lead">
                    <?php echo $msg2; ?>
                  </p>
                <a href="index.html" class="btn btn-primary">Home</a>
            </div>
        </div>
</body>
