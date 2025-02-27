<?php
require_once __DIR__ . '/../models/CreerRecetteLive.php';

class CreerRecetteLiveController {
    private $creerRecetteLive;

    public function __construct() {
        $this->creerRecetteLive = new CreerRecetteLive();
    }

    public function afficherFormulaire() {
        require_once __DIR__ . '/../view/php/CreationRecetteLive.php';
    }

    public function traiterFormulaire() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titreRecette'];
            $idDifficulte = $_POST['difficulte'];
            $heureDebut = intval($_POST['heureDebut']); // Assurer que c'est un entier
            $duree = $_POST['duree'];
            $lienYoutube = $_POST['lienYoutube'];

            $idRecette = $this->creerRecetteLive->ajouterRecetteLive($titre, $idDifficulte, $heureDebut, $duree, $lienYoutube);

            header('Location: index.php?page=recettelive&id=' . $idRecette);
        }
    }
}
?>
