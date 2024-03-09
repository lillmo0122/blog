<?php
// ログインを判別
include 'lib/secure.php';
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

                <p>本文がここに入ります。</p>

            </div>

        </div>

    </main>

</body>

</html>