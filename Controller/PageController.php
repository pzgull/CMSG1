<?php
namespace Controller;

use \Model\PageRepository;

class PageController
{
    private $page;

    public function __construct(\PDO $pdo)
    {
        $this->page = new PageRepository($pdo);
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
        // TODO: Implement displayAction
    }

}