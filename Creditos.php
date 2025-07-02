<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://unpkg.com/scrollreveal"></script>

  <title>Safe Space</title>
  <link rel="shortcut icon   " href="Imagens/logo3.png">


</head>
<body class="pagina-creditos">
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
  

 
 
  <main class="conteudo-creditos">
    <section class="container-creditos">

  <h1>🫂 Sobre o SafeSpace</h1>

      
<h3 class="titulo-secundario">
  História da Criação e Desenvolvimento do SafeSpace
</h3>

<p>
  A ideia do <strong>SafeSpace</strong> surgiu a partir de uma necessidade real: oferecer um ambiente digital seguro e empático para pessoas que convivem com a timidez, a ansiedade social e a dificuldade de se expressar livremente. Com isso em mente, iniciamos o projeto com o objetivo de unir <strong>tecnologia</strong> e <strong>acolhimento</strong> em uma só plataforma.
</p>

<p>
  O desenvolvimento começou em sala de aula, como parte de um projeto técnico, mas logo ganhou um significado maior. Queríamos criar mais do que um sistema — queríamos criar um espaço que pudesse realmente impactar vidas. Durante o processo, aplicamos conhecimentos em <strong>HTML, CSS, JavaScript, PHP e MySQL</strong>, sempre com foco em acessibilidade, leveza e funcionalidade.
</p>

<p>
  A jornada envolveu planejamento, estruturação de banco de dados, desenvolvimento de páginas como login, registro, painel do usuário, relatórios e a própria seção de créditos. Também pensamos com carinho em cada detalhe visual e textual, para que tudo transmitisse empatia e confiança.
</p>

<p>
  Mais do que um simples projeto, o SafeSpace representa uma construção coletiva de propósito e sensibilidade, que mostra como a tecnologia pode ser usada para criar ambientes de apoio, conexão e transformação pessoal.
</p>

<section class="missao-visao-valores">
  <h2> Nossa Missão</h2>
  <p>Proporcionar um ambiente seguro, acolhedor e tecnológico para que cada pessoa possa se expressar com liberdade e confiança.</p>

  <h2> Nossa Visão</h2>
  <p>Ser uma plataforma referência em apoio emocional e desenvolvimento pessoal digital.</p>

  <h2> Nossos Valores</h2>
  <ul>
    <li>Empatia</li>
    <li>Segurança</li>
    <li>Inclusão</li>
    <li>Respeito</li>
    <li>Privacidade</li>
  </ul>
</section>

<section class="tecnologias">
  <h2>Tecnologias Usadas</h2>
  <ul class="lista-tecnologias">
    <li><i class="ri-html5-fill"></i> HTML5</li>
    <li><i class="ri-css3-fill"></i> CSS3</li>
    <li><i class="ri-javascript-fill"></i> JavaScript</li>
    <li><i class="ri-database-2-line"></i> MySQL</li>
    <li><i class="ri-code-s-slash-line"></i> PHP</li>
  </ul>
</section>


<div class = autores>
      <h2>👥 Créditos do Projeto</h2>

      <ul>
        <li>Rafael Vargas Brandão</li>
        <li>Eduarda Brandão</li>
        <li>Douglas De almeida</li>
      </ul>
    </div>
 
    
     
      

      <blockquote>
        “Você não precisa mudar quem é. Só precisa se sentir seguro para ser você.” 
      </blockquote>
    </section>
  </main>

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
</body>
</html>
