<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);


//cadastra funcionario----------------
$crud->pdo_cadastro('equip_ti', $info);
//fim------------------------------

$id_prop = $crud->pdo_src('equip_ti', 'ORDER BY id DESC LIMIT 1')[0][0];

//retorna para a lista
?>
<script type="text/javascript">
alert("Equipamento cadastrado com sucesso!");
window.location.href = "../edita_equip_ti?id=<?= $id_prop ?>";
</script>
