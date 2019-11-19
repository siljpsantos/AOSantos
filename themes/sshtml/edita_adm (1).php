<?php
	
    //protege de entrada sem login
    if ($_SESSION != array()) {
        if ($_SESSION['nivel_usuario'] != 'adm') {
            echo "<script>window.location.href='" . HOME . "/403';</script>";
        }
    }else {
        echo "<script>window.location.href='" . HOME . "/403';</script>";
    }
	
    $adm = $crud->pdo_src('usuario', 'WHERE id_usuario = ' . $_GET['id']);
	
?>
		
<div class="panel panel-default">
    <div style="font-size: 14pt" class="panel-heading">Edição do Administrador</div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" action="php/edit_usuario.php" method="post">

            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />

            <div class="container-big">
                <div class="content">
                    
                    <div class="row">
                        <div class="col-md-3">
                            <label>Nome: </label>
                            <input class="form-control" value="<?php echo $adm[0]['nome_usuario'] ?>" type="text" name="nome" />
                        </div>
                        <div class="col-md-3">
                            <label>Login: </label>
                            <input class="form-control" value="<?php echo $adm[0]['login_usuario'] ?>" type="text" name="login" />
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <input class="btn btn-primary btn-block" type="submit" value="Salvar Alterações" />
                            
                        </div>
                    </div>

                </div>
            </div>

        </form>

        <br />

        <div style="max-width: 350px" class="panel panel-default panel-warning">
            <div style="font-size: 14pt" class="panel-heading">Trocar Senha</div>
            <div class="panel-body">
                <form class="form-inline" role="form" action="php/edit_senha.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                    <!--<label>Senha antiga: </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="form-control" type="password" name="antiga" />
                    <br />-->
                    <label>Nova senha: </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="form-control" type="password" name="nova" />
                    <br />
                    <label>Confima senha: </label>
                    &nbsp;&nbsp;
                    <input class="form-control" type="password" name="confirma" />
                    <br /><br />
                    <button class="btn btn-warning btn-block">Trocar Senha</button>
                </form>
            </div>
        </div>

    </div>
</div>
		
