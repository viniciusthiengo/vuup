<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/User.php');
	require_once(__PATH__.'/package/cdp/Bank.php');
	require_once(__PATH__.'/package/cdp/RemoveAccount.php');
	require_once(__PATH__.'/package/cdp/ContactMessage.php');
	require_once(__PATH__.'/package/cdp/Error.php');
	require_once(__PATH__.'/package/cdp/ForgotPassword.php');
	require_once(__PATH__.'/package/apl/AplEmail.php');
	require_once(__PATH__.'/package/apl/AplFile.php');
	require_once(__PATH__.'/package/cgd/DaoUser.php');
	require_once(__PATH__.'/package/util/class/Gcm.php');
	require_once(__PATH__.'/package/util/php-aws-ses-master/src/SimpleEmailService.php');
	require_once(__PATH__.'/package/util/php-aws-ses-master/src/SimpleEmailServiceMessage.php');
	require_once(__PATH__.'/package/util/php-aws-ses-master/src/SimpleEmailServiceRequest.php');
	
	
	class AplUser {
		private $dao;
		
		
		public function __construct(){
			$this->dao = new DaoUser();
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function save($user, $error){
			// ERROR
				$return = 0;
				if($this->dao->verifyUrlSufix($user) > 0){
					$error->setHasError(true);
					$error->setUrlSufixError(new ErrorBlock('URL personalizada já em uso', true));
				}
				if($this->dao->verifyEmail($user) > 0){
					$error->setHasError(true);
					$error->setEmailError(new ErrorBlock('Email já em uso', true));
				}
			// ERROR
			
			if(!$error->hasError()){
				$return = $this->dao->save($user);
				
				if(!empty($return)){
					
					// ADDRESS
						//$user->setId($this->dao->getUserIdByEmail($user));
						//$this->dao->saveAddress($user);
						
					// BANK
						/*$user->setId($this->dao->getUserIdByEmail($user));
						$user->getBank()->setUser($user);
						$this->dao->updateBank($user->getBank());
						$this->dao->updateBankStatusTime($user->getBank());*/
					
					//AplEmail::signUp($user);
					// ALGORITMO QUE PERMITE O ENVIO DO EMAIL ***********************
					/*include(__PATH__.'/view/email/sign-up.php');
					$ses = new SimpleEmailService(__SES_TOKEN__, __SES_KEY__);
					$simpleEmailService = new SimpleEmailServiceMessage();
					$simpleEmailService->setFrom(__SES_EMAIL_FROM__);
					$simpleEmailService->addReplyTo(__SES_EMAIL_REPLY__);
					$simpleEmailService->addTo($email);
					$simpleEmailService->setSubject($subject);
					$simpleEmailService->setMessageFromString('', $body);
					$ses->sendEmail($simpleEmailService);*/
				}
			}
			return($return);
		}
		
		
		public function update($user, $error){
			// ERROR
				$return = 0;
				if($this->dao->verifyEmail($user) > 0){
					$error->setHasError(true);
					$error->setEmailError(new ErrorBlock('Email já em uso', true));
				}
			// ERROR
			
			if(!$error->hasError()){
				$oldImg = $this->dao->getOldImage($user);
				$return = $this->dao->update($user);
				
				if(!empty($return)){
					// ADDRESS
						//$this->dao->saveAddress($user);
						
					// IMAGE MAIN
						if(strlen($user->getImage()->getName()) > 0 && file_exists('../../img/temp/'.$user->getImage()->getName())){
							if(is_object($oldImg)){
								@unlink('../../img/user/normal/'.$oldImg->getName());
								@unlink('../../img/user/240-240/'.$oldImg->getName());
								@unlink('../../img/user/150-150/'.$oldImg->getName());
								@unlink('../../img/user/100-100/'.$oldImg->getName());
								@unlink('../../img/user/70-70/'.$oldImg->getName());
								@unlink('../../img/user/52-52/'.$oldImg->getName());
								@unlink('../../img/user/50-50/'.$oldImg->getName());
								@unlink('../../img/user/44-44/'.$oldImg->getName());
								@unlink('../../img/user/39-39/'.$oldImg->getName());
								@unlink('../../img/user/30-30/'.$oldImg->getName());
								@unlink('../../img/user/25-25/'.$oldImg->getName());
							}
							
							$aplFile = new AplFile();
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/normal/'.$user->getImage()->getName(), 1000, 1000, 'inside', 'down');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/240-240/'.$user->getImage()->getName(), 240, 240, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/150-150/'.$user->getImage()->getName(), 150, 150, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/100-100/'.$user->getImage()->getName(), 100, 100, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/70-70/'.$user->getImage()->getName(), 70, 70, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/52-52/'.$user->getImage()->getName(), 52, 52, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/50-50/'.$user->getImage()->getName(), 50, 50, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/44-44/'.$user->getImage()->getName(), 44, 44, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/39-39/'.$user->getImage()->getName(), 39, 39, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/30-30/'.$user->getImage()->getName(), 30, 30, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$user->getImage()->getName(), '../../img/user/25-25/'.$user->getImage()->getName(), 25, 25, 'fill', 'any', true);
						}
						else if(strlen($user->getImage()->getName()) == 0 && is_object($oldImg)){
							@unlink('../../img/user/normal/'.$oldImg->getName());
							@unlink('../../img/user/240-240/'.$oldImg->getName());
							@unlink('../../img/user/150-150/'.$oldImg->getName());
							@unlink('../../img/user/100-100/'.$oldImg->getName());
							@unlink('../../img/user/70-70/'.$oldImg->getName());
							@unlink('../../img/user/52-52/'.$oldImg->getName());
							@unlink('../../img/user/50-50/'.$oldImg->getName());
							@unlink('../../img/user/44-44/'.$oldImg->getName());
							@unlink('../../img/user/39-39/'.$oldImg->getName());
							@unlink('../../img/user/30-30/'.$oldImg->getName());
							@unlink('../../img/user/25-25/'.$oldImg->getName());
						}
				}
			}
			return($return);
		}
		
		
		public function updatePassword($user, $error){
			// ERROR
				$return = 0;
				if($this->dao->verifyPassword($user) == 0){
					$error->setHasError(true);
					$error->setPasswordError(new ErrorBlock('Senha atual inválida', true));
				}
			// ERROR
			
			if(!$error->hasError()){
				$return = $this->dao->updatePassword($user);
			}
			return($return);
		}
		
		
		public function verifyPassword($user){
			return($this->dao->verifyPassword($user));
		}
		
		
		public function updateBank($bank, $error){
			// ERROR
				$return = 0;
				if($this->verifyPassword($bank->getUser()) == 0){
					$error->setHasError(true);
					$error->setPasswordError(new ErrorBlock('Senha inválida', true));
				}
			// ERROR
			
			if(!$error->hasError()){
				$oldDocument = $this->dao->getOldDocument($bank->getUser());
				$return = $this->dao->updateBank($bank);
				
				if(!empty($return)){
					// STATUS
						$this->dao->updateBankStatusTime($bank);
						
					// DOC
						if(strlen($bank->getDocument()->getName()) > 0 && file_exists('../../img/temp/'.$bank->getDocument()->getName())){
							if(is_object($oldDocument)){
								@unlink('../../file/user/'.$oldDocument->getName());
							}
							
							$aplFile = new AplFile();
							$aplFile->setFileToDirectory('../../img/temp/'.$bank->getDocument()->getName(), '../../file/user/'.$bank->getDocument()->getName(), true);
						}
				}
			}
			return($return);
		}
		
		
		public function verifyUrlSufix($user, $error){
			$return = $this->dao->verifyUrlSufix($user);
			
			if($return == 1){
				$error->setHasError(true);
				$error->setUrlSufixError(new ErrorBlock('URL personalizada já em uso', true));
			}
			
			return($return);
		}
		
		
		public function verifyLogin($user){
			$return = $this->dao->verifyLogin($user);
			if($return == 1){
				$user->setId($this->dao->getIdByLogin($user));
			}
			return($return);
		}
		
		
		public function getUsers($user){
			$arrayUsers = $this->dao->getUsers($user);
			
			for($i = 0, $tam = count($arrayUsers); $i < $tam; $i++){
				$arrayUsers[$i]->setBank($this->getBank($arrayUsers[$i]));
				//$arrayUsers[$i]->setAddress($this->getAddress($arrayUsers[$i]));
			}
			return($arrayUsers);
		}
		
		
		public function getUserByPage($user){
			$user = $this->dao->getUserByPage($user);
			
			if(is_object($user)){
				$user = $this->getUsers($user);
				$user = $user[0];
			}
			return($user);
		}
		
		
		public function getAddress($user){
			return($this->dao->getAddress($user));
		}
		
		
		public function confirmAccount($user){
			$user = $this->getUserByHashEmail($user);
			if($user->getId() > 0 && $user->getStatus() == 2){
				$user->setStatus(1);
				$return = $this->dao->setUserStatus($user);
				$user->setReturn($return);
			}
			return($user);
		}
		
		
		public function getUserByHashEmail($user){
			$user->setId($this->dao->getUserIdByHashEmail($user));
			if($user->getId() > 0){
				$user = $this->getUsers($user);
				$user = $user[0];
			}
			return($user);
		}
		public function getUserByEmail($user, $withStatus=false){
			$user->setId($this->dao->getUserIdByEmail($user, $withStatus));
			if($user->getId() > 0){
				$user = $this->getUsers($user);
				$user = $user[0];
			}
			return($user);
		}
		
		
		public function getBank($user){
			return($this->dao->getBank($user));
		}
		
		
		public function saveContactMessage($contactMessage, $error){
			// ERROR
				$return = 0;
				if($contactMessage->getUserFrom()->getId() == 0 && strlen(trim($contactMessage->getUserFrom()->getName())) == 0){
					$error->setHasError(true);
					$error->setNameError(new ErrorBlock('Nome inválido', true));
				}
				if($contactMessage->getUserFrom()->getId() == 0 && !preg_match('/^([0-9a-zA-Z]+[-._+&amp;])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$/', $contactMessage->getUserFrom()->getEmail())){
					$error->setHasError(true);
					$error->setEmailError(new ErrorBlock('Email inválido', true));
				}
			// ERROR
			
			if(!$error->hasError()){
				$return = $this->dao->saveContactMessage($contactMessage);
				
				if($return){
					//AplEmail::sendContactMessage($contactMessage);
					include(__PATH__.'/view/email/contact-message.php');
					$ses = new SimpleEmailService(__SES_TOKEN__, __SES_KEY__);
					$simpleEmailService = new SimpleEmailServiceMessage();
					$simpleEmailService->setFrom(__SES_EMAIL_FROM__);
					$simpleEmailService->addReplyTo(__SES_EMAIL_REPLY__);
					$simpleEmailService->addTo($email);
					$simpleEmailService->setSubject($subject);
					$simpleEmailService->setMessageFromString('', $body);
					$ses->sendEmail($simpleEmailService);
				}
			}
			return($return);
		}
		
		
		public function setNumberEventCorrectly($user){
			return($this->dao->setNumberEventCorrectly($user));
		}
		
		
		public function verifyUserAlreadyFollow($follow){
			return($this->dao->verifyUserAlreadyFollow($follow));
		}
		public function setUserFollow($follow){
			$return = 0;
			if($this->verifyUserAlreadyFollow($follow) == 0){
				$return = $this->dao->saveUserFollow($follow);
				
				if($return == 1){
					$aux = $this->getUsers($follow->getUserFollower());
					$follow->setUserFollower($aux[0]);
					
					$aux = $this->getUsers($follow->getUserFollowing());
					$follow->setUserFollowing($aux[0]);
					
					//AplEmail::newFollower($follow);
					include(__PATH__.'/view/email/new-follower.php');
					$ses = new SimpleEmailService(__SES_TOKEN__, __SES_KEY__);
					$simpleEmailService = new SimpleEmailServiceMessage();
					$simpleEmailService->setFrom(__SES_EMAIL_FROM__);
					$simpleEmailService->addReplyTo(__SES_EMAIL_REPLY__);
					$simpleEmailService->addTo($email);
					$simpleEmailService->setSubject($subject);
					$simpleEmailService->setMessageFromString('', $body);
					$ses->sendEmail($simpleEmailService);
				}
			}
			else{
				$return = $this->dao->deleteUserFollow($follow);
			}
			$this->dao->setNumberFollowingCorrectly($follow->getUserFollowing());
			$this->dao->setNumberFollowerCorrectly($follow->getUserFollower());
			return($return);
		}
		
		
		public function getFollows($follow){
			$arrayFollows = $this->dao->getFollows($follow);
			
			for($i = 0, $tamI = count($arrayFollows); $i < $tamI; $i++){
				if($follow->getIsFollowing()){
					$aux = $this->getUsers($arrayFollows[$i]->getUserFollower());
					$arrayFollows[$i]->setUserFollower($aux[0]);
				}
				else{
					$aux = $this->getUsers($arrayFollows[$i]->getUserFollowing());
					$arrayFollows[$i]->setUserFollowing($aux[0]);
				}
			}
			return($arrayFollows);
		}
		
		
		// FORGOT PASSWORD
			public function setForgotPassword($forgotPassword, $error){
				// ERROR
					$return = 0;
					$forgotPassword->setUser($this->getUserByEmail($forgotPassword->getUser(), true));
					if($forgotPassword->getUser()->getId() == 0){
						$error->setHasError(true);
						$error->setEmailError(new ErrorBlock('Nenhum usuário identificado com o email fornecido.', true));
					}
				// ERROR
				
				if(!$error->hasError()){
					$return = $this->dao->saveForgotPassword($forgotPassword);
					$forgotPassword = $this->getForgotPasswordIdByUser($forgotPassword);
					
					if(!empty($return) && $forgotPassword->getId() > 0){
						// USER DATA
							$auxUser = $this->getUsers($forgotPassword->getUser());
							$forgotPassword->setUser($auxUser[0]);
							
						//AplEmail::forgotPassword($forgotPassword);
						include(__PATH__.'/view/email/forgot-password.php');
						$ses = new SimpleEmailService(__SES_TOKEN__, __SES_KEY__);
						$simpleEmailService = new SimpleEmailServiceMessage();
						$simpleEmailService->setFrom(__SES_EMAIL_FROM__);
						$simpleEmailService->addReplyTo(__SES_EMAIL_REPLY__);
						$simpleEmailService->addTo($email);
						$simpleEmailService->setSubject($subject);
						$simpleEmailService->setMessageFromString('', $body);
						$ses->sendEmail($simpleEmailService);
					}
				}
				return($return);
			}
			
			
			public function getForgotPasswordIdByUser($forgotPassword){
				$forgotPassword->setId($this->dao->getForgotPasswordIdByUser($forgotPassword));
				if($forgotPassword->getId() > 0){
					$forgotPassword = $this->dao->getForgotPassword($forgotPassword);
				}
				return($forgotPassword);
			}
			
			
			public function getForgotPasswordIdByHash($forgotPassword){
				$forgotPassword->setId($this->dao->getForgotPasswordIdByHash($forgotPassword));
				if($forgotPassword->getId() > 0){
					$forgotPassword = $this->dao->getForgotPassword($forgotPassword);
				}
				return($forgotPassword);
			}
			
			
			public function getForgotPassword($forgotPassword){
				$forgotPassword = $this->getForgotPasswordIdByHash($forgotPassword);
				return($forgotPassword);
			}
			
			
			public function setPasswordByForgotPassword($forgotPassword, $error){
				// ERROR
					$return = 0;
					if($this->dao->varifyValidForgotPassword($forgotPassword) == 0){
						$error->setHasError(true);
						$error->setPasswordError(new ErrorBlock('Token de recuperação de senha inválido.', true));
					}
				// ERROR
				
				if(!$error->hasError()){
					$return = $this->dao->updatePassword($forgotPassword->getUser());
					
					if(!empty($return)){
						// UPDATE STATUS
							$auxForgotPassword = $this->getForgotPassword($forgotPassword);
							$forgotPassword->setId($auxForgotPassword->getId());
							$forgotPassword->setStatus(0);
							$this->dao->updateForgotPasswordStatus($forgotPassword);
							
						// USER DATA
							$auxUser = $this->getUsers($forgotPassword->getUser());
							$forgotPassword->setUser($auxUser[0]);
					}
				}
				return($return);
			}
	}
?>