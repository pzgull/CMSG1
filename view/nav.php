<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">WtfWeb</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <?php
foreach ($this->repository->selectAll() as $page) {
    $class = $page->slug === $slug ? 'class="active"' : '';
    ?>
                <li <?= $class ?>><a href="?p=<?= $page->slug ?>"><?= $page->title ?></a></li>
    <?php
} ?>
            </ul>
        </div>
    </div>
</nav>