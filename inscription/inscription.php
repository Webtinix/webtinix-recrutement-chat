<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap.min.css">
    <link rel="stylesheet" href="ins.css">
    <title>Inscription</title>
</head>
<body>
    <div class="container-fluid">
        <div class="container fIns">
            <h3>Inscription</h3>
            <hr>
            <form method="POST" action="traitement_Ins.php">
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo">
                </div>
                <div class="form-group">
                    <label for="pass">Mot de passe :</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="form-group">
                    <label for="pass_c">Comfirmer votre mot de passe :</label>
                    <input type="password" class="form-control" id="pass_c" name="pass_c">
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <button type="submit" name="submit" class="btn btn-default">Enregistrez</button>
            </form>
        </div>
    </div>
</body>
</html>