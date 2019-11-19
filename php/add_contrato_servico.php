<?php

include "../_app/Config.inc.php";

$info = $_POST;

// echo "<pre>";
// print_r($info);
// exit();

$servico = $crud->pdo_src('servico', 'WHERE id = '.$info['id_servico']);
$info['val'] = $servico[0]['preco'];

//cadastra funcionario----------------
$crud->pdo_cadastro('contrato_servico', $info);
//fim------------------------------


//retorna para a lista
?>
<script type="text/javascript">
alert("Serviço registrado com sucesso!");
window.history.go(-1);
</script>
