<?php
declare(strict_types=1);

class MyDb {
  private static $conn;

  private static function connect() {
    // load file config
    include 'dbconfig.php';
    // buat koneksi ke database
    self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  }

  /**
   * memeriksa akun apakah ada di database
   *
   * @param string $email
   * @param string $password
   * @return boolean
   */
  public static function checkAccount(string $email, string $password): bool {
    // lempar ke fungsi query yang sudah harus mengecek $conn untuk koneksi
    $res = self::query("SELECT COUNT(ID_USER) AS TOTAL FROM user WHERE EMAIL_USER = '$email' AND PASSWORD_USER = '$password' AND STATUS_USER = 1");
    $data = $res->fetch_assoc();
    return $data['TOTAL'] == 1;
  }

  /**
   * dapatkan profile pengguna, jika data lebih banyak biasanya diletakkan tabel profile
   *
   * @param string $email
   * @return void
   */
  public static function getProfile(string $email): array {
    $res = self::query("SELECT * FROM user WHERE EMAIL_USER = '$email' AND STATUS_USER = 1");
    $data = $res->fetch_assoc();
    return [
      'id' => $data['ID_USER'],
      'email' => $data['EMAIL_USER'],
      'name' => $data['NAME_USER']
    ];
  }

  public static function query(string $query) {
    // pastikan sudah ada koneksi
    if (empty(self::$conn)) self::connect();
    return self::$conn->query($query);
  }
}