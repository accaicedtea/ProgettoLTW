<?php include './head.html';?>

<?php 
session_start();
?>
<body>
  <div class="row mb-3">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <div class="card shadow mt-5">
        <div id="wrapper">
          <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
              <div class="container-fluid">
                <form class="form-signin">
                  <div row class="text-center">
                    <img class="mt-3 text-center" src="./assets/brand/4M-cropped.svg" alt="" width="200" height="200">
                  </div>
                  <p class="h3 text-dark mb-4 mt-3 text-center">Accedi</p>
                  <div class="text-start"><label class="form-label" for="inputEmail"><strong>Indirizzo email</strong></label></div>
                  <input type="email" id="inputEmail" class="form-control" placeholder="example@gmail.com" required autofocus>
                  <p></p>
                  <div class="text-start"><label class="form-label" for="inputPassowrd"><strong>Password</strong></label></div>
                  <input type="password" id="inputPassword" class="form-control" placeholder="************" required>
                  <p><br></p>
                  <div class="text-center"><button class="btn btn-lg btn-primary btn-block" type="submit">Accedi</button></div>
                  <p></p>
                  <div class="mb-4">
                    Non hai un account?
                    <a href="./register.php">Registrati</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3"></div>
  </div>
</body>
</html>