<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$base = $altura = $area = $perimetro = 0;
$erros = [];
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém e sanitiza os valores do POST

    if (isset($_POST['base'])) {
        $base = trim($_POST['base']);
    }

    if (isset($_POST['altura'])) {
        $altura = trim($_POST['altura']);
    }

    // Validação da base
    if (empty($base)) {
        $erros[] = "⚠️ Por favor, preencha o campo da base.";
    } else {
        $base_filtrada = filter_var($base, FILTER_VALIDATE_FLOAT);
        if ($base_filtrada === false) {
            $erros[] = "⚠️ O valor da base deve ser um número válido.";
        } elseif ($base_filtrada <= 0) {
            $erros[] = "⚠️ O valor da base deve ser maior que zero.";
        }
    }

    // Validação da altura
    if (empty($altura)) {
        $erros[] = "⚠️ Por favor, preencha o campo da altura.";
    } else {
        $altura_filtrada = filter_var($altura, FILTER_VALIDATE_FLOAT);
        if ($altura_filtrada === false) {
            $erros[] = "⚠️ O valor da altura deve ser um número válido.";
        } elseif ($altura_filtrada <= 0) {
            $erros[] = "⚠️ O valor da altura deve ser maior que zero.";
        }
    }

    // Se não houver erros, realiza cálculos e determina quadrado/retângulo
    if (empty($erros)) {
        $area = $base_filtrada * $altura_filtrada;
        $perimetro = 2 * ($base_filtrada + $altura_filtrada);

        if ($base_filtrada == $altura_filtrada) {
            $mensagem = "quadrado";
        } else {
            $mensagem = "retângulo";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>📐 Calculadora de Área e Perímetro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header>
    <h1>Minhas Funções</h1>
    <nav>
        <ul>
            <li><a class="item" href="../php/conversorMoedas.php">Encontrar o maior valor</a></li>
            <li><a class="item" href="../index.php">Home</a></li>
            <li><a class="item" href="../php/consumoCombustivel.php">Calculadora de área e perímetro</a></li>
        </ul>
    </nav>
</header>

    <div class="container">
        <h2>📏 Calculadora de Área e Perímetro</h2>
        <p>Insira os valores da base e da altura do seu retângulo ou quadrado:</p>

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
        if (!empty($area) && $area > 0) {
            $base_formatada = number_format($base_filtrada, 2, ',', '.');
            $altura_formatada = number_format($altura_filtrada, 2, ',', '.');
            $area_formatada = number_format($area, 2, ',', '.');
            $perimetro_formatado = number_format($perimetro, 2, ',', '.');

            echo "<div class='resultado'>";
            echo "<h2>📊 Informações do seu $mensagem</h2>";
            echo "📏 Altura: <strong>{$altura_formatada}</strong> cm<br>";
            echo "📐 Base: <strong>{$base_formatada}</strong> cm<br>";
            echo "🧮 Área: <strong>{$area_formatada}</strong> cm²<br>";
            echo "📏 Perímetro: <strong>{$perimetro_formatado}</strong> cm<br>";
            echo "</div>";
        }
        ?>

    <!-- Formulário -->
        <form method="post" action="">
            <div class="form-group">
                <label for="base">📐 Base</label>
                <input type="text"" id=" base" name="base"
                    value="<?= (!empty($base) && $base != '0') ? htmlspecialchars($base) : '' ?>"
                    placeholder="Ex: 20.5">
            </div>

            <div class="form-group">
                <label for="altura">📏 Altura</label>
                <input type="text" id="altura" name="altura"
                    value="<?= (!empty($altura) && $altura != '0') ? htmlspecialchars($altura) : '' ?>"
                    placeholder="Ex: 5">
            </div>

            <div class="form-group">
                <input type="submit" value="🧮 Calcular">
            </div>
        </form>
    </div>
</body>

</html>