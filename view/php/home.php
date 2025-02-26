<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let Me Cook - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/NavBar.css">
    <link rel="stylesheet" href="view/css/carousel.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h1 class="text-center">Des chefs cuisinier du monde entier vous proposent de cuisiner avec vous en direct !</h1>

    <!-- Section Lives -->
    <div class="container mt-4">
        <h2 class="text-center">Plus de 100 000 recettes à votre disposition pour trouver l'inspiration !</h2>
        <HR>

        <?php if (empty($lives)): ?>
            <p class="text-center">Aucun live disponible pour le moment.</p>
        <?php else: ?>
            <!-- Carrousel avec 3 lives par slide -->
            <div id="liveCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Diviser les lives en groupes de 3
                    $chunkedLives = array_chunk($lives, 3);
                    foreach ($chunkedLives as $index => $liveGroup):
                        ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="row">
                                <?php foreach ($liveGroup as $live): ?>
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <?php
                                            // Extraction de l'ID YouTube à partir du lien
                                            preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $live['lien'], $matches);
                                            $youtubeId = isset($matches[1]) ? $matches[1] : null;
                                            // URL de la miniature YouTube
                                            $thumbnailUrl = $youtubeId ? "https://img.youtube.com/vi/$youtubeId/0.jpg" : "https://via.placeholder.com/300x200.png?text=Miniature+Live";
                                            ?>
                                            <img src="<?= $thumbnailUrl ?>" class="card-img-top" alt="Image du live">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Live en direct</h5>
                                                <p class="card-text">
                                                    <strong>Heure de début :</strong> <?= htmlspecialchars($live['heureDebut']) ?><br>
                                                    <strong>Difficulté :</strong> <?= htmlspecialchars($live['idDifficulte']) ?><br>
                                                </p>
                                                <a href="index.php?page=live&id=<?= htmlspecialchars($live['id']) ?>" class="btn btn-primary">
                                                     Voir le détail du live
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Boutons de navigation du carrousel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#liveCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#liveCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        <?php endif; ?>
    </div>
<HR>
    <h2 class="text-center">Nous mettons à votre disposition ci-dessous une liste de nos meilleurs plats du jour</h2>
    <!-- Section Recettes -->
    <?php if (empty($recettes)): ?>
    <p class="text-center">Aucune recette disponible pour le moment.</p>
    <?php else: ?>
    <div class="row">
        <?php foreach ($recettes as $recette): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?= htmlspecialchars($recette['cheminPhoto']) ?>" class="card-img-top" alt="Image de la recette">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($recette['titre']) ?></h5>
                        <p class="card-text">
                            <strong>Pour :</strong> <?= htmlspecialchars($recette['nombreDePersonne']) ?> personnes<br>
                            <strong>Note :</strong> <?= htmlspecialchars($recette['noteMoyenne']) ?>/5<br>
                            <strong>Calories :</strong> <?= htmlspecialchars($recette['calories']) ?> kcal<br>
                            <strong>Prix :</strong> <?= htmlspecialchars($recette['prixTotal']) ?> €  <!-- Prix Total -->
                        </p>
                        <a href="index.php?page=recette&id=<?= $recette['id'] ?>" class="btn btn-primary">Voir la recette</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
        <div class="text-center mt-4">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>" class="btn btn-secondary">Page précédente</a>
            <?php endif; ?>

            <!-- Affichage des numéros de pages -->
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <?php if ($page == $currentPage): ?>
                    <span class="btn btn-primary"><?= $page ?></span> <!-- Page actuelle en surbrillance -->
                <?php else: ?>
                    <a href="?page=<?= $page ?>" class="btn btn-secondary"><?= $page ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>" class="btn btn-secondary">Page suivante</a>
            <?php endif; ?>
        </div>

    <?php endif; ?>
</div>

<footer class="text-center mt-5 p-3 bg-light">
    <p>&copy; 2025 Let Me Cook - Tous droits réservés.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
