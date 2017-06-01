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
		<meta name="keywords" content="MIBEC, Ministério Betel em Células" />
		<meta name="description" content="Ministério Betel em Células" />
		
		<title>Contato</title>
		
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
					<h1>Contato</h1>
					
					<form id="form-contact">
						<fieldset>
							<input type="text" id="fc-name" placeholder="*Nome" />
							<input type="text" id="fc-email" placeholder="*Email" />
							<select id="fc-subject">
								<?php
									echo $html_ContactSubject;
								?>
							</select>
							<textarea id="fc-message" placeholder="*Mensagem (mínimo de 5 caracteres)"></textarea>
							<div class="box-count-post">
								<i class="icon-keyboard"></i>
								<span id="fc-message-count">1000</span>
								<span class="number">1000</span>
							</div>
							<div class="cl"></div>
							<a href="#" class="submit" id="fc-submit-contact" title="Enviar">
								Enviar
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