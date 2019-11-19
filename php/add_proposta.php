<?php

include "../_app/Config.inc.php";

$info = $_POST;

$info['data_criacao'] = $info['data_att'] = date('Y-m-d');

//echo "<pre>";
//print_r($info);

//cadastra funcionario----------------
$crud->pdo_cadastro('proposta', $info);
//fim------------------------------

$ultima_proposta = $crud->pdo_src('proposta','ORDER BY id DESC LIMIT 1')[0];

//retorna para a lista
?>
<script type="text/javascript">
alert("Proposta cadastrada com sucesso!");
window.location.href = "<?= "../edita_proposta?id=" . $ultima_proposta['id'] ?>";
</script>

