<?php

// verifica se foi enviado um arquivo
if (isset($_FILES['imagem']['name']) && $_FILES["imagem"]["error"] == 0) {

    $arquivo_tmp = $_FILES['imagem']['tmp_name'];
    $nome = $_FILES['imagem']['name'];

    // Pega a extensao
    $extensao = strrchr($nome, '.');

    // Converte a extensao para mimusculo
    $extensao = strtolower($extensao);

    // So imagens, .jpg;.jpeg;.gif;.png
    // pesquisar dentro da String as extensoes permitidas
    if (strstr('.jpg;.jpeg;.gif;.png;.pdf;.doc;.docx', $extensao)) {

        @$novoNome = $info['nome'] . "-" . md5(microtime()) . $extensao;

        // cria o caminho
        $info['imagem'] = "../themes/sshtml/media/foto_funcionario/" . $novoNome;

        // tenta mover o arquivo para o destino
        if (move_uploaded_file($arquivo_tmp, $info['imagem'])) {
            //echo "Arquivo salvo com sucesso!";
            $ok = 1;
        } else {
            echo "<script>alert('Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita');</script>.";
        }
    } else {
        echo "<script>alert('Você poderá enviar apenas arquivos *.jpg; *.jpeg; *.gif; *.png;');</script>";
    }
} else {
    echo "Você não enviou nenhum arquivo!";
}
