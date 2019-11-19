<?php

include "../_app/Config.inc.php";

$info = $_POST;

$user = $crud->chk_login($info);

$dia = strftime('%a', strtotime('Y-m-d'));

if(utf8_encode($dia) == 'sáb' || $dia == 'dom'){
  $fds = true;
}else{
  $fds = false;
}

if ($user !== array()) {

    if ($user[0]['ativo_usuario'] != 0) {

      if($user[0]['nivel_usuario']=='user'){

        if($fds == true){

          if($var_json->fds == 1){
            //zera a senha
            $user[0]['senha_usuario'] = 'Não interessa pra você, palhaço!';
            $user[0][2] = 'Não interessa pra você, palhaço!';

            $_SESSION = $user[0];

            echo "<script>window.location.href='../';</script>";
          }else{
            echo "<script>alert('Dia Inválido!');window.location.href='../login';</script>";
          }

        }else{
          //zera a senha
          $user[0]['senha_usuario'] = 'Não interessa pra você, palhaço!';
          $user[0][2] = 'Não interessa pra você, palhaço!';

          $_SESSION = $user[0];

          echo "<script>window.location.href='../';</script>";
        }


      }else{
        //zera a senha
        $user[0]['senha_usuario'] = 'Não interessa pra você, palhaço!';
        $user[0][2] = 'Não interessa pra você, palhaço!';

        $_SESSION = $user[0];

        echo "<script>window.location.href='../';</script>";
      }

    }else {
        echo "<script>alert('Usuário Bloqueado!');window.location.href='../login';</script>";
    }
}else {
    echo "<script>alert('Usuário ou Senha incorretos!');window.location.href='../login';</script>";
}
