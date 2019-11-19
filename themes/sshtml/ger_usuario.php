<?php

    $usuarios = $crud->pdo_src('usuario', 'WHERE nivel_usuario = \'usuario\'');

    //protege de entrada sem login
    if ($_SESSION != array()) {
        if (@$_SESSION['nivel_usuario'] === 'usuario') {
            echo "<script>window.location.href='" . HOME . "/403';</script>";
        }
    }else {
        echo "<script>window.location.href='" . HOME . "/403';</script>";
    }

?>
<div class="panel panel-default">
    <div style="font-size: 14pt" class="panel-heading">Usuários</div>
    <div class="panel-body">

        <a href="cad_usuario" class="btn btn-primary btn-block">Cadastrar usuário</a>

        <br /><br />
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            Nome:
                        </th>
                        <th>
                            Login:
                        </th>
                        <th colspan="2">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $index=>$key) { ?>
                        <tr>
                            <td>
                                <?= $key['nome_usuario'] ?>
                            </td>
                            <td>
                                <?= $key['login_usuario'] ?>
                            </td>
                            <td>
                                <form action="edita_usuario_adm" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $key['id_usuario'] ?>" />
                                    <button class="btn btn-default" value="<?php echo $key['id_usuario'] ?>">Editar</button>
                                </form>
                            </td>
                            <!--
                            <td>
                                <form action="php/remove_usuario.php" method="POST" onsubmit="return confirm('Realmente deseja remover o usuario?');">
                                    <input type="hidden" name="id" value="<?php echo $key['id_usuario'] ?>" />
                                    <button value="<?php echo $key['id_usuario'] ?>">Remover</button>
                                </form>
                            </td>
                            -->
                            <td>
                                <form action="php/bloq_usuario.php" method="POST" onsubmit="return confirm('Realmente deseja bloquear o usuario?');">
                                    <input type="hidden" name="id" value="<?php echo $key['id_usuario'] ?>" />
                                    <button class="btn btn-default" value="<?php echo $key['id_usuario'] ?>">
                                        <?php if ($key['ativo_usuario'] == "1") {echo 'bloquear'; } else {echo 'desbloquear'; } ?>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
