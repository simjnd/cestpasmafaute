<!doctype html>
<html>
<head>
    <title>CPMF - Mot de passe oublié</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="assets/css/inter.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Inter';
            box-sizing: border-box;
        }

        body {
            background-color: rgba(230, 230, 230, 1);
        }

        a {
            text-decoration: none;
        }

        #container {
            max-width: 300px;
            margin: auto;
            text-align: center;
        }

        header {
            margin-top: 32px;
        }

        label, input {
            display: block;
            margin: auto;
        }

        #reset-password-form {
            border-radius: 20px;
            margin: var(--margin-top-bottom);
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0px 4px 32px rgba(0, 0, 0, .1);
            padding: 20px;
            margin: 20px 0 20px 0;
        }

        label, input {
            display: block;
            margin: auto;
        }

        input[type=submit] {
            text-align: center;
            width: 100%;
            -webkit-appearance: none;
            border: none;
            display: block;
            margin: var(--margin-top-bottom);
        }

        .button {
            background-color: rgba(0, 0, 0, .1);
            color: rgba(0, 0, 0, .4);
            font-size: 1.25rem;
            font-weight: 600;
            padding: 12px;
            border-radius: 12px;
        }

        .button:hover {
            background-color: rgba(0, 0, 0, .2);
            color: rgba(0, 0, 0, .6);
            cursor: pointer;
        }

        .cancel {
            font-size: .75rem;
            font-weight: 600;
            color: rgba(0, 0, 0, .6);
            margin-top: 12px;
        }

        .error {
        	color: rgba(255, 0, 0, 1);
        	font-weight: 500;
        }
    </style>
</head>
<body>
    <div id="container">
        <header>
            <div id="logo">
                <img src="assets/img/logo-vertical-big-black.svg">
            </div>
        </header>
        <?php if (isset($error)) { ?>
			<p class="error">Erreur: <?= $error ?></p>
		<?php } ?>
        <section id="content">
            <div id="reset-password-form">
                <h1>Réinitialiser mon mot de passe</h1><br>
                <p>Saisissez l'adresse e-mail de votre compte pour obtenir un email de confirmation</p><br>
                <form id="reset-password-fields" action="/forgot-password" method="post">
                    <label for="email">E-mail</label>
                    <input type="email" name="email">
                </form>
            </div>
            <input type="submit" value="M'envoyer un e-mail" form="reset-password-fields" class="button"><br>
            <a href="#" class="cancel">Annuler</a>
        </section>
        <footer>
        </footer>
    </div>
</body>
</html>