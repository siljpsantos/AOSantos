<?php
//protege login em cima de login
if (isset($_SESSION)) {
    echo ($_SESSION !== [] ? "<script>window.location.href='" . HOME . "';</script>" : "");
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <div class="panel panel-default panel-small center">
                <div style="font-size: 14pt" class="panel-heading panel-heading-center">
                    <!--<img class="panel-heading-img" src="<?= INCLUDE_PATH; ?>/img/morada_logo.png" />-->
                </div>
                <div class="panel-body">
                  <img src="themes/sshtml/img/logo.png" class="logo-login" >
                    <form class="form-horizontal " role="form" action="php/login_mec.php" method="POST">
                        <input autofocus class="form-control" style="width:70%;text-align:center;margin-left:15%;margin-top:10%;" placeholder="login" required type="text" name="login" />
                        <input class="form-control" placeholder="senha" style="width:70%;text-align:center;margin-left:15%;" required type="password" name="senha" />
                        <button class="btn btn-primary btn-block" style="width:50%;text-align:center;margin-left:25%;" type="submit">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>

</div>
