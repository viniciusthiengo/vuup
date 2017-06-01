<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="<?php echo $ticket->getEvent()->getName().','.$ticket->getName().','.$ticket->getUser()->getName(); ?>" />
		<meta name="description" content="<?php echo 'Ingresso '.$ticket->getEvent()->getName().' - '.$ticket->getName().' - '.$ticket->getUser()->getName(); ?>" />
		<meta property="og:url" content="<?php echo trim(__PATH_FULL_PREFIX__, '/'); ?>" />
		<meta property="og:title" content="<?php echo 'Ingresso '.$ticket->getEvent()->getName().' - '.$ticket->getName().' - '.$ticket->getUser()->getName(); ?>" />
		<meta property="og:description" content="<?php echo 'Ingresso '.$ticket->getEvent()->getName().' - '.$ticket->getName().' - '.$ticket->getUser()->getName(); ?>" />
		<meta property="og:image" content="<?php echo __PATH_FULL_PREFIX__.'img/system/logo/vuup-og.png'; ?>" />
		<meta property="fb:app_id" content="350312291805346" />
		
		<title>
			<?php
				echo 'Ingresso '.$ticket->getEvent()->getName().' - '.$ticket->getName().' - '.$ticket->getUser()->getName();
			?>
		</title>
		
		<!-- start CSS -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end CSS -->
	</head>
	
	
	
	<body id="ticket-page">
		<div class="wrap-ticket-print">
			<div class="vuup">
				VUUP.com.br /
				(21) 4063-4141
			</div>
			<div class="wrap">
				<div class="ticket-label content">
					INGRESSO
				</div>
				<div class="title content">
					<?php echo $ticket->getEvent()->getName(); ?>
					<span>(<?php echo $ticket->getEvent()->getUser()->getName(); ?>)</span>
				</div>
				<div class="type content">
					<i class="fa fa-ticket"></i>
					<?php echo $ticket->getName(); ?>
				</div>
				<div class="address content">
					<i class="fa fa-map-marker"></i>
					<?php echo $ticket->getEvent()->getAddress(); ?>
				</div>
				<div class="price content">
					<?php
						$price = $ticket->getEvent()->getTicketTypeCharge() == 1 ? 'Entrada gratuita' : $ticket->getPriceHumanFormated($ticket->getEvent()->getTicketTypeTaxes(), false, false, true);
						echo $price;
					?>
				</div>
				<div class="expiration content">
					<i class="fa fa-calendar-o"></i>
					<?php
						$ticketDayLabel = $ticket->getTicketValidDaysHumanFormat().' a partir de:';
						$ticketDayDay = $ticket->getTicketDay()->getDayPage(false).', '.$ticket->getTicketDay()->getDaySeccondsToBrazilDate();
						$ticketDayTime = $ticket->getTicketDay()->getTimeSeccondsToBrazilDate();
						echo $ticketDayLabel.' <b>'.$ticketDayDay.'</b> <i class="fa fa-clock-o"></i> <b>'.$ticketDayTime.'</b>';
					?>
				</div>
				<div class="expiration content">
					<i class="fa fa-caret-square-o-right"></i>
					Adquirido em: <?php echo date('d\/m\/Y \à\s H\hi', $ticket->getPayment()->getTime());?>
				</div>
				<div class="expiration content">
					<i class="fa fa-user"></i>
					<?php
						$name = $ticket->getUser()->getName();
						/*if($ticket->getUserRepass()->getId() > 0){
							$name = $ticket->getUserRepass()->getName();
						}*/
						echo '<b>'.$name.'</b>';
					?>
				</div>
			</div>
			<div class="wrap-code">
				<div class="phone">
					<i class="fa fa-phone"></i>
					<?php
						echo '('.$ticket->getEvent()->getPhone()->getCode().') '.$ticket->getEvent()->getPhone()->getNumber();
					?>
				</div>
				<img src="<?php echo $ticket->getQRCodeImg(); ?>" height="140" />
				<div>
					<?php echo $ticket->getIdTicketPaymentAsCode(); ?>
				</div>
			</div>
			<div class="cl"></div>
		</div>
		<a href="#" title="Imprimir ingresso" id="print-button">
			<i class="fa fa-print"></i>
			Imprimir ingresso
		</a>
		
		<!-- start FOOTER -->
			<script type="text/javascript" src="../js/jquery.js"></script>
			<script type="text/javascript">
				window.print();
				$('#print-button').click(function(e){
					e.preventDefault();
					window.print();
				});
			</script>
		<!-- end FOOTER -->
	</body>
</html>