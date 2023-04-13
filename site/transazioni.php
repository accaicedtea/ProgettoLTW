<?php 
    $pagina = 'Visualizza transazioni';
    include './head.php';
?>


<body id="page-top" style="background-color:#e9e9e9;">
    <?php 
        include './db_conn.php';
        include './navBar.php';
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
            $record_per_page = 15;  
            $page = ''; 
            if(isset($_POST["page"]))  {  
                $page = $_POST["page"];  
            }else{  
                $page = 1;  
            }  
            $start_from = ($page - 1)*$record_per_page; 
            
    ?>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" >
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
                                    <?php 
                                        $query ="SELECT nome FROM categoria";
                                        $result = $conn->query($query);
                                        if($result->num_rows> 0){
                                            $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        }
                                    ?>
                                <div class="col-md-4 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Mostra&nbsp;<select class="d-inline-block form-select form-select-sm">
                                        <option>Seleziona categoria</option>
                                                <?php 
                                                foreach ($options as $option) {
                                                ?>
                                                    <option><?php echo $option['nome']; ?> </option>
                                                    <?php 
                                                    }
                                                ?>
                                        </select>&nbsp;</label>
                                    </div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Tipo&nbsp;<select class="d-inline-block form-select form-select-sm">
                                        <option value="tutte" selected="">Tutte</option>
                                        <option value="entrate">Entrate</option>
                                        <option value="uscite">Uscite</option>
                                        </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaEntrata">Aggiungi entrata</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaUscita">Aggiungi uscita</button>
                                </div>
                                <div class="col-md-2 text-nowrap">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>

                            <!-- Modal NUOVA ENTRATA-->
                            <div class="modal fade" id="modalNuovaEntrata" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <!-- INIZIO FORM -->
                                        <form action="./register_entry.php" method="post" name="insert_form">
                                            <div class="hidden"><input type="" name="tipo_new" value="entrata"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria&nbsp;</strong></label><select class="d-inline-block form-select form-select-sm" name="cat_new">
                                                                <option>Seleziona categoria</option>
                                                                        <?php 
                                                                        foreach ($options as $option) {
                                                                        ?>
                                                                            <option><?php echo $option['nome']; ?> </option>
                                                                            <?php 
                                                                            }
                                                                        ?>
                                                                </select>&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description" placeholder="Inserisci descrizione" name="description_new"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date" name="date_new"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount" name="amount_new" step="0.01" min="0" pattern="^\d*(\.\d{0,2})$"></div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                <input type="submit" class="btn btn-primary" value="Salva transazione"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal NUOVA USCITA-->
                            <div class="modal fade" id="modalNuovaUscita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <!-- INIZIO FORM -->
                                        <form action="./register_entry.php" method="post" name="insert_form">
                                            <div class="hidden"><input type="" name="tipo_new" value="uscita"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria&nbsp;</strong></label><select class="d-inline-block form-select form-select-sm" name="cat_new">
                                                                <option>Seleziona categoria</option>
                                                                        <?php 
                                                                        foreach ($options as $option) {
                                                                        ?>
                                                                            <option><?php echo $option['nome']; ?> </option>
                                                                            <?php 
                                                                            }
                                                                        ?>
                                                                </select>&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description_new" placeholder="Inserisci descrizione" name="description_new"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date_new" name="date_new"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount_new" name="amount_new" step="0.01" min="0" pattern="^\d*(\.\d{0,2})$"></div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                <input type="submit" class="btn btn-primary" value="Salva transazione"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Inizio tabella -->
                            <div class="table-responsive table mt-2" id="pagination_data" role="grid" aria-describedby="dataTable_info">

                            </div>
                            <script>  
 $(document).ready(function(){  
      load_data();  
      function load_data(page)  
      {  
           $.ajax({  
                url:"pagination.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                     $('#pagination_data').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });  
 });  
 </script>  

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php 
}
else{
    header("Location: login.php?error=E tu chi cazzo sei");
}
?>