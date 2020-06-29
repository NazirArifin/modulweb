<?php
declare(strict_types=1);

class Session {
  public static function validateEmailPassword(string $email, string $password): bool {
    // jika email tidak valid
    if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    }

    // jika password kurang dari 6 karakter
    if (strlen($password) < 6) {
      return false;
    }
    return true;
  }

  /**
   * Mengeset data profile ke Session
   *
   * @param array $profile
   * @return void
   */
  public static function setProfile(array $profile) {
    // tidak perlu session_start karena sudah ada di index.php

    $_SESSION['id'] = $profile['id'];
    $_SESSION['email'] = $profile['email'];
    $_SESSION['name'] = $profile['name'];
  }

  public static function getProfile(): array {
    return $_SESSION;
  }

  public static function removeUser() {
    $_SESSION = [];

    session_unset();
    session_destroy();
  }
}