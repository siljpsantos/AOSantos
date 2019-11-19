<?php

include "../_app/Config.inc.php";

$info = $_POST;

// echo "<pre>";
// print_r($info);
// exit();

//cadastra funcionario----------------
$crud->pdo_cadastro('funcionario_contrato', $info);
//fim------------------------------

$crud->query_void('UPDATE tb_funcionario SET id_contrato = ' . $info['id_contrato'] . ' WHERE id = ' . $info['id_funcionario']);

//retorna para a lista
?>
<script type="text/javascript">
alert("Funcionário reistrado com sucesso!");
window.history.go(-1);
</script>
