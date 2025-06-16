<?php
require_once __DIR__ . '/../model/Article.php';

class ArticleController {
    private $articleModel;
    private $categories = ['tissus', 'merceries', 'fournitures'];

    public function __construct() {
        $this->articleModel = new Article();
    }

    public function index() {
        $searchTerm = $_GET['search'] ?? '';
        $articles = $this->articleModel->getAll($searchTerm);
        $alertedArticles = $this->articleModel->getAlertedArticles();
        require_once __DIR__ . '/../view/index.php';
    }

    public function create() {
        $categories = $this->categories;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'libelle' => $_POST['libelle'],
                'prix_unitaire' => $_POST['prix_unitaire'],
                'qte_stock' => $_POST['qte_stock'],
                'reference' => $_POST['reference'] ?? null,
                'categorie' => $_POST['categorie'],
                'description' => $_POST['description'] ?? null,
                'seuil_alerte' => $_POST['seuil_alerte'] ?? 0,
                'unite' => $_POST['unite'] ?? 'unité'
            ];
            
            if ($this->articleModel->create($data)) {
                header('Location: index.php?action=index');
                exit;
            }
        }
        require_once __DIR__ . '/../view/create.php';
    }

    public function edit($id) {
        $article = $this->articleModel->getById($id);
        $categories = $this->categories;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'libelle' => $_POST['libelle'],
                'prix_unitaire' => $_POST['prix_unitaire'],
                'qte_stock' => $_POST['qte_stock'],
                'reference' => $_POST['reference'] ?? null,
                'categorie' => $_POST['categorie'],
                'description' => $_POST['description'] ?? null,
                'seuil_alerte' => $_POST['seuil_alerte'] ?? 0,
                'unite' => $_POST['unite'] ?? 'unité'
            ];
            
            if ($this->articleModel->update($id, $data)) {
                header('Location: index.php?action=index');
                exit;
            }
        }
        require_once __DIR__ . '/../view/edit.php';
    }

    public function delete($id) {
        if ($this->articleModel->delete($id)) {
            header('Location: index.php?action=index');
            exit;
        }
    }
} 