<?php 
    $pagina = 'Visualizza transazioni';
    include './head.php';
?>


<body id="page-top" style="background-color:#e9e9e9;">
    <?php 
        include './db_conn.php';
        include './navBar.php';
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
    ?>
    
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container fluid mt-5 mb-5">
                    <div class="card shadow">
                        <?php if(isset($_GET['msg'])){ ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Congratulazioni! </strong><?php echo $_GET['msg']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }?>
                        <p class="h3 text-center mb-3 mt-3">Gestione entrate e uscite</p>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">I tuoi movimenti</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">
                                    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
                                   
                                    <div class="row">
                                        <div class="col-auto">
                                            <!--The SELECT element.-->
                                            <select id="sel" >
                                                <option value="">-- Select --</option>
                                            </select>

                                        </div>
                                        <div class="col-auto"><select id="selectTipo" class="d-inline-block form-select form-select-sm">
                                        <option value="tutte" selected="">Tutti i tipi</option>

                                        </select></div>
                                        <div class="col-1"></div>
                                        
                                        <div class="col-auto ms-auto"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaEntrata">Aggiungi entrata</button></div>
                                        <div class="col-auto "><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaUscita">Aggiungi uscita</button></div>
                                        <div class="col-auto ms-auto"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></div>
                                    </div>
                                    </div>
                            

                            <!-- Inizio tabella -->
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Categoria</th>
                                            <th>Descrizione</th>
                                            <th>Importo</th>
                                            <th>Tipo</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php echo include ('./test_buffi_json.php');?> 
<script> 
window.onload = populateSelect();

function populateSelect() {
    // THE JSON ARRAY.
    let birds = <?= include ('./test_buffi_json.php');?>;
    
    let ele = document.getElementById('sel');
    for (let i = 0; i < birds.length; i++) {
        // POPULATE SELECT ELEMENT WITH JSON.
        ele.innerHTML = ele.innerHTML +
            '<option value="' + birds[i]['id'] + '">' + birds[i]['nome'] + '</option>';
    }
}
                            
</script>
<?php 
}
else{
    header("Location: login.php?error=E tu chi cazzo sei");
}
?>