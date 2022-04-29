<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  	<title>Mon titre</title>
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Tutoriel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="container" style="margin-top: 75px;">
  	<?= $content; ?>
  </div>
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/home.js"></script>
  </body>
</html>