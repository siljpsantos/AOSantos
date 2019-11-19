<?php

    include "../_app/Config.inc.php";
    
    $info = $_POST;
	
    $usuario = $crud->pdo_src('usuario', 'WHERE id_usuario = ' . $info['id']);
	
    if ($usuario[0]['ativo_usuario'] == "1") {
        $status = "0";
    }else {
        $status = "1";
    }
	
    $crud->bloq_usuario($info['id'], $status);
	
?>
<script type="text/javascript">
alert("Usuário alterado com sucesso!");
window.location.href = "<?= "../ger_user" ?>";
</script>