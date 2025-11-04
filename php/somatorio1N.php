<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$numero = 0;
$erros = [];
$resultado = '';

// Inicializa variável a partir do POST
if (isset($_POST['numero'])) {
    $numero = trim($_POST['numero']);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação do número
    if ($numero === '') {
        $erros[] = "⚠️ Por favor, preencha o número.";
    } else {
        $numero_filtrado = filter_var($numero, FILTER_VALIDATE_INT);
        if ($numero_filtrado === false || $numero_filtrado <= 0) {
            $erros[] = "⚠️ Informe um número inteiro positivo.";
        }
    }

    // Se não houver erros, calcula o somatório
    if (empty($erros)) {
        $soma = 0;
        for ($i = 1; $i <= $numero_filtrado; $i++) {
            $soma += $i;
        }
        $resultado = "A soma dos números de 1 a <strong>{$numero_filtrado}</strong> é <strong>{$soma}</strong>.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>➕ Somatório de 1 a N</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
                <header>
        <h1>Minhas Funções</h1>
        <nav>
            <ul>
                <li><a class="item" href="../php/fatorialNumero.php">⬅️</a></li>
                <li><a class="item" href="../index.php">Home</a></li>
                <li><a class="item" href="../php/sequenciaPares.php">➡️</a></li>
            </ul>
        </nav>
    </header>
<div class="container">
    <h2>➕ Somatório de 1 a N</h2>
    <p>Informe um número inteiro positivo para calcular o somatório:</p>

    <?php
    // Exibe erros
    if (!empty($erros)) {
        echo "<div class='erro'><strong>⚠️ Erros encontrados:</strong><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul></div>";
    }

    // Exibe resultado
    if (!empty($resultado)) {
        echo "<div class='resultado'>";
        echo "<h2>📌 Resultado</h2>";
        echo "{$resultado}<br>";
        echo "</div>";
    }
    ?>

    <!-- Formulário -->
    <form method="post" action="">
        <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" step="1" id="numero" name="numero"
                   value="<?= (!empty($numero) && $numero != '0') ? htmlspecialchars($numero) : '' ?>"
                   placeholder="Ex: 5">
        </div>

        <div class="form-group">
            <input type="submit" value="🧮 Calcular">
        </div>
    </form>
</div>
</body>
</html>
