<?php
namespace Controller;

use \Model\PageRepository;

class PageController
{
    private $repository;
    private $slug;
    private $pagetitle;

    public function __construct(\PDO $pdo)
    {
        $this->repository = new PageRepository($pdo);
        $this->slug = '';
        $this->pagetitle = '';
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

    public function listerAction()
    {
        $id = 0;
        ob_start();
        foreach ($this->repository->selectAll() as $page) {
            $id++;
            include APP_VIEW_DIR . 'inc/chunk/list_item.php';
        }
        return ob_get_clean();
    }

    public function makeNavbar()
    {
      ob_start();
      foreach ($this->repository->selectAll() as $page) {
          $class = $page->slug === $this->slug ? ' active ' : '';
          include APP_VIEW_DIR . 'inc/chunk/nav_item.php';
      }
      return ob_get_clean();
    }

    public function displayAction()
    {
        $this->slug = APP_DEFAULT_ROUTE;

        if (isset($_GET['p'])) {
            $this->slug = $_GET['p'];
        }
        $content = $this->repository->selectOne($this->slug);

        if ($content) {
            $this->pagetitle = $content->title;
            ob_start();
            include APP_VIEW_DIR . 'inc/page.php';
            $display = ob_get_clean();
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
                $content = $this->listerAction();
                $this->pagetitle = 'Liste des Pages';
                include APP_VIEW_DIR . 'inc/lister.php';
                break;
            case 'details':
                $content = $this->detailsAction($slug);
                $this->pagetitle = 'Détail de la page ' . $content->title;
                include APP_VIEW_DIR . 'inc/details.php';
                break;
            case 'ajouter':
                $content = $this->ajouterAction();
                $this->pagetitle = 'Ajouter une page';
                include APP_VIEW_DIR . 'inc/ajouter.php';
                break;
            case 'modifier':
                $content = $this->modifierAction($slug);
                $this->pagetitle = 'Modification de la page ' . $content->title;
                include APP_VIEW_DIR . 'inc/modifier.php';
                break;
            case 'supprimer':
                $content = $this->supprimerAction($slug);
                $this->pagetitle = 'Suppression de la page ' . $content->title;
                include APP_VIEW_DIR . 'inc/supprimer.php';
                break;
            default:
                ob_get_clean();
                include_once APP_VIEW_DIR . '404.php';
                die();
        }
        $display = ob_get_clean();
        include_once APP_VIEW_DIR . 'display.php';
    }

}
