<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $sexo = $_POST['sexo'] ?? '';

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        $novo_usuario = [
            'id' => time(),
            'nome' => $nome,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT),
            'data_nascimento' => $data_nascimento,
            'sexo' => $sexo
        ];

        $arquivo_usuarios = 'usuarios.json';
        $usuarios = [];

        if (file_exists($arquivo_usuarios)) {
            $json_data = file_get_contents($arquivo_usuarios);
            $usuarios = json_decode($json_data, true);
        }

        $usuarios[] = $novo_usuario;

        if (file_put_contents($arquivo_usuarios, json_encode($usuarios, JSON_PRETTY_PRINT))) {
            $message = "Cadastro realizado com sucesso! <a href='login.php'>Faça o login</a>";
        } else {
            $message = "Erro ao salvar os dados. Tente novamente.";
        }
    } else {
        $message = "Por favor, preencha todos os campos obrigatórios (Nome, E-mail, Senha).";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <header>
        <h1>Delivery System</h1>
    </header>

    <main>
        <div class="form-container card">
            <h2>Cadastro</h2>
            <?php if (!empty($message)):
                // Adiciona uma classe de erro se a mensagem contiver a palavra "Erro"
                $message_class = (strpos($message, 'Erro') !== false || strpos($message, 'preencha') !== false) ? 'error' : 'message';
            ?>
                <p class="<?php echo $message_class; ?>"><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="cadastro.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento">
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" name="sexo">
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                        <option value="nao_informar">Prefiro não informar</option>
                    </select>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
            <div class="login-link">
                <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
            </div>
        </div>
    </main>
</body>
</html>