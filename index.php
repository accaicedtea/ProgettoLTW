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
    <div class="card shadow border-secondary">
      <div class="card-body">
        <!-- <h1 class="mt-3"><strong>HOME PAGE</strong></h1> -->
        <img class="mt-3 mb-3 text-center img-bg" src="./assets/brand/4M-cropped.svg" >
        <p class="lead italics">Gestisci il tuo portafoglio in maniera smart</p>
        <button class="btn1 btn btn-lg mt-3 text-white btn-secondary fw-bold border-white bg-dark zoom btn-min">SCOPRI LE FUNZIONALITÁ</button>
      </div>
    </div> 
  </div>
  </p> 
</div>


<div id="sipario" class="text-light mt-5">

  <div class="text-center">
    <button class="btn2 btn btn-lg text-dark btn-secondary fw-bold border-white bg-white zoom border-secondary">HOME</button>
  </div>

  <div class="container marketing">


    <hr class="featurette-divider">

    
    <hr class="featurette-divider">
    <div class="row featurette">
          <div class="info col-md-7">
            <h2 class="featurette-heading text-dark">Organizza le tue spese e i tuoi guadagni.</h2>
            <p class="lead text-dark justify">Organizza con sapienza le tue finanze, bilanciando con cura le spese e massimizzando i guadagni.
Scegli tu la partitura delle tue transazioni, personalizzando, aggiornando e eliminando con facilità.
Gestisci le tue entrate e uscite come un vero maestro, dirigendo l'armonia del tuo bilancio con maestria.</p>
          </div>
          <div class="example col-md-5">  <!-- div vuoto quando diminuisco grandezza schermo -->
            <img class="img-example img-hover" src="./assets/img/esempio1.png" alt="illustrazione" width="400" height="400">
          </div>
        </div>
    
        <hr class="featurette-divider mt-4 mb-4">
    
        <div class="row featurette">
          <div class="info col-md-7 order-md-2">
            <h2 class="featurette-heading text-dark">Aggiungi spese e guadagni futuri in scadenze.</h2>
            <p class="lead text-dark justify">Nella tua Dashboard avrai un'istantanea delle tue finanze, mostrando in modo chiaro e immediato le spese e i guadagni in scadenza prossima.
Avrai una panoramica dettagliata delle transazioni finanziarie imminenti, permettendoti di prendere decisioni tempestive e strategiche.
La Dashboard ti fornirà una visione d'insieme delle tue spese e guadagni imminenti, offrendoti un quadro completo per mantenere un equilibrio finanziario stabile.
</p>
          </div>
          <div class="example col-md-5 order-md-1">
            <img class="img-example img-hover" src="./assets/img/esempio2.png" alt="illustrazione" width="370" height="370">    
          </div>
        </div>
    
        <hr class="featurette-divider mt-4 mb-4">
    
        <div class="row featurette">
          <div class="info col-md-7">
            <h2 class="featurette-heading text-dark">Gestisci il tuo risparmio.</h2>
            <p class="lead text-dark justify">Quando selezioni la categoria "Risparmio" durante l'aggiunta o la modifica di una transazione, questa verrà automaticamente inclusa (o detratta) dal tuo conto risparmio.
            Puoi gestire facilmente il tuo conto risparmio selezionando la categoria "Risparmio" durante l'aggiunta o la modifica delle transazioni, in modo che l'importo venga aggiunto o sottratto direttamente dal tuo fondo risparmi.
            </p>
          </div>
          <div class="example col-md-5">
            <img class="img-example img-hover" src="./assets/img/esempio3.png" alt="illustrazione" width="400" height="400">
    
          </div>
        </div>
    
        <hr class="featurette-divider mt-4 mb-4">

        <div class="row featurette">
          <div class="info col-md-7 order-md-2">
            <h2 class="featurette-heading text-dark">Consulta l'andamento delle tue entrate e uscite.</h2>
            <p class="lead text-dark justify">Nella sezione Scadenze, avrai accesso a una tabella dettagliata che ti mostrerà in modo chiaro e organizzato le tue spese future. Potrai visualizzare le scadenze imminenti e le relative informazioni, consentendoti di pianificare con cura le tue finanze. La tabella ti offrirà una panoramica completa delle spese programmate, fornendoti una visione chiara delle prossime scadenze finanziarie.</p>
          </div>
          <div class="example col-md-5 order-md-1">
            <img class="img-example img-hover" src="./assets/img/esempio4.png" alt="illustrazione" width="400" height="400">    
          </div>
        </div>
    
        <hr class="featurette-divider mt-4 mb-4">
    
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