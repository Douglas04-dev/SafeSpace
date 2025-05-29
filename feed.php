<?php
// feed.php – página principal do feed
session_start();
require_once 'sessao.php'; // já redireciona caso não logado
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feed • Safespace</title>
  <link rel="stylesheet" href="css/feed.css">
</head>
<body>

<main class="feed-container">
  <!-- Formulário (mostrado apenas para profissionais via JS) -->
  <section id="novoPost" class="card" style="display:none;">
    <form id="postForm">
      <textarea name="conteudo" placeholder="Escreva algo…" required></textarea>
      <button type="submit">Publicar</button>
    </form>
  </section>

  <!-- Timeline -->
  <section id="timeline"></section>
</main>

<script>
// Função para verificar se o usuário é profissional
fetch('feed_api.php', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ _ping: true }) // Envia uma requisição vazia para saber se o usuário é profissional
})
  .then(r => r.status === 403 ? false : true) // Se a resposta for 403, significa que o usuário não é profissional
  .then(isProf => {
    if (isProf) {
      // Exibe o formulário de postagem para profissionais
      document.getElementById('novoPost').style.display = 'block';
    }
  });

// Função para carregar a timeline
async function carregar() {
  const res = await fetch('feed_api.php'); // Faz a requisição GET para carregar os posts
  const posts = await res.json(); // Recebe os posts em formato JSON
  const html = posts.map(p => `
    <article class="card post">
      <header><strong>${p.autor}</strong><small>${p.data}</small></header>
      <p>${p.conteudo.replace(/\n/g, '<br>')}</p>
    </article>`).join('');
  document.getElementById('timeline').innerHTML = html || '<p>Nenhuma publicação.</p>';
}

// Carrega a timeline quando a página é carregada
carregar();

// Função para publicar novo post
document.getElementById('postForm').addEventListener('submit', async e => {
  e.preventDefault();
  const conteudo = e.target.conteudo.value.trim(); // Pega o conteúdo do post
  if (!conteudo) return; // Se não houver conteúdo, não faz nada

  // Envia a requisição POST para criar um novo post
  const res = await fetch('feed_api.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ conteudo })
  });

  const data = await res.json();

  if (res.status === 200) {
    // Se a resposta for sucesso, recarrega os posts
    e.target.reset();
    carregar();
  } else {
    // Exibe a mensagem de erro se não for bem-sucedido
    alert(data.erro || "Erro ao publicar.");
  }
});
</script>

</body>
</html>
