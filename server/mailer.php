<?php

  $action = $_GET['TC']; // get TC number ..
  /* ================================================================= */
  /* begin of server                                                   */
  /*                                                                   */

    /*=============================================*/
    /* test config : sillychilli ...               */
/*
    $SMTPHost     = "srv168.prodns.com.br";
    $SMTPPort     = 465;
    $SMTPUsername = "sendemail@sillychilli.com.br";
    $SMTPPassword = "1234Bier";

    $emailContato = "burzinsky@yahoo.com.br";
    $emailFrom    = "sendemail@sillychilli.com.br";
*/
    /*=============================================*/

    /*=============================================*/
    /* Mairibel config : ...               */
/**/
    $SMTPHost     = "email-ssl.com.br";
    $SMTPPort     = 465;
    $SMTPUsername = "sendEMail@mairibel.com.br";
    $SMTPPassword = "loc@1020";

    $emailContato = "contato@mairibel.com.br";
    $emailPedido  = "pedidos@mairibel.com.br";
    $emailComentarios  = "comentarios@mairibel.com.br";
    $emailFrom    = "sendEMail@mairibel.com.br";
/**/
    /*=============================================*/



  if($action == '090909'){  
      ;
  }

  else if($action == '5151'){

    $nome          = $_GET['nome'];  
    $assunto       = $_GET['assunto'];  
    $email         = $_GET['email'];  
    $fone          = $_GET['fone'];  
    $mensagemForm  = $_GET['mensagem'];  
    
    require 'PHPMailer/PHPMailerAutoload.php';
    require('PHPMailer/class.smtp.php');
    require 'PHPMailer/class.phpmailer.php';

    $phpmail = new PHPMailer();
    $phpmail->IsSMTP(); 				   // envia por SMTP

    $phpmail->Host       = $SMTPHost;      // SMTP servers
	$phpmail->Port       = $SMTPPort;      // Set the SMTP port
    $phpmail->SMTPAuth   = true; 		   // Caso o servidor SMTP precise de autenticação
    $phpmail->Username   = $SMTPUsername;  // SMTP username
    $phpmail->Password   = $SMTPPassword;  // SMTP password
    $phpmail->SMTPSecure = 'ssl';
 
    $phpmail->From     = $emailFrom;
    $phpmail->FromName = $nome;
    $phpmail->AddAddress($emailContato);
    $phpmail->Subject  = $assunto;
    $phpmail->Body  = "Nome: ".$nome."<br>";
    $phpmail->Body .= "Assunto: ".$assunto."<br>";
    $phpmail->Body .= "E-mail: ".$email."<br>";
    $phpmail->Body .= "Fone: ".$fone."<br>";
    $phpmail->Body .= "Mensagem: ".nl2br($mensagemForm)."<br>";

    $phpmail->AltBody = '';
    $phpmail->isHTML(true);   

    $send = $phpmail->Send();

    if($send){
        echo "A Mensagem foi enviada com sucesso.";
    }
    else{
        echo "Não foi possível enviar a mensagem. Erro: " .$phpmail->ErrorInfo;
    }

  } /* send Contato .. */
  else if($action == '5152'){
        
    $assunto       = "Comentario pedido";  
    $mensagemForm  = $_GET['mensagem'];  
    $radio1  = $_GET['radio1'];  
    $radio2  = $_GET['radio2'];  
      
    require 'PHPMailer/PHPMailerAutoload.php';
    require('PHPMailer/class.smtp.php');
    require 'PHPMailer/class.phpmailer.php';

    $phpmail = new PHPMailer();

    $phpmail->IsSMTP(); 					        // envia por SMTP

    $phpmail->Host       = $SMTPHost;      // SMTP servers
	$phpmail->Port       = $SMTPPort;      // Set the SMTP port
    $phpmail->SMTPAuth   = true; 		   // Caso o servidor SMTP precise de autenticação
    $phpmail->Username   = $SMTPUsername;  // SMTP username
    $phpmail->Password   = $SMTPPassword;  // SMTP password
    $phpmail->SMTPSecure = 'ssl';
 
    $phpmail->From     = $emailFrom;
    $phpmail->FromName = $nome;
    $phpmail->AddAddress($emailComentarios);
    $phpmail->Subject  = $assunto;      
      
    $phpmail->Body  = "Pedido chegou: ".$radio1."<br>";
    $phpmail->Body .= "Pedido OK: ".$radio2."<br>";
    $phpmail->Body .= "Mensagem: ".nl2br($mensagemForm)."<br>";

    $phpmail->AltBody = '';
    $phpmail->isHTML(true);   

    $send = $phpmail->Send();

    if($send)
    {
        echo "A Mensagem foi enviada com sucesso.";
    }
    else
    {
        echo "Não foi possível enviar a mensagem. Erro: " .$phpmail->ErrorInfo;
    }

  } /* send Pedido Comentario ..  */
  else if($action == '5153'){
 
//$pedido = $_GET['pedidoId'];  
      
    $nome          = "Revendedor";  
    $assunto       = "Novo pedido";  
    $mensagemForm  = 'pedido1, teste1 ';  
      
    require 'PHPMailer/PHPMailerAutoload.php';
    require('PHPMailer/class.smtp.php');
    require 'PHPMailer/class.phpmailer.php';

    $phpmail = new PHPMailer();

    $phpmail->IsSMTP(); 					        // envia por SMTP

    $phpmail->Host       = $SMTPHost;      // SMTP servers
	$phpmail->Port       = $SMTPPort;      // Set the SMTP port
    $phpmail->SMTPAuth   = true; 		   // Caso o servidor SMTP precise de autenticação
    $phpmail->Username   = $SMTPUsername;  // SMTP username
    $phpmail->Password   = $SMTPPassword;  // SMTP password
    $phpmail->SMTPSecure = 'ssl';

    $phpmail->From     = $emailFrom;
    $phpmail->FromName = $nome;
    $phpmail->AddAddress($emailContato);
    $phpmail->Subject  = $assunto;      
      
    $phpmail->Body  = "Nome: ".$nome."<br>";
    $phpmail->Body .= "Assunto: ".$assunto."<br>";
    $phpmail->Body .= "Mensagem: ".nl2br($mensagemForm)."<br>";

    $phpmail->AltBody = '';
    $phpmail->isHTML(true);   

    $send = $phpmail->Send();

    if($send)
    {
echo "A Mensagem foi enviada com sucesso.";
    }
    else
    {
echo "Não foi possível enviar a mensagem. Erro: " .$phpmail->ErrorInfo;
    }

  } /* send Pedido  ..  */
   
  /* end of server ==================================================*/

?>  
