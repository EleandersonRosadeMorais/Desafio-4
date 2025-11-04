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
        $erros[] = "⚠️ Por favor, selecione um número de 1 a 7.";
    } else {
        $numero_filtrado = filter_var($numero, FILTER_VALIDATE_INT);
        if ($numero_filtrado === false) {
            $erros[] = "⚠️ Informe um número inteiro válido.";
        }
    }

    // Se não houver erros, verifica o dia da semana
    if (empty($erros)) {
        switch ($numero_filtrado) {
            case 1:
                $resultado = "1 - Domingo 🌞";
                break;
            case 2:
                $resultado = "2 - Segunda-feira 🌅";
                break;
            case 3:
                $resultado = "3 - Terça-feira 🌄";
                break;
            case 4:
                $resultado = "4 - Quarta-feira ☀️";
                break;
            case 5:
                $resultado = "5 - Quinta-feira 🌤️";
                break;
            case 6:
                $resultado = "6 - Sexta-feira 🌇";
                break;
            case 7:
                $resultado = "7 - Sábado 🎉";
                break;
            default:
                $resultado = "Número inválido ❌. Informe um valor entre 1 e 7.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>📅 Dia da Semana</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <h1>Minhas Funções</h1>
        <nav>
            <ul>
                <li><a class="item" href="../php/parImpar.php">⬅️</a></li>
                <li><a class="item" href="../index.php">Home</a></li>
                <li><a class="item" href="../php/operacoesMatematicas.php">➡️</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>📅 Dia da Semana</h2>
        <p>Selecione um número de 1 a 7 para verificar o dia correspondente:</p>

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
                <label for="numero">📅 Dia da Semana</label>
                <select id="numero" name="numero">
                    <option value="">Selecione</option>
                    <?php
                    for ($i = 1; $i <= 7; $i++) {
                        $selected = ($numero == $i) ? 'selected' : '';
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