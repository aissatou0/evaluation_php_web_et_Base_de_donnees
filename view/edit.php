<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Article de Confection</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modifier un Article de Confection</h1>
        
        <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Retour à la liste</a>

        <?php if ($article): ?>
        <form action="index.php?action=edit&id=<?= $article['id'] ?>" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Libellé *</label>
                        <input type="text" id="libelle" name="libelle" class="form-control" value="<?= htmlspecialchars($article['libelle']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="categorie" class="form-label">Catégorie *</label>
                        <select id="categorie" name="categorie" class="form-select" required>
                            <option value="">Sélectionner une catégorie</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat['nom']) ?>" <?= ($cat['nom'] === $article['categorie']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="prix_unitaire" class="form-label">Prix unitaire (€) *</label>
                        <input type="number" step="0.01" id="prix_unitaire" name="prix_unitaire" class="form-control" value="<?= htmlspecialchars($article['prix_unitaire']) ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3"><?= htmlspecialchars($article['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="qte_stock" class="form-label">Quantité en stock</label>
                        <input type="number" id="qte_stock" name="qte_stock" class="form-control" value="<?= htmlspecialchars($article['qte_stock']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="seuil_alerte" class="form-label">Seuil d'alerte</label>
                        <input type="number" id="seuil_alerte" name="seuil_alerte" class="form-control" value="<?= htmlspecialchars($article['seuil_alerte'] ?? '0') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="unite" class="form-label">Unité</label>
                        <input type="text" id="unite" name="unite" class="form-control" value="<?= htmlspecialchars($article['unite'] ?? 'unité') ?>">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Article non trouvé.</div>
        <?php endif; ?>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html> 