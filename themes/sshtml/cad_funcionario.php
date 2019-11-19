<?php

	//protege entrada sem permissão
	if(@$_SESSION == array()){
		echo "<script>window.location.href='" . HOME . "/403';</script>";
	}else{
		// if (false) {
		// } else {
		// 	echo "<script>window.location.href='" . HOME . "/403';</script>";
		// }
	}

	$cargos = $crud->pdo_src('cargo', 'ORDER BY cargo');

	// $proposta = $crud->pdo_src('equip_ti', 'WHERE id = '.$_GET['id'])[0];
	// $marcas = $crud->pdo_src('marca_equip_ti', 'order by marca_equip_ti ');
	//$modelos = $crud->pdo_src('modelo_equip_ti', 'order by modelo_equip_ti ');
	// $categorias = $crud->pdo_src('categoria_equip_ti', 'order by categoria_equip_ti ');

?>

<!-- <script>
function buscar_marca(){
	if(true){
		var url = 'php/a-ajax_buscar_marca_equip_ti.php';
		$.get(url, function(dataReturn) {
			$('#retorno_marca').html(dataReturn);
		});
	}
}
function buscar_modelo(){
	var marca = $('#select_marca_cad option:selected').val();
	if(marca){
		var url = 'php/a-ajax_buscar_modelo_equip_ti.php?marca='+marca;
		$.get(url, function(dataReturn) {
			$('#retorno_modelo').html(dataReturn);
		});
	}
}
function buscar_categoria(){
	if(true){
		var url = 'php/a-ajax_buscar_categoria_equip_ti.php';
		$.get(url, function(dataReturn) {
			$('#retorno_categoria').html(dataReturn);
		});
	}
}
</script> -->

<div class="panel panel-default" style="margin: 0 10px 0 10px">
	<div style="font-size: 14pt" class="panel-heading">
	Informações do Funcionário
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="cons_1" action="php/add_funcionario.php" method="POST">



			<div class="container-big">

					<div class="panel-body">
						<div class="row">
								<div class="col-md-7">
									<label>Nome.:</label>
									<input required type="text" class="form-control" name="nome"  />
								</div>
								<div class="col-md-3">
									<label>CPF.:</label>
									<input required type="text" class="form-control i-cpf" name="cpf"/>
								</div>
								<div class="col-md-2">
									<label>Idade.:</label>
									<input required type="text" class="form-control" name="idade"  />
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

								            //if($id == $equip['id_cargo']){
								            //	echo "<option selected value=$id>$nome</option>";
								            //}else{
								            	echo "<option value=$id>$nome</option>";
								            //}

								        }
								        ?>
								    </select>
								</div>

							<div class="col-md-3">
								<label>RG.:</label>
								<input required type="text" class="form-control" name="rg"  />
							</div>
							<div class="col-md-3">
								<label>Carteira de Trabalho.:</label>
								<input required type="text" class="form-control" name="carteira_trab"  />
							</div>
							<div class="col-md-3">
								<label>CNH.:</label>
								<input  type="text" class="form-control" name="cnh"  />
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label>Endereço.:</label>
								<input  type="text" class="form-control" name="endereco"  />
							</div>
							<div class="col-md-3">
								<label>Bairro:</label>
								<input class="form-control" required placeholder="" type="text" name="bairro" />
							</div>
							<div class="col-md-3">
								<label>Cidade:</label>
								<input class="form-control" required placeholder="" type="text" name="cidade" />
							</div>
							<div class="col-md-1">
								<label>Estado:</label>
								<input class="form-control" required placeholder="" type="text" name="estado" />
							</div>
							<div class="col-md-2">
								<label>CEP:</label>
								<input class="form-control i-cep" minlength="9" required placeholder="" type="text" name="cep" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label>Contato 1:</label>
								<input class="form-control i-fone"  placeholder="" type="text" name="contato_1" />
							</div>
							<div class="col-md-3">
								<label>Contato 2:</label>
								<input class="form-control i-fone"  placeholder="" type="text" name="contato_2" />
							</div>
							<div class="col-md-6">
								<label>Email:</label>
								<input class="form-control"  placeholder="" type="email" name="email" />
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

			</div>

		</form>

	</div>
</div>



<br /><br /><br /><br />
