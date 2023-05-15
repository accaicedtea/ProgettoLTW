<?php
$pagina = "Home";

require './funzioni.php';
$conn = db_conn();
head($pagina);
navBar($pagina, "Home");



?>
<style>
#sipario{
  display: none;
}
</style>
<body>
<div id="conenuto" class="text-center mt-5">
  <div class="container">
    <div class="card shadow">
      <div class="card-body">
        <!-- <h1 class="mt-3"><strong>HOME PAGE</strong></h1> -->
        <img class="mt-3 mb-3 text-center" src="./assets/brand/4M-cropped.svg" alt="" width="300" height="300">
        <p class="lead italics">Gestisci il tuo portafoglio in maniera smart</p>
        <button class="btn1 btn btn-lg mt-3 text-white btn-secondary fw-bold border-white bg-dark zoom">SCOPRI LE FUNZIONALITÁ</button>
      </div>
    </div> 
  </div>
  </p> 
</div>


<div id="sipario" class="text-center mt-5">

  <button class="btn2 btn btn-lg text-dark btn-secondary fw-bold border-white bg-white">HOME</button>

  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    
    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    
    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

  
</div>
</body>

<script>
$(document).ready(function(){
  $(".btn1").click(function(){
    $("#conenuto").slideToggle();
    $("#sipario").slideToggle();
  });
  $(".btn2").click(function(){
    $("#conenuto").slideToggle();
    $("#sipario").slideToggle();
  });
});
</script>