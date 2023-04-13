<?php 
    $pagina='Informazioni';
    include './head.php';
    ?>
<body class="page-top">
    <?php 
        include './db_conn.php';
        include './navBar.php';
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
        ?>
        
    <div id="#page-top"></div>
    <div class="container-fluid">
    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">Hasan <span class="text-muted">Abdel Aziz</span></h2>
            <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
        </div>
        <div class="col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#eee"/>
                <text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>
            </svg>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Riccardo <span class="text-muted">Ebene</span></h2>
            <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
        </div>
        <div class="col-md-5 order-md-1">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#eee"/>
                <text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>
            </svg>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">Cristian Andrei <span class="text-muted">Mai Mihai</span></h2>
            <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
        </div>
        <div class="col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#eee"/>
                <text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>
            </svg>
        </div>
    </div>
    <hr class="featurette-divider">
    <footer class="container">
        <p>&copy; 2023–2023 4Money, Inc. &middot; <a href="./assets/vid/get rickrolled lol.mp4">Privacy</a> &middot; <a href="./assets/vid/1 Hour Of Silence occasionally broken up by Lego Yoda death sound..mp4">Terms</a></p>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </footer>
    </div>
</body>
<?php } ?>