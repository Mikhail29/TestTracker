<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->template->title ?></title>
    <meta name="description" content="<?php echo $this->template->description ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>
<body>
    <header class="px-0 px-md-5">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col"><a href="<?php echo $this->request->buildLink() ?>">Logo Place</a></div>
                <div class="col-auto">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                          <li class="nav-item active">
                            <a class="nav-link" href="<?php echo $this->userLogged ? $this->request->buildLink("auth/logout") : $this->request->buildLink("auth/login") ?>"><?php echo $this->userLogged ? "Выход" : "Вход" ?></a>
                          </li>
                        </ul>
                      </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <section class="pt-3 px-0 px-md-5">
      <?php foreach($this->request->getMessages() as $message):
      ?>
      <div class="<?php echo $message["class"] ?>" role="alert">
        <?php echo $message["message"] ?>
      </div>
      <?php
      endforeach;
      ?>
      <?php echo $this->template->controllerView ?>
    </section>
</body>
</html>