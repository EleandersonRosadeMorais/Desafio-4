<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$distancia = $combustivel = $consumo = 0;
$erros = [];

// Inicializa variáveis a partir do POST
if (isset($_POST['distancia'])) {
    $distancia = trim($_POST['distancia']);
}

if (isset($_POST['combustivel'])) {
    $combustivel = trim($_POST['combustivel']);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação da distância
    if (empty($distancia)) {
        $erros[] = "⚠️ Por favor, preencha o campo da distância.";
    } else {
        $distancia_filtrada = filter_var($distancia, FILTER_VALIDATE_FLOAT);
        if ($distancia_filtrada === false) {
            $erros[] = "⚠️ A distância deve ser um número válido.";
        } elseif ($distancia_filtrada <= 0) {
            $erros[] = "⚠️ A distância deve ser maior que zero.";
        }
    }

    // Validação do combustível
    if (empty($combustivel)) {
        $erros[] = "⚠️ Por favor, preencha o campo do combustível.";
    } else {
        $combustivel_filtrado = filter_var($combustivel, FILTER_VALIDATE_FLOAT);
        if ($combustivel_filtrado === false) {
            $erros[] = "⚠️ O combustível deve ser um número válido.";
        } elseif ($combustivel_filtrado <= 0) {
            $erros[] = "⚠️ O combustível deve ser maior que zero.";
        }
    }

    // Se não houver erros, calcula o consumo médio
    if (empty($erros)) {
        $consumo = $distancia_filtrada / $combustivel_filtrado;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>⛽ Calculadora de Consumo de Combustível</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
    <h1>Minhas Funções</h1>
    <nav>
        <ul>
            <li><a class="item" href="../php/calculadoraAreaPerimetro.php">Encontrar o maior valor</a></li>
            <li><a class="item" href="../index.php">Home</a></li>
            <li><a class="item" href="../php/SituacaoAluno.php">Calculadora de área e perímetro</a></li>
        </ul>
    </nav>
</header>
<div class="container">
    <h2>⛽ Calculadora de Consumo de Combustível</h2>
    <p>Informe a distância percorrida e o total de combustível gasto:</p>

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
    if (!empty($consumo) && $consumo > 0) {
        $distancia_formatada = number_format($distancia_filtrada, 2, ',', '.');
        $combustivel_formatado = number_format($combustivel_filtrado, 2, ',', '.');
        $consumo_formatado = number_format($consumo, 2, ',', '.');

        echo "<div class='resultado'>";
        echo "<h2>📊 Resultado do consumo médio</h2>";
        echo "🛣️ Distância percorrida: <strong>{$distancia_formatada} km</strong><br>";
        echo "⛽ Combustível gasto: <strong>{$combustivel_formatado} L</strong><br>";
        echo "🧮 Consumo médio: <strong>{$consumo_formatado} km/L</strong><br>";
        echo "</div>";
    }
    ?>

    <!-- Formulário -->
    <form method="post" action="">
        <div class="form-group">
            <label for="distancia">🛣️ Distância (km)</label>
            <input type="text" step="any" id="distancia" name="distancia"
                   value="<?= (!empty($distancia) && $distancia != '0') ? htmlspecialchars($distancia) : '' ?>"
                   placeholder="Ex: 150">
        </div>

        <div class="form-group">
            <label for="combustivel">⛽ Combustível (L)</label>
            <input type="text" step="any" id="combustivel" name="combustivel"
                   value="<?= (!empty($combustivel) && $combustivel != '0') ? htmlspecialchars($combustivel) : '' ?>"
                   placeholder="Ex: 10">
        </div>

        <div class="form-group">
            <input type="submit" value="🧮 Calcular">
        </div>
    </form>
</div>
</body>
</html>
