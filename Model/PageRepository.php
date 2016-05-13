<?php
namespace Model;

class PageRepository
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($params)
    {
        $query = "INSERT INTO `page` (
        `title`,`h1`,`body`,`img`,
        `span_class`, `span_text`, `slug`)
        VALUES (
        ':title', ':h1', ':body', ':img',
        ':span_class', ':span_text', ':slug');";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam('title', $params['title']);
        $stmt->bindParam('h1', $params['h1']);
        $stmt->bindParam('body', $params['body']);
        $stmt->bindParam('img', $params['img']);
        $stmt->bindParam('span_class', $params['span_class']);
        $stmt->bindParam('span_text', $params['span_text']);
        $stmt->bindParam('slug', $params['slug']);

        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function selectOne($slug)
    {
        $query = "SELECT * FROM `page`
        WHERE `slug`= :slug;";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam('slug', $slug);

        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function selectAll()
    {
        $query = "SELECT * FROM `page`;";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $result = [];

        while ($row = $stmt->fetchObject()) {
            $result[] = $row;
        }

        return $result;
    }

    public function delete($slug)
    {
        $query = "DELETE FROM `page`
        WHERE `slug`= :slug;";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam('slug', $slug);

        $stmt->execute();

        return $stmt->fetchObject();
    }

}