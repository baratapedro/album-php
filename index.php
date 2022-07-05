<?php
session_start();
require_once "connection.php";

$sql = "SELECT * FROM images JOIN usuarios ON images.id = usuarios.id";
$result = mysqli_query($con, $sql);


if (isset($_SESSION['email'])) {
  $sqlUserID = "SELECT id, email FROM usuarios WHERE email = '{$_SESSION['email']}'";
  $resultUserID = mysqli_query($con, $sqlUserID);
  if (mysqli_num_rows($resultUserID) > 0) {
    while ($row = mysqli_fetch_assoc($resultUserID)) {
      $userID = $row['id'];
      $userEmail = $row['email'];
    }
  }
}

$qry="SELECT usuarios.email FROM usuarios INNER JOIN images WHERE usuarios.id = images.id";
$resultt = mysqli_query($con, $qry);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.98.0">
  <title>Album example · Bootstrap v5.2</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .form {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .image {
      width: 25rem;
      height: 25rem;
    }

    .col {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100vw;
    }

    .cardDisplay {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 2rem;
      width: 100vw;
    }

    .btn-group {
      margin-bottom: 4rem;
    }

    .card {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 25rem;
    }
  </style>


</head>

<body>

  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">About</h4>
            <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 class="text-white">Contact</h4>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white">Follow on Twitter</a></li>
              <li><a href="#" class="text-white">Like on Facebook</a></li>
              <li><a href="#" class="text-white">Email me</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
            <circle cx="12" cy="13" r="4" />
          </svg>
          <strong>Album</strong>
        </a>
        <?php
        if (isset($_SESSION['email'])) {  ?>
          <a href="logout.php">Logout</a>
        <?php   } else { ?>
          <a href="registration.php">Cadastro</a>
          <a href="login.php">Login</a>
        <?php
        }
        ?>
      </div>
    </div>
  </header>

  <main>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <div id="alert"></div>
          <?php
          if (isset($_SESSION['message'])) {
            echo "
              <script>
              let errorMessage = '{$_SESSION['message']}';
              let message = document.getElementById('alert');
              message.innerHTML = errorMessage;
              setInterval(() => {message.innerHTML = ''}, 3000);
              </script>";
          }
          unset($_SESSION['message']);

          if (isset($_SESSION['email'])) {
            echo "
            <h1 class='fw-light'>Fazer upload de imagens</h1>
            <form action='upload.php' method='POST' enctype='multipart/form-data' class='form'>
              <input type='file' name='arquivo' />
              <textarea name='description' cols='30' rows='5' placeholder='Digite a descrição'></textarea>
              <button type='submit' name='send_button'>Enviar</button>
            </form>
            ";
          } else {
            echo "<h1>Faça login para enviar suas fotos!</h1>";
          }

          ?>
         
        </div>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <div class="col">
            <div class='cardDisplay'>

              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $image_path = $row["image_path"];
                  $description = $row['descricao'];
                  $image_id = $row['id'];
                  $userSendPictureEmail = $row["email"];
                  echo "<div class='card'><img src='$image_path' alt='Imagem' class='image'/>
                  <p class='p'>$description <br></p>
                  <p>Enviado por : $userSendPictureEmail</p>
                  <div class='d-flex justify-content-between align-items-center btDiv'>";
                  if (isset($_SESSION['email'])) {
                    if ($image_id == $userID) {
                      echo "
                      <div class='btn-group'>
                        <button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button>
                      </div>
                   </div>
                      </div>";
                    } else {
                      echo "<div class='btn-group'></div>
                      </div>
                      </div>";
                    }
                  } else {
                    echo "<div class='btn-group'></div>
                    </div>
                    </div>";
                  }
                }
              } else {
                echo "0 results";
              }

              // if (mysqli_num_rows($resultt) > 0) {
              //   while ($row = mysqli_fetch_assoc($resultt)) {
              //     $a = $row["email"];
              //     echo "$a";
              //   }
              // }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="text-muted py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a href="#">Back to top</a>
      </p>
      <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
      <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="../getting-started/introduction/">getting started guide</a>.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>