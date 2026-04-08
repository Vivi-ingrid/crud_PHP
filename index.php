<?php require 'config.php';
 
$lista = $db->query("SELECT * FROM jogos")->fetchAll();
 
if(!empty($_GET['del'])){
    $id = $_GET['del'];
    $sql = $db->prepare("DELETE FROM jogos WHERE id = :id");
    $sql->bindValue(':id' , $id);
    $sql->execute();
    header("Location: index.php?msg=del_ok");
    exit;
}
 
?>
 
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de jogos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>
 
<body>
 
    <nav class="navbar" style="background-color: #0773ff;" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 mx-auto">CONTROLE DE JOGOS</span>
        </div>
    </nav>
 
 <div class="container">

 <?php
       
        if(isset($_GET['msg']) && $_GET['msg'] == 'add_ok'):
        ?>
 
        <div id="alert-msg" class="alert alert-success mt-4">Jogo adicionado!</div>
 
        <?php endif; ?>
 
        <?php
       
        if(isset($_GET['msg']) && $_GET['msg'] == 'del_ok'):
        ?>
 
        <div id="alert-msg" class="alert alert-danger mt-4">Jogo removido</div>
 
        <?php endif; ?>
 
        <a href="adicionar.php" class="btn btn-outline-info mt-3">Adicionar Jogo</a>
 
        <!-- listagem inicio -->
 
        <table class="table text_center table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th scope="col">Id_jogo</th>
                    <th scope="col">Nome_jogo</th>
                    <th scope="col">Plataforma</th>
                    <th scope="col">Genero</th>
                </tr>
            </thead>
            <tbody class="table-group-divider align-middle">
        <?php foreach($lista as $item):?>
 
                <tr>
                    <th scope="row"><?php echo $item["id"]; ?></th>
                    <td><?= $item['nome']; ?></td>
                    <td> <?= $item['plataforma'];?></td>
                    <td> <?= $item['genero'];?></td>
                    <td>
                            <a href="editar.php?id=<?= $item['id']; ?>" 
                            class="btn btn-outline-info">Editar</a>
                                <a href="index.php?del=<?= $item['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Excluir?')">Excluir</a>
 
                    </td>
                </tr>
 
                <?php endforeach; ?>
 
            </tbody>
        </table>
 
 
        <!-- listagem Final -->
 
 
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
    