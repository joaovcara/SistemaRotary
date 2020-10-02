<?php
class Email{	
  
  function enviaEmail($destinatario, $remetente, $tarefa, $email, $prazo){
    
    $modelo_email = file_get_contents("scripts/email_model.html");
    
    $modelo_email = str_replace('{{nome}}', $destinatario, $modelo_email);
    $modelo_email = str_replace('{{de}}', $remetente, $modelo_email);
    $modelo_email = str_replace('{{tarefa}}', $tarefa, $modelo_email);
    $modelo_email = str_replace('{{prazo}}', $prazo, $modelo_email);
    $modelo_email = str_replace('{{host}}', $_SERVER['HTTP_HOST'].'/taskflow/', $modelo_email);
    $modelo_email = str_replace('{{link-sistema}}', $_SERVER['HTTP_HOST'].'/taskflow', $modelo_email);
    
    /* #### ALTERE OS CAMPOS ENTRE ASPAS SIMPLES DESTACADOS ABAIXO #### */
    
    /* ## CAMPO 1 ## Informe o e-mail que receberá o formulário */
    $destinatarios = $email;
    
    /* ## CAMPO 2 ## Informe o nome que será exibido no e-mail do formulário */
    $nomeDestinatario = $destinatario;
    
    /* ## CAMPO 3 ## Informe o endereço de e-mail completo criado em sua hospedagem, que será o remetente da mensagem. Como por exemplo teste@seudominio */
    $usuario = 'sistema@rtkinformatica.com.br';
    
    /* ## CAMPO 4 ## Informe a senha do endereço de e-mail acima */
    $senha = 'rtk123';
    
    /* ## CAMPO 5 ## Informe o email do remetente para o campo reply to */
    $email = $_SESSION['usuarioemail'];
    
    /* ## CAMPO 6 ## Informe o nome do remetente para o campo reply to */
    $nome = $remetente;
    
    
    /*abaixo as veriaveis principais, que devem conter em seu formulario*/
    $nomeRemetente = 'Taskflow';
    $assunto = 'Nova tarefa';
    
    
    /*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/
  
    include_once("phpmailer/class.phpmailer.php");
    
    $To = $destinatarios;
    $Subject = $assunto;
    $Message = $modelo_email;
    
    $Host = 'mail.rtkinformatica.com.br';
    $Username = $usuario;
    $Password = $senha;
    $Port = "587";
    
    $mail = new PHPMailer();
    //$mail->SMTPSecure = 'tls';
    $body = $Message;
    $mail->CharSet = "UTF-8";
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->Host = $Host; // SMTP server
    $mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->Port = $Port; // set the SMTP port for the service server
    $mail->Username = $Username; // account username
    $mail->Password = $Password; // account password
    
    $mail->SetFrom($usuario, 'Taskflow');
    $mail->Subject = $Subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($To, "");
    $mail->AddReplyTo($email , $nome);
    //$mail->AddBCC("conradomd@gmail.com","Conrado"); // Envia Cópia Oculta
    
    if(!$mail->Send()) {
      //$mensagemRetorno = 'Erro ao enviar e-mail: '; //.print($mail->ErrorInfo);
      //$erros .= "Erro ao enviar o email <br> " . $mail->ErrorInfo;
      echo false;
    } else {
      //$mensagemRetorno = 'E-mail enviado com sucesso!';
      //header("Location: /email/enviado#contato");
      echo true;
    }
  }
}