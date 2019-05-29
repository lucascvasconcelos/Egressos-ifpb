<?php
Class Usuario
{
    public $msgError = "";
    private $pdo;
    public function conectar($nome, $host, $usuario, $senha)
    {   
        global $msgError;
        global $pdo;
        try 
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host.";port:3306", $usuario, $senha);
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
            echo $msgError;
        }
    }
    public function cadastrar($nome, $email, $senha)
    {
        global $pdo;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount()>0){
            return false;
        }else{
            $sql = $pdo->prepare(
                "INSERT INTO usuarios(nome, email, senha) VALUES (:n,:e, :s)"
            );
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", $senha);
            $sql->execute();
            return true;
        }
    }
    public function logar($email, $senha)
    {
        global $pdo;
        $sql = $pdo->prepare(
            "SELECT id FROM usuarios WHERE
            email = :e AND senha = :s"
        );
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", $senha);
        $sql->execute();
        if($sql->rowCount()>0){
            
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true;
        }else{
            return false;
        }
    }
    

    public function cadastrarEgressos($mat, $nomeComp, $nome, $email, $linkedin, $curso, $campus, $avatar){
        global $pdo;
        $egresso = 1;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE matricula = :mat");
        $sql->bindValue(":mat", $mat);
        $sql->execute();
        if($sql->rowCount()>0){
            return false;
        }else{
            echo "kjasdh";
            $sql = $pdo->prepare(
                "INSERT INTO egressos(matricula, nomeCompactado, nome, email, 
                linkedin, curso, campus, egresso, avatar) 
                VALUES(:mat, :nomeComp, :nome, :email, :linkedin, :curso, :campus, :egresso, :avatar)"
                );
            $sql->bindValue(":mat", $mat);
            $sql->bindValue(":nomeComp", $nomeComp);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":linkedin", $linkedin);
            $sql->bindValue(":curso", $curso);
            $sql->bindValue(":campus", $campus);
            $sql->bindValue(":egresso", $egresso);
            $sql->bindValue(":avatar", $avatar);
            $sql->execute();
            return true;
        }
    }

    public function listarEgressos(){
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM egressos");
        $sql->execute();
        $dados = $sql->fetchALL(PDO::FETCH_ASSOC);
        return $dados;
    }
}    
?>