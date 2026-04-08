<?php require 'config.php';

$id = $_GET['id'] ?? '';


    if(empty($id)){
        header("location:index.php");
        exit();
    }

    if(!empty($_POST['nome']) && !empty($_POST['plataforma'])){
        $nome = $_POST['nome'];
        $plataforma = $_POST['plataforma'];
        $genero = $_POST['genero'];

        $sql = $db ->prepare("UPDATE jogos SET nome = :nome, plataforma = :plataforma, genero = :genero WHERE id = :id");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':plataforma', $plataforma);
        $sql->bindValue(':genero', $genero);
        $sql->bindValue(':id', $id);
        $sql->execute();
        header("location: index.php");
        exit();
    }

$sql = $db->prepare("SELECT * FROM jogos WHERE id = :id");
$sql->bindValue(':id', $id);
$sql->execute();

$info = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>controle de jogos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar" style="background-color: #0773ff;" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 mx-auto">CONTROLE DE JOGOS</span>
        </div>
    </nav>


    <div class="container mt-3">


        <h3>Editar</h3>


        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" value="<?= $info['nome'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">plataforma</label>
                <input type="text" class="form-control" name="plataforma" value="<?= $info['plataforma'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">genero</label>
                <input type="text" class="form-control" name="genero" value="<?= $info['genero'] ?>" required>
            </div>
            <button type="submit" class="btn btn-outline-info">Editar</button>
            <a href="index.php" class="btn btn-outline-primary">Voltar</a>
        </form>



    </div>

    <footer>
        <nav class="navbar">
            <div class="container-fluid">
                <span class="navbar mx-auto">&copy; Todos os direitos reservados</span>
            </div>
        </nav>
    </footer>


    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>