<?php

include "../../_app/Config.inc.php";

$info = $_GET;

$crud->pdo_cadastro('despesa', $info);

$despesa = $crud->pdo_src('despesa', 'ORDER BY id DESC LIMIT 1')[0][0];

?>
<script type="text/javascript">
alert("Despesa cadastrada com sucesso!");
edita_despesa(<?= $despesa ?>);
</script>
