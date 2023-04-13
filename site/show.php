<?php 
    $pagina = 'Transazioni';
    include './head.php';
    ?>
<body id="page-top">
    <?php 
        include './db_conn.php';
        include './navBar.php';
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
        ?>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container fluid mt-5">
                    <div class="card shadow">
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
                                    <div id="menu_categoria" class="dataTables_length" aria-controls="dataTable">
                                        <label class="form-label">
                                            Mostra&nbsp;
                                            <select class="d-inline-block form-select form-select-sm">
                                                <option>Seleziona categoria</option>
                                                <?php 
                                                    foreach ($options as $option) {
                                                    ?>
                                                <option><?php echo $option['nome']; ?> </option>
                                                <?php 
                                                    }
                                                    ?>
                                            </select>
                                            &nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <label class="form-label">
                                            Tipo&nbsp;
                                            <select class="d-inline-block form-select form-select-sm">
                                                <option value="tutte" selected="">Tutte</option>
                                                <option value="entrate">Entrate</option>
                                                <option value="uscite">Uscite</option>
                                            </select>
                                            &nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaEntrata">Aggiungi entrata</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaUscita">Aggiungi uscita</button>
                                </div>
                                <!-- Modal NUOVA ENTRATA-->
                                <div class="modal fade" id="modalNuovaEntrata" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="./register_entry.php" method="post" name="insert_form">
                                                <div class="hidden"><input type="" name="tipo" value="entrata"></div>
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                                                <label class="form-label"><strong>Categoria&nbsp;</strong></label>
                                                                <select class="d-inline-block form-select form-select-sm" name="cat_new">
                                                                    <option>Seleziona categoria</option>
                                                                    <?php 
                                                                        foreach ($options as $option) {
                                                                        ?>
                                                                    <option><?php echo $option['nome']; ?> </option>
                                                                    <?php 
                                                                        }
                                                                        ?>
                                                                </select>
                                                                &nbsp;
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
                                <div class="col-md-2 text-nowrap">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <!-- Modal NUOVA USCITA-->
                            <div class="modal fade" id="modalNuovaUscita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="./register_entry.php" method="post" name="insert_form">
                                            <div class="hidden"><input type="" name="tipo" value="uscita"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                                            <label class="form-label"><strong>Categoria&nbsp;</strong></label>
                                                            <select class="d-inline-block form-select form-select-sm" name="cat_new">
                                                                <option>Seleziona categoria</option>
                                                                <?php 
                                                                    foreach ($options as $option) {
                                                                    ?>
                                                                <option><?php echo $option['nome']; ?> </option>
                                                                <?php 
                                                                    }
                                                                    ?>
                                                            </select>
                                                            &nbsp;
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
                                    <tbody>
                                        <?php
                                            $user = $_SESSION['username']; 
                                            $result = $conn->query("SELECT * FROM spesa WHERE utente = '$user'");
                                            $tuples = array();
                                            if($result->num_rows> 0){
                                                $tuples= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($tuples as $tuple) { ?>
                                        <tr class=<?php if ($tuple['importo'] > 0) echo "enc"; else echo "usc"; ?>>
                                            <!-- QUESTO NON FUNZIONA (LA SELEZIONE DELL CLASSE) RIP -->
                                            <td><?php echo $tuple['data'];?></td>
                                            <td><?php echo $tuple['categoria'];?></td>
                                            <td><?php echo $tuple['descrizione'];?></td>
                                            <td><?php echo abs($tuple['importo'])." €";?></td>
                                            <td><?php if ($tuple['importo']>0) echo "Entrata"; else echo "Uscita";?></td>
                                            <td class="buttons">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEntry">
                                                Modifica
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEditEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Modifica transazione</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- INIZIO FORM -->
                                                                <form action="" method="post" name="edit_form">
                                                                    <div class="hidden"><input type="" name="id" value=<?php echo $tuple['id']?>></div>
                                                                    <div class="row">
                                                                        <?php 
                                                                            /*$user = $_SESSION['username'];
                                                                            $result = mysqli_query($conn,"SELECT descrizione FROM spesa WHERE utente = '$user'");
                                                                            if(mysqli_num_rows($result) === 1){
                                                                                $descrizione = mysqli_fetch_assoc($result);
                                                                            }
                                                                            $result = mysqli_query($conn,"SELECT data FROM spesa WHERE utente = '$user'");
                                                                            if(mysqli_num_rows($result) === 1){
                                                                                $data = mysqli_fetch_assoc($result);
                                                                            }
                                                                            $result = mysqli_query($conn,"SELECT importo FROM spesa WHERE utente = '$user'");
                                                                            if(mysqli_num_rows($result) === 1){
                                                                                $importo = mysqli_fetch_assoc($result);
                                                                            }*/
                                                                            ?>
                                                                        <div class="col">
                                                                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                                                                <label class="form-label"><strong>Categoria</strong></label>
                                                                                <select class="d-inline-block form-select form-select-sm" name="cat">
                                                                                    <option>Seleziona categoria</option>
                                                                                    <?php 
                                                                                        foreach ($options as $option) {
                                                                                        ?>
                                                                                    <option><?php echo $option['nome']; ?> </option>
                                                                                    <?php 
                                                                                        }
                                                                                        ?>
                                                                                </select>
                                                                                &nbsp;
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description" value=<?php echo "descrizione"?> name="description"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date" value=<?php echo "16/01/2002"?> name="date"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount" value=<?php echo "22"?> name="amount" step="0.01" pattern="^\d*(\.\d{0,2})$"></div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                                <button type="button" class="btn btn-primary">Salva modifiche</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-danger btn-sm">Elimina</button>
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
</body>
<?php 
    }else{
        header("Location: login.php?error=E tu chi cazzo sei");
    }
    ?>