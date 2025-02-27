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
<body>
<div class="container mt-5">
    <h1 class="text-center">Créer une Recette en Live</h1>

    <form action="index.php?page=creerrecettelive" method="POST">
        <div class="mb-3">
            <label class="form-label">Titre de la recette</label>
            <input type="text" class="form-control" name="titreRecette" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Difficulté</label>
            <select class="form-select" name="difficulte">
                <option value="1">Facile</option>
                <option value="2">Moyen</option>
                <option value="3">Difficile</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Heure de Début (nombre entier)</label>
            <input type="number" class="form-control" name="heureDebut" min="1" step="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Durée (minutes)</label>
            <input type="number" class="form-control" name="duree" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lien YouTube</label>
            <input type="url" class="form-control" name="lienYoutube" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Publier la Recette</button>
    </form>
</div>
</body>
</html>
