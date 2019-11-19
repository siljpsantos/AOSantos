<?php

include "../../_app/Config.inc.php";

$info = $_GET;

$crud->pdo_cadastro('recibo', $info);

$recibo = $crud->pdo_src('recibo', 'ORDER BY id DESC LIMIT 1')[0][0];

?>
<script type="text/javascript">
alert("Recibo cadastrado com sucesso!");
edita_recibo(<?= $recibo ?>);
</script>
