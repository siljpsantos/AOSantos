<?php

include "../_app/Config.inc.php";

$info = $_GET;

//echo "<pre>";
//print_r($info);

//cadastra funcionario----------------
$crud->query_void('delete from tb_doc_proposta WHERE id = ' . $info['id']);
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Documento removido com sucesso!");
window.history.go(-1);
</script>