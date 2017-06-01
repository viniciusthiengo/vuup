<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="MIBEC, Minist�rio Betel em C�lulas" />
		<meta name="description" content="Descadastrando email da lista de emails de MIBEC" />
		
		<title>Descadastrando de email</title>
		
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
					<h1>Email descadastrado com sucesso</h1>
					
					<?php
						if(!is_null($emailList->getUser())){
					?>
							<p>
								Opa! Blz?
							</p>
							<p>
								<u>Seu email (<b><?php echo $emailList->getUser()->getEmail(); ?></b>) est� <b>Descadastrado</b> da lista do blog.</u>
								<br />
								Entendo a sua escolha e acho nobre voc� se retirar quando o blog n�o mais lhe acrescenta algo,
								eu mesmo fa�o isso frequentemente na Web.
							</p>
							<br />
							<p>
								Sinta-se a vontade para voltar quando quiser.
							</p>
					<?php
						}
						else{
					?>
							<p>
								Nenhum email encontrado para o c�digo informado (<b><?php echo $emailList->getHash(); ?></b>).
								<br />
								<br />
								Verifique se o link de descadastro de email clicado � realmente o link correto.
							</p>
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