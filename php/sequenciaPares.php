<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$inicio = $fim = 0;
$erros = [];
$resultado = '';

// Inicializa variáveis a partir do POST
if (isset($_POST['inicio'])) {
    $inicio = trim($_POST['inicio']);
}
if (isset($_POST['fim'])) {
    $fim = trim($_POST['fim']);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação do número inicial
    if ($inicio === '') {
        $erros[] = "⚠️ Por favor, preencha o número inicial.";
    } else {
        $inicio_filtrado = filter_var($inicio, FILTER_VALIDATE_INT);
        if ($inicio_filtrado === false) {
            $erros[] = "⚠️ Informe um número inicial válido.";
        }
    }

    // Validação do número final
    if ($fim === '') {
        $erros[] = "⚠️ Por favor, preencha o número final.";
    } else {
        $fim_filtrado = filter_var($fim, FILTER_VALIDATE_INT);
        if ($fim_filtrado === false) {
            $erros[] = "⚠️ Informe um número final válido.";
        }
    }

    // Verifica se início <= fim
    if (empty($erros) && $inicio_filtrado > $fim_filtrado) {
        $erros[] = "⚠️ O número inicial deve ser menor ou igual ao número final.";
    }

    // Se não houver erros, calcula os pares
    if (empty($erros)) {
        $pares = [];
        for ($i = $inicio_filtrado; $i <= $fim_filtrado; $i++) {
            if ($i % 2 == 0) {
                $pares[] = $i;
            }
        }
        $resultado = "Pares entre <strong>{$inicio_filtrado}</strong> e <strong>{$fim_filtrado}</strong>: ";
        $resultado .= !empty($pares) ? implode(", ", $pares) : "Nenhum número par neste intervalo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>🔢 Sequência de Pares</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>🔢 Sequência de Pares</h2>
    <p>Informe o número inicial e o número final para listar os pares do intervalo:</p>

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
            <label for="inicio">Número Inicial</label>
            <input type="text" step="1" id="inicio" name="inicio"
                   value="<?= (!empty($inicio)) ? htmlspecialchars($inicio) : '' ?>"
                   placeholder="Ex: 5">
        </div>

        <div class="form-group">
            <label for="fim">Número Final</label>
            <input type="text" step="1" id="fim" name="fim"
                   value="<?= (!empty($fim)) ? htmlspecialchars($fim) : '' ?>"
                   placeholder="Ex: 15">
        </div>

        <div class="form-group">
            <input type="submit" value="🧮 Calcular">
        </div>
    </form>
</div>
</body>
</html>
