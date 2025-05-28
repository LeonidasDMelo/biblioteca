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

        echo "Livro e exemplar cadastrados com sucesso!<br>Código do exemplar: <strong>$codigo</strong><br><a href='index.html'>Voltar</a>";
    } else {
        echo "Erro ao cadastrar exemplar: " . $conn->error;
    }

} else {
    echo "Erro ao cadastrar livro: " . $conn->error;
}

$conn->close();
?>
