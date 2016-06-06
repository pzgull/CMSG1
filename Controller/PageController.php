<?php
namespace Controller;

use \Model\PageRepository;

class PageController
{
    private $repository;
    private $slug;
    private $action;
    private $pagetitle;
    private $nav;

    public function __construct(\PDO $pdo)
    {
        $this->repository = new PageRepository($pdo);
        $this->slug = '';
        $this->action = '';
        $this->pagetitle = '';
    }

    public function ajouterAction()
    {
        $this->pagetitle = 'Ajouter une page';
        
        if (!isset($_POST['ajouter'])) {
            return '';
        }
        
        $requiredFields = ['title', 'h1', 'body', 'label-type', 'label-text'];
        $undefined = count($requiredFields);
        foreach (array_keys($_POST) as $key) {
            if (in_array($key, $requiredFields)) {
                $undefined--;
            }
        }
        
        ob_start();
        if ($undefined) {
            $message['type'] = 'danger';
            $message['text'] = 'Il manque des champs!';
        } else {
            $page = $_POST;
            $page['slug'] = strtolower($_POST['title']);
            $page['img'] = 'snorkies.jpg';

            $this->repository->create($page);
            $message['type'] = 'success';
            $message['text'] = 'Page ajoutée';
        }
        
        include APP_VIEW_DIR . 'inc/chunk/form_message.php';
        return ob_get_clean();
    }

    public function supprimerAction()
    {
        // TODO: Use delete method from PageRepository
    }

    public function modifierAction()
    {
        if (!isset($_GET['id'])) {
            ob_start();
            $message['type'] = 'danger';
            $message['text'] = 'Aucune page n\'a été spécifiée.';
            include APP_VIEW_DIR . 'inc/chunk/form_message.php';
            return ob_get_clean();
        } elseif (!isset($_POST['modifier'])) {
            ob_start();
            $page = $this->repository->selectOneById($_GET['id']);
            $this->pagetitle = 'Modification de la page ' . $page->title;
            foreach (['default', 'success', 'warning', 'danger'] as $label) {
                $selected = '';
                if ($page->span_class === 'label-' . $label) {
                    $selected = ' checked ';
                }
                include APP_VIEW_DIR . 'inc/chunk/modifier_labels.php';
            }
            $labels = ob_get_clean();
            ob_start();
            include APP_VIEW_DIR . 'inc/chunk/modifier_form.php';
            return ob_get_clean();
        } else {
            $requiredFields = ['title', 'h1', 'body', 'label-type', 'label-text'];
            $undefined = count($requiredFields);
            foreach (array_keys($_POST) as $key) {
                if (in_array($key, $requiredFields)) {
                    $undefined--;
                }
            }
            $page = $_POST;
            $page['id'] = $_GET['id'];
            $page['slug'] = strtolower($_POST['title']);

            $this->repository->update($page);

            $message['type'] = 'success';
            $message['text'] = 'Page modifiée';

            ob_start();
            include APP_VIEW_DIR . 'inc/chunk/form_message.php';
            return ob_get_clean();
        }
        
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

    public function makeNavbar($admin = false)
    {
        $view = array(
            'default' => APP_VIEW_DIR . 'inc/chunk/nav_item.php',
            'admin' => APP_VIEW_DIR . 'inc/chunk/nav_admin.php'
        );
        ob_start();
        if ($admin) {
            $pages = array(
                ['action' => 'lister', 'title' => 'Lister'],
                ['action' => 'ajouter', 'title' => 'Ajouter']
            );

            foreach ($pages as $item => $page) {
                $class = $page['action'] === $this->action ? ' active ' : '';
                include $view['admin'];
            }

        } else {
            foreach ($this->repository->selectAll() as $page) {
                $class = $page->slug === $this->slug ? ' active ' : '';
                include $view['default'];
            }
        }

        return ob_get_clean();
    }

    public function displayAction()
    {
        $this->slug = APP_DEFAULT_ROUTE;
        $this->nav = $this->makeNavbar();

        if (isset($_GET['p'])) {
            $this->slug = $_GET['p'];
        }

        $content = $this->repository->selectOneBySlug($this->slug);
        $content->body = htmlspecialchars_decode($content->body);

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
        $this->action = APP_DEFAULT_ACTION;
        $this->nav = $this->makeNavbar(true);

        if (isset($_GET['a'])) {
            $this->action = $_GET['a'];
        }

        ob_start();
        switch ($this->action) {
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
                include APP_VIEW_DIR . 'inc/ajouter.php';
                break;
            case 'modifier':
                $content = $this->modifierAction();
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
