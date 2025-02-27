<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<nav class="navbar">
    <!-- Le texte "LetMeCook" devient un lien qui redirige vers l'index -->

        <a href="index.php" class="site-name">
            LetMeCook
        </a>
    <div class="search-container">
        <input type="text" placeholder="Rechercher la recette qui vous donne envie !">
    </div>
    <div class="buttons">
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Si l'utilisateur est connecté, afficher le lien vers la page des favoris -->
            <a href="index.php?page=favoris" class="favorite-btn btn btn-warning">Voir mes favoris</a>
        <?php else: ?>
            <!-- Si l'utilisateur n'est pas connecté, afficher un message ou rediriger -->
            <a href="view/php/login.php" class="favorite-btn">Connectez-vous pour voir vos favoris</a>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Si l'utilisateur est connecté, afficher son nom et prénom, avec un lien vers la gestion du compte -->
            <a href="index.php?page=gestioncompte" class="account-btn">
                <?php echo $_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom']; ?>
            </a>
        <?php else: ?>
            <!-- Si l'utilisateur n'est pas connecté, afficher le lien d'accès au compte -->
            <a href="view/php/login.php" class="account-btn">Accès au compte</a>
        <?php endif; ?>

    </div>
</nav>
<div class="content">
</div>
