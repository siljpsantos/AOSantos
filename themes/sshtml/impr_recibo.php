 <?php

    $encoding = mb_internal_encoding();

    date_default_timezone_set('America/Sao_Paulo');
    $data_atual = date('Y-m-d');

    $info = $_GET;

    $recibo = $crud->pdo_src('recibo', 'WHERE id = '.$info['id'])[0];
    $contrato = $crud->pdo_src('contrato', 'WHERE id_contrato = '.$recibo['id_contrato'])[0];

    $val_t = 0;
    for($i=1;$i<=10;$i++){
    $qtd = "servico_$i";
    $val = "val_servico_$i";
    $val_t += $recibo[$qtd] * $recibo[$val];
    }
    $val_t = number_format($val_t,2,",",".");

    date_default_timezone_set('America/Sao_Paulo');
    $hoje = strftime('%d de %B de %Y', strtotime('today'));

?>
<div style="position: fixed; z-index: 1000; width: 100%; height: 100%; background-color: white;">
</div>
<style>
p{
  margin:5px;
  font-size: 18px;
}
body{
	-webkit-print-color-adjust: exact !important;
	padding: 0 !important;
	background-color: white;
  display: none;
}
aside {
  display: none !important;
}
	@media print {

		.pace {
			display: none;
		}

		#tudo_t{
			display: block;
		}

		@page {padding: 0;margin: 50px;}
		#footer{display: none !important;}
		#titulo_num{color: #ccc !important; font-size: 16pt !important;}
		#menu_esconder{display: none !important; height: 0 !important;}
		/* div{
			page-break-before: always;
			page-break-inside: avoid;
		} */
	}
	#footer{display: none; height: 0 !important;}
	#menu_esconder{display: none;}
	body {
		margin: 0 !important;
		padding: 0 !important;
		zoom: 80%;
    display:block;
	}
	thead{
  display:table-header-group;/*repeat table headers on each page*/
  position:fixed;
  top:0px;
  left:400px;
}
tbody{
  display:table-row-group;
}
tfoot{
  display:table-footer-group;/*repeat table footers on each page*/
  position:fixed;
  left:300px;
  bottom:0px;
}
.rotate {
  transform: rotate(-45deg) translate(-70px, -65px);
  width: 30px;
  margin: 0px;
  white-space: nowrap;
  vertical-align: bottom;
  text-align: left;

}
.divider{
  border-right: 1px dashed black;
  padding-right: 5px;
}
</style>



<body>

  <center>
    <img style="width: 200px;" class="nav_logo" src="./themes/sshtml/img/logo_norm.png">
    <br/>
    <b>CNPJ: 06.329.862/0001-49</b>

    <br/><br/>

    RECIBO N°
    <br/>
    <span style="font-size: 16pt;"><?= sprintf('%06d', $recibo['id']); ?></span>
    <br/>
    <b>VALOR: R$<?= $val_t ?></b>

    <br/><br/>

    Recebi(emos) de <?= $recibo['fornecedor'] ?>,
    <br/>
    A importância de: R$<?= $val_t ?>
    <br/>
    Referente à descarga: <?= $contrato['nome'] ?>
    <br/>
    Placa do veículo: <?= $recibo['placa'] ?>

    <br/><br/>

    Serviços registrados:
    <br><br>

    <style>
    table tr td{
      border: 1px solid black;
      padding: 3px;
      font-size: 8pt;
    }
    </style>

    <table style="border: 1px solid black;">
      <?php
        $servicos = array();
        for($i=1;$i<=10;$i++){
        if($recibo['servico_'.$i] != 0){
            $servicos[] = $i;
        }
        }
        $servicos = implode(",",$servicos);

        $servicos_t = $crud->pdo_src('servico', "");

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

            echo "<tr><td width=270>" . $servico_txt . "</td><td align=center width=50>x" . $recibo[$label] . "</td></tr>";

        }
        }

        if($serv==false){
        echo "<tr><td align=center width=320 >Nenhum Serviço Registrado</td></tr>";
        }

        ?>
    </table>

    <br/>
    Para os devidor efeitos, firmo(amos) o presente.
    <br/><br/>
    Rio de Janeiro, <?= $hoje ?>, <?= date('H:i:s') ?>.

    <?php
    if ($recibo['status'] == 2) {
    ?>
    <br/><br/>
    RECIBO BAIXADO <br><br> Motivo:
    <?php
    echo $recibo['motivo_baixa'];
    }
    ?>

    <br/><br/><br/><br/>

    ___________________________________<br/>
    Nome do Responsável

    <br/><br/><br/><br/>

    ___________________________________<br/>
    Ass. do Responsável

  </center>

</body>


<script>
function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}
sleep(600).then(() => {
  window.print();
  window.close();
});
</script>
