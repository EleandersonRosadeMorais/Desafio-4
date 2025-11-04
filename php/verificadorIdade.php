<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$ano_nascimento = $idade = 0;
$erros = [];
$situacao_voto = "";

// Inicializa variável a partir do POST
if (isset($_POST['ano_nascimento'])) {
    $ano_nascimento = trim($_POST['ano_nascimento']);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação do ano de nascimento
    if ($ano_nascimento === '') {
        $erros[] = "⚠️ Por favor, preencha o campo do ano de nascimento.";
    } else {
        $ano_filtrado = filter_var($ano_nascimento, FILTER_VALIDATE_INT);
        $ano_atual = date("Y");
        if ($ano_filtrado === false || $ano_filtrado < 1900 || $ano_filtrado > $ano_atual) {
            $erros[] = "⚠️ Informe um ano válido entre 1900 e $ano_atual.";
        }
    }

    // Se não houver erros, calcula a idade e situação de voto
    if (empty($erros)) {
        $idade = $ano_atual - $ano_filtrado;

        if ($idade < 16) {
            $situacao_voto = "Não pode votar ❌";
        } elseif (($idade >= 16 && $idade < 18) || $idade >= 70) {
            $situacao_voto = "Voto Facultativo ⚠️";
        } else {
            $situacao_voto = "Voto Obrigatório ✅";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>🗳️ Verificador de Idade e Votação</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
          <header>
    <h1>Minhas Funções</h1>
    <nav>
        <ul>
            <li><a class="item" href="../php/situacaoAluno.php">Encontrar o maior valor</a></li>
            <li><a class="item" href="../index.php">Home</a></li>
            <li><a class="item" href="../php/parImpar.php">Calculadora de área e perímetro</a></li>
        </ul>
    </nav>
</header>   
<div class="container">
    <h2>🗳️ Verificador de Idade e Votação</h2>
    <p>Informe o ano de nascimento da pessoa:</p>

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
    if (!empty($idade)) {
        echo "<div class='resultado'>";
        echo "<h2>📌 Resultado</h2>";
        echo "🎂 Idade: <strong>{$idade} anos</strong><br>";
        echo "🗳️ Situação de voto: <strong>{$situacao_voto}</strong><br>";
        echo "</div>";
    }
    ?>

    <!-- Formulário -->
    <form method="post" action="">
        <div class="form-group">
            <label for="ano_nascimento">📅 Ano de Nascimento</label>
            <input type="text" id="ano_nascimento" name="ano_nascimento"
                   value="<?= (!empty($ano_nascimento) && $ano_nascimento != '0') ? htmlspecialchars($ano_nascimento) : '' ?>"
                   placeholder="Ex: 2005">
        </div>

        <div class="form-group">
            <input type="submit" value="🧮 Verificar">
        </div>
    </form>
</div>
</body>
</html>
