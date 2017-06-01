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
		<meta name="keywords" content="Recupera��o de senha, MIBEC, Minist�rio Betel em C�lulas" />
		<meta name="description" content="Recupera��o de senha do sistema Web MIBEC, Minist�rio Betel em C�lulas" />
		
		<title>Recupera��o de senha</title>
		
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
					<h1>Recupera��o de senha</h1>
					
					<form id="form-contact" class="forget-password">
						<fieldset>
							<div class="box-section info-text">
								<i class="fa fa-bullhorn"></i>
								Um email com o link para voc� fornecer sua nova senha ser� enviado ao email cadastrado em sua conta, voc� ter� 24 horas para poder utilizar o link ainda com validade.
							</div>
							<input type="text" id="fc-email" placeholder="*Email" />
							<div class="cl"><br /></div>
							<a href="#" class="submit" id="fc-submit-forget-password" title="Enviar link">
								Enviar link
							</a>
							<div class="cl"></div>
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