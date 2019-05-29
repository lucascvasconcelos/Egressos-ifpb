<?php
    require_once 'usuarios.php';
    $u = new Usuario;
    $json_file = file_get_contents(
        "https://raw.githubusercontent.com/ifpb/egressos/master/data/egressos.json"
    );
    $egressos = json_decode($json_file);
    $u->conectar("usuario", "mysql", "root", "abc123");

    foreach($egressos as $e){
        $u->cadastrarEgressos(
            $e->id,
            $e->nomeCompactado,
            $e->nome,
            $e->email,
            $e->linkedin,
            $e->curso,
            $e->campus,
            $e->avatar
        );
    }
?>