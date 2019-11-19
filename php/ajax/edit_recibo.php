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

$recibo = $crud->pdo_src('recibo', 'WHERE id = '.$info['id'])[0];

$data_h = explode(" ",$recibo['data_hora'])[0] . "T" . explode(":",explode(" ",$recibo['data_hora'])[1])[0] . ":" . explode(":",explode(" ",$recibo['data_hora'])[1])[1];

$contratos = $crud->pdo_src('contrato', 'WHERE id_responsavel = '.$_SESSION['id_usuario']);

$servicos = array();
for($i=1;$i<=10;$i++){
    if($recibo['servico_'.$i] != 0){
    $servicos[] = $i;
    }
}
$servicos = implode(",",$servicos);

$servicos_t = $crud->pdo_src('servico', "");

if($servicos != ""){
    $servicos = $crud->pdo_src('servico', "WHERE id NOT IN ($servicos)");
}else{
    $servicos = $crud->pdo_src('servico', "");
}

$dis = "";
if($recibo['status'] >= 1){
    $dis = "disabled";
}
echo'<script>$("#faturar_btn").show();</script>';
echo'<script>$("#motivo_baixa").hide();</script>';
$dis2 = "";
if($recibo['status'] == 2){
    $dis2 = "disabled";
    echo'<script>$("#baixar_btn").hide();</script>';
    echo'<script>$("#motivo_baixa").show();</script>';
}

$nobl ="block";
if($recibo['status'] >= 1){
    echo'<script>$("#faturar_btn").hide();</script>';
    $nobl="none";
}

// print_r($recibos);
$status = array(
    0 => "Em aberto",
    1 => "Faturado",
    2 => "Baixado"
);

$status_l = $status[$recibo['status']];

// print_r($recibo);

?>


<div class="modal-body">
  <div class="content">
    <form class="form-horizontal" role="form" id="edit_recibo" onsubmit="edita_recibo_mec(event);" >
      <input type="hidden" class="form-control" name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>"/>.
      <input type="hidden" class="form-control" name="id" value="<?= $info['id'] ?>"/>
       <div class="row">
         <div class="col-md-3">
           <label>Data:</label>
           <input <?= $dis ?> required type="datetime-local" class="form-control" name="data_hora" value="<?= $data_h ?>"  />
         </div>
         <div class="col-md-3">
           <label>Fornecedor.:</label>
           <input <?= $dis ?> required type="text" class="form-control" name="fornecedor" value="<?= $recibo['fornecedor'] ?>"  />
         </div>
       <!-- <div class="col-md-3">
         <label>Endereço.:</label>
         <input <?= $dis ?> required type="text" class="form-control" name="endereco" value="<?= $recibo['endereco']  ?>"  />
       </div> -->
       <div class="col-md-3">
         <label>Contrato.:</label>
         <select style="width: 100%" disabled class="form-control" name="id_contrato" >
             <option></option>
             <?php
                foreach ($contratos as $key) {
                    $id = $key['id_contrato'];
                    $nome = $key['nome'];
                    if($id == $recibo['id_contrato']){
                    echo "<option selected value=$id>$nome</option>";
                    }

                }
                ?>
         </select>
       </div>
       <div class="col-md-3">
         <label>Placa:</label>
         <input <?= $dis ?> required type="text" class="form-control i-placa" name="placa" value="<?= $recibo['placa'] ?>"  />
       </div>
       <div class="col-md-3">
         <label>Numero da nota:</label>
         <input <?= $dis ?> type="text" class="form-control" name="num_nota" value="<?= $recibo['num_nota'] ?>"  />
       </div>
       <div class="col-md-3">
         <label>Status:</label>
         <input disabled type="text" class="form-control" value="<?= $status_l ?>"  />
       </div>
       <div class="col-md-12">
         <label>Produtos:</label>
         <textarea <?= $dis ?> required class="form-control" name="produtos" ><?= $recibo['produtos'] ?></textarea>
       </div>
       <div class="col-md-12 text-danger" id="motivo_baixa" >
         <label>Motivo da Baixa:</label>
         <textarea <?= $dis2 ?> class="form-control"  name="motivo_baixa"><?= $recibo['motivo_baixa'] ?></textarea>
       </div>
       <div class="col-md-12">&nbsp;</div>

       <div class="col-md-8"></div>
       <div class="col-md-2">
         <a target="_blank" id="faturar_btn" class="btn btn-block btn-warning" href="./impr_recibo?id=<?= $info['id']  ?>">Imprimir</a>
       </div>
       <div class="col-md-2">
         <button <?= $dis2 ?> type="submit" class="btn btn-primary btn-block">Salvar</button>
       </div>

       <div class="col-md-12 text-center">
         <br />
         <h2>Descrição de Serviços</h2>
         <br />
       </div>

       <?php
        $serv = false;
        for($i=1;$i<=10;$i++){

            $label = "servico_$i";
            $label_val = "val_servico_$i";
            if($recibo[$label] != '0'){

            foreach($servicos_t as $key){
                if($key['id'] == $i){
                $servico_txt = $key['servico'];
                }
            }
            $serv = true;

        ?>
        <div class="col-md-2 text-left">
          <input <?= $dis ?> class="form-control" type="number" step='1' name="servico_<?= $i ?>" value="<?= $recibo[$label] ?>" />
        </div>
        <div class="col-md-10">
          <input class="form-control" disabled value="<?= $servico_txt ?>"  />
        </div>
        <?php

            }
        }

        if($serv==false){
            ?>
         <div class="col-md-12">
           <input class="form-control" disabled value="Nenhum serviço registrado."  />
         </div>
        <?php
        }
        ?>

      </div>
    </form>
  </div>
 </div>
 <div class="modal-footer">

   <div class="row">

     <div class="col-md-8 text-left">
       <label>Serviço</label>
       <select <?= $dis ?> class="form-control" id="new_servico_slc">
         <option></option>
         <?php
            foreach ($servicos as $key) {
                $id = $key['id'];
                $nome = $key['servico'];
                echo "<option value=$id>$nome</option>";

            }
            ?>
       </select>
     </div>
     <div class="col-md-2 text-left">
       <label>QTD</label>
       <input <?= $dis ?> class="form-control" type="number" step='1' id="qtd_servico_input" />
     </div>
     <div class="col-md-1 text-left"></div>
     <div class="col-md-2 text-left">
        <label>&nbsp;</label>
       <button <?= $dis ?> onclick="add_servico(<?= $info['id'] ?>);" class="btn btn-primary btn-block">Adicionar</button>
     </div>
   </div>

 </div>
