<section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-subheading text-muted">Give us suggestion</h2>
        </div>
      </div>
      <div class="row pt-3">
        <div class="col-lg-12  text-white">
          <form id="contactForm" action="logic/contact.php" method="post" onSumbit="return provera()">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="form-group">
                  <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject *" 
                    data-validation-required-message="Please enter your name.">
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" name="email" type="text" placeholder="Your Email *" 
                    data-validation-required-message="Please enter your email address.">
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="message" name="message" placeholder="Your Message *" 
                    data-validation-required-message="Please enter a message."></textarea>
                    <?php
                      if(isset($_SESSION['greskeKontakt'])):
                    ?>
                    <?php
                      foreach($_SESSION['greskeKontakt'] as $g):
                    ?>
                     <p class="help-block text-danger"><?= $g?></p>
                    <?php endforeach;?>
                    <?php unset($_SESSION['greskeKontakt']); elseif(isset($_SESSION['uspehKontakt'])):?>
                    <?php
                      foreach($_SESSION['uspehKontakt'] as $g):
                    ?>
                     <p class="help-block text-success"><?= $g?></p>
                    <?php endforeach;?>
                    <?php unset($_SESSION['uspehKontakt']);  endif;?>
                    <p id="greskaIme" class="help-block text-danger"></p>
                    <p id="greskaEmail" class="help-block text-danger"></p>
                    <p id="greskaPoruka" class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" name="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>