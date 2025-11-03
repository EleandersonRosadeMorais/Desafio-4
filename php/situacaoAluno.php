<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$nota1 = $nota2 = $media = 0;
$erros = [];
$situacao = "";

// Inicializa variáveis a partir do POST
if (isset($_POST['nota1'])) {
    $nota1 = trim($_POST['nota1']);
}

if (isset($_POST['nota2'])) {
    $nota2 = trim($_POST['nota2']);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação da primeira nota
    if ($nota1 === '') {
        $erros[] = "⚠️ Por favor, preencha a primeira nota.";
    } else {
        $nota1_filtrada = filter_var($nota1, FILTER_VALIDATE_FLOAT);
        if ($nota1_filtrada === false || $nota1_filtrada < 0 || $nota1_filtrada > 10) {
            $erros[] = "⚠️ A primeira nota deve ser um número entre 0 e 10.";
        }
    }

    // Validação da segunda nota
    if ($nota2 === '') {
        $erros[] = "⚠️ Por favor, preencha a segunda nota.";
    } else {
        $nota2_filtrada = filter_var($nota2, FILTER_VALIDATE_FLOAT);
        if ($nota2_filtrada === false || $nota2_filtrada < 0 || $nota2_filtrada > 10) {
            $erros[] = "⚠️ A segunda nota deve ser um número entre 0 e 10.";
        }
    }

    // Se não houver erros, calcula a média e determina a situação
    if (empty($erros)) {
        $media = ($nota1_filtrada + $nota2_filtrada) / 2;

        if ($media >= 7) {
            $situacao = "Aprovado ✅";
        } elseif ($media >= 4) {
            $situacao = "Em Recuperação ⚠️";
        } else {
            $situacao = "Reprovado ❌";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>📚 Situação do Aluno</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>📊 Situação do Aluno</h2>
    <p>Informe as duas notas do aluno (0 a 10):</p>

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
    if (!empty($media)) {
        $media_formatada = number_format($media, 2, ',', '.');
        echo "<div class='resultado'>";
        echo "<h2>📌 Resultado</h2>";
        echo "📝 Nota 1: <strong>{$nota1_filtrada}</strong><br>";
        echo "📝 Nota 2: <strong>{$nota2_filtrada}</strong><br>";
        echo "🧮 Média: <strong>{$media_formatada}</strong><br>";
        echo "🎯 Situação: <strong>{$situacao}</strong><br>";
        echo "</div>";
    }
    ?>

    <!-- Formulário -->
    <form method="post" action="">
        <div class="form-group">
            <label for="nota1">📝 Nota 1</label>
            <input type="number" step="any" id="nota1" name="nota1"
                   value="<?= (!empty($nota1) && $nota1 != '0') ? htmlspecialchars($nota1) : '' ?>"
                   placeholder="Ex: 7.5">
        </div>

        <div class="form-group">
            <label for="nota2">📝 Nota 2</label>
            <input type="text" step="any" id="nota2" name="nota2"
                   value="<?= (!empty($nota2) && $nota2 != '0') ? htmlspecialchars($nota2) : '' ?>"
                   placeholder="Ex: 8.0">
        </div>

        <div class="form-group">
            <input type="submit" value="🧮 Calcular">
        </div>
    </form>
</div>
</body>
</html>
