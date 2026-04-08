<?php require 'config.php';
//   $nome = trim($_POST['nome'] ?? '');
//         $email = trim($_POST['email']?? '');

//     if(!empty('$nome') && !empty($email)){


//         $sql = $db ->prepare("INSERT INTO contatos (nome,email) VALUES (:nome, :email)");
//         $sql -> bindValue(':nome',$nome);
//         $sql -> bindValue(':email',$email);
//         $sql ->execute();
//         header("location: index.php");
//         exit;
//     }
$nome = trim($_POST['nome'] ?? '');
$plataforma = trim($_POST['plataforma'] ?? '');
$genero = trim($_POST['genero'] ?? '');
$error = '';



if (!empty('$nome') && !empty($plataforma)) {

    //if (filter_var($nome, FILTER_VALIDATE_DOMAIN)) 

        $check = $db->prepare("SELECT id FROM jogos WHERE nome = :nome");
        $check->bindValue('nome', $nome);
        $check->execute();


        if ($check->rowCount() === 0) {

            $sql = $db->prepare("INSERT INTO jogos(nome,plataforma,genero) VALUES (:nome, :plataforma, :genero)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':plataforma', $plataforma);
            $sql->bindValue(':genero', $genero);
            $sql->execute();
            header("location: index.php");
            exit;
        } else {
            $error = 'Esse jogo já está cadastrado!';
        }
    
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Contatos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

   <nav class="navbar" style="background-color: #0773ff;" data-bs-theme="dark">
   
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 mx-auto">CONTROLE DE JOGOS</span>
        </div>
    </nav>


    <div class="container mt-3">
        


        <?php if ($error): ?>
            <div class="alert alert-warning"><?= $error; ?></div>
        <?php endif; ?>



        <h3>Adicionar</h3>


        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nome Jogo:</label>
                <input type="text" class="form-control" name="nome"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Plataforma:</label>
                <input type="text" class="form-control" name="plataforma"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gênero:</label>
                <input type="text" class="form-control" name="Gênero"
                    required>
            </div>
            <button type="submit" class="btn btn-outline-info">adicionar</button>
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

<script>
        const alertMsg = document.getElementById('alert-msg');
        
        if(alertMsg){
            setTimeout(() =>{
                alertMsg.style.display = 'none';
            }, 3000);
        }

    </script>

    
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>