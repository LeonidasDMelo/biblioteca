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
<a href="index.html">Continuar➞</a>
</div>
