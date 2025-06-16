<?php
require_once __DIR__ . '/controller/ArticleController.php';

$controller = new ArticleController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->edit($id);
        } else {
            header('Location: index.php');
        }
        break;
    case 'delete':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->delete($id);
        } else {
            header('Location: index.php');
        }
        break;
    default:
        header('Location: index.php');
        break;
} 