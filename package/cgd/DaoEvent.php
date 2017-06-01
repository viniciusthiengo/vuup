<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/util/class/Database.php');
	
	class DaoEvent {
		private $conn;
		
		
		public function __construct(){
			$this->conn = new Database();
		}
		public function __destruct(){
			$this->conn->close();
		}
		
		
		public function save($event){
			$data = array();
			$data[] = $event->getUser()->getId();
			$data[] = $this->conn->cleanDataOnlyForMysql($event->getName());
			$data[] = $this->conn->cleanData($event->getStatusBankAccount());
			$data[] = $this->conn->cleanData($event->getUrlSufix());
			$data[] = $this->conn->cleanData($event->getStatus());
			$data[] = $this->conn->cleanData($event->getCategory()->getItem());
			$data[] = $this->conn->cleanData($event->getPhone()->getCode());
			$data[] = $this->conn->cleanData($event->getPhone()->getNumber());
			$data[] = $this->conn->cleanDataOnlyForMysql($event->getDescription());
			$data[] = $this->conn->cleanData($event->getTicketTypeCharge());
			$data[] = $this->conn->cleanData($event->getTicketEmailSend());
			$data[] = $this->conn->cleanData($event->getTicketParcels()->getItem());
			$data[] = $this->conn->cleanData($event->getTicketTypeTaxes());
			$data[] = $this->conn->cleanData($event->getShowUserConfirmed());
			$data[] = $this->conn->cleanData($event->getImgBanner()->getName());
			$data[] = $this->conn->cleanData($event->getImgBackground()->getName());
			$data[] = $this->conn->cleanData($event->getVideo()->getUrl());
			$data[] = $this->conn->cleanData($event->getTime());
			$query = <<<HTML
				INSERT INTO
					vu_event(id_user,
							name,
							status_bank_account,
							url_sufix,
							status,
							category,
							phone_code,
							phone_number,
							description,
							ticket_type,
							ticket_send_email,
							ticket_parcells,
							ticket_type_taxes,
							show_user_confirmed,
							banner_main,
							banner_background,
							video,
							time)
					VALUES($data[0],
							"$data[1]",
							$data[2],
							"$data[3]",
							$data[4],
							$data[5],
							"$data[6]",
							"$data[7]",
							"$data[8]",
							$data[9],
							$data[10],
							$data[11],
							$data[12],
							$data[13],
							"$data[14]",
							"$data[15]",
							"$data[16]",
							$data[17])
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		public function update($event){
			$data = array();
			$data[] = $event->getId();
			$data[] = $event->getUser()->getId();
			$data[] = $this->conn->cleanDataOnlyForMysql($event->getName());
			$data[] = $this->conn->cleanData($event->getStatusBankAccount());
			$data[] = $this->conn->cleanData($event->getUrlSufix());
			$data[] = $this->conn->cleanData($event->getStatus());
			$data[] = $this->conn->cleanData($event->getCategory()->getItem());
			$data[] = $this->conn->cleanData($event->getPhone()->getCode());
			$data[] = $this->conn->cleanData($event->getPhone()->getNumber());
			$data[] = $this->conn->cleanDataOnlyForMysql($event->getDescription());
			$data[] = $this->conn->cleanData($event->getTicketTypeCharge());
			$data[] = $this->conn->cleanData($event->getTicketEmailSend());
			$data[] = $this->conn->cleanData($event->getTicketParcels()->getItem());
			$data[] = $this->conn->cleanData($event->getTicketTypeTaxes());
			$data[] = $this->conn->cleanData($event->getShowUserConfirmed());
			$data[] = $this->conn->cleanData($event->getImgBanner()->getName());
			$data[] = $this->conn->cleanData($event->getImgBackground()->getName());
			$data[] = $this->conn->cleanData($event->getVideo()->getUrl());
			$data[] = $this->conn->cleanData($event->getTime());
			$query = <<<HTML
				UPDATE
					vu_event
					SET
						name = "$data[2]",
						status_bank_account = $data[3],
						url_sufix = "$data[4]",
						status = $data[5],
						category = $data[6],
						phone_code = "$data[7]",
						phone_number = "$data[8]",
						description = "$data[9]",
						ticket_type = $data[10],
						ticket_send_email = $data[11],
						ticket_parcells = $data[12],
						ticket_type_taxes = $data[13],
						show_user_confirmed = $data[14],
						banner_main = "$data[15]",
						banner_background = "$data[16]",
						video = "$data[17]",
						time_update = $data[18]
					WHERE
						id = $data[0]
						AND
						id_user = $data[1]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function getEventIdByTime($event){
			$data = array();
			$data[] = $this->conn->cleanData($event->getUser()->getId());
			$data[] = $this->conn->cleanData($event->getTime());
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_event
					WHERE
						id_user = $data[0]
						AND
						time = $data[1]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->fetchObject($result);
			$this->conn->free($result);
			return($data->id);
		}
		
		
		public function getOldImage($obj){
			$data = array();
			$data[] = $obj->getId();
			$query = <<<HTML
				SELECT
					banner_main
					FROM
						vu_event
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
		
		
		public function saveTicketDay($ticketDay){
			$data = array();
			$data[] = $this->conn->cleanData($ticketDay->getEvent()->getId());
			$data[] = $this->conn->cleanData($ticketDay->getDateSqlInt());
			$query = <<<HTML
				INSERT INTO
					vu_event_ticket_day(id_event,
										time_day)
					VALUES($data[0],
							$data[1])
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		public function updateTicketDay($ticketDay){
			$data = array();
			$data[] = $this->conn->cleanData($ticketDay->getId());
			$data[] = $this->conn->cleanData($ticketDay->getEvent()->getId());
			$data[] = $this->conn->cleanData($ticketDay->getDateSqlInt());
			$query = <<<HTML
				UPDATE
					vu_event_ticket_day
					SET
						time_day = $data[2]
					WHERE
						id = $data[0]
						AND
						id_event = $data[1]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function saveTicket($ticket){
			$data = array();
			$data[] = $this->conn->cleanData($ticket->getTicketDay()->getId());
			$data[] = $this->conn->cleanDataOnlyForMysql($ticket->getName());
			$data[] = $this->conn->cleanData($ticket->getQtdMax()->getItem());
			$data[] = $this->conn->cleanData($ticket->getQtdMaxSell());
			$data[] = $this->conn->cleanData($ticket->getTicketValidDays()->getItem());
			$data[] = $this->conn->cleanData($ticket->getPrice());
			$query = <<<HTML
				INSERT INTO
					vu_event_ticket(id_ticket_day,
									name,
									maximum,
									qtd_max_sell,
									valid_days,
									price)
					VALUES($data[0],
							"$data[1]",
							$data[2],
							$data[3],
							$data[4],
							$data[5])
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		public function updateTicket($ticket){
			$data = array();
			$data[] = $this->conn->cleanData($ticket->getId());
			$data[] = $this->conn->cleanData($ticket->getTicketDay()->getId());
			$data[] = $this->conn->cleanDataOnlyForMysql($ticket->getName());
			$data[] = $this->conn->cleanData($ticket->getQtdMax()->getItem());
			$data[] = $this->conn->cleanData($ticket->getQtdMaxSell());
			$data[] = $this->conn->cleanData($ticket->getTicketValidDays()->getItem());
			$data[] = $this->conn->cleanData($ticket->getPrice());
			$data[] = $this->conn->cleanData($ticket->getStatus());
			$query = <<<HTML
				UPDATE
					vu_event_ticket
					SET
						name = "$data[2]",
						maximum = $data[3],
						qtd_max_sell = $data[4],
						valid_days = $data[5],
						price = $data[6],
						status = $data[7]
					WHERE
						id = $data[0]
						AND
						id_ticket_day = $data[1]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function saveAddress($event){
			$data = array();
			$data[] = $this->conn->cleanData($event->getId());
			$data[] = $this->conn->cleanDataOnlyForMysql($event->getAddress()->getStreet());
			$data[] = $this->conn->cleanDataOnlyForMysql($event->getAddress()->getNeighborhood());
			$data[] = $this->conn->cleanDataOnlyForMysql($event->getAddress()->getCity());
			$data[] = $this->conn->cleanData($event->getAddress()->getState()->getItem());
			$data[] = $this->conn->cleanData($event->getAddress()->getNumber());
			$data[] = $this->conn->cleanData($event->getAddress()->getMap()->getLatitude());
			$data[] = $this->conn->cleanData($event->getAddress()->getMap()->getLongitude());
			$query = <<<HTML
				INSERT INTO
					vu_event_address(id_event,
									street,
									neighborhood,
									city,
									state,
									number,
									latitude,
									longitude)
					VALUES($data[0],
							"$data[1]",
							"$data[2]",
							"$data[3]",
							$data[4],
							"$data[5]",
							"$data[6]",
							"$data[7]")
					ON DUPLICATE KEY
						UPDATE
							street = "$data[1]",
							neighborhood = "$data[2]",
							city = "$data[3]",
							state = $data[4],
							number = "$data[5]",
							latitude = "$data[6]",
							longitude = "$data[7]"
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function saveTag($tag){
			$data = array();
			$data[] = $this->conn->cleanData($tag->getEvent()->getId());
			$data[] = $this->conn->cleanDataOnlyForMysql($tag->getName());
			$query = <<<HTML
				INSERT INTO
					vu_event_tag(id_event,
								tag)
					VALUES($data[0],
							"$data[1]")
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		public function removeTags($event){
			$data = array();
			$data[] = $this->conn->cleanData($event->getId());
			$query = <<<HTML
				DELETE FROM
					vu_event_tag
					WHERE
						id_event = $data[0]
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function savePhoto($photo, $event){
			$data = array();
			$data[] = $this->conn->cleanData($event->getId());
			$data[] = $this->conn->cleanData($photo->getName());
			$query = <<<HTML
				INSERT INTO
					vu_event_photo(id_event,
									photo)
					VALUES($data[0],
							"$data[1]")
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		public function deletePhoto($photo, $event){
			$data = array();
			$data[] = $this->conn->cleanData($event->getId());
			$data[] = $this->conn->cleanData($photo->getName());
			$query = <<<HTML
				DELETE FROM
					vu_event_photo
					WHERE
						id_event = $data[0]
						AND
						photo LIKE "$data[1]"
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		
		
		public function getWhereClause($search){
			$data = '';
			if(strlen(trim($search->getText())) > 0){
				$data .= ' AND ve.name LIKE "'.$this->conn->cleanData($search->getText()).'%"';
			}
			if(is_object($search->getEventCategory()) && $search->getEventCategory()->getItem() > 0){
				$data .= ' AND ve.category = '.$this->conn->cleanData($search->getEventCategory()->getItem());
			}
			if(is_object($search->getState()) && $search->getState()->getItem() > 0){
				$data .= ' AND vea.state = '.$this->conn->cleanData($search->getState()->getItem());
			}
			if(strlen(trim($search->getCity())) > 0){
				$data .= ' AND vea.city LIKE "'.$this->conn->cleanData($search->getCity()).'"';
			}
			if($search->getStartDate() > 0){
				$data .= ' AND vetd.time_day >= '.$this->conn->cleanData($search->getStartDate());
			}
			if($search->getEndDate() > 0){
				$data .= ' AND vetd.time_day <= '.$this->conn->cleanData($search->getEndDate());
			}
			if($search->getOnlyPayment() == 1 && $search->getOnlyFree() == 0){
				$data .= ' AND ve.ticket_type = 2';
			}
			if($search->getOnlyPayment() == 0 && $search->getOnlyFree() == 1){
				$data .= ' AND ve.ticket_type = 1';
			}
			//	exit($data);
			return($data);
		}
		
		
		public function getEvents($event, $userSession=NULL){
			$time = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$data = array();
			if(is_object($event) && is_object($event->getSearch())){ // SEARCH EVENTS
				$data[] = !$event->getIsLoadMore() ? '' : 've.id NOT IN('.$this->conn->cleanData($event->getId()).') AND';
				$data[] = $event->getIsAll() ? '' : 've.status = 1 AND ve.status_bank_account = 1';
				$data[] = $this->getWhereClause($event->getSearch());
				$data[] = substr_count($this->getWhereClause($event->getSearch()), 'time_day') > 0 ? '' : 'AND vetd.time_day >= '.$time;
				$data[] = substr_count($this->getWhereClause($event->getSearch()), 'time_day') > 0 ? '' : 'AND vetd.time_day <= '.$time;
			}
			else if(is_object($event) && $event->getId() > 0 && !$event->getIsLoadMore()){ // UNIQUE EVENT
				$data[] = 've.id = '.$this->conn->cleanData($event->getId());
				$data[] = $event->getIsAll() ? '' : 'AND ((ve.status = 1 AND ve.status_bank_account = 1) '.(is_object($userSession) ? 'OR ve.id_user = '.$this->conn->cleanData($userSession->getId()) : '').')';
				$data[] = $event->getIsAll() && is_object($event->getUser()) ? 'AND ve.id_user = '.$this->conn->cleanData($event->getUser()->getId()) : '';
				$data[] = 'AND vetd.time_day >= '.$time;
				$data[] = 'AND vetd.time_day <= '.$time;
			}
			else if(is_object($event) && $event->getIsLoadMore()){ // LOAD MORE EVENTS
				$data[] = 've.id NOT IN('.$this->conn->cleanData($event->getId()).')';
				$data[] = $event->getIsAll() ? '' : 'AND ve.status = 1 AND ve.status_bank_account = 1';
				$data[] = is_object($event->getUser()) ? 'AND ve.id_user = '.$this->conn->cleanData($event->getUser()->getId()) : '';
				$data[] = 'AND vetd.time_day >= '.$time;
				$data[] = 'AND vetd.time_day <= '.$time;
			}
			else { // EVENTS (WITHOUT BE LOAD MORE)
				$data[] = 've.id = ve.id';
				$data[] = $event->getIsAll() ? '' : 'AND ve.status = 1 AND ve.status_bank_account = 1';
				$data[] = is_object($event->getUser()) ? 'AND ve.id_user = '.$this->conn->cleanData($event->getUser()->getId()) : '';
				$data[] = 'AND vetd.time_day >= '.$time;
				$data[] = 'AND vetd.time_day <= '.$time;
			}
			$data[] = $event->getLimit() > 0 ? 'LIMIT '.$event->getLimit() : '';
			$query = <<<HTML
				SELECT DISTINCT
					*
					FROM
					((SELECT DISTINCT
						ve.id,
						ve.id_user,
						ve.name,
						ve.status_bank_account,
						ve.url_sufix,
						ve.status,
						ve.category,
						ve.phone_code,
						ve.phone_number,
						ve.description,
						ve.ticket_type,
						ve.ticket_send_email,
						ve.ticket_parcells,
						ve.ticket_type_taxes,
						ve.show_user_confirmed,
						ve.banner_main,
						ve.banner_background,
						ve.video,
						ve.time,
						ve.number_ticket_sold,
						ve.number_comment,
						ve.number_view,
						ve.number_favorite,
						ve.amount_inside
						FROM
							vu_event ve
							INNER JOIN
							vu_event_address vea
								ON(ve.id = vea.id_event)
							INNER JOIN
							vu_event_ticket_day vetd
								ON(vea.id_event = vetd.id_event)
						WHERE
							$data[0]
							$data[1]
							$data[2]
							$data[3]
						ORDER BY
							vetd.time_day ASC
						$data[5])
					UNION ALL
					(SELECT DISTINCT
						ve.id,
						ve.id_user,
						ve.name,
						ve.status_bank_account,
						ve.url_sufix,
						ve.status,
						ve.category,
						ve.phone_code,
						ve.phone_number,
						ve.description,
						ve.ticket_type,
						ve.ticket_send_email,
						ve.ticket_parcells,
						ve.ticket_type_taxes,
						ve.show_user_confirmed,
						ve.banner_main,
						ve.banner_background,
						ve.video,
						ve.time,
						ve.number_ticket_sold,
						ve.number_comment,
						ve.number_view,
						ve.number_favorite,
						ve.amount_inside
						FROM
							vu_event ve
							INNER JOIN
							vu_event_address vea
								ON(ve.id = vea.id_event)
							INNER JOIN
							vu_event_ticket_day vetd
								ON(vea.id_event = vetd.id_event)
						WHERE
							$data[0]
							$data[1]
							$data[2]
							$data[4]
						ORDER BY
							vetd.time_day DESC
						$data[5])) aux
					$data[5]
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$arrayEvents = array();
			while($data = $this->conn->fetchObject($result)){
				$imgBanner = new Image();
				$imgBanner->setName($data->banner_main);
				
				$imgBackground = new Image();
				$imgBackground->setName($data->banner_background);
				
				$auxEvent = new Event($data->id);
				$auxEvent->setUser(new User($data->id_user));
				$auxEvent->setName($data->name);
				$auxEvent->setStatusBankAccount($data->status_bank_account);
				$auxEvent->setUrlSufix($data->url_sufix);
				$auxEvent->setStatus($data->status);
				$auxEvent->setCategory(new EventCategory($data->category));
				$auxEvent->setPhone(new Phone($data->phone_code, $data->phone_number));
				$auxEvent->setDescription($data->description);
				$auxEvent->setTicketTypeCharge($data->ticket_type);
				$auxEvent->setTicketEmailSend($data->ticket_send_email);
				$auxEvent->setTicketParcels(new TicketParcel($data->ticket_parcells));
				$auxEvent->setTicketTypeTaxes($data->ticket_type_taxes);
				$auxEvent->setShowUserConfirmed($data->show_user_confirmed);
				$auxEvent->setImgBanner($imgBanner);
				$auxEvent->setImgBackground($imgBackground);
				$auxEvent->setVideo(new Video($data->video));
				$auxEvent->setTime($data->time);
				$auxEvent->setNumberTicketSold($data->number_ticket_sold);
				$auxEvent->setNumberComment($data->number_comment);
				$auxEvent->setNumberView($data->number_view);
				$auxEvent->setNumberFavorite($data->number_favorite);
				$auxEvent->setAmountInside($data->amount_inside);
				
				$arrayEvents[] = $auxEvent;
			}
			$this->conn->free($result);
			return($arrayEvents);
		}
		
		
		public function getEventsFavorite($favorite){
			$time = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$data = array();
			$data[] = $this->conn->cleanData($favorite->getUser()->getId());
			if($favorite->getEvent()->getIsLoadMore()){ // LOAD MORE FAVORITE EVENTS
				$data[] = 'AND vef.id_event NOT IN('.$this->conn->cleanData($favorite->getEvent()->getId()).')';
			}
			else { // FAVORITE EVENTS (WITHOUT BE LOAD MORE)
				$data[] = '';
			}
			$data[] = time();
			$data[] = $favorite->getEvent()->getLimit() > 0 ? 'LIMIT '.$favorite->getEvent()->getLimit() : '';
			$query = <<<HTML
				SELECT DISTINCT
					*
					FROM
					((SELECT DISTINCT
						ve.id
						FROM
							vu_event ve
							INNER JOIN
							vu_event_ticket_day vetd
								ON(ve.id = vetd.id_event)
							INNER JOIN
							vu_event_favorite vef
								ON(vetd.id_event = vef.id_event)
						WHERE
							vef.id_user = $data[0]
							$data[1]
							AND
							ve.status = 1
							AND
							ve.status_bank_account = 1
							AND
							vetd.time_day >= $data[2]
						ORDER BY
							vetd.time_day ASC
						$data[3])
					UNION ALL
					(SELECT DISTINCT
						ve.id
						FROM
							vu_event ve
							INNER JOIN
							vu_event_ticket_day vetd
								ON(ve.id = vetd.id_event)
							INNER JOIN
							vu_event_favorite vef
								ON(vetd.id_event = vef.id_event)
						WHERE
							vef.id_user = $data[0]
							$data[1]
							AND
							ve.status = 1
							AND
							ve.status_bank_account = 1
							AND
							vetd.time_day < $data[2]
						ORDER BY
							vetd.time_day DESC
						$data[3])) aux
					$data[3]
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$arrayEvents = array();
			while($data = $this->conn->fetchObject($result)){
				$arrayEvents[] = new Event($data->id);
			}
			$this->conn->free($result);
			return($arrayEvents);
		}
		
		
		public function getEventByPage($event, $userSession=NULL){
			$data = array();
			$data[] = $this->conn->cleanData($event->getUser()->getId());
			$data[] = $this->conn->cleanData($event->getUrlSufix());
			$data[] = $this->conn->cleanData($event->getTime());
			$data[] = $this->conn->cleanData($userSession->getId());
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_event
					WHERE
						id_user = $data[0]
						AND
						url_sufix LIKE "$data[1]"
						AND
						time = $data[2]
						AND
						(
							(
								status = 1
								AND
								status_bank_account = 1
							)
							OR
							id_user = $data[3]
						)
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$auxEvent = NULL;
			while($data = $this->conn->fetchObject($result)){
				$auxEvent = new Event($data->id);
				break;
			}
			$this->conn->free($result);
			return($auxEvent);
		}
		
		
		public function getAddress($event){
			$data = array();
			$data[] = $this->conn->cleanData($event->getId());
			$query = <<<HTML
				SELECT
					id_event,
					street,
					neighborhood,
					city,
					state,
					number,
					latitude,
					longitude
					FROM
						vu_event_address
					WHERE
						id_event = $data[0]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$address = NULL;
			while($data = $this->conn->fetchObject($result)){
				$address = new Address();
				$address->setStreet($data->street);
				$address->setNeighborhood($data->neighborhood);
				$address->setCity($data->city);
				$address->setState(new State($data->state));
				$address->setNumber($data->number);
				$address->setMap(new Map($data->latitude, $data->longitude));
				break;
			}
			$this->conn->free($result);
			return($address);
		}
		
		
		public function getPhotos($event){
			$data = array();
			$data[] = $this->conn->cleanData($event->getId());
			$query = <<<HTML
				SELECT
					id,
					id_event,
					photo
					FROM
						vu_event_photo
					WHERE
						id_event = $data[0]
					ORDER BY
						id ASC
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$arrayPhotos = array();
			while($data = $this->conn->fetchObject($result)){
				$photo = new Image($data->id);
				$photo->setName($data->photo);
				$arrayPhotos[] = $photo;
			}
			$this->conn->free($result);
			return($arrayPhotos);
		}
		
		
		public function getTags($event){
			$data = array();
			$data[] = $this->conn->cleanData($event->getId());
			$query = <<<HTML
				SELECT
					id,
					id_event,
					tag
					FROM
						vu_event_tag
					WHERE
						id_event = $data[0]
					ORDER BY
						id ASC
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$arrayTags = array();
			while($data = $this->conn->fetchObject($result)){
				$tag = new Tag($data->id);
				$tag->setName($data->tag);
				$arrayTags[] = $tag;
			}
			$this->conn->free($result);
			return($arrayTags);
		}
		
		
		public function getTicketsDay($obj){
			$data = array();
			if(strcasecmp(get_class($obj), 'Event') == 0){
				$data[] = 'id_event = '.$this->conn->cleanData($obj->getId());
			}
			else if(strcasecmp(get_class($obj), 'TicketDay') == 0){
				$data[] = 'id = '.$this->conn->cleanData($obj->getId());
			}
			$query = <<<HTML
				SELECT
					id,
					id_event,
					time_day
					FROM
						vu_event_ticket_day
					WHERE
						$data[0]
					ORDER BY
						id ASC
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$arrayTicketsDay = array();
			while($data = $this->conn->fetchObject($result)){
				$auxTicketsDay = new TicketDay($data->id);
				$auxTicketsDay->setDay($data->time_day);
				$auxTicketsDay->setHour(new Hour((int)date('H', $data->time_day)));
				$auxTicketsDay->setMinute(new Minute(((int)date('i', $data->time_day)) / 15));
				
				$arrayTicketsDay[] = $auxTicketsDay;
			}
			$this->conn->free($result);
			return($arrayTicketsDay);
		}
		
		
		public function getTicketDayId($ticketDay){
			$data = array();
			$data[] = $this->conn->cleanData($ticketDay->getEvent()->getId());
			$data[] = $this->conn->cleanData($ticketDay->getDateSqlInt());
			$query = <<<HTML
				SELECT
					id
					FROM
						vu_event_ticket_day
					WHERE
						id_event = $data[0]
						AND
						time_day = $data[1]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$data = $this->conn->fetchObject($result);
			$this->conn->free($result);
			return($data->id);
		}
		
		
		public function getTickets($obj){
			$data = array();
			if(strcasecmp(get_class($obj), 'TicketDay') == 0){
				$data[] = 'id_ticket_day = '.$this->conn->cleanData($obj->getId());
			}
			else if(strcasecmp(get_class($obj), 'Ticket') == 0){
				$data[] = 'id = '.$this->conn->cleanData($obj->getId());
			}
			$query = <<<HTML
				SELECT
					id,
					id_ticket_day,
					name,
					maximum,
					qtd_max_sell,
					valid_days,
					price,
					number_ticket_sold,
					status
					FROM
						vu_event_ticket
					WHERE
						$data[0]
					ORDER BY
						id ASC
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$arrayTickets = array();
			while($data = $this->conn->fetchObject($result)){
				$ticket = new Ticket();
				$ticket->setId($data->id);
				$ticket->setName($data->name);
				$ticket->setStatus($data->status);
				$ticket->setQtdMaxSell($data->qtd_max_sell);
				$ticket->setTicketValidDays(new TicketValidDays($data->valid_days));
				$ticket->setPrice($data->price);
				$ticket->setNumberTicketSold($data->number_ticket_sold);
				$ticket->setQtdMax(new TicketQtdMax($data->maximum));
				
				$arrayTickets[] = $ticket;
			}
			$this->conn->free($result);
			return($arrayTickets);
		}
		
		
		public function getTicketPaymentValidDays($ticket){
			$data = array();
			$data[] = $this->conn->cleanData($ticket->getIdTicketPayment());
			$query = <<<HTML
				SELECT
					valid_days
					FROM
						vu_payment_ticket
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			//exit($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$ticketValidDays = new TicketValidDays();
			while($data = $this->conn->fetchObject($result)){
				$ticketValidDays->setItem($data->valid_days);
				break;
			}
			$this->conn->free($result);
			return($ticketValidDays);
		}
		
		
		// NUMBER VIEW
			public function verifyUserAlreadyVisit($event, $user){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$data[] = $this->conn->cleanData($user->getId());
				$data[] = $this->conn->cleanData($user->getIp());
				$data[] = time();
				$query = <<<HTML
					SELECT
						id
						FROM
							vu_event_view
						WHERE
							id_event = $data[0]
							AND
							(
								(
									id_user = $data[1]
									AND
									id_user > 0
								)
								OR
								ip = $data[2]
							)
						LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$data = $this->conn->numRows($result);
				$this->conn->free($result);
				return($data);
			}
			public function saveEventUserView($event, $user){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$data[] = $this->conn->cleanData($user->getId());
				$data[] = $this->conn->cleanData($user->getIp());
				$data[] = time();
				$query = <<<HTML
					INSERT INTO
						vu_event_view(id_event,
										id_user,
										ip,
										time)
						VALUES($data[0],
								$data[1],
								$data[2],
								$data[3])
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setNumberViewCorrectly($event){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$query = <<<HTML
					UPDATE
						vu_event
						SET
							number_view = (SELECT
											COUNT(*) number_view
											FROM
												vu_event_view
											WHERE
												id_event = $data[0])
						WHERE
							id = $data[0]
					LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setAmountInsideCorrectly($event){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$query = <<<HTML
					UPDATE
						vu_event
						SET
							amount_inside = (SELECT
												SUM(vpt.valid_days_used) amount_inside
												FROM
													vu_payment vp
													INNER JOIN
													vu_payment_ticket_day vptd
														ON(vp.id = vptd.id_payment)
													INNER JOIN
													vu_payment_ticket vpt
														ON(vptd.id = vpt.id_payment_ticket_day)
												WHERE
													vp.id_event = $data[0]
													AND
													vp.status = 1)
						WHERE
							id = $data[0]
					LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			
			
			public function isEventActivate($event){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$data[] = time() - __TIME_EXTRA_EVENT__;
				$query = <<<HTML
					SELECT
						ve.id
						FROM
							vu_event ve
							INNER JOIN
							vu_event_ticket_day vetd
								ON(ve.id = vetd.id_event)
							INNER JOIN
							vu_event_ticket vet
								ON(vetd.id = vet.id_ticket_day)
						WHERE
							ve.id = $data[0]
							AND
							ve.status = 1
							AND
							vetd.time_day >= $data[1]
							AND
							vet.status = 1
					LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$data = $this->conn->numRows($result) > 0 ? true : false;
				$this->conn->free($result);
				return($data);
			}
			
		
		// FAVORITE
			public function verifyUserAlreadyFavorite($favorite){
				$data = array();
				$data[] = $this->conn->cleanData($favorite->getEvent()->getId());
				$data[] = $this->conn->cleanData($favorite->getUser()->getId());
				$query = <<<HTML
					SELECT
						id
						FROM
							vu_event_favorite
						WHERE
							id_event = $data[0]
							AND
							id_user = $data[1]
						LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$data = $this->conn->numRows($result);
				$this->conn->free($result);
				return($data);
			}
			public function saveFavorite($favorite){
				$data = array();
				$data[] = $this->conn->cleanData($favorite->getEvent()->getId());
				$data[] = $this->conn->cleanData($favorite->getUser()->getId());
				$data[] = $favorite->getTime();
				$query = <<<HTML
					INSERT INTO
						vu_event_favorite(id_event,
											id_user,
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
			public function deleteFavorite($favorite){
				$data = array();
				$data[] = $this->conn->cleanData($favorite->getEvent()->getId());
				$data[] = $this->conn->cleanData($favorite->getUser()->getId());
				$query = <<<HTML
					DELETE FROM
						vu_event_favorite
						WHERE
							id_event = $data[0]
							AND
							id_user = $data[1]
						LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setNumberFavoriteCorrectly($event){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$query = <<<HTML
					UPDATE
						vu_event
						SET
							number_favorite = (SELECT COUNT(*) number_favorite FROM vu_event_favorite WHERE id_event = $data[0])
						WHERE
							id = $data[0]
					LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			
		
		// REPORT DATA / TICKET
			public function saveReportData($reportData){
				$data = array();
				$data[] = $this->conn->cleanData($reportData->getEvent()->getId());
				$data[] = $this->conn->cleanData($reportData->getType());
				$data[] = $this->conn->cleanData($reportData->getTime());
				$query = <<<HTML
					INSERT INTO
						vu_event_report_data(id_event,
											type,
											time)
						VALUES($data[0],
								$data[1],
								$data[2])
						ON DUPLICATE KEY
							UPDATE
								amount = (amount + 1)
HTML;
				//exit($query);
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function getReportData($reportData){
				$data = array();
				$data[] = $this->conn->cleanData($reportData->getEvent()->getId());
				$data[] = $this->conn->cleanData($reportData->getInitMonthTime());
				$data[] = $this->conn->cleanData($reportData->getFinishMonthTime());
				$query = <<<HTML
					SELECT
						type,
						time,
						amount
						FROM
							vu_event_report_data
						WHERE
							id_event = $data[0]
							AND
							time BETWEEN $data[1] AND $data[2]
						GROUP BY
							type,
							time
						ORDER BY
							time ASC
HTML;
				//exit($query);
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$arrayReportData = array();
				while($data = $this->conn->fetchObject($result)){
					$auxReportData = new ReportData();
					$auxReportData->setType($data->type);
					$auxReportData->setTime($data->time);
					$auxReportData->setAmount($data->amount);
					$arrayReportData[] = $auxReportData;
				}
				$this->conn->free($result);
				return($arrayReportData);
			}
			
			
			public function saveReportTicket($reportData){
				$data = array();
				$data[] = $this->conn->cleanData($reportData->getEvent()->getId());
				$data[] = $this->conn->cleanData($reportData->getTicketDay()->getId());
				$data[] = $this->conn->cleanData($reportData->getTicket()->getId());
				$data[] = $this->conn->cleanData($reportData->getTime());
				$query = <<<HTML
					INSERT INTO
						vu_event_report_ticket(id_event,
												id_ticket_day,
												id_ticket,
												time)
						VALUES($data[0],
								$data[1],
								$data[2],
								$data[3])
						ON DUPLICATE KEY
							UPDATE
								amount = (amount + 1)
HTML;
				//exit($query);
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function getReportTicket($reportData){
				$data = array();
				$data[] = $this->conn->cleanData($reportData->getEvent()->getId());
				$data[] = $this->conn->cleanData($reportData->getInitMonthTime());
				$data[] = $this->conn->cleanData($reportData->getFinishMonthTime());
				$query = <<<HTML
					SELECT
						time,
						id_ticket_day,
						id_ticket,
						SUM(amount) amount
						FROM
							vu_event_report_ticket
						WHERE
							id_event = $data[0]
							AND
							time BETWEEN $data[1] AND $data[2]
						GROUP BY
							time,
							id_ticket_day,
							id_ticket
						ORDER BY
							id_ticket_day ASC,
							id_ticket ASC,
							time ASC
HTML;
				//exit($query);
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$arrayReportData = array();
				while($data = $this->conn->fetchObject($result)){
					$auxReportData = new ReportData();
					$auxReportData->setTicketDay(new TicketDay($data->id_ticket_day));
					$auxReportData->setTicket(new Ticket($data->id_ticket));
					$auxReportData->setTime($data->time);
					$auxReportData->setAmount($data->amount);
					$arrayReportData[] = $auxReportData;
				}
				$this->conn->free($result);
				return($arrayReportData);
			}
			
			
		// PAYMENT
			public function savePayment($payment){
				$data = array();
				$data[] = $this->conn->cleanData($payment->getUser()->getId());
				$data[] = $this->conn->cleanData($payment->getEvent()->getId());
				$data[] = $this->conn->cleanData($payment->getFullPrice());
				$data[] = $this->conn->cleanData($payment->getFullPriceToPayEventParcel(false, true));
				$data[] = $this->conn->cleanData($payment->getEvent()->getTicketTypeCharge());
				$data[] = $this->conn->cleanData($payment->getEvent()->getTicketTypeTaxes());
				$data[] = $this->conn->cleanData($payment->getParcels()->getItem());
				$data[] = $this->conn->cleanData($payment->getToken());
				$data[] = $payment->getStatus();
				$data[] = $payment->getTime();
				$query = <<<HTML
					INSERT INTO
						vu_payment(id_user,
									id_event,
									full_price,
									price_to_pay,
									ticket_type_charge,
									ticket_type_taxes,
									parcels,
									token,
									status,
									time)
						VALUES($data[0],
								$data[1],
								$data[2],
								$data[3],
								$data[4],
								$data[5],
								$data[6],
								"$data[7]",
								$data[8],
								$data[9])
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function getPaymentId($payment){
				$data = array();
				$data[] = $this->conn->cleanData($payment->getUser()->getId());
				$data[] = $this->conn->cleanData($payment->getEvent()->getId());
				$data[] = $payment->getTime();
				$query = <<<HTML
					SELECT
						id
						FROM
							vu_payment
						WHERE
							id_user = $data[0]
							AND
							id_event = $data[1]
							AND
							time = $data[2]
						LIMIT 1
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				while($data = $this->conn->fetchObject($result)){
					$data = $data->id;
					break;
				}
				$this->conn->free($result);
				return($data);
			}
			public function savePaymentTicketDay($ticketDay){
				$data = array();
				$data[] = $this->conn->cleanData($ticketDay->getPayment()->getId());
				$data[] = $this->conn->cleanData($ticketDay->getId());
				$query = <<<HTML
					INSERT INTO
						vu_payment_ticket_day(id_payment,
												id_ticket_day)
						VALUES($data[0],
								$data[1])
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function getPaymentTicketDayId($ticketDay){
				$data = array();
				$data[] = $this->conn->cleanData($ticketDay->getPayment()->getId());
				$data[] = $this->conn->cleanData($ticketDay->getId());
				$query = <<<HTML
					SELECT
						id
						FROM
							vu_payment_ticket_day
						WHERE
							id_payment = $data[0]
							AND
							id_ticket_day = $data[1]
						LIMIT 1
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				while($data = $this->conn->fetchObject($result)){
					$data = $data->id;
					break;
				}
				$this->conn->free($result);
				return($data);
			}
			public function savePaymentTicket($ticket){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getTicketDay()->getIdTicketDayPayment());
				$data[] = $this->conn->cleanData($ticket->getId());
				$data[] = $this->conn->cleanData($ticket->generateCode());
				$data[] = $this->conn->cleanData($ticket->getPrice());
				$data[] = $this->conn->cleanData($ticket->getTicketValidDays()->getItem());
				$query = <<<HTML
					INSERT INTO
						vu_payment_ticket(id_payment_ticket_day,
											id_ticket,
											code,
											price,
											valid_days)
						VALUES($data[0],
								$data[1],
								"$data[2]",
								$data[3],
								$data[4])
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setPaymentStatus($payment){
				$data = array();
				$data[] = $this->conn->cleanData($payment->getId());
				$data[] = $this->conn->cleanData($payment->getStatus());
				$query = <<<HTML
					UPDATE
						vu_payment
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
			public function savePaymentIugu($paymentIugu){
				$data = array();
				$data[] = $this->conn->cleanData($paymentIugu->getPayment()->getId());
				$data[] = $this->conn->cleanData($paymentIugu->getSuccess());
				$data[] = $this->conn->cleanData($paymentIugu->getMessage());
				$data[] = $this->conn->cleanData($paymentIugu->getInvoiceId());
				$data[] = $this->conn->cleanData($paymentIugu->getUrl());
				$data[] = $this->conn->cleanData($paymentIugu->getPdf());
				$data[] = $this->conn->cleanData($paymentIugu->getToken());
				$query = <<<HTML
					INSERT INTO
						vu_payment_iugu(id_payment,
										success,
										message,
										invoice_id,
										url,
										pdf,
										token)
						VALUES($data[0],
								$data[1],
								"$data[2]",
								"$data[3]",
								"$data[4]",
								"$data[5]",
								"$data[6]")
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setNumberTicketSoldCorrectly($event){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$query = <<<HTML
					UPDATE
						vu_event
						SET
							number_ticket_sold = (SELECT
								COUNT(*) number_ticket_sold
								FROM
									vu_payment vp
									INNER JOIN
									vu_payment_ticket_day vptd
										ON(vp.id = vptd.id_payment)
									INNER JOIN
									vu_payment_ticket vpt
										ON(vptd.id = vpt.id_payment_ticket_day)
								WHERE
									vp.id_event = $data[0]
									AND
									vp.status = 1)
						WHERE
							id = $data[0]
					LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setTicketNumberTicketSoldCorrectly($ticket){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getId());
				$data[] = $this->conn->cleanData($ticket->getQtdMax()->getItem());
				$query = <<<HTML
					UPDATE
						vu_event_ticket
						SET
							number_ticket_sold = (SELECT
								COUNT(*) number_ticket_sold
								FROM
									vu_payment vp
									INNER JOIN
									vu_payment_ticket_day vptd
										ON(vp.id = vptd.id_payment)
									INNER JOIN
									vu_payment_ticket vpt
										ON(vptd.id = vpt.id_payment_ticket_day)
								WHERE
									vpt.id_ticket = $data[0]
									AND
									vp.status = 1)
						WHERE
							id = $data[0]
					LIMIT 1
HTML;
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			
			
			public function getUserBoughtTicket($ticket){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getEvent()->getId());
				$data[] = $this->conn->cleanData($ticket->getIdTicketPayment());
				$query = <<<HTML
					SELECT
						vp.id_user,
						vpt.id_user_repass
						FROM
							vu_payment vp
							INNER JOIN
							vu_payment_ticket_day vptd
								ON(vp.id = vptd.id_payment)
							INNER JOIN
							vu_payment_ticket vpt
								ON(vptd.id = vpt.id_payment_ticket_day)
						WHERE
							vp.id_event = $data[0]
							AND
							vpt.id = $data[1]
							AND
							vp.status = 1
						LIMIT 1
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$auxUser = new User();
				while($data = $this->conn->fetchObject($result)){
					$auxUser->setId($data->id_user_repass > 0 ? $data->id_user_repass : $data->id_user);
					break;
				}
				$this->conn->free($result);
				return($auxUser);
			}
			
			
			public function confirmUserInEvent($ticket){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getUser()->getId());
				$data[] = $this->conn->cleanData($ticket->getEvent()->getId());
				$data[] = $this->conn->cleanData($ticket->getIdTicketPayment());
				$query = <<<HTML
					UPDATE
						vu_event ve
						INNER JOIN
						vu_payment vp
							ON(ve.id = vp.id_event)
						INNER JOIN
						vu_user vu
							ON(vp.id_user = vu.id)
						INNER JOIN
						vu_payment_ticket_day vptd
							ON(vp.id = vptd.id_payment)
						INNER JOIN
						vu_payment_ticket vpt
							ON(vptd.id = vpt.id_payment_ticket_day)
						SET
							vpt.valid_days_used = (valid_days_used + 1)
						WHERE
							(
								(
									vp.id_user = $data[0]
									AND
									vpt.id_user_repass = 0
								)
								OR
								vpt.id_user_repass = $data[0]
							)
							AND
							vu.status = 1
							AND
							vp.id_event = $data[1]
							AND
							ve.status = 1
							AND
							vpt.id = $data[2]
							AND
							vp.status = 1
							AND
							vpt.status = 0
							AND
							(vpt.valid_days_used + 1) <= vpt.valid_days
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			public function setPaymentTicketStatus($ticket){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getIdTicketPayment());
				$query = <<<HTML
					UPDATE
						vu_payment_ticket
						SET
							status = 1
						WHERE
							id = $data[0]
							AND
							valid_days_used >= valid_days
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				return($this->conn->affectedRows());
			}
			
			
			public function getPaymentTicketByCode($ticket){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getCode());
				if(is_object($ticket->getEvent()) && $ticket->getEvent()->getId() > 0){
					$data[] = 'AND vp.id_event = '.$this->conn->cleanData($ticket->getEvent()->getId());
				}
				else{
					$data[] = '';
				}
				$query = <<<HTML
					SELECT
						vp.id_user,
						vpt.id,
						vpt.id_user_repass
						FROM
							vu_event ve
							INNER JOIN
							vu_payment vp
								ON(ve.id = vp.id_event)
							INNER JOIN
							vu_payment_ticket_day vptd
								ON(vp.id = vptd.id_payment)
							INNER JOIN
							vu_payment_ticket vpt
								ON(vptd.id = vpt.id_payment_ticket_day)
							INNER JOIN
							vu_event_ticket_day vtd
								ON(vptd.id_ticket_day = vtd.id)
						WHERE
							vpt.code LIKE "$data[0]"
							AND
							vp.status = 1
							$data[1]
						LIMIT 1
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$auxTicket = NULL;
				while($data = $this->conn->fetchObject($result)){
					$auxTicket = new Ticket();
					$auxTicket->setIdTicketPayment($data->id);
					$auxTicket->setUser(new User($data->id_user));
					$auxTicket->setUserRepass(new User($data->id_user_repass));
					break;
				}
				$this->conn->free($result);
				return($auxTicket);
			}
			
			
			public function getPaymentTicketByNotQrCode($ticket){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getIdTicketPayment());
				$data[] = $this->conn->cleanData($ticket->getCode());
				if(is_object($ticket->getEvent()) && $ticket->getEvent()->getId() > 0){
					$data[] = 'AND vp.id_event = '.$this->conn->cleanData($ticket->getEvent()->getId());
				}
				else{
					$data[] = '';
				}
				$query = <<<HTML
					SELECT
						vp.id_user,
						vpt.id,
						vpt.id_user_repass
						FROM
							vu_event ve
							INNER JOIN
							vu_payment vp
								ON(ve.id = vp.id_event)
							INNER JOIN
							vu_payment_ticket_day vptd
								ON(vp.id = vptd.id_payment)
							INNER JOIN
							vu_payment_ticket vpt
								ON(vptd.id = vpt.id_payment_ticket_day)
							INNER JOIN
							vu_event_ticket_day vtd
								ON(vptd.id_ticket_day = vtd.id)
						WHERE
							vpt.id = $data[0]
							AND
							CONCAT(SUBSTRING(code,40,1), SUBSTRING(code,28,1), SUBSTRING(code,18,1), SUBSTRING(code,3,1)) LIKE "$data[1]"
							AND
							vp.status = 1
							$data[2]
						LIMIT 1
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$auxTicket = NULL;
				while($data = $this->conn->fetchObject($result)){
					$auxTicket = new Ticket();
					$auxTicket->setIdTicketPayment($data->id);
					$auxTicket->setUser(new User($data->id_user));
					$auxTicket->setUserRepass(new User($data->id_user_repass));
					break;
				}
				$this->conn->free($result);
				return($auxTicket);
			}
			
			
			public function getPaymentTickets($ticket){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getUser()->getId());
				if($ticket->getIdTicketPayment() > 0){
					$data[] = 'AND vpt.id = '.$this->conn->cleanData($ticket->getIdTicketPayment());
				}
				else if($ticket->getIsLoadMore()){
					$data[] = 'AND vpt.id NOT IN('.$this->conn->cleanData($ticket->getId()).')';
				}
				else if(is_object($ticket->getPayment()) && $ticket->getPayment()->getId() > 0){
					$data[] = 'AND vp.id = '.$this->conn->cleanData($ticket->getPayment()->getId());
				}
				else if(strlen(trim($ticket->getCode())) > 0){
					$data[] = 'vpt.code LIKE "'.$this->conn->cleanData($ticket->getCode()).'"';
				}
				else{
					$data[] = '';
				}
				$data[] = time();
				$data[] = $ticket->getLimit() == 0 ? '' : 'LIMIT '.$this->conn->cleanData($ticket->getLimit());
				$query = <<<HTML
					SELECT DISTINCT
						*
						FROM
						(
							(SELECT
								vp.id id_payment,
								vp.id_user,
								vp.full_price,
								vp.price_to_pay,
								vp.ticket_type_charge,
								vp.ticket_type_taxes,
								vp.status status_payment,
								vp.time time_payment,
								vp.id_event,
								vp.parcels,
								vp.token,
								vptd.id id_payment_ticket_day,
								vptd.id_ticket_day,
								vpt.id,
								vpt.id_ticket,
								vpt.code,
								vpt.status,
								vpt.time_used,
								vpt.id_user_repass,
								vpt.time_repass,
								vpt.price,
								vpt.valid_days,
								vpt.valid_days_used
								FROM
									vu_event ve
									INNER JOIN
									vu_payment vp
										ON(ve.id = vp.id_event)
									INNER JOIN
									vu_payment_ticket_day vptd
										ON(vp.id = vptd.id_payment)
									INNER JOIN
									vu_payment_ticket vpt
										ON(vptd.id = vpt.id_payment_ticket_day)
									INNER JOIN
									vu_event_ticket_day vtd
										ON(vptd.id_ticket_day = vtd.id)
								WHERE
									(
										(
											vp.id_user = $data[0]
											AND
											vpt.id_user_repass = 0
										)
										OR
										vpt.id_user_repass = $data[0]
									)
									AND
									vp.status = 1
									$data[1]
									AND
									vtd.time_day >= $data[2]
								ORDER BY
									vpt.status ASC,
									ve.status DESC,
									ve.status_bank_account DESC,
									vtd.time_day ASC,
									vp.id DESC
								$data[3])
							UNION
							(SELECT
								vp.id id_payment,
								vp.id_user,
								vp.full_price,
								vp.price_to_pay,
								vp.ticket_type_charge,
								vp.ticket_type_taxes,
								vp.status status_payment,
								vp.time time_payment,
								vp.id_event,
								vp.parcels,
								vp.token,
								vptd.id id_payment_ticket_day,
								vptd.id_ticket_day,
								vpt.id,
								vpt.id_ticket,
								vpt.code,
								vpt.status,
								vpt.time_used,
								vpt.id_user_repass,
								vpt.time_repass,
								vpt.price,
								vpt.valid_days,
								vpt.valid_days_used
								FROM
									vu_event ve
									INNER JOIN
									vu_payment vp
										ON(ve.id = vp.id_event)
									INNER JOIN
									vu_payment_ticket_day vptd
										ON(vp.id = vptd.id_payment)
									INNER JOIN
									vu_payment_ticket vpt
										ON(vptd.id = vpt.id_payment_ticket_day)
									INNER JOIN
									vu_event_ticket_day vtd
										ON(vptd.id_ticket_day = vtd.id)
								WHERE
									(
										(
											vp.id_user = $data[0]
											AND
											vpt.id_user_repass = 0
										)
										OR
										vpt.id_user_repass = $data[0]
									)
									AND
									vp.status = 1
									$data[1]
									AND
									vtd.time_day < $data[2]
								ORDER BY
									vpt.status ASC,
									ve.status DESC,
									ve.status_bank_account DESC,
									vtd.time_day ASC,
									vp.id DESC
								$data[3])
						) aux
					$data[3]
HTML;
				//exit($query);
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$arrayTickets = array();
				while($data = $this->conn->fetchObject($result)){
					$payment = new Payment($data->id_payment);
					$payment->setFullPrice($data->full_price);
					$payment->setPriceToPay($data->price_to_pay);
					$payment->setStatus($data->status_payment);
					$payment->setTime($data->time_payment);
					$payment->setParcels(new TicketParcel($data->parcels));
					
					$event = new Event($data->id_event);
					$event->setTicketTypeCharge($data->ticket_type_charge);
					$event->setTicketTypeTaxes($data->ticket_type_taxes);
					
					$ticketDay = new TicketDay($data->id_ticket_day);
					$ticketDay->setIdTicketDayPayment($data->id_payment_ticket_day);
					
					$userRepass = new User($data->id_user_repass > 0 ? $data->id_user : 0);
					$userRepass->setTime($data->time_repass);
					
					$auxTicket = new Ticket($data->id_ticket);
					$auxTicket->setIdTicketPayment($data->id);
					$auxTicket->setStatus($data->status);
					$auxTicket->setTime($data->time_used);
					$auxTicket->setCode($data->code);
					$auxTicket->setPrice($data->price);
					$auxTicket->setPayment($payment);
					$auxTicket->setEvent($event);
					$auxTicket->setTicketDay($ticketDay);
					$auxTicket->setUserRepass($userRepass);
					$auxTicket->setTicketValidDays(new TicketValidDays($data->valid_days));
					$auxTicket->setTicketValidDaysUsed(new TicketValidDays($data->valid_days_used));
				
					$arrayTickets[] = $auxTicket;
				}
				$this->conn->free($result);
				return($arrayTickets);
			}
			
			
			public function getUsersConfirmed($event, $limit=0){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$data[] = empty($limit) ? 'vu.name ASC,' : '';
				$data[] = empty($limit) ? '' : 'LIMIT '.$this->conn->cleanData($limit);
				$query = <<<HTML
					SELECT DISTINCT
						vu.id,
						vu.name,
						vu.image,
						vu.url_sufix
						FROM
							vu_user vu
							INNER JOIN
							vu_payment vp
								ON(vu.id = vp.id_user)
						WHERE
							vp.id_event = $data[0]
							AND
							vp.status = 1
							AND
							vu.status = 1
						ORDER BY
							$data[1]
							vp.id DESC
						$data[2]
HTML;
				//exit($query);
				//$this->conn->fileQuery($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$arrayUsers = array();
				while($data = $this->conn->fetchObject($result)){
					$auxUser = new User($data->id);
					$auxUser->setName($data->name);
					$auxUser->setUrlSufix($data->url_sufix);
					
					$auxUser->setImage(new Image());
					$auxUser->getImage()->setName($data->image);
				
					$arrayUsers[] = $auxUser;
				}
				$this->conn->free($result);
				return($arrayUsers);
			}
			public function getUsersConfirmedForMobile($event){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$data[] = !$event->getIsLoadMore() ? '' : 'AND vpt.id NOT IN('.$this->conn->cleanData($event->getIds()).')';
				$data[] = __LIMIT_USERS_CONFIRMED_MOB__;
				$query = <<<HTML
					SELECT
						vp.id id_payment,
						vp.id_user,
						vu.name,
						vp.full_price,
						vp.price_to_pay,
						vp.ticket_type_charge,
						vp.ticket_type_taxes,
						vp.status status_payment,
						vp.time time_payment,
						vp.id_event,
						vp.parcels,
						vp.token,
						vptd.id id_payment_ticket_day,
						vptd.id_ticket_day,
						vetd.time_day,
						vpt.id,
						vpt.id_ticket,
						vpt.code,
						vpt.status,
						vpt.time_used,
						vpt.id_user_repass,
						vur.name name_repass,
						vpt.time_repass,
						vpt.price,
						vpt.valid_days,
						vpt.valid_days_used
						FROM
							vu_user vu
							INNER JOIN
							vu_payment vp
								ON(vu.id = vp.id_user)
							INNER JOIN
							vu_payment_ticket_day vptd
								ON(vp.id = vptd.id_payment)
							INNER JOIN
							vu_payment_ticket vpt
								ON(vptd.id = vpt.id_payment_ticket_day)
							INNER JOIN
							vu_event_ticket_day vetd
								ON(vptd.id_ticket_day = vetd.id)
							LEFT JOIN
							vu_user vur
								ON(vpt.id_user_repass > 0 && vpt.id_user_repass = vur.id)
						WHERE
							vp.id_event = $data[0]
							$data[1]
							AND
							vp.status = 1
							AND
							vu.status = 1
						ORDER BY
							vp.time DESC,
							vu.name ASC,
							vpt.status ASC,
							vp.id DESC
						LIMIT $data[2]
HTML;
				$query = $this->conn->removeBreakLine($query);
				//exit($query);
				//$this->conn->fileQuery($query);
				$result = $this->conn->query($query);
				$arrayTickets = array();
				while($data = $this->conn->fetchObject($result)){
					$payment = new Payment($data->id_payment);
					$payment->setFullPrice($data->full_price);
					$payment->setPriceToPay($data->price_to_pay);
					$payment->setStatus($data->status_payment);
					$payment->setTime($data->time_payment);
					$payment->setParcels(new TicketParcel($data->parcels));
					
					$event = new Event($data->id_event);
					$event->setTicketTypeCharge($data->ticket_type_charge);
					$event->setTicketTypeTaxes($data->ticket_type_taxes);
					
					$ticketDay = new TicketDay($data->id_ticket_day);
					$ticketDay->setIdTicketDayPayment($data->id_payment_ticket_day);
					$ticketDay->setDay($data->time_day);
					
					$auxUser = new User($data->id_user_repass == 0 ? $data->id_user : $data->id_user_repass);
					$auxUser->setName($data->id_user_repass == 0 ? $data->name : $data->name_repass);
					
					$auxTicket = new Ticket($data->id_ticket);
					$auxTicket->setIdTicketPayment($data->id);
					$auxTicket->setStatus($data->status);
					$auxTicket->setTime($data->time_used);
					$auxTicket->setCode($data->code);
					$auxTicket->setPrice($data->price);
					$auxTicket->setPayment($payment);
					$auxTicket->setEvent($event);
					$auxTicket->setTicketDay($ticketDay);
					$auxTicket->setUser($auxUser);
					$auxTicket->setTicketValidDays(new TicketValidDays($data->valid_days));
					$auxTicket->setTicketValidDaysUsed(new TicketValidDays($data->valid_days_used));
				
					$arrayTickets[] = $auxTicket;
				}
				$this->conn->free($result);
				return($arrayTickets);
			}
			/*public function getUsersConfirmedForMobile($event){
				$data = array();
				$data[] = $this->conn->cleanData($event->getId());
				$data[] = !$event->getIsLoadMore() ? '' : 'AND vpt.id NOT IN('.$this->conn->cleanData($event->getIds()).')';
				$data[] = __LIMIT_USERS_CONFIRMED_MOB__;
				$query = <<<HTML
					SELECT
						vu.id id_user,
						vu.name,
						vu.image,
						vpt.id,
						vpt.id_user_repass,
						vur.name name_repass,
						vur.image image_repass
						FROM
							vu_user vu
							INNER JOIN
							vu_payment vp
								ON(vu.id = vp.id_user)
							INNER JOIN
							vu_payment_ticket_day vptd
								ON(vp.id = vptd.id_payment)
							INNER JOIN
							vu_payment_ticket vpt
								ON(vptd.id = vpt.id_payment_ticket_day)
							LEFT JOIN
							vu_user vur
								ON(vpt.id_user_repass > 0 && vpt.id_user_repass = vur.id)
						WHERE
							vp.id_event = $data[0]
							$data[1]
							AND
							vp.status = 1
							AND
							vu.status = 1
						ORDER BY
							vu.name ASC,
							vpt.status ASC,
							vp.time ASC,
							vp.id DESC
						LIMIT $data[2]
HTML;
				$query = $this->conn->removeBreakLine($query);
				//exit($query);
				//$this->conn->fileQuery($query);
				$result = $this->conn->query($query);
				$arrayUsers = array();
				while($data = $this->conn->fetchObject($result)){
					$auxTicket = new Ticket();
					$auxTicket->setIdTicketPayment($data->id);
					
					$auxUser = new User($data->id_user_repass == 0 ? $data->id_user : $data->id_user_repass);
					$auxUser->setName($data->id_user_repass == 0 ? $data->name : $data->name_repass);
					$auxUser->setImage(new Image());
					$auxUser->getImage()->setName($data->id_user_repass == 0 ? $data->image : $data->image_repass);
					$auxUser->setTicket($auxTicket);
					
					$arrayUsers[] = $auxUser;
				}
				$this->conn->free($result);
				return($arrayUsers);
			}*/
			
			
		// SINCRONYZE
			public function sicronyzeGet($event, $user){
				$data = array();
				if($event != null && $event->getId() > 0){
					$data[] = 'WHERE ve.id = '.$this->conn->cleanData($event->getId());
				}
				else if($user != null && $user->getId() > 0){
					$data[] = 'WHERE ve.id_user = '.$this->conn->cleanData($user->getId());
				}
				else{
					return(array());
				}
				$query = <<<HTML
					SELECT
						vpt.id,
						vpt.status,
						vpt.valid_days_used
						FROM
							vu_event ve
							INNER JOIN
							vu_payment vp
								ON(ve.id = vp.id_event)
							INNER JOIN
							vu_payment_ticket_day vptd
								ON(vp.id = vptd.id_payment)
							INNER JOIN
							vu_payment_ticket vpt
								ON(vptd.id = vpt.id_payment_ticket_day)
							INNER JOIN
							vu_event_ticket_day vtd
								ON(vptd.id_ticket_day = vtd.id)
						$data[0]
							
HTML;
				//$this->conn->fileQuery($query);
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$result = $this->conn->query($query);
				$arrayTickets = array();
				while($data = $this->conn->fetchObject($result)){
					/*$auxEvent = new Event($data->id_event);
					$auxUser = new User($data->id_user_repass > 0 ? $data->id_user_repass : $data->id_user);*/
					$auxTicket = new Ticket();
					$auxTicket->setIdTicketPayment($data->id);
					$auxTicket->setStatus($data->status);
					$auxTicket->setTicketValidDaysUsed(new ticketValidDays($data->valid_days_used));
					/*$auxTicket->setEvent($auxEvent);
					$auxTicket->setUser($auxUser);*/
					$arrayTickets[] = $auxTicket;
				}
				$this->conn->free($result);
				return($arrayTickets);
			}
			
			
		// REPASS TICKET
			public function repassTicket($ticket, $userRepass){
				$data = array();
				$data[] = $this->conn->cleanData($ticket->getPayment()->getId());
				$data[] = $this->conn->cleanData($ticket->getUser()->getId());
				$data[] = $this->conn->cleanData($ticket->getIdTicketPayment());
				$data[] = $this->conn->cleanData($userRepass->getId());
				$data[] = $ticket->getTime();
				$query = <<<HTML
					UPDATE
						vu_payment vp
						INNER JOIN
						vu_payment_ticket_day vptd
							ON(vp.id = vptd.id_payment)
						INNER JOIN
						vu_payment_ticket vpt
							ON(vptd.id = vpt.id_payment_ticket_day)
						SET
							vpt.id_user_repass = $data[3],
							vpt.time_repass = $data[4]
						WHERE
							vp.id = $data[0]
							AND
							vp.id_user = $data[1]
							AND
							vpt.id = $data[2]
HTML;
				//exit($query);
				$query = $this->conn->removeBreakLine($query);
				$this->conn->query($query);
				
				/*if($this->conn->affectedRows() == 1){
					$data = array();
					$data[] = $this->conn->cleanData($ticket->getIdTicketPayment());
					$data[] = $this->conn->cleanData($ticket->getUser()->getId());
					$data[] = $ticket->getTime();
					$query = <<<HTML
						UPDATE
							vu_payment_ticket
							SET
								id_user_repass = $data[1],
								time_repass = $data[2]
							WHERE
								id = $data[0]
							LIMIT 1
HTML;
					//exit($query);
					$query = $this->conn->removeBreakLine($query);
					$this->conn->query($query);
				}*/
				return($this->conn->affectedRows());
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
		}
		
		
		public function updateUser($user){
			$data = array();
			$data[] = $this->conn->cleanData($user->getId());
			$data[] = $this->conn->cleanDataOnlyForMysql($user->getName());
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $this->conn->cleanData($user->getImage()->getName());
			$data[] = $this->conn->cleanData($user->getPhone());
			$data[] = $this->conn->cleanData($user->getStatus());
			$query = <<<HTML
				UPDATE
					gw_user
					SET
						name = "$data[1]",
						email = "$data[2]",
						image = "$data[3]",
						phone = "$data[4]",
						status = $data[5],
					WHERE
						id = $data[0]
					LIMIT 1
HTML;
			$query = $this->conn->removeBreakLine($query);
			$this->conn->query($query);
			return($this->conn->affectedRows());
		}
		public function updatePassword($user){
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
		
		
		public function getUsers($user){
			$data = array();
			if($user->getId() > 0 || strlen($user->getEmail()) > 0)
				$data[] = $user->getId() > 0 ? 'id = '.$this->conn->cleanData($user->getId()) : 'email LIKE "'.$this->conn->cleanData($user->getEmail()).'"';
			else
				$data[] = 'status = 1';
			$query = <<<HTML
				SELECT
					id,
					id_facebook,
					name,
					email,
					image,
					phone,
					status,
					time
					FROM
						vu_user
					WHERE
						$data[0]
					ORDER BY
						name ASC,
						id DESC
HTML;
			//$this->conn->fileQuery($query);
			$query = $this->conn->removeBreakLine($query);
			$result = $this->conn->query($query);
			$arrayUsers = array();
			while($data = $this->conn->fetchObject($result)){
				$auxUser = new User($data->id);
				$auxUser->setName($data->name);
				$auxUser->setEmail($data->email);
				$auxUser->setImage(new Image(0, '', 0, $data->image));
				$auxUser->setPhone($data->phone);
				$auxUser->setStatus($data->status);
				$auxUser->setTime($data->time);
				$arrayUsers[] = $auxUser;
			}
			$this->conn->free($result);
			return($arrayUsers);
		}
		
		
		public function getUserByEmail($user, $wuthStatus=true){
			$data = array();
			$data[] = $this->conn->cleanData($user->getEmail());
			$data[] = $wuthStatus ? 'AND status = 1' : '';
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
			$auxUser = NULL;
			while($data = $this->conn->fetchObject($result)){
				$auxUser = new User($data->id);
			}
			$this->conn->free($result);
			return($auxUser);
		}
		
		
		public function getUserByIdFacebook($user, $wuthStatus=true){
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