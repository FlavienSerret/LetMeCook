<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/NavBar.css">
    <link rel="stylesheet" href="view/css/recette.css">
    <link rel="stylesheet" href="view/css/gestioncompte.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<!-- Ajouter la classe "gestion-compte" pour appliquer le CSS spécifique -->
<div class="container mt-5 gestion-compte">
    <div class="row">
        <!-- Colonne gauche -->
        <div class="col-md-6">
            <h3 class="text-center title">Vos Créations de Recettes</h3>

            <?php if (!empty($recettes)): ?>
                <div class="recettes-list">
                    <ul>
                        <?php foreach ($recettes as $recette): ?>
                            <li>
                                <?= htmlspecialchars($recette['titre']) ?>
                                <a href="#" class="btn btn-warning btn-sm">Modifier</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <p>Vous n'êtes pas un chef ou vous n'avez pas encore créé de recette.</p>
            <?php endif; ?>
        </div>

        <!-- Colonne droite -->
        <div class="col-md-6">
            <h3 class="text-center section-title">Modifier le Mot de Passe</h3>
            <form action="#" method="POST" class="mdp-form">
                <div class="mb-3">
                    <label for="ancienMdp" class="form-label">Ancien mot de passe</label>
                    <input type="password" class="form-control" id="ancienMdp" name="ancienMdp">
                </div>
                <div class="mb-3">
                    <label for="nouveauMdp" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="nouveauMdp" name="nouveauMdp">
                </div>
                <div class="mb-3">
                    <label for="confirmationMdp" class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" class="form-control" id="confirmationMdp" name="confirmationMdp">
                </div>
                <button type="submit" class="btn btn-primary">Modifier le mot de passe</button>
            </form>
        </div>
    </div>

    <!-- Boutons en bas -->
    <div class="create-buttons">
        <a href="index.php?page=creerrecette" class="btn btn-success">Créer une recette</a>
        <a href="index.php?page=creerlive" class="btn btn-primary">Créer un live</a>
    </div>

</div>

<footer class="text-center mt-5 p-3 bg-light">
    <p>&copy; 2025 Let Me Cook - Tous droits réservés.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
