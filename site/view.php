<?php 
    $pagina='Utenti';
    include './head.php';
    ?>   
<body id="page-top">
    <?php 
        include './db_conn.php';
        include './navBar.php';
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on' && $_SESSION['username']=='admin'){
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
                        <p class="h3 text-center mb-3 mt-3">Visualizzazione utenti inscritti</p>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">I miei pagurini</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th scope="col">username</th>
                                                <th scope="col">nome</th>
                                                <th scope="col">cognome</th>
                                                <th scope="col">data di nascista</th>
                                                <th scope="col">sesso</th>
                                                <th scope="col">email</th>
                                                <th scope="col">blocca utente</th>
                                                <th scope="col">elimina utente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $user = $_SESSION['username'];
                                                if($user=='admin'){ 
                                                    $result = $conn->query("SELECT * FROM utente ");
                                                }
                                                $tuples = array();
                                                if($result->num_rows> 0){
                                                    $tuples= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                }
                                                foreach ($tuples as $tuple) { 
                                                    if($tuple['username']!='admin'){
                                                    ?>
                                            <tr class="table-<?php if($tuple['sesso']==0) echo 'dark';?>">
                                                <td scope="row">
                                                    <p><?php echo $tuple['username'];?></p>
                                                </td>
                                                <td >
                                                    <p><?php echo $tuple['nome'];?></p>
                                                </td>
                                                <td >
                                                    <p><?php echo $tuple['cognome'];?></p>
                                                </td>
                                                <td >
                                                    <p><?php echo $tuple['dataNascita'];?></p>
                                                </td>
                                                <td >
                                                    <p><?php echo ($tuple['sesso']==1) ? "Uomo" : "Donna";?></p>
                                                </td>
                                                <td >
                                                    <p><?php echo $tuple['email'];?></p>
                                                </td>
                                                <td class="text-center ">
                                                    <?php 
                                                        $un = $tuple['username'];
                                                        $sql = "SELECT password from utente WHERE username='$un'";
                                                        $result = mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($result) === 1){
                                                            $row = mysqli_fetch_assoc($result);
                                                            $pass = $row['password'];
                                                        } 
                                                        if(substr($pass, -10)!='adminBlock'){?>
                                                    <form action="./blocca_utente.php" method="post" name="form-block-user" class="form-block-user">
                                                        <input class="visually-hidden" type="text" id="username" name="blockthis" value="<?php echo $tuple['username'];?>" readonly>
                                                        <button type="submit"  class="btn btn-warning btn-sm">Blocca utente</button>
                                                    </form>
                                                    <?php }else{ ?>
                                                    <form action="./sblocca_utente.php" method="post" name="form-sblock-user" class="form-sblock-user">
                                                        <input class="visually-hidden" type="text" id="username" name="sblockthis" value="<?php echo $tuple['username'];?>" readonly>
                                                        <button type="submit"  class="btn btn-success btn-sm">Sblocca utente</button>
                                                    </form>
                                                    <?php }?>
                                                </td>
                                                <td class="text-center ">
                                                    <button type="button" name="<?php echo $tuple['username'];?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEntry">Elimina utente</button>
                                                    <div class="modal fade" id="modalEditEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Elimina definitivamente un utente</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- INIZIO FORM -->
                                                                    <form action="./elimina_utente.php" method="post" name="edit_form">
                                                                        <div class="row">
                                                                            <input class="visually-hidden" type="text" id="username" name="sblockthis" value="<?php echo $tuple['username'];?>" readonly>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Rinuncio</button>
                                                                            <button type="submit" class="btn btn-danger">Si sono proprio sicuro di volere eliminare definitivamente questo utente</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
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
<?php }else{
    header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    } ?>