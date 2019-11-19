<?php

	//protege entrada sem permissão
	if(@$_SESSION == array()){
		echo "<script>window.location.href='" . HOME . "/403';</script>";
	}else{
		// if ($_SESSION['perm_frota'] == "1") {
		// } else {
		// 	echo "<script>window.location.href='" . HOME . "/403';</script>";
		// }
	}

	//$propostas = $crud->pdo_src('proposta', 'WHERE id_contrato = 0 AND del_yn != 1');
	$propostas = $crud->query_p("
		SELECT p.*
		FROM tb_proposta p WHERE p.id_contrato = 0 AND p.del_yn != 1
	");

?>
<div style="margin: 0 10px 0 10px">
		<?php if(@$_SESSION['bloq_ger_usuario']!="1"){ ?>
			<div class="panel panel-default">
				<div style="font-size: 14pt; display: table; width: 100%" class="panel-heading">
					Propostas em Aberto
					<a style="float: right" class="btn btn-primary" href="cad_proposta">Nova Proposta</a>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="lista" class="tablesorter" >
							<thead>
								<tr>
									<th style='width: 120px !important;'>
										N° da Proposta
									</th>
									<th>
										Validade
									</th>
									<th>
										Status
									</th>
									<?php if($_SESSION['id_usuario'] =="1" || $_SESSION['id_usuario'] =="16" || $_SESSION['id_usuario'] =="20"){ ?>
									<th>
										USUÁRIO
									</th>
									<?php } ?>
									<!--<th>
										Contrato
									</th>-->
									<?php if($_SESSION['id_usuario'] =="1" || $_SESSION['id_usuario'] =="16" || $_SESSION['id_usuario'] =="20"){ ?>
									<th style="white-space: nowrap; width: 50px;">
										OP
									</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>

								<?php

								foreach($propostas as $index=>$key){

									$usuario = $crud->pdo_src('usuario', 'WHERE id_usuario = ' . $key['id_usuario'] . ' ');

									$del = "";
									$del_u = "php/del_proposta.php?id=" . $key['id'];
									$confirm = " onclick=\"return confirm('Tem certeza disto?')\" ";

									$del_str = "<a $confirm href=\"$del_u\" $del class=\"btn btn-danger\">X</a>";

									?>

									<tr style=' border-bottom: 1px solid #ababab; cursor: pointer;'>
										<td <?=  "onclick='window.open(\"edita_proposta?id=".$key['id']."\")' " ?>>
											<?php echo $key['num_proposta'] ?>
										</td>
										<td <?=  "onclick='window.open(\"edita_proposta?id=".$key['id']."\")' " ?>>
											<?php echo implode("/",array_reverse(explode("-",$key['data_val']))) ?>
										</td>
										<td <?=  "onclick='window.open(\"edita_proposta?id=".$key['id']."\")' " ?>>
											<?php
												if($key['ass']=="1"){
													echo "Aceita / Aguardando Contrato";
												}else{
													echo "Em aberto / Aguardando Aceite";
												}
											?>
										</td>
										<?php if($_SESSION['id_usuario'] =="1" || $_SESSION['id_usuario'] =="16" || $_SESSION['id_usuario'] =="20"){ ?>
									<td <?=  "onclick='window.open(\"edita_proposta?id=".$key['id']."\")' " ?>>
										<?= $usuario[0]['nome_usuario'] ?>
									</td>
									<?php } ?>
										<!--<td <?=  "onclick='window.open(\"edita_proposta?id=".$key['id']."\")' " ?>>
											<?php echo @$contrato['nome'] ?>
										</td>-->
										<?php
										if($_SESSION['id_usuario'] =="1" || $_SESSION['id_usuario'] =="16" || $_SESSION['id_usuario'] =="20"){
												echo "<td>$del_str</td>";
											}
										?>
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
