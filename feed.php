<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['idusuario'])) {
    header('Location: index.html');
    exit;
}
$id_usuario = $_SESSION['idusuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);
    if (!empty($titulo) && !empty($conteudo)) {
        $stmt = $conn->prepare("INSERT INTO posts (id_usuario, titulo, conteudo) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id_usuario, $titulo, $conteudo);
        $stmt->execute();
        $stmt->close();
        header("Location: feed.php");
        exit;
    }
}

$sql = "SELECT p.id, p.titulo, p.conteudo, p.data_post, p.id_usuario, u.nome 
        FROM posts p JOIN usuarios u ON p.id_usuario = u.idUsuarios 
        ORDER BY p.data_post DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Feed - SafeSpace</title>
<link rel="stylesheet" href="feed.css">
<link rel="stylesheet" href="estilo.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
</head>
<body>
  <nav>
        <div class=" logo">
            <a href="#">
                <img src="Imagens/logo3.png" alt="">
            </a>
        </div>

        <ul class="links">
            <li class="li"><a href="index.php">Página Inicial</a></li>
            <li class="li"><a href="consultas_atual.php"> Consultas</a></li>
            <li class="li"><a href="Creditos.php">Sobre Nós</a></li>  
            <li class="li"><a href="feed.php">Feed</a></li>  
        </ul>
      

            <div class="user-menu">
    <img src="Imagens/circle-user-solid.svg" alt="Avatar do usuário" class="avatar" id="user-avatar">
    <div class="dropdown" id="user-dropdown">
        <a href="perfil.html">Meu Perfil</a>
        <a href="#">Configurações</a>
        <a href="logout.php">Sair</a>
    </div>
    
</div>

        </a>
    </nav>
 
<div class="feed-container">
  <h2>Nova Publicação</h2>
  <form action="feed.php" method="POST">
    <input type="text" name="titulo" placeholder="Título (máx. 100 caracteres)" required maxlength="100">
    <textarea name="conteudo" placeholder="Conteúdo da publicação..." required></textarea>
    <input type="submit" value="Publicar">
  </form>

  <h2>Publicações Recentes</h2>
  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="post">
        <h3 class="post-title"><?php echo htmlspecialchars($row['titulo']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($row['conteudo'])); ?></p>
        <small><?php echo date('d/m/Y H:i', strtotime($row['data_post'])); ?> - <?php echo htmlspecialchars($row['nome']); ?></small>
        <?php if ($row['id_usuario'] == $_SESSION['idusuario']): ?>
          <div class="post-actions">
            <button onclick="abrirModal(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['titulo'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($row['conteudo'], ENT_QUOTES); ?>')">✏️ Editar</button>
            <a href="excluir_post.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Deseja excluir?')">🗑️ Excluir</a>
          </div>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>

<!-- Modal -->
<div id="modalEditar" class="modal">
  <div class="modal-content">
    <span class="close" onclick="fecharModal()">&times;</span>
    <form id="formEditar" method="POST" action="atualizar_post.php">
      <input type="hidden" name="id" id="edit-id">
      <input type="text" name="titulo" id="edit-titulo" required>
      <textarea name="conteudo" id="edit-conteudo" required></textarea>
      <input type="submit" value="Salvar Alterações">
    </form>
  </div>
</div>


 <footer id="con" class="container">
        <span class="blur"> </span>
        <span class="blur"> </span>
            <div class="column">
                <div class="log">
                    <img src="Imagens/logo3.png" alt="">
                    <p>
                 
                    

                        </p>
                     <div class="so">
                        <a href="#"><i  class="ri-youtube-line"></i></a>
                         <a href="#"><i class="ri-instagram-line"></i></a>
                        <a href="#"><i class="ri-whatsapp-line"></i></a>
                     </div>
                </div>
            
            </div>
            <div class="col">
                <h4>Company</h4>
                <a href="#">Busines</a>
                <a href="#">Patrocínios</a>
                <a href="#">Network</a>

            </div>

            <div class="col">
                <h4>Sobre Nós</h4>
                <a href="#">Blogs</a>
                <a href="#">Canal</a>
                <a href="#">Portfólio</a>

            </div>
            <div class="col">
                <h4>Contatos</h4>
                <a href="#">Nosso contato</a>
                <a href="#">Politica Privacidade</a>
                <a href="#">Termos & Condições</a>

            </div>
    </footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/scrollreveal"></script>
<script src="script.js"></script>
<script src="movimentacao.js"></script>

<script>
function abrirModal(id, titulo, conteudo) {
  document.getElementById('edit-id').value = id;
  document.getElementById('edit-titulo').value = titulo;
  document.getElementById('edit-conteudo').value = conteudo;
  document.getElementById('modalEditar').style.display = 'block';
}
function fecharModal() {
  document.getElementById('modalEditar').style.display = 'none';
}
window.onclick = function(event) {
  if (event.target.classList.contains('modal')) {
    fecharModal();
  }
}


</script>
</body>
</html>
