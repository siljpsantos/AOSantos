<?php

include "../../_app/Config.inc.php";

$info = $_GET;

// print_r($info);
if (@$info['motivo_baixa'] != '' && @$info['motivo_baixa'] != '<br>'){
  $info['status'] =2;
}
$crud->pdo_edit('recibo', $info, 'id');

?>

<?php if(isset($info['status']) && $info['status']=='1'){ ?>
  <script type="text/javascript">
  alert("Recibo faturado com sucesso!");
  </script>
<?php } else if(isset($info['status']) && $info['status']=='2'){ ?>
  <script type="text/javascript">
  alert("Recibo baixado com sucesso!");
  </script>
<?php }else{ ?>
  <script type="text/javascript">
  alert("Recibo editado com sucesso!");
  </script>
<?php } ?>
