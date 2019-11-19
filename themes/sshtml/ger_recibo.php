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
            $contratos = $crud->pdo_src('contrato', 'WHERE id_contrato > 0');
        }else{
            $contratos = $crud->pdo_src('contrato', '');
        }

    }else{
        $contratos = $crud->pdo_src('contrato', 'WHERE id_responsavel = '.$_SESSION['id_usuario']);
    }

?>

<div class="modal fade in" data-backdrop="true" id="modal_cad_recibo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:92%;">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                 <h4 class="modal-title">Novo Recibo</h4>
             </div>
						 <form class="form-horizontal" role="form" id="cad_recibo" onsubmit="cad_recibo(event);" >
							 <input type="hidden" class="form-control" name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>"/>
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
								<!-- <div class="col-md-3">
									<label>Endereço.:</label>
									<input required type="text" class="form-control" name="endereco"  />
								</div> -->
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
									<label>Placa:</label>
									<input required type="text" class="form-control" name="placa"  />
								</div>
								<div class="col-md-3">
									<label>Numero da nota:</label>
									<input  type="text" class="form-control" name="num_nota"  />
								</div>
								<div class="col-md-12">
									<label>Produtos:</label>
									<textarea required  class="form-control" name="produtos"  ></textarea>
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

<div class="modal fade in" data-backdrop="true" id="modal_edit_recibo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:92%;">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                 <h4 class="modal-title" style="display: inline-block">Edição de Recibo</h4>
								 <button style="float: right; margin-right: 10px" id="baixar_btn" class="btn btn-danger" onclick='mostrar_motivo();'>Baixar</button>
								 <button style="float: right; margin-right: 10px" id="faturar_btn" class="btn btn-primary" onclick='faturar();'>Faturar</button>
             </div>
						 <div id="ret_edit_recibo">
						 </div>
         </div>
     </div>
</div>

<script>

	function buscar_recibos(){
		var contrato = $('#select_contrato option:selected').val();
		var ini = $('#input_ini').val();
		var fin = $('#input_fin').val();
		if(contrato && ini && fin){
			var url = 'php/ajax/buscar_recibo.php?contrato='+contrato+'&ini='+ini+'&fin='+fin;
			$.get(url, function(dataReturn) {
				$('#recibos_div').html(dataReturn);
				$('#btn_cad_recibo').removeClass('disabled');
			});
		}
	}

	function edita_recibo(id){
		if(id){
			var url = 'php/ajax/edit_recibo.php?id='+id;
			$.get(url, function(dataReturn) {
				$('#ret_edit_recibo').html(dataReturn);
				$("#modal_edit_recibo").modal();

				$('#ret_edit_recibo textarea').summernote({
		        lang: 'pt-BR',
		        enterHtml: '<p><br></p>',
		        toolbar: [
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'clear'] ],
		            [ 'para', [ 'ol', 'ul' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview'] ]
		        ]
		    });

			});
		}
	}

	function edita_recibo_r(id){
		if(id){
			var url = 'php/ajax/edit_recibo.php?id='+id;
			$.get(url, function(dataReturn) {
				$('#ret_edit_recibo').html(dataReturn);

		    $('#ret_edit_recibo textarea').summernote({
		        lang: 'pt-BR',
		        enterHtml: '<p><br></p>',
		        toolbar: [
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'clear'] ],
		            [ 'para', [ 'ol', 'ul' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview'] ]
		        ]
		    });

			});
		}
	}

	function faturar(){

		var id = $('#edit_recibo [name=id]').val();
		var status = "1";

		var url = 'php/ajax/edit_recibo_mec.php?id='+id+'&status='+status;

		if(confirm("Tem certeza que deseja faturar o recibo?")){
		$.get(url, function(dataReturn) {
			$('#recibos_div').html(dataReturn);
			$("#modal_edit_recibo").modal('hide');
		});

		buscar_recibos();
}
	}
	function baixar(){

		var id = $('#edit_recibo [name=id]').val();
		var status = "2";

		var url = 'php/ajax/edit_recibo_mec.php?id='+id+'&status='+status;

		if(confirm("Tem certeza que deseja dar baixa no recibo?")){
		$.get(url, function(dataReturn) {
			$('#recibos_div').html(dataReturn);
			$("#modal_edit_recibo").modal('hide');
		});

		buscar_recibos();
}
	}

	function edita_recibo_mec(e){
		e.preventDefault();

		var id = $('#edit_recibo [name=id]').val();
		var usuario = $('#edit_recibo [name=id_usuario]').val();
		var fornecedor = $('#edit_recibo [name=fornecedor]').val();
		var endereco = $('#edit_recibo [name=endereco]').val();
		var placa = $('#edit_recibo [name=placa]').val();
		var num_nota = $('#edit_recibo [name=num_nota]').val();
		var produtos = $('#edit_recibo [name=produtos]').val();
		var data = $('#edit_recibo [name=data_hora]').val();
		var motivo_baixa = $('#motivo_baixa [name=motivo_baixa]').val();

		var url = 'php/ajax/edit_recibo_mec.php?id='+id+'&id_usuario='+usuario+'&fornecedor='+fornecedor+'&endereco='+endereco+'&placa='+placa+'&num_nota='+num_nota+'&produtos='+produtos+'&data_hora='+data+'&motivo_baixa='+motivo_baixa;

		var servs = [];
		for(var i=1;i<=10;i=i+1){
			if($('#edit_recibo [name=servico_'+i+']').val()){

				servs[i] = $('#edit_recibo [name=servico_'+i+']').val();

				url = url + '&servico_'+i+'='+servs[i];

			}
		}

	$.get(url, function(dataReturn) {
			$('#recibos_div').html(dataReturn);
			$("#modal_edit_recibo").modal('hide');
		});

		buscar_recibos();

	}

	function add_servico(id){

		var id_servico = $('#new_servico_slc option:selected').val();
		var qtd = $('#qtd_servico_input').val();

		var url = 'php/ajax/add_servico.php?id_recibo='+id+'&qtd='+qtd+'&id_servico='+id_servico;
		$.get(url, function(dataReturn) {
			$('#recibos_div').html(dataReturn);
		});

		edita_recibo_r(id);
		buscar_recibos();

	}

	function cad_recibo(e){
		e.preventDefault();

		var usuario = $('#cad_recibo [name=id_usuario]').val();
		var fornecedor = $('#cad_recibo [name=fornecedor]').val();
		var endereco = $('#cad_recibo [name=endereco]').val();
		var id_contrato = $('#cad_recibo [name=id_contrato] option:selected').val();
		var placa = $('#cad_recibo [name=placa]').val();
		var num_nota = $('#cad_recibo [name=num_nota]').val();
		var produtos = $('#cad_recibo [name=produtos]').val();
		var data = $('#cad_recibo [name=data_hora]').val();

		var url = 'php/ajax/cad_recibo.php?id_usuario='+usuario+'&fornecedor='+fornecedor+'&endereco='+endereco+'&id_contrato='+id_contrato+'&placa='+placa+'&num_nota='+num_nota+'&produtos='+produtos+'&data_hora='+data;
		$.get(url, function(dataReturn) {
			$('#recibos_div').html(dataReturn);
			$("#modal_cad_recibo").modal('hide');
		});

		buscar_recibos();

	}

</script>

<div style="margin: 0 10px 0 10px">

	<div class="panel panel-default">
		<div style="font-size: 14pt; display: table; width: 100%" class="panel-heading">
			Recibos
			<a style="float: right; cursor: pointer;" onclick='$("#modal_cad_recibo").modal();' id="btn_cad_recibo" class="btn btn-primary disabled" >Novo Recibo</a>
		</div>
		<div class="panel-body">

			<div class="row">
				<div class="col-md-2">
					Para começar selecione um contrato ao lado:
				</div>

				<form target="_blank" action="impr_relatorio_recibo" method="GET">

					<div class="col-md-4">
						<label>Contrato</label>
						<select required class="form-control" id="select_contrato" name="id_contrato" onchange="buscar_recibos();">
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
						<input class="form-control" onkeyup="buscar_recibos();" required type="date" name="ini" id="input_ini" value="<?= date('Y-m-d', strtotime('-1 month')); ?>" />
					</div>
					<div class="col-md-2">
						<label>Data Fin.</label>
						<input class="form-control" onkeyup="buscar_recibos();" required type="date" name="fin" id="input_fin" value="<?= date('Y-m-d'); ?>" />
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
			<div class="table-responsive" id="recibos_div">
				<table id="lista" class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Data e Hora</th>
							<th>Fornecedor</th>
							<!-- <th>Endereço</th> -->
							<th>Placa</th>
							<th>N° NF</th>
							<th>Val.</th>
							<th>Status.</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

</div>
