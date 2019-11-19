<?php

include "../../_app/Config.inc.php";

$info = $_GET;

$recibos = $crud->query_p('
  SELECT r.*, c.nome
  FROM tb_despesa r
  INNER JOIN tb_contrato c ON c.id_contrato = r.id_contrato
  WHERE r.id_contrato = '.$info['contrato'] . ' AND data_hora BETWEEN "' . $info['ini'] . ' 00:00:00" AND "' . $info['fin'] . ' 23:59:59"
  ORDER BY r.data_hora DESC
');

// print_r($recibos);
$status = array(
    0 => "Em aberto",
    1 => "Faturada",
    2 => "Baixada"
);

?>

<style>
  .ponteiro{
    cursor: pointer;
  }
</style>

<table id="lista" class="table table-hover table-striped">
  <thead>
    <tr>
      <th>Data e Hora</th>
      <th>Fornecedor</th>
      <th>Status</th>
      <th>Val.</th>

    </tr>
  </thead>
  <tbody>
    <?php
    $val_tot = 0;
    foreach($recibos as $key){

        $data_h = implode("/",array_reverse(explode("-",explode(" ",$key['data_hora'])[0]))) . ", " . explode(" ",$key['data_hora'])[1];

        $val_t = 0;


        $val = "valor";
        $val_t += $key[$val];

        if($key['status']=="1"){
        $val_tot += $val_t;
        }

        echo "<tr>";

        echo "<td class='ponteiro' onclick='edita_despesa(".$key['id'].");'>".$data_h."</td>";
        echo "<td class='ponteiro' onclick='edita_despesa(".$key['id'].");'>".$key['fornecedor']."</td>";
        echo "<td class='ponteiro' onclick='edita_despesa(".$key['id'].");'>".$status[$key['status']]."</td>";
        echo "<td class='ponteiro' onclick='edita_despesa(".$key['id'].");'><b>R$".number_format($key['valor'],2,",",".")."</b></td>";


        // if ($key['status'] == 0){
        //   echo "<td class='ponteiro' onclick='edita_recibo(".$key['id'].");'>Em Aberto</td>";
        // } else if ($key['status'] == 1) {
        //   echo "<td class='ponteiro' onclick='edita_recibo(".$key['id'].");'>Faturado</td>";
        //
        // }else{
        //   echo "<td class='ponteiro' onclick='edita_recibo(".$key['id'].");'>Baixado</td>";
        // }



        echo "</tr>";

    }

    echo "<tr>";

    echo "<th colspan=7>&nbsp;</td>";

    echo "</tr>";

    echo "<tr>";

    echo "<th colspan=3>TOTAL</td>";
        echo "<th >R$".number_format($val_tot,2,",",".")."</td>";

    echo "</tr>";

    ?>
  </tbody>
</table>
