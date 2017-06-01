<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/util/class/Database.php');
	
	class DaoUser {
		private $conn;
		
		
		public function __construct(){
			$this->conn = new Database();
		}
		public function __destruct(){
			$this->conn->close();
		}
		
		
		public function save($user){
			$data = array();
			$data[] = $this->conn->cleanDataOnlyForMysql($user->getName());
			$data[] = $this->conn->cleanData($user->getUrlSufix());
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $user->getPasswordWithHash();
			$data[] = $this->conn->cleanData($user->getImage()->getName());
			$data[] = $this->conn->cleanData($user->getStatus());
			$data[] = $this->conn->cleanData($user->getIdFacebook());
			$data[] = $this->conn->cleanData($user->getDescription());
			$data[] = $this->conn->cleanData($user->getCpf());
			$data[] = $this->conn->cleanData($user->getPhone()->getCode());
			$data[] = $this->conn->cleanData($user->getPhone()->getNumber());
			$data[] = $this->conn->cleanData($user->getTime());
			$query = <<<HTML
				INSERT INTO
					vu_user(name,
							url_sufix,
							email,
							password,
							image,
							status,
							id_facebook,
							description,
							cpf,
							phone_code,
							phone_number,
							time)
					VALUES("$data[0]",
							"$data[1]",
							"$data[2]",
							"$data[3]",
							"$data[4]",
							$data[5],
							"$data[6]",
							"$data[7]",
							"$data[8]",
							"$data[9]",
							"$data[10]",
							$data[11])
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function update($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$data[] = $this->conn->cleanDataOnlyForMysql($user->getName());
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $this->conn->cleanDataOnlyForMysql($user->getDescription());
			$data[] = $this->conn->cleanData($user->getImage()->getName());
			$data[] = $this->conn->cleanData($user->getCpf());
			$data[] = $this->conn->cleanData($user->getPhone()->getCode());
			$data[] = $this->conn->cleanData($user->getPhone()->getNumber());
			$data[] = $this->conn->cleanData($user->getTime());
			$query = <<<HTML
				UPDATE
					vu_user
					SET
						name = "$data[1]",
						email = "$data[2]",
						description = "$data[3]",
						image = "$data[4]",
						cpf = "$data[5]",
						phone_code = "$data[6]",
						phone_number = "$data[7]",
						time_update = $data[8]
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function updatePassword($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$data[] = $user->getPasswordWithHash();
			$query = <<<HTML
				UPDATE
					vu_user
					SET
						password = "$data[1]"
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function updateBank($bank){
			$data = array();
			$data[] = $bank->getUser()->getId();
			$data[] = $this->conn->cleanData($bank->getBankTypeAccount()->getItem());
			$data[] = $this->conn->cleanData($bank->getBankBrand()->getItem());
			$data[] = $this->conn->cleanData($bank->getAgency());
			$data[] = $this->conn->cleanData($bank->getNumber());
			$data[] = $this->conn->cleanData($bank->getDigit());
			$data[] = $this->conn->cleanData($bank->getOperation());
			$data[] = $this->conn->cleanData($bank->getDocument()->getName());
			$query = <<<HTML
				INSERT INTO
					vu_user_bank(id_user,
								type_account,
								bank,
								agency,
								number,
								digit,
								operation,
								document)
					VALUES($data[0],
							$data[1],
							$data[2],
							"$data[3]",
							"$data[4]",
							"$data[5]",
							"$data[6]",
							"$data[7]")
					ON DUPLICATE KEY
						UPDATE
							type_account = $data[1],
							bank = $data[2],
							agency = "$data[3]",
							number = "$data[4]",
							digit = "$data[5]",
							operation = "$data[6]",
							document = "$data[7]"
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function updateBankStatusTime($bank){
			$data = array();
			$data[] = $bank->getUser()->getId();
			$data[] = $this->conn->cleanData($bank->getStatus());
			$data[] = $this->conn->cleanData($bank->getTime());
			$query = <<<HTML
				UPDATE
					vu_user_bank
					SET
						status = $data[1],
						time = $data[2]
					WHERE
						id_user = $data[0]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function setUserStatus($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$data[] = $this->conn->cleanData($user->getStatus());
			$query = <<<HTML
				UPDATE
					vu_user
					SET
						status = $data[1]
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function verifyUrlSufix($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getUrlSufix());
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_user
					WHERE
						url_sufix LIKE "$data[0]"
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->numRows($result);
			$this->conn->free($result);
			return($data);
		}
		
		
		public function getUserIdByHashEmail($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getEmail());
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_user
					WHERE
						SHA1(CONCAT( REVERSE(email), MD5(REVERSE(email)), CHAR_LENGTH(email), email ) ) LIKE "$data[0]"
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = 0;
			if($this->conn->numRows($result) == 1){
				$data = $this->conn->fetchObject($result);
				$data = $data->id;
			}
			$this->conn->free($result);
			return($data);
		}
		
		
		public function verifyLogin($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $user->getPassword();
			$query = <<<HTML
				SELECT SQL_NO_CACHE 
					id
					FROM
						vu_user
					WHERE
						email LIKE "$data[0]"
						AND
						password = CONCAT( LEFT( password, 7 ), SHA1( CONCAT( LEFT( password, 7 ), "$data[1]" ) ) )
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			//exit($query);
			$result = $this->conn->query($query);
			$data = $this->conn->numRows($result);
			$this->conn->free($result);
			return($data);
		}
		public function verifyPassword($user){
			$data = array();
			$data[] = $user->getId();
			$data[] = $this->conn->cleanData($user->getCurrentPassword());
			$query = <<<HTML
				SELECT SQL_NO_CACHE 
					id
					FROM
						vu_user
					WHERE
						id = $data[0]
						AND
						password = CONCAT( LEFT( password, 7 ), SHA1( CONCAT( LEFT( password, 7 ), "$data[1]" ) ) )
					LIMIT 1
HTML;
			//$this->conn->fileQuery($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->numRows($result);
			$this->conn->free($result);
			return($data);
		}
		public function getIdByLogin($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $user->getPassword();
			
			$query = <<<HTML
				SELECT SQL_NO_CACHE 
					id
					FROM
						vu_user
					WHERE
						email LIKE "$data[0]"
						AND
						password = CONCAT( LEFT( password, 7 ), SHA1( CONCAT( LEFT( password, 7 ), "$data[1]" ) ) )
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->fetchObject($result);
			$this->conn->free($result);
			return($data->id);
		}
		
		
		/*public function saveIdFacebook($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$data[] = $this->conn->cleanData($user->getIdFacebook());
			$query = <<<HTML
				UPDATE
					vu_user
					SET
						id_facebook = "$data[1]"
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}*/
		
		
		/*public function updatePassword($user){
			$data = array();
			$data[] = $user->getId();
			$data[] = $user->getPasswordWithHash();
			
			$query = <<<HTML
				UPDATE
					vu_user
					SET
						password = "$data[1]"
					WHERE
						id = $data[0]
HTML;
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function updateUserStatus($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$data[] = $this->conn->cleanData($user->getStatus());
			$query = <<<HTML
				UPDATE
					vu_user
					SET
						status = $data[1]
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			//$this->conn->fileQuery($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function deleteUser($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$query = <<<HTML
				UPDATE
					vu_user
					SET
						email = CONCAT('del.', email, '.del'),
						status = 0
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function verifyUserEmail($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$data[] = $this->conn->cleanData($user->getEmail());
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_user
					WHERE
						id != $data[0]
						AND
						email LIKE "$data[1]"
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->numRows($result);
			$this->conn->free($result);
			return($data);
		}
		public function verifyUserPhoneNumber($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$data[] = $this->conn->cleanData($user->getPhone());
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_user
					WHERE
						id != $data[0]
						AND
						phone LIKE "$data[1]"
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->numRows($result);
			$this->conn->free($result);
			return($data);
		}*/
		
		
		public function saveContactMessage($contactMessage){
			$data = array();
			$data[] = $this->conn->cleanData($contactMessage->getUserTo()->getId());
			$data[] = $this->conn->cleanData($contactMessage->getUserFrom()->getId());
			$data[] = $this->conn->cleanDataOnlyForMysql($contactMessage->getUserFrom()->getName());
			$data[] = $this->conn->cleanData($contactMessage->getUserFrom()->getEmail());
			$data[] = $this->conn->cleanDataOnlyForMysql($contactMessage->getMessage());
			$data[] = $this->conn->cleanData($contactMessage->getTime());
			$query = <<<HTML
				INSERT INTO
					vu_contact_message(id_user_to,
										id_user_from,
										name_user_from,
										email_user_from,
										message,
										time)
					VALUES($data[0],
							$data[1],
							"$data[2]",
							"$data[3]",
							"$data[4]",
							$data[5])
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function getOldImage($obj){
			$data = array();
			$data[] = $obj->getId();
			$query = <<<HTML
				SELECT
					image
					FROM
						vu_user
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$image = NULL;
			if($this->conn->numRows($result) > 0){
				$data = $this->conn->fetchObject($result);
				$image = new Image();
				$image->setName($data->image);
			}
			$this->conn->free($result);
			return($image);
		}
		
		
		public function getOldDocument($obj){
			$data = array();
			$data[] = $obj->getId();
			$query = <<<HTML
				SELECT
					document
					FROM
						vu_user_bank
					WHERE
						id_user = $data[0]
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$document = NULL;
			if($this->conn->numRows($result) > 0){
				$data = $this->conn->fetchObject($result);
				$document = new File();
				$document->setName($data->document);
			}
			$this->conn->free($result);
			return($document);
		}
		
		
		public function getUserIdByEmail($user, $withStatus=true){
			$data = array();
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $withStatus ? 'AND status = 1' : '';
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_user
					WHERE
						email LIKE "$data[0]"
						$data[1]
					LIMIT 1
HTML;
			//$this->conn->fileQuery($query, 'a');
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = 0;
			while($data = $this->conn->fetchObject($result)){
				$data = $data->id;
				break;
			}
			$this->conn->free($result);
			return($data);
		}
		
		
		public function getUsers($user){
			$data = array();
			if(is_object($user->getSearch())){
				$data[] = 'name LIKE "'.$this->conn->cleanData($user->getSearch()->getText()).'%"';
				$data[] = 'AND status = 1 AND id NOT IN('.$user->getId().','.$user->getSearch()->getObj()->getId().')';
			}
			else if($user->getId() > 0 || strlen($user->getEmail()) > 0){
				$data[] = $user->getId() > 0 ? 'id = '.$this->conn->cleanData($user->getId()) : 'email LIKE "'.$this->conn->cleanData($user->getEmail()).'"';
				$data[] = '';
			}
			else{
				$data[] = 'status = 1';
				$data[] = '';
			}
			$data[] = $user->getLimit() == 0 ? '' : 'LIMIT '.$user->getLimit();
			$query = <<<HTML
				SELECT
					id,
					url_sufix,
					name,
					email,
					image,
					status,
					cpf,
					phone_code,
					phone_number,
					id_facebook,
					description,
					number_event,
					number_following,
					number_follower,
					time
					FROM
						vu_user
					WHERE
						$data[0]
						$data[1]
					ORDER BY
						name ASC,
						id DESC
					$data[2]
HTML;
			//exit($query);
			//$this->conn->fileQuery($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$arrayUsers = array();
			while($data = $this->conn->fetchObject($result)){
				$auxUser = new User($data->id);
				$auxUser->setUrlSufix($data->url_sufix);
				$auxUser->setName($data->name);
				$auxUser->setEmail($data->email);
				
				$auxUser->setImage(new Image());
				$auxUser->getImage()->setName($data->image);
				
				$auxUser->setStatus($data->status);
				$auxUser->setCpf($data->cpf);
				$auxUser->setPhone(new Phone($data->phone_code, $data->phone_number));
				$auxUser->setIdFacebook($data->id_facebook);
				$auxUser->setDescription($data->description);
				$auxUser->setNumberEvent($data->number_event);
				$auxUser->setNumberFollowing($data->number_following);
				$auxUser->setNumberFollower($data->number_follower);
				$auxUser->setTime($data->time);
				$arrayUsers[] = $auxUser;
			}
			$this->conn->free($result);
			return($arrayUsers);
		}
		
		
		public function getUserByPage($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getUrlSufix());
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_user
					WHERE
						url_sufix LIKE "$data[0]"
						AND
						status = 1
					LIMIT 1
HTML;
			//exit($query);
			//$this->conn->fileQuery($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$auxUser = NULL;
			while($data = $this->conn->fetchObject($result)){
				$auxUser = new User($data->id);
				break;
			}
			$this->conn->free($result);
			return($auxUser);
		}
		
		
		public function getBank($user){
			$data = array();
			$data[] = $user->getId();
			$query = <<<HTML
				SELECT
					type_account,
					bank,
					agency,
					number,
					digit,
					operation,
					document,
					status,
					time
					FROM
						vu_user_bank
					WHERE
						id_user = $data[0]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$bank = NULL;
			while($data = $this->conn->fetchObject($result)){
				$bank = new Bank();
				$bank->setBankTypeAccount(new BankTypeAccount($data->type_account));
				$bank->setBankBrand(new BankBrand($data->bank));
				$bank->setAgency($data->agency);
				$bank->setNumber($data->number);
				$bank->setDigit($data->digit);
				$bank->setOperation($data->operation);
				$bank->setStatus($data->status);
				$bank->setTime($data->time);
				
				$file = new File();
				$file->setName($data->document);
				$bank->setDocument($file);
				
				break;
			}
			$this->conn->free($result);
			return($bank);
		}
		
		
		public function verifyEmail($user){
			$data = array();
			$data[] = $user->getId() > 0 ? 'id != '.$user->getId().' AND ' : '';
			$data[] = $this->conn->cleanData($user->getEmail());
			$query = <<<HTML
				SELECT SQL_NO_CACHE 
					id
					FROM
						vu_user
					WHERE
						$data[0]
						email LIKE "$data[1]"
					LIMIT 1
HTML;
			//$this->conn->fileQuery($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->numRows($result);
			$this->conn->free($result);
			return($data);
		}
		
		
		public function setNumberEventCorrectly($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$query = <<<HTML
				UPDATE
					vu_user
					SET
						number_event = (number_event + 1)
					WHERE
						id = $data[0]
				LIMIT 1
HTML;
			//$this->conn->fileQuery($query); // (SELECT COUNT(*) number_event FROM vu_event WHERE id_user = $data[0])
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		// FOLLOW
			public function verifyUserAlreadyFollow($follow){
				$data = array();
				$data[] = $this->conn->cleanData($follow->getUserFollowing()->getId());
				$data[] = $this->conn->cleanData($follow->getUserFollower()->getId());
				$query = <<<HTML
					SELECT
						id
						FROM
							vu_user_follow
						WHERE
							id_user_following = $data[0]
							AND
							id_user_followed = $data[1]
						LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$data = $this->conn->numRows($result);
				$this->conn->free($result);
				return($data);
			}
			public function saveUserFollow($follow){
				$data = array();
				$data[] = $this->conn->cleanData($follow->getUserFollowing()->getId());
				$data[] = $this->conn->cleanData($follow->getUserFollower()->getId());
				$data[] = $follow->getTime();
				$query = <<<HTML
					INSERT INTO
						vu_user_follow(id_user_following,
										id_user_followed,
										time)
						VALUES($data[0],
								$data[1],
								$data[2])
HTML;
				//exit($query);
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function deleteUserFollow($follow){
				$data = array();
				$data[] = $this->conn->cleanData($follow->getUserFollowing()->getId());
				$data[] = $this->conn->cleanData($follow->getUserFollower()->getId());
				$query = <<<HTML
					DELETE FROM
						vu_user_follow
						WHERE
							id_user_following = $data[0]
							AND
							id_user_followed = $data[1]
						LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setNumberFollowingCorrectly($user){
				$data = array();
				$data[] = $this->conn->cleanData($user->getId());
				$query = <<<HTML
					UPDATE
						vu_user
						SET
							number_following = (SELECT COUNT(*) number_following FROM vu_user_follow WHERE id_user_following = $data[0])
						WHERE
							id = $data[0]
					LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setNumberFollowerCorrectly($user){
				$data = array();
				$data[] = $this->conn->cleanData($user->getId());
				$query = <<<HTML
					UPDATE
						vu_user
						SET
							number_follower = (SELECT COUNT(*) number_follower FROM vu_user_follow WHERE id_user_followed = $data[0])
						WHERE
							id = $data[0]
					LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function getFollows($follow){
				$data = array();
				if($follow->getIsFollowing()){
					$data[] = 'vuf.id_user_followed';
					$data[] = 'vuf.id_user_following = '.$this->conn->cleanData($follow->getUserFollowing()->getId());
				}
				else{
					$data[] = 'vuf.id_user_following';
					$data[] = 'vuf.id_user_followed = '.$this->conn->cleanData($follow->getUserFollower()->getId());
				}
				$data[] = $follow->getIsLoadMore() ? 'AND vuf.id < '.$this->conn->cleanData($follow->getId()) : '';
				$data[] = $follow->getLimit() > 0 ? 'LIMIT '.$this->conn->cleanData($follow->getLimit()) : '';
				$query = <<<HTML
					SELECT
						vuf.id,
						vuf.time,
						$data[0] id_user
						FROM
							vu_user_follow vuf
							INNER JOIN
							vu_user vu
								ON($data[0] = vu.id)
						WHERE
							$data[1]
							AND
							vu.status = 1
							$data[2]
						ORDER BY
							vuf.id DESC
						$data[3]
HTML;
				//exit($query);
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$arrayFollows = array();
				while($data = $this->conn->fetchObject($result)){
					$aux = new Follow($data->id);
					$aux->setTime($data->time);
					
					if($follow->getIsFollowing()){
						$aux->setUserFollower(new User($data->id_user));
					}
					else{
						$aux->setUserFollowing(new User($data->id_user));
					}
					
					$arrayFollows[] = $aux;
				}
				$this->conn->free($result);
				return($arrayFollows);
			}
			
		
		// ADDRESS
			public function saveAddress($user){
				$data = array();
				$data[] = $this->conn->cleanData($user->getId());
				$data[] = $this->conn->cleanDataOnlyForMysql($user->getAddress()->getCep());
				$data[] = $this->conn->cleanDataOnlyForMysql($user->getAddress()->getStreet());
				$data[] = $this->conn->cleanDataOnlyForMysql($user->getAddress()->getCity());
				$data[] = $this->conn->cleanData($user->getAddress()->getState()->getItem());
				$data[] = $this->conn->cleanData($user->getAddress()->getNumber());
				$query = <<<HTML
					INSERT INTO
						vu_user_address(id_user,
										cep,
										street,
										city,
										state,
										number)
						VALUES($data[0],
								"$data[1]",
								"$data[2]",
								"$data[3]",
								$data[4],
								"$data[5]")
						ON DUPLICATE KEY
							UPDATE
								cep = "$data[1]",
								street = "$data[2]",
								city = "$data[3]",
								state = $data[4],
								number = "$data[5]"
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function getAddress($user){
				$data = array();
				$data[] = $this->conn->cleanData($user->getId());
				$query = <<<HTML
					SELECT
						cep,
						street,
						city,
						state,
						number
						FROM
							vu_user_address
						WHERE
							id_user = $data[0]
						LIMIT 1
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$address = new Address();
				while($data = $this->conn->fetchObject($result)){
					$address->setCep($data->cep);
					$address->setStreet($data->street);
					$address->setCity($data->city);
					$address->setState(new State($data->state));
					$address->setNumber($data->number);
					break;
				}
				$this->conn->free($result);
				return($address);
			}
		
		
		// FORGOT PASSWORD
			public function saveForgotPassword($forgotPassword){
				$data = array();
				$data[] = $this->conn->cleanData($forgotPassword->getUser()->getId());
				$data[] = $forgotPassword->generateHash();
				$data[] = $forgotPassword->getTime();
				$query = <<<HTML
					INSERT INTO
						vu_forgot_password(id_user,
											hash,
											time)
						VALUES($data[0],
								"$data[1]",
								$data[2])
HTML;
				//exit($query);
				//$this->conn->fileQuery($query, 'a');
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function updateForgotPasswordStatus($forgotPassword){
				$data = array();
				$data[] = $this->conn->cleanData($forgotPassword->getId());
				$data[] = $this->conn->cleanData($forgotPassword->getStatus());
				$query = <<<HTML
					UPDATE
						vu_forgot_password
						SET
							status = $data[1]
						WHERE
							id = $data[0]
						LIMIT 1
HTML;
				//exit($query);
				//$this->conn->fileQuery($query, 'a');
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			
			
			public function getForgotPasswordIdByUser($forgotPassword){
				$data = array();
				$data[] = $this->conn->cleanData($forgotPassword->getUser()->getId());
				$query = <<<HTML
					SELECT
						id
						FROM
							vu_forgot_password
						WHERE
							id_user = $data[0]
						ORDER BY
							id DESC
						LIMIT 1
HTML;
				//exit($query);
				//$this->conn->fileQuery($query, 'a');
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$data = 0;
				while($data = $this->conn->fetchObject($result)){
					$data = $data->id;
					break;
				}
				$this->conn->free($result);
				return($data);
			}
			public function getForgotPasswordIdByHash($forgotPassword){
				$data = array();
				$data[] = $this->conn->cleanData($forgotPassword->getHash());
				$query = <<<HTML
					SELECT
						id
						FROM
							vu_forgot_password
						WHERE
							hash = "$data[0]"
						LIMIT 1
HTML;
				//exit($query);
				//$this->conn->fileQuery($query, 'a');
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$data = 0;
				while($data = $this->conn->fetchObject($result)){
					$data = $data->id;
					break;
				}
				$this->conn->free($result);
				return($data);
			}
			public function getForgotPassword($forgotPassword){
				$data = array();
				$data[] = $this->conn->cleanData($forgotPassword->getId());
				$query = <<<HTML
					SELECT
						id_user,
						hash,
						status,
						time
						FROM
							vu_forgot_password
						WHERE
							id = $data[0]
						LIMIT 1
HTML;
				//exit($query);
				//$this->conn->fileQuery($query, 'a');
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$auxForgotPassword = NULL;
				while($data = $this->conn->fetchObject($result)){
					$auxForgotPassword = new ForgotPassword($forgotPassword->getId());
					$auxForgotPassword->setUser(new User($data->id_user));
					$auxForgotPassword->setHash($data->hash);
					$auxForgotPassword->setStatus($data->status);
					$auxForgotPassword->setTime($data->time);
					break;
				}
				$this->conn->free($result);
				return($auxForgotPassword);
			}
			
			
			public function varifyValidForgotPassword($forgotPassword){
				$data = array();
				$data[] = $this->conn->cleanData($forgotPassword->getUser()->getId());
				$data[] = $this->conn->cleanData($forgotPassword->getHash());
				$query = <<<HTML
					SELECT
						id
						FROM
							vu_forgot_password
						WHERE
							id_user = $data[0]
							AND
							hash = "$data[1]"
							AND
							status = 1
						LIMIT 1
HTML;
				//exit($query);
				//$this->conn->fileQuery($query, 'a');
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$data = $this->conn->numRows($result);
				$this->conn->free($result);
				return($data);
			}
		
		
		/*public function getUserByIdFacebook($user, $wuthStatus=true){
			$data = array();
			$data[] = $this->conn->cleanData($user->getIdFacebook());
			$data[] = $wuthStatus ? 'AND status = 1' : '';
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_user
					WHERE
						id_facebook LIKE "$data[0]"
						AND
						id_facebook != "0"
						$data[1]
					LIMIT 1
HTML;
			//$this->conn->fileQuery($query, 'a');
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$auxUser = NULL;
			while($data = $this->conn->fetchObject($result)){
				$auxUser = new User($data->id);
			}
			$this->conn->free($result);
			return($auxUser);
		}
		
		
		public function verifyLogin($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $user->getPassword();
			$query = <<<HTML
				SELECT SQL_NO_CACHE 
					id
					FROM
						vu_user
					WHERE
						email LIKE "$data[0]"
						AND
						password = CONCAT( LEFT( password, 7 ), SHA1( CONCAT( LEFT( password, 7 ), "$data[1]" ) ) )
						AND
						status = 1
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->numRows($result);
			$this->conn->free($result);
			return($data);
		}
		public function verifyPassword($user){
			$data = array();
			$data[] = $user->getId();
			$data[] = $this->conn->cleanData($user->getCurrentPassword());
			$query = <<<HTML
				SELECT SQL_NO_CACHE 
					id
					FROM
						vu_user
					WHERE
						id = $data[0]
						AND
						password = CONCAT( LEFT( password, 7 ), SHA1( CONCAT( LEFT( password, 7 ), "$data[1]" ) ) )
					LIMIT 1
HTML;
			//$this->conn->fileQuery($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->numRows($result);
			$this->conn->free($result);
			return($data);
		}
		public function getIdByLogin($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $user->getPassword();
			
			$query = <<<HTML
				SELECT SQL_NO_CACHE 
					id
					FROM
						vu_user
					WHERE
						email LIKE "$data[0]"
						AND
						password = CONCAT( LEFT( password, 7 ), SHA1( CONCAT( LEFT( password, 7 ), "$data[1]" ) ) )
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->fetchObject($result);
			$this->conn->free($result);
			return($data->id);
		}
		
		
		// FOR USER AND WALKER
			public function getRemoveAccount($user){
				$data = array();
				$data[] = $this->conn->cleanData($user->getId());
				$query = <<<HTML
					SELECT
						id,
						reason_index,
						reason,
						time
						FROM
							vu_remove_account
						WHERE
							id = $data[0]
						LIMIT
							1
HTML;
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$removeAccount = new RemoveAccount();
				while($data = $this->conn->fetchObject($result)){
					$removeAccount->setId($data->id);
					$removeAccount->setRemoveAccountReason(new RemoveAccountReason($data->reason_index));
					$removeAccount->setReason($data->reason);
					$removeAccount->setTime($data->time);
				}
				return($removeAccount);
			}*/
	}
?>