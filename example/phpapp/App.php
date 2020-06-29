<?php
class App {
  protected $template_dir = 'template/';

  protected $url = '';
  public function __construct() {
    $this->url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }

  /** GET Request */
  public function get($path, $callback) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $path == $this->url) {
      $callback();
    }
  }

  /** POST Request */
  public function post($path, $callback) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $path == $this->url) {
      $callback();
    }
  }

  /**
   * Meload file view di folder template
   *
   * @param [type] $view
   * @param array $vars array untuk data di view
   * @return void
   */
  public function view($view, $vars = []) {
    if ( ! empty($vars)) {
      // di ekstrak agar dapat diakses lebih mudah ['err']  menjadi $err
      extract($vars);
    }
    include $this->template_dir . $view;
  }
}