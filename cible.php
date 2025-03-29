<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Données reçues</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(0, 0, 0);
            text-align: center;
            padding: 20px;
        }
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        td {
            background-color: #fff;
        }
        .back-btn {
            display: inline-block; 
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

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

</body>
</html>
