<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);

//cadastra funcionario----------------
$crud->pdo_edit('fornecedor', $info, 'id');
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Fornecedor atualizado com sucesso!");
window.location.href = "../edita_fornecedor?id=<?= $info['id'] ?>";
</script>
