<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="vuup" />
		<meta name="description" content="Vuup, sua plataforma online de compra e venda de ingressos com pagamentos respondidos na hora." />
		<meta property="og:url" content="<?php echo trim(__PATH_FULL_PREFIX__, '/'); ?>" />
		<meta property="og:title" content="Vuup Events" />
		<meta property="og:description" content="Vuup, sua plataforma online de compra e venda de ingressos com pagamentos respondidos na hora." />
		<meta property="og:image" content="<?php echo __PATH_FULL_PREFIX__.'img/system/logo/vuup-og.png'; ?>" />
		<meta property="fb:app_id" content="350312291805346" />
		
		<title>Vuup</title>
		
		<!-- start CSS -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end CSS -->
	</head>
	
	
	
	<body>
		<!-- HEADER -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- HEADER -->
		
		
		
		
		
		<!-- HEADER INDEX (SLIDE) -->
			<section class="header-index" style="height: 400px; background-image: url(img/banner/normal/rockn-glow.jpg); background-size: cover; background-position: center;">
				<a href="<?php echo __PATH__; ?>goparty/2014-10-02-14-00-14/rock-n-glow-11" class="go-party-bt br-3" target="_blank" title="Comprar">
					<i class="fa fa-ticket"></i>
					Comprar
				</a>
				<!-- div class="container">
					<div class="left">
						<h1>Encontrar e organizar eventos ficou fácil.</h1>
						<div class="sub-title">Encontre os melhores eventos ou organize um evento e venda seus ingressos online.</div>
						
						<?php
							if($user->getId() == 0){
						?>
								<div class="box-buttons">
									<a href="inscrever-se" class="br-3" title="Criar conta">Criar conta</a>
									<span>(é gratuito)</span>
								</div>
						<?php
							}
							else{
						?>
								<div class="box-buttons">
									<a href="dashboard?criar-evento" class="br-3" title="Criar evento">Criar evento</a>
									<span>(é gratuito)</span>
								</div>
						<?php
							}
						?>
					</div>
					
					<div class="right">
						<div class="box-slide" style="background-image: url(img/system/bg/vuup-banner.jpg);"></div>
						<div class="box-slide" style="background-image: url(img/banner/512-192/oktober-rio.jpg); background-size: contain;"></div>
						<div class="box-slide-control">
							<a href="#" class="selected"></a>
							<a href=""></a>
							<a href=""></a>
							<a href=""></a>
						</div>
					</div>
					
					<div class="cl"></div>
				</div -->
			</section>
		<!-- HEADER INDEX (SLIDE) -->
		
		
		
		
		
		<!-- MAIN -->
			<main>
				<div class="box-mode-search">
					<h2>
						Encontre eventos próximos...
						<!-- a href="#" title="Mude sua localização">Mude sua localização</a -->
					</h2>
					
					<a class="list-bt br-3" title="Lista" href="box-list">
						<i class="fa fa-align-justify"></i>
					</a>
					<a class="grade-bt br-3 selected" title="Grade" href="box-grade">
						<i class="fa fa-th-large"></i>
					</a>
					<div class="cl"></div>
				</div>
				
				<div class="left">
					<div class="box-filter">
						<?php
							require_once(__PATH__.'/view/search-form.php');
						?>
					</div>
				</div>
				
				<div class="right">
					<div class="box-events">
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
									Nenhum evento disponível.
								</p>
						<?php
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
		
		<script type="text/javascript" src="//assets.zendesk.com/external/zenbox/v2.6/zenbox.js"></script>
		<style type="text/css" media="screen, projection">
		  @import url(//assets.zendesk.com/external/zenbox/v2.6/zenbox.css);
		</style>
		<script type="text/javascript">
		  if (typeof(Zenbox) !== "undefined") {
			Zenbox.init({
			  dropboxID:   "20148109",
			  url:         "https://vuup.zendesk.com",
			  tabTooltip:  "Ajuda",
			  tabImageURL: "https://p4.zdassets.com/external/zenbox/images/tab_pt_help_right.png",
			  tabColor:    "#f4190b",
			  tabPosition: "Right"
			});
		  }
		</script>
	</body>
</html>