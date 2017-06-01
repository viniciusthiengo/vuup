<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="<?php echo $event->getTagsPage(); ?>" />
		<meta name="description" content="<?php echo 'Página do evento '.$event->getName().' no Vuup. Produção de '.$event->getUser()->getName(); ?>" />
		<meta property="og:url" content="<?php echo $event->getFullUrl(); ?>" />
		<meta property="og:title" content="<?php echo $event->getName(); ?>" />
		<meta property="og:description" content="<?php echo 'Página do evento '.$event->getName().' no Vuup. Produção de '.$event->getUser()->getName(); ?>" />
		<meta property="og:image" content="<?php echo $event->getImgBannerUrl(__PATH_FULL_PREFIX__.'img/event/250-300/'); ?>" />
		<meta property="fb:app_id" content="350312291805346" />
		
		<title><?php echo $event->getName(); ?></title>
		
		<!-- start CSS -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end CSS -->
	</head>
	
	
	
	<body id="event-page">
		<!-- HEADER -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- HEADER -->
		
		
		
		
		
		<!-- MAIN -->
			<?php
				// BACKGROUND PAGE
					/*if(strlen($event->getImgBackground()->getName()) > 0){
						$imgBackground = $event->getImgBackgroundUrl(__PATH_FOR_LONG_URL__.'img/event/background/');
						echo '<div id="box-wallpaper" style="background-image: url('.$imgBackground.')"></div>';
					}*/
			?>
			
			<main class="event">
				<div class="container">
					<div class="left">
						<form id="form-ticket" class="form br-3">
							<h2>
								<i class="fa fa-ticket"></i>
								Ingressos
							</h2>
							<div class="vl"></div>
							<ul>
								<?php
									$html = '';
									$time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
									$arrayTicketsDay = $event->getTicketsDayArray();
									$priceActually = 0;
									
									// CACHE EVENT
										$arrayTicketsDayCache = is_null($eventCache) ? NULL : $eventCache->getTicketsDayArray();
										
									for($i = 0, $tam = count($arrayTicketsDay); $i < $tam; $i++){
										$html_TicketDay = '';
										$disabled = '';
										$disabledIcon = '';
										if($arrayTicketsDay[$i]->getDay() < $time){
											$disabled = ' disabled="disabled"';
											$disabledIcon = '<i class="fa fa-lock" title="Dia de evento finalizado"></i>';
										}
										
										$ticketDayId = $arrayTicketsDay[$i]->getId();
										$ticketDayDay = $arrayTicketsDay[$i]->getDayPage();
										$ticketDayTime = $arrayTicketsDay[$i]->getTimeSeccondsToBrazilDate();
										$checked = $arrayTicketsDay[$i]->cacheVerifySameId($arrayTicketsDayCache) && empty($disabled) ? 'checked="checked"' : '';
										$showWrapTicket = $arrayTicketsDay[$i]->cacheVerifySameId($arrayTicketsDayCache) && empty($disabled) ? 'style="display:block;"' : '';
										$html_TicketDay .= <<<HTML
											<li>
												<div class="box-day">
													<label>
														<input type="checkbox" id="ft-day-$ticketDayId" $disabled $checked />
														&nbsp; $ticketDayDay
														<span>
															<i class="fa fa-clock-o"></i>
															$ticketDayTime
															$disabledIcon
														</span>
													</label>
													<div class="box-ticket-type" $showWrapTicket>
HTML;
										$arrayTickets = $arrayTicketsDay[$i]->getTicketArray();
										$arrayTicketsCache = $arrayTicketsDay[$i]->cacheGetTicketArrayBySameId($arrayTicketsDayCache);
										$html_Ticket = '';
										for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
											if($arrayTickets[$j]->getStatus() == 0) // DEACTIVATE TICKET
												continue;
										
											$ticketId = $arrayTickets[$j]->getId();
											$ticketName = $arrayTickets[$j]->getName();
											$ticketPrice = $arrayTickets[$j]->getPrice($event->getTicketTypeTaxes());
											$ticketPriceHumanFormated = $arrayTickets[$j]->getPriceHumanFormated($event->getTicketTypeTaxes(), false, false, true);
											$ticketValidDaysLabel = $arrayTickets[$j]->getTicketValidDaysHumanFormat();
											
											// CACHE
												if(is_null($arrayTickets[$j]->cacheGetQtdMaxSameId($arrayTicketsCache))){
													$ticketOptionsQtdMax = $arrayTickets[$j]->getQtdMax()->getOptions(false, $arrayTickets[$j]->getQtdMax()->getItem(), 1);
												}
												else{
													$arrayTickets[$j]->getQtdMax()->setItem($arrayTickets[$j]->cacheGetQtdMaxSameId($arrayTicketsCache)->getItem());
													$ticketOptionsQtdMax = $arrayTickets[$j]->getQtdMax()->getOptions(true, 0, 1);
													$priceActually += ($ticketPrice * $arrayTickets[$j]->getQtdMax()->getItem());
												}
												$checked = $arrayTickets[$j]->cacheVerifySameId($arrayTicketsCache) ? 'checked="checked"' : '';
											
											// SOLD OUT
												$html_SoldOut = '';
												$disabledSoldOut = '';
												if($arrayTickets[$j]->getNumberTicketSold() >= $arrayTickets[$j]->getQtdMaxSell()){
													$disabledSoldOut = empty($disabled) ? 'disabled="disabled"' : '';
													$html_SoldOut = <<<HTML
														<div class="cl"></div>
														<div class="sold-out br-3">
															<i class="fa fa-bolt"></i> Esgotado!
														</div>
HTML;
												}
											
											if($event->getTicketTypeCharge() == 2){
												$html_Ticket .= <<<HTML
													<div class="wrap-ticket br-3">
														<label>
															<input type="checkbox" id="ft-day-$ticketDayId-$ticketId" $disabled $disabledSoldOut $checked />
															<input type="hidden" id="ft-day-$ticketDayId-$ticketId-p" value="$ticketPrice" />
															$ticketName ($ticketPriceHumanFormated)
														</label>
														<select id="ft-day-$ticketDayId-$ticketId-s" class="br-3" $disabled $disabledSoldOut>
															$ticketOptionsQtdMax
														</select>
														<div class="cl"></div>
														<div class="valid-days br-3">
															<i class="fa fa-calendar-o"></i> $ticketValidDaysLabel
														</div>
														$html_SoldOut
													</div>
HTML;
											}
											else{
												$html_Ticket .= <<<HTML
													<div class="wrap-ticket br-3">
														<label>
															<input type="radio" id="ft-day-$ticketDayId-$ticketId" name="ft-day-$ticketDayId-radio" $disabled $disabledSoldOut $checked />
															$ticketName
														</label>
														<div class="cl"></div>
														<div class="valid-days br-3">
															<i class="fa fa-calendar-o"></i> $ticketValidDaysLabel
														</div>
														$html_SoldOut
													</div>
HTML;
											}
										}
										
										// NO TICKET ALLOWED FOR THAT DAY
											if(empty($html_Ticket))
												continue;
										
										$html_TicketDay .= <<<HTML
													$html_Ticket
													</div>
												</div>
											</li>
											<li class="vl"></li>
HTML;
										$html .= $html_TicketDay;
									}
									echo $html;
									
									if($user->getId() != $ownerEvent->getId()
										&& is_object($event->getTicketDayNext())
										&& $event->getNumberTicketSold() < $event->getTicketMaximum()){
										if($event->getTicketTypeCharge() == 2){
								?>
											<li class="box-total">
												<?php
													echo 'R$ '.str_replace('.', ',', sprintf('%.2f', $priceActually));
												?>
											</li>
											<li class="vl"></li>
											<li>
												<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlEvent.php|vu-get-event-payment-form|<?php echo $event->getId(); ?>" id="ft-buy-ticket" class="bt-form" title="Comprar">
													<i class="fa fa-credit-card"></i>
													Comprar
												</a>
											</li>
								<?php
										}
										else{
								?>
											<li>
												<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlEvent.php|vu-get-event-payment-form|<?php echo $event->getId(); ?>" id="ft-buy-ticket" class="bt-form" title="Obter ingresso">
													<i class="fa fa-ticket"></i>
													Obter ingresso
												</a>
											</li>
								<?php
										}
									}
									else if(!is_object($event->getTicketDayNext())){
								?>
										<li class="box-end-event">
											Evento finalizado
										</li>
								<?php
									}
									else if($event->getNumberTicketSold() >= $event->getTicketMaximum()){
								?>
										<li class="box-end-event">
											<i class="fa fa-bolt"></i>
											Esgotado!
										</li>
								<?php
									}
									else{
								?>
										<li class="box-end-event">
											Proprietário do evento
										</li>
								<?php
									}
								?>
							</ul>
						</form>
						
						<?php
							// USERS CONFIRMED
							if(count($event->getUsersConfirmedArray()) > 0 && $event->getShowUserConfirmed() == 1){
						?>
								<div class="box-confirmed br-3">
									<h2>
										<i class="fa fa-users"></i>
										Já confirmaram!
										<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlEvent.php|get-users-confirm|<?php echo $event->getId(); ?>" class="bt-call-popup" title="Visualizar todos">
											<i class="fa fa-check"></i>
											todos
										</a>
									</h2>
									<div class="vl"></div>
									
									<div class="box-users">
										<?php
											$arrayUsersConfirmed = $event->getUsersConfirmedArray();
											$html = '';
											for($i = 0, $tamI = count($arrayUsersConfirmed); $i < $tamI; $i++){
												$userName = $arrayUsersConfirmed[$i]->getName();
												$userUrl = __PATH_FOR_LONG_URL__.$arrayUsersConfirmed[$i]->getUrlSufix();
												$userImg = $arrayUsersConfirmed[$i]->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/44-44/');
												$html .= ' <a href="'.$userUrl.'" title="'.$userName.'"> <img src="'.$userImg.'" width="44" height="44" /> </a> ';
											}
											echo $html;
										?>
									</div>
								</div>
						<?php
							}
							
							// PHOTOS
							$photosArray = $event->getPhotosArray();
							if(is_array($photosArray) && count($photosArray) > 0){
						?>
								<div class="box-photos br-3">
									<h2>
										<i class="fa fa-camera-retro"></i>
										Fotos
									</h2>
									<div class="vl"></div>
									
									<div class="box-img-photos">
										<?php
											$html = '';
											for($i = 0, $tam = count($photosArray); $i < $tam; $i++){
												$photoNormal = __PATH_FOR_LONG_URL__.'img/event/photo/normal/'.$photosArray[$i]->getName();
												$photo = __PATH_FOR_LONG_URL__.'img/event/photo/44-44/'.$photosArray[$i]->getName();
												echo '<a href="'.$photoNormal.'" class="photo"> <img src="'.$photo.'" width="44" height="44" /> </a>';
											}
										?>
									</div>
								</div>
						<?php
							}
						?>
					</div>
					
					
					<div class="center">
						<div class="title">
							<div class="conf-title br-3">
								<?php
									// STATUS EVENT
										if($user->getId() == $event->getUser()->getId() && ($event->getStatus() != 1 || $event->getStatusBankAccount() != 1)){
											$statusClass = $event->getStatusClass();
											$statusLabel = $event->getStatusLabel();
								?>
											<div class="status <?php echo $statusClass; ?>">
												<i class="fa fa-circle"></i>
												<?php echo $statusLabel; ?> <em>(somente você pode ver esse evento)</em>
											</div>
								<?php
										}
								
									// FAVORITE
										if($user->getId() != $event->getUser()->getId()){
											if($event->getIsFavorite() == 1){
								?>
												<a class="favorite selected" title="Remover de favoritos" href="<?php echo __PATH_FOR_LONG_URL__; ?>/package/ctrl/CtrlEvent.php|vu-event-favoriting|<?php echo $event->getId(); ?>">
													<i class="fa fa-star"></i>
												</a>
								<?php
											}
											else{
								?>
												<a class="favorite" title="Favoritar" href="<?php echo __PATH_FOR_LONG_URL__; ?>/package/ctrl/CtrlEvent.php|vu-event-favoriting|<?php echo $event->getId(); ?>">
													<i class="fa fa-star"></i>
												</a>
								<?php
											}
										}
								?>
								
								<div class="box-phone">
									<i class="fa fa-phone"></i> <?php echo __VUUP_PHONE__; ?>
								</div>
								
								<h1><?php echo $event->getName(); ?></h1>
								
								<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlEvent.php|vu-get-map|<?php echo $event->getId(); ?>" class="bt-call-popup" title="local">
									<i class="fa fa-map-marker"></i>
									<?php echo $event->getAddress()->getCity().', '.$event->getAddress()->getState()->getLabelCodeItem(); ?>
								</a>
								<br />
								<?php
									// CATEGORY
										echo '<a href="'.__PATH_FOR_LONG_URL__.'busca?ec='.$event->getCategory()->getItem().'" class="more-info"> <i class="fa fa-tag"></i> '.$event->getCategory()->getLabelItem().' </a>';
									
									// TAGS
										$tags = $event->getTagsPage(false, true, '#');
										if(!empty($tags) && strlen($tags) > 0){
											echo '<br />'.$tags;
										}
								?>
							</div>
						</div>
						
						<div class="box-share br-3">
							<div class="social-button facebook">
								<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode($event->getFullUrl()); ?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=350312291805346" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; width: 100px;" allowTransparency="true"></iframe>
							</div>
							<div class="social-button twitter">
								<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $event->getFullUrl(); ?>" data-via="@vuup" data-lang="en">Tweet</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							</div>
							<div class="social-button google-plus">
								<div class="g-plusone" data-size="medium"></div>
								<script type="text/javascript">
								  window.___gcfg = {lang: 'pt-BR'};
								  (function() {
									var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
									po.src = 'https://apis.google.com/js/platform.js';
									var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
								  })();
								</script>
							</div>
							<div class="social-button linkedin">
								<script src="//platform.linkedin.com/in.js" type="text/javascript">
								  lang: pt_BR
								</script>
								<script type="IN/Share" data-counter="right"></script>
							</div>
						</div>
					
					
						<div class="main-content">
							<div class="box-description br-3">
								<h2>
									<i class="fa fa-align-left"></i>
									Descrição
								</h2>
								<div class="vl"></div>
								
								<div class="description">
									<?php
										echo $event->getDescriptionPage();
									?>
								</div>
							</div>
							
							<?php
								if(strlen($event->getVideo()->getUrl()) > 0){
							?>
									<div class="box-video br-3">
										<h2>
											<i class="fa fa-video-camera"></i>
											Vídeo
										</h2>
										<div class="vl"></div>
										<?php
											echo $event->getVideo()->getUrlIframe();
										?>
									</div>
							<?php
								}
							?>
							
							<div class="box-comments br-3">
								<h2>
									<i class="fa fa-comment"></i>
									Comentários
								</h2>
								<div class="vl"></div>
								
								<div class="fb-comments" data-href="<?php echo $event->getFullUrl(); ?>" data-width="515" data-numposts="100" data-colorscheme="light"></div>
								<div id="fb-root"></div>
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=350312291805346&version=v2.0";
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
							</div>
						</div>
					</div>
					
					<div class="right">
						<div class="box-organizer br-3">
							<h2>
								<i class="fa fa-building"></i>
								Organizador
							</h2>
							<div class="vl"></div>
							
							<div class="box-data">
								<a href="<?php echo __PATH_FOR_LONG_URL__.$event->getUser()->getUrlSufix(); ?>" class="organizer-img-link" title="Página de organizador">
									<img src="<?php echo $event->getUser()->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/70-70/'); ?>" alt="<?php echo $event->getUser()->getName(); ?>" class="br-3" width="70" height="70" />
								</a>
								<div class="more-info">
									<a href="<?php echo __PATH_FOR_LONG_URL__.$event->getUser()->getUrlSufix(); ?>" title="<?php echo $event->getUser()->getName(); ?>">
										<i class="fa fa-user"></i>
										<?php echo $event->getUser()->getName(); ?>
									</a>
									<br />
									<a href="<?php echo __PATH_FOR_LONG_URL__.$event->getUser()->getUrlSufix(); ?>" title="<?php echo $event->getUser()->getName(); ?>">
										<?php echo $event->getUser()->getNumberEventLabel(); ?>
									</a>
									<br />
									<a href="<?php echo __PATH_FOR_LONG_URL__.$event->getUser()->getUrlSufix(); ?>" title="<?php echo $event->getUser()->getName(); ?>">
										<?php echo $event->getUser()->getNumberFollowerLabel(); ?>
									</a>
									<?php
										if($user->getId() != $ownerEvent->getId()){
									?>
											<br />
											<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-get-form-organizer-event-message-in-page|<?php echo $event->getId(); ?>" class="bt-call-popup" title="<?php echo $event->getUser()->getName(); ?>">
												<i class="fa fa-envelope"></i>
												Falar com organizador
											</a>
									<?php
										}
									?>
								</div>
								<div class="cl"></div>
							</div>
						</div>
						
						<div class="box-more-information">
							<img src="<?php echo $event->getImgBannerUrl(__PATH_FOR_LONG_URL__.'img/event/250-300/'); ?>" alt="<?php echo $event->getName(); ?>" class="br-3" width="250" height="300" />
						
							<div class="box-location br-3">
								<h2>
									<i class="fa fa-map-marker"></i>
									Local evento
								</h2>
								<div class="vl"></div>
								
								<div id="map"></div>
								<div class="vl"></div>
								<p>
									<i class="fa fa-map-marker"></i>
									<?php echo $event->getAddress(); ?>
									<br />
									<a href="http://maps.google.com?q=(<?php echo $event->getAddress()->getMap()->getLatitude().','.$event->getAddress()->getMap()->getLongitude(); ?>)" target="_blank" title="Visualizar no Google Maps">Visualizar no Google Maps</a>
								</p>
							</div>
						</div>
					</div>
					<div class="cl"></div>
				</div>
			</main>
		<!-- MAIN -->
		
		
		
		
		

		
		<!-- start FOOTER -->
			<?php
				require_once(__PATH__.'/view/footer/footer.php');
				require_once(__PATH__.'/view/footer/js.php');
			?>
			<script type="text/javascript" src="https://js.iugu.com/v2"></script>
			<script type="text/javascript">
				// MAP
					map('map', <?php echo $event->getAddress()->getMap()->getLatitude().','.$event->getAddress()->getMap()->getLongitude(); ?>, 13, 'roadmap', true, '<?php echo __PATH_FOR_LONG_URL__; ?>img/system/icon/pin.png');
				
			</script>
		<!-- end FOOTER -->
	</body>
</html>