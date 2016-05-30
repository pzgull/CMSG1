<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->pagetitle ?></title>
    <link href="<?= PUBLIC_BOOTSTRAP ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?= PUBLIC_BOOTSTRAP ?>/css/bootstrap-theme.min.css" rel="stylesheet">
</head>
<body role="document">
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
          <div class="navbar-header">
              <a class="navbar-brand" href="/">WtfWeb</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                  <?= $this->makeNavbar(); ?>
              </ul>
          </div>
      </div>
  </nav>
  <div class="container theme-showcase" role="main">
      <?= $display ?>
  </div>
</body>
</html>
