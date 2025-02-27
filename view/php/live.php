<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($live['titre']) ?> - Let Me Cook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/NavBar.css">
    <link rel="stylesheet" href="view/css/recette.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center"><?= htmlspecialchars($live['titre']) ?></h1>

    <div class="text-center">
        <strong>Animé par :</strong> <?= htmlspecialchars($live['nomChef'] ?? 'Chef Inconnu') ?> <br>
        <strong>Difficulté :</strong> <?= htmlspecialchars($live['idDifficulte']) ?> |
        <strong>Date :</strong> <?= htmlspecialchars($live['datePublication']) ?>
    </div>

    <HR>

    <div class="card mt-4">
        <div class="video-container text-center">
            <!-- Extraction de l'ID YouTube et affichage de la vidéo -->
            <?php
            preg_match('/[?&]v=([^&#]+)/', $live['lien'], $matches);
            $videoId = $matches[1] ?? '';
            ?>
            <?php if ($videoId): ?>
                <iframe class="live-video"
                        src="https://www.youtube.com/embed/<?= htmlspecialchars($videoId) ?>" allowfullscreen>
                </iframe>
            <?php else: ?>
                <p>Vidéo indisponible.</p>
            <?php endif; ?>
        </div>

        <HR>

        <div class="card-body">
            <table class="info-table">
                <tr>
                    <td><strong>Heure de début :</strong></td>
                    <td><?= htmlspecialchars($live['heureDebut']) ?> heures </td>
                </tr>
                <tr>
                    <td><strong>Durée :</strong></td>
                    <td><?= htmlspecialchars($live['duree']) ?> heure</td>
                </tr>
            </table>

            <!-- Affichage de la liste des ingrédients avec le type d'unité -->
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
                <?php if (!empty($live['ingredients'])): ?>
                    <?php foreach ($live['ingredients'] as $ingredient): ?>
                        <tr>
                            <td><?= htmlspecialchars($ingredient['ingredientNom']) ?></td>
                            <td><?= htmlspecialchars($ingredient['quantite']) ?></td>
                            <td><?= htmlspecialchars($ingredient['uniteType']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Aucun ingrédient disponible.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- Section de notation -->
    <div class="avis-section text-center mt-4">
        <h4>Donnez votre avis sur ce live :</h4>

        <form action="index.php" method="POST">
            <input type="hidden" name="idLive" value="<?= htmlspecialchars($live['id']) ?>"> <!-- ID du live -->
            <input type="hidden" name="idUser" value="56"> <!-- Remplacer par l'ID de l'utilisateur dynamique -->

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
</body>
</html>
