<?php

    //protege entrada sem permissão
    if(@$_SESSION == array()){
        echo "<script>window.location.href='" . HOME . "/403';</script>";
    }else{
        // if ($_SESSION['perm_ti'] == "1") {
        // } else {
        // 	echo "<script>window.location.href='" . HOME . "/403';</script>";
        // }
    }

    if($nivel_adm){

        if($perm_f){
            $contratos = $crud->pdo_src('contrato', 'WHERE id_contrato = 3');
        }else{
            $contratos = $crud->pdo_src('contrato', '');
        }

    }else{
            $contratos = $crud->pdo_src('contrato', 'WHERE id_responsavel = '.$_SESSION['id_usuario']);
    }

?>

<div class="modal fade in" data-backdrop="true" id="modal_cad_despesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:92%;">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                 <h4 class="modal-title">Nova Despesa</h4>
             </div>
						 <form class="form-horizontal" role="form" id="cad_despesa" onsubmit="cad_despesa(event);" >
							 <!-- <input type="hidden" class="form-control" name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>"/> -->
             	<div class="modal-body">

								<div class="row">
									<div class="col-md-3">
										<label>Data:</label>
										<input required type="datetime-local" class="form-control" name="data_hora" value="<?= date('Y-m-d\TH:i'); ?>"  />
									</div>
									<div class="col-md-3">
										<label>Fornecedor.:</label>
										<input required type="text" class="form-control" name="fornecedor"  />
									</div>
								<div class="col-md-3">
									<label>Contrato.:</label>
									<select style="width: 100%" required class="form-control" name="id_contrato">
											<option></option>
											<?php
                                            foreach ($contratos as $key) {
                                                    $id = $key['id_contrato'];
                                                    $nome = $key['nome'];
                                                    echo "<option value=$id>$nome</option>";
                                            }
                                            ?>
									</select>
								</div>

								<div class="col-md-3">
									<label>Val:</label>
									<input  type="number" step=".01" class="form-control" name="valor"  />
								</div>
								<div class="col-md-12">
									<label>Despesa:</label>
									<input  type="text" class="form-control" name="despesa"  />
								</div>

							</div>

	            </div>
	            <div class="modal-footer">
	                 <button type="submit" class="btn btn-primary">Salvar</button>
	            </div>
         	</form>
         </div>
     </div>
</div>

<div class="modal fade in" data-backdrop="true" id="modal_edit_despesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:92%;">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                 <h4 class="modal-title" style="display: inline-block">Edição de Despesas</h4>
								 <!-- <button style="float: right; margin-right: 10px" id="baixar_btn" class="btn btn-danger" onclick='mostrar_motivo();'>Baixar</button> -->
								 <button style="float: right; margin-right: 10px" id="faturar_btn" class="btn btn-primary" onclick='faturar();'>Faturar</button>
								 <button style="float: right; margin-right: 10px" id="baixar_btn" class="btn btn-danger" onclick='baixar();'>Baixar</button>
             </div>
						 <div id="ret_edit_despesa">
						 </div>
         </div>
     </div>
</div>

<script>





	function buscar_despesas(){
		var contrato = $('#select_contrato option:selected').val();
		var ini = $('#input_ini').val();
		var fin = $('#input_fin').val();
		if(contrato && ini && fin){
			var url = 'php/ajax/buscar_despesa.php?contrato='+contrato+'&ini='+ini+'&fin='+fin;
			$.get(url, function(dataReturn) {
				$('#despesa_div').html(dataReturn);
				$('#btn_cad_despesa').removeClass('disabled');
			});
		}
	}

	function edita_despesa(id){
		if(id){
			var url = 'php/ajax/edit_despesa.php?id='+id;
			$.get(url, function(dataReturn) {
				$('#ret_edit_despesa').html(dataReturn);
				$("#modal_edit_despesa").modal();

			});
		}
	}

	function edita_despesa_r(id){
		if(id){
			var url = 'php/ajax/edit_despesa.php?id='+id;
			$.get(url, function(dataReturn) {
				$('#ret_edit_despesa').html(dataReturn);

			});
		}
	}

	function faturar(){

		var id = $('#edit_despesa [name=id]').val();
		var status = "1";

		var url = 'php/ajax/edit_despesa_mec.php?id='+id+'&status='+status;

		if(confirm("Tem certeza que deseja faturar a despesa?")){
		$.get(url, function(dataReturn) {
			$('#recibos_div').html(dataReturn);
			$("#modal_edit_despesa").modal('hide');
		});

		buscar_despesas();
}
	}
	function baixar(){

		var id = $('#edit_despesa [name=id]').val();
		var status = "2";

		var url = 'php/ajax/edit_despesa_mec.php?id='+id+'&status='+status;

		if(confirm("Tem certeza que deseja dar baixa a despesa?")){
		$.get(url, function(dataReturn) {
			$('#despesa_div').html(dataReturn);
			$("#modal_edit_despesa").modal('hide');
		});

		buscar_despesas();
}
	}

	function edita_despesa_mec(e){
		e.preventDefault();

		var id = $('#edit_despesa [name=id]').val();
		// var usuario = $('#edit_despesa [name=id_usuario]').val();
		var fornecedor = $('#edit_despesa [name=fornecedor]').val();
		var despesa = $('#edit_despesa [name=despesa]').val();
		var valor = $('#edit_despesa [name=valor]').val();
		var data = $('#edit_despesa [name=data_hora]').val();

		var url = 'php/ajax/edit_despesa_mec.php?id='+id+'&fornecedor='+fornecedor+'&despesa='+despesa+'&valor='+valor+'&data_hora='+data;


	$.get(url, function(dataReturn) {
			$('#despesa_div').html(dataReturn);
			$("#modal_edit_despesa").modal('hide');
		});

		buscar_despesas();

	}



	function cad_despesa(e){
		e.preventDefault();

		// var usuario = $('#cad_despesa [name=id_usuario]').val();
		var fornecedor = $('#cad_despesa [name=fornecedor]').val();
		var id_contrato = $('#cad_despesa [name=id_contrato] option:selected').val();
		var valor = $('#cad_despesa [name=valor]').val();
		var despesa = $('#cad_despesa [name=despesa]').val();
		var data = $('#cad_despesa [name=data_hora]').val();

		var url = 'php/ajax/cad_despesa.php?fornecedor='+fornecedor+'&id_contrato='+id_contrato+'&valor='+valor+'&despesa='+despesa+'&data_hora='+data;
		$.get(url, function(dataReturn) {
			$('#despesa_div').html(dataReturn);
			$("#modal_cad_despesa").modal('hide');
		});

		buscar_despesas();

	}

</script>

<div style="margin: 0 10px 0 10px">

	<div class="panel panel-default">
		<div style="font-size: 14pt; display: table; width: 100%" class="panel-heading">
			Despesas
			<a style="float: right; cursor: pointer;" onclick='$("#modal_cad_despesa").modal();' id="btn_cad_despesa" class="btn btn-primary disabled" >Nova Despesa</a>
		</div>
		<div class="panel-body">

			<div class="row">
				<div class="col-md-2">
					Para começar selecione um contrato ao lado:
				</div>
				<form target="_blank" action="impr_relatorio_despesa" method="GET">
				<div class="col-md-4">
					<label>Contrato</label>
					<select required class="form-control" id="select_contrato" name="id_contrato" onchange="buscar_despesas();">
						<option></option>
						<?php
                        foreach($contratos as $key){
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
				<div class="col-md-2">
					<label>Data Ini.</label>
					<input class="form-control" onkeyup="buscar_despesas();" name="ini" required type="date" id="input_ini" value="<?= date('Y-m-d', strtotime('-1 month')); ?>" />
				</div>
				<div class="col-md-2">
					<label>Data Fin.</label>
					<input class="form-control" onkeyup="buscar_despesas();" name="fin" required type="date" id="input_fin" value="<?= date('Y-m-d'); ?>" />
				</div>
				<div class="col-md-2">
					<label></label>
					<button class="btn btn-block btn-warning">Gerar Impressão</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<div class="table-responsive" id="despesa_div">
				<table id="lista" class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Data e Hora</th>
							<th>Fornecedor</th>
							<th>Status.</th>
							<th>Val.</th>

						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

</div>
