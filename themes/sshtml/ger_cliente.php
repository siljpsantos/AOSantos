<?php

	//protege entrada sem permissão
	// if(@$_SESSION == array()){
	// 	echo "<script>window.location.href='" . HOME . "/403';</script>";
	// }else{
	// 	if ($_SESSION['perm_ti'] == "1") {
	// 	} else {
	// 		echo "<script>window.location.href='" . HOME . "/403';</script>";
	// 	}
	// }

	//$propostas = $crud->pdo_src('proposta', 'WHERE id_contrato = 0 AND del_yn != 1');
	$propostas = $crud->query_p("
	Select * from tb_cliente
			");

?>
<div style="margin: 0 10px 0 10px">
		<?php if(@$_SESSION['bloq_ger_usuario']!="1"){ ?>
			<div class="panel panel-default">
				<div style="font-size: 14pt; display: table; width: 100%" class="panel-heading">
					Clientes
					<a style="float: right" class="btn btn-primary" href="cad_cliente">Novo Cliente</a>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="lista" class="tablesorter" >
							<thead>
								<tr>
									<th style='width: 120px !important;'>
										Nome
									</th>
									<th>
										cnpj
									</th>
									<th>
										E-mail
									</th>
									<th>
										Inscrição Estadual
									</th>


									<!--<th>
										Contrato
									</th>-->

								</tr>
							</thead>
							<tbody>

								<?php

								foreach($propostas as $index=>$key){

									// echo '<pre>';
									// print_r($key);

									?>

									<tr style=' border-bottom: 1px solid #ababab; cursor: pointer;'>
										<td <?=  "onclick='window.open(\"edita_cliente?id=".$key['id']."\")' " ?>>
											<?php echo $key['nome'] ?>
										</td>
										<td <?=  "onclick='window.open(\"edita_cliente?id=".$key['id']."\")' " ?>>
											<?php echo $key['cnpj'] ?>
										</td>

										<td <?=  "onclick='window.open(\"edita_cliente?id=".$key['id']."\")' " ?>>
											<?php echo $key['email'] ?>
										</td>

									<td <?=  "onclick='window.open(\"edita_cliente?id=".$key['id']."\")' " ?>>
											<?php echo $key['inscricao_estadual'] ?>
									</td>
									<!-- <td <?=  "onclick='window.open(\"edita_cliente?id=".$key['id']."\")' " ?>>
											<?php echo implode("/",array_reverse(explode("-",$key['usuario']))) ?>
										</td> -->
									</tr>

								<?php } ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php }else{ ?>
			<div class="panel panel-default">
				<div class="panel-heading"><center><h2>USUARIO SOMENTE PARA CADASTRO</h3></center></div>
			</div>
		<?php } ?>
