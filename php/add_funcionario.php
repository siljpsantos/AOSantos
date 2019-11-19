<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);


//cadastra funcionario----------------
$crud->pdo_cadastro('funcionario', $info);
//fim------------------------------

$id_prop = $crud->pdo_src('funcionario','ORDER BY id DESC LIMIT 1')[0][0];

//retorna para a lista
?>
<script type="text/javascript">
alert("Funcionário cadastrado com sucesso!");
window.location.href = "../edita_funcionario?id=<?= $id_prop ?>";
</script>
