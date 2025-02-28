<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion / inscription</title>
    <link rel="stylesheet" href="../css/LoginCss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="container">
    <!-- Formulaire de Connexion -->
    <div class="form-box login">
        <form action="../../Controller/loginController.php" method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="forgot-link" style="text-align: right; font-size: 0.8em; margin-top: 5px;">
                <a href="view/php/motdepasse" style="color: #777; text-decoration: none;">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="btn">Se connecter</button>
            <p>Connectez-vous avec vos plateformes</p>
            <div class="social-icons">
                <a href="#"><i class='bx bxl-google'></i></a>
                <a href="#"><i class='bx bxl-facebook'></i></a>
            </div>
            <?php if (isset($_GET['error'])): ?>
                <p style="color: red; font-size: 0.9em;">Email ou mot de passe incorrect.</p>
            <?php endif; ?>
        </form>
    </div>

    <!-- Formulaire d'Inscription -->
    <div class="form-box register">
        <form action="../../Controller/RegisterController.php" method="POST">
            <h1>Registration</h1>
            <div class="input-box">
                <input type="text" name="nom_prenom" placeholder="Nom Prénom " required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <select name="type" required>
                    <option value="" disabled selected>Choisir un rôle</option>
                    <option value="cuisinier">Cuisinier</option>
                    <option value="apprenti">Apprenti</option>
                </select>
                <i class='bx bxs-briefcase'></i>
            </div>
            <button type="submit" class="btn">S'inscrire</button>
            <p>Inscrivez-vous avec vos plateformes</p>
            <div class="social-icons">
                <a href="#"><i class='bx bxl-google'></i></a>
                <a href="#"><i class='bx bxl-facebook'></i></a>
            </div>
            <?php if (isset($_GET['error'])): ?>
                <p style="color: red; font-size: 0.9em;">Une erreur est survenue lors de l'inscription.</p>
            <?php endif; ?>
        </form>
    </div>

    <!-- Panneaux de bascule -->
    <div class="toggle-box">
        <div class="toggle-panel toggle-left">
            <h1>Bienvenue !</h1>
            <p>mail : admin@etu.estia.fr</p>
            <p>mdp : 123456789</p>
            <button class="btn register-btn">S'inscrire</button>
        </div>

        <div class="toggle-panel toggle-right">
            <h1>Bienvenue !</h1>
            <p>Vous avez déjà un compte ?</p>
            <button class="btn login-btn">Se connecter</button>
        </div>
    </div>
</div>

<script src="../js/login.js"></script>
</body>
</html>
