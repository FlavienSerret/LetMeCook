<?php
require_once __DIR__ . '/../models/LiveModel.php';

class AffichageLiveController {
    public function afficherLive($idLive) {
        $liveModel = new LiveModel();
        $live = $liveModel->getLiveById($idLive);

        if (!$live) {
            header("Location: index.php?page=lives");
            exit();
        }

        require_once __DIR__ . '/../view/php/live.php';
    }



}
?>
<?php
