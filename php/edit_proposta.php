<?php
	
include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);

/*
@$contrato = $crud->pdo_src('contrato', 'WHERE id_proposta = '.$info['id'])[0];
if($contrato != array()){
	$crud->query_void('UPDATE tb_contrato SET id_proposta = 0 WHERE id_contrato = ' . $contrato['id_contrato']);
}
*/
//cadastra o aluno-----------------
$crud->pdo_edit('proposta', $info, 'id');
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
alert("Proposta atualizada com sucesso!");
window.location.href = "<?= "../edita_proposta?id=" . $info['id'] ?>";
</script>