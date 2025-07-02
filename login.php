<?php
session_start();
include_once "conexao.php";

// Conexão
$conn = mysqli_connect($localhost, $user, $password, $banco);
if (!$conn) {
    die("Erro de conexão com o banco de dados.");
}

// Verifica se foi enviado email e senha
if (isset($_POST['email'], $_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se encontrou o usuário
    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        // Cria as sessões do jeito que a sessao.php espera
        $_SESSION["usuario"]   = $usuario["nome"];
        $_SESSION["senha"]     = $usuario["senha"];
        $_SESSION["idusuario"] = $usuario["idUsuarios"];
        $_SESSION["backup"]    = ""; // Se quiser usar ou ignorar

        // Redireciona para o feed
        header("Location: feed.php");
        exit();
    } 
    else {
        echo "<script>alert('Usuário ou senha inválidos!'); window.location.href = 'index.html';</script>";
        exit();
    }
} else {
    echo "<script>alert('Preencha os dados corretamente!'); window.location.href = 'index.html';</script>";
    exit();
}
