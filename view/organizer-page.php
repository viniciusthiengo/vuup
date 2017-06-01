<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="<?php echo $ownerEvent->getName(); ?>" />
		<meta name="description" content="<?php echo $ownerEvent->getDescription(); ?>" />
		<meta property="og:url" content="<?php echo __PATH_FULL_PREFIX__.$ownerEvent->getUrlSufix(); ?>" />
		<meta property="og:title" content="<?php echo $ownerEvent->getName(); ?>" />
		<meta property="og:description" content="<?php echo 'Página de '.$ownerEvent->getName().' no Vuup'; ?>" />
		<meta property="og:image" content="<?php echo $ownerEvent->getImageUrl(__PATH_FULL_PREFIX__.'img/user/240-240/'); ?>" />
		<meta property="fb:app_id" content="350312291805346" />
		
		<title><?php echo $ownerEvent->getName(); ?></title>
		
		<!-- start CSS -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end CSS -->
	</head>
	
	
	
	<body id="organizer-page">
		<!-- HEADER -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- HEADER -->
		
		
		
		
		
		<!-- MAIN -->
			<!-- div id="box-wallpaper"></div -->
			<main class="event organizer">
				<span class="id-organizer"><?php echo $ownerEvent->getId(); ?></span>
				<div class="container">
					<div class="left">
						<div class="box-organizer-data br-3">
							<h2>
								<?php echo $ownerEvent->getName(); ?>
							</h2>
							<div class="vl"></div>
							
							<img src="<?php echo $ownerEvent->getImageUrl(__PATH_FULL_PREFIX__.'img/user/240-240/'); ?>" width="240" height="240" />
							<div class="vl"></div>
							
							<ul>
								<li>
									<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlEvent.php|vu-get-events-page|<?php echo $ownerEvent->getId(); ?>" class="bt-load-content" title="Eventos">
										<i class="fa fa-beer"></i>
										Eventos
									</a>
								</li>
								<?php
									if($user->getId() != $ownerEvent->getId()){
								?>
										<li class="vl"></li>
										<li>
											<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-get-form-organizer-event-message-in-page|<?php echo $ownerEvent->getId(); ?>" class="bt-call-popup" title="Entrar em contato">
												<i class="fa fa-envelope"></i>
												Entrar em contato
											</a>
										</li>
								<?php
									}
								?>
							</ul>
						</div>
						
						<?php
							// FOLLOWINGS
							if(count($ownerEvent->getFollowingsArray()) > 0){
						?>
								<div class="box-confirmed br-3">
									<h2>
										<i class="fa fa-check-circle"></i>
										Seguido por (<?php echo $ownerEvent->getNumberFollower(); ?>)
										<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-get-followings-page|<?php echo $ownerEvent->getId(); ?>" class="bt-load-content" title="Visualizar todos">
											<i class="fa fa-check"></i>
											todos
										</a>
									</h2>
									<div class="vl"></div>
									
									<div class="box-users">
										<?php
											$html = '';
											$arrayFollowings = $ownerEvent->getFollowingsArray();
											
											for($i = 0, $tamI = count($arrayFollowings); $i < $tamI; $i++){
												$name = $arrayFollowings[$i]->getUserFollowing()->getName();
												$userUrl = __PATH_FOR_LONG_URL__.$arrayFollowings[$i]->getUserFollowing()->getUrlSufix();
												$imgUrl = $arrayFollowings[$i]->getUserFollowing()->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/44-44/');
												$html .= <<<HTML
													<a href="$userUrl" title="$name">
														<img src="$imgUrl" width="44" height="44" />
													</a>
HTML;
											}
											echo $html;
										?>
									</div>
								</div>
						<?php
							}
							
							// FOLLOWERS
							if(count($ownerEvent->getFollowersArray()) > 0){
						?>
								<div class="box-confirmed br-3">
									<h2>
										<i class="fa fa-certificate"></i>
										Seguindo (<?php echo $ownerEvent->getNumberFollowing(); ?>)
										<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-get-followers-page|<?php echo $ownerEvent->getId(); ?>" class="bt-load-content" title="Visualizar todos">
											<i class="fa fa-check"></i>
											todos
										</a>
									</h2>
									<div class="vl"></div>
									
									<div class="box-users">
										<?php
											$html = '';
											$arrayFollowers = $ownerEvent->getFollowersArray();
											
											for($i = 0, $tamI = count($arrayFollowers); $i < $tamI; $i++){
												$name = $arrayFollowers[$i]->getUserFollower()->getName();
												$userUrl = __PATH_FOR_LONG_URL__.$arrayFollowers[$i]->getUserFollower()->getUrlSufix();
												$imgUrl = $arrayFollowers[$i]->getUserFollower()->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/44-44/');
												$html .= <<<HTML
													<a href="$userUrl" title="$name">
														<img src="$imgUrl" width="44" height="44" />
													</a>
HTML;
											}
											echo $html;
										?>
									</div>
								</div>
						<?php
							}
						?>
					</div>
					
					
					<div class="center">
						<?php
							if($user->getId() != $ownerEvent->getId()){
								$followLabel = $ownerEvent->getIsFollow() == 1 ? 'Deixar de seguir' : 'Seguir';
						?>
								<div class="box-follow-bt br-3">
									<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-user-follow|<?php echo $ownerEvent->getId(); ?>" class="br-3" title="<?php echo $followLabel; ?>">
										<?php echo $followLabel; ?>
									</a>
								</div>
								<div class="cl"></div>
						<?php
							}
							
							if(strlen($ownerEvent->getDescription()) > 0){
						?>
								<div class="box-description br-3">
									<h2>
										<i class="fa fa-file"></i>
										Sobre <?php echo $ownerEvent->getName(); ?>
									</h2>
									<div class="vl"></div>
									
									<div class="description">
										<?php echo $ownerEvent->getDescriptionPage(); ?>
									</div>
								</div>
						<?php
							}
						?>
						
						<div class="box-description br-3 container-dinamic">
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
							
							<?php
								require_once(__PATH__.'/view/event-list-make.php');
								
								if(count($arrayObj) > 0){
									echo $htmlGrade;
									echo $htmlList;
								}
								else{
							?>
									<p class="no-content">
										<i class="fa fa-frown-o"></i>
										Nenhum evento ainda criado por <?php echo $ownerEvent->getName(); ?>.
									</p>
							<?php
								}
							?>
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
			<script type="text/javascript">
				//map('map', -22.912213, -43.188778, 13, 'roadmap', true, '<?php echo __PATH_FOR_LONG_URL__; ?>img/system/icon/pin.png');
			</script>
		<!-- end FOOTER -->
	</body>
</html>