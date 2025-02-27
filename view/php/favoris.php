<!-- favoris.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/recette.css">
    <link rel="stylesheet" href="view/css/NavBar.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h1 class="text-center title-favoris">Mes Recettes Favorites</h1>


    <!-- Vérification si des recettes existent -->
    <?php if (!empty($recettes)): ?>
        <div class="row">
        <!-- Affichage des recettes avec 3 cartes par ligne -->
        <?php foreach ($recettes as $index => $recette): ?>
            <!-- Affichage de 3 recettes par ligne -->
            <?php if ($index % 3 == 0 && $index != 0): ?>
                </div> <!-- Fermeture de la ligne précédente -->
                <div class="row"> <!-- Nouvelle ligne -->
            <?php endif; ?>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($recette['cheminPhoto']) ?>" class="card-img-top" alt="Image de la recette">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($recette['titre']) ?></h5>
                        <p class="card-text">
                            <strong>Pour :</strong> <?= htmlspecialchars($recette['nombreDePersonne']) ?> personnes<br>
                            <strong>Note :</strong> <?= htmlspecialchars($recette['noteMoyenne']) ?>/5<br>
                            <strong>Calories :</strong> <?= htmlspecialchars($recette['calories']) ?> kcal<br>
                        </p>
                        <a href="index.php?page=recette&id=<?= $recette['id'] ?>" class="btn btn-primary">Voir la recette</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucune recette favorite.</p>
    <?php endif; ?>
</div>

<footer class="text-center mt-5 p-3 bg-light">
    <p>&copy; 2025 Let Me Cook - Tous droits réservés.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
