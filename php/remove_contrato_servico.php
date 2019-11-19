<?php

include "../_app/Config.inc.php";

$info = $_POST;

// echo "<pre>";
// print_r($info);
// exit();

//cadastra funcionario----------------
$crud->query_void('delete from tb_contrato_servico WHERE id = ' . $info['id']);
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Serviço removido com sucesso!");
window.history.go(-1);
</script>
