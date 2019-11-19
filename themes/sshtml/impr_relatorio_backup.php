<!DOCTYPE html >
<html>
  <head>
    <meta charset="UTF-8"/>
    <style type="text/css">
      html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:5pt; background-color:white }
      a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
      a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
      div.comment { display:none }
      table { border-collapse:collapse; page-break-after:always }
      .gridlines td { border:1px solid black }
      /* .gridlines th { border:1px solid black } */
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style2 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:white }
      th.style2 { vertical-align:bottom; text-align:center; font-family:'Calibri'; font-size:8pt; background-color:white }
      td.style3 { vertical-align:bottom; text-align:center; font-family:'Calibri'; font-size:15pt; background-color:white }
      th.style3 { vertical-align:bottom; text-align:center; font-family:'Calibri'; font-size:15pt; background-color:white }
      td.style4 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:15pt; background-color:white }
      th.style4 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:15pt; background-color:white }
      td.style5 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:15pt; background-color:white }
      th.style5 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:15pt; background-color:white }
      table.sheet0 col.col0 { width:100pt }
      table.sheet0 col.col1 { width:150pt }
      table.sheet0 col.col2 { width:100pt }
      table.sheet0 col.col3 { width:100pt }
      table.sheet0 col.col4 { width:100pt }
      table.sheet0 col.col5 { width:100pt }
      table.sheet0 tr { height:20pt }
      table.sheet0 tr.row0 { height:20pt }
      table.sheet0 tr.row2 { height:20pt }
      table.sheet0 tr.row3 { height:20pt }
      table.sheet0 tr.row7 { height:20pt }
      table.sheet0 tr.row8 { height:20pt }
      .fundozinza-verde{
        background-color:#bee0ae !important;
      }
      .fundocinza{
        background-color:#dde3da !important;
      }
      body{
        	-webkit-print-color-adjust: exact !important;
          padding: 0 !important;
        	background-color: white;
          /* display: none; */
      }
      .letra-pesada{
        font-weight: 900 !important;
      }
      thead img{
        width:115.5px !important;
      }
      @media print{
        body{
          -webkit-print-color-adjust:exact;
          }
      }
      .fundo{
        background-color: #bee0ae !important;
      }
      .fundo_2{
        background-color: #dde3da !important;
      }
    </style>

  </head>

  <body>
    <?php


    $info = $_GET;

    $recibo =  $crud->query_p('
      SELECT r.*, c.nome
      FROM tb_recibo r
      INNER JOIN tb_contrato c ON c.id_contrato = r.id_contrato
      WHERE r.id_contrato = '.$info['id_contrato'].' AND data_hora BETWEEN "'.$info['ini'].' 00:00:00" AND "'.$info['fin'].' 23:59:59"
      ORDER BY r.data_hora DESC
    ');

    $contrato =$crud->pdo_src('contrato','where id_contrato='.$info['id_contrato'])[0];
    $valor = 0;


    // print_r($recibo)
     ?>
<style>
/* @page {  margin-right: 0.511811024in; margin-top: 0.787401575in; margin-bottom: 0.787401575in; }
body { margin-right: 0.511811024in; margin-top: 0.787401575in; margin-bottom: 0.787401575in; } */
</style>
<center>

    <table width=600 border="0" cellpadding="2" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">


        <thead>
          <tr>
        		<th class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; " colspan=3 height="35" align="center" valign=bottom><font size=5 color="#000000"><center>RELATÓRIO DE RECIBOS DETALHADO</center></font></th>
            <th class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000;  border-right: 1px solid #000000" colspan=1 height="35" align="center" valign=bottom><center><img src="themes/sshtml/img/logo.png" /></center></th>
        		</tr>
        	<tr>
        		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="21" align="left" valign=middle><font size=3 color="#000000">Contrato: <?= $contrato['nome'] ?></font></td>
        		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><font size=3 color="#000000">De: <?= implode("/",array_reverse(explode("-",$info['ini']))); ?></font></td>
        		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><font size=3 color="#000000">À: <?= implode("/",array_reverse(explode("-",$info['fin']))); ?></font></td>
        	</tr>
          <!-- <img style="width:10%;margin-bottom:10px;" src="themes/sshtml/img/logo.png" />
          <tr>
            <td class="column0 style3 s style3 fundozinza-verde letra-pesada" colspan="4">Relatório de Recibos Detalhado</td>
          </tr>
          <tr >
            <td class="column0 style3 s style3 fundozinza-verde letra-pesada" colspan="4" rowspan="2"><?= $contrato['nome'] ?></td>
          </tr> -->
        </thead>
        <tbody>

          <tr align="center" class="row4">

            <td style ="font-size:17px;"class="column1 style1 s"><b>Fornecedor</b></td>
            <td style ="font-size:17px;"class="column2 style1 s"><b>Controle</b></td>
            <td style ="font-size:17px;"class="column3 style1 s"><b>Nº nota</b></td>
            <td style ="font-size:17px;"class="column4 style1 s"><b>Valor</b></td>

          </tr>
<?php
$total=0;
foreach ($recibo as $index=>$key) {

  $data_h = implode("/",array_reverse(explode("-",explode(" ",$key['data_hora'])[0])));
  $data_h = strftime('%a,%d de %b de %Y', strtotime($data_h));
  if($index > 0){
    if(explode(" ",$recibo[$index-1]['data_hora'])[0] != explode(" ",$recibo[$index]['data_hora'])[0] ){
      echo'<tr class="fundocinza"><td align="center" style="font-size:14px;" colspan="4" class="column0"><b>'.utf8_encode($data_h).'</b></td></tr>';
    } else {
      echo'';
    }
}else {
  echo'<tr class="fundocinza"><td align="center" style="font-size:12px;" colspan="4" class="column0"><b><span>'.utf8_encode($data_h).'</span></b></td></tr>';
}

  $valor=0;

  for ($i=1; $i <= 10 ; $i++) {
    $valor += $key['val_servico_'.$i] * $key['servico_'.$i];
  }
    $total += $valor;

?>

<tr class="row5" align="center">
  <td class="column1" style="font-size:11px !important ;"><?= $key['fornecedor'] ?></td>
  <td class="column2" style="font-size:11px !important ;"><?= sprintf('%06d', $key['id']); ?></td>
  <td class="column3" style="font-size:11px !important ;"><?= $key['num_nota'] ?></td>
  <td class="column4" style="font-size:11px !important ; text-align: right;"><span style="float: left;">R$</span><?= number_format($valor,2,",",".")?></b></td></td>
</tr>
<?php
}
?>

          <tr class="row8">
            <td class=" style4 null"></td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="row7">
            <td class="column2 style3 s style3 fundozinza-verde " align="right" style=" border:1px solid #000 !important;" colspan="3" rowspan="2">Total</td>
            <td class="column2 style3 s style3 fundozinza-verde letra-pesada" style=" border:1px solid #000 !important;" colspan="1" rowspan="2">R$ <?= number_format($total,2,",",".")?></td>

          </tr>
        </tfoot>
    </table>
  </center>
  </body>
</html>
