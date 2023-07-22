<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimun-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" type="text/css" href="css_login.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <img src="../img/logo.png" alt="TecnoMarket logo">
        <a class="navbar-brand" href="#">TecnoMarket</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index.html">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../productos.php">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="registro.php">Registrarse</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  
  <main>
    <div class="container">
      <h1>Iniciar sesión</h1>
      <?php
        session_start();
        require 'database.php';

        if (isset($_POST['nombre']) && isset($_POST['clave'])) {
          $nombre = mysqli_real_escape_string($conn, trim($_POST['nombre']));
          $clave = mysqli_real_escape_string($conn, trim($_POST['clave']));
          $sql = "SELECT * FROM registro WHERE Nombre = '$nombre'";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($clave, $row['clave'])) {
              $_SESSION['user_id'] = $row['id'];
              header("Location: index.html");
              exit;
            } else {
              echo '<div class="alert alert-danger" role="alert">La clave es incorrecta.</div>';
            }
          } else {
            echo '<div class="alert alert-danger" role="alert">No se encontró una cuenta con ese nombre.</div>';
          }
        }
      ?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
          <label for="clave">Clave:</label>
          <input type="password" class="form-control" id="clave" name="clave" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
      </form>
    </div>
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2023 TecnoMarket. Todos los derechos reservados.</p>
    </div>
  </footer>

  <script src="js/jquery-3.7.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Agrega aquí otros scripts personalizados si es necesario -->
</body>
</html>