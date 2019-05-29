<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
    exit;
}
require_once 'usuarios.php';
$u = new Usuario;
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prova php</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        h1{
            text-align: center; 
        }
        #sair{
            float: right;
        }
    </style>
</head>
<body>
<div class="container">
<a id="sair" href="logout.php"><strong>Logout</strong></a>

    <h1>Egressos IFPB</h1>
<div class="row">
<?php
$u->conectar("usuario", "mysql", "root", "abc123");
$dados = $u->listarEgressos();
?>
<?php
foreach($dados as $dado){
    if($dado['avatar']!=NULL AND $dado['nome']!="Marcos Cesar Holanda dos Santos"){
        $img = "https://raw.githubusercontent.com/ifpb/egressos/master/img/egressos/".$dado['avatar']
?>   
    <div class="col s4 m3">
      <div class="card">
        <div class="card-image">
          <img src="<?php echo $img ?>">
        </div>
        <div class="card-content">
          <p><strong><?php echo $dado['nome'] ?></strong></p>
        </div>
        <div class="card-action">
        </div>
      </div>
    </div>
  
<?php
}
}
?>
</div>
</div>            
</body>
</html>