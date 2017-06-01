<?php
	// SEARCH
		$text = '';
		if(is_object($search)){
			$text = $search->getText();
		}
	
	// ACTUAL PAGE
		$arraySelected = array('como-funciona'=>'',
								'inscrever-se'=>'',
								'login'=>'',
								'criar-evento'=>'');		
		$arraySelected[$_GET['page']] = ' selected';
?>
<header>
	<div class="container">
		<a href="<?php echo __PATH_FOR_LONG_URL__; ?>" class="logo" title="vuup">
			<img src="<?php echo __PATH_FOR_LONG_URL__; ?>img/system/logo/vuup-136x39.png" width="136" height="39" title="vuup" />
		</a>
		<form id="form-search-event" class="form" action="<?php echo __PATH_FOR_LONG_URL__; ?>busca">
			<input type="search" class="br-3" id="fse-search" placeholder="Buscar" name="q" value="<?php echo $text; ?>" />
			<button type="submit" class="bt-form br-3" id="fse-button" title="Buscar">
				<i class="fa fa-search"></i>
			</button>
			<div class="cl"></div>
		</form>
		
		<?php
			if($user->getId() > 0 && !preg_match('/^(confirmar){1}$/', $_GET['page'])){
		?>
				<div class="box-user-connected">
					<img src="<?php echo __PATH_FOR_LONG_URL__.$user->getImageUrl('img/user/39-39/'); ?>" class="br-3" width="39" height="39" />
					<div class="mask-shadow"></div>
					<ul>
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>dashboard" title="Área de administrador">
								<i class="fa fa-gear"></i>
								Área de administrador
							</a>
						</li>
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__.$user->getUrlSufix(); ?>" title="Perfil público">
								<i class="fa fa-desktop"></i>
								Perfil público
							</a>
						</li>
						<li>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>sair" title="Sair">
								<i class="fa fa-sign-out"></i>
								Sair
							</a>
						</li>
					</ul>
					<div class="cl"></div>
				</div>
		<?php
			}
		?>
		
		<nav class="menu">
			<ul>
				<li><b class="br-3">vuup call <i class="fa fa-phone"></i> <?php echo __VUUP_PHONE__; ?></b></li>
				<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>como-funciona" class="br-3<?php echo $arraySelected['como-funciona']; ?>" title="Como funciona">Como funciona</a></li>
				<?php
					if($user->getId() == 0 || preg_match('/^(confirmar){1}$/', $_GET['page'])){
				?>
						<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>inscrever-se" class="br-3<?php echo $arraySelected['inscrever-se']; ?>" title="Criar conta">Criar conta</a></li>
						<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>login" class="br-3<?php echo $arraySelected['login']; ?>" title="Login">Login</a></li>
						<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>login" class="br-3 bt-create-event<?php echo $arraySelected['criar-evento']; ?>" title="Criar evento">Criar evento</a></li>
				<?php
					}
					else{
				?>
						<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>dashboard?criar-evento" class="br-3 bt-create-event<?php echo $arraySelected['criar-evento']; ?>" title="Criar evento">Criar evento</a></li>
				<?php
					}
				?>
			</ul>
		</nav>
		<div class="cl"></div>
	</div>
</header>
<div id="modal">
</div>

