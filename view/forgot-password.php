<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="vuup, recuperação de senha" />
		<meta name="description" content="Recuperação de senha em Vuup." />
		<meta property="og:url" content="<?php echo trim(__PATH_FULL_PREFIX__, '/'); ?>" />
		<meta property="og:title" content="Recuperação de senha" />
		<meta property="og:description" content="Recuperação de senha em Vuup" />
		<meta property="og:image" content="<?php echo __PATH_FULL_PREFIX__.'img/system/logo/vuup-og.png'; ?>" />
		<meta property="fb:app_id" content="350312291805346" />
		
		<title>Esqueceu a senha</title>
		
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
		
		
		
		
		
		<!-- MAIN -->
			<main>
				<?php
					if(is_null($forgotPassword)){
				?>
						<form id="form-login" class="form br-3 form-forgot-password">
							<div class="top">
								<h2>Recuperação de senha</h2>
							</div>
							
							<div class="box-field">
								<input type="text" id="fl-email" class="br-3" placeholder="Email cadastrado na conta" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Email inválido
								</span>
							</div>
							
							<div class="box-field">
								<button type="submit" id="fl-submit-forgot-password" class="br-3 bt-form" title="Iniciar processo">Iniciar processo de recuperação</button>
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Usuário não identificado
								</span>
							</div>
							
							<div class="bottom">
								<p>
									<i class="fa fa-shield"></i>
									Um email informando o processo necessário para a recuperação de senha será enviado
									ao email cadastrado em sua conta vuup. Sempre que você receber um email de recuperação
									de senha que não tenha solicitado apenas o ignore, pois nenhuma configuração será alterada
									em sua conta.
								</p>
							</div>
						</form>
				<?php
					}
					else if($forgotPassword->getId() > 0 && $forgotPassword->getStatus() == 1){
				?>
						<form id="form-login" class="form br-3 form-reset-password">
							<div class="top">
								<h2>Recuperação de senha</h2>
							</div>
							
							<div class="box-field">
								<input type="password" id="fl-new-password" class="br-3" placeholder="Nova senha" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Nova senha inválida (mínimo de 8 caracteres)
								</span>
							</div>
							
							<div class="box-field">
								<input type="password" id="fl-confirm-password" class="br-3" placeholder="Confirmação de senha" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Confirmação de senha inválida
								</span>
							</div>
							
							<div class="box-field">
								<input type="hidden" id="fl-id" value="<?php echo $forgotPassword->getUser()->getId(); ?>" />
								<input type="hidden" id="fl-hash" value="<?php echo $forgotPassword->getHash(); ?>" />
								<button type="submit" id="fl-submit-reset-password" class="br-3 bt-form" title="Resetar senha">Resetar senha</button>
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Token inválido
								</span>
							</div>
							
							<div class="bottom">
								<p>
									<i class="fa fa-shield"></i>
									Preencha os dados acima para criar uma nova senha e assim recuperar seu acesso em Vuup
								</p>
							</div>
						</form>
				<?php
					}
					else if($forgotPassword->getId() > 0 && $forgotPassword->getStatus() == 0){
				?>
						<form id="form-login" class="form br-3 form-reset-password">
							<div class="top">
								<h2>Recuperação de senha</h2>
							</div>
							<div class="ops-title">Ops!</div>
							<div class="bottom">
								<p>
									<i class="fa fa-shield"></i>
									Token de recuperação de senha já utilizado. Tente recuperar a senha novamente para obter um novo
									token. <a href="<?php echo __PATH_FOR_LONG_URL__; ?>esqueceu-a-senha" title="Recuperar senha">Recuperar senha</a>
								</p>
							</div>
						</form>
				<?php
					}
					else if($forgotPassword->getId() == 0 && $forgotPassword->getStatus() == 0){
				?>
						<form id="form-login" class="form br-3 form-reset-password">
							<div class="top">
								<h2>Recuperação de senha</h2>
							</div>
							<div class="ops-title">Ops!</div>
							<div class="bottom">
								<p>
									<i class="fa fa-shield"></i>
									Token de recuperação de senha desconhecido. Tente recuperar a senha para obter um novo
									token. <a href="<?php echo __PATH_FOR_LONG_URL__; ?>esqueceu-a-senha" title="Recuperar senha">Recuperar senha</a>
								</p>
							</div>
						</form>
				<?php
					}
				?>
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