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

    $contrato = $crud->query_p('
		SELECT
			id_contrato, id_cliente, id_responsavel, nome, num_contrato, ini, fim, contato, logradouro, bairro, cidade, estado, cep,
			UNCOMPRESS(claus_3) as claus_3,
			UNCOMPRESS(claus_4) as claus_4,
			UNCOMPRESS(claus_5) as claus_5,
			UNCOMPRESS(claus_6) as claus_6,
			UNCOMPRESS(claus_7) as claus_7,
			UNCOMPRESS(claus_8) as claus_8,
			UNCOMPRESS(claus_9) as claus_9,
			UNCOMPRESS(claus_10) as claus_10,
			ass,
			id_proposta,
			percent
		FROM tb_contrato where id_contrato = '.
    $_GET['id'])[0];

    $loc = $crud->pdo_src('cliente','');
    $usuarios = $crud->pdo_src('usuario', '');
    $servicos = $crud->pdo_src('servico', 'WHERE id NOT IN ( SELECT id_servico FROM tb_contrato_servico WHERE id_contrato = '.$_GET['id'].' ) ');
    $func = $crud->pdo_src('funcionario', 'WHERE id_contrato != '.$_GET['id']);

    $contrato_servico = $crud->query_p('
		SELECT
			s.servico, cs.val, cs.id
		FROM
			tb_contrato_servico cs
			INNER JOIN tb_servico s ON s.id = cs.id_servico
		WHERE
			cs.id_contrato = '.$_GET['id'] . '
		ORDER BY s.id DESC
	');

    $func_contrato = $crud->query_p('
		SELECT
			f.nome, f.cpf, f.id as id_f, fc.data_hora_ini, fc.id as id_fc
		FROM
			tb_funcionario_contrato fc
			INNER JOIN tb_funcionario f ON f.id = fc.id_funcionario
		WHERE
			fc.id_contrato = '.$_GET['id'] . ' AND fc.ativo_yn = 1
		ORDER BY fc.id DESC
	');

    $historico = $crud->query_p('
		SELECT
			f.nome, f.cpf, fc.data_hora_ini, fc.data_hora_fin
		FROM
			tb_funcionario_contrato fc
			INNER JOIN tb_funcionario f ON f.id = fc.id_funcionario
		WHERE
			fc.id_contrato = '.$_GET['id'].'  AND fc.ativo_yn = 0
		ORDER BY fc.id DESC
	');

    // print_r($func_contrato);

    if($contrato['id_proposta'] != 0){
        $proposta = $crud->pdo_src('proposta', 'WHERE id = ' . $contrato['id_proposta'])[0];
    }

    $documentos = $crud->pdo_src('doc_contrato', 'WHERE id_contrato = '.$_GET['id']);

    // print_r($contrato);

    if(true){
        echo '<script>
			$( document ).ready(function() {
			    $(":input").prop("disabled", true);
			});
		</script>';
    }

?>

<div class="panel panel-default" style="margin: 0 10px 0 10px">
	<div style="font-size: 14pt" class="panel-heading">
		Informações do Contrato
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="cons_1" action="php/edit_contrato.php" method="POST">



			<div class="container-big">
				<div class="panel panel-default bg-escuro">
					<div class="panel-body">

						<div class="col-md-3">
							<label>Responsável:</label>
							<select style="width: 100%;" class="form-control" required name="id_responsavel">
								<option></option>
								<?php
                                    foreach($usuarios as $index=>$key){

                                        $id = $key['id_usuario'];
                                        $nome = $key['nome_usuario'];

                                        if($id == $contrato['id_responsavel']){
                                            echo "<option selected value='$id'>$nome</option>";
                                        }else{
                                            echo "<option value='$id'>$nome</option>";
                                        }

                                    }
                                ?>
							</select>
						</div>
						<div class="col-md-3">
							<label>Cliente:</label>
							<select style="width: 100%;" class="form-control" required name="id_cliente">
								<option></option>
								<?php
                                    foreach($loc as $index=>$key){

                                        $id = $key['id'];
                                        $nome = $key['nome'];

                                        if($id == $contrato['id_cliente']){
                                            echo "<option selected value='$id'>$nome</option>";
                                        }else{
                                            echo "<option value='$id'>$nome</option>";
                                        }

                                    }
                                ?>
							</select>
						</div>
						<div class="col-md-3">
							<label>Nome:</label>
							<input class="form-control" required placeholder="" type="text" name="nome" value="<?= $contrato['nome'] ?>" />
						</div>
						<div class="col-md-3">
							<label>Número do Contrato:</label>
							<input class="form-control" required placeholder="" type="text" name="num_contrato" value="<?= $contrato['num_contrato'] ?>" />
						</div>
						<div class="col-md-2">
							<label>Início:</label>
							<input class="form-control" required placeholder="" type="date" name="ini" value="<?= $contrato['ini'] ?>" />
						</div>
						<div class="col-md-2">
							<label>Final:</label>
							<input class="form-control" required placeholder="" type="date" name="fim" value="<?= $contrato['fim'] ?>" />
						</div>
						<div class="col-md-2">
							<label>Contato:</label>
							<input class="form-control" required placeholder="" type="text" name="contato" value="<?= $contrato['contato'] ?>" />
						</div>
						<div class="col-md-3">
							<label>Percentual:</label>
							<select style="width: 100%;" class="form-control" required name="percent">
								<option <?= $contrato['percent'] == "30.00" ? "selected" : ""  ?> value="30">30%</option>
								<option <?= $contrato['percent'] == "35.00" ? "selected" : ""  ?> value="35">35%</option>
							</select>
						</div>

						<div class="col-md-12">
							<h4>
								Cláusulas Detalhadas <a class="btn-sm btn-primary" style="margin-left: 15px;" onclick="return false;" href="#" data-toggle="collapse" data-target="#clausulas_div">+/-</a>
							</h4>
						</div>

						<div class="col-md-12">
							<div id="clausulas_div" class="panel panel-default bg-escuro collapse">
								<div class="col-md-12 text-justify">
									<label>DO OBJETO DO CONTRATO</label>
									<textarea class="form-control" name="claus_3" rows=7><?= $contrato['claus_3'] ?></textarea>
								</div>
								<div class="col-md-12 text-justify">
									<label>OBRIGAÇÕES DO CONTRATANTE</label>
									<textarea class="form-control" name="claus_4" rows=7><?= $contrato['claus_4'] ?></textarea>
								</div>
								<div class="col-md-12 text-justify">
									<label>OBRIGAÇÕES DO CONTRATADO</label>
									<textarea class="form-control" name="claus_5" rows=7><?= $contrato['claus_5'] ?></textarea>
								</div>
								<div class="col-md-12 text-justify">
									<label>DO PREÇO E DAS CONDIÇÕES DE PAGAMENTO</label>
									<textarea class="form-control" name="claus_6" rows=7><?= $contrato['claus_6'] ?></textarea>
								</div>
								<div class="col-md-12 text-justify">
									<label>DA RESCISÃO IMOTIVADA</label>
									<textarea class="form-control" name="claus_7" rows=7><?= $contrato['claus_7'] ?></textarea>
								</div>
								<div class="col-md-12 text-justify">
									<label>DO PRAZO</label>
									<textarea class="form-control" name="claus_8" rows=7><?= $contrato['claus_8'] ?></textarea>
								</div>
								<div class="col-md-12 text-justify">
									<label>DAS CONDIÇÕES GERAIS</label>
									<textarea class="form-control" name="claus_9" rows=7><?= $contrato['claus_9'] ?></textarea>
								</div>
								<div class="col-md-12 text-justify">
									<label>DO FORO</label>
									<textarea class="form-control" name="claus_10" rows=7><?= $contrato['claus_10'] ?></textarea>
								</div>

							</div>
						</div>

					</div>
				</div>
				<!--</div>
				<div class="row">-->
				<div class="panel panel-default bg-escuro">
					<div class="panel-body">
						<div class="col-md-3">
							<label>Logradouro:</label>
							<input class="form-control" required placeholder="" type="text" name="logradouro" value="<?= $contrato['logradouro'] ?>" />
						</div>
						<div class="col-md-3">
							<label>Bairro:</label>
							<input class="form-control" required placeholder="" type="text" name="bairro" value="<?= $contrato['bairro'] ?>" />
						</div>
						<div class="col-md-3">
							<label>Cidade:</label>
							<input class="form-control" required placeholder="" type="text" name="cidade" value="<?= $contrato['cidade'] ?>" />
						</div>
						<div class="col-md-1">
							<label>Estado:</label>
							<input class="form-control" required placeholder="" type="text" name="estado" value="<?= $contrato['estado'] ?>" />
						</div>
						<div class="col-md-2">
							<label>CEP:</label>
							<input class="form-control" required placeholder="" type="text" name="cep" value="<?= $contrato['cep'] ?>" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-6">
						<?php if ($contrato['id_proposta'] != 0) { ?>
							<a onclick="window.open('edita_proposta?id=<?= $contrato['id_proposta'] ?>');" style="cursor: pointer; float: right; margin-left: 10px;" class="btn btn-warning">Visualizar proposta</a>
							<div style="float: right; margin-right: 30px;"><a target="_blank" class="btn btn-success" href="impr_contrato?id=<?= $_GET['id'] ?>">Imprimir Contrato</a></div>
						<?php } else { ?>
							<div style="float: right;"><a class="btn btn-warning" disabled>Aguardando Aprovação de Proposta</a></div>
						<?php } ?>
					</div>
					<input type="hidden" name="id_contrato" value="<?= $contrato['id_contrato'] ?>" />
          <div class="col-md-1">
						<button class="btn btn-primary btn-block" type="submit">Salvar</button>
					</div>
				</div>
				<!--<div class="row">
					<div class="col-md-3">

					</div>
				</div>-->
			</div>

		</form>

	</div>
</div>

<br /><br />

<div class="panel panel-default" style="margin: 0 10px 0 10px">
		<div style="font-size: 14pt" class="panel-heading">
			<a class="text-success" style="cursor: pointer" data-toggle="collapse" data-target="#func_div">Funcionários No Contrato</a>
			<button class="btn-xs btn-primary" style="margin-left: 15px; float: right;" data-toggle="collapse" data-target="#func_div">+/-</button>
		</div>
		<div class="panel-body">
			<div id="func_div" class="container-big collapse" style="margin: 10px;">

				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Registrar Funcionário
					</div>
					<div class="panel-body">
						<form action="php/add_funcionario_contrato.php" method="POST">
							<input type="hidden" name="id_contrato" value="<?= $_GET['id'] ?>" />
							<div class="content">
								<div class="col-md-8">
									Funcionário:
									<select style="width: 100%;" class="form-control" required name="id_funcionario">
										<option></option>
										<?php
                                            foreach($func as $index=>$key){

                                                $id = $key['id'];
                                                $nome = $key['cpf'] . " - " . $key['nome'];

                                                echo "<option value='$id'>$nome</option>";

                                            }
                                        ?>
									</select>

								</div>
								<div class="col-md-3">
									Data de Início:
									<input class="form-control" required name="data_hora_ini" type="datetime-local" value="<?= date('Y-m-d\TH:i'); ?>" />
								</div>
								<div class="col-md-1">
									&nbsp;
									<button class="btn btn-block btn-success" type="submit">Salvar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Funcionários No Contrato
					</div>
					<div class="panel-body">
						<div class="content">
							<table class="tablesorter">
								<thead>
									<tr>
										<th>Nome</th>
										<th>CPF</th>
										<th>Data de Ingresso</th>
										<th width=400>Data de Saída</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($func_contrato as $key) { ?>
										<tr>
											<td><?= $key['nome'] ?></td>
											<td><?= $key['cpf'] ?></td>
											<td><?= implode("/", array_reverse(explode('-', explode(" ", $key['data_hora_ini'])[0]))) ?></td>
											<td>
												<form method="POST" class="form form-inline" action="php/remove_funcionario_contrato.php">
													<input type="hidden" name="id" value="<?= $key['id_fc'] ?>" />
													<input type="hidden" name="id_funcionario" value="<?= $key['id_f'] ?>" />
													<input type="hidden" name="ativo_yn" value="0" />
													<input class="form-control" required name="data_hora_fin" type="datetime-local" value="<?= date('Y-m-d\TH:i'); ?>" />
													<button style="margin-top: -10px;" type="submit" class="btn btn-danger">Desalocar</button>
												</form>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="panel panel-warning">
					<div style="font-size: 14pt" class="panel-heading">
						<a style="cursor: pointer" class="text-warning" data-toggle="collapse" data-target="#hist_div">Histórico do Contrato</a>
						<button class="btn-xs btn-warning" style="margin-left: 15px; float: right;" data-toggle="collapse" data-target="#hist_div">+/-</button>
					</div>
					<div class="panel-body">
						<div class="content collapse" id="hist_div">
							<table class="tablesorter">
								<thead>
									<tr>
										<th>Nome</th>
										<th>CPF</th>
										<th>Data de Ingresso</th>
										<th>Data de Saída</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($historico as $key) { ?>
										<tr>
											<td><?= $key['nome'] ?></td>
											<td><?= $key['cpf'] ?></td>
											<td><?= implode("/", array_reverse(explode('-', explode(" ", $key['data_hora_ini'])[0]))) ?></td>
											<td><?= implode("/", array_reverse(explode('-', explode(" ", $key['data_hora_fin'])[0]))) ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

<br /><br />


<div class="panel panel-default" style="margin: 0 10px 0 10px">
		<div style="font-size: 14pt" class="panel-heading">
			<a class="text-success" style="cursor: pointer" data-toggle="collapse" data-target="#serv_div">Serviços do Contrato</a>
			<button class="btn-xs btn-primary" style="margin-left: 15px; float: right;" data-toggle="collapse" data-target="#serv_div">+/-</button>
		</div>
		<div class="panel-body">
			<div id="serv_div" class="container-big collapse" style="margin: 10px;">

				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Registrar Serviço
					</div>
					<div class="panel-body">
						<form action="php/add_contrato_servico.php" method="POST">
							<input type="hidden" name="id_contrato" value="<?= $_GET['id'] ?>" />
							<div class="content">
								<div class="col-md-11">
									Serviço:
									<select style="width: 100%;" class="form-control" required name="id_servico">
										<option></option>
										<?php
                                            foreach($servicos as $index=>$key){

                                                $id = $key['id'];
                                                $nome = $key['servico'];

                                                echo "<option value='$id'>$nome</option>";

                                            }
                                        ?>
									</select>

								</div>
								<div class="col-md-1">
									&nbsp;
									<button class="btn btn-block btn-success" type="submit">Salvar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Serviços do Contrato
					</div>
					<div class="panel-body">
						<div class="content">
							<table class="tablesorter">
								<thead>
									<tr>
										<th >Serviço</th>
										<th >Valor</th>
										<th width=100 >OP</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($contrato_servico as $key) { ?>
										<tr>
											<td><?= $key['servico'] ?></td>
											<td>
												<form method="POST" class="form form-inline" action="php/edit_contrato_servico.php">
													<input type="hidden" name="id_contrato" value="<?= $_GET['id'] ?>" />
													<input type="hidden" name="id" value="<?= $key['id'] ?>" />
													<input class="form-control" type="number" step=".01" name="val" value="<?= $key['val'] ?>" />
													<button style="margin-top: -10px" type="submit" class="btn btn-success">&nbsp;<i style="margin-left: -13px;" class="fa fa-sync"></i>&nbsp;</button>
												</form>
											</td>
											<td>
												<form method="POST" class="form form-inline" action="php/remove_contrato_servico.php">
													<input type="hidden" name="id" value="<?= $key['id'] ?>" />
													<button type="submit" class="btn btn-danger">Remover</button>
												</form>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<br /><br />


<div class="panel panel-default" style="margin: 0 10px 0 10px">
		<div style="font-size: 14pt" class="panel-heading">
			<a class="text-success" style="cursor: pointer" data-toggle="collapse" data-target="#doc_eq">Documentos do Contrato</a>
			<button class="btn-xs btn-primary" style="margin-left: 15px; float: right;" data-toggle="collapse" data-target="#doc_eq">+/-</button>
		</div>
		<div class="panel-body">
			<div id="doc_eq" class="container-big collapse" style="margin: 10px;">

				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Novo Documento
					</div>
					<div class="panel-body">
						<form action="php/add_doc_contrato.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="id_contrato" value="<?= $_GET['id'] ?>" />
							<input type="hidden" name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>" />
							<div class="content">
								<div class="col-md-4">
									&nbsp;
								    <input class="form-control" required type="file" name="documento" />
								</div>
								<div class="col-md-3">
									Nome:
									<input class="form-control" required name="nome" placeholder="Nome do Documento Aqui." />
								</div>
								<?php if ($contrato['ass'] == 0) { ?>
									<div class="col-md-2">
										Assinatura:
										<select style="width: 100%" class="form-control" required name="ass">
											<option value=0>Não</option>
											<option value=1>Sim</option>
										</select>
									</div>
								<?php } ?>
								<div class="col-md-1">
									&nbsp;
									<button class="btn btn-block btn-success" type="submit">Salvar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Documentos do Contrato
					</div>
					<div class="panel-body">
						<div class="content">
							<?php foreach ($documentos as $documento) { ?>
								<div class="row">
									<div class="col-md-12">
										<?php if ($documento['ass'] == 0) { ?>
											<a onclick="return confirm('Essa ação não pode ser desfeita! Tem certeza?')" class="btn-sm btn-danger" href="php/del_doc_contrato.php?id=<?= $documento['id'] ?>">X</a>
										<?php } else { ?>
											<a style="color: white; cursor: pointer;" class="btn-sm btn-default">X</a>
										<?php } ?>

									<?php
                                        /*if($documento['id_equipamento'] != "0"){
											$equip_tmp = $crud->pdo_src('equipamento', 'WHERE id_equipamento = '.$documento['id_equipamento']);

											echo "<div class='col-md-1'>";
											echo "<input disabled class='form-control' value='".$equip_tmp[0]['nome']."' />";
											echo "</div>";
										}*/
                                    ?>

											&nbsp;<a href="<?= substr($documento['documento'], 3) ?>" target="_blank">
											<?= $documento['nome'] ?>
										</a>
									</div>
								</div>
								<div class="row">&nbsp;</div>
							<?php } ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

<br /><br /><br /><br />
