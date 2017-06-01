<?php
	// ACTUAL NAV
		$urlDashboard = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$arrayNavSelected = array('create-event'=>(preg_match('/(\?criar-evento){1}$/', $urlDashboard) ? ' selected' : ''),
								'tickets'=>(!preg_match('/(\?criar-evento){1}$/', $urlDashboard) ? ' selected' : ''));
?>
<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="vuup" />
		<meta name="description" content="" />
		<meta property="og:image" content="" />
		
		<title>Vuup</title>
		
		<!-- start CSS -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end CSS -->
	</head>
	
	
	
	<body id="dashboard-page">
		<!-- HEADER -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- HEADER -->
		
		
		
		
		
		
		<!-- MAIN -->
			<main>
				<div class="left">
					<ul class="nav-dashboard br-3">
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlEvent.php|vu-get-ticket-active-dashboard" class="br-3<?php echo $arrayNavSelected['tickets']; ?>" title="Ingressos">
								<i class="fa fa-ticket"></i>
								Ingressos
							</a>
						</li>
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlEvent.php|vu-get-event-dashboard" class="br-3<?php echo $arrayNavSelected['create-event']; ?>" title="Eventos">
								<i class="fa fa-beer"></i>
								Eventos
							</a>
						</li>
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlEvent.php|vu-get-event-favorite-dashboard" class="br-3" title="Favoritos">
								<i class="fa fa-star"></i>
								Favoritos
							</a>
						</li>
						<!-- li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-get-promoter-dashboard" class="br-3" title="Eu promoter">
								<i class="fa fa-user"></i>
								Eu promoter
							</a>
						</li -->
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-get-followings-dashboard" class="br-3" title="Seguido por">
								<i class="fa fa-check-circle"></i>
								Seguido por (<?php echo $user->getNumberFollower(); ?>)
							</a>
						</li>
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-get-followers-dashboard" class="br-3" title="Seguindo">
								<i class="fa fa-certificate"></i>
								Seguindo (<?php echo $user->getNumberFollowing(); ?>)
							</a>
						</li>
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>package/ctrl/CtrlUser.php|vu-get-user-dashboard" class="br-3" title="Minhas configurações">
								<i class="fa fa-cogs"></i>
								Minhas configurações
							</a>
						</li>
					</ul>
				</div>
				
				<div class="right">
					<div class="needed-info-container">
						<?php
							if(substr_count($user->getImageUrl(), 'default') > 0){
						?>
								<div class="needed-info-box br-3">
									<i class="fa fa-image"></i>
									Você ainda precisa completar seu perfil com uma <b>Foto de Perfil</b>.
									<a href="./package/ctrl/CtrlUser.php|vu-get-user-dashboard" class="open-new-content" title="Acessar minhas configurações">
										Acessar minhas configurações
									</a>
								</div>
						<?php
							}
						?>
					</div>
					
					<div class="container-form br-3">
						<?php
							$isDashboard = true;
							if(preg_match('/(criar-evento){1}$/', $urlDashboard)){
								require_once(__PATH__.'/view/event-make.php');
							}
							else{
								$ticket = new Ticket();
								$ticket->setUser($user);
								$ticket->setLimit(__LIMIT_TICKETS__);
								$arrayObj = $aplEvent->getPaymentTickets($ticket);
								
								require_once(__PATH__.'/view/ticket-make.php');
							}
						?>
					</div>
				</div>
				
				<div class="cl"></div>
			</main>
		<!-- MAIN -->
		
		
		
		
		

		
		<!-- start FOOTER -->
			<?php
				require_once(__PATH__.'/view/footer/footer.php');
				require_once(__PATH__.'/view/footer/js.php');
			?>
		<!-- end FOOTER -->
	</body>
</html>