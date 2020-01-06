<!doctype html>
<html>
<head>
    <title>CPMF - En attente de validation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="assets/css/inter.css">
    <style>
        :root {
            --background-color: rgba(32, 32, 32, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, sans-serif;
            color: rgba(255, 255, 255, 1);
        }

        body {
            background-color: var(--background-color);
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            align-content: center;
        }

        #logo {
            margin-top: 64px;
        }

        #logo img {
            margin: auto;
            transform: scale(.8);
        }

        #content {
            max-width: 900px;
            margin: 64px auto auto auto;
            text-align: center;
        }

        #waiting-clock {
            width: 200px;
            height: 200px;
            background-color: red;
            margin: auto;
        }
    </style>
</head>
<body>
    <header>
        <div id="logo">
            <img src="assets/img/logo-vertical-big.svg">
        </div>
    </header>
    <section id="content">
        <h2>En attente de validation</h2>
        <p>Votre compte est en attente de validation. Votre enseignant de français validera votre inscription sous peu.</p>
        <br>
        <a href="/signout">Se déconnecter</a>
    </section>
    <footer>
    </footer>
</body>
</html>