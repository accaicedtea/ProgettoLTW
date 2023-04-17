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
                                        <!-- Prendo dal database tutte le spese -->
                                        <?php
                                            $user = $_SESSION['username']; 
                                            $result = $conn->query("SELECT * FROM spesa WHERE utente = '$user'");
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