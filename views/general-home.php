<!doctype html>
<html>
<head>
    <title>C'est pas ma faute</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="assets/css/inter.css">
    <style>
        :root {
            --margin-top-bottom: 20px 0 20px 0;
        }

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

        #logo {
            margin-top: 32px;
            min-height: 200px;
        }

        label, input {
            display: block;
            margin: auto;
        }

        #signin-form, #signup-form {
            border-radius: 20px;
            margin: var(--margin-top-bottom);
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0px 4px 32px rgba(0, 0, 0, .1);
            padding: 20px;
        }

        #show-signin, #show-signup {
            display: block;
            margin: var(--margin-top-bottom);
            width: 100%;
        }

        input[type=submit] {
            text-align: center;
            width: 100%;
            -webkit-appearance: none;
            border: none;
            display: block;
            margin: var(--margin-top-bottom);
        }

        #reset-password {
            font-size: .75rem;
            color: rgba(0, 0, 0, .6);
            font-weight: 600;
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
    </style>
</head>
<body>
    <div id="container">
        <header>
            <div id="logo">
                <img src="assets/img/logo-vertical-big.svg">
            </div>
        </header>
        <section id="content">
            <div id="signup" style="display:none;">
                <div id="signup-form">
                    <h1>Je n'ai pas de compte</h1>
                    <form id="signup-fields" action="/signup" method="post">
                        <label for="firstName">Prénom</label>
                        <input type="text" name="firstName">
                        <label for="lastName">Nom</label>
                        <input type="text" name="lastName">
                        <label for="email">E-mail</label>
                        <input type="text" name="email">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password">
                        <label for="password_again">Confirmer le mot de passe</label>
                        <input type="password" name="passwordConfirmation">
                    </form>
                </div>
                <input type="submit" value="S'inscrire" form="signup-fields" class="button">
                <p>ou</p>
                <a href="#" id="show-signin" class="button">Se connecter</a>
            </div>
            <div id="signin">
                <a href="#" id="show-signup" class="button">S'inscrire</a>
                <p>ou</p>
                <div id="signin-form">
                    <h1>J'ai un compte</h1>
                    <form id="signin-fields" action="/signin" method="post">
                        <label for="email">E-mail</label>
                        <input type="text" name="email">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password">
                    </form>
                </div>
                <input type="submit" value="Se connecter" form="signin-fields" class="button">
                <a href="/forgot-password " id="reset-password">Mot de passe oublié ?</a>
            </div>
        </section>
        <footer>
        </footer>
    </div>
    <script>
        var showSignIn = document.querySelector('#show-signin');
        showSignIn.addEventListener("click", function() {
            document.querySelector("#signup").style.display = "none";
            document.querySelector("#signin").style.display = "";
        });

        var showSignUp = document.querySelector('#show-signup');
        showSignUp.addEventListener("click", function() {
            document.querySelector("#signin").style.display = "none";
            document.querySelector("#signup").style.display = "";
        });
    </script>
</body>
</html>