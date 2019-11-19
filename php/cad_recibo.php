<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);


//cadastra funcionario----------------
$crud->pdo_cadastro('recibo', $info);
//fim------------------------------

$id_recibo = $crud->pdo_src('recibo', 'ORDER BY id DESC LIMIT 1')[0][0];

// //dados para o histórico
// unset($info['id_marca_equip_ti']);
// unset($info['id_modelo_equip_ti']);
// unset($info['id_categoria_equip_ti']);
// unset($info['cod']);
// unset($info['equip_ti']);
// unset($info['apelido']);
//
// $info['id_cliente'] = $id_prop;
//
// $crud->pdo_cadastro('hist_cliente', $info);

//retorna para a lista
?>
<script type="text/javascript">
alert("Recibo cadastrado com sucesso!");
window.location.href = "../edita_recibo?id=<?= $id_recibo ?>";
</script>
