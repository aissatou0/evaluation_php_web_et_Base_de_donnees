<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles de Confection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestion des Articles de Confection</h1>
        
        <a href="index.php?action=create" class="btn btn-primary mb-3">
            <i class="fas fa-plus-circle"></i> Nouvel Article
        </a>

        <?php if (!empty($alertedArticles)): ?>
        <div class="alert alert-warning" role="alert">
            <strong><i class="fas fa-exclamation-triangle"></i> Articles en alerte de stock</strong>
            <ul>
                <?php foreach ($alertedArticles as $article): ?>
                    <li><?= htmlspecialchars($article['libelle']) ?> - Stock actuel : <?= htmlspecialchars($article['qte_stock']) ?> <?= htmlspecialchars($article['unite']) ?> (Seuil : <?= htmlspecialchars($article['seuil_alerte']) ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="index.php" method="GET" class="mb-4">
            <input type="hidden" name="action" value="index">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher par libellé ou référence..." name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Rechercher</button>
            </div>
        </form>
        
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Libellé</th>
                    <th>Catégorie</th>
                    <th>Stock</th>
                    <th>Seuil d'alerte</th>
                    <th>Prix unitaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>
                    <tr>
                        <td>
                            <strong><?= htmlspecialchars($article['libelle']) ?></strong><br>
                            <small class="text-muted"><?= htmlspecialchars($article['description'] ?? '') ?></small>
                        </td>
                        <td><?= htmlspecialchars($article['categorie']) ?></td>
                        <td><?= htmlspecialchars($article['qte_stock']) ?> <?= htmlspecialchars($article['unite']) ?></td>
                        <td><?= htmlspecialchars($article['seuil_alerte']) ?></td>
                        <td><?= number_format($article['prix_unitaire'], 2, ',', ' ') ?> fcfa</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <a href="#" class="btn btn-info btn-sm" title="Voir"><i class="fas fa-eye"></i></a>
                                <a href="index.php?action=edit&id=<?= $article['id'] ?>" class="btn btn-warning btn-sm" title="Modifier"><i class="fas fa-edit"></i></a>
                                <a href="index.php?action=delete&id=<?= $article['id'] ?>" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucun article trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html> 