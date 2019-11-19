<?php
if(@$_SESSION != array()){
    // if(@$_SESSION['perm_frota'] == "1"){
    //
    // }else{
    // 	echo "<script>window.location.href='403';</script>";
    // }
}else{
    echo "<script>window.location.href='index.php';</script>";
}
        $contrato= $crud->pdo_src('contrato','order by nome
     ');

?>


            <div class="panel panel-default" style="margin: 0 10px 0 10px">
            	<div style="font-size: 14pt" class="panel-heading">
            		Cadastro de recibo
            	</div>
            	<div class="panel-body">
            		<form class="form-horizontal" role="form" id="cons_1" action="php/cad_recibo.php" method="POST">
                  <input type="hidden" class="form-control" name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>"/>
                  <div class="container-big">
            					<div class="panel-body">
            						<div class="row">
            							<div class="col-md-3">
            								<label>Fornecedor.:</label>
            								<input required type="text" class="form-control" name="fornecedor"  />
            							</div>
            						<div class="col-md-3">
            							<label>Endereço.:</label>
            							<input required type="text" class="form-control" name="endereco"  />
            						</div>
            						<div class="col-md-3">
                          <label>Contrato.:</label>
                          <select required class="form-control" name="id_contrato">
                                          <option></option>
                                          <?php
                                            foreach ($contrato as $key) {
                                                $id = $key['id_contrato'];
                                                $nome = $key['nome'];
                                echo "<option value=$id>$nome</option>";
                                            }
                                            ?>
                                      </select>
            						</div>
            						<div class="col-md-3">
            							<label>Placa:</label>
            							<input required type="text" class="form-control" name="placa"  />
            						</div>
                        <div class="col-md-3">
            							<label>Numero da nota:</label>
            							<input  type="text" class="form-control" name="num_nota"  />
            						</div>
                        <div class="col-md-3">
            							<label>Produtos:</label>
            							<textarea required  class="form-control" name="produtos"  ></textarea>
            						</div>

            						<!-- <div class="row"> -->
            							<div class="col-md-5"></div>
            		           <div class="col-md-1">
                             <label></label>
            								<button class="btn btn-primary btn-block" type="submit">Salvar</button>
            							</div>
            						<!-- </div> -->
</div>
            					</div>

            			</div>

            		</form>

            	</div>
            </div>
