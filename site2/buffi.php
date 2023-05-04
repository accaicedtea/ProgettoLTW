<?php 
    $pagina = 'Buffe e buffetti';
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina);
?>


<body id="page-top" style="background-color:#e9e9e9;">
    <?php 
       
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
    ?>
    <script>
        function applicaFiltroCat(){
            var e = document.getElementById("selectCat");
            var chosen = e.options[e.selectedIndex].text; 
            var httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = gestisciCat;
            httpRequest.open("GET", "filtered_table.php"+"?categoria="+chosen+"&tipo=", true);
            httpRequest.send();
        }

        function gestisciCat(e){
            if (e.target.readyState == XMLHttpRequest.DONE && e.target.status == 200){
                document.getElementById("tableBody").innerHTML = e.target.responseText;
            }
        }

        function applicaFiltroTipo(){
            var e = document.getElementById("selectTipo");
            var chosen = e.options[e.selectedIndex].text; 
            console.log(chosen);
            var httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = gestisciCat;
            httpRequest.open("GET", "filtered_table.php"+"?tipo="+chosen+"&categoria=", true);
            httpRequest.send();
        }

        function gestisciCat(e){
            if (e.target.readyState == XMLHttpRequest.DONE && e.target.status == 200){
                document.getElementById("tableBody").innerHTML = e.target.responseText;
            }
        }
    </script>
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
                                    <?php 
                                        $query ="SELECT nome FROM categoria ";
                                        $result = $conn->query($query);
                                        if($result->num_rows> 0){
                                            $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        }
                                    ?>
                                <div class="container">
                                    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
                                    <div class="row">
                                        <div class="col-auto"><select id="selectCat" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroCat()">
                                        <option>Tutte le categorie</option>
                                                <?php 
                                                foreach ($options as $option) {
                                                ?>
                                                    <option><?php echo $option['nome']; ?> </option>
                                                    <?php 
                                                    }
                                                ?>
                                        </select> </div>
                                        <div class="col-auto"><select id="selectTipo" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroTipo()">
                                        <option value="tutte" selected="">Tutti i tipi</option>
                                        <option value="entrate">Entrate</option>
                                        <option value="uscite">Uscite</option>
                                        </select></div>
                                        <div class="col-1"></div>
                                        
                                        <div class="col-auto ms-auto"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaEntrata">Aggiungi entrata</button></div>
                                        <div class="col-auto "><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaUscita">Aggiungi uscita</button></div>
                                        <div class="col-auto ms-auto"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></div>
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
                                    <tbody id="tableBody">
                                        <!-- Prendo dal database tutte le spese -->
                                        <?php
                                            $user = $_SESSION['username']; 
                                            $result = $conn->query("SELECT * FROM spesa WHERE utente = '$user' and data IS NULL ");
                                            $tuples = array();
                                            if($result->num_rows> 0){
                                                $tuples= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            }
                                            $i=0;
                                            foreach ($tuples as $tuple) { ?>
                                                <tr class="table-<?php echo ($tuple['importo']<0)? 'danger' : 'success';?>">  <!-- QUESTO NON FUNZIONA (LA SELEZIONE DELL CLASSE) RIP -->
                                                    <td><?php echo $tuple['data'];?></td>
                                                    <td><?php echo $tuple['categoria'];?></td>
                                                    <td><?php echo $tuple['descrizione'];?></td>
                                                    <td><?php echo abs($tuple['importo'])." €";?></td>
                                                    <td><?php if ($tuple['importo']>0) echo "Entrata"; else echo "Uscita";?></td>
                                                    <td class="buttons">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEntry<?php echo $i?>">
                                                            Modifica
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteEntry<?php echo $i?>">
                                                            Elimina
                                                        </button>

                                                    <!-- Modal per MODIFICA-->
                                                    <div class="modal fade" id="modalEditEntry<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <!-- INIZIO FORM -->
                                                                <form action="./edit_entry.php" method="post" name="edit_form">
                                                                    <div class="hidden"><input type="" name="id_edit" value=<?php echo $tuple['id']?>></div>
                                                                    <div class="hidden"><input type="" name="tipo_edit" value=<?php if ($tuple['importo']>=0) echo "entrata"; else echo "uscita";?>></div>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modifica transazione</h5>
                                                                    </div>
                                                                    <div class="modal-body left-labels">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria</strong></label><select class="d-inline-block form-select form-select-sm" name="cat_edit">
                                                                                        <?php 
                                                                                        foreach ($options as $option) {
                                                                                        ?>
                                                                                            <option <?php if ($option['nome'] == $tuple['categoria']) echo "selected";?>><?php echo $option['nome']; ?> </option>
                                                                                            <?php 
                                                                                            }
                                                                                        ?>
                                                                                    </select>&nbsp;
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description_edit" <?php echo 'value = "'.$tuple["descrizione"].'"';?> name="description_edit"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date_edit" value=<?php echo $tuple['data']?> name="date_edit"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount_edit" value=<?php echo abs($tuple['importo'])?> name="amount_edit" step="0.01" pattern="^\d*(\.\d{0,2})$"></div>
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

                                                    <!-- Modal per ELIMINA-->
                                                    <div class="modal fade" id="modalDeleteEntry<?php echo $i; $i++;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLongTitle">Elimina transazione</h5>
                                                                </div>
                                                                <div class="modal-body left-labels">
                                                                    Sei sicuro di voler eliminare la transazione?
                                                                </div>
                                                                <form action="./delete_entry.php" method="post" name="delete_form">
                                                                    <div class="hidden"><input type="" name="id_delete" value=<?php echo $tuple['id']?>></div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                        <input type="submit" class="btn btn-danger" value="Si">
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
</body>
<?php 
}
else{
    header("Location: login.php?error=E tu chi cazzo sei");
}
?>