<?php
// feed_api.php – Lógica para carregar e publicar postagens
session_start();
require_once 'conexao.php'; // Conexão com o banco de dados

// Verificando se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    http_response_code(403);
    echo json_encode(["erro" => "Você precisa estar logado."]);
    exit;
}

// Verificando se é um profissional
$is_profissional = $_SESSION['is_profissional'] ?? false;

// Processa o POST (criar novo post)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se não for profissional, retorna erro
    if (!$is_profissional) {
        http_response_code(403);
        echo json_encode(["erro" => "Apenas profissionais podem publicar."]);
        exit;
    }

    // Recupera o conteúdo da postagem
    $dados = json_decode(file_get_contents('php://input'), true);
    $conteudo = $dados['conteudo'] ?? '';

    // Verifica se o conteúdo está vazio
    if (empty($conteudo)) {
        http_response_code(400);
        echo json_encode(["erro" => "Conteúdo não pode ser vazio."]);
        exit;
    }

    // Inserir a postagem no banco de dados
    $autor = $_SESSION['usuario_logado']['nome'];  // Nome do usuário logado
    $data = date('Y-m-d H:i:s'); // Data e hora atual

    // Query SQL para inserir o post
    $query = "INSERT INTO posts (autor, conteudo, data) VALUES (:autor, :conteudo, :data)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':autor'   => $autor,
        ':conteudo'=> $conteudo,
        ':data'    => $data,
    ]);

    // Retorna uma resposta de sucesso
    echo json_encode(["sucesso" => "Postagem criada com sucesso."]);
    exit;
}

// Processa o GET (carregar postagens)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Query SQL para pegar os posts mais recentes
    $query = "SELECT autor, conteudo, data FROM posts ORDER BY data DESC";
    $stmt = $pdo->query($query);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os posts em formato JSON
    echo json_encode($posts);
    exit;
}

// Se o método não for POST nem GET
http_response_code(405);
echo json_encode(["erro" => "Método não permitido."]);
