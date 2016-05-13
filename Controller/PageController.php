<?php
namespace Controller;

use \Model\PageRepository;

class PageController
{
    private $repository;

    public function __construct(\PDO $pdo)
    {
        echo 'Page Controller' . PHP_EOL;
        $this->repository = new PageRepository($pdo);
    }

    public function ajoutAction()
    {
        // TODO: Use add method from PageRepository
    }

    public function supprimerAction()
    {
        // TODO: Use delete method from PageRepository
    }

    public function modifierAction()
    {
        // TODO: Use update method from PageRepository
    }

    public function detailsAction()
    {
        // TODO: Use get (one) method from PageRepository
    }

    public function listeAction()
    {
        // TODO: Use get (many) method from PageRepository
    }

    public function displayAction()
    {
        $slug = APP_DEFAULT_ROUTE;
        if (isset($_GET['p'])) {
            $slug = $_GET['p'];
        }

        $content = $this->repository->selectOne($slug);

        if ($content) {
            include_once APP_VIEW_DIR . '/display.php';
        } else {
            include_once APP_VIEW_DIR . '/404.php';
        }
    }

}