<?php
	// CONTACT SUBJECT
		$contactSubject = new ContactSubject();
		$html_ContactSubject = $contactSubject->getOptions();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				//require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
			<link type="text/css" rel="stylesheet" href="<?php echo __PATH_FOR_LONG_URL__; ?>css/mibec-mobile.css" media="all" />
		<!-- end TOP -->
		<style type="text/css">
			
		</style>
	</head>
	
	
	
	<body>
		<!-- start CENTER -->
			<section id="center">
				<div class="left page">
					<h1>Contato</h1>
					
					<form id="form-contact" class="is-mobile">
						<fieldset>
							<div class="wrap-input">
								<input type="text" id="fc-name" placeholder="*Nome" />
							</div>
							<div class="wrap-input">
								<input type="text" id="fc-email" placeholder="*Email" />
							</div>
							<div class="wrap-input">
								<div class="subject">
									<select id="fc-subject">
										<?php
											echo $html_ContactSubject;
										?>
									</select>
								</div>
							</div>
							<div class="wrap-input">
								<textarea id="fc-message" placeholder="*Mensagem (mínimo de 5 caracteres)"></textarea>
							</div>
							<div class="wrap-input">
								<div class="box-count-post">
									<i class="icon-keyboard"></i>
									<span id="fc-message-count">1000</span>
									<span class="number">1000</span>
								</div>
							</div>
							<div class="cl"></div>
							<a href="#" class="submit" id="fc-submit-contact" title="Enviar">
								Enviar
							</a>
							<div class="cl"></div>
						</fieldset>
					</form>
				</div>
			</section>
		<!-- end CENTER -->
		
		
		
      

		
		<!-- start FOOTER -->
			<script type="text/javascript">
				MibecJavaScript.destroyProgressBar();
			</script>
			<?php
				require_once(__PATH__.'/view/footer/js.php');
			?>
			<script type="text/javascript">
				adjustInputForm();
				
				$(window).resize(function(){
					setTimeout(function(){
						adjustInputForm();
					}, 1000);
					
				});
				
				function sendName(name){ $('#fc-name').val(name); }
				function sendEmail(email){ $('#fc-email').val(email); }
				
				function adjustInputForm(){
					$('#fc-name').css({ 'width': ($('#fc-name').parents('.wrap-input').width() - 20)+'px' });
					$('#fc-email').css({ 'width': ($('#fc-email').parents('.wrap-input').width() - 20)+'px' });
					$('#fc-message').css({ 'width': ($('#fc-message').parents('.wrap-input').width() - 20)+'px' });
					$('#fc-submit-contact').css({ 'width': ($('#fc-message').parents('.wrap-input').width() - 20)+'px' });
				}
			</script>
		<!-- end FOOTER -->
	</body>
</html>