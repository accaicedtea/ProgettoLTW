<?php 
    $pagina = 'Visualizza transazioni';
    include './head.php';
?>


<body id="page-top" style="background-color:#e9e9e9;">
    <?php 
        include './db_conn.php';
        include_once './navBar.php';
        // if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
    ?>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container fluid mt-5">
                    <p class="h3 text-center mb-3 mt-3">Gestione entrate e uscite</p>
                    <div class="card shadow">
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
                                <div class="col-md-4 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Tipo&nbsp;<select class="d-inline-block form-select form-select-sm">
                                        <option value="entrate" selected="">Entrate</option>
                                        <option value="uscite">Uscite</option>
                                        </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-2 text-nowrap">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewEntry">Aggiungi</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="modalNewEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="./register_entry.php" method="post" name="insert_form">
                                                    <div class="row">
                                                        <div class="col">
                                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria&nbsp;</strong></label><select class="d-inline-block form-select form-select-sm" name="cat">
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
                                                            <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description" placeholder="poi vediamo" name="description"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date" name="date"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount" name="amount" step="0.01" pattern="^\d*(\.\d{0,2})$"></div>
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
                                <div class="col-md-2 text-nowrap">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $user = $_SESSION['username']; 
                                            $result = $conn->query("SELECT * FROM spesa WHERE utente = '$user'");
                                            if($result->num_rows> 0){
                                                $tuples= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            foreach ($tuples as $tuple) { ?>
                                                <tr>
                                                    <td><?php echo $tuple['data'];?></td>
                                                    <td><?php echo $tuple['categoria'];?></td>
                                                    <td><?php echo $tuple['descrizione'];?></td>
                                                    <td><?php echo $tuple['importo']." €";?></td>
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
                                                                    <form action="" method="post" name="edit_form">
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
                                                                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria</strong></label><select class="d-inline-block form-select form-select-sm" name="cat">
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