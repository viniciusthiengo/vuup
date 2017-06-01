<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="vuup" />
		<meta name="description" content="" />
		<meta property="og:image" content="" />
		
		<title>Confirmação de cadastro</title>
		
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
				<div class="free-content">
					<?php
						if($user->getReturn() == 1 && $user->getStatus() == 1){
					?>
							<i class="fa fa-thumbs-o-up"></i>
							Ok <b><?php echo $user->getName(); ?></b>,
							<br /><br />
							Sua conta está confirmada no vuup.com.br
							<br />
							Inicie criando eventos, comprando ingressos, seguindo outros usuários, ...
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>login" title="acessando sua conta">acessando sua conta</a>
							<br /><br />
							Bem-vindo (a) ao vuup!
					<?php
						}
						else if($user->getReturn() == 0 && $user->getStatus() == 1){
					?>
							<i class="fa fa-thumbs-o-up"></i>
							Ok <b><?php echo $user->getName(); ?></b>,
							<br /><br />
							Sua conta já está confirmada no vuup.com.br
							<br />
							Acesse pela
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>login" title="página de login">página de login</a>
							<br /><br />
							Att,
							<br />
							Equipe vuup
					<?php
						}
						else{
					?>
							<i class="fa fa-frown-o"></i>
							Olá,
							<br /><br />
							Desculpe, mas nenhuma conta vuup foi identificada pela confirmação indicada <b><?php echo $_GET['subpage']; ?></b>
							<br />
							Para fazer parte da comunidade de eventos e vendas de ingressos online <b>vuup.com.br</b>
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>inscrever-se" title="cadastre-se">cadastre-se</a>
							<br /><br />
							Att,
							<br />
							Equipe vuup
					<?php
						}
					?>
				</div>
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