<?php
require_once __DIR__ . '/../models/CreerRecette.php';

class CreerRecetteController {
    private $creerRecette;

    public function __construct() {
        $this->creerRecette = new CreerRecette();
    }

    public function afficherFormulaire() {
        // Récupérer les ingrédients et les unités depuis la base de données
        $ingredients = $this->creerRecette->getAllIngredients();
        $unites = $this->creerRecette->getAllUnites();

        // Passer les ingrédients et unités à la vue
        require_once __DIR__ . '/../view/php/CreationRecette.php';
    }

    public function traiterFormulaire() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $idUser = 1; // Par exemple, l'ID de l'utilisateur connecté (à adapter)
            $titre = $_POST['titreRecette'];
            $nbPersonnes = $_POST['nbPersonnes'];
            $idDifficulte = $_POST['difficulte'];
            $calories = $_POST['caloriesRecette'];
            $photo = $_FILES['photoRecette'];

            // Traitement de l'image
            $photoPath = 'uploads/' . basename($photo['name']);
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }
            move_uploaded_file($photo['tmp_name'], $photoPath);

            // Ajouter la recette
            $idRecette = $this->creerRecette->ajouterRecette($idUser, $titre, $nbPersonnes, $idDifficulte, $calories, $photoPath);

            // Ajouter les ingrédients
            if (isset($_POST['ingredient'])) {
                $ingredients = $_POST['ingredient'];
                $quantites = $_POST['quantite'];
                $unites = $_POST['typeIngredient'];
                foreach ($ingredients as $index => $ingredientId) {
                    $this->creerRecette->ajouterIngredient($idRecette, $ingredientId, $quantites[$index], $unites[$index]);
                }
            }


            // Rediriger ou afficher un message de succès
            header('Location: index.php?action=recette&id=' . $idRecette);
        }
    }
}
?>
