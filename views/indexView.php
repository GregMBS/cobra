<?php
$msg = 'COBRA';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>COBRA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS (local) -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ebd5b3;
            color: #222;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-container {
            max-width: 400px;
            margin: 3rem auto;
            background: #fffbe9;
            border-radius: 1rem;
            box-shadow: 0 0 16px #c0c0c0;
            padding: 2rem 2.5rem 1.5rem 2.5rem;
        }
        .form-label {
            font-weight: 500;
        }
        .brand {
            font-size: 2.5rem;
            font-weight: bold;
            letter-spacing: 0.1em;
            color: #795548;
        }
        .version {
            color: #888;
            font-size: 1rem;
        }
        .copyright {
            color: #888;
            font-size: 0.95rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="text-center mb-4">
                <span class="brand"><?php echo $msg; ?></span>
                <div class="version">versi&oacute;n configurado 2025</div>
            </div>
            <form action="/index.php" method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="capt" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" name="capt" id="capt" required
                        onchange="this.value = this.value.replace(/ /g, '');" autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Contrase&ntilde;a:</label>
                    <input type="password" class="form-control" name="pwd" id="pwd" required autocomplete="current-password">
                </div>
                <div class="d-grid">
                    <button type="submit" name="go" class="btn btn-primary" value="<?php echo time(); ?>">Empezar</button>
                </div>
            </form>
        </div>
        <div class="text-center copyright">
            <a href="/licencia.txt" class="text-decoration-none">
                <cite>&copy; GMBS Consulting 2025</cite>
            </a>
        </div>
    </div>
    <!-- Bootstrap 5 JS (local) -->
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>