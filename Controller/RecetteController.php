<?php
require_once __DIR__ . '/../models/RecetteAcceuil.php';

$recetteModel = new RecetteAcceuil();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 12;
$offset = ($page - 1) * $limit;

$recettes = $recetteModel->getPaginated($limit, $offset);

// Retourner le HTML des nouvelles recettes
foreach ($recettes as $recette): ?>
    <div class="col-md-4">
        <div class="card mb-4">
            <img src="<?= htmlspecialchars($recette['cheminPhoto']) ?>" class="card-img-top" alt="Image de la recette">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($recette['titre']) ?></h5>
                <p class="card-text">
                    <strong>Pour :</strong> <?= htmlspecialchars($recette['nombreDePersonne']) ?> personnes<br>
                    <strong>Note :</strong> <?= htmlspecialchars($recette['note']) ?>/5<br>
                    <strong>Calories :</strong> <?= htmlspecialchars($recette['calories']) ?> kcal<br>
                    <strong>Prix :</strong> <?= htmlspecialchars($recette['prix']) ?> €
                </p>
                <a href="../controller/recetteController.php?id=<?= $recette['id'] ?>" class="btn btn-primary">Voir la recette</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
