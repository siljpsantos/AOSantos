<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);


include "up_doc_funcionario.php";

//cadastra funcionario----------------
$crud->pdo_cadastro('doc_funcionario', $info);
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Documento cadastrado com sucesso!");
window.history.go(-1);
</script>
