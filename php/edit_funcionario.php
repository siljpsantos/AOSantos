<?php

include "../_app/Config.inc.php";

$info = $_POST;

//echo "<pre>";
//print_r($info);

//cadastra MOV----------------
$crud->pdo_edit('funcionario', $info, 'id');
//fim------------------------------


//retorna para a lista
?>
<script type="text/javascript">
alert("Funcionário Atualizado com sucesso!");
window.location.href = "../edita_funcionario?id=<?= $info['id'] ?>";
</script>
