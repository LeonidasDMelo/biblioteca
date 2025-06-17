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

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$ano = $_POST['ano_publicacao'];
$status = $_POST['status'];



// Inserir livro
$stmt = $conn->prepare("INSERT INTO livro (titulo, autor, editora, ano_publicacao) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $titulo, $autor, $editora, $ano);

if ($stmt->execute()) {
    $id_livro = $conn->insert_id;

    // Inserir exemplar
    $stmt2 = $conn->prepare("INSERT INTO exemplar (id_livro, status, localizacao) VALUES (?, ?, ?)");
    $localizacao = "não definido";
    $stmt2->bind_param("iss", $id_livro, $status, $localizacao);
    
    if ($stmt2->execute()) {
        $id_exemplar = $conn->insert_id;
        $codigo = "EX" . str_pad($id_exemplar, 5, "0", STR_PAD_LEFT);

        $conn->query("UPDATE exemplar SET codigo_exemplar = '$codigo' WHERE id_exemplar = $id_exemplar");

        echo "<div class='caixa'>Livro e exemplar cadastrados com sucesso. Código do exemplar: $codigo </div>";
    } else {
        echo "Erro ao cadastrar exemplar.";
    }
} else {
    echo "Erro ao cadastrar livro.";
}
?>
<a href="index.html">← Voltar</a>
</div>
