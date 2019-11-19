<?php

    //protege de entrada sem ser ADM
    if ($_SESSION != array()) {
        if ($_SESSION['nivel_usuario'] == 'adm') {
        } else {
            echo "<script>window.location.href='" . HOME . "/403';</script>";
        }
    } else {
        echo "<script>window.location.href='" . HOME . "/403';</script>";
    }

    function senha() {


        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

?>

<div class="marginsides10">
<div class="panel panel-default">
    <div  class="font14 panel-heading">Cadastro de usuário</div>
    <div class="panel-body">

      <form class="form" role="form" action="php/add_usuario.php" method="POST">

			<input type="hidden" name="ativo_usuario" value="1" />
      <div class="row">

        <div class="col-md-2">
			       <label>Nome: </label>
			       <input required class="form-control" type="text" name="nome_usuario" />
        </div>

        <div class="col-md-2">
			       <label>Login: </label>
			       <input required class="form-control" type="text" name="login_usuario" />
        </div>
        <div class="col-md-2">
			       <label>Senha: </label>
			       <input required class="form-control" value="<?php echo senha(); ?>" type="text" name="senha_usuario" />
        </div>
        <div class="col-md-2">
	       <label>Nível: </label>
	       <select required class="form-control select_normal" type="text" name="nivel_usuario">
		           <option value="user">Usuário</option>
		           <option value="adm">Administrador</option>
         </select>
       </div>


<!--
			<h2>Permissões</h2>

			<hr></hr>

			<div class="panel panel-default bg-escuro">
				<div class="panel-body">

					<div class="col-md-3 grade">
						<div class="form-check">
							<h4>Utilitários</h4>
							<label>
								<input type='checkbox' name='perm_modulos' />
								<span class="label-text">Módulos Isolados</span>
							</label>
						</div>
					</div>

					<div class="col-md-3 grade">
						<div class="form-check">
							<h4>Ordens de Serviço</h4>
							<label>
								<input type='checkbox' name='perm_os' />
								<span class="label-text">Ver</span>
							</label>
							 -
							<label>
								<input type='checkbox' name='perm_os_1' />
								<span class="label-text">Cadastrar/Editar</span>
							</label>
						</div>
					</div>

					<div class="col-md-3 grade">
						<div class="form-check">
							<h4>Comercial</h4>
							<label>
								<input type='checkbox' name='perm_frota' />
								<span class="label-text">Locação</span>
							</label>
							<label>
								<input type='checkbox' name='perm_adm' />
								<span class="label-text">Compra/Venda</span>
							</label>
						</div>
					</div>


					<div class="col-md-3 grade">
						<div class="form-check">
							<h4>Almoxarifado</h4>
							<label>
								<input type='checkbox' name='perm_almox' />
								<span class="label-text">Controle Total</span>
							</label>
						</div>
					</div>

					<div class="col-md-3 grade">
						<div class="form-check">
							<h4>Manutenção</h4>
							<label>
								<input type='checkbox' name='perm_manut' />
								<span class="label-text">Controle Total</span>
							</label>
						</div>
					</div>

          <div class="col-md-3 grade">
						<div class="form-check">
							<h4>Documentação</h4>
							<label>
								<input type='checkbox' name='perm_doc' />
								<span class="label-text">Remover</span>
							</label>
						</div>
					</div>

          <?php if ($_SESSION['id_usuario'] == "1") { ?>

            <div class="col-md-3 grade">
  						<div class="form-check">
  							<h4>T.I.</h4>
  							<label>
  								<input type='checkbox' name='perm_ti' />
  								<span class="label-text">Controle Total</span>
  							</label>
  						</div>
  					</div>

          <?php } ?>

          <div class="col-md-2 grade-vermelha">
            <div class="form-check">
              <h4>Somente Leitura</h4>
              <label>
                <input type='checkbox' name='somente_leitura' />
                <span class="label-text">Somente Leitura</span>
              </label>
            </div>
          </div>

				</div>
			</div> -->




      <div class="col-md-2">
        <label></label>
				<button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
			</div>
    </div>

        </form>
    </div>
</div>
</div>
