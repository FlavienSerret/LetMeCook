<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /views/login.php");
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
<h1>Bienvenue, <?php echo htmlspecialchars($user['prenom']); ?>!</h1>
<p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($user['nom']); ?></p>
<a href="/logout.php">Se déconnecter</a>
</body>
</html>
