<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$numero = 0;
$erros = [];
$resultado = "";

// Inicializa variável a partir do POST
if (isset($_POST['numero'])) {
    $numero = trim($_POST['numero']);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação do número
    if ($numero === '') {
        $erros[] = "⚠️ Por favor, preencha o campo do número.";
    } else {
        $numero_filtrado = filter_var($numero, FILTER_VALIDATE_INT);
        if ($numero_filtrado === false) {
            $erros[] = "⚠️ Informe um número inteiro válido.";
        }
    }

    // Se não houver erros, verifica par ou ímpar
    if (empty($erros)) {
        if ($numero_filtrado % 2 == 0) {
            $resultado = "O número <strong>{$numero_filtrado}</strong> é PAR ✅";
        } else {
            $resultado = "O número <strong>{$numero_filtrado}</strong> é ÍMPAR ❌";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>🔢 Verificador Par ou Ímpar</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
              <header>
    <h1>Minhas Funções</h1>
    <nav>
        <ul>
            <li><a class="item" href="../php/verificadorIdade.php">⬅️</a></li>
            <li><a class="item" href="../index.php">Home</a></li>
            <li><a class="item" href="../php/diaSemana.php">➡️</a></li>
        </ul>
    </nav>
</header>   
<div class="container">
    <h2>🔢 Verificador Par ou Ímpar</h2>
    <p>Informe um número inteiro:</p>

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
            <label for="numero">🔢 Número</label>
            <input type="text" step="1" id="numero" name="numero"
                   value="<?= (!empty($numero) && $numero != '0') ? htmlspecialchars($numero) : '' ?>"
                   placeholder="Ex: 7">
        </div>

        <div class="form-group">
            <input type="submit" value="🧮 Verificar">
        </div>
    </form>
</div>
</body>
</html>
