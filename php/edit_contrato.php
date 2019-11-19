<?php


include "../_app/Config.inc.php";

$info = $_POST;

// print_r($info);
// exit();

$campo_id = "id_contrato";

$sql = "UPDATE tb_contrato SET id_responsavel = ?, id_cliente = ?, nome = ?, num_contrato = ?, ini = ?, fim = ?, contato = ?, percent = ?,
	claus_3 = COMPRESS(?),
	claus_4 = COMPRESS(?),
	claus_5 = COMPRESS(?),
	claus_6 = COMPRESS(?),
	claus_7 = COMPRESS(?),
	claus_8 = COMPRESS(?),
	claus_9 = COMPRESS(?),
	claus_10 = COMPRESS(?),
	logradouro = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id_contrato = ?";

try {
    $prepara = $crud->pdo->prepare($sql);

    $controle = 1;
    foreach ($info as $index => $key) {
        if ($index !== $campo_id) {
            $prepara->bindParam($controle, $info[$index], PDO::PARAM_INT);
            $controle += 1;
        }
    }

    $prepara->bindParam($controle, $info[$campo_id], PDO::PARAM_INT);

    $prepara->execute();

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

//cadastra funcionario----------------
//$crud->pdo_edit(  'contrato', $info, 'id_contrato');
//fim------------------------------

//retorna para a lista
?>
<script type="text/javascript">
alert("Contrato atualizado com sucesso!");
window.location.href = "../edita_contrato?id=<?= $info['id_contrato'] ?>";
</script>
