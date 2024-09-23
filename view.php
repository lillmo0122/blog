<!-- ログインID Maruta
パスワード test -->

<?php
  include 'lib/connect.php';
  include 'lib/queryArticle.php';
  include 'lib/article.php';

  if (!empty($_GET['id'])){
    $id = intval($_GET['id']); // 記事のIDを取得

    $queryArticle = new QueryArticle();
    $article = $queryArticle->find($id); // 指定記事IDの記事を取得
  } else {
    $article = null;
  }
?>

<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>

    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        padding-top: 5rem;
      }
      .cl-title { 
        color: #CAC2D5;
      }
      .bk-set {
        background-color: #9880DA;
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
    </style>

    <link href="./css/blog.css" rel="stylesheet">
  </head>
  <body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bk-set">
  <div class="container">
    <a class="navbar-brand" href="/blog/">My Blog</a>
  </div>
</nav>

<main class="container">
  <div class="row">
    <div class="col-md-8">
    <?php if ($article): ?>
      <article class="blog-post">
        <h2 class="blog-post-title cl-title"><?php echo $article->getTitle() ?></h2>
        <p class="blog-post-meta"><?php echo $article->getCreatedAt() ?></p>
        <?php echo nl2br($article->getBody()) ?>
      </article>
    <?php else: ?>
          <div class="alert alert-success">
            <p>記事はありません。</p>
          </div>
    <?php endif ?>
    </div>

    <div class="col-md-4">
      <div class="p-4 mb-3 bg-light rounded">
        <h4>ブログについて</h4>
        <p class="mb-0">毎日のなんてことない日常を書いていきます。</p>
      </div>
    </div>

  </div>

</main>

  </body>
</html>
