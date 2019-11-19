<script>
$("#baixar_btn").show();
  function mostrar_motivo(){
    $("#motivo_baixa").show();
    $("#baixar_btn").hide();
  }
</script>
<?php

include "../../_app/Config.inc.php";

$info = $_GET;

$despesa = $crud->pdo_src('despesa', 'WHERE id = '.$info['id'])[0];

$data_h = explode(" ",$despesa['data_hora'])[0] . "T" . explode(":",explode(" ",$despesa['data_hora'])[1])[0] . ":" . explode(":",explode(" ",$despesa['data_hora'])[1])[1];

$contratos = $crud->pdo_src('contrato','');

// print_r($info);

$dis = "";
if($despesa['status'] >= 1){
  $dis = "disabled";
}
echo'<script>$("#faturar_btn").show();</script>';
echo'<script>$("#motivo_baixa").hide();</script>';
$dis2 = "";
if($despesa['status'] == 2){
  $dis2 = "disabled";
  echo'<script>$("#baixar_btn").hide();</script>';
  echo'<script>$("#motivo_baixa").show();</script>';
}


$nobl ="block";
if($despesa['status'] >= 1){
  echo'<script>$("#faturar_btn").hide();</script>';
  $nobl="none";
}

// print_r($recibos);
$status = array(
  0 => "Em aberto",
  1 => "Faturada",
  2 => "Baixada"
);

$status_l = $status[$despesa['status']];

// print_r($despesa);

?>


<div class="modal-body">
  <div class="content">
    <form class="form-horizontal" role="form" id="edit_despesa" onsubmit="edita_despesa_mec(event);" >
      <input type="hidden" class="form-control" name="id" value="<?= $info['id'] ?>"/>
       <div class="row">
         <div class="col-md-3">
           <label>Data:</label>
           <input <?= $dis ?> required type="datetime-local" class="form-control" name="data_hora" value="<?= $data_h ?>"  />
         </div>
         <div class="col-md-3">
           <label>Fornecedor.:</label>
           <input <?= $dis ?> required type="text" class="form-control" name="fornecedor" value="<?= $despesa['fornecedor'] ?>"  />
         </div>

       <div class="col-md-3">
         <label>Contrato.:</label>
         <select disabled class="form-control" name="id_contrato" >
             <option></option>
             <?php
             foreach ($contratos as $key) {
                 $id = $key['id_contrato'];
                 $nome = $key['nome'];
                 if($id == $despesa['id_contrato']){
                   echo "<option selected value=$id>$nome</option>";
                 }

             }
             ?>
         </select>
       </div>

       <div class="col-md-3">
         <label>Valor:</label>
         <input <?= $dis ?> type="number" step=".01" class="form-control" name="valor" value="<?= $despesa['valor'] ?>"  />
       </div>
       <div class="col-md-12">
         <label>Despesa.:</label>
         <input <?= $dis ?> required type="text" class="form-control" name="despesa" value="<?= $despesa['despesa']  ?>"  />
       </div>
       <div class="col-md-3">
         <label>Status:</label>
         <input disabled type="text" class="form-control" value="<?= $status_l ?>"  />
       </div>


       <div class="col-md-12">&nbsp;</div>

       <div class="col-md-10"></div>

       <div class="col-md-2">
         <button <?= $dis2 ?> type="submit" class="btn btn-primary btn-block">Salvar</button>
       </div>
      </div>
    </form>
  </div>
 </div>
 <div class="modal-footer">


 </div>
