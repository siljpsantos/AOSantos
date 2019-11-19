<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);

$ok = 0;
include "up_doc_proposta.php";

if($info['ass']==1){
    $crud->query_void('UPDATE tb_proposta set ass = 1 WHERE id = '.$info['id_proposta']);
}

//cadastra funcionario----------------
if($ok = 1){
    $crud->pdo_cadastro('doc_proposta', $info);
}
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Documento cadastrado com sucesso!");
window.history.go(-1);
</script>

