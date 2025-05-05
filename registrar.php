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
if (isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Monta o script para a inserção de dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    // Executa o script no banco
    $result = mysqli_query($conn, $sql);

    // Verifica se conseguiu fazer o INSERT
    if (!$result) {
        echo "<script>alert('Erro ao registrar o usuário!');</script>";
    }
} else {
    echo "<script>alert('Dados inválidos!');</script>";
}

// Desconecta do banco
mysqli_close($conn);

// Retorna para a página de login
header('Location: index.html');
exit();
?>
