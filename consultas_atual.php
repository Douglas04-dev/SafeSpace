<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SaveSpace</title>
    <link rel="shortcut icon" href="Imagens/logo3.png" />
    <link rel="stylesheet" href="estilo.css" />
    <link rel="stylesheet" href="consultas_atual.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css"
    />
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo">
            <a href="#">
                <img src="Imagens/logo3.png" alt="" />
            </a>
        </div>

        <ul class="links">
            <li><a href="index.php">Página Inicial</a></li>
            <li><a href="consultas_atual.php">Consultas</a></li>
            <li><a href="#">Sobre Nós</a></li>
        </ul>

        <div class="user-menu">
            <img
              src="Imagens/circle-user-solid.svg"
              alt="Avatar do usuário"
              class="avatar"
              id="user-avatar"
            />
            <div class="dropdown" id="user-dropdown">
                <a href="perfil.php">Meu Perfil</a>
                <a href="#">Configurações</a>
                <a href="logout.php">Sair</a>
            </div>
        </div>
    </nav>

    <!-- CONTEÚDO -->
    <section id="tu" class="container">
        <h2 class="header">Profissionais</h2>
        <div class="features">

            <?php
            $sql = "SELECT idProfissional, nome, especialidade FROM profissionais";

            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <div class="profile-card">
                            <img src="Imagens/circle-user-solid.svg" alt="Foto do profissional" />
                            <h4>' . htmlspecialchars($row["nome"]) . '</h4>
                            <p>' . htmlspecialchars($row["especialidade"]) . '</p>
                            <a href="perfil_profissional.php?id=' . $row["idProfissional"] . '">
                                <button class="btn">Pesquisar</button>
                            </a>
                        </div>';
                    }
                } else {
                    echo "<p>Nenhum profissional encontrado.</p>";
                }
            } else {
                echo "<p>Erro na consulta: " . $conn->error . "</p>";
            }
            ?>

        </div>
    </section>

    <!-- FOOTER -->
    <footer id="con" class="container">
        <div class="column">
            <div class="log">
                <img src="Imagens/logo3.png" alt="" />
                <div class="so">
                    <a href="#"><i class="ri-youtube-line"></i></a>
                    <a href="#"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-whatsapp-line"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>Company</h4>
            <a href="#">Business</a>
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
            <a href="#">Política de Privacidade</a>
            <a href="#">Termos & Condições</a>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="script.js"></script>
    <script src="movimentacao.js"></script>

</body>
</html>
