<?php

include "../_app/Config.inc.php";

$info = $_POST;
//
// $perm_os = (isset($_POST['perm_os'])) ? 1 : 0;
// $perm_os_1 = (isset($_POST['perm_os_1'])) ? 2 : 0;
//
// $perm_os = max($perm_os, $perm_os_1);
//
// if($info['id_usuario'] == $_SESSION['id_usuario']){
// 	$_SESSION['perm_os'] = $info['perm_os'] = $perm_os;
// 	$_SESSION['perm_frota'] = $info['perm_frota'] = (isset($_POST['perm_frota'])) ? 1 : 0;
// 	$_SESSION['perm_adm'] = $info['perm_adm'] = (isset($_POST['perm_adm'])) ? 1 : 0;
// 	$_SESSION['perm_modulos'] = $info['perm_modulos'] = (isset($_POST['perm_modulos'])) ? 1 : 0;
// 	$_SESSION['perm_almox'] = $info['perm_almox'] = (isset($_POST['perm_almox'])) ? 1 : 0;
// 	$_SESSION['perm_manut'] = $info['perm_manut'] = (isset($_POST['perm_manut'])) ? 1 : 0;
// 	$_SESSION['somente_leitura'] = $info['somente_leitura'] = (isset($_POST['somente_leitura'])) ? 1 : 0;
// 	$_SESSION['perm_doc'] = $info['perm_doc'] = (isset($_POST['perm_doc'])) ? 1 : 0;
// 	if($_SESSION['id_usuario'] =="1"){
// 		$_SESSION['perm_ti'] = $info['perm_ti'] = (isset($_POST['perm_ti'])) ? 1 : 0;
// 	}
// }else{
// 	$info['perm_os'] = $perm_os;
// 	$info['perm_frota'] = (isset($_POST['perm_frota'])) ? 1 : 0;
// 	$info['perm_adm'] = (isset($_POST['perm_adm'])) ? 1 : 0;
// 	$info['perm_modulos'] = (isset($_POST['perm_modulos'])) ? 1 : 0;
// 	$info['perm_almox'] = (isset($_POST['perm_almox'])) ? 1 : 0;
// 	$info['perm_manut'] = (isset($_POST['perm_manut'])) ? 1 : 0;
// 	$info['somente_leitura'] = (isset($_POST['somente_leitura'])) ? 1 : 0;
// 	$info['perm_doc'] = (isset($_POST['perm_doc'])) ? 1 : 0;
// 	if($_SESSION['id_usuario'] =="1"){
// 		$info['perm_ti'] = (isset($_POST['perm_ti'])) ? 1 : 0;
// 	}
// }
//
// unset($info['perm_os_1']);

$crud->pdo_edit('usuario',$info,'id_usuario');

if ($_SESSION['nivel_usuario'] == 'adm') {
    echo "<script>alert('Usuário atualizado com sucesso!');window.location.href='" . HOME . "/ger_user';</script>";
} else {
    echo "<script>alert('Usuário atualizado com sucesso!');window.location.href='" . HOME . "/';</script>";
}

?>
