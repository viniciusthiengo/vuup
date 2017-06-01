<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="vuup" />
		<meta name="description" content="" />
		<meta property="og:image" content="" />
		
		<title>Login</title>
		
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
				<!-- a href="#" class="bt-facebook br-3" title="Entre com sua conta do Facebook">
					<i class="fa fa-facebook-square"></i> &nbsp;
					Entre com sua conta do Facebook
				</a>
				
				<div class="box-or">
					<span class="line-or"></span>
					ou
					<span class="line-or"></span>
				</div -->
				
				<form id="form-login" class="form br-3 form-login">
					<div class="top">
						<h2>Conecte-se</h2>
						Ou, <a href="<?php echo __PATH_FOR_LONG_URL__; ?>inscrever-se" title="Inscrever-se">se inscrever</a>
					</div>
					
					<div class="box-field">
						<input type="text" id="fl-email" class="br-3" placeholder="Email" maxlength="100" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o email válido
						</span>
					</div>
					<div class="box-field">
						<input type="password" id="fl-password" class="br-3" placeholder="Senha" maxlength="30" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe a senha válida
						</span>
					</div>
					
					<div class="box-field">
						<button type="submit" id="fl-submit-login" class="br-3 bt-form" title="Entrar">Entrar</button>
						<div class="cl"></div>
					</div>
					
					<div class="bottom">
						<label>
							<input type="checkbox" id="fl-remember" value="1" checked="checked" />
							Mantenha-me conectado
						</label>
						
						<a href="<?php echo __PATH_FOR_LONG_URL__; ?>esqueceu-a-senha" title="Esqueceu a senha?">
							Esqueceu a senha?
						</a>
						<div class="cl"></div>
					</div>
				</form>
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