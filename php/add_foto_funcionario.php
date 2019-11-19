<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);


include "up_foto_funcionario.php";

//cadastra funcionario----------------
$crud->pdo_cadastro('foto_funcionario', $info);
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Foto cadastrada com sucesso!");
window.history.go(-1);
</script>
