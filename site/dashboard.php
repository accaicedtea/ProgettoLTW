<?php
$pagina = "Dashboard";
include './head.php';
include './db_conn.php';
$_SESSION['data_oggi'] = date("Y:m:d");
if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
?>

<html>
    <body id="page-top">
        <?php include_once './navBar.php';?>
        <div id="wrapper">
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col lg-3 card shadow me-2">
                                <p>Entrate mensili</p>
                                <!--Entrate mensili da database-->
                                <?php
                                $username= $_SESSION['username'];
                                $data_oggi = $_SESSION['data_oggi'];
                                $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo > 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi')";
                                $result = $conn->query($query);
                                if ($result->num_rows>0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['somma'].'€';
                                }
                                ?>
                            </div>
                            <div class="col lg-3 card shadow me-2">
                                <p>Uscite mensili</p>
                                <?php
                                $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo < 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi')";
                                $result = $conn->query($query);
                                if ($result->num_rows>0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['somma'].'€';
                                }
                                ?>
                            </div>
                            <div class="col lg-3 card shadow me-2">
                                <p>Entrate annuali</p>
                                <?php
                                $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo > 0 AND spesa.utente = '$username' AND YEAR(spesa.data) = YEAR('$data_oggi')";
                                $result = $conn->query($query);
                                if ($result->num_rows>0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['somma'].'€';
                                }
                                ?>
                            </div>
                            <div class="col lg-3 card shadow me-2">
                                <p>Uscite annuali</p>
                                <?php
                                $username= $_SESSION['username'];
                                $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo < 0 AND spesa.utente = '$username' AND YEAR(spesa.data) = YEAR('$data_oggi')";
                                $result = $conn->query($query);
                                if ($result->num_rows>0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['somma'].'€';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php } else( header("Locacion: login.php"));
?>