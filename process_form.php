<?php
// Configurações do banco de dados
$host = 'localhost';
$db = 'meu_banco_de_dados';
$user = 'root';
$pass = '';

try {
    // Criação da conexão
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['name'];
        $email = $_POST['email'];
        $mensagem = $_POST['message'];

        // Prepara e executa a consulta
        $stmt = $pdo->prepare("INSERT INTO mensagens (nome, email, mensagem) VALUES (:nome, :email, :mensagem)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mensagem', $mensagem);
        
        // Executa a consulta
        if ($stmt->execute()) {
            // Redireciona para a página inicial após o envio
            header("Location: index.htm"); // Substitua 'index.php' pelo nome do seu arquivo da página inicial
            exit(); // Certifique-se de chamar exit após header
        } else {
            echo "Erro ao enviar a mensagem.";
        }
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
