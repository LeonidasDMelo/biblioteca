<style>
      body {

            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 1000px;
        }
.caixa-resultado {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgb(0, 0, 0);
            width: 300px;
            text-align: center;
        }
        .caixa {
            font-size: 22px;
            font-weight: bold;
            margin-top: 15px;
        }
         a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color:rgb(241, 183, 247);
        }
        </style>
         <div class="caixa-resultado">
<?php
require 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Verifica se o e-mail já está cadastrado
$verifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$verifica->bind_param("s", $email);
$verifica->execute();
$verifica->store_result();

if ($verifica->num_rows > 0) {
    echo "<div class='caixa'>E-mail já cadastrado.";
} else {
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "<div class='caixa'>Cadastro realizado com sucesso!";
    } else {
        echo "<div class='caixa'>Erro ao cadastrar usuário.";
    }
}
?>
<a href="index.html">Continuar➞</a>
</div>
