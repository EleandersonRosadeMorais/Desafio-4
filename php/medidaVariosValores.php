<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$notas = [];
$erros = [];
$resultado = '';

// Inicializa variável a partir do POST
if (isset($_POST['notas'])) {
    $notas = $_POST['notas'];
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $soma = 0;
    $valores_validos = 0;

    foreach ($notas as $index => $nota) {
        $nota = trim($nota);
        if ($nota === '') {
            $erros[] = "⚠️ Por favor, preencha a nota " . ($index + 1) . ".";
        } else {
            $nota_filtrada = filter_var($nota, FILTER_VALIDATE_FLOAT);
            if ($nota_filtrada === false || $nota_filtrada < 0 || $nota_filtrada > 10) {
                $erros[] = "⚠️ A nota " . ($index + 1) . " deve ser um número entre 0 e 10.";
            } else {
                $soma += $nota_filtrada;
                $valores_validos++;
            }
        }
    }

    // Calcula média se não houver erros
    if (empty($erros) && $valores_validos > 0) {
        $media = $soma / $valores_validos;
        $media_formatada = number_format($media, 2, ',', '.');
        $resultado = "A média das notas é <strong>{$media_formatada}</strong>.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>📊 Média de Vários Valores</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>📊 Média de Vários Valores</h2>
    <p>Informe 5 notas (0 a 10) para calcular a média:</p>

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
            $valor = isset($notas[$i]) ? htmlspecialchars($notas[$i]) : '';
            echo "<div class='form-group'>
                    <label for='nota{$i}'>Nota " . ($i + 1) . "</label>
                    <input type='text' step='any' id='nota{$i}' name='notas[]' value='{$valor}' placeholder='Ex: 7.5'>
                  </div>";
        }
        ?>
        <div class="form-group">
            <input type="submit" value="🧮 Calcular Média">
        </div>
    </form>
</div>
</body>
</html>
