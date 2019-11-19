<?php

    //protege entrada sem login
    if(@$_SESSION == array()){
        echo "<script>window.location.href='index.php';</script>";
    }

    @$id = $_SESSION['id_usuario'];
    @$id_adm = $_SESSION['id_adm'];

    $cliente = $crud->pdo_src('fornecedor', 'ORDER BY nome_razao ');
    $cliente_f = array();

    //limpa a matriz
    $ok = 1;
    foreach($cliente as $index=>$key){
        foreach($key as $pont=>$row){

            if($ok==1){
                $cliente_f[$index][$pont] = $row;
                $ok = 0;
            }else{
                $ok = 1;
            }

        }
    }
?>
<div style="margin: 0 10px 0 10px">

<div class="panel panel-default">
	<div style="font-size: 14pt; display: table; width: 100%" class="panel-heading">
		Fornecedores
		<a style="float: right" class="btn btn-primary" href="cad_fornecedor">Novo Fornecedor</a>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table id="lista" class="tablesorter" >
				<thead>
					<tr>
						<th>
							CNPJ
						</th>
						<th>
							Nome
						</th>
						<th>
							Logradouro
						</th>
						<th>
							Bairro
						</th>
						<th>
							Cidade
						</th>
						<th>
							UF
						</th>
						<th>
							CEP
						</th>
					</tr>
				</thead>
				<tbody>

						<?php

                            foreach($cliente_f as $index=>$key){
                                echo "<tr onclick='window.open(\"edita_fornecedor?id=".$key['id']."\")' style=' border-bottom: 1px solid #ababab; cursor: pointer;'>";
                                unset($key['id']);
                                foreach($key as $pont=>$row){
                                    if($pont == "ie" || $pont == "im" || $pont == "contato_1" || $pont == "contato_2" || $pont == "email" || $pont == "tipo"){

                                    }else{
                                        echo "<td>".$row."</td>";
                                    }
                                }
                                echo "</tr>";
                            }

                        ?>

				</tbody>
			</table>
		</div>
	</div>
</div>
