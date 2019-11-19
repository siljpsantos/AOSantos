<?php
    $nivel_adm    = @$_SESSION['nivel_usuario'] == "adm" ? ""   : " class=\"disabled\" ";
?>
<style>
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;        -webkit-transition: height 0.5s linear .4s; transition: height 0.5s linear .4s;}
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#eee;margin-top:5px;margin-right:-10px;}
.dropdown-submenu:hover>a:after{border-left-color:#333;}
.dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}

.dropdown-submenu {
    position: relative;
}
.popover{
    max-width: 100%; /* Max Width of the popover (depending on the container!) */
}
</style>

<script>
    $('#dropdown').click(function() {
      $(this).AddClass('open');
    })
    $(document).ready(function() {

       $(".nav li.disabled a").click(function() {
         return false;
       });

       $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });

    });
</script>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav navbar-nav" id="logo_menu">
                <li>
                    <a href="<?= HOME; ?>/" class="pull-left navbar-brand"> <img class="nav_logo" style="width: 70px !important" src="<?= LOGO_NAV; ?>" /> </a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left" id="bs-example-navbar-collapse-1">

                <?php if (@$_SESSION != array()) { ?>

                  <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">RH
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">

                          <li ><a href="ger_funcionario" >Funcionários</a></li>

                      </ul>
                  </li>
                  <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Comercial
                      <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">

                    <li <?= $nivel_adm ?> ><a href="ger_proposta">Propostas</a></li>
                    <li <?= $nivel_adm ?> ><a href="ger_contrato">Contratos</a></li>

                    <li role="separator" class="divider"></li>

                    <li <?= $nivel_adm ?> ><a href="ger_recibo">Recibos</a></li>
                    <li <?= $nivel_adm ?> ><a href="ger_despesa">Despesas</a></li>

                    <li role="separator" class="divider"></li>

                    <li><a href="lista_servico">Serviços</a></li>
                  </ul>
                </li>
                    <!-- <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu 1
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?= HOME; ?>/">Opção 1</a>
                            </li>

							<li>
                                <a href="<?= HOME; ?>/">Opção 2</a>
                            </li>

                            <li class="dropdown dropdown-submenu">
                                <a tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown">Opção 3</a>
                                <ul class="dropdown-menu">

                                    <li ><a href="#" >Opção 3.1</a></li>
                                    <li ><a href="#" >Opção 3.2</a></li>

                                </ul>
                            </li>

                        </ul>
                    </li> -->

                    <li class="dropdown">
        							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Utilitários
        							<span class="caret"></span></a>
        							<ul class="dropdown-menu">

        								<li class="dropdown dropdown-submenu">
        									<a class="dropdown-toggle" data-toggle="dropdown" tabindex="-1" href="#">Controle de Acesso</a>
        									<ul class="dropdown-menu">

        										<li <?= $nivel_adm ?> ><a href="cad_usuario" >Novo Usuário</a></li>
        										<li <?= $nivel_adm ?> ><a href="ger_user" >Listagem</a></li>

        										<li role="separator" class="divider"></li>

        										<li><a href="<?= HOME; ?>/edita_usuario?id=<?= base64_encode($_SESSION['id_usuario']) ?>">Meu Usuário</a></li>

        									</ul>
        								</li>

        							</ul>
        						</li>

                <?php } ?>
                <!-- menu inicio -->
                
                <!-- fim do menu -->

            </ul>
            <ul class="nav navbar-nav navbar-right" id="bs-example-navbar-collapse-1">

                <?php if (@$_SESSION != array()) { ?>

                  <li id="li-voltar"></li>
                  <script>
                    if(+localStorage.tabCount > 0 && window.opener != null){
                      $('#li-voltar').html('<a onclick="window.close();" href="#"><i style="margin-bottom: 3px;" class="fa fa-arrow-left"></i>&nbsp;Voltar</a>');
                    }
                  </script>

                    <li>
                        <a href="php/logoff.php"> <i class="fa fa-sign-out"></i> Sair </a>
                    </li>

                <?php } else { ?>

                    <li>
                        <a href="<?= HOME; ?>/login"> <i class="fa fa-sign-in"></i> Entrar </a>
                    </li>

                <?php } ?>

            </ul>
        </div>
    </div>
</nav>
