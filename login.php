<style>
      body {

             background-image: url(https://images6.alphacoders.com/104/thumb-1920-1041263.jpg);
          background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 1000px;
        }
.caixa-resultado {
            background: transparent;
            padding: 30px;
            border-radius: 12px;
           
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
            color:rgb(255, 255, 255);
        }
    
        </style>
         <div class="caixa-resultado">
<?php
require 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $conn->prepare("SELECT id, senha, nome FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($usuario = $resultado->fetch_assoc()) {
    if (password_verify($senha, $usuario['senha'])) {
        echo "Login realizado com sucesso. Bem-vindo, " . $usuario['nome'] . "!";
        // Aqui você pode iniciar sessão: session_start(), etc.
    } else {
        echo "<div class='caixa'>Senha incorreta.";
    }
} else {
    echo "<div class='caixa'>E-mail não encontrado.";
}
?>
<a href="porra.html">Continuar➞</a>
</div>
