<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);

$tabela = "servico";

$fabr = $info['servico'];

$dupl = $crud->pdo_src($tabela, "WHERE servico LIKE '$fabr' ");
//print_r($dupl);

if($dupl != array()){
	?>
	<script type="text/javascript">
	alert("Duplicidade encontrada! por favor verifique se o item desejado já se encontra cadastrado.");
	window.history.go(-1);
	</script>
	<?php
	die();
}

//cadastra funcionario----------------
$crud->pdo_cadastro('servico', $info);
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Serviço cadastrado com sucesso!");
window.location.href = "<?= "../lista_servico" ?>";
</script>
