<?php

    //protege de entrada sem login
    if ($_SESSION != array()) {

    }else {
        echo "<script>window.location.href='" . HOME . "/403';</script>";
    }

    $usuario = $crud->pdo_src('usuario', 'WHERE id_usuario = ' . base64_decode($_GET['id']) )[0];

?>

<style>
.grade{
	border: 1px solid #193854;
	margin: 2px;
	padding-bottom: 15px;
	border-radius: 7px;
	background-color: #275f91;
	width: 250px;
	color: #b8d6f2;
}
.grade-vermelha{
	border: 1px solid #541919;
	margin: 2px;
	padding-bottom: 15px;
	border-radius: 7px;
	background-color: #912727;
	width: 250px;
	color: #f2b8b8;
}
.grade h4{
	color: #ddd;
}
</style>

<div style="margin: 0 10px 0 10px">

	<div class="panel panel-default">
	    <div style="font-size: 14pt" class="panel-heading">Edição de Usuário</div>
	    <div class="panel-body">

	        <form role="form" action="php/edit_usuario.php" method="post">

	            <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario'] ?>" />

	            <h4>Info. usuario</h4>

	            <div class="panel panel-default bg-escuro">
					<div class="panel-body">

						<div class="col-md-3">
				            <label>Nome: </label>
							<input required class="form-control" type="text" name="nome_usuario" value="<?= $usuario['nome_usuario'] ?>" />
						</div>

						<?php if ($nivel_adm) { ?>
							<div class="col-md-3">
								<label>Nível: </label>
								<select required class="form-control select_normal" type="text" name="nivel_usuario">
									<option <?= $usuario['nivel_usuario'] == 'user' ? 'selected' : '' ?> value="user">Usuário</option>
									<option <?= $usuario['nivel_usuario'] == 'adm' ? 'selected' : '' ?> value="adm">Administrador</option>
								</select>
							</div>
						<?php } ?>

						<div class="col-md-3">
							<label>Login: </label>
							<input required class="form-control" type="text" name="login_usuario" value="<?= $usuario['login_usuario'] ?>" />
						</div>

					</div>
				</div>
<!--
				<?php if ($_SESSION['nivel_usuario'] == "adm") { ?>

					<?php //if($_SESSION['id_usuario'] == '1' ){ ?>

						<h4>Permissões</h4>

						<hr></hr>

						<div class="panel panel-default bg-escuro">
							<div class="panel-body">

								<div class="col-md-2 grade">
									<div class="form-check">
										<h4>Utilitários</h4>
										<label>
											<input <?= $usuario['perm_modulos'] == '1' ? 'checked' : '' ?> type='checkbox' name='perm_modulos' />
											<span class="label-text">Módulos Isolados</span>
										</label>
									</div>
								</div>

								<div class="col-md-2 grade">
									<div class="form-check">
										<h4>Ordens de Serviço</h4>
										<label>
											<input <?= $usuario['perm_os'] >= '1' ? 'checked' : '' ?> type='checkbox' name='perm_os' />
											<span class="label-text">Ver</span>
										</label>
										 -
										<label>
											<input <?= $usuario['perm_os'] == '2' ? 'checked' : '' ?> type='checkbox' name='perm_os_1' />
											<span class="label-text">Cadastrar/Editar</span>
										</label>
									</div>
								</div>

								<div class="col-md-2 grade">
									<div class="form-check">
										<h4>Comercial</h4>
										<label>
											<input <?= $usuario['perm_frota'] == '1' ? 'checked' : '' ?> type='checkbox' name='perm_frota' />
											<span class="label-text">Locação</span>
										</label>
										<label>
											<input <?= $usuario['perm_adm'] == '1' ? 'checked' : '' ?> type='checkbox' name='perm_adm' />
											<span class="label-text">Compra/Venda</span>
										</label>
									</div>
								</div>


								<div class="col-md-3 grade">
									<div class="form-check">
										<h4>Almoxarifado</h4>
										<label>
											<input <?= $usuario['perm_almox'] == '1' ? 'checked' : '' ?> type='checkbox' name='perm_almox' />
											<span class="label-text">Controle Total</span>
										</label>
									</div>
								</div>

								<div class="col-md-2 grade">
									<div class="form-check">
										<h4>Manutenção</h4>
										<label>
											<input <?= $usuario['perm_manut'] == '1' ? 'checked' : '' ?> type='checkbox' name='perm_manut' />
											<span class="label-text">Controle Total</span>
										</label>
									</div>
								</div>

                <div class="col-md-2 grade">
									<div class="form-check">
										<h4>Documentação</h4>
										<label>
											<input <?= $usuario['perm_doc'] == '1' ? 'checked' : '' ?> type='checkbox' name='perm_doc' />
											<span class="label-text">Remover</span>
										</label>
									</div>
								</div>

                <?php if($_SESSION['id_usuario'] =="1"){ ?>

                  <div class="col-md-3 grade">
        						<div class="form-check">
        							<h4>T.I.</h4>
        							<label>
        								<input <?= $usuario['perm_ti'] == '1' ? 'checked' : '' ?> type='checkbox' name='perm_ti' />
        								<span class="label-text">Controle Total</span>
        							</label>
        						</div>
        					</div>

                <?php } ?>

                <div class="col-md-2 grade-vermelha">
									<div class="form-check">
										<h4>Somente Leitura</h4>
										<label>
											<input <?= $usuario['somente_leitura'] == '1' ? 'checked' : '' ?> type='checkbox' name='somente_leitura' />
											<span class="label-text">Somente Leitura</span>
										</label>
									</div>
								</div>

							</div>
						</div>

					<?php //} ?>

				<?php } ?>

	            <div class="col-md-12">
					&nbsp;
				</div>-->

				<div class="col-md-11"></div>
        <div class="col-md-1">
					<button class="btn btn-primary btn-block" type="submit">Salvar</button>
				</div>

	        </form>

		    <div class="col-md-12">
				&nbsp;
			</div>

	    </div>
	</div>

	<div class="panel panel-default panel-success">
	    <div style="font-size: 14pt" class="panel-heading">Trocar senha</div>
	    <div class="panel-body">
	        <form role="form" action="php/edit_senha.php" method="POST">

	            <input type="hidden" name="id" value="<?php echo $usuario['id_usuario'] ?>" />

              <!--<div class="col-md-3">
		            <label>Senha antiga: </label>
		            <input class="form-control" type="password" name="antiga" />
		        </div>-->
		        <div class="col-md-3">
		            <label>Nova senha: </label>
		            <input class="form-control" type="password" name="nova" />
	            </div>
	            <div class="col-md-3">
		            <label>Confima senha: </label>
		            <input class="form-control" type="password" name="confirma" />
		        </div>

		        <div class="col-md-5"></div>

		        <div class="col-md-1">
		        	&nbsp;
		            <button style="float: right; width: 100px;" class="btn btn-primary">Salvar</button>
		        </div>

	        </form>
	    </div>
	</div>

</div>

<br /><br />
