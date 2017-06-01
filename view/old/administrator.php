<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="MIBEC, Ministério Betel em Células" />
		<meta name="description" content="Ministério Betel em Células" />
		
		<title>Administrador</title>
		
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				//require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end TOP -->
	</head>
	
	
	
	<body>
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- end TOP -->
		
		
		
		
		<!-- start CENTER -->
			<section id="center">
				<div class="left page">
					<h1>
						Administrador
						<?php
							if($admin->getId() > 0){
						?>
								<a href="package/ctrl/CtrlAdmin.php|sign-out" class="sign-out border-radius" title="Sair"><i class="icon-signout"></i> Sair</a>
						<?php
							}
						?>
					</h1>
					<?php
						if($admin->getId() == 0){
					?>
						<div class="support-text admin">
							<form id="form-contact">
								<fieldset>
									<input type="text" id="fc-login" placeholder="*Login" />
									<input type="password" id="fc-password" placeholder="*Senha" />
									<div class="cl"><br /></div>
									<a href="./esqueceu-a-senha" class="forget-password" title="Esqueceu a senha?">
										Esqueceu a senha?
									</a>
									<a href="#" class="submit" id="fcadm-submit" title="Entrar">
										Entrar
									</a>
									<div class="cl"></div>
								</fieldset>
							</form>
						</div>
					<?php
						}
						else{
					?>
						<div class="nav-admin">
							<a href="package/ctrl/CtrlPost.php|get-form-post" class="out-link border-radius select" title="Post">Post</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-banner" class="out-link border-radius" title="Banners">Banners</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-page" class="out-link border-radius" title="Páginas">Páginas</a>
							<?php
								if($admin->getType() == 1){
							?>
									<a href="package/ctrl/CtrlAdmin.php|get-form-user" class="out-link border-radius" title="Usuários">Usuários</a>
							<?php
								}
							?>
							<a href="package/ctrl/CtrlAdmin.php|get-contacts" class="out-link border-radius" title="Contatos enviados">Contatos enviados</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-calendar" class="out-link border-radius" title="Calendário">Calendário</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-network-widget" class="out-link border-radius" title="Widgets">Widgets redes sociais</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-gallery-video" class="out-link border-radius" title="Galerias">Galeria</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-download" class="out-link border-radius" title="Downloads">Downloads</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-project" class="out-link border-radius" title="Projetos">Projetos</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-radio" class="out-link border-radius" title="Rádio">Rádio</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-email-list" class="out-link border-radius" title="Email">Email</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-verse-message" class="out-link border-radius" title="Versículo e mensagem">Versículo e mensagem</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-cell" class="out-link border-radius" title="Célula">Célula</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-sponsor" class="out-link border-radius" title="Patrocinadores">Patrocinadores</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-update-perfil" class="out-link border-radius" title="Atualizar perfil">Atualizar perfil</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-update-password" class="out-link border-radius" title="Alterar senha">Alterar senha</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-map" class="out-link border-radius" title="Mapa">Mapa</a>
							<a href="package/ctrl/CtrlAdmin.php|get-form-widgets" class="out-link border-radius" title="Widgets laterais">Widgets laterais</a>
						</div>
						<div class="support-text">
							<div class="content">
								<?php
									require_once(__PATH__.'view/post-form.php');
								?>
							</div>
						</div>
					<?php
						}
					?>
				</div>
				
				
				
				
				<!-- start RIGHT -->
					<?php
						require_once(__PATH__.'/view/body/right.php');
					?>
				<!-- end RIGHT -->
				<div class="cl"></div>
			</section>
		<!-- end CENTER -->
		
		
		
      

		
		<!-- start FOOTER -->
			<?php
				require_once(__PATH__.'/view/footer/footer.php');
				require_once(__PATH__.'/view/footer/js.php');
			?>
		<!-- end FOOTER -->
	</body>
</html>