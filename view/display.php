<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $content->title ?></title>
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
</head>
<body role="document">
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
          <div class="navbar-header">
              <a class="navbar-brand" href="/">WtfWeb</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <?= $this->makeNavbar($slug); ?>
              </ul>
          </div>
      </div>
  </nav>
  <div class="container theme-showcase" role="main">
      <div class="jumbotron">
          <h1><?= $content->h1 ?></h1>
          <p><?= $content->body ?></p>
          <span class="label <?= $content->span_class ?>"><?= $content->span_text ?></span>
      </div>
      <img class="img-thumbnail" alt="<?= $content->title ?>" src="img/<?= $content->img ?>" data-holder-rendered="true">
  </div>
</body>
</html>
