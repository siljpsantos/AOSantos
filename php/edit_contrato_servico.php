<?php

include "../_app/Config.inc.php";

$info = $_POST;

// echo "<pre>";
// print_r($info);
// exit();

/*
@$contrato = $crud->pdo_src('contrato', 'WHERE id_proposta = '.$info['id'])[0];
if($contrato != array()){
	$crud->query_void('UPDATE tb_contrato SET id_proposta = 0 WHERE id_contrato = ' . $contrato['id_contrato']);
}
*/
//cadastra o aluno-----------------
$crud->pdo_edit('contrato_servico', $info, 'id');
//fim------------------------------

/*
if(@$info['id_contrato'] != ""){
	$crud->query_void('UPDATE tb_proposta SET id_contrato = 0 WHERE id_contrato = ' . $info['id_contrato'] . ' AND id != ' . $info['id']);
	$crud->query_void('UPDATE tb_contrato SET id_proposta = ' . $info['id'] . ' WHERE id_contrato = ' . $info['id_contrato']);
}
*/

//retorna para a lista
?>
<script type="text/javascript">
alert("Serviço atualizado com sucesso!");
window.location.href = "../edita_contrato?id=<?= $info['id_contrato'] ?>";
</script>
