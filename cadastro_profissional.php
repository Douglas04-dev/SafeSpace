<?php
// Conexão com o banco de dados (ajuste os dados abaixo)
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "safespace";

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recebe os dados do formulário
  $nome = trim($_POST["nome"]);
  $email = trim($_POST["email"]);
  $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
  $crp = trim($_POST["crp"]);
  $cpf = trim($_POST["cpf"]);
  $data_nascimento = $_POST["data_nascimento"];
  $especialidade = trim($_POST["especialidade"]);
  $agenda_google = trim($_POST["agenda_google"]);

  // Prepara e executa a query
  $stmt = $conn->prepare("INSERT INTO profissionais (nome, email, senha, crp, cpf, data_nascimento, especialidade, agenda_google) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssss", $nome, $email, $senha, $crp, $cpf, $data_nascimento, $especialidade, $agenda_google);

  if ($stmt->execute()) {
    echo "<h2>Cadastro realizado com sucesso!</h2>";
    echo "<a href='login.html'>Ir para o login</a>";
  } else {
    echo "Erro ao cadastrar: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
