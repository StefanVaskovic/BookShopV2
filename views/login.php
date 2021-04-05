




<section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center greske">
        <?php 


            if(isset($_SESSION['greske'])){

            foreach($_SESSION['greske'] as $greska){

              echo $greska ."<br/>";
            }

            unset($_SESSION['greske']);
            
            }
        ?>
        </div>
      </div>
      <div class="row pt-3">
        <div class="col-lg-12  text-white">
          <form id="loginForm" action="logic/login.php" method="post">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="form-group">
                <div class="form-group">
                  <input class="form-control" id="emailLogin" name="emailLogin" type="text" placeholder="Your Email *">
                  <p id="greskaEmail" class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" name="passLogin" id="passLogin" type="password" placeholder="Your Password *">
                  <p id="greskaEmail" class="help-block text-danger"></p>
                </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <input type="submit" id="btnLogin" name="btnLogin" class="btn btn-primary btn-xl text-uppercase" value="Login"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>