<?php
  $nivel_adm = @$_SESSION['nivel_usuario'] == "adm" ? true : false;
  $contratos_m = $crud->pdo_src('contrato', '');

  $perm_w = $_SESSION['id_usuario'] == "11" ? true : false;
  $perm_f = $_SESSION['id_usuario'] == "12" ? true : false;
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

.disabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
}

</style>

<script>

 $(function(){
     //$(".button-collapse").sideNav();
 });

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

<div class="modal fade in" data-backdrop="true" id="modal_resumo_caixa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:92%;">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                 <h4 class="modal-title" style="display: inline-block">Resumo de Caixa</h4>
             </div>
						 <div class="modal-body">

               <form target="_blank" action="impr_resumo_caixa">

               <div class="row">
                 <div class="col-md-4">
         					<label>Contrato</label>
         					<select required class="form-control select_normal" name="id_contrato">
         						<option></option>
         						<?php
         						foreach($contratos_m as $key){
         							$id = $key['id_contrato'];
         							$nome = $key['nome'];

         							// if($id == $proposta['id_cargo']){
         							// 	echo "<option selected value=$id>$nome</option>";
         							// }else{
         								echo "<option value=$id>$nome</option>";
         							// }
         						}
         						?>
         					</select>
         				</div>
         				<div class="col-md-4">
         					<label>Data Ini.</label>
         					<input class="form-control" required type="date" name="data_ini" value="<?= date('Y-m-d', strtotime('-1 month')); ?>" />
         				</div>
         				<div class="col-md-4">
         					<label>Data Fin.</label>
         					<input class="form-control" required type="date" name="data_fin" value="<?= date('Y-m-d'); ?>" />
         				</div>

                <div class="col-md-10"></div>
                <div class="col-md-2">
                  <button class="btn btn-block btn-primary" type="submit">Imprimir</button>
                </div>

              </form>

              </div>
           </div>
         </div>
     </div>
</div>

<aside class="backcolor" >
  <nav >

      <div class="teste">
    		<ul class="mainmenu" id="bs-example-navbar-collapse-1">

                <!--
                <li>
                    <a href="Index_rel.php">Relatórios</a>
                </li>
                -->
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Relatórios
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="relatorio_lista.php">NFE/NFCe</a></li>
                    </ul>
               </li> -->


               <!-- menu para esconder e fazer de novo por motivo nenhum
               <?php if (@$_SESSION != array()) { ?>
               <li class="dropdown hovermenu desaparece">
                   <div class="li1"><i class="fas fa-users"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>RH</span></a></div>

                   <ul class=" submenu transicaomenu hovermenu">
                       <li class="li2"><a href="ger_funcionario" ><span>Funcionários</span></a></li>
                       <li class="li2"><a href="lista_cargo"><span>Cargos</span></a></li>
                       <li class="li2"><a href="ger_cliente"><span>Clientes</span></a></li>
                   </ul>
               </li>
               <li class="dropdown hovermenu">
                 <div class="li1"><i class="fas fa-newspaper"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Comercial</span></a></div>

                 <ul class=" submenu transicaomenu hovermenu">

                   <li class="li2" <?= $nivel_adm ?> ><a href="ger_proposta"><span>Propostas</span></a></li>
                   <li class="li2" <?= $nivel_adm ?> ><a href="ger_contrato"><span>Contratos</span></a></li>



                   <li class="li2" <?= $nivel_adm ?> ><a href="ger_recibo"><span>Recibos</span></a></li>
                   <li class="li2" <?= $nivel_adm ?> ><a href="ger_despesa"><span>Despesas</span></a></li>



                   <li class="li2"><a href="lista_servico"><span>Serviços</span></a></li>
                 </ul>
               </li>

                 <li class="dropdown hovermenu">
                   <div class="li1"><i class="fas fa-bars"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Utilitários</span></a></div>

                   <ul class="dropdown hovermenu transicaomenu">

                     <li class="dropdown submenu esconde_lista">
                       <div class="li2"><a href="#">&nbsp;&nbsp;<i style="font-size: 0.8vw" class="fa fa-lock"></i><span>Acesso</span></a></div>
                       <ul class="transicaomenu hovermenu">

                         <li class="li3"  <?= $nivel_adm ?> ><a href="cad_usuario" >&nbsp;&nbsp;<span>Novo Usuário</span></a></li>
                         <li class="li3"  <?= $nivel_adm ?> ><a href="ger_user" >&nbsp;&nbsp;<span>Listagem</span></a></li>

                         <li class="li3" ><a href="<?= HOME; ?>/edita_usuario?id=<?= base64_encode($_SESSION['id_usuario']) ?>">&nbsp;&nbsp;<span>Meu Usuário</span></a></li>

                       </ul>
                     </li>

                   </ul>
                 </li>
                <?php } ?>

            menu secundario o deus -->



               <?php if (@$_SESSION != array()) { ?>

                 <li class="dropdown hovermenu">
                     <div class="li1"><i class="fas fa-users"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>RH</span></a></div>

                     <ul class=" submenu transicaomenu hovermenu">
                         <li  class="li2"><a <?= $nivel_adm && !$perm_f ? "href='ger_funcionario'" : "class='disabled'"; ?> ><span>Funcionários</span></a></li>
                         <li  class="li2"><a <?= $nivel_adm && !$perm_f ? "href='lista_cargo'" : "class='disabled'"; ?> ><span>Cargos</span></a></li>
                         <li  class="li2"><a <?= $nivel_adm && !$perm_f ? "href='ger_cliente'" : "class='disabled'"; ?> ><span>Clientes</span></a></li>
                     </ul>
                 </li>
                 <li class="dropdown hovermenu">
                   <div class="li1"><i class="fas fa-newspaper"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Comercial</span></a></div>

                   <ul class=" submenu transicaomenu hovermenu">

                     <li class="li2" ><a <?= $nivel_adm && !$perm_f ? "href='ger_proposta'" : "class='disabled'"; ?> ><span>Propostas</span></a></li>
                     <li class="li2" ><a <?= $nivel_adm ? "href='ger_contrato'" : "class='disabled'"; ?> ><span>Contratos</span></a></li>



                     <li class="li2" ><a <?= $nivel_adm && $perm_w ? "class='disabled' style='cursor:not-allowed;'" : "href='ger_recibo'" ?> ><span>Recibos</span></a></li>
                     <li class="li2" ><a <?= $nivel_adm && $perm_w ? "class='disabled' style='cursor:not-allowed;'" : "href='ger_despesa'" ?> ><span>Despesas</span></a></li>



                     <li class="li2"><a <?= $nivel_adm && !$perm_f == "adm" ? "href='lista_servico'" : "class='disabled'"; ?> ><span>Serviços</span></a></li>
                   </ul>
                 </li>

                 <?php if($nivel_adm){ ?>
                   <li class="dropdown hovermenu">
                     <div class="li1"><i class="fas fa-paste"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Relatórios</span></a></div>

                     <ul class="submenu transicaomenu hovermenu">

                       <li class="li2" ><a <?php if($nivel_adm && !($perm_w || $perm_f)){ ?> onclick='$("#modal_resumo_caixa").modal("show");' <?php }else{ echo "class='disabled' style='cursor:not-allowed;'"; } ?> ><span>Resumo de Caixa</span></a></li>
                       <!-- <li class="li2" ><a <?= $nivel_adm ? "href='view_pg_func'" : "class='disabled'"; ?> ><span>PG Funcionário</span></a></li> -->
                       <!-- <li class="li2" ><a <?= $nivel_adm ? "href='view_recibo'" : "class='disabled'"; ?> ><span>Recibos</span></a></li>
                       <li class="li2" ><a <?= $nivel_adm ? "href='view_despesa'" : "class='disabled'"; ?> ><span>Despesas</span></a></li> -->

                     </ul>
                   </li>
                 <?php } ?>

                 <li class="dropdown hovermenu">
                   <div class="li1"><i class="fas fa-bars"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Utilitários</span></a></div>

                   <ul class="dropdown hovermenu transicaomenu">

                     <li class="dropdown submenu esconde_lista">
                       <div class="li2"><a href="#">&nbsp;&nbsp;<i style="font-size: 0.8vw" class="fa fa-lock"></i><span>Acesso</span></a></div>
                       <ul class="transicaomenu hovermenu">

                         <li class="li3" ><a <?= $nivel_adm && ($perm_w || $perm_f) ? "class='disabled' style='cursor:not-allowed;'" : "href='cad_usuario'" ?> >&nbsp;&nbsp;<span>Novo Usuário</span></a></li>
                         <li class="li3" ><a <?= $nivel_adm && ($perm_w || $perm_f) ? "class='disabled' style='cursor:not-allowed;'" : "href='ger_user'" ?> >&nbsp;&nbsp;<span>Listagem</span></a></li>

                         <li class="li3" ><a href="<?= HOME; ?>/edita_usuario?id=<?= base64_encode($_SESSION['id_usuario']) ?>">&nbsp;&nbsp;<span>Meu Usuário</span></a></li>

                       </ul>
                     </li>

                   </ul>
                 </li>

               <?php } ?>
    		</ul>
      </div>
  </nav>
    <div >

    </div>

    <div class="footer logo">
      <div class="nav-header">
        <figure>
          <a><img class="nav_logo" src="themes/sshtml/img/logo-inforway.png" /></a>
        </figure>
      </div>
        <a target="_blank" href="http://www.inforway.com"><span class="zero-oito">&copy;&nbsp;2019 - InforWay Informática.</span></a>

  </div>
    <img class="some_img" src="themes/sshtml/img/logo-inforway.png" />
</aside>
<!--fim do menu lateral-->

<!--topo-->
<nav class="navbar navbar-default navbar-fixed-top header-top-2"></div>
</nav>
<nav class="navbar navbar-default navbar-fixed-top header-top">
  <div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<ul class="nav navbar-nav" id="logo_menu">
      <li>
          <a class="pull-left navbar-brand"><img style="width: 90px;" class="nav_logo" src="./themes/sshtml/img/logo_nav.png" /></a>
      </li>


      <?php if (@$_SESSION != array()) { ?>
        <li class="icon_full" >
            <a class="pull-left navbar-brand" href="./">
            <i style="font-size: 14pt; margin-top: 0px;" class="fas fa-home"></i>
            </a>
        </li>
      <?php if($Url[0] != "" && $Url[0] != "index" && $Url[0] != "login"){ ?>
      <li class="icon_full">
          <a class="pull-left navbar-brand" style="cursor: pointer;" onclick="window.history.go(-1);">
          <i style="font-size: 14pt; margin-top: 0px;" class="fas fa-arrow-left"></i>
          </a>
      </li>
      <?php } ?>
    <?php } ?>

		</ul>
	</div>
	<div class="collapse navbar-collapse">

    <ul class="nav navbar-nav navbar-right nicebox" style="background-color: #004E2B;" id="bs-example-navbar-collapse-1">

        <?php if (@$_SESSION != array()) { ?>

          <!-- <li id="li-voltar"></li>
          <script>
            if(+localStorage.tabCount > 0 && window.opener != null){
              $('#li-voltar').html('<a onclick="window.close();" href="#"><i style="margin-bottom: 3px;" class="fa fa-arrow-left"></i>&nbsp;Voltar</a>');
            }
          </script> -->
            <li>
              <ul class="desnecessauro-rex">

          <li class="dropdown ">
              <div class="li1"><i class="fas fa-users"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span><b>RH</b></span></a></div>

              <ul class=" submenu transicaomenu ">
                  <li class="li2"><a href="ger_funcionario" ><span>Funcionários</span></a></li>
                  <li class="li2"><a href="lista_cargo"><span>Cargos</span></a></li>
                  <li class="li2"><a href="ger_cliente"><span>Clientes</span></a></li>
              </ul>
          </li>
          <li class="dropdown ">
            <div class="li1"><i class="fas fa-newspaper"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span><b>Comercial</b></span></a></div>

            <ul class=" submenu transicaomenu ">

              <li class="li2" <?= $nivel_adm ?> ><a href="ger_proposta"><span>Propostas</span></a></li>
              <li class="li2" <?= $nivel_adm ?> ><a href="ger_contrato"><span>Contratos</span></a></li>



              <li class="li2" ><a <?= $nivel_adm && $perm_w ? "class='disabled'" : "" ?> href="ger_recibo"><span>Recibos</span></a></li>
              <li class="li2" ><a <?= $nivel_adm && $perm_w ? "class='disabled'" : "" ?> href="ger_despesa"><span>Despesas</span></a></li>



              <li class="li2"><a href="lista_servico"><span>Serviços</span></a></li>
            </ul>
          </li>

          <?php if($nivel_adm){ ?>
            <li class="dropdown">
              <div class="li1"><i class="fas fa-paste"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><b><span>Relatórios</span></b></a></div>

              <ul class="submenu transicaomenu hovermenu">

                <li class="li2" ><a onclick='$("#modal_resumo_caixa").modal("show");' ><span>Resumo de Caixa</span></a></li>
                <!-- <li class="li2" ><a <?= $nivel_adm ? "href='view_pg_func'" : "class='disabled'"; ?> ><span>PG Funcionário</span></a></li> -->
                <!-- <li class="li2" ><a <?= $nivel_adm ? "href='view_recibo'" : "class='disabled'"; ?> ><span>Recibos</span></a></li>
                <li class="li2" ><a <?= $nivel_adm ? "href='view_despesa'" : "class='disabled'"; ?> ><span>Despesas</span></a></li> -->

              </ul>
            </li>
          <?php } ?>

            <li class="dropdown">
              <div class="li1"><i class="fas fa-bars"></i><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span><b>Utilitários</b></span></a></div>

              <ul class="dropdown transicaomenu">

                <li class="dropdown submenu esconde_lista">
                  <div class="li2"><a href="#">&nbsp;&nbsp;<i style="font-size: 0.8vw" class="fa fa-lock"></i><span>Acesso</span></a></div>
                  <ul class="transicaomenu">

                    <li class="li3"  <?= $nivel_adm ?> ><a href="cad_usuario" >&nbsp;&nbsp;<span>Novo Usuário</span></a></li>
                    <li class="li3"  <?= $nivel_adm ?> ><a href="ger_user" >&nbsp;&nbsp;<span>Listagem</span></a></li>

                    <li class="li3" ><a href="<?= HOME; ?>/edita_usuario?id=<?= base64_encode($_SESSION['id_usuario']) ?>">&nbsp;&nbsp;<span>Meu Usuário</span></a></li>

                  </ul>
                </li>

              </ul>
            </li>
          </ul>
            <li class="apagai">
                <a href="php/logoff.php"> <i class="fa fa-sign-out"></i> <span class="spacelef">Sair</span> </a>
            </li>

        <?php } else { ?>

            <li class="apagai">
                <a href="<?= HOME; ?>/login"> <i class="fa fa-sign-in"></i> <span class="spacelef">Entrar</span> </a>
            </li>

        <?php } ?>

    </ul>
	</div>
  </div>
</nav>
<div class="container-tudo">
