<?php 
    $pagina='Categorie';
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    ?>   
<body id="page-top">
    <?php 
        navBar($pagina,"Gestisci Categorie");
        if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']== 'daje'){
           
        ?>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content-fluid">
                <div class="container-fluid mt-5">
                    <div class="card shadow">
                        <?php if(isset($_GET['error'])){ ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Non grandioso! </strong><?php echo $_GET['error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php }else if(isset($_GET['msg'])){?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Operazione esegiuta! hai correttamente: </strong><?php echo $_GET['msg']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php }?>
                        <p class="h3 text-center mb-3 mt-3">Visualizzazione categorie registrate</p>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">I miei pagurini</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <button type="button" class="btn btn-success mb-3 " data-bs-toggle="modal" data-bs-target="#modalAddCat">
                                                            Aggiungi categoria
                                                        </button>
                                                        

                                                    <!-- Modal per Aggiungi-->
                                                    <div class="modal fade" id="modalAddCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <!-- INIZIO FORM -->
                                                                <form class="text-start" action="aggiungi_categoria.php" method="post" name="edit_form">
                                                                    <div class="visually-hidden"><input type="" name="id_edit" value=""></div>
                                                                    
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Aggiungi categoria</h5>
                                                                    </div>
                                                                    <div class="modal-body left-labels">

                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="nome"><strong >Nome</strong></label><input class="form-control" type="text" id="nome_add"  name="nome_add"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="color"><strong>Colore</strong></label><input class="form-control form-control-color" type="color" id="colore_add"  name="colore_add" ></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label" for="immagine">
                                                                                        <strong>Immagine</strong></label><input class="form-control" type="text" id="img_add" name="img_add">
                                                                                        <a href="https://icons.getbootstrap.com/" target="_blank">Info <i class="bi bi-info-circle-fill"></i></a>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                                        <input type="submit" class="btn btn-primary" value="Salva modifiche">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Colore</th>
                                                <th scope="col">Immagine</th>
                                                <th scope="col">Azioni categoria</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($_SESSION['adminLog']=='daje'){ 
                                                    $result = $conn->query("SELECT * FROM categoria ");
                                                }
                                                $tuples = array();
                                                if($result->num_rows> 0){
                                                    $tuples= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                }

                                                $i=0;
                                                foreach ($tuples as $tuple) { 
                                                    ?>
                                            <tr class="table" >
                                                <td scope="row">
                                                    <p><?php echo $tuple['nome'];?></p>
                                                </td>
                                                <td style="background-color: <?php echo $tuple['colore'];?>">
                                                    <p><?php echo $tuple['colore'];?></p>
                                                </td>
                                                <td ><p class="text-center h2"><i class="<?php echo $tuple['img'];?>"></i></p></td>
                                                <!-- td della modifica -->
                                                <td class="text-center" >
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEntry<?php echo $i?>">
                                                            Modifica
                                                        </button>
                                                        

                                                    <!-- Modal per MODIFICA-->
                                                    <div class="modal fade" id="modalEditEntry<?php echo $i; $i++;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <!-- INIZIO FORM -->
                                                                <form class="text-start" action="modifica_categoria.php" method="post" name="edit_form">
                                                                    <div class="visually-hidden"><input type="" name="id_edit" value=<?php echo $tuple['id']?>></div>
                                                                    
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modifica categoria</h5>
                                                                    </div>
                                                                    <div class="modal-body left-labels">

                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="nome"><strong >Nome</strong></label><input class="form-control" type="text" id="nome_edit" <?php echo 'value = "'.$tuple["nome"].'"';?> name="nome_edit"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="color"><strong>Colore</strong></label><input class="form-control form-control-color" type="color" id="colore_edit" value="<?php echo $tuple['colore'];?>" name="colore_edit" ></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label" for="immagine">
                                                                                        <strong>Immagine</strong></label><input class="form-control" type="text" id="img_edit" value="<?php echo $tuple['img'];?>" name="img_edit">
                                                                                        <a href="https://icons.getbootstrap.com/" target="_blank">Info <i class="bi bi-info-circle-fill"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                                        <input type="submit" class="btn btn-primary" value="Salva modifiche">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                
                                                    </td>
                                            </tr>
                                            <?php 
                                                
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php }else {
        log_out($conn);
        header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
        
    } ?>



