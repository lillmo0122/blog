<?php
class QueryArticle extends connect{
  private $article;

  // インスタンスが生成されるとコンストラクタが呼ばれ、親クラス(connectクラス)のコンストラクタが実行される
  public function __construct(){
    parent::__construct();
  }

  // Articleクラスのインスタンスを受け取ったら変数$articleのパラメータに保存
  public function setArticle(Article $article){
    $this->article = $article;
  }

  public function save(){
    if ($this->article->getId()){
      // $articleにIDがあるときは上書き
    } else {
      // $articleにIDがなければ新規作成
      $title = $this->article->getTitle();
      $body = $this->article->getBody();
      $stmt = $this->dbh->prepare("INSERT INTO articles (title, body, created_at, updated_at)
                VALUES (:title, :body, NOW(), NOW())");
      $stmt->bindParam(':title', $title, PDO::PARAM_STR);
      $stmt->bindParam(':body', $body, PDO::PARAM_STR);
      $stmt->execute();
    }   
  }

  // 記事データ1件を取得するメソッド
  public function find($id){
    $stmt = $this->dbh->prepare("SELECT * FROM articles WHERE id=:id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // articlesテーブルからidが:idであるレコードを取得する
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $article = null;
    if ($result){
      $article = new Article();
      $article->setId($result['id']);
      $article->setTitle($result['title']);
      $article->setBody($result['body']);
      $article->setCreatedAt($result['created_at']);
      $article->setUpdatedAt($result['updated_at']);
    }
    return $article;
  }
  
  // articlesテーブルから全件取得するメソッド
  public function findAll(){
    $stmt = $this->dbh->prepare("SELECT * FROM articles");
    $stmt->execute(); //SQL実行
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll()で結果全てを配列$resultsとして取得
    $articles = array();

    // $resultsに入っている結果をArticleクラスのインスタンスにして配列にする
    foreach ($results as $result){
      $article = new Article();
      $article->setId($result['id']);
      $article->setTitle($result['title']);
      $article->setBody($result['body']);
      $article->setCreatedAt($result['created_at']);
      $article->setUpdatedAt($result['updated_at']);
      $articles[] = $article;
    }
    return $articles;
  }
}
