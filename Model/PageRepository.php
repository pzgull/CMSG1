<?php
namespace Model;

class PageRepository
{
    private $pdo;
    private $slug;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($params)
    {
        $query = "INSERT INTO `page` (
        `title`,`h1`,`body`,`img`,
        `span_class`, `span_text`, `slug`)
        VALUE (
        :title, :h1, :body, :img,
        :span_class, :span_text, :slug
        );";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam('title', $params['title']);
        $stmt->bindParam('h1', $params['h1']);
        $stmt->bindParam('body', $params['body']);
        $stmt->bindParam('img', $params['img']);
        $stmt->bindParam('span_class', $params['label-type']);
        $stmt->bindParam('span_text', $params['label-text']);
        $stmt->bindParam('slug', $params['slug']);

        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function selectOneById($id)
    {
        $query = "SELECT * FROM `page`
        WHERE `id`= :id;";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        
        return $stmt->fetchObject();
    }

    public function selectOneBySlug($slug)
    {
        $query = "SELECT * FROM `page`
        WHERE `slug`= :slug;";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':slug', $slug);

        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function selectAll()
    {
        $query = "SELECT `id`, `slug`, `title` FROM `page`;";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function delete($id)
    {
        $query = "DELETE FROM `page`
        WHERE `id`= :id;";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function update($params)
    {
        $query = "UPDATE `page`
        SET
        `slug` = :slug,
        `title` = :title,
        `h1` = :h1,
        `body` = :body,
        `span_class` = :span_class,
        `span_text` = :span_text
        WHERE `id` = :id;";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':slug', $params['slug']);
        $stmt->bindParam(':title', $params['title']);
        $stmt->bindParam(':h1', $params['h1']);
        $stmt->bindParam(':body', $params['body']);
        $stmt->bindParam(':span_class', $params['label-type']);
        $stmt->bindParam(':span_text', $params['label-text']);
        $stmt->bindParam(':id', $params['id']);
        
        $stmt->execute();
        
        return $stmt->fetchObject();
    }

}