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

	@$id = $_SESSION['id_usuario'];
	@$id_adm = $_SESSION['id_adm'];

	$contrato = $crud->pdo_src('contrato', '');

	if($perm_f){
		$contrato = $crud->pdo_src('contrato', 'WHERE id_contrato = 3');
	}

?>
<div style="margin: 0 10px 0 10px">
		<?php if(@$_SESSION['bloq_ger_usuario']!="1"){ ?>
			<div class="panel panel-default">
				<div style="font-size: 14pt; display: table; width: 100%" class="panel-heading">
					Contratos
					<a style="float: right" class="btn btn-primary" href="cad_contrato">Novo Contrato</a>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="lista" class="tablesorter" >
							<thead>
								<tr>
									<th>
										Nome
									</th>
									<th>
										Endereço
									</th>
									<th>
										Status
									</th>
								</tr>
							</thead>
							<tbody>

								<?php foreach($contrato as $index=>$key){ ?>


										<tr <?=  "onclick='window.open(\"edita_contrato?id=".$key['id_contrato']."\")' " ?> style='border-bottom: 1px solid #ababab; cursor: pointer; <?php if($key['ass']=="0"){echo "color: red;";} ?>'>

											<td>
												<?php echo $key['nome'] ?>
											</td>
											<td>
												<?php echo $key['logradouro'] ?>
											</td>
											<td>
												<?php
													if($key['ass']=="1"){
														echo "Assinado";
													}else{
														echo "Em aberto / Aguardando Assinatura";
													}
												?>
											</td>
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
