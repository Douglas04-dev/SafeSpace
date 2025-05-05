<?php
// Inicia a sessão
session_start();

// Inclui parâmetros de conexão
include_once "conexao.php";

// Comando de conexão (certifique-se de que as variáveis $localhost, $db_user, $db_password, $banco estão corretamente configuradas no "conexao.php")
$conn = mysqli_connect($localhost, $user, $password, $banco);

// Testa se a conexão deu certo
if (!$conn) {
    echo "<script>alert('Não conseguiu se conectar ao banco!');</script>";
    header('Location: index.html');
    exit();
}

// Verifica se as variáveis de POST estão definidas
if (isset($_POST['email'], $_POST['senha'])) {
    // Escapa caracteres especiais para evitar problemas de segurança e de sintaxe SQL
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

        // Monta e executa a consulta SQL
        $sql = "SELECT idUsuarios, nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $result = mysqli_query($conn, $sql);

    // Verifica se a consulta foi executada corretamente
    if (!$result) {
        echo "<script>alert('Erro na consulta SQL: " . mysqli_error($conn) . "');</script>";
        header('Location: index.html');
        exit();
    }

    // Verifica se o usuário foi encontrado
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $idusuario = $row[0];
        $usuario = $row[1];

        // Cria a sessão
        $_SESSION['idusuario'] = $idusuario;
        $_SESSION['usuario'] = $usuario;

        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Usuário não existe!');</script>";
        header('Location: index.html');
        exit();
    }
} else {
    echo "<script>alert('Dados inválidos!');</script>";
    header('Location: index.html');
    exit();
}

// Encerra a conexão
mysqli_close($conn);
?>
