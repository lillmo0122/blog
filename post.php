<?php
  // ログインを判別
  include 'lib/secure.php';
  include 'lib/connect.php';
  include 'lib/queryArticle.php';
  include 'lib/article.php';
  
  // 投稿用の変数を設定
  $title = "";        // タイトル
  $body = "";         // 本文
  $title_alert = "";  // タイトルのエラー文言
  $body_alert = "";   // 本文のエラー文言

  if (!empty($_POST['title']) && !empty($_POST['body'])){
    // titleとbodyがPOSTメソッドで送信されたとき SQLを実行
    $title = $_POST['title'];
    $body = $_POST['body'];
    // $db = new connect();
    // $sql = "INSERT INTO articles (title, body, created_at, updated_at)
    //         VALUES (:title, :body, NOW(), NOW())";

    // // queryを実行 第1引数はSQL 第2引数は割り当てる変数の連想配列
    // $result = $db->query($sql, array(':title' => $title, ':body' => $body));
    // header('Location: backend.php');

    // Articleインスタンスを作成
    // 値を保存してsaveメソッドを実行
    $article = new Article();
    $article->setTitle($title);
    $article->setBody($body);
    $article->save();

  } else if(!empty($_POST)){
    // POSTメソッドで送信されたが、titleかbodyが空のとき

    // titleチェック
    // POSTで送信されていれば、変数に代入
    if (!empty($_POST['title'])){
      $title = $_POST['title'];
    } else {
      $title_alert = "タイトルを入力してください。";
    }

    // bodyチェック
    // POSTで送信されていれば、変数に代入
    if (!empty($_POST['body'])){
      $body = $_POST['body'];
    } else {
      $body_alert = "本文を入力してください。";
    }
  }
?>

<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Backend</title>

  <link href="./css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 5rem;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .bg-red {
      background-color: #ffc6c7 !important;
    }
  </style>

  <link href="./css/blog.css" rel="stylesheet">
</head>

<body>

  <!-- ナビゲーションバー読み込み -->
  <?php include('lib/nav.php'); ?>

  <main class="container">
    <div class="row">
      <div class="col-md-12">

        <h1>記事の投稿</h1>

        <form action="post.php" method="post">
          <div class="mb-3">
            <label class="form-label">タイトル</label>
            <?php echo !empty($title_alert)? '<div class="alert alert-danger">'.$title_alert.'</div>': '' ?>
            <input type="text" name="title" value="<?php echo $title; ?>" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">本文</label>
            <?php echo !empty($body_alert)? '<div class="alert alert-danger">'.$body_alert.'</div>': '' ?>
            <textarea name="body" class="form-control" rows="10"><?php echo $body; ?></textarea>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">投稿する</button>
          </div>
        </form>

      </div>

    </div>

  </main>

</body>

</html>