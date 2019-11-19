<?php

$fds = array('fds'=>$_POST['fds']);

$fds = json_encode($fds);

$file = fopen('../_app/var.json', 'w');
fwrite($file, $fds);

?>
<script type="text/javascript">
alert("Acesso no Fim de Semana Configurado com sucesso!");
window.history.go(-1);
</script>
