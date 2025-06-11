<?php
include_once "conexao.php";

$conn = mysqli_connect($localhost, $user, $password, $banco);

if (!$conn) {
    echo "<script>alert('Erro ao conectar com o banco de dados!');</script>";
    header('Location: index.html');
    exit();
}

if (isset($_POST['cpf'], $_POST['nome'], $_POST['crp'])) {
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $crp = mysqli_real_escape_string($conn, $_POST['crp']);
    $especialidade = mysqli_real_escape_string($conn, $_POST['especialidade'] ?? '');
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone'] ?? '');
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao'] ?? '');
    $link = mysqli_real_escape_string($conn, $_POST['agenda_google'] ?? '');

    $sql = "INSERT INTO profissionais (cpf, nome, crp, especialidade, telefone, descricao, link)
            VALUES ('$cpf', '$nome', '$crp', '$especialidade', '$telefone', '$descricao', '$link')";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "<script>alert('Erro ao registrar o profissional! Verifique se CPF ou CRP já estão cadastrados.');</script>";
    } else {
        echo "<script>alert('Profissional cadastrado com sucesso!');</script>";
    }
} else {
    echo "<script>alert('Dados obrigatórios (CPF, Nome, CRP) não informados!');</script>";
}

mysqli_close($conn);

header('Location: index.html');
exit();
?>
