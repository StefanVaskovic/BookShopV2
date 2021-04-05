<section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-subheading text-muted">What is your favorite genre?</h2>
        </div>
      </div>
      <div class="row pt-3">
        <div class="col-lg-12  text-white">
          <form id="contactForm">
            <div class="row justify-content-center">
              <div class="col-lg-12 "></div>
                <div class="form-group">
                  <?php
                    require "logic/connection.php";

                    $upit = "SELECT * FROM zanr";

                    $rez = $konekcija->query($upit)->fetchAll();

                    foreach($rez as $r):
                  ?>
                  <input type="radio" name="rbZanr" class="rbZanr" data-id="<?= $r->idZanr?>"/><?= $r->naziv?><br/>
                  <?php endforeach;?>
                  <p id="greskaPol" class="help-block text-danger"></p>
                </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="btnSurvey" class="btn btn-primary btn-xl text-uppercase" type="button">Vote!</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>