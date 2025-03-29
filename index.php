<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
        }

        /* ---- Container du formulaire ---- */
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

        /* ---- Champs du formulaire ---- */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 12px 40px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .input-group input:focus, .input-group select:focus {
            outline: 2px solid #fff;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: gray;
        }

        /* ---- Bouton ---- */
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

        /* ---- Lien inscription ---- */
        .register-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: white;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Inscription</h1>
        <form action="cible.php" method="POST">
            
            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="name" placeholder="Nom" required>
            </div>

            <div class="input-group">
                <i class="fa fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="confirm_password" placeholder="Confirmez le mot de passe" required>
            </div>

            <div class="input-group">
                <i class="fa fa-phone"></i>
                <input type="tel" name="phone" placeholder="Téléphone" required>
            </div>

            <div class="input-group">
                <i class="fa fa-user"></i>
                <select name="gender" required>
                    <option value="">Sélectionnez votre genre</option>
                    <option value="male">Homme</option>
                    <option value="female">Femme</option>
                </select>
            </div>

            <button type="submit">S'inscrire</button>

        </form>
    </div>

</body>
</html>
