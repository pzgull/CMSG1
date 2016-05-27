<?php
namespace Controller;

use \Model\PageRepository;

class PageController
{
    private $repository;

    public function __construct(\PDO $pdo)
    {
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
        ob_start();
        foreach ($this->repository->selectAll() as $page) {
            include APP_VIEW_DIR . 'inc/list_item.php';
        }
        return ob_end_flush();
    }

    public function makeNavbar($slug)
    {
      ob_start();
      foreach ($this->repository->selectAll() as $page) {
          $class = $page->slug === $slug ? 'class="active"' : '';
          include APP_VIEW_DIR . 'inc/nav_item.php';
      }
      return ob_end_flush();
    }

    public function displayAction()
    {
        $slug = APP_DEFAULT_ROUTE;
        if (isset($_GET['p'])) {
            $slug = $_GET['p'];
        }
        $content = $this->repository->selectOne($slug);

        if ($content) {
            ob_start();
            include APP_VIEW_DIR . 'inc/page_content.php';
            $display = ob_end_flush();
            include_once APP_VIEW_DIR . 'display.php';
        } else {
            include_once APP_VIEW_DIR . '404.php';
        }
    }
    
    public function adminAction()
    {
        $action = APP_DEFAULT_ACTION;
        if (isset($_GET['a'])) {
            $action = $_GET['a'];
        }

        ob_start();
        switch ($action) {
            case 'lister':
                include APP_VIEW_DIR . 'inc/lister_content.php';
                break;
            case 'details':
                include APP_VIEW_DIR . 'inc/details_content.php';
                break;
            case 'ajouter':
                include APP_VIEW_DIR . 'inc/ajouter_content.php';
                break;
            case 'modifier':
                include APP_VIEW_DIR . 'inc/modifier_content.php';
                break;
            case 'supprimer':
                include APP_VIEW_DIR . 'inc/supprimer_content.php';
                break;
            default:
                ob_end_clean();
                include_once APP_VIEW_DIR . '404.php';
                die();
        }
        $display = ob_end_flush();
        include_once APP_VIEW_DIR . 'display.php';
    }

}
