<?php

$nombre = "Jose";

?>

<!DOCTYPE html>
<html lang="sp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Login Proyecto Integrador</title>
  </head>
  <body>
    <header>
      <h1>INCLUIR HEADER DE LOGIN</h1>
    </header>
    <section class="login">

      <form>
        <div class="form-group">
          <label class="exampleInput" for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

        </div>
        <div class="form-group">
          <label class="exampleInput" for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
      </form>

    </section>
    <section class="not-login">
      <button type="submit" class="btn btn-lg btn-secondary">Registrate</button>
      <button type="submit" class="btn btn-lg btn-secondary">olvidé mi contraseña</button>
    </section>

  </body>
</html>
