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


<div id="sipario" class="text-light mt-5">

  <div class="text-center">
    <button class="btn2 btn btn-lg text-dark btn-secondary fw-bold border-white bg-white">HOME</button>
  </div>

  <div class="container marketing">


    <hr class="featurette-divider">

    
    <hr class="featurette-divider">
    <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Organizza le tue spese e i tuoi guadagni.</h2>
            <p class="lead">Inserisci, modifica ed elimina le tue transazioni.</p>
          </div>
          <div class="col-md-5">  <!-- div vuoto quando diminuisco grandezza schermo -->
            <img class="img-example" src="./assets/img/esempio1.png" alt="illustrazione" width="400" height="400">
          </div>
        </div>
    
        <hr class="featurette-divider">
    
        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Aggiungi spese e guadagni futuri in scadenze.</h2>
            <p class="lead">Nella Dashboard saranno visibili le spese e i guadagni che hanno scadenza imminente.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="img-example" src="./assets/img/esempio2.png" alt="illustrazione" width="400" height="400">    
          </div>
        </div>
    
        <hr class="featurette-divider">
    
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Gestisci il tuo risparmio.</h2>
            <p class="lead">Selezionando "Risparmio" come categoria quando aggiungi o modifichi una transazione, questa sarà aggiunta (o sottratta) al conto risparmio</p>
          </div>
          <div class="col-md-5">
            <img class="img-example" src="./assets/img/esempio3.png" alt="illustrazione" width="400" height="400">
    
          </div>
        </div>
    
        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Consulta l'andamento delle tue entrate e uscite.</h2>
            <p class="lead">Nella sezione Scadenze puoi visualizzare i grafici sull'andamento del saldo e del risparmio, oltre ai movimenti effettuati.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="img-example" src="./assets/img/esempio4.png" alt="illustrazione" width="400" height="400">    
          </div>
        </div>
    
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