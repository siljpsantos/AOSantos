<?php

    include "../_app/Config.inc.php";

    $info = $_POST;

    $info['senha_usuario'] = crypt($info['senha_usuario'], 'inforway');

    $crud->pdo_cadastro('usuario', $info);

?>
<script type="text/javascript">
alert("Usuário cadastrado com sucesso!");
window.location.href='../ger_user';
</script>
