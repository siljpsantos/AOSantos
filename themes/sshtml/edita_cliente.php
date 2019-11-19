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

	$proposta = $crud->pdo_src('cliente', 'WHERE id = '.$_GET['id'])[0];
	// $unidades = $crud->pdo_src('unidade', 'order by nome ');

	// $hist = $crud->query_p('
	// 	SELECT u.nome, h.*
	// 	FROM tb_hist_equip_ti h
	// 	INNER JOIN tb_unidade u ON u.id_unidade = h.id_unidade
	// 	WHERE h.id_equip_ti = '.$_GET['id'].'
	// 	ORDER BY data_entrega DESC
	// ');

?>


<div class="panel panel-default" style="margin: 0 10px 0 10px">
	<div style="font-size: 14pt" class="panel-heading">
		Informações do cliente
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" id="cons_1" action="php/edita_cliente.php" method="POST">

			<input type="hidden" name="id" value="<?= $proposta['id'] ?>" />

			<div class="container-big">

					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<label>Nome.:</label>
								<input required type="text" class="form-control" name="nome" value="<?= $proposta['nome'] ?>" />
							</div>
						<div class="col-md-3">
							<label>CNPJ.:</label>
							<input required type="text" class="form-control" name="cnpj" value="<?= $proposta['cnpj'] ?>" />
						</div>
						<div class="col-md-3">
							<label>Email.:</label>
							<input  type="text" class="form-control" name="email" value="<?= $proposta['email'] ?>" />
						</div>
            <div class="col-md-3">
							<label>Inscrição Estadual.:</label>
							<input  type="text" class="form-control" name="inscricao_estadual" value="<?= $proposta['inscricao_estadual'] ?>" />
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
