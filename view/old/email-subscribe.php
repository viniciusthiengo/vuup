<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="MIBEC, Ministério Betel em Células" />
		<meta name="description" content="Confirmação de email na lista de emails de MIBEC" />
		
		<title>Confirmação de email</title>
		
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
					<h1>Confirmação de email concluída com sucesso</h1>
					
					<?php
						if(!is_null($emailList->getUser())){
					?>
							<p>
								Opa! Blz?
							</p>
							<p>
								<u>Seu email (<b><?php echo $emailList->getUser()->getEmail(); ?></b>) está confirmado na lista do blog.</u>
								<br />
								Uma vez por semana estarei lhe enviando um email sobre tudo que está rolando aqui no blog
								sobre Desenvolvimento Web, Android e Avaliação de Sites.
							</p>
							<br />
							<p>
								Queria ressaltar também que sempre em paralelo eu estou desenvolvendo algum projeto pessoal
								relacionado a Desenvolvimento Web e Mobile, logo pode ser que a frequencia de um email por semana
								possa ser "burlada" quando esses projetos terminam, pois vou convindá-lo(a) a "destrinchá-lo" para
								ver o que achou.
							</p>
					<?php
						}
						else{
					?>
							<p>
								Nenhum email encontrado para o código informado (<b><?php echo $emailList->getHash(); ?></b>).
								<br />
								<br />
								Verifique se o link de confirmação clicado é realmente o link correto.
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