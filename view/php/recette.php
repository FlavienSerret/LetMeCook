<?php require_once __DIR__ . '/../../Controller/affichageRecetteController.php';?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recette['titre']) ?> - Let Me Cook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/NavBar.css">
    <link rel="stylesheet" href="view/css/recette.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center"><?= htmlspecialchars($recette['titre']) ?></h1>

    <div class="text-center">
        <strong>Note :</strong> <?= htmlspecialchars($noteMoyenne) ?>/5 |
        <strong>Difficulté :</strong> <?= htmlspecialchars($recette['idDifficulte']) ?>
    </div>

    <div class="text-center mt-3">
        <button class="btn btn-warning">Ajouter aux favoris</button>
    </div>
    <HR>
    <div class="card mt-4">

        <div class="recette-img-container">
            <img src="<?= htmlspecialchars($recette['cheminPhoto']) ?>" class="recette-img" alt="Image de la recette">
        </div>
        <HR>
        <div class="card-body">
            <h5 class="card-title">Recette écrite par le chef : <?= htmlspecialchars($recette['nomChef'] ?? 'Chef Inconnu') ?></h5>

            <table class="info-table">
                <tr>
                    <td><strong>Calories :</strong></td>
                    <td><?= isset($recette['calories']) ? htmlspecialchars($recette['calories']) . ' kcal' : 'Non précisé' ?></td>
                </tr>
                <tr>
                    <td><strong>Publié le :</strong></td>
                    <td><?= isset($recette['datePublication']) ? htmlspecialchars($recette['datePublication']) : 'Non précisé' ?></td>
                </tr>
            </table>

            <table class="info-table">
                <tr>
                    <td><strong>Temps de préparation :</strong></td>
                    <td><?= isset($recette['tempsPrepa']) ? htmlspecialchars($recette['tempsPrepa']) . ' min' : 'Non précisé' ?></td>
                </tr>
            </table>
            <HR>
            <h4 class="mt-4">Ingrédients :</h4>
            <table id="ingredientsTable">
                <thead>
                <tr>
                    <th>Ingrédient</th>
                    <th>Quantité</th>
                    <th>Unité</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ingredients as $ingredient): ?>
                    <tr>
                        <td><?= htmlspecialchars($ingredient['nom']) ?></td>
                        <td id="quantite-<?= isset($ingredient['id']) ? $ingredient['id'] : 'undefined' ?>" data-quantite="<?= htmlspecialchars($ingredient['quantite']) ?>"><?= htmlspecialchars($ingredient['quantite']) ?></td>
                        <td><?= htmlspecialchars($ingredient['unite']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-4 text-center">
                <label for="personnes">Nombre de personnes :</label>
                <input type="number" id="personnes" value="<?= $nombreDePersonne ?>" min="1">
                <button id="updateIngr">Mettre à jour</button>
            </div>

            <HR>

            <h4 class="mt-4">Étapes de préparation :</h4>
            <ol class="list-group list-group-numbered">
                <?php foreach ($etapes as $etape): ?>
                    <li class="list-group-item">
                        <strong>Étape <?= isset($etape['numeroetape']) ? htmlspecialchars($etape['numeroetape']) : 'N/A' ?> :</strong>
                        <?= isset($etape['descriptionEtape']) ? htmlspecialchars($etape['descriptionEtape']) : 'Pas d\'étape disponible.' ?>

                        <?php if (!empty($etape['Tips'])): ?>
                            <br><em><strong>Conseil :</strong> <?= htmlspecialchars($etape['Tips']) ?></em>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>

        </div>
    </div>
    <HR>

    <div class="avis-section text-center mt-4">
        <h4>Donnez votre avis sur la recette :</h4>

        <form action="index.php" method="POST">
            <input type="hidden" name="idRecette" value="5"> <!-- Remplacer par l'id de la recette dynamique -->
            <input type="hidden" name="idUser" value="56">   <!-- Remplacer par l'id de l'utilisateur dynamique -->

            <div class="rating">
                <input type="radio" name="note" id="star5" value="5"><label for="star5">★</label>
                <input type="radio" name="note" id="star4" value="4"><label for="star4">★</label>
                <input type="radio" name="note" id="star3" value="3"><label for="star3">★</label>
                <input type="radio" name="note" id="star2" value="2"><label for="star2">★</label>
                <input type="radio" name="note" id="star1" value="1"><label for="star1">★</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Envoyer mon avis</button>
        </form>
    </div>


</div>

<footer class="text-center mt-5 p-3 bg-light">
    <p>&copy; 2025 Let Me Cook - Tous droits réservés.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Fonction pour mettre à jour les quantités des ingrédients
    document.getElementById('updateIngr').addEventListener('click', function() {
        let nombrePersonnes = parseInt(document.getElementById('personnes').value);
        if (nombrePersonnes < 1) return;

        document.querySelectorAll('#ingredientsTable tbody tr').forEach(function(row) {
            let quantiteCell = row.querySelector('td[id^="quantite-"]');
            let quantiteBase = parseFloat(quantiteCell.getAttribute('data-quantite'));

            if (!isNaN(quantiteBase)) {
                let quantiteModifiee = quantiteBase * nombrePersonnes / <?= $nombreDePersonne ?>;
                quantiteCell.textContent = quantiteModifiee.toFixed(2);
            }
        });
    });


</script>

</body>
</html>
