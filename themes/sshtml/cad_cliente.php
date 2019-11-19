<?php


	// $proposta = $crud->pdo_src('equip_ti', 'WHERE id = '.$_GET['id'])[0];
	// $marcas = $crud->pdo_src('marca_equip_ti', 'order by marca_equip_ti ');
	// //$modelos = $crud->pdo_src('modelo_equip_ti', 'order by modelo_equip_ti ');
	// $categorias = $crud->pdo_src('categoria_equip_ti', 'order by categoria_equip_ti ');
	// $unidades = $crud->pdo_src('unidade', 'order by nome ');

?>

<div class="panel panel-default" style="margin: 0 10px 0 10px">
	<div style="font-size: 14pt" class="panel-heading">
		Cadastro de Cliente
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="cons_1" action="php/cad_cliente.php" method="POST">
			<div class="container-big">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<label>Nome.:</label>
								<input required type="text" class="form-control" name="nome"  />
							</div>
						<div class="col-md-3">
							<label>CNPJ.:</label>
							<input required type="text" class="form-control" name="cnpj"  />
						</div>
						<div class="col-md-3">
							<label>E-mail.:</label>
							<input  type="text" class="form-control" name="email"  />
						</div>
						<div class="col-md-3">
							<label>Inscrição Estadual:</label>
							<input  type="text" class="form-control" name="inscricao_estadual"  />
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
