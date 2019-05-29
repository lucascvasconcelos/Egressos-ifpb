<?php
    require_once 'usuarios.php';
    $u = new Usuario;
?>
<?php
    if(isset($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $email  = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
    
        if(!empty($nome) && !empty($email) && !empty($senha)){
            $u->conectar("usuario", "mysql", "root", "abc123");
            if($u->msgError == ""){
                if($u->cadastrar($nome, $email, $senha)){
                    header("Location: index.php");
                    echo "Cadastrado com sucesso!!";
                }else{
                    echo "Email já cadastrado";
                }
            }else{
                echo "Erro: ".$u->msgError;
            }
        }else{
            echo "Preencha todos os campos!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prova-php</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body{
            background-image: url('img3.jpg');
        }
        #row-form{
            display: flex;
            flex-direction: column; 
        }
        form{
            margin: auto;   
        }
        h2{
            text-align: center;
        }
        .btn{
            float: right;
        }
        strong{
            margin-top: 40px;
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <strong><a href="index.php">Fazer login</a></strong>

        <div id="row-form" class="row">
            <h2>Cadastrar</h2>
            <form class="col s6" method="POST">
            <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="nome"  type="text" class="validate" name="nome">
                        <label for="nome">Nome</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                    <i class="material-icons prefix">alternate_email</i>
                        <input id="email" type="email" class="validate" name="email">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                    <i class="material-icons prefix">fingerprint</i>

                        <input id="password" type="password" class="validate" name="senha">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="waves-effect waves-light btn" type="submit">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>