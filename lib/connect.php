<?php
// DB接続用
class connect{
  const DB_NAME = "blog";
  const HOST = "localhost";
  const USER = "user";
  const PASS = "pass";

  // メンバ変数
  // $dbh にはDBを操作するための情報が入る
  //protected にすることで、継承したクラスで参照できる
  protected $dbh;

  // コンストラクタ
  // インスタンスが作成されたときに自動的に実行されるメソッド
  public function __construct(){
    $dsn = "mysql:host=".self::HOST.";dbname=".self::DB_NAME.";charset=utf8mb4"; //どのホストのどのDBに接続するか
    
    try {
      // PDOのインスタンスをクラス変数に格納する
      $this->dbh = new PDO($dsn, self::USER, self::PASS);

    } catch(Exception $e){
      // Exceptionが発生したら表示して終了
      exit($e->getMessage());
    }

    // DBのエラーを表示するモードを設定
    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }

  public function query($sql, $param = null){
    // プリペアドステートメントを作成し、SQL文を実行する準備をする
    // SELECT * FROM users WHERE id=●●　←型を用意することにより、高速で実行出来る
    $stmt = $this->dbh->prepare($sql);
    // パラメータを割り当てて実行し、結果セットを返す
    $stmt->execute($param);
    return $stmt;
  }
}
?>
