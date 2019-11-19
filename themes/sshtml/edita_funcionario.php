<?php

    //protege entrada sem permissão
    if(@$_SESSION == array()){
        echo "<script>window.location.href='" . HOME . "/403';</script>";
    }else{
        // if ($_SESSION['perm_ti'] == "1") {
        // } else {
        // 	echo "<script>window.location.href='" . HOME . "/403';</script>";
        // }
    }

    $proposta = $crud->pdo_src('funcionario', 'WHERE id = '.$_GET['id'])[0];
    $documentos = $crud->pdo_src('doc_funcionario', 'WHERE id_funcionario = '.$_GET['id']);
    $fotos = $crud->pdo_src('foto_funcionario', 'WHERE id_funcionario = '.$_GET['id']);
    $cargos = $crud->pdo_src('cargo', 'ORDER BY cargo');

    $historico = $crud->query_p('
	 SELECT
		 c.nome, fc.data_hora_ini, fc.data_hora_fin
	 FROM
		 tb_funcionario_contrato fc
		 INNER JOIN tb_contrato c ON c.id_contrato = fc.id_contrato
	 WHERE
		 fc.id_funcionario = '.$_GET['id'].' AND fc.ativo_yn = 0
	 ORDER BY fc.id DESC
 ');

    $contrato = $crud->pdo_src('contrato', 'WHERE id_contrato = '.$proposta['id_contrato']);

?>

<div class="panel panel-default" style="margin: 0 10px 0 10px">
	<div style="font-size: 14pt" class="panel-heading">
		Informações do Funcionário
		<span style="float: right;">
			<?php
            if($contrato != array()){
                ?>
				Contrato Atual: <?= $contrato[0]['nome'] ?>
				<a target='_blank' class='btn-sm btn-primary' href='edita_contrato?id=<?= $proposta['id_contrato'] ?>'>
					ir
				</a>
				<?php
            }
            ?>
		<span>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="cons_1" action="php/edit_funcionario.php" method="POST">

			<input type="hidden" name="id" value="<?= $proposta['id'] ?>" />

			<div class="container-big">

				<div class="panel-body">
					<div class="row">
							<div class="col-md-7">
								<label>Nome.:</label>
								<input required type="text" class="form-control" name="nome" value="<?= $proposta['nome'] ?>"  />
							</div>
							<div class="col-md-3">
								<label>CPF.:</label>
								<input required type="text" class="form-control i-cpf" name="cpf" value="<?= $proposta['cpf'] ?>"/>
							</div>

							<div class="col-md-2">
								<label>Idade.:</label>
								<input required type="text" class="form-control" name="idade" value="<?= $proposta['idade'] ?>"  />
							</div>
					</div>
						<div class="row">
							<div class="col-md-3">
									<label>Cargo: </label>
									<select required class="form-control select_normal" name="id_cargo">
											<option></option>
											<?php
                                            foreach ($cargos as $key) {
                                                    $id = $key['id'];
                                                    $nome = $key['cargo'];

                                                    if($id == $proposta['id_cargo']){
                                                        echo "<option selected value=$id>$nome</option>";
                                                    }else{
                                                        echo "<option value=$id>$nome</option>";
                                                    }

                                            }
                                            ?>
									</select>
							</div>
						<div class="col-md-3">
							<label>RG.:</label>
							<input required type="text" class="form-control" name="rg" value="<?= $proposta['rg'] ?>"  />
						</div>
						<div class="col-md-3">
							<label>Carteira de Trabalho.:</label>
							<input required type="text" class="form-control" name="carteira_trab" value="<?= $proposta['carteira_trab'] ?>"  />
						</div>
						<div class="col-md-3">
							<label>CNH.:</label>
							<input  type="text" class="form-control" name="cnh" value="<?= $proposta['cnh'] ?>"  />
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label>Endereço.:</label>
							<input  type="text" class="form-control" name="endereco" value="<?= $proposta['endereco'] ?>" />
						</div>
						<div class="col-md-3">
							<label>Bairro:</label>
							<input class="form-control" required placeholder="" type="text" name="bairro" value="<?= $proposta['bairro'] ?>" />
						</div>
						<div class="col-md-3">
							<label>Cidade:</label>
							<input class="form-control" required placeholder="" type="text" name="cidade" value="<?= $proposta['cidade'] ?>" />
						</div>
						<div class="col-md-1">
							<label>Estado:</label>
							<input class="form-control" required placeholder="" type="text" name="estado" value="<?= $proposta['estado'] ?>" />
						</div>
						<div class="col-md-2">
							<label>CEP:</label>
							<input class="form-control i-cep" minlength="9" required placeholder="" type="text" name="cep" value="<?= $proposta['cep'] ?>" />
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label>Contato 1:</label>
							<input class="form-control i-fone"  placeholder="" type="text" name="contato_1" value="<?= $proposta['contato_1'] ?>" />
						</div>
						<div class="col-md-3">
							<label>Contato 2:</label>
							<input class="form-control i-fone"  placeholder="" type="text" name="contato_2" value="<?= $proposta['contato_2'] ?>" />
						</div>
						<div class="col-md-6">
							<label>E-mail:</label>
							<input class="form-control"  placeholder="" type="email" name="email" value="<?= $proposta['email'] ?>" />
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-11"></div>
											<div class="col-md-1">
							<button class="btn btn-primary btn-block" type="submit">Salvar</button>
						</div>
					</div>

			</div>

		</form>

	</div>
</div>

<br /><br />

<div class="panel panel-default" style="margin: 0 10px 0 10px">
	<div style="font-size: 14pt" class="panel-heading">
		<a class="text-success" style="cursor: pointer" class="" data-toggle="collapse" data-target="#hist_div">Histórico do Funcionário</a>
		<button class="btn-xs btn-primary" style="margin-left: 15px; float: right;" data-toggle="collapse" data-target="#hist_div">+/-</button>
	</div>
	<div class="panel-body">
		<div class="content collapse" id="hist_div">
			<table class="tablesorter">
				<thead>
					<tr>
						<th>Contrato</th>
						<th>Data de Ingresso</th>
						<th>Data de Saída</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($historico as $key) { ?>
						<tr>
							<td><?= $key['nome'] ?></td>
							<td><?= implode("/", array_reverse(explode('-', explode(" ", $key['data_hora_ini'])[0]))) ?></td>
							<td><?= implode("/", array_reverse(explode('-', explode(" ", $key['data_hora_fin'])[0]))) ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<br />

<div class="panel panel-default" style="margin: 0 10px 0 10px">
		<div style="font-size: 14pt" class="panel-heading">
			<a class="text-success" style="cursor: pointer;" data-toggle="collapse" data-target="#doc_eq">Documentos do Funcionário</a>
			<button class="btn-xs btn-primary" style="margin-left: 15px; float: right;" data-toggle="collapse" data-target="#doc_eq">+/-</button>
		</div>
		<div class="panel-body">
			<div id="doc_eq" class="container-big collapse" style="margin: 10px;">

				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Novo Documento
					</div>
					<div class="panel-body">
						<form action="php/add_doc_funcionario.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="id_funcionario" value="<?= $_GET['id'] ?>" />
							<div class="content">
								<div class="col-md-4">
									&nbsp;
								    <input class="form-control" required type="file" name="documento" />
								</div>
								<div class="col-md-7">
									Nome:
									<input class="form-control" required name="nome" placeholder="Nome do Documento Aqui." />
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
						Documentos
					</div>
					<div class="panel-body">
						<div class="content">
							<?php foreach ($documentos as $documento) { ?>
								<div class="row">
										<div class="col-md-12">
											<a onclick="return confirm('Essa ação não pode ser desfeita! Tem certeza?')" class="btn-sm btn-danger" href="php/del_doc_funcionario.php?id=<?= $documento['id'] ?>">X</a>
											<a href="<?= substr($documento['documento'], 3) ?>" target="_blank">
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

	<br />

	<div style="margin: 10px;" class="panel panel-default">
		<div style="font-size: 14pt" class="panel-heading">
			<a class="text-success" style="cursor: pointer;" data-toggle="collapse" data-target="#fotos">Foto do Funcionário</a>
			<button class="btn-xs btn-primary" style="margin-left: 15px; float: right;" data-toggle="collapse" data-target="#fotos">+/-</button>
		</div>
		<div class="panel-body">
			<div id="fotos" class="container-big collapse" style="margin: 10px;">

				<?php if (!isset($fotos[0])) { ?>
					<div class="panel panel-success">
						<div style="font-size: 14pt" class="panel-heading">
							Adicionar Foto
						</div>
						<div class="panel-body">
							<form action="php/add_foto_funcionario.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="id_funcionario" value="<?= $_GET['id'] ?>" />
								<div class="content">
									<div class="col-md-4">
									    <input class="form-control" required type="file" name="imagem" />
									</div>
									<div class="col-md-7">
										<input class="form-control" required name="descr" placeholder="Descrição da Foto Aqui." />
									</div>
									<div class="col-md-1">
										<button class="btn btn-success btn-block" type="submit">Salvar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				<?php } ?>


				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Foto
					</div>
					<div class="panel-body">
						<div class="content">
							<?php foreach ($fotos as $foto) { ?>
								<div class="col-md-3 text-center">
									<a onclick="return confirm('Essa ação não pode ser desfeita! Tem certeza?')" class="btn-sm btn-danger" href="<?= $_SESSION['id_usuario'] == "1" || $_SESSION['id_usuario'] == "16" || $_SESSION['id_usuario'] == "20" ? "php/del_foto_funcionario.php?id=" . $foto['id'] : "" ?>">Remover</a>
									<br />
									<a href="<?= substr($foto['imagem'], 3) ?>" target="_blank">
									<img style="width: 300px;" src="<?= substr($foto['imagem'], 3) ?>" /></a>
									<br /><br />
									<?= ucfirst($foto['descr']) ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<br /><br /><br /><br />
