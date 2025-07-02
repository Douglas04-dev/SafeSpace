<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['idusuario'])) {
    header('Location: index.html');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);
    $id_usuario = $_SESSION['idusuario'];

    if (!empty($titulo) && !empty($conteudo)) {
        $stmt = $conn->prepare("UPDATE posts SET titulo = ?, conteudo = ? WHERE id = ? AND id_usuario = ?");
        $stmt->bind_param("ssii", $titulo, $conteudo, $id, $id_usuario);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: feed.php");
            exit;
        } else {
            echo "<p>Erro: postagem não encontrada ou você não tem permissão para editar.</p>";
        }
    } else {
        echo "<p>Título e conteúdo não podem estar vazios.</p>";
    }
} else {
    echo "<p>Requisição inválida.</p>";
}
?>
