<?php


$host = 'localhost';       
$usuario = 'root';         
$senha = '';              
$banco = 'biblioteca';    

$conn = new mysqli($host, $usuario, $senha, $banco);


if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}


$conn->set_charset("utf8");



$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$ano = $_POST['ano_publicacao'];


$sqlLivro = "INSERT INTO Livro (titulo, autor, editora, ano_publicacao)
             VALUES ('$titulo', '$autor', '$editora', '$ano')";

if ($conn->query($sqlLivro) === TRUE) {
    $id_livro = $conn->insert_id;

   
    $sqlExemplar = "INSERT INTO Exemplar (id_livro, status, localizacao)
                    VALUES ($id_livro, 'disponível', 'não definido')";

    if ($conn->query($sqlExemplar) === TRUE) {
        $id_exemplar = $conn->insert_id;

      
        $codigo = 'EX' . str_pad($id_exemplar, 5, '0', STR_PAD_LEFT);

       
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
