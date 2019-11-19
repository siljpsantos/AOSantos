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


	$loc = $crud->pdo_src('cliente','');
	$proposta = $crud->pdo_src('proposta', 'WHERE id = '.$_GET['id'])[0];

	$contratos = $crud->pdo_src('contrato', '/*WHERE id_proposta = 0 OR id_proposta != '.$_GET['id'].' ORDER BY nome*/');
	$documentos = $crud->pdo_src('doc_proposta', 'WHERE id_proposta = '.$_GET['id']);

?>
<script>
	function termo_obrigatório(){
    	var contrato = $('#contrato_slc option:selected').val();
    	if(contrato != ''){
    		$('#termo').prop('required',true);
    	}else{
    		$('#termo').prop('required',false);
    	}
    }
    function buscar_tipo(){
      var classe = $('#classe_select option:selected').val();
      if(classe){
        var url = 'php/a-ajax_buscar_tipo.php?classe='+classe;
        $.get(url, function(dataReturn) {
          $('#retorno_tipo').html(dataReturn);
          //buscar_capacidade();
        });
      }
    }
    function buscar_subtipo(){
      var tipo = $('#select_tipo option:selected').val();
      if(tipo){
        var url = 'php/a-ajax_buscar_subtipo.php?tipo='+tipo;
        $.get(url, function(dataReturn) {
          $('#retorno_subtipo').html(dataReturn);
          buscar_capacidade();
        });
      }
    }
    function buscar_capacidade(){
      var tipo = $('#select_tipo option:selected').val();
      if(tipo){
        var url = 'php/a-ajax_buscar_capacidade.php?tipo='+tipo;
        $.get(url, function(dataReturn) {
          $('#retorno_capacidade').html(dataReturn);
        });
      }
    }
    function buscar_categoria(){
      var tipo = $('#select_tipo option:selected').val();
      if(tipo){
        var url = 'php/a-ajax_buscar_categoria.php?tipo='+tipo;
        $.get(url, function(dataReturn) {
          $('#retorno_categoria').html(dataReturn);
        });
      }
    }
    <?php
    if($proposta['id_contrato']!="0"){
		echo '
			$( document ).ready(function() {
			    $(":input").prop("disabled", true);
			});
		';

		$del = "style='display: none;'";
	}
    ?>
</script>
<div class="panel panel-default" style="margin: 0 10px 0 10px">
	<div style="font-size: 14pt" class="panel-heading">
		Informações da Proposta
		<div style="float: right;"><a target="_blank" class="btn btn-warning" href="php/envia_proposta.php?id=<?= $_GET['id'] ?>">Enviar</a></div>
		<div style="float: right; margin-right: 10px;"><a target="_blank" class="btn btn-success" href="impr_proposta?id=<?= $_GET['id'] ?>">Imprimir Proposta</a></div>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="cons_1" action="php/edit_proposta.php" method="POST">

			<input type="hidden" name="id" value="<?= $proposta['id'] ?>" />

			<div class="container-big">
				<div class="panel panel-default bg-escuro">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4">
								<label>Nome do Contato:</label>
								<input required type="text" class="form-control" name="contato" value="<?= $proposta['contato'] ?>" />
							</div>
							<div class="col-md-2">
								<label>N° da Proposta:</label>
								<input required type="text" class="form-control" name="num_proposta" value="<?= $proposta['num_proposta'] ?>" />
							</div>
							<div class="col-md-2">
								<label>Cliente:</label>
								<select class="form-control" required name="id_cliente">
									<option></option>
									<?php
										foreach($loc as $index=>$key){

											$id = $key['id'];
											$nome = $key['nome'];

											if($id == $proposta['id_cliente']){
												echo "<option selected value='$id'>$nome</option>";
											}else{
												echo "<option value='$id'>$nome</option>";
											}

										}
									?>
								</select>
							</div>
							<!--<div class="col-md-10">
								<label>Local:</label>
								<input required type="text" class="form-control" name="local" value="<?= $proposta['local'] ?>" />
							</div>-->
							<div class="col-md-2">
		                        <label>Validade da Proposta: </label>
		                        <input required class="form-control" type="date" name="data_val" value="<?= date('Y-m-d', strtotime('+1 week')) ?>" />
		                    </div>
		                    <div class="col-md-2">
		                        <label>Data de Criação: </label>
		                        <input disabled class="form-control" type="date"  value="<?= $proposta['data_criacao'] ?>" />
		                    </div>
		                    <div class="col-md-2">
		                        <label>Data de Atualização: </label>
		                        <input disabled class="form-control" type="date"  value="<?= $proposta['data_att'] ?>" />
		                    </div>
												<div class="col-md-2">
													Aceita?
													<select style="width: 100%" class="form-control select_normal" required name="ass">
														<option <?= $proposta['ass'] == "0" ? "selected" : "" ?> value=0>Não</option>
														<option <?= $proposta['ass'] == "1" ? "selected" : "" ?> value=1>Sim</option>
													</select>
												</div>
		                    <!--<div class="col-md-6">
								<label>Contrato Referente:</label>
								<?php if($proposta['id_contrato'] != 0){ ?>
									<a onclick="window.open('edita_contrato?id=<?= $proposta['id_contrato'] ?>');" style="cursor: pointer;" class="btn-xs btn-primary"><img style="margin-right: 5px;" width=12 src="themes/sshtml/img/new_pg.png" /></a>
								<?php } ?>
								<select onchange="termo_obrigatório();"; class="form-control" name="id_contrato" id="contrato_slc">
									<option></option>
									<?php
										foreach($contratos as $index=>$key){

											$id = $key['id_contrato'];
											$nome = $key['nome'];

											if($id == $proposta['id_contrato']){
												echo "<option selected value='$id'>$nome</option>";
											}else{
												echo "<option value='$id'>$nome</option>";
											}

										}
									?>
								</select>
							</div>-->

							<div class="col-md-12">
								<h4>
									Cláusulas Detalhadas <a class="btn-sm btn-primary" style="margin-left: 15px;" onclick="return false;" href="#" data-toggle="collapse" data-target="#clausulas_div">+/-</a>
								</h4>
							</div>

							<div class="col-md-12">
								<div id="clausulas_div" class="panel panel-default bg-escuro collapse">
									<div class="col-md-6 text-justify">
										<label>01 - OBJETO</label>
										<input class="form-control" type="text" name="objeto" value='<?= $proposta['objeto'] ?>' />
									</div>
									<div class="col-md-6 text-justify">
										<label>02 - ESCOPO DO SERVIÇO</label>
                    <input class="form-control" type="text" name="escopo" value='<?= $proposta['escopo'] ?>' />
									</div>
									<div class="col-md-6 text-justify">
										<label>03 - LOCAL DO PROJETO</label>
										<input type="text" class="form-control" name="local" value="<?= $proposta['local'] ?>" />
									</div>
									<div class="col-md-6 text-justify">
										<label>04 - TEMPO DE CONTRATO (MESES)</label>
										<input required type="number" class="form-control" name="tempo_contrato" value="<?= $proposta['tempo_contrato'] ?>" />
									</div>
									<div class="col-md-12 text-justify">
										<label>05 -TRABALHO NOTURNO</label>
										<textarea class="form-control" name="grupo5" rows=7><?= $proposta['grupo5'] ?></textarea>
									</div>
									<div class="col-md-12 text-justify">
										<label>06 - FUNCIONÁRIOS</label>
										<textarea class="form-control" name="grupo6" rows=7><?= $proposta['grupo6'] ?></textarea>
									</div>
									<div class="col-md-12 text-justify">
										<label>07 - OBRIGAÇÃO DO CONTRATANTE</label>
										<textarea class="form-control" name="grupo7" rows=7><?= $proposta['grupo7'] ?></textarea>
									</div>

									<!-- <div class="col-md-12 text-justify">
										<label>08 - CONDIÇÕES ESPECIAIS</label>
										<textarea class="form-control" name="grupo8" rows=7><?= $proposta['grupo8'] ?></textarea>
									</div>
									<div class="col-md-12 text-justify">
										<label>09 - FATURAMENTO E PAGAMENTO</label>
										<textarea class="form-control" name="grupo9" rows=7><?= $proposta['grupo9'] ?></textarea>
									</div> -->
								</div>
							</div>

							<!--<div class="col-md-12 text-justify">
								<div class="form-check">
									<label>
										<input id="termo" type='checkbox' />
										<span class="label-text">Ao registrar um Contrato na presente Proposta, atesto que a Proposta foi aprovada pelo Cliente e corresponde aos itens finais que comporão o contrato. Atesto também que estou ciente que o Contrato selecionado será associado à mesma, utilizando seus itens e valores na composição do Contrato final e que esta proposta só estará disponível, daqui para frente, para impressão e consulta dentro do contrato, significando sua não acessibilidade pela lista e não editabilidade.</span>
									</label>
								</div>
							</div>-->

						</div>
						<div class="row">
							<div class="col-md-11"></div>
		                    <div class="col-md-1">
								<button class="btn btn-primary btn-block" type="submit">Salvar</button>
							</div>
						</div>

					</div>
				</div>
			</div>

		</form>

	</div>
</div>

<br />

<div class="panel panel-default" style="margin: 0 10px 0 10px">
		<div style="font-size: 14pt" class="panel-heading">
			<a class="text-success" style="cursor: pointer;" data-toggle="collapse" data-target="#doc_eq">Documentos da Proposta</a>
			<button class="btn-xs btn-primary" style="margin-left: 15px; float: right;" data-toggle="collapse" data-target="#doc_eq">+/-</button>
		</div>
		<div class="panel-body">
			<div id="doc_eq" class="container-big collapse" style="margin: 10px;">

				<div class="panel panel-success">
					<div style="font-size: 14pt" class="panel-heading">
						Novo Documento
					</div>
					<div class="panel-body">
						<form action="php/add_doc_proposta.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="id_proposta" value="<?= $_GET['id'] ?>" />
							<input type="hidden" name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>" />
							<div class="content">
								<div class="col-md-4">
									&nbsp;
								    <input class="form-control" required type="file" name="documento" />
								</div>
								<div class="col-md-4">
									Nome:
									<input class="form-control" required name="nome" placeholder="Nome do Documento Aqui." />
								</div>
								<?php if($proposta['ass']==0){ ?>
									<div class="col-md-2" style="display: none;">
										Assinatura:
										<select style="width: 100%" class="form-control select_normal" required name="ass">
											<option selected value=0>Não</option>
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
						Documentos
					</div>
					<div class="panel-body">
						<div class="content">
							<?php foreach($documentos as $documento){ ?>
								<div class="row">
									<?php if($documento['ass']==0){ ?>
										<div class="col-md-12">
											<?php /*if($dis_doc){*/ if(true){ ?>
												<a onclick="return confirm('Essa ação não pode ser desfeita! Tem certeza?')" class="btn-sm btn-danger" href="php/del_doc_proposta.php?id=<?= $documento['id'] ?>">X</a>
											&nbsp;
										<?php } ?>
									<?php }else{ ?>
										<div class="col-md-12">
											<a style="color: white; cursor: pointer;" class="btn-sm btn-default">X</a>
										&nbsp;
									<?php } ?>
										<a href="<?= substr($documento['documento'],3) ?>" target="_blank">
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
