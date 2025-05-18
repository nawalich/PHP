<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un utilisateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, rgb(95, 104, 113), rgb(0, 88, 204));
        }

        .form-container {
            background: rgba(240, 208, 208, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 400px;
            text-align: center;
            color: white;
        }

        .form-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 40px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .input-group input:focus {
            outline: 2px solid #fff;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: gray;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #0044CC;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #003399;
        }

        .back-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .back-link a {
            color: white;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Supprimer un utilisateur</h1>
        <form method="post" action="">
            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" id="user_name" name="user_name" placeholder="Nom de l'utilisateur" required>
            </div>
            <button type="submit">Supprimer</button>
        </form>
        <div class="back-link">
            <a href="cible.php">Retour</a>
        </div>

        <?php
        # supprimer d'apre le fichier csv

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userName = $_POST['user_name'];

            // Lire le contenu du fichier CSV
            $file = 'donnees.csv';
            $lines = file($file);
            $updatedLines = [];

            foreach ($lines as $line) {
                $data = str_getcsv($line);
                if ($data[0] !== $userName) {
                    $updatedLines[] = $line;
                }
            }

            // Écrire les lignes mises à jour dans le fichier CSV
            file_put_contents($file, implode("", $updatedLines));
            echo "<p style='color: lightgreen;'>Utilisateur supprimé avec succès.</p>";
        }
        ?>
    </div>

</body>
</html>