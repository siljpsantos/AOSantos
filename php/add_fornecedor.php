<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);

//cadastra funcionario----------------
$crud->pdo_cadastro('fornecedor', $info);
//fim------------------------------

$id = $crud->query_p('SELECT id FROM tb_fornecedor ORDER BY id DESC LIMIT 1')[0][0];

//retorna para a lista
?>
<script type="text/javascript">
alert("Fornecedor cadastrado com sucesso!");
window.location.href = "<?= "../edita_fornecedor?id=$id" ?>";
</script>
