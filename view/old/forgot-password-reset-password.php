<?php
	// CONTACT SUBJECT
		$contactSubject = new ContactSubject();
		$html_ContactSubject = $contactSubject->getOptions();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="Recuperação de senha, MIBEC, Ministério Betel em Células" />
		<meta name="description" content="Recuperação de senha do sistema Web MIBEC, Ministério Betel em Células" />
		
		<title>Recuperação de senha</title>
		
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
					<h1>Recuperação de senha</h1>
					
					<form id="form-contact" class="forget-password">
						<fieldset>
							<?php
								if($statusEmail > 0 && $statusLastRequest == 1){
							?>
									<div class="box-section info-text">
										<i class="fa fa-bullhorn"></i>
										Forneça sua nova senha e logo depois confirme a mesma.
									</div>
									<input type="password" id="fc-new-password" placeholder="Nova senha" />
									<input type="password" id="fc-confirm-password" placeholder="Confirmar nova senha" />
									<div class="cl"><br /></div>
									<a href="#" class="submit" id="fc-submit-update-forget-password" title="Atualizar senha">
										Atualizar senha
									</a>
									<input type="hidden" id="fc-hash" value="<?php echo $user->getHash(); ?>" />
									<div class="cl"></div>
							<?php
								}
								else if($statusEmail > 0 && $statusLastRequest == 0){
							?>
									<div class="box-section info-text">
										<i class="fa fa-bullhorn"></i>
										Já se passaram 24 horas desde que esse último pedido de recuperação de senha foi realizado.
										Para realizar uma nova recuparação de senha clique no link a seguir:
										<a href="<?php echo __PATH_FOR_LONG_URL__; ?>esqueceu-a-senha" class="forget-password" title="Realizar recuperação de senha">Realizar recuperação de senha</a>
									</div>
							<?php
								}
								else {
							?>
									<div class="box-section info-text">
										<i class="fa fa-bullhorn"></i>
										Pedido de recuperação de senha não reconhecido.
										Para realizar uma recuparação de senha clique no link a seguir:
										<a href="<?php echo __PATH_FOR_LONG_URL__; ?>esqueceu-a-senha" class="forget-password" title="Realizar recuperação de senha">Realizar recuperação de senha</a>
									</div>
							<?php
								}
							?>
						</fieldset>
					</form>
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