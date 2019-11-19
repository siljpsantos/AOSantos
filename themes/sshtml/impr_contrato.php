 <?php

  $encoding = mb_internal_encoding();

  date_default_timezone_set('America/Sao_Paulo');
  $data_atual = date('Y-m-d');

  $contrato = $crud->query_p('
  SELECT cli.nome as nome,
         cli.cnpj as cnpj,
         cli.inscricao_estadual as inscricao_estadual,
         cont.contato as contato,
         s.servico as servico,
         cs.val as preco,
         cont.logradouro as logradouro,
         cont.bairro as bairro,
         cont.cidade as cidade,
         cont.cep as cep,
         cont.estado as estado,
  UNCOMPRESS(cont.claus_3) as claus_3,
  UNCOMPRESS(cont.claus_4) as claus_4,
  UNCOMPRESS(cont.claus_5) as claus_5,
  UNCOMPRESS(cont.claus_6) as claus_6,
  UNCOMPRESS(cont.claus_7) as claus_7,
  UNCOMPRESS(cont.claus_8) as claus_8,
  UNCOMPRESS(cont.claus_9) as claus_9,
  UNCOMPRESS(cont.claus_10) as claus_10
  FROM tb_contrato cont
  inner join tb_cliente cli on cli.id = cont.id_cliente
  left join tb_contrato_servico cs on cs.id_contrato = cont.id_contrato
  left join tb_servico s on s.id = cs.id_servico
  WHERE cont.id_contrato = '.$_GET['id'].'');

  $tot = 0.00;

?>
<!-- <?php echo "<pre>";
 print_r($contrato); ?> -->
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
#tudo_t{
	display: none;
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
		zoom: 70%;
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

</style>

<center>

<body>
    <table id="tudo_t">
	<thead>
		<tr>
			<td style="font-weight: bold;">
				<center>
					<img style="width: 150px" src="themes/sshtml/img/logo_nav.png" />
				</center>
			</td>

		</tr>
		<tr>
			<td></td>
			<td></td>

		</tr>
	</thead>
	<tfoot>
		<tr>
			<td>
      <p align="center">
        <br/>
        A. O. SANTOS PRESTADORA DE SERVIÇOS ME
      </p>
      <p align="center">
       <?= $contrato[0]['nome'] ?><strong></strong>
      </p></td>
		</tr>
	</tfoot>
	<tbody>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <tr>
      <td>

        <p style="font-size:30px;margin: 10px 0;"align="center">
          <strong>CONTRATO DE PRESTAÇÃO DE SERVIÇOS</strong>

        </p>
        <p>
          <strong>
              CONTRATANTE:  <?= $contrato[0]['nome'] ?> , situada <?= $contrato[0]['estado'] ?>, com sede na <?= $contrato[0]['logradouro'] . ", " . $contrato[0]['bairro'] . ", " .  $contrato[0]['cidade'] . " - . CEP: " .  $contrato[0]['cep'] ?>, CNPJ
              <?= $contrato[0]['cnpj'] ?>, Inscr. Est.<?= $contrato[0]['inscricao_estadual'] ?>, representada por <?= $contrato[0]['contato'] ?>.
          </strong>
        </p>
        <p>
          <strong></strong>
        </p>
        <br/>
        <p>
          <strong>
              CONTRATADO: A. O. SANTOS PRESTADORA DE SERVIÇOS ME, situada na Rua do
              Arroz, 65, Penha Circular, Rio de Janeiro, RJ, Cep 21011-070, CNPJ
              06.329.862/0001-49, e inscrição municipal 038306, representada por
              ALVIMAR OLIVEIRA DOS SANTOS, brasileiro, casado, empresário, portador
              da Cédula de Identificação nº. 07.577.937-1 DETRAN e CPF
              923.048.857-72.
          </strong>
        </p>
        <p>
          As partes acima identificadas têm, entre si, justo e acertado o presente
          Contrato de Prestação de Serviços, que se regerá pelas cláusulas seguintes
          e pelas condições de preço, forma e termo de pagamento descritas no
          presente.
        </p>
        <p>
          <br/>
          <strong>DO OBJETO DO CONTRATO </strong>
        </p>
        <p>
          <strong></strong>
        </p>
        <p>
          <?= $contrato[0]['claus_3'] ?>
        </p>
        <p>
          <br/>
          <strong>OBRIGAÇÕES DO CONTRATANTE</strong>
        </p>
        <p>
          <?= $contrato[0]['claus_4'] ?>
        </p>
        <p>
          <br/>
          <strong>OBRIGAÇÕES DO CONTRATADO </strong>
        </p>
        <p>
          <strong></strong>
        </p>
        <p>
          <?= $contrato[0]['claus_5'] ?>
        </p>
        <br/>
        <p>
          <strong>DO PREÇO E DAS CONDIÇÕES DE PAGAMENTO </strong>
        </p>
        <p>
          <strong></strong>
        </p>
        <p>
          <?= $contrato[0]['claus_6'] ?>
        </p>
        <table style="border:1px solid #000;margin-left:145px;margin-top:20px; margin-bottom:20px;" cellspacing="0" cellpadding="0">
          <tbody>
              <tr style="border:1px solid #000;">
                  <td style="border:1px solid #000; text-align:center;" width="288" valign="top">
                      <p>
                          <strong>DESCARGA </strong>
                          <!-- Variavel -->
                      </p>
                  </td>
                  <td style="border:1px solid #000;text-align:center;" width="288" valign="top">
                      <p>
                          <strong>VALOR </strong>
                          <!-- Variavel -->
                      </p>
                  </td>
              </tr>
              <?php
              foreach($contrato as $item){

              ?>
              <tr style="border:1px solid #000;">
                  <td style="border:1px solid #000; text-align:center;" width="288" valign="top">
                      <p>
                          <?= $item['servico'] ?>
                          <!-- Variavel -->
                      </p>
                  </td>
                  <td style="border:1px solid #000; text-align:center;" width="288" valign="top">
                      <p>
                          R$<?= number_format($item['preco'],2,",",".") ?>
                          <!-- Variavel -->
                      </p>
                  </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
        <p>
          <strong></strong>
        </p>

        <p>
          <strong></strong>
        </p>
        <p>
          <strong></strong>
        </p>
        <br/>
        <p>
          <strong>DA RESCISÃO IMOTIVADA </strong>
        </p>
        <p>
          <strong></strong>
        </p>
        <p>
          <?= $contrato[0]['claus_7'] ?>

        </p>
        <br/>
        <p>
          <strong>DO PRAZO </strong>
        </p>
        <p>
          <strong></strong>
        </p>
        <p>
          <?= $contrato[0]['claus_8'] ?>
        </p>
        <p>
          <br/>

          <strong>DAS CONDIÇÕES GERAIS </strong>
        </p>
        <p>
          <strong></strong>
        </p>
        <p>
          <?= $contrato[0]['claus_9'] ?>
        </p>
        <p>
          <br/>
          <strong>DO FORO </strong>
        </p>
        <p>
          <?= $contrato[0]['claus_10'] ?>
        </p>
        <br/>
        <br/>
        <br/>
        <p align="right">
          Rio de Janeiro, <?= strftime('%d de %B de %Y', strtotime('today')); ?>.
        </p>


      </td>
    </tr>
  </tbody>
	</table>
</body>

</center>

<script>
function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}
sleep(600).then(() => {
  window.print();
  window.close();
});
</script>
