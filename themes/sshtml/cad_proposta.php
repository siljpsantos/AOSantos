<?php

	//protege entrada sem login
	if(@$_SESSION != array()){
		// if(@$_SESSION['perm_frota'] == "1"){
		//
		// }else{
		// 	echo "<script>window.location.href='403';</script>";
		// }
	}else{
		echo "<script>window.location.href='index.php';</script>";
	}

	$loc = $crud->pdo_src('cliente', '');
	//calcula numero da proposta
	@$n_proposta = $crud->query_p('SELECT num_proposta as num FROM tb_proposta WHERE YEAR(data_criacao) = 2019 ');

	$props = array();
	foreach($n_proposta as $key){
		$props[] = explode("/",$key[0])[0];
	}
	$prop = max($props);

	/*echo "<pre>";
	print_r($prop);
	echo "</pre>";*/


	@$prox_proposta = $prop + 1;

	$n_proposta = sprintf('%04d', $prox_proposta) . "/" . substr(date('y'),0);

?>
<div style="margin: 0 10px 0 10px">
<div class="panel panel-default">
	<div style="font-size: 14pt" class="panel-heading">Informações da Proposta</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="cons_1" action="php/add_proposta.php" method="POST">

			<input type="hidden" class="form-control" name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>"/>

			<div class="container-big">
				<div class="row">
					<div class="col-md-4">
						<label>Nome do Contato:</label>
						<input required type="text" class="form-control" name="contato" />
					</div>
					<div class="col-md-2">
						<label>N° da Proposta:</label>
						<input required type="text" class="form-control" name="num_proposta" value="<?= $n_proposta ?>" />
					</div>
					<div class="col-md-6">
						<label>Endereço:</label>
						<input required type="text" class="form-control" name="local" />
					</div>
					<div class="col-md-2 text-justify">
						<label>Tempo de Contrato (meses)</label>
						<input required type="number" class="form-control" name="tempo_contrato" value="" />
					</div>
					<div class="col-md-2">
              <label>Validade da Proposta: </label>
              <input required class="form-control" type="date" name="data_val" value="<?= date('Y-m-d', strtotime('+1 month')) ?>" />
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

          <div style="display: none;">

          	<input type="hidden" name="objeto" value='Prestação de Serviços' />

          	<input type="hidden" name="escopo" value='Prestação de Serviços' />

						
          	<textarea name="grupo5"><p>
		        Obs. 2: Fica expresso nesta, que nossa empresa se compromete a manter o
		        quadro de funcionário sempre completo;
					 	</p></textarea>

						<textarea name="grupo6"><p> </p></textarea>

						<textarea name="grupo7"><p>
				        Obs. 3: Conforme o acordo, nossa empresa fornecerá toda parte de uniforme,
				        cabendo o restante dos equipamentos a serem fornecidos pela CONTRATANTE.</p>
				    <p>
				        B. ) Os encargos sociais dos funcionários, serão pagos pela AOSantos como
				        INSS, FGTS e Contribuição Sindical.</p>
				    <p>
				        C. ) Caso houver qualquer tipo de acidente trabalhista na CONTRATANTE, com
				        nossos funcionários, a responsabilidade será de nossa empresa.</p>
				    <p>
				        D. ) O horário de almoço ficará de responsabilidade da contratante.</p>
				    <p>
				        E. ) A data de pagamento dos será acordada com CONTRATANTE.</p>
				    <p>
				        F. ) Os valores descritos, sofrem reajuste anual, conforme o índice da
				        SENECAAERJ (Sindicato dos Empregado em Centrais de Abastecimento do Estado
				        do RJ)
				    </p></textarea>

						<textarea name="grupo8"><p>8.1. </p></textarea>

						<textarea name="grupo9"><p>9.1. </p></textarea>

          </div>

				<div class="row">
					<div class="col-md-10"></div>
            		<div class="col-md-2">
						<button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
					</div>
				</div>
			</div>

		</form>

	</div>
</div>
