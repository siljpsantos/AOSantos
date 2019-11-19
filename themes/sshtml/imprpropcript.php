<?php

$encoding = mb_internal_encoding();

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('Y-m-d');

$_GET['id'] = SA_Encryption::decrypt_from_url_param($_GET['token']);

//$proposta = $crud->pdo_src('proposta', 'WHERE id = '.$_GET['id'])[0];
$proposta = $crud->query_p("
	SELECT p.*,
  c.nome as nome_cliente
  FROM tb_proposta p
  INNER JOIN tb_cliente c ON c.id = p.id_cliente
  WHERE p.id = ".$_GET['id']."
  ")[0];



// echo "<pre>";
// print_r($proposta);

?>
<div id="menu_esconder" style="position: fixed; z-index: 1500; width: 100%; height: 100%; background-color: white;"></div>
<style>
nav{
  display:none !important;
}
.tabela-preco span{
  align:center;
  margin:2px;
}
.tabela-preco{
  margin-left: 110px;

}
i{
  display:none !important;
}
aside {
  display: none !important;
}
head{
  display:none !important;
}
footer{
  display:none !important;
}
td{
	padding-left: 5px;
	padding-right: 5px;
}
img{
  width:200px;
  margin-top: -30px !important;


}
p{
  margin:20px;
  font-size:18px;
}
	body{
		zoom: 0.82;
		-moz-transform: scale(0.82);
    padding-top: 0 !important;
    margin-top: 0 !important;
    display:none;


	}
	@media print {

		@page {padding: 0;margin: 25px;


		}
    body{display:block !important;}

		div{
			page-break-before: always;
			page-break-inside: avoid;
		}

	}




</style>


<body>
      <table>
      <thead>
        <tr>
          <td>
        <center>
          <p><img src="themes/sshtml/img/logo.png" alt="logo" /></p>
        </center>
      </td>
      </tr>
      </thead>
      <tfoot>
        <tr>
          <td style="text-size:14px;color:rgba(0,0,0,0.7);">
          <center>
            <p >ESTRADA SÃO JOÃO CAXIAS, 530 - S. J. DE MERITI</p>
            <p> TEL.: 21 3753-5951  E-mail: alvimaraos@ig.com.br</p>
          </center>
      </td>
      </tr>
      </tfoot>
      <tbody>
        <tr>
          <td>
      <p>
        AOSANTOS, vem atuando no mercado desde 2002. Nossa visão é reconhecida pela
        Qualidade, Padrão e Excelência do trabalho que realizamos. Para isto,
        procuramos treinar nossos colaboradores às necessidades de nossos clientes,
        visando assim se adequar ao máximo as particularidades de cada organização
        em que operamos com uma operação customizada.
      </p>
    <p>
        Na busca de aperfeiçoamento com as novas tendências do mercado logístico, a
        AOSANTOS, é brasileira de Logística.
    </p>
    <p>
        <strong></strong>
    </p>
    <p>
        <strong>AOSANTOS</strong>
    </p>
    <p>
        Rua do Arroz,65
    </p>
    <p>
        CNPJ.: 01.472.207/0001-21
    </p>
    <p>
        Inscr. Mun. 028273-19
    </p>
    <p>
        <strong><u>Nossos números em Operacionais no ano 2014</u></strong>
    </p>
    <p>
        Funcionários. 52
    </p>
    <p>
        Pontos de Operação 4
    </p>
    <p>
        Volume 2008 386.817 toneladas
    </p>
    <p>
        Veiculados /ano. 15.633 caminhões
    </p>
    <p>
        → <strong>Fidelização dos Colaboradores</strong> – cerca de 80 % de nosso
        quadro de funcionários está conosco há no mínimo 3 anos. Esta fidelização é
        fundamental para difundirmos melhores práticas Operacionais e de Segurança.
    </p>
    <p>
        → <strong>Suporte Operacional 24hs por dia </strong>– qualquer pessoa de
        nossa área operacional, desde a Direção Operacional até os encarregados que
        coordenam o processo é facilmente encontrada através de telefones celulares
        da Empresa, O que nos permite estar realizando, dentro do perímetro urbano,
        rápido atendimento caso seja necessário.
    </p>
    <p>
        → <strong>Atualização dos Líderes na Operação</strong> – nosso encarregados
        atuam de forma pró-ativa, identificando situações de risco de forma a
        agirmos em tempo real para que as mesmas não se concretizem.
    </p>
    <p>
        Embora em menor escala, também temos desempenhado com sucesso outras
        atividades em Produtos Alimentícios, como conferência e recondicionamento
        de produção.
    </p>
    <p>
        O gerenciamento de operação é feito através de medidores de desempenho,
        como por exemplo:
    </p>
    <p>
        → <strong> Relatório de Ocorrência</strong> – Acompanhamos diariamente as
        ocorrências do carregamento, gerando ao final do mês consolidado que
        retrata quais os pontos de melhoraria de maior ocorrência de operação.
    </p>
    <p>
        → <strong>Tempo de Descarga</strong> – realizamos acompanhamento do local e
        também das congêneres no Mercado.
    </p>
    <p>
        → <strong>Produtividade de Equipe</strong> – é realizado acompanhamento
        mensal, a fim de melhorarmos o equilíbrio da equipe.
    </p>
    <p>
        Apresentamos abaixo o que consideramos como FATORES CRITICOS DE SUCESSO são
        eles:
    </p>
    <p>
        → <strong>Foco no Negócio</strong> – AOSantos é atualmente focada em
        descarga de veículos alimentícios.
    </p>
    <p>
        São descarregados 1300 caminhões em média por mês, tendo uma média mensal
        carregada de aproximadamente 256000 toneladas.
    </p>
    <p>
        → <strong>Parceria e Integração</strong> – durante as empresas que atuamos,
        dada a parceria e integração de sempre buscamos, temos tido casos de
        sucesso como por exemplo a realização de um projeto de otimização que nos
        trouxe:
    </p>
    <p>
        Redução de Tempo de descarga, da ordem de 40%;
    </p>
    <p>
        Redução de Recursos Físico, 40%;
    </p>
    <p>
        Redução de Recursos Humanos na operação, de 50%
    </p>
    <p>
        <strong></strong>
    </p>
    <p>
        <strong>Referências</strong>
    </p>
    <p>
        → <strong>Transportadora Sul-americana</strong>
    </p>
    <p>
        Sr. Hélio
    </p>
    <p>
        Tel.: 21 2560-6229
    </p>
    <p>
        → <strong>W. A. Logística ( CBA – Alimentos) </strong>
    </p>
    <p>
        Sr. Waldemar
    </p>
    <p>
        Tel.: 21 3407-9454
    </p>

    <p>
        <strong></strong>
    </p>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <p>
        Encargos Sociais.
    </p>
    <p>
        A).
    </p>
    <table class="tabela-preco" style="border: 1px solid #000;"width="643">
      <thead></thead>
      <tfoot></tfoot>
      <center>
        <tbody>
            <tr style="border: 1px solid #000; text-align:center;">
                <td width="643" style="border: 1px solid #000; text-align:center;" colspan="6">
                    <span align="center">
                        <strong>TABELA DE PREÇO DA MÃO-DE-OBRA (HOMEM)</strong>
                    </span>
                </td>
            </tr>
            <tr style="border: 1px solid #000; text-align:center;">
                <td style="border: 1px solid #000; text-align:center;" width="199">
                    <span align="center">
                        <strong>Região</strong>
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="216" colspan="3">
                    <span align="center">
                        Baixada Fluminense e Pavuna
                    </span>
                </td>
                <td  style="border: 1px solid #000; text-align:center;"width="228" colspan="2">
                    <span align="center">
                        Rio de Janeiro
                    </span>
                </td>
            </tr>
            <tr style="border: 1px solid #000; text-align:center;">
                <td style="border: 1px solid #000; text-align:center;" width="199">
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="100">
                    <span align="center">
                        <strong>DIÁRIA</strong>
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="116" colspan="2">
                    <span align="center">
                        <strong>MENSAL</strong>
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="84">
                    <span align="center">
                        <strong>DIÁRIA</strong>
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="144">
                    <span align="center">
                        <strong>MENSAL</strong>
                    </span>
                </td>
            </tr>
            <tr style="border: 1px solid #000; text-align:center;">
                <td style="border: 1px solid #000; text-align:center;" width="199">
                    <span align="center">
                        Mão-de-Obra (homem)
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="100">
                    <span align="center">
                        R$ 30,75
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="116" colspan="2">
                    <span align="center">
                        R$ 742,50
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="84">
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="144">
                    <span align="center">
                        R$ 809,40
                    </span>
                </td>
            </tr>
            <tr style="border: 1px solid #000; text-align:center;">
                <td style="border: 1px solid #000; text-align:center;" width="199">
                    <span align="center">
                        Insalubridade
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="100">
                    <span align="center">
                        R$ 2,33
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="116" colspan="2">
                    <span align="center">
                        R$ 40, 00
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="84">
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="144">
                    <span align="center">
                        R$ 40,00
                    </span>
                </td>
            </tr>
            <tr style="border: 1px solid #000; text-align:center;">
                <td style="border: 1px solid #000; text-align:center;" width="199">
                    <span align="center">
                        <strong>TOTAL</strong>
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="100">
                    <span align="center">
                        R$ 33,08
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="116" colspan="2">
                    <span align="center">
                        R$ 782,50
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="84">
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="144">
                    <span align="center">
                        R$ 7,36
                    </span>
                </td>
            </tr>
            <tr style="border: 1px solid #000; text-align:center;">

                <td style="border: 1px solid #000; text-align:center;" width="444" colspan="6">
                    <span align="center">
                        <strong>HORA EXTRA</strong>
                    </span>
                </td>
            </tr>
            <tr style="border: 1px solid #000; text-align:center;">
                <td style="border: 1px solid #000; text-align:center;" width="199">
                    <span align="center">
                        Segunda à Sábado
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="199" colspan="2">
                    <span align="center">
                        R$ 5,06
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="244" colspan="3">
                    <span align="center">
                        R$ 5,52
                    </span>
                </td>
            </tr>
            <tr style="border: 1px solid #000; text-align:center;">
                <td style="border: 1px solid #000; text-align:center;" width="199">
                    <span align="center">
                        Domingo e Feriado
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="199" colspan="2">
                    <span align="center">
                        R$ 6,74
                    </span>
                </td>
                <td style="border: 1px solid #000; text-align:center;" width="244" colspan="3">
                    <span align="center">
                        R$ 7,36
                    </span>
                </td>
            </tr>
            <tr height="0">
                <td width="199">
                </td>
                <td width="100">
                </td>
                <td width="100">
                </td>
                <td width="16">
                </td>
                <td width="84">
                </td>
                <td width="144">
                </td>
            </tr>
          </td>
        </tr>
        </tbody>
      </center>
    </table>
    <p>
      <?= $proposta ['grupo5'] ?>

    </p>
    <p>
      <?= $proposta ['grupo6'] ?>

    </p>
    <p>
      <?= $proposta ['grupo7'] ?>

    </p>
    </tbody>
    </table>
</body>


<script >
	function sleep (time) {
	  return new Promise((resolve) => setTimeout(resolve, time));
	}
	sleep(600).then(() => {
		window.print();
		window.close();
	});
</script>
