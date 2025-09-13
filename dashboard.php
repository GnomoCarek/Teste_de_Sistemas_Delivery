<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    header('Location: login.php');
    exit;
}

$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos específicos para o dashboard */
        .nav-card {
            background-color: #f8f9fa;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            color: var(--bg);
        }
        .nav-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(2,6,23,.1);
        }
        .nav-card h3 {
            margin: 0 0 10px 0;
        }
        .nav-card p {
            font-size: 14px;
            color: var(--muted);
        }
    </style>
</head>
<body>
    <header>
        <h1>Delivery System</h1>
        <nav class="menu">
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <main>
        <section class="card">
            <h2>Bem-vindo, <?php echo htmlspecialchars($user_name); ?>!</h2>
            <p>O que você gostaria de fazer?</p>
            <div class="grid-2-col" style="margin-top: 20px;">
                <a href="produtos.php" class="nav-card">
                    <h3>Ver Produtos</h3>
                    <p>Navegue pelo catálogo de produtos disponíveis.</p>
                </a>
                <a href="cadastro_de_produto.php" class="nav-card">
                    <h3>Cadastrar Produto</h3>
                    <p>Adicione um novo item ao sistema de delivery.</p>
                </a>
            </div>
        </section>
    </main>
</body>
</html>