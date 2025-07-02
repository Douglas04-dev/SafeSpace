<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['idusuario'])) {
    header('Location: index.html');
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $id_usuario = $_SESSION['idusuario'];

    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id, $id_usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: feed.php");
        exit;
    } else {
        echo "<p>Erro: postagem não encontrada ou você não tem permissão para excluir.</p>";
    }
} else {
    echo "<p>ID de postagem inválido.</p>";
}
?>
