<?php

include "../_app/Config.inc.php";

$info = $_GET;

//echo "<pre>";
//print_r($info);

//cadastra funcionario----------------
$crud->query_void('delete from tb_foto_funcionario WHERE id = ' . $info['id']);
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Foto removida com sucesso!");
window.history.go(-1);
</script>
