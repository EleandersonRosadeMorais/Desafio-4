<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$n1 = $n2 = 0;
$operacao = '';
$erros = [];
$resultado = '';

// Inicializa variáveis a partir do POST
if (isset($_POST['n1'])) {
    $n1 = trim($_POST['n1']);
}
if (isset($_POST['n2'])) {
    $n2 = trim($_POST['n2']);
}
if (isset($_POST['operacao'])) {
    $operacao = trim($_POST['operacao']);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação do primeiro número
    if ($n1 === '') {
        $erros[] = "⚠️ Por favor, preencha o primeiro número.";
    } else {
        $n1_filtrado = filter_var($n1, FILTER_VALIDATE_FLOAT);
        if ($n1_filtrado === false) {
            $erros[] = "⚠️ O primeiro número deve ser válido.";
        }
    }

    // Validação do segundo número
    if ($n2 === '') {
        $erros[] = "⚠️ Por favor, preencha o segundo número.";
    } else {
        $n2_filtrado = filter_var($n2, FILTER_VALIDATE_FLOAT);
        if ($n2_filtrado === false) {
            $erros[] = "⚠️ O segundo número deve ser válido.";
        }
    }

    // Validação da operação
    $operacoes_validas = ['somar', 'subtrair', 'multiplicar', 'dividir'];
    if (!in_array($operacao, $operacoes_validas)) {
        $erros[] = "⚠️ Selecione uma operação válida.";
    }

    // Se não houver erros, realiza a operação
    if (empty($erros)) {
        switch ($operacao) {
            case 'somar':
                $resultado_valor = $n1_filtrado + $n2_filtrado;
                $resultado = "{$n1_filtrado} + {$n2_filtrado} = {$resultado_valor}";
                break;
            case 'subtrair':
                $resultado_valor = $n1_filtrado - $n2_filtrado;
                $resultado = "{$n1_filtrado} - {$n2_filtrado} = {$resultado_valor}";
                break;
            case 'multiplicar':
                $resultado_valor = $n1_filtrado * $n2_filtrado;
                $resultado = "{$n1_filtrado} × {$n2_filtrado} = {$resultado_valor}";
                break;
            case 'dividir':
                if ($n2_filtrado == 0) {
                    $resultado = "⚠️ Divisão por zero não é permitida!";
                } else {
                    $resultado_valor = $n1_filtrado / $n2_filtrado;
                    $resultado = "{$n1_filtrado} ÷ {$n2_filtrado} = {$resultado_valor}";
                }
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>🧮 Calculadora Simples</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>🧮 Calculadora Simples</h2>
    <p>Informe dois números e selecione a operação:</p>

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
            <label for="n1">Número 1</label>
            <input type="text" step="any" id="n1" name="n1"
                   value="<?= (!empty($n1) && $n1 != '0') ? htmlspecialchars($n1) : '' ?>"
                   placeholder="Ex: 10">
        </div>

        <div class="form-group">
            <label for="n2">Número 2</label>
            <input type="text" step="any" id="n2" name="n2"
                   value="<?= (!empty($n2) && $n2 != '0') ? htmlspecialchars($n2) : '' ?>"
                   placeholder="Ex: 5">
        </div>

        <div class="form-group">
            <label for="operacao">Operação</label>
            <select id="operacao" name="operacao">
                <option value="">Selecione</option>
                <option value="somar" <?= ($operacao=='somar') ? 'selected' : '' ?>>Somar</option>
                <option value="subtrair" <?= ($operacao=='subtrair') ? 'selected' : '' ?>>Subtrair</option>
                <option value="multiplicar" <?= ($operacao=='multiplicar') ? 'selected' : '' ?>>Multiplicar</option>
                <option value="dividir" <?= ($operacao=='dividir') ? 'selected' : '' ?>>Dividir</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" value="🧮 Calcular">
        </div>
    </form>
</div>
</body>
</html>
