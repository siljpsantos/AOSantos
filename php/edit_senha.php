<?php

    include "../_app/Config.inc.php";

    $info = $_POST;

    $usuario = $crud->pdo_src('usuario', 'WHERE id_usuario = ' . $info['id']);

    $info['nova'] = crypt($info['nova'],'inforway');
    $info['confirma'] = crypt($info['confirma'],'inforway');

    if ($info['nova'] == $info['confirma']) {

        $crud->edita_senha($info['id'], $info['nova']);

        echo ("<SCRIPT LANGUAGE='JavaScript'>
		    window.alert('Senha alterada com sucesso!');
		    window.location.href='../ger_user';
		    </SCRIPT>");

    }else {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
		    window.alert('Senhas não conferem!');
		    window.location.href='../ger_user';
		    </SCRIPT>");

    }

?>
