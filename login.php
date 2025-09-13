<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (!empty($email) && !empty($senha)) {
        $arquivo_usuarios = 'usuarios.json';

        if (file_exists($arquivo_usuarios)) {
            $json_data = file_get_contents($arquivo_usuarios);
            $usuarios = json_decode($json_data, true);
            $login_sucesso = false;

            if (is_array($usuarios)) {
                foreach ($usuarios as $usuario) {
                    if (isset($usuario['email']) && $usuario['email'] === $email && isset($usuario['senha']) && password_verify($senha, $usuario['senha'])) {
                        $_SESSION['user_id'] = $usuario['id'];
                        $_SESSION['user_name'] = $usuario['nome'];
                        $login_sucesso = true;
                        break;
                    }
                }
            }

            if ($login_sucesso) {
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'E-mail ou senha inválidos.';
            }
        } else {
            $error = 'Nenhum usuário cadastrado. Por favor, <a href="cadastro.php">cadastre-se</a>.';
        }
    } else {
        $error = 'Por favor, preencha e-mail e senha.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <header>
        <h1>Delivery System</h1>
    </header>

    <main>
        <div class="form-container card">
            <h2>Login</h2>
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit">Entrar</button>
            </form>
            <div class="register-link">
                <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            </div>
        </div>
    </main>
</body>
</html>