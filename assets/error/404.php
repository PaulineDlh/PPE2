<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Erreur 404</title>
      <?php include '../php/allcss.php'; ?>
      <style>
      .potitionerror{
        margin: 10% auto;
      }
      html{
        height: 100%;
      }
      body{
        height: 100%;
      }
      section{
        min-height: 85%;
      }
      </style>
  </head>
  <body>
    <?php include '../php/nav.php'; ?>
    <div class="error potitionerror">
      <div class="container-floud">
        <div class="col-xs-12 ground-color text-center">
          <h1>Oops!</h1>
          <h2>404 Not Found</h2>
          <h2 class="error-details">Désolé, la page que vous cherchez n'existe pas! :'(</h2>
        </div>
      </div>
    </div>
    <?php include '../php/footer.php'; ?>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
