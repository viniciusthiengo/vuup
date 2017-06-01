<?php
	$html = '';
	$htmlList = '';
	$htmlGrade = '';
	$hasMap = false;
	$hasDate = false;
	
	$categoryOptions = new EventCategory();
	$categoryOptions = $categoryOptions->getOptions();
	
	$stateOptions = new State();
	$stateOptions = $stateOptions->getOptions();
	
	$ticketParcelOptions = new TicketParcel();
	$ticketParcelOptions = $ticketParcelOptions->getOptions();
	
	if(preg_match('/^(vu-get-event-dashboard|vu-get-event-form-create|vu-get-event-update-form){1}$/', $_POST['method']) || $isDashboard){
		$hasMap = true;
		$hasDate = true;
		$id = 0;
		$hourOptions = new Hour();
		$hourOptions = $hourOptions->getOptions();
		$minuteOptions = new Minute();
		$minuteOptions = $minuteOptions->getOptions();
		$ticketQtdMaxOptions = new TicketQtdMax();
		$ticketQtdMaxOptions = $ticketQtdMaxOptions->getOptions();
		$ticketValidDaysOptions = new TicketValidDays();
		$ticketValidDaysOptions = $ticketValidDaysOptions->getOptions();
		$imgRemoveButton = '';
		$imgUrl = __PATH_FOR_LONG_URL__.'img/system/bg/img-250x300.png';
		$name = '';
		$statusArray = array('checked="checked"', '');
		$street = '';
		$neighborhood = '';
		$city = '';
		$number = '';
		$latitude = '-22.912213';
		$longitude = '-43.188778';
		$phoneCode = '';
		$phoneNumber = '';
		$description = '';
		$tags = '';
		$boxTagsStatus = '';
		$boxTagsIcon = '<i class="fa fa-chevron-circle-right"></i>';
		$ticketTypeChargeArray = array('checked="checked"', '');
		$disabled = 'disabled="disabled"';
		$ticketEmailSendStatus = 'checked="checked"';
		$showUserConfirmedStatus = 'checked="checked"';
		$ticketTypeTaxesArray = array('checked="checked"', '');
		$videoUrl = '';
		$boxVideoStatus = '';
		$videoHtml = '';
		$boxVideoIcon = '<i class="fa fa-chevron-circle-right"></i>';
		$html_Photos = '';
		$boxPhotosStatus = '';
		$boxPhotosIcon = '<i class="fa fa-chevron-circle-right"></i>';
		$html_TicketsDay = '';
		
		if(is_object($event)){
			$id = $event->getId();
			
			$imgRemoveButton = 'style="display: block;"';
			$imgUrl = $event->getImgBannerUrl(__PATH_FOR_LONG_URL__.'img/event/250-300/');
			
			$name = $event->getName();
			
			$statusArray = array();
			$statusArray[] = $event->getStatus() == 1 ? 'checked="checked"' : '';
			$statusArray[] = $event->getStatus() == 0 ? 'checked="checked"' : '';
			
			$street = $event->getAddress()->getStreet();
			$neighborhood = $event->getAddress()->getNeighborhood();
			$city = $event->getAddress()->getCity();
			$stateOptions = $event->getAddress()->getState()->getOptions();
			$number = $event->getAddress()->getNumber();
			$latitude = $event->getAddress()->getMap()->getLatitude();
			$longitude = $event->getAddress()->getMap()->getLongitude();
			
			$phoneCode = $event->getPhone()->getCode();
			$phoneNumber = $event->getPhone()->getNumber();
			
			$categoryOptions = $event->getCategory()->getOptions();
			$description = $event->getDescription();
			$tags = $event->getTagsPage(false);
			$boxTagsStatus = empty($tags) ? '' : 'style="display: block;"';
			$boxTagsIcon = empty($tags) ? $boxTagsIcon : '<i class="fa fa-chevron-circle-down"></i>';
			
			$ticketTypeChargeArray = array();
			$ticketTypeChargeArray[] = $event->getTicketTypeCharge() == 1 ? 'checked="checked"' : '';
			$ticketTypeChargeArray[] = $event->getTicketTypeCharge() == 2 ? 'checked="checked"' : '';
			$disabled = $event->getTicketTypeCharge() == 1 ? 'disabled="disabled"' : '';
			
			$ticketEmailSendStatus = $event->getTicketEmailSend() == 1 ? 'checked="checked"' : '';
			$showUserConfirmedStatus = $event->getShowUserConfirmed() == 1 ? 'checked="checked"' : '';
			$ticketParcelOptions = $event->getTicketParcels()->getOptions();
			
			$ticketTypeTaxesArray = array();
			$ticketTypeTaxesArray[] = $event->getTicketTypeTaxes() == 1 ? 'checked="checked"' : '';
			$ticketTypeTaxesArray[] = $event->getTicketTypeTaxes() == 2 ? 'checked="checked"' : '';
			
			$videoUrl = $event->getVideo()->getUrl();
			$videoUrl = empty($videoUrl) ? '' : htmlentities($event->getVideo()->getUrlIframe(786, 400));
			$boxVideoStatus = empty($videoUrl) ? '' : 'style="display: block;"';
			$videoHtml = empty($videoUrl) ? '' : $event->getVideo()->getUrlIframe(786, 400);
			$boxVideoIcon = empty($videoUrl) ? $boxVideoIcon : '<i class="fa fa-chevron-circle-down"></i>';
		}
		require_once(__PATH__.'/view/event-make-photos-form.php');
		require_once(__PATH__.'/view/event-make-tickets-form.php');
		
		// EDIT HEAD
			$html_EditHead = '';
			if(is_object($event)){
				$html_EditHead = <<<HTML
					<h2>
						<i class="fa fa-edit"></i>
						Editar <b>$name</b>
						<a href="package/ctrl/CtrlEvent.php|vu-get-event-list" class=" br-3 bt bt-come-back" title="Voltar">
							<i class="fa fa-reply"></i>
							Voltar
						</a>
					</h2>
HTML;
			}
		
		// INFO
			$html_UpdateInfo = '';
			if(is_object($event)){
				$html_UpdateInfo = <<<HTML
					<p class="tip ticket br-3">
						<i class="fa fa-info-circle"></i>
						Para manter a consistência de eventos criados e segurança para com os usuários do vuup, você
						pode <u>desativar ingressos</u> já criados, assim os usuários que ainda não compraram esses ingressos
						não poderam mais acessá-los.
					</p>
HTML;
			}
			
		// BUTTON
			$html_Button = <<<HTML
				<a href="#" id="fct-create-event" class="bt br-3" title="Criar evento">
					<i class="fa fa-send"></i>
					Criar evento
				</a>
HTML;
			if(is_object($event)){
				$html_Button = <<<HTML
					<a href="#" id="fct-update-event" class="bt br-3" title="Atualizar evento">
						<i class="fa fa-send"></i>
						Atualizar evento
					</a>
					<a href="package/ctrl/CtrlEvent.php|vu-get-event-update-form|$id" class="update-page"></a>
					<!-- a href="#" id="fct-close-event" class="bt-remove-bt br-3" title="Remover evento">
						<i class="fa fa-trash-o"></i>
						Remover evento
					</a -->
HTML;
			}
		
		$html = <<<HTML
			<div class="form">
				$html_EditHead
				
				<form class="fct-box-img banner" action="package/ctrl/CtrlFile.php">
					<div class="mask br-3">
						<div class="content">
							<img class="img-load" src="img/system/load/load-01.GIF" width="15" height="15" />
							Carregando banner
						</div>
					</div>
					<img src="$imgUrl" class="br-03 main-img" width="250" height="300" />
					<input class="input-file" type="file" name="fct-img">
					<div class="br-03 remove" title="Remover" $imgRemoveButton><i class="fa fa-times"></i></div>
					<a href="#" class="load-img br-3" title="Carregar banner (250 x 300)">
						<i class="fa fa-upload"></i>
						Carregar banner (250 x 300)
					</a>
					<input name="method" type="hidden" value="" />
					<span class="error">
						<i class="fa fa-times"></i>
						Forneça um banner 250x300
					</span>
				</form>
				
				<div class="box-field left-wm sub-container">
					<div class="box-field left">
						<input type="text" id="fct-name" class="br-3" placeholder="*Nome" value="$name" maxlength="40" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe um nome do evento
						</span>
					</div>
											
					<div class="box-field right-wm box-radio-button">
						Status evento:
						<label>
							<input type="radio" name="fct-status" value="1" $statusArray[0] />
							Disponível
						</label>
						&nbsp;
						<label>
							<input type="radio" name="fct-status" value="0" $statusArray[1] />
							Não disponível
						</label>
						<div class="cl"></div>
					</div>
					<div class="cl"></div>
					
					<div class="box-field left">
						<div class="box-field">
							<select id="fct-category" class="br-3">
								$categoryOptions
							</select>
							<div class="cl"></div>
							<span class="error">
								<i class="fa fa-times"></i>
								Escolha uma categoria
							</span>
						</div>
						
						<div class="box-address br-3">
							<h3>
								<i class="fa fa-road"></i>
								Endereço do evento
							</h3>
							
							<div class="box-field left-wm">
								<input type="text" id="fct-street" class="br-3" placeholder="*Logradouro" value="$street" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe rua
								</span>
							</div>
							<div class="box-field left">
								<input type="text" id="fct-neighborhood" class="br-3" placeholder="*Bairro" value="$neighborhood" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe bairro
								</span>
							</div>
							<div class="cl"></div>
							
							<div class="box-field left-wm">
								<input type="text" id="fct-city" class="br-3" placeholder="*Cidade" value="$city" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe cidade
								</span>
							</div>
							<div class="box-field left">
								<select id="fct-state" class="br-3">
									$stateOptions
								</select>
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe estado
								</span>
							</div>
							<div class="cl"></div>
							
							<div class="box-field left-wm">
								<input type="text" id="fct-number" class="br-3" placeholder="*Nº" value="$number" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe número
								</span>
							</div>
							<div class="box-field right-wm wmt">
								<a href="package/ctrl/CtrlEvent.php|vu-get-map-admin" class="bt bt-map bt-call-popup br-3" title="Marcar no mapa">
									<i class="fa fa-map-marker"></i>
									Mapa
								</a>
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe mapa
								</span>
							</div>
							<div class="cl"></div>
						</div>
					</div>
					
					<div class="box-field right-wm wmb">
						<div class="box-field">
							<input type="text" id="fct-phone-code" class="br-3" placeholder="*DDD" maxlength="2" value="$phoneCode" />
							<input type="text" id="fct-phone-number" class="br-3" placeholder="*Tel." maxlength="10" value="$phoneNumber" />
							<div class="cl"></div>
							<span class="error">
								<i class="fa fa-times"></i>
								Informe telefone para contato
							</span>
						</div>
						
						<div class="box-field">
							<textarea id="fct-description" class="br-3" placeholder="*Descrição">$description</textarea>
							<div class="cl"></div>
							<span class="error">
								<i class="fa fa-times"></i>
								Informe uma descrição detalhada
							</span>
						</div>
					</div>
					<div class="cl"></div>
				</div>
				<div class="cl"></div>
				
				<div class="box-block block-type br-3">
					<h2>
						<i class="fa fa-ticket"></i>
						Ingressos
					</h2>
					<div class="box-field left-wm">
						<div class="box-field">
							<label>
								<input type="radio" name="fct-type" value="1" $ticketTypeChargeArray[0] />
								Gratuito
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<label>
								<input type="radio" name="fct-type" value="2" $ticketTypeChargeArray[1] />
								Pago
							</label>
						</div>
						
						<div class="box-field" style="display: none;">
							<label>
								<input type="checkbox" name="fct-receiver-email" value="1" $ticketEmailSendStatus />
								Email por ingresso aquirido
							</label>
						</div>
						
						<div class="box-field">
							<label>
								<input type="checkbox" name="fct-show-user-confirmed" value="1" $showUserConfirmedStatus />
								Mostrar usuários já confirmados
							</label>
						</div>
						
						<div class="box-field">
							<label>
								Parcelado em até:
								<select id="fct-parcels" class="br-3" $disabled>
									$ticketParcelOptions
								</select>
							</label>
						</div>
						
						<div class="box-field">
							<label>
								<input type="radio" name="fct-rates" value="1" $ticketTypeTaxesArray[0] $disabled />
								Acrescentar valor de taxas
							</label>
							<br />
							<label>
								<input type="radio" name="fct-rates" value="2" $ticketTypeTaxesArray[1] $disabled />
								Incorporar valor de taxas
							</label>
						</div>
					</div>
					
					<div class="box-field right-wm right-wmb">
						<p class="tip ticket br-3">
							<i class="fa fa-info-circle"></i>
							Os dias definidos aqui são equivalentes aos dias do evento. No campo <b>Nome ingresso</b> você pode colocar, por exemplo,
							<u>"masculino"</u> em um ingresso e <u>"feminino"</u> em outro.
						</p>
						$html_UpdateInfo
						$html_TicketsDay
						<a href="#" class="bt br-3 bt-day-add" title="Add dia">
							<i class="fa fa-plus-circle"></i>
							Add dia
						</a>
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Ao menos um dia válido de ingresso deve ser definido.
						</span>
					</div>
					
					<div class="cl"></div>
				</div>
				
				<!-- div class="box-block block-type br-3">
					<h2>
						<i class="fa fa-users"></i>
						Promoter de evento
						<a href="#" class="bt-more" title="mais">
							...mais
							<i class="fa fa-chevron-circle-right"></i>
						</a>
					</h2>
					
					<div class="hide-block">
						<p class="tip br-3">
							<i class="fa fa-info-circle"></i>
							Com a opção de <b>"Promoter de evento"</b> liberada a possibilidade de você vender mais ingressos aumenta, pois os
							usuários do vuup poderão vender ingressos de seu evento com a atividade promocional deles. Para
							isso você terá de dar aos promoteres uma porcentagem de sua escolha do valor de venda do ingresso. <u>Com a venda por promoteres
							liberada você também poderá acompanhar como anda as vendas de cada um deles.</u>
						</p>
						
						<div class="box-field">
							<label>
								<input type="radio" name="fct-promoter" value="1" />
								Liberar promoteres
							<label>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<label>
								<input type="radio" name="fct-promoter" value="2" checked="checked" />
								Não liberar promoteres
							<label>
						</div>
						
						<div class="box-field">
							<label>
								Porcentagem paga na venda do ingresso:
								<select id="fct-promoter-porcentage" class="br-3 fct-promoter" disabled="disabled">
									<option value="1">1%</option>
									<option value="2">2%</option>
									<option value="3">3%</option>
									<option value="4">4%</option>
									<option value="5">5%</option>
								</select>
							</label>
						</div>
						
						<div class="cl"></div>
					</div>
				</div -->
				
				<div class="box-block block-type br-3" style="display: none;">
					<h2>
						<i class="fa fa-image"></i>
						Background página
						<a href="#" class="bt-more" title="mais">
							...mais
							<i class="fa fa-chevron-circle-right"></i>
						</a>
					</h2>
					<div class="hide-block">
						<form class="fct-box-img background-page" action="package/ctrl/CtrlFile.php">
							<div class="mask br-3">
								<div class="content">
									<img class="img-load" src="img/system/load/load-01.GIF" width="15" height="15" />
									Carregando
								</div>
							</div>
							<img src="img/system/bg/img-786x300.png" class="br-03 main-img" width="786" height="300" />
							<input class="input-file" type="file" name="fct-img">
							<div class="br-03 remove" title="Remover"><i class="fa fa-times"></i></div>
							<a href="#" class="load-img br-3" title="Carregar (mínimo 1400 x 400)">
								<i class="fa fa-upload"></i>
								Carregar (mínimo 1400 x 400)
							</a>
							<input name="method" type="hidden" value="" />
						</form>
						<div class="cl"></div>
					</div>
				</div>
				
				<div class="box-block block-type br-3">
					<h2>
						<i class="fa fa-camera-retro"></i>
						Fotos
						<a href="#" class="bt-more" title="mais">
							...mais
							$boxPhotosIcon
						</a>
					</h2>
					<div class="hide-block" $boxPhotosStatus>
						$html_Photos
						<div class="cl"></div>
					</div>
				</div>
				
				<div class="box-block block-type br-3">
					<h2>
						<i class="fa fa-video-camera"></i>
						Vídeo promocional
						<a href="#" class="bt-more" title="mais">
							...mais
							$boxVideoIcon
						</a>
					</h2>
					<div class="hide-block" $boxVideoStatus>
						<div class="box-field">
							<input type="text" id="fct-video" class="br-3" placeholder="Embed code" value="$videoUrl" />
							<input type="hidden" id="fct-video-url" value="package/ctrl/CtrlEvent.php" />
							<input type="hidden" id="fct-video-method" value="vu-validate-url-video" />
							<div class="mask-input br-3">
								<img src="img/system/load/load-01.GIF" width="16" />
								Validando...
							</div>
							<div class="cl"></div>
						</div>
						
						<div class="box-video" $boxVideoStatus>$videoHtml</div>
						<div class="cl"></div>
					</div>
				</div>
				
				<div class="box-block block-type br-3">
					<h2>
						<i class="fa fa-tag"></i>
						Tags
						<a href="#" class="bt-more" title="mais">
							...mais
							$boxTagsIcon
						</a>
					</h2>
					<div class="hide-block" $boxTagsStatus>
						<div class="box-field">
							<input type="text" id="fct-tags" class="br-3" placeholder="Separe as tags por vírgula ','" maxlength="50" value="$tags" />
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
					</div>
				</div>
				
				<!-- MAP -->
					<input id="fct-latitude" type="hidden" name="lati-1" value="$latitude">
					<input id="fct-longitude" type="hidden" name="long-1" value="$longitude">
					<input id="fct-zoom" type="hidden" name="zoom-1" value="13">
					<input id="fct-mapt-type" type="hidden" name="mapt-1" value="roadmap">
					<input id="fct-paid" type="hidden" name="paid-1" value="undefined">
					<input id="fct-pazo" type="hidden" name="pazo-1" value="undefined">
					<input id="fct-pavi" type="hidden" name="pavi-1" value="0">
					<input id="fct-pahe" type="hidden" name="pahe-1" value="0">
					<input id="fct-papi" type="hidden" name="papi-1" value="0">
				<!-- MAP -->
				
				<div class="cl"></div>
				<div class="vl"></div>
				
				<div class="box-buttons">
					<input id="fct-event" type="hidden" value="$id" />
					$html_Button
				</div>
				<div class="cl"></div>
				
				<input id="fct-method" name="method" type="hidden" value="">
			</div>
HTML;

	
		// DASHBOARD
			if(preg_match('/^(vu-get-event-dashboard){1}$/', $_POST['method']) || $isDashboard){
				$html = <<<HTML
					<nav>
						<ul class="box-header-buttons">
							<li>
								<a href="package/ctrl/CtrlEvent.php|vu-get-event-form-create" class="selected" title="Criar evento">
									<i class="fa fa-chevron-down"></i>
									Criar evento
								</a>
							</li>
							<li class="vl"></li>
							<li>
								<a href="package/ctrl/CtrlEvent.php|vu-get-event-list" title="Acessar eventos">
									<i class="fa fa-chevron-right"></i>
									Acessar eventos
								</a>
							</li>
							<li class="cl"></li>
						</ul>
						<div class="cl"></div>
					</nav>
					<div class="sub-content">
						$html
					</div>
HTML;
			}
	}
	
	
	else if(preg_match('/^(vu-event-create){1}$/', $_POST['method'])){
		$hasMap = false;
		$hasDate = false;
		
		$name = $event->getUser()->getName();
		$eventName = $event->getName();
		$eventUrl = $event->getFullUrl();
			
		if($return == 1 && $event->getTicketTypeCharge() == 2){			
			$titleModal = '';
			
			if(!is_null($event->getUser()->getBank()) && $event->getUser()->getBank()->getStatus() == 1){
				$titleModal = 'Evento criado!';
				$html = <<<HTML
					O evento <a href="$eventUrl" title="$eventName" target="_blank">$eventName</a> foi criado com sucesso,
					agora é só divulgar e aguardar as vendas de ingressos
HTML;
			}
			else{
				$titleModal = '...evento ainda não liberado';
				if(is_null($event->getUser()->getBank())){
					$html = 'Para informar uma conta bancária';
				}
				else if($event->getUser()->getBank()->getStatus() == 2){
					$html = 'A conta bancária enviada por você ainda está em análise, assim que ela for aprovada o evento será liberado. Para verificar os dados de conta enviada';
				}
				else if($event->getUser()->getBank()->getStatus() == 0){
					$html = 'A conta bancária enviada por você foi suspensa. Para verificar os dados de conta enviada';
				}
				
				$html == <<<HTML
					O evento <b>$eventName</b> foi criado com sucesso, porém ele ainda não está disponível devido a <u>não existência
					ainda de uma conta bancária válida</u> para recebimento do dinheiro.
					<br />
					<br />
					$html
					<a href="./package/ctrl/CtrlUser.php|vu-get-user-dashboard" class="open-new-content open-bank-account" title="Dados conta bancária">clique aqui</a>.
					<br /><br />
					Se houver dúvidas você pode estar entrando em contato pelo email <b>contato@vuup.com.br</b>
					<br /><br />
					Att,
					<br />
					Equipe vuup
HTML;
			}
			
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-beer"></i>
						$titleModal
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="login-box">
							<br />
							<br />
							Olá <b>$name</b>,
							<br />
							<br />
							$html
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
HTML;
		}
		else if($return == 1 && $event->getTicketTypeCharge() == 1){
			$html = <<<HTML
					<div class="modal-main-content br-3">
						<h2>
							<i class="fa fa-beer"></i>
							Evento criado
							<a href="#" title="Fechar" class="link-close">
								<i class="fa fa-times-circle"></i>
							</a>
						</h2>
						<div class="wrap-content">
							<div class="login-box">
								<br />
								<br />
								Olá <b>$name</b>,
								<br />
								<br />
								O evento <a href="$eventUrl" title="$eventName" target="_blank">$eventName</a> foi criado com sucesso,
								agora é só divulgar e aguardar os cadastros de obtenção de ingressos
								<br />
								<br />
								$html
								<br /><br />
								Se houver dúvidas você pode estar entrando em contato pelo email <b>contato@vuup.com.br</b>
								<br /><br />
								Att,
								<br />
								Equipe vuup
								<br />
								<br />
								<br />
							</div>
						</div>
					</div>
HTML;
		}
	}
	
	
	else if(preg_match('/^(vu-event-update){1}$/', $_POST['method'])){
		$hasMap = false;
		$hasDate = false;
		$name = $event->getUser()->getName();
		$eventName = $event->getName();
		$eventUrl = $event->getFullUrl();
		
		if($return == 1){
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-beer"></i>
						Evento atualizado!
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="login-box">
							<br />
							<br />
							Olá <b>$name</b>,
							<br />
							<br />
							O evento <a href="$eventUrl" title="$eventName" target="_blank">$eventName</a> foi atualizado com sucesso,
							agora é só divulgar.
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
HTML;
		}
		else{
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-beer"></i>
						FALHOU!
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="login-box">
							<br />
							<br />
							<b>$name</b>,
							<br />
							<br />
							Houve uma falha no momento da atualização, tente novamente.
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
HTML;
		}
	}
	
	
	else if(preg_match('/^(vu-get-event-list|vu-get-event-list-load-more|vu-get-event-list-page-load-more){1}$/', $_POST['method'])){
		$arrayObj = $arrayEvents;
		require_once(__PATH__.'/view/event-list-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-event-favorite-dashboard|vu-get-event-favorite|vu-get-event-favorite-load-more){1}$/', $_POST['method'])){
		$arrayObj = $arrayEvents;
		require_once(__PATH__.'/view/event-favorite-list-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-event-payment-form){1}$/', $_POST['method'])){
		$imgCard = __PATH_FULL_PREFIX__.'img/system/bg/credit-card-01.png';
		$hasMap = false;
		$hasDate = false;
		$price = 0;
		
		$eventId = $event->getId();
		$eventName = $event->getName();
		
		// HIDDEN INPUT FOR TICKETS
			$hiddenTickets = '';
			$arrayTicketsDay = $event->getTicketsDayArray();
			for($i = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
				$hiddenTickets .= $arrayTicketsDay[$i]->getId().__SPLINE__;
				
				$arrayTickets = $arrayTicketsDay[$i]->getTicketArray();
				for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
					$hiddenTickets .= $arrayTickets[$j]->getId().__SPSUBDATA__.$arrayTickets[$j]->getQtdMax()->getItem().__SPDATA__;
				}
				$hiddenTickets = trim($hiddenTickets, __SPDATA__);
				$hiddenTickets .= __SPMAIN__;
			}
			$hiddenTickets = trim($hiddenTickets, __SPMAIN__);
		
		if($event->getTicketTypeCharge() == 2){
			$cardVencMonthOptions = new CardVencMonth();
			$cardVencMonthOptions = $cardVencMonthOptions->getOptions();
			
			$cardVencYearOptions = new CardVencYear();
			$cardVencYearOptions = $cardVencYearOptions->getOptions();
			
			$ticketParcelOptions = new TicketParcel(0, $event->getTicketTypeTaxes() == 2 ? 2 : 0);
			$ticketParcelOptions->setArrayItemPosition(0, 'Pagamento à vista');
			$ticketParcelOptions = $ticketParcelOptions->getOptions($event->getTicketParcels()->getItem());
			
			$price = $event->getFullPrice();
			$priceHumanFormated = $event->getFullPrice(true);
			$event->setTicketTypeTaxes(2); // REMOVE TAXES TO GET FULL PRICE
			$priceWithoutTaxes = $event->getFullPrice();
			
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-credit-card"></i>
						Finalizar compra
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="payment-box">
							
							<form class="form">
								<div class="box-field radio-card">
									<i class="fa fa-credit-card"></i>
									Cartão:<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label>
										<input type="radio" name="fct-card" value="visa" />
										<i class="fa fa-cc-visa"></i>
									</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label>
										<input type="radio" name="fct-card" value="mastercard" />
										<i class="fa fa-cc-mastercard"></i>
									</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label>
										<input type="radio" name="fct-card" value="amex" />
										<i class="fa fa-cc-amex"></i>
									</label>
									<div class="cl"></div>
									<span class="error">
										<i class="fa fa-times"></i>
										Informe a bandeira do cartão
									</span>
								</div>
								<div class="cl"></div>
								<div class="vl"></div>
								
								<div class="box-field box-field-mb">
									<label for="fct-parcels">Parcelas:</label>
									<select id="fct-parcels" class="br-3">
										$ticketParcelOptions
									</select>
								</div>
								<div class="cl"></div>
								
								<div class="box-field box-field-mb left">
									<input type="text" id="fct-card-number" class="br-3" placeholder="Nº cartão" />
									<div class="cl"></div>
									<span class="error">
										<i class="fa fa-times"></i>
										Número do cartão incompatível
									</span>
								</div>
								
								<div class="box-field box-field-mb right">
									<input type="text" id="fct-card-name" class="br-3" placeholder="Nome no cartão" />
									<div class="cl"></div>
									<span class="error">
										<i class="fa fa-times"></i>
										Informe o nome que está no cartão
									</span>
								</div>
								<div class="cl"></div>
								
								<div class="box-field box-field-mb left">
									<label>Vencimento:</label>
									<select id="fct-card-month" class="br-3">
										$cardVencMonthOptions
									</select>
									/
									<select id="fct-card-year" class="br-3">
										$cardVencYearOptions
									</select>
									<div class="cl"></div>
									<span class="error">
										<i class="fa fa-times"></i>
										Data de vencimento incompatível
									</span>
								</div>
								
								<div class="box-field box-field-mb right">
									<input type="text" id="fct-card-safe-code" class="br-3" placeholder="Código de segurança" />
									<div class="box-show-info">
										<i class="fa fa-question-circle"></i>
										<div class="info br-3">
											<div class="arrow-top-right"></div>
											<img src="$imgCard" width="252" height="155" />
										</div>
									</div>
									<div class="cl"></div>
									<span class="error">
										<i class="fa fa-times"></i>
										Código de segurança incompatível
									</span>
								</div>
								<div class="cl"></div>
								<div class="vl" style="margin-top: 0;"></div>
								
								<div class="box-total-price">
									<div class="box-center">
										<span>Total:</span><br />
										&nbsp;&nbsp;
										<b>$priceHumanFormated</b>
									</div>
								</div>
							</form>
							<div class="cl"></div>
							<div class="vl"></div>
							<input type="hidden" id="fct-type-charge" value="2" />
							<input type="hidden" id="fct-full-price-before" value="$price" />
							<input type="hidden" id="fct-full-price" value="$price" />
							<input type="hidden" id="fct-event" value="$eventId" />
							<input type="hidden" id="fct-tickets" value="$hiddenTickets" />
							<a href="#" id="submit-finish-buy" class="bt br-3" title="Finalizar">
								<i class="fa fa-credit-card"></i>
								Finalizar
							</a>
							<div class="cl"></div>
							<div class="box-error-payment">
								<div class="vl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe a bandeira do cartão
								</span>
							</div>
						</div>
					</div>
				</div>
HTML;
		}
		else{
			if(count($event->getTicketsDayArray()) == 1){
				$title = 'Obter ingresso';
				$text = 'Clique em "Confirmar" abaixo para obter seu token de entrada no evento gratuito';
			}
			else{
				$title = 'Obter ingressos';
				$text = 'Clique em "Confirmar" abaixo para obter seus tokens de entrada no evento gratuito';
			}
			$title = count($event->getTicketsDayArray()) == 1 ? 'Obter ingresso' : 'Obter ingressos';
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-ticket"></i>
						$title
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="payment-box">
							<br /><br />
							
							$text
							<b>"$eventName"</b>.
							
							<br /><br /><br />
							<div class="cl"></div>
							<div class="vl"></div>
							<input type="hidden" id="fct-type-charge" value="1" />
							<input type="hidden" id="fct-full-price-before" value="$price" />
							<input type="hidden" id="fct-full-price" value="$price" />
							<input type="hidden" id="fct-event" value="$eventId" />
							<input type="hidden" id="fct-tickets" value="$hiddenTickets" />
							<a href="#" id="submit-finish-buy" class="bt br-3" title="Confirmar">
								<i class="fa fa-ticket"></i>
								Confirmar
							</a>
							<div class="cl"></div>
						</div>
					</div>
				</div>
HTML;
		}
	}
	
	
	else if(preg_match('/^(vu-pay-event-ticket){1}$/', $_POST['method'])){
		$imgCard = __PATH_FULL_PREFIX__.'img/system/bg/credit-card-01.png';
		$hasMap = false;
		$hasDate = false;
		
		$userName = $user->getName();
		$eventName = $event->getName();
		
		if($return == 1){
			$numberTickestSold = $payment->getTotalTickets();
			
			if($numberTickestSold == 1){
				$title = 'Ingresso adquirido com sucesso!';
				if($event->getTicketTypeCharge() == 1){
					$text = 'Sua reserva para o evento gratuito <b>'.$eventName.'</b> está confirmada.';
				}
				else{
					$text = 'A compra foi aprovada e o ingresso para o evento <b>'.$eventName.'</b> já está disponível em sua conta.';
				}
			}
			else{
				$title = 'Ingressos adquiridos com sucesso!';
				if($event->getTicketTypeCharge() == 1){
					$text = 'Suas reservas para o evento gratuito <b>'.$eventName.'</b> estão confirmadas.';
				}
				else{
					$text = 'A compra foi aprovada e os ingressos para o evento <b>'.$eventName.'</b> já estão disponíveis em sua conta.';
				}
			}
			
			$vuupPhone = __VUUP_PHONE__;
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-angellist"></i>
						$title
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="payment-box">
							<br /><br />
							
							<b>$userName</b>.
							<br />
							$text
							<br /><br />
							Utilize o QRCode gerado do ingresso para se identificar na entrada do evento. <em>O QRCode está disponível em sua área de administrador no vuup</em>.
							<br /><br /><br />
							Qualquer dúvida você pode entrar em contato diretamente com o vuup pelo email contato@vuup.com.br ou pelo telefone $vuupPhone
							<br /><br /><br />
						</div>
					</div>
				</div>
HTML;
		}
	}
	
	
	else if(preg_match('/^(vu-get-events-page){1}$/', $_POST['method'])){
		$hasMap = false;
		$hasDate = false;
		$img = __PATH_FULL_PREFIX__.'img/ticket/250-300/event-01.jpg';
		
		$arrayObj = $arrayEvents;
		require_once(__PATH__.'/view/event-list-make.php');
		
		if(count($arrayObj) == 0){
			$userFromPageName = $userFromPage->getName();
			$htmlGrade = '';
			$htmlList = <<<HTML
				<p class="no-content">
					<i class="fa fa-frown-o"></i>
					Nenhum evento ainda criado por $userFromPageName.
				</p>
HTML;
		}
		
		$html = <<<HTML
			<h2>
				<i class="fa fa-beer"></i>
				Eventos
				
				<a href="box-list" class="list-bt br-3" title="Lista">
					<i class="fa fa-align-justify"></i>
				</a>
				<a href="box-grade" class="grade-bt br-3 selected" title="Grade">
					<i class="fa fa-th-large"></i>
				</a>
			</h2>
			<div class="vl"></div>
			$htmlGrade
			$htmlList
HTML;
	}
	
	
	else if(preg_match('/^(get-users-confirm){1}$/', $_POST['method'])){
		$hasMap = false;
		$hasDate = false;
		$arrayObj = $event->getUsersConfirmedArray();
		require_once(__PATH__.'/view/event-users-confirmed.php');
	}
	
	
	if($isDashboard){
		echo $html;
	}
	else{
		// MOBILE
			$arrayJson = array();
			if(preg_match('/^(vu-mob-get-event-list){1}$/', $_POST['method']) && is_array($arrayEvents)){
				$tamI = count($arrayEvents);
				for($i = 0; $i < $tamI; $i++){
					$arrayJson[] = $arrayEvents[$i]->getDataJSON();
				}
			}
			
		echo json_encode(array('feedback'=>$return,
			'isFavorite'=>$isFavorite,
			'hasMap'=>$hasMap,
			'hasDate'=>$hasDate,
			'html'=>$html,
			'htmlList'=>$htmlList,
			'htmlGrade'=>$htmlGrade,
			'error'=>(is_object($error) ? $error->getDataJSON() : ''),
			'events'=>$arrayJson,
			'synchronizedData'=>$synchronizedData));
	}
?>