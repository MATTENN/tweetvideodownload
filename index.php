<?php

if (isset($_COOKIE['screen_name'])) {
      $user_html = '<p class="navbar-text navbar-right status-text">'.htmlspecialchars($_COOKIE["screen_name"], ENT_QUOTES, 'UTF-8').'</p><li><a href="logout.php">ログアウト</a></li>';
      $form_html = '<input type="text" name="tweeturl" id="tweeturl" value="https://twitter.com/MATTENN/status/645948574434332674" class="form-control" placeholder=""><span class="input-group-btn"><button class="btn btn-primary btn-inverse"  id="send" type="button">Send</button></span>';
}else{
      $user_html = '<li><a href="prepare.php">ログイン</a></li>';
      $form_html = '<input type="text" name="tweeturl" id="tweeturl" value="" class="form-control" placeholder="ログインしてください。" disabled><span class="input-group-btn"><button class="btn btn-primary btn-inverse"  id="send" type="button" disabled="disabled">Send</button></span>';
}

?>


<!DOCTYPE HTML>
<html lang="ja">
      <head>
            <script src="http://code.jquery.com/jquery-2.1.4.min.js" ></script>
            <link rel="stylesheet" type="text/css" href="./honoka/css/bootstrap.min.css">
            <script src="./honoka/js/bootstrap.min.js" ></script>
            <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="xoj6defaed1cnvr"></script>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>TweetVideoDownload</title>
            <style media="screen">
                  .jumbotron h1{
                        font-size: 42px;
                  }
            </style>
            <script type="text/javascript">
            $(function () {
                  $('#send').click(function () {
                        var tweeturl = $('#tweetform [name=tweeturl]').val();
                        $.get('analyze.php',{
                              tweeturl: tweeturl
                        },function(rs){
                              $('#result').prepend(rs);
                        });
                  });
            });
            </script>
      </head>
      <body>
                  <nav class="navbar navbar-default">
                    <div class="container">
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Tweet Video Download</a>
                      </div>
                      <div id="navbar" class="navbar-collapse collapse">
                           <ul class="nav navbar-nav navbar-right">
                             <?php echo $user_html; ?>
                           </ul>
                      </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                  </nav>
            <div class="container">
                  <div class="jumbotron">
                        <h1>ツイートから動画をダウンロードするやつ</h1>
                        動画が添付されたツイートから動画へのURLを表示するツールです。著作権や肖像権に反しない範囲でご利用ください。<br>
                        Twitter apiの都合上、ログインが必須となっております。ご了承ください。


                  </div>
                  <hr>
                  ツイートへの完全なURL または ツイートのID(数桁の番号)をそのままペーストできます。<br>
                  URLを貼り付けて、sendボタンをクリックしてください。
                  <form id="tweetform">
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="input-group">

                              <?php echo $form_html; ?>

                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  </form>
                  <br>
                  <div class="row">
                  <div id="result">

                  </div>
                  </div>
                  <footer class="footer">
                        <hr>
        <p>お問い合わせは<a href="https://twitter.com/MATTENN">Twitter : @MATTENN</a> または mattenn@gochiusa.xyzまでお願いします。<a href="https://github.com/MATTENN/tweetvideodownload">Githubリポジトリはこちらから。</a></p>
      </footer>
            </div>
      </body>
</html>
