<?php

include "../../_app/Config.inc.php";

$info = $_GET;

    // print_r($info);

$crud->pdo_edit('despesa', $info, 'id');

?>

<?php if (isset($info['status']) && $info['status'] == '1') { ?>
  <script type="text/javascript">
  alert("Despesa faturada com sucesso!");
  </script>
<?php } else if (isset($info['status']) && $info['status'] == '2') { ?>
  <script type="text/javascript">
  alert("Despesa baixada com sucesso!");
  </script>
<?php } else { ?>
  <script type="text/javascript">
  alert("Despesa editada com sucesso!");
  </script>
<?php } ?>
