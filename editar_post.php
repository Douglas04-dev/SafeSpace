<?php
session_start();
include 'conexao.php';

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ? AND id_usuario = ?");
$stmt->bind_param("ii", $id, $_SESSION['idusuario']);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
  echo "Post não encontrado ou acesso negado.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Postagem</title>
  <link rel="stylesheet" href="feed.css">
</head>
<body>
<div class="feed-container">
  <h2>Editar Publicação</h2>
  <form action="atualizar_post.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <input type="text" name="titulo" value="<?php echo htmlspecialchars($post['titulo']); ?>" required maxlength="100">
    <textarea name="conteudo" required><?php echo htmlspecialchars($post['conteudo']); ?></textarea>
    <input type="submit" value="Atualizar">
  </form>
</div>
</body>
</html>
