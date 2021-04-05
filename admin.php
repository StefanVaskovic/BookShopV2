<?php
 session_start();
    if(!isset($_SESSION['korisnik'])){
        header("Location: index.php?page=Home");
    } else {
        $korisnik = $_SESSION['korisnik'];

        if($korisnik->naziv != "admin") {
            header("Location: index.php?page=Home");
        }
    }

   
    require "views/head.php";
    require "views/nav.php";
    require "views/header.php";
    



?>
<section class="page-section" id="contact">
    <div class="container ">
        <div id="adminNav" class="row d-flex justify-content-around flex-lg-row">
            <a href="#insertForms">Insert</a>
            <a href="#updateDelete">Update/Delete</a>
            <a href="#survey">Survey</a>
            <a href="#orders">Orders</a>
            <a href="#updateDeleteUser">Users</a>
            <a href="#contactFormAdmin">Contact</a>
            <a href="#genres">Genres</a>
        </div>
    </div>
    <div id="insertForms" class="container">
        <div class="row pt-3">
            <div class="col-lg-12 p-3 text-white">
                <form id="insertForm">
                    <h2 class="section-subheading text-muted text-center">Insert book and autor</h2>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input class="form-control" id="title" type="text" name="title" placeholder="Title ">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="newPrice" id="newPrice" type="number" min="1"
                                    placeholder="New Price ">
                                <p id="greskaEmail" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="oldPrice" id="oldPrice" type="number" min="1"
                                    placeholder="Old Price ">
                                <p id="greskaEmail" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="src" type="text" name="src" placeholder="Picture src">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="srcCart" type="text" name="srcCart"
                                    placeholder="Picture src cart">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="messageInsert" id="messageInsert"
                                    placeholder="Description "
                                    data-validation-required-message="Please enter a message."></textarea>
                                <p id="greskaPoruka" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="dateInsert" type="date" name="dateInsert"
                                    placeholder="Publish Date ">
                                <p id="greskaEmail" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <select id="ddlGenre" name="ddlGenre" class="form-control">
                                    <option value="0">Genre</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="autorName" type="text" name="autorName"
                                    placeholder="Autor Name ">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="autorSurname" type="text" name="autorSurname"
                                    placeholder="Autor Surname ">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <input type="button" id="btnInsert" name="btnInsert"
                                    class="btn btn-primary btn-xl text-uppercase" value="Insert" />
                            </div>
                        </div>
                </form>
            </div>

            <div class="col-lg-12 p-3 text-white">
                <form id="insertFormBook">
                    <h2 class="section-subheading text-muted text-center">Insert book</h2>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input class="form-control" id="titleBook" type="text" name="titleBook"
                                    placeholder="Title ">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="newPriceBook" id="newPriceBook" type="number" min="1"
                                    placeholder="New Price ">
                                <p id="greskaEmail" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="oldPriceBook" id="oldPriceBook" type="number" min="1"
                                    placeholder="Old Price ">
                                <p id="greskaEmail" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="srcBook" type="text" name="srcBook"
                                    placeholder="Picture src">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="srcBookCart" type="text" name="srcBookCart"
                                    placeholder="Picture src cart">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="messageInsertBook" id="messageInsertBook"
                                    placeholder="Description "
                                    data-validation-required-message="Please enter a message."></textarea>
                                <p id="greskaPoruka" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="dateInsertBook" type="date" name="dateInsertBook"
                                    placeholder="Publish Date ">
                                <p id="greskaEmail" class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <select id="ddlGenreBook" name="ddlGenreBook" class="form-control">
                                    <option value="0">Genre</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <select id="ddlAutorInsert" name="ddlAutorInsert" class="form-control">
                                    <option value="0">Autor</option>


                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <input type="button" id="btnInsertBook" name="btnInsertBook"
                                    class="btn btn-primary btn-xl text-uppercase" value="Insert" />
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div id="updateDelete" class="col-lg-12 text-dark p-3 table-responsive border-bottom border-dark">
        <h2 class="section-subheading text-muted text-center pt-3">Update/Delete</h2>
        <table class="table table-stripped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>New price</th>
                    <th>Old price</th>
                    <th>Publish date</th>
                    <th>Id genre</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <?php

                        require_once "logic/getAllBooksAdmin.php";

                        foreach($knjige as $k):
                    ?>
            <tbody>
                <tr>
                    <td class="align-middle"><?= $k->naslov?></td>
                    <td class="align-middle"><?= $k->novaCena?></td>
                    <td class="align-middle"><?= $k->staraCena?></td>
                    <td class="align-middle"><?= $k->datumObjave?></td>
                    <td class="align-middle"><?= $k->idZanr?></td>
                    <td class="align-middle"><a href="#updateForm" data-ida="<?= $k->idAutor?>"
                            data-idk="<?= $k->idNaslov?>" class="btn btn-secondary update">Update</a></td>
                    <td class="align-middle"><a href="#" data-id="<?= $k->idNaslov?>"
                            class="btn btn-secondary delete">Delete</a></td>
                </tr>
            </tbody>
            <?php endforeach;?>
        </table>
    </div>
    <div class="col-lg-12 pt-3 text-white">
        <form id="updateForm" action="logic/update.php" method="post">
            <h2 class="section-subheading text-muted text-center">Update form</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-group">
                        <input class="form-control" name="idNaslovHidden" id="idNaslovHidden" type="hidden"
                            placeholder="New Price " />
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="idNaslovAutorHidden" id="idNaslovAutorHidden" type="hidden"
                            placeholder="New Price " />
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="titleUpd" type="text" name="titleUpd" placeholder="Title ">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="newPriceUpd" id="newPriceUpd" type="number" min="1"
                            placeholder="New Price ">

                    </div>
                    <div class="form-group">
                        <input class="form-control" name="oldPriceUpd" id="oldPriceUpd" type="number" min="0"
                            placeholder="Old Price ">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="messageUpd" id="messageUpd" placeholder="Description "
                            data-validation-required-message="Please enter a message."></textarea>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="dateUpd" type="date" name="dateUpd" placeholder="Publish Date ">

                    </div>
                    <div class="form-group">
                        <select id="ddlGenreUpd" name="ddlGenreUpd" class="form-control">


                        </select>
                    </div>
                    <div class="form-group">
                        <select id="ddlAutorUpd" name="ddlAutorUpd" class="form-control">


                        </select>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <div id="success"></div>
                        <input type="submit" id="btnUpd" name="btnUpd" class="btn btn-primary btn-xl text-uppercase"
                            value="Update" />
                    </div>
                </div>
        </form>
    </div>
    <div class="container">
        <div id="survey" class="col-lg-12 text-dark p-3 table-responsive ">
            <h2 class="section-subheading text-muted text-center pt-3">Survey</h2>
            <table class="table table-stripped table-bordered table-hover">
                <tr>
                    <th>Genre</th>
                    <th>Number of votes</th>
                </tr>
                <?php

                require_once "logic/connection.php";

                $upitAnketa = "SELECT naziv,COUNT(*) as brGlasova FROM anketa a INNER JOIN odgovor o ON a.idAnketa = o.idAnketa INNER JOIN glasanje g ON o.idKorisnik = g.idKorisnik INNER JOIN zanr z ON g.idZanr = z.idZanr INNER JOIN korisnik k ON g.idKorisnik = k.idKorisnik WHERE aktivna = 1 GROUP BY naziv";

                $rezAnketa = $konekcija->query($upitAnketa)->fetchAll();

                foreach($rezAnketa as $r):
            ?>
                <tr>
                    <td class="align-middle"><?= $r->naziv?></td>
                    <td class="align-middle"><?= $r->brGlasova?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    <div class="container">
        <div id="orders" class="col-lg-12 text-dark p-3 table-responsive ">
            <h2 class="section-subheading text-muted text-center pt-3">Orders</h2>
            <table class="table table-stripped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Title</th>
                        <th>Date of order</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <?php

                $upitOrders = "SELECT ime,prezime,naslov,datumNarucivanja,kolicina FROM porudzbina p INNER JOIN porudzbina_detalji pd ON p.idPorudzbina = pd.idPorudzbina INNER JOIN naslov n ON pd.idNaslov = n.idNaslov INNER JOIN korisnik k ON p.idKorisnik = k.idKorisnik";

                $rezOrders = $konekcija->query($upitOrders)->fetchAll();

                function obradaDatuma($datum){
                    $niz = explode(' ',$datum);
                    return $niz[0];
                }

                foreach($rezOrders as $r):
            ?>
                <tbody>
                    <tr>
                        <td class="align-middle"><?= $r->ime?></td>
                        <td class="align-middle"><?= $r->prezime?></td>
                        <td class="align-middle"><?= $r->naslov?></td>
                        <td class="align-middle"><?= obradaDatuma($r->datumNarucivanja)?></td>
                        <td class="align-middle"><?= $r->kolicina?></td>
                    </tr>
                </tbody>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    <div class="container">
        <div id="updateDeleteUser" class="col-lg-12 text-dark p-3 table-responsive border-bottom border-dark">
            <h2 class="section-subheading text-muted text-center pt-3">Update/Delete</h2>
            <table class="table table-stripped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Date of registration</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php

                        $upitKorisnici = "SELECT * FROM korisnik";

                $rezKorisnici = $konekcija->query($upitKorisnici);  

                        foreach($rezKorisnici as $r):
                    ?>
                <tbody>
                    <tr>
                        <td class="align-middle"><?= $r->ime?></td>
                        <td class="align-middle"><?= $r->prezime?></td>
                        <td class="align-middle"><?= $r->email?></td>
                        <td class="align-middle"><?= $r->username?></td>
                        <td class="align-middle"><?= $r->datumRegistracije?></td>
                        <td class="align-middle"><a href="#updateFormUser" data-ida="<?= $r->idAutor?>"
                                data-idkor="<?= $r->idKorisnik?>" class="btn btn-secondary updateUser">Update</a></td>
                        <td class="align-middle"><a href="#" data-idkor="<?= $r->idKorisnik?>"
                                class="btn btn-secondary deleteUser">Delete</a></td>
                    </tr>
                </tbody>
                <?php endforeach;?>
            </table>
        </div>
        <div class="col-lg-12 pt-3 text-white">
            <form id="updateFormUser" action="logic/updateUser.php" method="post">
                <h2 class="section-subheading text-muted text-center">Update form</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input class="form-control" name="idKorisnikHidden" id="idKorisnikHidden" type="hidden"
                                placeholder="New Price " />
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="emailUpd" type="text" name="emailUpd" placeholder="Email ">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="usernameUpd" id="usernameUpd" type="text" 
                                placeholder="Username ">

                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success"></div>
                            <input type="submit" id="btnUpdUser" name="btnUpdUser" class="btn btn-primary btn-xl text-uppercase"
                                value="Update" />
                        </div>
                    </div>
            </form>
        </div>

    </div>
    <div class="container">
        <div id="contactFormAdmin" class="col-lg-12 text-dark p-3 table-responsive ">
            <h2 class="section-subheading text-muted text-center pt-3">Contact</h2>
            <table class="table table-stripped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <?php

                $upitKontakt = "SELECT tema,email,poruka FROM kontakt";

                $rezKontakt = $konekcija->query($upitKontakt)->fetchAll();

                foreach($rezKontakt as $r):
            ?>
                <tbody>
                    <tr>
                        <td class="align-middle"><?= $r->tema?></td>
                        <td class="align-middle"><?= $r->email?></td>
                        <td class="align-middle"><?= $r->poruka?></td>
                    </tr>
                </tbody>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    <div class="row pt-3">
    <div class="col-lg-12 p-3 text-white">
                <form id="genres">
                    <h2 class="section-subheading text-muted text-center">Insert genre</h2>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input class="form-control" id="genreInsert" type="text" name="genreInsert" placeholder="Genre ">
                                <p id="greskaIme" class="help-block text-danger"></p>
                            </div>
                            <div class="col-lg-12 text-center">
                                <input type="button" id="btnInsertGenre" name="btnInsertGenre"
                                    class="btn btn-primary btn-xl text-uppercase" value="Insert" />
                            </div>
                        </div>
                </form>
            </div>
</div>
</section>

<?php


    require "views/footer.php";


?>
<?php




    require "views/script.php";
?>