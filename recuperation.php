<?php
session_start();
$username = $_SESSION['username'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur la planète Fun !</title>
    <style>
        body {
            background: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            font-family: 'Comic Sans MS', 'Arial', sans-serif;
            text-align: center;
            padding: 60px 20px;
        }
        .fun-box {
            background: #fffbe7;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            display: inline-block;
            padding: 40px 50px;
            margin-top: 30px;
            animation: pop 0.8s;
        }
        @keyframes pop {
            0% { transform: scale(0.7);}
            80% { transform: scale(1.05);}
            100% { transform: scale(1);}
        }
        .emoji {
            font-size: 3em;
            margin-bottom: 18px;
        }
        .rainbow {
            background: linear-gradient(90deg, #ff6a00, #ffb800, #43e97b, #38f9d7, #4353ff, #ff6a00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            font-size: 2em;
            margin-bottom: 18px;
        }
        .btn-fun {
            margin-top: 30px;
            background: #4353ff;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 14px 32px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(67,83,255,0.12);
            transition: background 0.2s;
        }
        .btn-fun:hover {
            background: #ff6a00;
        }
    </style>
</head>
<body>
    <div class="fun-box">
        <div class="emoji">🎉😎🚀</div>
        <div class="rainbow">yoohooo, <?= htmlspecialchars($username) ?: "explorateur anonyme" ?> !</div>
        <p>
            Désolé de t'annoncer que tu viens de te faire ARNAQUEEEE.<br>
            Ici, on ne récupère pas que des données, on retire aussi des sourires ! 😁<br><br>
            
        </p>
        <button class="btn-fun" onclick="window.location.href='login.php'">Retour à la fusée 🚀</button>
    </div>
</body>
</html>