<?php

include "../../_app/Config.inc.php";

$info = $_GET;

$recibo = $crud->pdo_src('recibo', 'WHERE id = '.$info['id_recibo'])[0];

$servico = $crud->pdo_src('servico', 'WHERE id = '.$info['id_servico'])[0];
$servico_contrato = $crud->pdo_src('contrato_servico', 'WHERE id_contrato = '.$recibo['id_contrato'].' AND id_servico = '.$info['id_servico']);

if($servico_contrato == array()){
    $valor = $servico['preco'];
}else{
    $valor = $servico_contrato[0]['val'];
}

$crud->query_void('UPDATE tb_recibo SET
  servico_'.$info['id_servico'].' = '.$info['qtd'].',
  val_servico_'.$info['id_servico'].' = '.$valor.'
  WHERE id = '.$info['id_recibo']);

?>
