<?php
// Inclui parâmetros de conexão
include_once "conexao.php";

// Comando de conexão
$conn = mysqli_connect($localhost, $user, $password, $banco);

// Testa se a conexão deu certo
if (!$conn) {
    echo "<script>alert('Erro ao conectar com o banco de dados!');</script>";
    header('Location: index.html');
    exit();
}

// Verifica se os dados foram recebidos corretamente
if (isset($_POST['cpf'], $_POST['nome'], $_POST['crp'])) {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $crp = $_POST['crp'];
    $especialidade = $_POST['especialidade'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    // Escapa os valores para evitar SQL Injection
    $cpf = mysqli_real_escape_string($conn, $cpf);
    $nome = mysqli_real_escape_string($conn, $nome);
    $crp = mysqli_real_escape_string($conn, $crp);
    $especialidade = mysqli_real_escape_string($conn, $especialidade);
    $telefone = mysqli_real_escape_string($conn, $telefone);
    $descricao = mysqli_real_escape_string($conn, $descricao);

    // Monta o script para a inserção de dados
    $sql = "INSERT INTO profissionais (cpf, nome, crp, especialidade, telefone, descricao)
            VALUES ('$cpf', '$nome', '$crp', '$especialidade', '$telefone', '$descricao')";

    // Executa o script no banco
    $result = mysqli_query($conn, $sql);

    // Verifica se conseguiu fazer o INSERT
    if (!$result) {
        echo "<script>alert('Erro ao registrar o profissional! Verifique se CPF ou CRP já estão cadastrados.');</script>";
    }
} else {
    echo "<script>alert('Dados obrigatórios (CPF, Nome, CRP) não informados!');</script>";
}

// Desconecta do banco
mysqli_close($conn);

// Retorna para a página de cadastro
header('Location: index.html');
exit();
?>
