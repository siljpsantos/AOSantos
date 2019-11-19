<?php
$cargo = $crud->pdo_src('cargo', 'ORDER BY cargo');

//protege de entrada sem login
if(@$_SESSION != array()){
    // if(@$_SESSION['perm_modulos'] == "1"){
    //
    // }else{
    // 	echo "<script>window.location.href='403';</script>";
    // }
}else{
    echo "<script>window.location.href='index.php';</script>";
}
?>

<style>
    .btn span.glyphicon {
        opacity: 0;
    }
    .btn.active span.glyphicon {
        opacity: 1;
    }
    .material-switch > input[type="checkbox"] {
        display: none;
    }
</style>
<div style="margin: 0 10px 0 10px">
<div class="panel panel-default">
    <div style="font-size: 14pt" class="panel-heading">Cargos</div>
    <div class="panel-body">

		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<form class='form form-inline' action="php/add_cargo.php" method="POST">
						<tr>
							<td>
								Cargo:
								<input required  class="form-control" type="text" name="cargo" />

							</td>
							<td style="width: 100px;">
								<br />
								<button class='btn btn-primary' >Cadastrar</button>
							</td>
						</tr>
					</form>
				</thead>
				<tbody>
					<?php foreach ($cargo as $key) { ?>
						<tr>
							<form class='form form-inline' action="php/edit_cargo.php" method="POST">
								<input type="hidden" name="id" value="<?= $key['id'] ?>" />
								<td>
									<input class="form-control" value="<?= $key['cargo'] ?>" type="text" name="cargo" />
								</td>
								<td style="width: 100px;">
									<button class='btn btn-primary'>&nbsp;&nbsp; Salvar &nbsp;&nbsp;</button>
								</td>
							</form>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

    </div>
</div>
<?php //print_r($_SESSION) ?>
<?php //echo '<script>prompt("Enter your PIN","Enter your PIN");</script>'; ?>
