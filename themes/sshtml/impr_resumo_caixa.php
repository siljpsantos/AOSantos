 <?php

    $encoding = mb_internal_encoding();

    date_default_timezone_set('America/Sao_Paulo');
    $data_atual = date('Y-m-d');

    $info = $_GET;

    $contrato = $crud->pdo_src('contrato','WHERE id_contrato = '.$info['id_contrato'])[0];

    $func_contrato = $crud->query_p('
		SELECT
			COUNT(DISTINCT f.id)
		FROM
			tb_funcionario_contrato fc
			INNER JOIN tb_funcionario f ON f.id = fc.id_funcionario
		WHERE
			fc.id_contrato = '.$info['id_contrato'] . '
      AND
      data_hora_ini <= "'.$info['data_ini'] . ' 23:59:59"
      AND
      (data_hora_fin >= "'.$info['data_fin'] . ' 23:59:59" OR data_hora_fin = "0000-00-00 00:00:00")

	')[0][0];

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
table tr td{
  padding: 0 5px 0 5px;
}

.fundo{
  background-color: #bee0ae !important;
}
.fundo_2{
  background-color: #dde3da !important;
}
	@media print {


    body {-webkit-print-color-adjust:exact;}

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
		div{
			page-break-before: always;
			page-break-inside: avoid;
		}

	}
	#footer{display: none; height: 0 !important;}
	#menu_esconder{display: none;}
	body {
		margin: 0 !important;
		padding: 0 !important;
		zoom: 100%;
    display:block;
	}
	thead{
  display:table-header-group;/*repeat table headers on each page*/
}
tbody{
  display:table-row-group;
}
tfoot{
  display:table-footer-group;/*repeat table footers on each page*/
}
tbody tr td{
  font-size: 8pt;
}
</style>



<body>

  <center>

    <table width=601 cellspacing="0" border="0">
    	<colgroup width="131"></colgroup>
    	<colgroup span="3" width="168"></colgroup>
      <thead>
      	<tr>
      		<th class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; " colspan=3 height="35" align="center" valign=bottom><font size=5 color="#000000"><center>RESUMO DE CAIXA</center></font></th>
          <th class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000;  border-right: 1px solid #000000" colspan=1 height="35" align="center" valign=bottom><center><img style="width:70%;" src="themes/sshtml/img/logo.png" /></center></th>
      		</tr>
      	<tr>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="21" align="left" valign=middle><font size=3 color="#000000">Contrato: <?= $contrato['nome'] ?></font></td>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><font size=3 color="#000000">De: <?= implode("/", array_reverse(explode("-", $info['data_ini']))); ?></font></td>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><font size=3 color="#000000">À: <?= implode("/", array_reverse(explode("-", $info['data_fin']))); ?></font></td>
      	</tr>
      	<tr>
      		<td style="border: 0; " colspan=4 height="10" align="center" valign=middle><font size=1 color="#000000"></font></td>
      		</tr>
        <tr>
      		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="25" align="center" valign=middle><font size=4 color="#000000">Data</font></td>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><font size=4 color="#000000">Entradas</font></td>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><font size=4 color="#000000">Despesas</font></td>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><font size=4 color="#000000">Total do Dia</font></td>
      	</tr>
      </thead>
      <tbody>
        <?php

        function isWeekend($date) {
            return (date('N', strtotime($date)) >= 6);
        }

        $begin = new DateTime($info['data_ini']);
        $end = new DateTime($info['data_fin']);

        $tot_e = 0;
        $tot_d = 0;
        $tot_t = 0;
        $sim = true;
        $dias = "";
        $entradas = "";
        $saidas = "";
        for($i = $begin; $i <= $end; $i->modify('+1 day')){

            if($sim){
            $fundo = 'fundo_2';
            $sim = false;
            }else{
            $fundo = '';
            $sim = true;
            }

            $recibos = $crud->query_p('
            SELECT r.*, c.nome
            FROM tb_recibo r
            INNER JOIN tb_contrato c ON c.id_contrato = r.id_contrato
            WHERE r.id_contrato = '.$info['id_contrato'] . ' AND data_hora LIKE "%' . $i->format("Y-m-d") . '%"
              AND r.status = 1
            ORDER BY r.data_hora DESC
          ');

            $despesas = $crud->query_p('
            SELECT SUM(d.valor)
            FROM tb_despesa d
            INNER JOIN tb_contrato c ON c.id_contrato = d.id_contrato
            WHERE d.id_contrato = '.$info['id_contrato'].' AND d.data_hora LIKE "%'.$i->format("Y-m-d").'%"
              AND d.status = 1
            ORDER BY d.data_hora DESC
          ');

            $val_t_t = 0;
            foreach($recibos as $index=>$key){
            $val_t = 0;
            for($j=1;$j<=10;$j++){
                $qtd = "servico_$j";
                $val = "val_servico_$j";
                $val_t += $key[$qtd] * $key[$val];
            }
            $recibos[$index]['val_t'] = $val_t;
            $val_t_t += $recibos[$index]['val_t'];
            }

            $tot_dia = $val_t_t - $despesas[0][0];

            $tot_e += $val_t_t;
            $tot_d += $despesas[0][0];
            $tot_t += $tot_dia;

            // $dias .= "'".$i->format("d/m")."',";
            // $entradas .= $val_t_t == "" ? "0," : $val_t_t.",";
            // $saidas .= $despesas[0][0] == "" ? "0," : $despesas[0][0].",";

            $dia = strftime('%a', strtotime($i->format('Y-m-d')));

            if(utf8_encode($dia) != 'sáb' && $dia != 'dom'){

        ?>
        <tr>
          <td class="<?= $fundo ?>" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="10" align="center" valign=bottom ><font color="#000000"><?= $i->format('d/m/y') ?></font></td>
          <td class="<?= $fundo ?>" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><font color="#000000"><span style="float: left;">R$</span> <?= number_format($val_t_t,2,",",".") ?> </font></td>
          <td class="<?= $fundo ?>" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><font color="#000000"><span style="float: left;">R$</span> <?= number_format($despesas[0][0],2,",",".") ?> </font></td>
          <td class="<?= $fundo ?>" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font color="#000000"><span style="float: left;">R$</span> <?= number_format($tot_dia,2,",",".") ?> </font></b></td>
        </tr>
      <?php } else{ ?>
        <tr>
          <td colspan=4 class="<?= $fundo ?>" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="10" align="center" valign=bottom ><font color="#000000"><?= utf8_encode(strtoupper(strftime('%A', strtotime($i->format('Y-m-d'))))); ?></td>
        </tr>
      <?php }} ?>
      </tbody>
      <tr>
        <td style="border: 0; " colspan=4 height="10" align="center" valign=middle><font size=1 color="#000000"></font></td>
        </tr>
        <tfoot>
          <tr>
        		<td class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="20" align="left" valign=bottom sdnum="1033;1033;M/D/YYYY"><font color="#000000">Totais</font></td>
        		<td class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><font color="#000000"><span style="float: left;">R$</span> <?= number_format($tot_e, 2, ",", ".") ?> </font></td>
        		<td class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><font color="#000000"><span style="float: left;">R$</span> <?= number_format($tot_d, 2, ",", ".") ?> </font></td>
        		<td class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font color="#000000"><span style="float: left;">R$</span> <?= number_format($tot_t, 2, ",", ".") ?> </font></b></td>
        	</tr>
          <tr>
            <td ></td>
            <td ></td>
            <td align=right><b>Percent. Total (<?= number_format($contrato['percent'], 0, "", "") ?>%)</b></td>
            <td class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font color="#000000"><span style="float: left;">R$</span> <?= number_format($tot_t * ($contrato['percent'] / 100), 2, ",", ".") ?> </font></b></td>
          </tr>
          <tr>
            <td ></td>
            <td ></td>
            <td align=right><b>Qtd. Func.</b></td>
            <td class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font color="#000000"><?= $func_contrato ?></font></b></td>
          </tr>
          <tr>
            <td ></td>
            <td ></td>
            <td align=right><b>Valor Por Func.</b></td>
            <td class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font color="#000000"><span style="float: left;">R$</span> <?= number_format(($tot_t * ($contrato['percent'] / 100)) / $func_contrato, 2, ",", ".") ?></font></b></td>
          </tr>
        </tfoot>
    </table>

    <!-- <table width=601 cellspacing="0" border="0">
    	<colgroup width="131"></colgroup>
    	<colgroup span="3" width="168"></colgroup>
      <tbody>
        <tr>
          <td colspan=4>
            <div style="width: 100%; height: 500px; padding: 10px;">
              <canvas id="pie-chart"></canvas>
            </div>
            </center>
            <script>
            Chart.plugins.register({
            afterDatasetsDraw: function(chart, easing) {
                // To only draw at the end of animation, check for easing === 1
                var ctx = chart.ctx;

                chart.data.datasets.forEach(function (dataset, i) {
                    var meta = chart.getDatasetMeta(i);
                    if (!meta.hidden) {
                        meta.data.forEach(function(element, index) {
                            // Draw the text in black, with the specified font
                            ctx.fillStyle = 'rgb(0, 0, 0)';

                            var fontSize = 14;
                            var fontStyle = 'normal';
                            var fontFamily = 'Arial';
                            ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                            // Just naively convert to string for now
                            var dataString = dataset.data[index].toString();

                            // Make sure alignment settings are correct
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';

                            var padding = 5;
                            var position = element.tooltipPosition();
                            ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                        });
                    }
                });
            }
            });
            new Chart(document.getElementById("pie-chart"), {
            type: 'line',
            data: {
            labels: [<?= $dias ?>],
            datasets: [{
              label: "Receitas",
              backgroundColor: "#2f75b5",
              borderColor: "#2f75b5",
              fill: false,
              data: [<?= $entradas ?>],
              datalabels: {
                align: 'end',
                anchor: 'end'
              }
            },{
              label: "Despesas",
              backgroundColor: '#ddd',
              borderColor: "#aaa",
              fill: false,
              data: [<?= $saidas ?>],
              datalabels: {
                align: 'end',
                anchor: 'end'
              }
            }]
            },
            options: {
            legend: { display: true },
            maintainAspectRatio: false,
            title: {
              display: false,
              text: ''
            },
            scales: {
                yAxes: [{
                  scaleLabel: {
                  display: true,
                  labelString: 'Valor'
                }
              }],
              xAxes: [{
                  scaleLabel: {
                  display: true,
                  labelString: 'Dias'
                }
              }]
              }
            }
            });
            </script>
          </td>
        </tr>
      </tbody>
    </table> -->

    <!-- <div></div> -->

    <!-- <br /><br />

    <table width=601 cellspacing="0" border="0">
    	<colgroup width="131"></colgroup>
    	<colgroup span="3" width="168"></colgroup>
      <thead>
      	<tr>
      		<th class="fundo" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="35" align="center" valign=bottom><font size=5 color="#000000"><center>PERCENTUAL DE FUNCIONÁRIOS</center></font></th>
      		</tr>
        <tr>
      		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="25" align="center" valign=middle><font size=4 color="#000000">Total Líquido</font></td>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><font size=4 color="#000000">Total Geral (30%)</font></td>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><font size=4 color="#000000">Nro de Func.</font></td>
      		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><font size=4 color="#000000">Valor por Func.</font></td>
      	</tr>
      </thead>
      <tfoot>
        <tr>
          <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="10" align="right" valign=bottom ><font color="#000000"><span style="float: left;">R$</span> <?= number_format($tot_t, 2, ",", ".") ?></font></td>
          <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><font color="#000000"><span style="float: left;">R$</span> <?= number_format($tot_t * 0.3, 2, ",", ".") ?></font></td>
          <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom ><font color="#000000"><?= $func_contrato ?></font></td>
          <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><font color="#000000"><span style="float: left;">R$</span> <?= number_format(($tot_t * 0.3) / $func_contrato, 2, ",", ".") ?> </font></td>
        </tr>
      </tfoot>
    </table> -->

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
