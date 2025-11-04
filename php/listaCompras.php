<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$itens = [];
$resultado = '';

// Inicializa variável a partir do POST
if (isset($_POST['itens'])) {
    $itens = $_POST['itens'];
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($itens)) {
        $resultado = "Itens selecionados:<br><ul>";
        foreach ($itens as $item) {
            $resultado .= "<li>" . htmlspecialchars($item) . "</li>";
        }
        $resultado .= "</ul>";
    } else {
        $resultado = "Nenhum item foi selecionado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>🛒 Lista de Compras</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
        <header>
        <h1>Minhas Funções</h1>
        <nav>
            <ul>
                <li><a class="item" href="../php/medidaVariosValores.php">⬅️</a></li>
                <li><a class="item" href="../index.php">Home</a></li>
                <li><a class="item" href="../php/encontrarMaiorValor.php">➡️</a></li>
            </ul>
        </nav>
    </header>
<div class="container">
    <h2>🛒 Lista de Compras</h2>
    <p>Selecione os itens que deseja comprar:</p>

    <?php
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
            <label><input type="checkbox" name="itens[]" value="Arroz" <?= in_array("Arroz", $itens) ? 'checked' : '' ?>> Arroz</label><br>
            <label><input type="checkbox" name="itens[]" value="Feijão" <?= in_array("Feijão", $itens) ? 'checked' : '' ?>> Feijão</label><br>
            <label><input type="checkbox" name="itens[]" value="Leite" <?= in_array("Leite", $itens) ? 'checked' : '' ?>> Leite</label><br>
            <label><input type="checkbox" name="itens[]" value="Ovos" <?= in_array("Ovos", $itens) ? 'checked' : '' ?>> Ovos</label><br>
            <label><input type="checkbox" name="itens[]" value="Pão" <?= in_array("Pão", $itens) ? 'checked' : '' ?>> Pão</label>
        </div>

        <div class="form-group">
            <input type="submit" value="✅ Confirmar">
        </div>
    </form>
</div>
</body>
</html>
