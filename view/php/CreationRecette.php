<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/recette.css">
    <link rel="stylesheet" href="view/css/NavBar.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">
    <h1 class="text-center">Créer votre recette en quelques clics !</h1>
    <p class="text-center">Remplissez les informations ci-dessous pour partager votre recette !</p>

    <form action="index.php?page=creerrecette" method="POST" enctype="multipart/form-data">
    <div class="row mt-4">
            <!-- Colonne Gauche -->
            <div class="col-md-6">
                <h3>Informations de la recette</h3>

                <div class="mb-3">
                    <label class="form-label">Titre de la recette</label>
                    <input type="text" class="form-control" name="titreRecette" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Calories</label>
                    <input type="number" class="form-control" name="caloriesRecette" required>
                </div>

                <h4>Ingrédients</h4>
                <div class="mb-3 d-flex">
                    <select class="form-select me-2" name="ingredient[]" id="ingredient" required>
                        <option value="">Choisir un ingrédient</option>
                        <?php
                        // Affichage dynamique des ingrédients depuis la base de données
                        foreach ($ingredients as $ingredient) {
                            echo "<option value='" . $ingredient['id'] . "'>" . $ingredient['nom'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="number" class="form-control me-2" name="quantite[]" placeholder="Quantité" required>
                    <select class="form-select me-2" name="typeIngredient[]" id="typeIngredient" required>
                        <option value="">Unité</option>
                        <?php
                        // Affichage dynamique des unités depuis la base de données
                        foreach ($unites as $unite) {
                            echo "<option value='" . $unite['id'] . "'>" . $unite['type'] . "</option>";
                        }
                        ?>
                    </select>
                    <button class="btn btn-success" type="button" onclick="ajouterIngredient()">+</button>
                </div>
                <ul class="list-group" id="listeIngredients"></ul>

                <h4 class="mt-3">Difficulté</h4>
                <select class="form-select" name="difficulte">
                    <option value="1">Facile</option>
                    <option value="2">Moyen</option>
                    <option value="3">Difficile</option>

                </select>
            </div>

            <!-- Colonne Droite -->
            <div class="col-md-6">
                <h3>Préparation</h3>

                <div class="mb-3">
                    <label class="form-label">Nombre de personnes</label>
                    <input type="number" class="form-control" name="nbPersonnes" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Durée (minutes)</label>
                    <input type="number" class="form-control" name="duree">
                </div>

                <div class="mb-3">
                    <label class="form-label">Photo du plat</label>
                    <input type="file" class="form-control" name="photoRecette" required>
                </div>

                <h4>Étapes de la recette</h4>
                <button class="btn btn-primary mb-2" type="button" onclick="ajouterEtape()">Ajouter une Étape</button>
                <ul class="list-group" id="listeEtapes"></ul>

                <!-- Champ caché pour envoyer les étapes avec le formulaire -->
                <input type="hidden" name="etapes" id="etapes" value="">
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="row mt-4">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success w-100">Poster votre recette</button>
            </div>
            <div class="col-md-6">
                <button type="reset" class="btn btn-danger w-100">Annuler</button>
            </div>
        </div>
    </form>
</div>

<!-- Modale pour ajouter/modifier une étape -->
<div class="modal fade" id="etapeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter / Modifier une Étape</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label">Étape</label>
                <textarea class="form-control" id="etapeInput" rows="3"></textarea>

                <label class="form-label mt-3">Tip</label>
                <textarea class="form-control" id="tipInput" rows="2"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="sauvegarderEtape()">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>

<script>
    let ingredients = [];
    let etapes = [];
    let currentEtapeIndex = null;

    function ajouterIngredient() {
        let ingredientId = document.getElementById("ingredient").value;
        let quantite = document.getElementById("quantite").value;
        let uniteId = document.getElementById("typeIngredient").value;

        if (ingredientId && quantite && uniteId) {
            ingredients.push({ ingredientId, quantite, uniteId });
            afficherIngredients();
        }
    }

    function afficherIngredients() {
        let liste = document.getElementById("listeIngredients");
        liste.innerHTML = "";
        ingredients.forEach((ing, index) => {
            liste.innerHTML += `<li class="list-group-item d-flex justify-content-between">
                ${ing.ingredientId} - ${ing.quantite} ${ing.uniteId}
                <button class="btn btn-danger btn-sm" onclick="supprimerIngredient(${index})">Supprimer</button>
            </li>`;
        });
    }

    function supprimerIngredient(index) {
        ingredients.splice(index, 1);
        afficherIngredients();
    }

    function ajouterEtape() {
        currentEtapeIndex = etapes.length;
        document.getElementById("etapeInput").value = "";
        document.getElementById("tipInput").value = "";
        let modal = new bootstrap.Modal(document.getElementById("etapeModal"));
        modal.show();
    }

    function sauvegarderEtape() {
        let etape = document.getElementById("etapeInput").value;
        let tip = document.getElementById("tipInput").value;

        if (etape) {
            if (currentEtapeIndex === null) {
                etapes.push({ etape, tip });
            } else {
                etapes[currentEtapeIndex] = { etape, tip };
            }
            afficherEtapes();
            let modal = bootstrap.Modal.getInstance(document.getElementById("etapeModal"));
            modal.hide();
        }
    }

    function afficherEtapes() {
        let liste = document.getElementById("listeEtapes");
        liste.innerHTML = "";
        etapes.forEach((etape, index) => {
            liste.innerHTML += `<li class="list-group-item">
                ${etape.etape} - ${etape.tip}
                <button class="btn btn-danger btn-sm" onclick="supprimerEtape(${index})">Supprimer</button>
            </li>`;
        });
        document.getElementById("etapes").value = JSON.stringify(etapes);
    }

    function supprimerEtape(index) {
        etapes.splice(index, 1);
        afficherEtapes();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
