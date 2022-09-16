<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap.min.css">
    <link rel="stylesheet" href="connect.css">
    <title>Connexion</title>
</head>
<body>
    <div class="container-fluid">
        <div class="container fIns">
            <h1>Connexion</h1>
            <hr>                <!--Pseudo: Nancy et mdp:Azerty aussi Emmanuel avec mdp Emmanuel-->
            <form method="POST" action="traitement_Connexion.php">
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo">
                </div>
                <div class="form-group">
                    <label for="pass">Mot de passe :</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="checkbox">
                    <label style="letter-spacing: 1px;"><input type="checkbox" name="connectAuto"> Connexion automatique</label>
                </div>
                <button type="submit" name="submit" class="btn btn-default">Se connecter</button>
            </form>
            <a href="../inscription/inscription.php" class="lienIns">S'inscrire</a>
        </div>
    </div>
</body>
</html>