<?php

/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

include "../_app/Config.inc.php";

//               dados
$proposta = $crud->query_p("
	SELECT p.*,
  c.nome as nome_cliente
  FROM tb_proposta p
  INNER JOIN tb_cliente c ON c.id = p.id_cliente
  WHERE p.id = ".$_GET['id']."
  ")[0];

$cliente = $crud->pdo_src('cliente', 'WHERE id = ' . $proposta['id_cliente'])[0];

require '../lib/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../lib/vendor/phpmailer/phpmailer/src/SMTP.php';
require '../lib/vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//Server settings
$mail->SMTPDebug = 0;                                       // Enable verbose debug output
$mail->isSMTP();
$mail->charSet = 'UTF-8';
$mail->Encoding = 'base64';                                          // Set mailer to use SMTP
$mail->Host       = 'smtp.skymail.net.br';                  // Specify main and backup SMTP servers
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'sistema@aosantos.com.br';           // SMTP username
$mail->Password   = 'M@ilsis10';                            // SMTP password
$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
$mail->Port       = 465;                                    // TCP port to connect to

//Recipients
$mail->setFrom('sistema@aosantos.com.br', 'AO Santos');
$mail->addReplyTo('sistema@aosantos.com.br', 'AO Santos');

 // $mail->addAddress('desenvolvimento@inforway.com', 'TESTE');     // Add a recipient
$mail->addAddress($cliente['email'], $cliente['nome']);     // Add a recipient

//$mail->addAddress('backup@zmbequipamentos.com.br', 'Webmaster');          // Add a recipient
//$mail->addCC('cc@zmbequipamentos.com.br');
//$mail->addBCC('bcc@zmbequipamentos.com.br');

// Attachments
//$mail->addAttachment('../themes/sshtml/img/favicon.png', 'icone');  // Optional name

//LINK DE DOWNLOAD + MENSAGEM HTML
$valor_ofuscado = SA_Encryption::encrypt_to_url_param($_GET['id']);
$link = "http://aosantos.com.br/sistema/imprpropcript?token=$valor_ofuscado";

$mensagem = utf8_decode('
<p>&nbsp;</p>
	<style type="text/css">
		a:hover{
			color:black;
		}
	</style>
	<body style="margin: 0; padding: 0;">
<center>
		<table cellpadding="0" cellspacing="0" width="600" style="border-width: 1px; border-color:#1C57A5; border-style: dotted;">

			<tr border="0">
				<td border="0" bgcolor="#004E2B" style="padding: 10px 0 10px 0;">
				</td>
			</tr>
			<tr border="0">
				<td border="0" align="center" style="padding: 10px 0 10px 0;">
					<h3 style=" margin-top:20px; text-align: center; color: #004e2b;">Muito Obrigado por fazer negócios com a</h3>
				</td>
			</tr>
			<tr border="0">
				<td border="0" align="center" bgcolor="#fff" style=" padding: 5px 0 5px 0;">
						<img width="300" height="200" style="display: block;" src="http://aosantos.com.br/sistema/themes/sshtml/img/logo.png" alt="logo" />
				</td>
			</tr>
			<tr border="0">
				<td border="0" bgcolor="#ffffff" style="padding: 10px 30px 40px 190px;">

						<tr align="center">
							<td align="center" style="padding: 0 0 0 0">
								<p><b>Sua proposta comercial pode ser impressa / salva através do link:</b></p>
								<br/>
								<a target=_blank href='.$link.'>
								<img style="display: block;" src="http://aosantos.com.br/sistema/themes/sshtml/img/botao.png" alt="botao" />
								</a>
							</td>
						</tr>
						<tr border="0">
							<td align="center" >
								<br/>
								<br/>
									<p ><span style="font-size:20;"><b>Em caso de duvidas, entre em contato conosco via:</b></span></p>
							</td>
					</tr>
						<tr  align="center" border="0" >
							<td align="center" >
									<br />
									<div style="display:inline-block;">
									<a target="_blank" style="text-decoration:none;color:#000;" rel="nofollow noopener"href="tel:+552137535951">
									<img alt="telefone" width="70" height="50" src="http://aosantos.com.br/sistema/themes/sshtml/img/tel.png" />
									<br/>
									<br/>
									<span style="font-size:18px;">Atendimento:</span>
									<br/>
									<span style="font-size:16px;"><b>+55 21 3753-5951</b>&nbsp;</span>
									</a>
									<br/>
									<br/>
									<br/>
									</div>
									<div style="display:inline-block;">
									<a target="_blank" style="text-decoration:none;color:#000;" rel="nofollow noopener"href="mailto:alvimaraos@ig.com.br">
									<img alt="telefone" width="50" height="40" style="margin: 0 0 8px 0;" src="http://aosantos.com.br/sistema/themes/sshtml/img/email.png" />
									<br/>
									<br/>
									<span style="font-size:18px;">Email:</span>
									<br/>
									<span style="font-size:16px;"><b>alvimaraos@ig.com.br</b>&nbsp;</span>
									</a>
									</div>
								<p> </p> <br />
							</td>
						</tr>

				</td>
			</tr>
			<tr border="0">
				<td align="center" bgcolor="#004E2B" style="padding: 30px 30px 30px 30px; color:#fff;">
					<p><b>A AO Santos agradece a prefer&ecirc;ncia!</b></p>
			</tr>
		</table>
</center>
</body>
');

//$mensagem .= "Link para download: <a target=_blank href='$link'>$link</a>";

// echo $mensagem;
// exit();

// Content
$mail->isHTML(true);                                                    // Set email format to HTML
$mail->Subject = 'AO Santos - Proposta Comercial';
$mail->Body    = $mensagem;
$mail->AltBody = $mensagem;

if(!$mail->send()) {
	echo "Erro no envio: " . $mail->ErrorInfo;
} else {
  ?>
  <script type="text/javascript">
  alert("Orçamento / Proposta enviada com sucesso!");
  window.close();
  </script>
  <?php
}
