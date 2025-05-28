<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
  <style>
        body {

            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 1000px;
        }
        .caixa-resultado {
            color: rgb(0, 0, 0);
            background: rgb(255, 255, 255);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 10px 10px 12px rgb(0, 0, 0);
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
            text-decoration: underline;
            color:rgb(0, 0, 0);
        }
    </style>
 <div class="caixa-resultado">
<?php


$host = 'localhost';        // normalmente é 'localhost'
$usuario = 'root';          // padrão no XAMPP ou WAMP
$senha = '';                // deixe vazio se não tiver senha
$banco = 'biblioteca';      // nome do seu banco de dados

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se deu erro na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// opcional: define charset para evitar problemas com acentos
$conn->set_charset("utf8");


// Dados do livro
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$ano = $_POST['ano_publicacao'];

// Insere o livro
$sqlLivro = "INSERT INTO Livro (titulo, autor, editora, ano_publicacao)
             VALUES ('$titulo', '$autor', '$editora', '$ano')";

if ($conn->query($sqlLivro) === TRUE) {
    $id_livro = $conn->insert_id; // Pega o ID do livro recém-inserido

    // Primeiro, insere o exemplar SEM o código
    $sqlExemplar = "INSERT INTO Exemplar (id_livro, status, localizacao)
                    VALUES ($id_livro, 'disponível', 'não definido')";

    if ($conn->query($sqlExemplar) === TRUE) {
        $id_exemplar = $conn->insert_id;

        // Gera código baseado no ID do exemplar
        $codigo = 'EX' . str_pad($id_exemplar, 5, '0', STR_PAD_LEFT);

        // Atualiza o exemplar com o código gerado
        $sqlUpdate = "UPDATE Exemplar SET codigo_exemplar = '$codigo' WHERE id_exemplar = $id_exemplar";
        $conn->query($sqlUpdate);
 
        echo "<div class='caixa'>Livro e exemplar cadastrados com sucesso!<br>Código do exemplar: <strong>$codigo</strong><br><a href='index.html'> « Voltar</a>";
    } else {
        echo "<div class='caixa'> Erro ao cadastrar exemplar: </div>" . $conn->error;
    }

} else {
    echo "Erro ao cadastrar livro: " . $conn->error;
}

$conn->close();
?> </div>
