<?php

    $usuarios = $crud->pdo_src('usuario', 'WHERE nivel_usuario = "user" OR id_usuario = ' . $_SESSION['id_usuario']);

    //protege de entrada sem login
    if ($_SESSION != array()) {
        if (@$_SESSION['nivel_usuario'] != 'adm') {
            echo "<script>window.location.href='" . HOME . "/403';</script>";
        }
    } else {
        echo "<script>window.location.href='" . HOME . "/403';</script>";
    }

?>
<div style="margin: 0 10px 0 10px">
<div class="panel panel-default">
    <div style="font-size: 14pt" class="panel-heading">
        Gerência de Usuários
        <a style="float: right" class="btn btn-primary" href="cad_usuario">Novo Usuário</a>
    </div>
    <div class="panel-body">

        <br /><br />
        <div class="table-responsive">
            <table class="tablesorter">
                <thead>
                    <tr>
                        <th>
                            Nome:
                        </th>
                        <th>
                            Login:
                        </th>
                        <th style="width: 200px;">

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
                            <td class="text-right">
                                <form action="edita_usuario" style="display: inline-block;" method="GET">
                                    <input type="hidden" name="id" value="<?php echo base64_encode($key['id_usuario']) ?>" />
                                    <button class="btn btn-primary" value="<?php echo $key['id_usuario'] ?>">Editar</button>
                                </form>
                                <form action="php/bloq_usuario.php" style="display: inline-block;" method="POST" onsubmit="return confirm('Realmente deseja bloquear o usuario?');">
                                    <input type="hidden" name="id" value="<?php echo $key['id_usuario'] ?>" />
                                    <button class="btn btn-warning" value="<?php echo $key['id_usuario'] ?>">
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
