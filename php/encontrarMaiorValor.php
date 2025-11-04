<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$numeros = [];
$erros = [];
$resultado = '';

// Inicializa variável a partir do POST
if (isset($_POST['numeros'])) {
    $numeros = $_POST['numeros'];
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valores_validos = [];

    // Valida e filtra os números
    foreach ($numeros as $index => $num) {
        $num = trim($num);
        if ($num === '') {
            $erros[] = "⚠️ Por favor, preencha o número " . ($index + 1) . ".";
        } else {
            $num_filtrado = filter_var($num, FILTER_VALIDATE_FLOAT);
            if ($num_filtrado === false) {
                $erros[] = "⚠️ O número " . ($index + 1) . " deve ser válido.";
            } else {
                $valores_validos[] = $num_filtrado;
            }
        }
    }

    // Se não houver erros, encontra o maior valor
    if (empty($erros) && !empty($valores_validos)) {
        $maior = $valores_validos[0];
        foreach ($valores_validos as $valor) {
            if ($valor > $maior) {
                $maior = $valor;
            }
        }
        $resultado = "O maior número digitado foi: <strong>{$maior}</strong>.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>🔢 Encontrar o Maior Valor</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
            <header>
        <h1>Minhas Funções</h1>
        <nav>
            <ul>
                <li><a class="item" href="../php/listaCompras.php">Encontrar o maior valor</a></li>
                <li><a class="item" href="../index.php">Home</a></li>
                <li><a class="item" href="../php/conversorMoedas.php">Calculadora de área e perímetro</a></li>
            </ul>
        </nav>
    </header>
<div class="container">
    <h2>🔢 Encontrar o Maior Valor</h2>
    <p>Digite 5 números:</p>

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
        <?php
        for ($i = 0; $i < 5; $i++) {
            $valor = isset($numeros[$i]) ? htmlspecialchars($numeros[$i]) : '';
            echo "<div class='form-group'>
                    <label for='num{$i}'>Número " . ($i + 1) . "</label>
                    <input type='text' step='any' id='num{$i}' name='numeros[]' value='{$valor}' placeholder='Ex: 10'>
                  </div>";
        }
        ?>
        <div class="form-group">
            <input type="submit" value="✅ Verificar Maior">
        </div>
    </form>
</div>
</body>
</html>
