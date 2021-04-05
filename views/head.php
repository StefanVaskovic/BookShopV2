<?php
  if(isset($_SESSION['korisnik'])) {
    $korisnik = $_SESSION['korisnik'];

    $stranica ="http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if($korisnik->naziv == "admin" && $stranica == "http://malosamo.epizy.com/index.php") {
        header("Location: admin.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="robots" content="index, follow">
  <meta name="author" content="Stefan Vaskovic">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Web site made for selling books.">
  <meta name="keywords" content="Title, Genre, Author">

  <title>Book Shop</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/ikonica.ico"/>
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
    type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/agency.css" rel="stylesheet">
  <link href="css/mojCss.css" rel="stylesheet">

  <!--fa fa ikonice-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
