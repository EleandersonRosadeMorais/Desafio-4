<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$reais = $dolar = $convertido = 0;
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém e sanitiza os valores do POST
    $reais = '';
    $dolar = '';

    if (isset($_POST['reais'])) {
        $reais = trim($_POST['reais']);
    }

    if (isset($_POST['dolar'])) {
        $dolar = trim($_POST['dolar']);
    }

    // Validação do campo Reais
    if (empty($reais)) {
        $erros[] = "Preencha o campo Reais!";
    } else {
        $reais_filtrado = filter_var($reais, FILTER_VALIDATE_FLOAT);
        if ($reais_filtrado === false) {
            $erros[] = "O valor em Reais não é um número válido!";
        } elseif ($reais_filtrado < 0) {
            $erros[] = "O valor em Reais deve ser um número positivo!";
        }
    }

    // Validação do campo Dólar
    if (empty($dolar)) {
        $erros[] = "Preencha o campo Dólar!";
    } else {
        $dolar_filtrado = filter_var($dolar, FILTER_VALIDATE_FLOAT);
        if ($dolar_filtrado === false) {
            $erros[] = "A cotação do Dólar não é um número válido!";
        } elseif ($dolar_filtrado <= 0) {
            $erros[] = "A cotação do Dólar deve ser maior que zero!";
        }
    }

    // Se não há erros, realiza a conversão
    if (empty($erros)) {
        $convertido = $reais_filtrado / $dolar_filtrado;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Conversor de Moedas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h2>💰 Conversor de Moedas</h2>
        <p>Insira o seu valor em Reais (R$) e a cotação do Dólar (USD)</p>

        <?php
        // Exibe erros
        if (!empty($erros)) {
            echo "<div class='erro'><strong>Erros encontrados:</strong><ul>";
            foreach ($erros as $erro) {
                echo "<li>$erro</li>";
            }
            echo "</ul></div>";
        }

        
        // Exibe resultado
        if (!empty($convertido) && $convertido > 0) {
            $reais_formatado = number_format($reais_filtrado, 2, ',', '.');
            $dolar_formatado = number_format($convertido, 2, ',', '.');
            $cotacao_formatada = number_format($dolar_filtrado, 2, ',', '.');

            echo "<div class='resultado'>";
            echo "💵 <strong>R$ {$reais_formatado}</strong> (Reais)<br>";
            echo "📊 Cotação do dólar: <strong>R$ {$cotacao_formatada}</strong><br>";
            echo "💲 Convertido: <strong>US$ {$dolar_formatado}</strong> (Dólares)";
            echo "</div>";
        }
        ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="reais">💵 Reais (R$)</label>
                <input type="text" id="reais" name="reais"
                    value="<?= (!empty($reais) && $reais != '0') ? htmlspecialchars($reais) : '' ?>"
                    placeholder="Ex: 100.50">
            </div>

            <div class="form-group">
                <label for="dolar">📊 Cotação do Dólar (R$)</label>
                <input type="text" id="dolar" name="dolar"
                    value="<?= (!empty($dolar) && $dolar != '0') ? htmlspecialchars($dolar) : '' ?>"
                    placeholder="Ex: 5.20">
            </div>

            <div class="form-group">
                <input type="submit" value="🔄 Converter">
            </div>
        </form>
    </div>
</body>

</html>