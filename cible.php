<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Données reçues</title>
    <style>
        /* ---- Style global ---- */
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
            background: linear-gradient(to bottom,rgb(95, 104, 113),rgb(0, 88, 204));
            text-align: center;
            flex-direction: column;
        }

        /* ---- Container principal ---- */
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            width: 80%;
            max-width: 600px;
            color: white;
        }

        h1 {
            margin-bottom: 20px;
        }

        /* ---- Tableau stylisé ---- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: left;
        }

        th {
            background-color: rgba(0, 123, 255, 0.5);
            color: white;
        }

        td {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* ---- Bouton retour ---- */
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #0044CC;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: #003399;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Données reçues</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                "Nom" => $_POST['name'],
                "Email" => $_POST['email'],
                "Mot de passe" => str_repeat('*', strlen($_POST['password'])), // Masquer le mot de passe
                "Téléphone" => $_POST['phone'],
                "Genre" => $_POST['gender']
            ];

            echo "<table>";
            echo "<tr><th>Champ</th><th>Valeur</th></tr>";
            foreach ($data as $key => $value) {
                echo "<tr><td>$key</td><td>$value</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucune donnée reçue. Veuillez soumettre le formulaire.</p>";
        }

        // Nom du fichier CSV où stocker les données
        $file = 'donnees.csv';

        // Ouvrir le fichier en mode "ajout"
        $handle = fopen($file, 'a');

        // Si le fichier est vide, ajouter l'en-tête
        if (filesize($file) == 0) {
            fputcsv($handle, array_keys($data));
        }

        // Écrire les données
        fputcsv($handle, array_values($data));

        // Fermer le fichier
        fclose($handle);
        ?>

        <a href="index.php" class="back-btn">Retour</a>
    </div>

</body>
</html>
