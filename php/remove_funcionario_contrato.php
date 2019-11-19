<?php

include "../_app/Config.inc.php";

$info = $_POST;

// echo "<pre>";
// print_r($info);
// exit();

//cadastra funcionario----------------
$crud->pdo_edit('funcionario_contrato', $info, 'id');
//fim------------------------------

$crud->query_void('UPDATE tb_funcionario SET id_contrato = 0 WHERE id = ' . $info['id_funcionario']);

//retorna para a lista
?>
<script type="text/javascript">
alert("Funcionário desalocado com sucesso!");
window.history.go(-1);
</script>
