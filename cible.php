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
            overflow-y: scroll;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, rgb(95, 104, 113), rgb(0, 88, 204));
            text-align: center;
            flex-direction: column;
            overflow-y: scroll;
        }

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

        .back-btn, .action-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #0044CC;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .back-btn:hover, .action-btn:hover {
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
                "Mot de passe" => ($_POST['password']),
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

        // Vérifier si le dossier de destination existe, sinon le créer
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Afficher le contenu de l'image uploadée
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imagePath = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            echo "<h2>Image téléchargée :</h2>";
            echo "<img src='$imagePath' alt='Image téléchargée' style='max-width: 100%; height: auto;'>";
        } else {
            echo "<p>Aucune image téléchargée.</p>";
        }

        // Nom du fichier CSV où stocker les données
        $file = 'donnees.csv';

        // Ouvrir le fichier en mode "ajout"
        $handle = fopen($file, 'a');

        // Si le fichier est vide, ajouter l'en-tête
        if (filesize($file) == 0) {
            fputcsv($handle, array_keys($data));
        }

        // Ajouter le chemin de l'image au tableau de données
        $data['Image'] = isset($imagePath) ? $imagePath : 'Aucune image';

        // Écrire les données dans le fichier CSV
        fputcsv($handle, array_values($data));

        // Fermer le fichier
        fclose($handle);

        /*// Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = ""; // Laissez vide si vous utilisez XAMPP sans mot de passe
        $dbname = "myDB";
        $port = 3306;
        // Créer une nouvelle connexion PDO

        try {
            $conn = new PDO("mysql:host=$servername;port=$port;dbname=myDB;", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");
            echo "Base de données créée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la création de la base de données : " . $e->getMessage();
        }

        try {
            $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie à la base de données.";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        try {
            $conn = new PDO("mysql:host=$servername;port=$port ;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Création de la table si elle n'existe pas
            $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(50),
                password VARCHAR(50),
                phone VARCHAR(15),
                image VARCHAR(255)
            )";
            $conn->exec($sql);

            // Insertion des données
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, image) VALUES (:name, :email, :password, :phone, :image)");
            $stmt->bindParam(':name', $data['Nom']);
            $stmt->bindParam(':email', $data['Email']);
            $stmt->bindParam(':password', $data['Mot de passe']);
            $stmt->bindParam(':phone', $data['Téléphone']);
            $stmt->bindParam(':image', $data['Image']);
            $stmt->execute();

            echo "<h2>Enregistrement dans la base de données réussi.</h2>";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        // Fermer la connexion
        $conn = null;

        // Accorder tous les privilèges sur la base de données à l'utilisateur root
        try {
            $conn = new PDO("mysql:host=$servername;port=$port", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("GRANT ALL PRIVILEGES ON myDB.* TO 'root'@'localhost'");
            $conn->exec("FLUSH PRIVILEGES");
            echo "Privilèges accordés avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'octroi des privilèges : " . $e->getMessage();
        }*/
        ?>

        <h2>Enregistrement dans le fichier CSV</h2>
        <p>Les données ont été enregistrées avec succès dans le fichier CSV.</p>

        <!-- Boutons pour ajouter ou supprimer un utilisateur -->
        
        <form method="post" action="index.php">
            <button type="submit" class="action-btn">Ajouter un utilisateur</button>
        </form>
        <form method="post" action="delete_user.php">
            <button type="submit" class="action-btn">Supprimer un utilisateur</button>
        </form>

        <a href="index.php" class="back-btn">Retour</a>
    </div>

</body>
</html>
