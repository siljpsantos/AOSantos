<?php
require './_app/Config.inc.php';
header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
if ($_POST) {
    $_SESSION['post_data'] = $_POST;
}
?>
<!DOCTYPE HTML>
<html>
    <head>

        <title>AOSantos</title>

        <!-- META TAGS -->
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=0.7, width=device-width, user-scalable=no">
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta http-equiv="expires" content="0"/>

    		<!-- FAV ICON -->
    		<link rel="icon" href="<?= LOGO_FAV ?>"  />

        <!-- JQUERY -->
        <script src="./_cdn/jquery.min.js"></script>

        <!-- BOOTSTRAP -->
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/css/bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/css/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
        <script src="_cdn/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/css/style.css" >
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/css/css_menu.css" >
        <link rel="stylesheet" type="text/css" href="themes/sshtml/css/style.css">
        <!-- LESS -->
        <link rel="stylesheet/less" type="text/css" href="<?= INCLUDE_PATH; ?>/css/cinza-azul.less">
        <script src="_cdn/less.js/dist/less.js" type="text/javascript"></script>

        <!-- JQUERY MASK -->
        <script src="_cdn/jqmask/src/jquery.mask.js"></script>

        <!-- SELECT2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

        <!-- CHARTJS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>

        <!-- DATATABLES -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>

        <!-- SUMMERNOTE -->
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
        <script src="_cdn/textarea/pt-br.js"></script>

        <!-- JS PRINCIPAL -->
        <script src="_cdn/ativo.js"></script>

        <style>
        @media print {
            body{
                background-color: #fff;
            }
            .pace{
              display: none;
            }
        }
        </style>

		<!-- FONT AWESOME -->
		<link href="_cdn/fa-5.8.2/css/all.css" rel="stylesheet">

        <!-- LOADING PROGRESS BARS - PACE.js -->
        <?php if(strpos($Url[0],'impr') !== false){ ?>
          <script src="_cdn/pace.js"></script>
          <link href="_cdn/pace_progress.css" rel="stylesheet">
        <?php }else{ ?>
          <script src="_cdn/pace.js"></script>
          <link href="_cdn/pace_thin.css" rel="stylesheet">
        <?php } ?>

    </head>
    <body>
        <?php
        //MENU SUPERIOR
        if(strpos($Url[0],'impr') !== false){

        }else{
          require REQUIRE_PATH . "/inc/menu.php";
        }
        //MENU SUPERIOR

        //CONTEÚDO
        $Url[1] = (empty($Url[1]) ? HOME : $Url[1]);
        if (file_exists(REQUIRE_PATH . '/' . $Url[0] . '.php')):
            require REQUIRE_PATH . '/' . $Url[0] . '.php';
        else:
            require REQUIRE_PATH . '/404.php';
        endif;
        //CONTEÚDO

        //FOOTER
        require REQUIRE_PATH . "/inc/footer.php";
        //FOOTER
        ?>
    </body>
</html>
