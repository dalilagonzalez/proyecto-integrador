<?php

//$nombre = "Jose";

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <!-- <link rel="stylesheet" href="css/navstyle.css"> -->
    <title>pIntegrador</title>
  </head>
  <body>
    <?php
      include ("header.php");
    ?>

    <div class="bd-example">

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/img1.jpg" class="d-block w-100" alt="imagen1">
          <div class="carousel-caption d-none d-md-block">
            <h5>Encontra lo que tu mejor amigo necesita</h5>
            <p>Alimento balanceado para todas las edades</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/peyga.jpg" class="d-block w-100" alt="imagen2">
          <div class="carousel-caption d-none d-md-block">
            <h5>Hacelo feliz</h5>
            <p>Trabajamos con las mejores marcas!</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/img3.jpg" class="d-block w-100" alt="imagen3">
          <div class="carousel-caption d-none d-md-block">
            <h5>Encontra eso que estas buscando</h5>
            <p>Respaldados por las mejores veterinarias del pais!</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>


  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-sm-12 col-md-6">
          <div class="card">
          <div class="card-body">
            <h5 class="card-title">Clinicas veterinarias</h5>
            <p class="card-text">Trabajamos con mas de 150 clinicas a lo largo de todo el pais.</p>
            <a href="#" class="btn btn-primary">Buscar clinica cercana</a>
          </div>
        </div>
      </div>
        <div class="col-sm-12 col-md-6">
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">El alimento que tu amigo necesita</h5>
              <p class="card-text">Respaldados por las mejores marcas, tenemos el alimento que tu amigo necesita.</p>
              <a href="#" class="btn btn-primary">Buscar alimento</a>
            </div>
          </div>
        </div>
    </div>    <div class="row mt-3">
          <div class="col-sm-12 col-md-6">
              <div class="card">
              <div class="card-body">
                <h5 class="card-title">Te vas de viaje?</h5>
                <p class="card-text">No te preocupes por tu mascota, contamos con mas de 100 anfitriones que pueden encargarse de el.</p>
                <a href="#" class="btn btn-primary">Ver hospedajes</a>
              </div>
            </div>
          </div>
            <div class="col-sm-12 col-md-6">
                <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Accesorios para mascotas.</h5>
                  <p class="card-text">Mima a tu mascota con nuestra amplia seleccion de juguetes pensados para el. </p>
                  <a href="#" class="btn btn-primary">Ver juguetes</a>
                </div>
              </div>
            </div>
        </div>
  </div>
  <?php
    include ("footer.php");
    ?>
  </body>

</html>
