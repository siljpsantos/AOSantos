<?php
    //protege entrada sem login
    if(@$_SESSION == array()){
        echo "<script>window.location.href='index.php';</script>";
    }
?>
<div style="margin: 0 10px 0 10px">
		<div class="panel panel-default">
			<div style="font-size: 14pt" class="panel-heading">Informações do Fornecedor</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="cons_1" action="php/add_fornecedor.php" method="POST">

					<div class="container-big">
						<div class="row">
							<div class="col-md-3">
								<label>Nome/Razão Social:</label>
								<input class="form-control" required placeholder="" type="text" name="nome_razao" />
							</div>
							<div class="col-md-3">
								<label>CPF/CNPJ:</label>
								<input class="form-control i-cpf" required placeholder="" type="text" name="cpf_cnpj" />
							</div>
							<div class="col-md-3">
								<label>Inscrição Estadual:</label>
								<input class="form-control"  placeholder="" type="text" name="ie" />
							</div>
							<div class="col-md-3">
								<label>Inscrição Municipal:</label>
								<input class="form-control"  placeholder="" type="text" name="im" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label>Logradouro:</label>
								<input class="form-control" required placeholder="" type="text" name="logradouro" />
							</div>
							<div class="col-md-3">
								<label>Bairro:</label>
								<input class="form-control" required placeholder="" type="text" name="bairro" />
							</div>
							<div class="col-md-3">
								<label>Cidade:</label>
								<input class="form-control" required placeholder="" type="text" name="cidade" />
							</div>
							<div class="col-md-1">
								<label>Estado:</label>
								<input class="form-control" required placeholder="" type="text" name="estado" />
							</div>
							<div class="col-md-2">
								<label>CEP:</label>
								<input class="form-control i-cep" minlength="9" required placeholder="" type="text" name="cep" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label>Contato 1:</label>
								<input class="form-control i-fone"  placeholder="" type="text" name="contato_1" />
							</div>
							<div class="col-md-3">
								<label>Contato 2:</label>
								<input class="form-control i-fone"  placeholder="" type="text" name="contato_2" />
							</div>
							<div class="col-md-6">
								<label>Email:</label>
								<input class="form-control"  placeholder="" type="email" name="email" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-11"></div>
                			<div class="col-md-1">
								<button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
							</div>
						</div>
					</div>

				</form>

			</div>
		</div>
