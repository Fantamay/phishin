<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FranceConnect / FranceConnect+</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f7f7fb; margin-left: 60px; }
        .header { display: flex; align-items: center; padding: 20px 40px 10px 40px; background: #fff; height: 120px; }
        .header img { height: 100px; margin-right: 80px; }
        .header .logo-fc { height: 100px; margin-left: 60px; }
        .navbar {height: 60px; margin-top: 0px; background: #fff; padding: 0 40px; border-bottom: 1px solid #eee; }
        .navbar ul { list-style: none; margin-top: 0.5cm; padding: 0; display: flex; }
        .navbar li { margin: 0 25px 0 0; }
        .navbar a {text-decoration: none; color: #222; font-weight: 500; font-size: 1.1em; padding-bottom: 4px; }
        .navbar a.active { color: #2a3cff; border-bottom: 2px solid #2a3cff; }
        .main { padding: 40px; display: flex; align-items: center; }
        .main-content { flex: 2; margin-left: 50px; }
        .main-img { flex: 1; text-align: right; margin-right: 150px;width:400px; }
        .main-img img { max-width: 250px; }
        h1 { font-size: 2.4em; margin-bottom: 10px; }
        .section { background: #fff; margin: 20px 40px; padding: 30px; border-radius: 10px; margin-left: 60px; }
        h2 { font-size: 2.3em; margin-top: 0; }
        .lead { font-size: 1.4em; color: #3a3a3a;margin: 0px 0px 24px; font: arial, sans-serif; }
        .navbar-link { margin-left: auto; text-decoration: none; color: #4617ff; font-weight: 500; font-size: 1.1em; padding-bottom: 4px; }
        .blue-line {
    border-left: 4px solid #2a3cff; /* couleur bleue */
    padding-left: 16px;             /* espace entre la ligne et le texte */
    margin: 34px 0 100px 40px;                 /* espace autour du paragraphe */
    font-size: 1.2em;     
            /* optionnel, pour le style */
}  
.btn.btn-primary {
    display: block;
    width: fit-content;
    margin-left: auto;
    margin-right: 0;
    text-decoration: none;
    color: #4617ff;
    font-weight: 500;
    font-size: 1.1em;
    padding-bottom: 4px;
}
.btn-primar{
    display: block;
    width: fit-content;
    margin-left: auto;
    margin-right: 0;
    text-decoration: none;
    background-color: #000091;
    color: #fff;
    font-weight: 500;
    font-size: 1.1em;
    padding-bottom: 4px;
}

.news-box {
       background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    padding: 32px 36px 32px 36px;
    margin: 40px 60px;
    color: #222;
    font-size: 1.15em;
    max-width: 1900px;
    max-height: 1300px;
}
.news-box h2 {
    margin-top: 0;
    font-size: 2em;
    font-weight: bold;
}
.news-date {
    color: #888;
    font-size: 1em;
    margin-bottom: 18px;
}
.news-box ul {
    margin: 18px 0 18px 30px;
}
.news-box a {
    color: #222;
    text-decoration: underline;
}
.img-fluid {
    display: block;
    margin: 40px auto;
    width: 65%;
    height: auto;
}
.hr{ margin-left: 60px; }
.first{
    font-size: 1.6em;
}
    </style>
</head>
<body>
    <div class="header">
        <img class="logo-fc" src="image.png" alt="République Française">
        <h2 class="first">FranceConnect / FranceConnect+</h2>
        <a  class="navbar-link" href="">Aide</a>
    </div>
    <hr>
    <nav class="navbar">
        <ul>
            <li><a href="#" class="active">Accueil</a></li>
            <li><a href="#">FranceConnect+</a></li>
            <li><a href="#">Comptes disponibles</a></li>
            <li><a href="#">Services accessibles</a></li>
            <li><a href="#">Actualités</a></li>
            <li><a href="#">Aide</a></li>
            <button class="btn-primar" onclick="window.location.href='login.php'">se connecter</button>
        </ul>
    </nav>
    <div class="main">
        <div class="main-content">
            <h1>Bienvenue sur le site d’information</h1>
            <h1> de FranceConnect</h1>
            <p class="lead">Vous trouverez sur ce site l’ensemble des informations sur le 
                fonctionnement et l’utilisation de FranceConnect</p>
        </div>
        <div class="main-img">
            <img src="image copy.png" alt="Illustration">
        </div>
    </div>
    <div class="section">
        <h2>Qu'est ce que FranceConnect ?</h2>
        <p class="lead">
            FranceConnect est la solution de l’État pour faciliter la connexion à vos services et démarches en ligne.
            Il permet d’accéder à plus de 1400 services en utilisant un compte et un mot de passe que vous possédez déjà.
            Au choix : le compte impots.gouv.fr, ameli.fr, L’Identité Numérique La Poste, MSA, YRIS, France Identité et TrustMe.
        </p>
    </div>
    <div class="section">
        <h2>Comment utiliser FranceConnect ?</h2>
        <img src="imag.png" alt="">
    </div>
     <div class="section">
        <h2>Comment fonctionne FranceConnect ?</h2>
        <p class="lead">
            FranceConnect est un service de l’État qui confirme l’identité et l’authentification d’une personne lorsqu’elle souhaite accéder à un service en ligne. Il fait intervenir trois acteurs : le service en ligne (par exemple une administration), un fournisseur d’identité (comme Impots.gouv, Ameli ou l’Identité Numérique La Poste) et le RNIPP, le Répertoire National d’Identification des Personnes Physiques. Le RNIPP est la base officielle gérée par l'INSEE qui recense toutes les personnes ayant un lien avec la France : les Français (nés en France ou à l’étranger), les personnes nées en France et celles qui résident ou ont résidé en France. Cette base contient des informations comme le nom, le prénom, la date et le lieu de naissance, et permet de vérifier que la personne existe bien dans les registres d’état civil et que ses données sont correctes.

        </p>
 
    

        <p class="lead">
           Lorsqu’un service en ligne demande à FranceConnect de vérifier l’identité d’un utilisateur, FranceConnect redirige la personne vers un fournisseur d’identité, qui vérifie l’identité de l’utilisateur et l’authentifie, puis transmet à FranceConnect les informations nécessaires pour confirmer son identité, comme son nom, prénom, date et lieu de naissance.
        </p>
        <p class="lead">
            FranceConnect compare ensuite ces informations avec celles du RNIPP pour s’assurer de leur exactitude et de l’existence officielle de la personne. Une fois l’identité validée, FranceConnect transmet au service en ligne les informations nécessaires pour permettre l’accès au service.

        </p>
        <p class="lead">

        FranceConnect ne conserve pas les données personnelles : il se contente de vérifier et sécuriser l’identité des utilisateurs avant qu’ils accèdent aux services en ligne.

        </p>

        <p class="blue-line">
    Grâce à FranceConnect, lorsqu’une personne utilise un service en ligne, on peut <strong>connaître son identité, l'authentifier</strong> et vérifier qu’elle est <strong>correctement enregistrée à l’état civil</strong>, tout en <strong>protégeant sa vie privée et ses données personnelles.</strong>
</p>
   <h2>Les actualités</h2>

   <div class="news-box">
    <div class="news-date">10 février 2026</div>
    <h2>Élections municipales : FranceConnect accompagne les usagers dans leurs démarches de procuration</h2>
    <p>
        À l’occasion des prochaines élections municipales, FranceConnect accompagne les électeurs dans leurs démarches de procuration, afin de faciliter l’exercice du droit de vote lorsque le déplacement au bureau de vote n’est pas possible. Ce service s’adresse aux électeurs qui savent qu’ils ne pourront pas être présents le jour du scrutin et souhaitent donner procuration à un autre électeur inscrit sur une liste électorale française.
    </p>
    <p>
        Grâce à FranceConnect, les usagers peuvent s’identifier de manière simple et sécurisée pour accéder au service de demande de procuration en ligne. Selon leur situation, deux parcours sont possibles :
    </p>
    <ul>
        <li>les électeurs peuvent préparer leur demande de procuration en ligne, puis la faire valider en se rendant auprès d’une autorité habilitée (commissariat, gendarmerie ou consulat) ;</li>
        <li>les usagers disposant d’une identité numérique France Identité certifiée en mairie peuvent réaliser l’intégralité de leur demande de procuration totalement en ligne, sans déplacement complémentaire.</li>
    </ul>
    <p>
        En facilitant l’accès à ces démarches, FranceConnect contribue à simplifier les formalités électorales, tout en garantissant un haut niveau de sécurité pour l’identité numérique des citoyens.
    </p>
    <p>👉 Accéder au service de demande de procuration : <a href="#">Maprocuration</a></p>
    <p>👉 Découvrez comment certifier votre identité en mairie avec France Identité : <a href="#">L’identité numérique certifiée France Identité</a></p>
</div>

<div class="news-box">
    <div class="news-date">01 décembre 2025</div>
    <h2>FranceConnect : une nouvelle plateforme pour un service plus performant</h2>
    <p>
        FranceConnect a récemment migré vers une nouvelle plateforme technique pour améliorer la sécurité, la disponibilité et la fiabilité du service. Chaque service en ligne utilisant FranceConnect doit également effectuer une mise à jour technique pour rejoindre cette nouvelle infrastructure.
    </p>
    <p>
        À ce jour, 99,8 % des usages de FranceConnect passent déjà par cette nouvelle plateforme, garantissant une expérience pleinement opérationnelle pour la grande majorité des usagers. Certains services n’ont pas encore finalisé leur migration. Si vous utilisez l’un de ces services, l’accès via FranceConnect pourrait être interrompu dans les prochaines semaines.
    </p>
    <p>
        Un bandeau d’information s’affichera sur la page de sélection du compte pour vous alerter. <strong>Si vous voyez ce bandeau, contactez directement le service concerné</strong> pour connaître les solutions alternatives ou la date de mise à jour prévue. Si aucun bandeau n’apparaît, le service est déjà compatible avec la nouvelle plateforme et vous pouvez poursuivre votre démarche sereinement.
    </p>
    <p>
        FranceConnect accompagne activement les derniers services concernés pour qu’ils rejoignent la nouvelle plateforme dans les meilleurs délais.
    </p>
</div>
<a class="btn btn-primary" href="#">consulter toutes les actualités</a>

<img class="img-fluid" src="imageee.png" alt="">

<a class="btn btn-primary" href="#">Retour en haut de page</a>
    </div>

 
</body>
<footer>
    <img src="image-1773715992975.png" alt="">
</footer>
</html>
