<?php
	// AplEmail.php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/util/class/Database.php');
	require_once(__PATH__.'/package/util/php-mailer/class.phpmailer.php');
	require_once(__PATH__.'/package/cdp/Email.php');
	require_once(__PATH__.'/package/cgd/DaoEmail.php');
	
	class AplEmail {
		private $daoEmail;
		
		
		public function __construct(){
			//$this->daoEmail = new DaoEmail();
		}
		public function __destruct(){
			// DESTRUCT OBJ
		}
		
		
		public function save($email){
			return($this->daoEmail->save($email));
		}
		
		
		public function get(){
			$email = $this->daoEmail->get();
			$this->daoEmail->updateCount($email);
			return($email);
		}
		
		
		public static function signUp($user){
			require_once(__PATH__.'/view/email/sign-up.php');
			AplEmail::sendEmail($email, $name, $subject, $body);
		}
		
		
		public static function sendContactMessage($contactMessage){
			require_once(__PATH__.'/view/email/contact-message.php');
			AplEmail::sendEmail($email, $name, $subject, $body);
		}
		
		
		public static function ticket($ticket){
			include(__PATH__.'/view/email/ticket.php');
			AplEmail::sendEmail($email, $name, $subject, $body);
		}
		
		
		public static function ticketSold($payment){
			require_once(__PATH__.'/view/email/ticket-sold.php');
			AplEmail::sendEmail($email, $name, $subject, $body);
		}
		
		
		public static function ticketRepass($ticket, $userRepass){
			require_once(__PATH__.'/view/email/ticket-repass.php');
			AplEmail::sendEmail($email, $name, $subject, $body);
		}
		
		
		public static function newFollower($follow){
			require_once(__PATH__.'/view/email/new-follower.php');
			AplEmail::sendEmail($email, $name, $subject, $body);
		}
		
		
		public static function ticketBill($payment){
			require_once(__PATH__.'/view/email/ticket-bill.php');
			AplEmail::sendEmail($email, $name, $subject, $body);
		}
		
		
		public static function forgotPassword($forgotPassword){
			require_once(__PATH__.'/view/email/forgot-password.php');
			AplEmail::sendEmail($email, $name, $subject, $body);
		}
		
		
		public static function sendEmail($toEmail, $toName, $subject, $body, $server='smtp.villopim.com.br', $fromEmail='peff@villopim.com.br', $fromName='Vinícius Thiengo', $password='peff33189588', $port='587', $charSet='iso-8859-1'){
			//$fromEmail = $this->get();
			//$fromEmail = $fromEmail->getEmail();
			
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com"; //$server;
			//$mail->Host = "email-smtp.us-east-1.amazonaws.com"; //$server;
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Username = "vuupevents@gmail.com"; //$fromEmail;
			$mail->Password = "gavetas31"; //$password;
			//$mail->Username = "AKIAIIRYVRKHDEOMVVWA"; //$fromEmail;
			//$mail->Password = "AuTOQlrhe5OOw71qTchbZPYKv3idr3+8AhH0FS+xYNKN"; //$password;
			$mail->Port = 465; //$port;
			
			$mail->From = "vuupevents@gmail.com"; //$fromEmail; // Seu e-mail
			$mail->FromName = "vuup Eventos"; // $fromName; // Seu nome
			
			if(!is_array($toEmail)){
				$mail->AddAddress($toEmail, $toName);
			}
			else{
				for($i = 0, $tam = count($toEmail); $i < $tam; $i++){
					$mail->AddAddress($toEmail[$i]->getEmail(), $toEmail[$i]->getName());
				}
			}
			
			
			$mail->IsHTML(true); // Define que o e-mail serÃ¡ enviado como HTML
			$mail->CharSet = $charSet;
		
			$mail->Subject = $subject; // Assunto da mensagem
			$mail->Body = $body;
			
			// Envia o e-mail
			$status = $mail->Send();
			 
			// Limpa os destinatÃ¡rios e os anexos
			$mail->ClearAllRecipients();
			$mail->ClearAttachments();
			
			// Exibe uma mensagem de resultado
			if($status)
				return(1);
			return($mail->ErrorInfo);
		}
	}
	
	//$aux = new AplEmail();
	//echo $aux->sendEmail('vinicius.aha@hotmail.com', 'Vinícius Thiengo', 'Teste', 'Teste AWS in PHP');
?>