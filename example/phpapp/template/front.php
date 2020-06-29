<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplikasi Simple Tapi Past Tense 1</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="jumbotron">
          <h1 class="display-4">Simple Tapi Past Tense</h1>
          <hr class="my-4">
          <p>Mekanisme Login menggunakan <strong>Session</strong> dan <strong>Database</strong></p>
          <blockquote class="blockquote">
            <p class="mb-0">Pekerjaan yang berat akan terasa ringan apabila tidak dikerjakan.</p>
            <footer class="blockquote-footer">Zulkifli</footer>
          </blockquote>
          <a class="btn btn-primary btn-lg" href="/daftar" role="button">Form Pendaftaran</a>
        </div>
      </div>

      <!-- FORM LOGIN -->
      <div class="col-md-3">
        <!-- HANYA JIKA ADA ERROR -->
        <?php if ( ! empty($err)): ?>
        <div class="alert alert-danger mt-2 shadow-sm">
          <ul class="m-0 list-unstyled">
            <!-- ITERASI ERR -->
            <?php foreach ($err as $e): ?>
            <li><strong>&times; <?php echo $e ?></strong></li>
            <?php endforeach ?>
          </ul>
        </div>
        <?php endif ?>
        <!-- AKHIR DARI JIKA ADA ERROR -->

        <form method="POST" action="/login" class="mt-3">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required minlength="3" maxlength="40" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Kita tidak akan membagi email Anda pada pihak lain.</small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required minlength="6" maxlength="40">
          </div>
          <button type="submit" class="btn btn-primary">Login Aplikasi</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>