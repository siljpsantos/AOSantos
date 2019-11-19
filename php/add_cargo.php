<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);

$tabela = "cargo";

$fabr = $info['cargo'];

$dupl = $crud->pdo_src($tabela, "WHERE cargo LIKE '$fabr' ");
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
$crud->pdo_cadastro('cargo', $info);
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Cargo cadastrado com sucesso!");
window.location.href = "<?= "../lista_cargo" ?>";
</script>
