<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$mes = 0;
$erros = [];
$resultado = '';

// Inicializa variável a partir do POST
if (isset($_POST['mes'])) {
    $mes = trim($_POST['mes']);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação do número do mês
    if ($mes === '') {
        $erros[] = "⚠️ Por favor, selecione o número do mês.";
    } else {
        $mes_filtrado = filter_var($mes, FILTER_VALIDATE_INT);
        if ($mes_filtrado === false || $mes_filtrado < 1 || $mes_filtrado > 12) {
            $erros[] = "⚠️ Informe um número válido entre 1 e 12.";
        }
    }

    // Se não houver erros, associa o número ao mês
    if (empty($erros)) {
        switch ($mes_filtrado) {
            case 1: $resultado = "1 - Janeiro"; break;
            case 2: $resultado = "2 - Fevereiro"; break;
            case 3: $resultado = "3 - Março"; break;
            case 4: $resultado = "4 - Abril"; break;
            case 5: $resultado = "5 - Maio"; break;
            case 6: $resultado = "6 - Junho"; break;
            case 7: $resultado = "7 - Julho"; break;
            case 8: $resultado = "8 - Agosto"; break;
            case 9: $resultado = "9 - Setembro"; break;
            case 10: $resultado = "10 - Outubro"; break;
            case 11: $resultado = "11 - Novembro"; break;
            case 12: $resultado = "12 - Dezembro"; break;
            default: $resultado = "Número inválido"; break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>📅 Mês por Extenso</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
        <header>
        <h1>Minhas Funções</h1>
        <nav>
            <ul>
                <li><a class="item" href="../php/operacoesMatematicas.php">⬅️</a></li>
                <li><a class="item" href="../index.php">Home</a></li>
                <li><a class="item" href="../php/fatorialNumero.php">➡️</a></li>
            </ul>
        </nav>
    </header>
<div class="container">
    <h2>📅 Mês por Extenso</h2>
    <p>Selecione o número do mês (1 a 12):</p>

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
            <label for="mes">Mês</label>
            <select id="mes" name="mes">
                <option value="">Selecione</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $selected = ($mes == $i) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" value="🧮 Verificar">
        </div>
    </form>
</div>
</body>
</html>
