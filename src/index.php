<?php
    require_once 'usuarios.php';
    $u = new Usuario;

    if(isset($_POST['email'])){
        $email  = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
    
        if(!empty($email) && !empty($senha)){
            $u->conectar("usuario", "mysql", "root", "abc123");
            if($u->msgError==""){
                if($u->logar($email, $senha)){
                    header("Location: listar.php");
                }else{
                    echo "Email e/ou senha estão incorretos!";
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
    </style>
</head>

<body>
    <div class="container">

        <div id="row-form" class="row">
            <h2>Login</h2>
            <form class="col s6" method="POST">
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
                <a>Ainda não é cadastrado? <strong><a href="cadastrar.php">Cadastre-se já!</a></strong></a>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="waves-effect waves-light btn" type="submit">Logar</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>