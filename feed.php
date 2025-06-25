<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['idusuario'])) {
    header('Location: index.html');
    exit;
}

$id_usuario = $_SESSION['idusuario'];

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conteudo = trim($_POST['conteudo']);
    if (!empty($conteudo)) {
        $stmt = $conn->prepare("INSERT INTO posts (id_usuario, conteudo) VALUES (?, ?)");
        $stmt->bind_param("is", $id_usuario, $conteudo);
        $stmt->execute();
        $stmt->close();
        echo "<p style='color:lime;'>Post publicado com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Escreva algo antes de publicar.</p>";
    }
}

// Busca as publicações
$sql = "SELECT p.conteudo, p.data_post, u.nome 
        FROM posts p
        JOIN usuarios u ON p.id_usuario = u.idUsuarios
        ORDER BY p.data_post DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Feed - SafeSpace</title>
  <link rel="stylesheet" href="feed.css">
</head>
<body class="pagina-feed">

<div class="feed-container">
  <h2 style="color:#4caf50;">Nova Publicação</h2>
  <form action="feed.php" method="POST">
    <textarea name="conteudo" rows="4" cols="50" placeholder="O que você está pensando?" required></textarea><br>
    <input type="submit" value="Publicar">
  </form>

  <hr>

  <h2 style="color:#4caf50;">Últimas Publicações</h2>

  <?php
  if ($result && $result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
  ?>
    <div class="post">
      <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
      <p><?php echo nl2br(htmlspecialchars($row['conteudo'])); ?></p>
      <small><?php echo date('d/m/Y H:i', strtotime($row['data_post'])); ?></small>
    </div>
  <?php
    endwhile;
  else:
    echo "<p>Nenhuma publicação encontrada.</p>";
  endif;
  ?>

</div>

</body>
</html>
