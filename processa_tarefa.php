<?php
// Dados de conexão
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_banco1";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Recebendo os dados do formulário e protegendo contra injeção SQL
$setor = $_POST['setor'];
$prioridade = $_POST['prioridade'];
$descricao = $_POST['descricao'];

// Preparando o comando SQL com prepared statements para evitar SQL Injection
$sql = $conn->prepare("INSERT INTO tbl_tarefas (tar_setor, tar_prioridade, tar_descricao, tar_status) 
                       VALUES (?, ?, ?, 'a fazer')");  // Atribuindo 'a fazer' como status padrão

// Ligando os parâmetros à consulta SQL
$sql->bind_param("sss", $setor, $prioridade, $descricao);

// Executando o comando SQL
if ($sql->execute()) {
    echo "Tarefa cadastrada com sucesso!";
} else {
    echo "Erro ao cadastrar tarefa: " . $sql->error;
}

// Fechando a conexão
$sql->close();
$conn->close();
?>
<a href="index.php">Voltar para a Tela Principal</a>
