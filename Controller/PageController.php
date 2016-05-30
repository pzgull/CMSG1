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
        $view = array(
            'error' => APP_VIEW_DIR . 'inc/chunk/details_error.php',
            'default' => APP_VIEW_DIR . 'inc/chunk/details_item.php'
        );
        ob_start();
        if (!isset($_GET['id'])) {
            $error = 'Paramètre ID manquant';
            include $view['error'];
            return ob_get_clean();
        }
        
        $data = $this->repository->selectOneById($_GET['id']);
        if (!$data) {
            $error = 'Cette page n\'existe pas.';
            include $view['error'];
            return ob_get_clean();
        }

        $this->pagetitle = 'Détail de la page ' . $data->title;
        include $view['default'];
        return ob_get_clean();
    }

    public function listerAction()
    {
        $this->pagetitle = 'Liste des Pages';
        $data = $this->repository->selectAll();
        $view = array(
            'error' => APP_VIEW_DIR . 'inc/chunk/lister_error.php',
            'default' => APP_VIEW_DIR . 'inc/chunk/lister_item.php'
        );

        ob_start();
        if (count($data) == 0) {
            $error = 'Aucune page disponible';
            include $view['error'];
            return ob_get_clean();
        }

        $id = 0;
        foreach ($data as $page) {
            $id++;
            include APP_VIEW_DIR . 'inc/chunk/lister_item.php';
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
        $content = $this->repository->selectOneBySlug($this->slug);

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
                include APP_VIEW_DIR . 'inc/lister.php';
                break;
            case 'details':
                $content = $this->detailsAction();
                include APP_VIEW_DIR . 'inc/details.php';
                break;
            case 'ajouter':
                $content = $this->ajouterAction();
                $this->pagetitle = 'Ajouter une page';
                include APP_VIEW_DIR . 'inc/ajouter.php';
                break;
            case 'modifier':
                $content = $this->modifierAction();
                $this->pagetitle = 'Modification de la page ' . $content->title;
                include APP_VIEW_DIR . 'inc/modifier.php';
                break;
            case 'supprimer':
                $content = $this->supprimerAction();
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
