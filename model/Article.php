<?php
require_once __DIR__ . '/../config/database.php';

class Article {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAll($searchTerm = '') {
        $sql = "SELECT * FROM articles";
        $params = [];

        if (!empty($searchTerm)) {
            $sql .= " WHERE libelle LIKE :searchTerm OR reference LIKE :searchTerm";
            $params[':searchTerm'] = '%' . $searchTerm . '%';
        }

        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO articles (libelle, prix_unitaire, qte_stock, reference, categorie, description, seuil_alerte, unite) 
                VALUES (:libelle, :prix_unitaire, :qte_stock, :reference, :categorie, :description, :seuil_alerte, :unite)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $sql = "UPDATE articles 
                SET libelle = :libelle, 
                    prix_unitaire = :prix_unitaire, 
                    qte_stock = :qte_stock, 
                    reference = :reference, 
                    categorie = :categorie, 
                    description = :description, 
                    seuil_alerte = :seuil_alerte, 
                    unite = :unite 
                WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAlertedArticles() {
        $stmt = $this->pdo->query("SELECT * FROM articles WHERE qte_stock <= seuil_alerte ORDER BY libelle ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 