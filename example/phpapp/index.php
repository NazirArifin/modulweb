<?php
spl_autoload_register(function($class_name) {
  include $class_name . '.php';
});

session_start();
// inisialisasi class App
$app = new App();

// untuk GET '/'
$app->get('/', function() use($app) {
  // mungkin ada error dilempar dari POST /login
  $err = [];
  if (isset($_GET['err'])) {
    $err = $_GET;
  }
  $app->view('front.php', $err);
});

// untuk POST '/login', memproses form login
$app->post('/login', function() {
  if ( ! isset($_POST['email']) || ! isset($_POST['password'])) {
    exit('Invalid Request');
  }
  extract($_POST); // agar jadi $email dan $password
  
  // penampung error
  $err = [];
  // pastikan semua input tersedia / di set
  if ( ! Session::validateEmailPassword($email, $password)) {
    $err[] = 'Input tidak lengkap!';
  } else {
    if ( ! MyDb::checkAccount($email, $password)) {
      $err[] = 'Akun tidak dikenal!';
    }
  }

  if ( ! empty($err)) {
    // jika ada error, redirect ke front, login lagi
    header('Location: /?' . http_build_query(['err' => $err]));
  } else {
    // set session
    $profile = MyDb::getProfile($email);
    Session::setProfile($profile);
    
    // jika tidak ada berarti sukses, redirect ke home
    header('Location: /home');
  }
});

// untuk GET '/home'
$app->get('/home', function() use($app) {
  $app->view('home.php', Session::getProfile());
});

// untuk GET '/logout'
$app->get('/logout', function() {
  Session::removeUser();
  header('Location: /');
});