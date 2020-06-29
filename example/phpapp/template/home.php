<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a href="/home" class="navbar-brand">STP</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="/home" class="nav-link">Beranda</a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">Pengguna</a>
        </li>
      </ul>
      <a href="/logout" class="btn btn-outline-secondary btn-sm">KELUAR</a>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col mt-5">
        <p class="lead">Hello, Selamat Datang <strong><?php echo $name ?></strong></p>
        <ul>
          <li>ID: <?php echo $id ?></li>
          <li>EMAIL: <?php echo $email ?></li>
        </ul>
        <a href="/logout" class="btn btn-danger btn-sm shadow-sm">KELUAR APLIKASI</a>
      </div>
    </div>
  </div>
</body>
</html>