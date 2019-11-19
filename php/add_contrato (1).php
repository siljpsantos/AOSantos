<?php

include "../_app/Config.inc.php";

$info = $_POST;

//print_r($info);

$info['id_proposta'] = $info['id_prop_cli'];
unset( $info['id_prop_cli']);

// echo "<pre>";
// print_r($info);

$sql = 'INSERT INTO tb_contrato(
	id_responsavel, nome, num_contrato, ini, fim, contato, logradouro, bairro, cidade, estado, cep, claus_3, claus_4, claus_5, claus_6, claus_7, claus_8, claus_9, claus_10, id_proposta)
	VALUES
	(?,?,?,?,?,?,?,?,?,?,?,compress(?),compress(?),compress(?),compress(?),compress(?),compress(?),compress(?),compress(?),?)';

try {

	$prepara = $crud->pdo->prepare($sql);

	$controle = 1;
	foreach ($info as $index => $key) {
	    $prepara->bindParam($controle, $info[$index], PDO::PARAM_INT);
	    $controle += 1;
	}

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

//echo $controle;

$prepara->execute();

$id_contrato = $crud->query_p('SELECT * FROM tb_contrato ORDER BY id_contrato DESC LIMIT 1')[0][0];
$crud->query_void('UPDATE tb_proposta SET id_contrato = '.$id_contrato.' WHERE id = '.$info['id_proposta']);

//retorna para a lista
?>
<script type="text/javascript">
alert("Contrato cadastrado com sucesso!");
window.location.href = "<?= "../edita_contrato?id=".$id_contrato ?>";
</script>
