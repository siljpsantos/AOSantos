<?php
    //protege entrada sem permissão
    if(@$_SESSION == array()){
        echo "<script>window.location.href='" . HOME . "/403';</script>";
    }else{
        // if ($_SESSION['perm_frota'] == "1") {
        // } else {
        // 	echo "<script>window.location.href='" . HOME . "/403';</script>";
        // }
    }
    $loc = $crud->pdo_src('cliente', '');
    $usuarios = $crud->pdo_src('usuario', '');
    $propostas = $crud->query_p("
		SELECT p.*
		FROM tb_proposta p WHERE p.id_contrato = 0 AND p.del_yn != 1 AND p.ass != 0
	");

?>

		<div class="panel panel-default" style="margin: 0 10px 0 10px">
			<div style="font-size: 14pt" class="panel-heading">Informações do Contrato</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="cons_1" action="php/add_contrato.php" method="POST">

					<div class="container-big">

						<div class="panel panel-default bg-escuro">
							<div class="panel-body">

								<div class="col-md-6">
									<label>Proposta:</label>
									<select class="form-control" required name="id_prop_cli">
										<option></option>
										<?php
                                            foreach($propostas as $index=>$key){

                                                $id = $key['id'];
                                                $nome = $key['num_proposta'];

                                                echo "<option value='$id'>$nome</option>";

                                            }
                                        ?>
									</select>
								</div>
								<div class="col-md-6">
									<label>Cliente:</label>
									<select style="width: 100%;" class="form-control" required name="id_cliente">
										<option></option>
										<?php
                                            foreach($loc as $index=>$key){

                                                $id = $key['id'];
                                                $nome = $key['nome'];

                                                if($id == $contrato['id_cliente']){
                                                    echo "<option selected value='$id'>$nome</option>";
                                                }else{
                                                    echo "<option value='$id'>$nome</option>";
                                                }

                                            }
                                        ?>
									</select>
								</div>
								<div class="col-md-3">
									<label>Responsável:</label>
									<select class="form-control" required name="id_responsavel">
										<option></option>
										<?php
                                            foreach($usuarios as $index=>$key){

                                                $id = $key['id_usuario'];
                                                $nome = $key['nome_usuario'];

                                                echo "<option value='$id'>$nome</option>";

                                            }
                                        ?>
									</select>
								</div>



								<div class="col-md-3">
									<label>Nome:</label>
									<input class="form-control" required placeholder="" type="text" name="nome" />
								</div>
								<div class="col-md-3">
									<label>Número do Contrato:</label>
									<input class="form-control" required placeholder="" type="text" name="num_contrato" />
								</div>
								<div class="col-md-2">
									<label>Início:</label>
									<input class="form-control" required placeholder="" type="date" name="ini" />
								</div>
								<div class="col-md-2">
									<label>Final:</label>
									<input class="form-control" required placeholder="" type="date" name="fim" />
								</div>
								<div class="col-md-2">
									<label>Contato:</label>
									<input class="form-control" required placeholder="" type="text" name="contato" />
								</div>
							</div>
						</div>
						<!--</div>
						<div class="row">-->
						<div class="panel panel-default bg-escuro">
							<div class="panel-body">
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
									<input class="form-control" required placeholder="" type="text" name="cep" />
								</div>
							</div>
						</div>


						<!--
						<div class="row">
							<div class="col-md-1">

							</div>
							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type='checkbox' name='resp_yn_1' />
										<span class="label-text">Cond 1</span>
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type='checkbox' name='resp_yn_2' />
										<span class="label-text">Cond 2</span>
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type='checkbox' name='resp_yn_3' />
										<span class="label-text">Cond 3</span>
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type='checkbox' name='resp_yn_4' />
										<span class="label-text">Cond 4</span>
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-check">
									<label>
										<input type='checkbox' name='resp_yn_5' />
										<span class="label-text">Cond 5</span>
									</label>
								</div>
							</div>
							<div class="col-md-1">

							</div>
						</div>
						<hr></hr>
						-->
						<div class="row">
							<div class="col-md-11"></div>
                   			<div class="col-md-1">
								<button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
							</div>
						</div>
						<!--<div class="row">
							<div class="col-md-3">

							</div>
						</div>-->
					</div>

					<div style="display: none;">

                    	<textarea name="claus_3"><p>  Cláusula 1ª. É objeto do presente contrato a prestação do serviço de CARGA
							          E DESCARGA de bens de consumo no depósito da CONTRATANTE, no período de
							          8:00h às 17:00h.</p><p><br></p><p>
							        </p>
							        <p>
							          Para a execução do serviço o CONTRATADO contratará mão de obra, sendo de
							          sua responsabilidade os contratos trabalhistas com todos os seus encargos.
							        </p></textarea>

                    	<textarea name="claus_4"><p>
							          Cláusula 2ª. O CONTRATANTE deverá fornecer ao CONTRATADO todas as
							          informações necessárias à realização do serviço, devendo especificar os
							          detalhes necessários à perfeita consecução do mesmo, e a forma de como ele
							          deve ser entregue.
							        </p>
							        <p>
							          O maquinário a ser utilizado na execução do serviço será de
							          responsabilidade do CONTRATANTE, bem como a sua manutenção.
							        </p>
							        <p>
							          Cláusula 3ª. O CONTRATANTE deverá efetuar o pagamento na forma e condições
							          estabelecidas na cláusula 6ª.
							        </p></textarea>

											<textarea name="claus_5">  <p>
								          Cláusula 4ª. É dever do CONTRATADO oferecer ao contratante a cópia do
								          presente instrumento, contendo todas as especificidades da prestação de
								          serviço contratada.
								        </p>
								        <p>
								          Cláusula 5ª. O CONTRATADO deverá fornecer Nota Fiscal de Serviços,
								          referente ao(s) pagamento(s) efetuado(s) pelo CONTRATANTE.
								        </p></textarea>

											<textarea name="claus_6"><p>
							          Cláusula 6ª. A CONTRATANTE concorda com a tabela de preços abaixo pela
							          execução total dos serviços.
							        </p>
							        <p>
							          <strong>6.1.</strong>
							          O valor do contrato será reajustado a cada 12 (doze) meses, a contar do mês
							          de início de sua vigência.
							        </p></textarea>

											<textarea name="claus_7"><p>
							          Cláusula 7ª. Poderá o presente instrumento ser rescindido por qualquer uma
							          das partes, em qualquer momento, sem que haja qualquer tipo de motivo
							          relevante, não obstante a outra parte deverá ser avisada previamente por
							          escrito, no prazo de 90 (noventa) dias.
							        </p></textarea>

											<textarea name="claus_8">  <p>
								          Cláusula 8ª. O PRAZO do presente contrato é de um ano a contar da data da
								          assinatura.
								        </p></textarea>

											<textarea name="claus_9">  <p>
								          Cláusula 9ª. Fica pactuado entre as partes a total inexistência de vínculo
								          trabalhista entre as partes contratantes, excluindo as obrigações
								          previdenciárias e os encargos sociais, não havendo entre CONTRATADO e
								          CONTRATANTE qualquer tipo de relação de subordinação.
								        </p>
								        <p>
								          Cláusula 10ª. Salvo com a expressa autorização do CONTRATANTE, não pode o
								          CONTRATADO transferir ou subcontratar os serviços previstos neste
								          instrumento, sob o risco de ocorrer a rescisão imediata.
								        </p></textarea>

											<textarea name="claus_10"><p>
							          Cláusula 11ª. Para dirimir quaisquer controvérsias oriundas do presente
							          contrato, as partes elegem o foro da comarca da Capital Rio de Janeiro;
							        </p>
							        <p>
							          Por estarem assim justos e contratados, firmam o presente instrumento, em
							          duas vias de igual teor.
							        </p></textarea>
                    </div>


				</form>

			</div>
		</div>
