<?php
	if($return == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Recupera��o de senha</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 200px;">
				<p>
					<i class="fa fa-warning"></i>
					Voc� tem que esperar que o �ltimo pedido de recupera��o de senha complete 24 horas para realizar um novo pedido,
					por�m enquanto o pedido anterior n�o vence voc� ainda pode utiliz�-lo.
				</p>
			</div>
			<div class="copyright">&copy; MIBEC - Minist�rio Betel em C�lulas <?php echo date('Y'); ?></div>
		</div>
<?php
	}
	else if($return == 1){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Recupera��o de senha</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 200px;">
				<p>
					<i class="fa fa-warning"></i>
					Um email com o link para reiniciar a senha foi enviado ao email informado. Voc� tem at� 24 horas para utilizar esse link de
					reinicializa��o de senha. Depois desse tempo voc� ter� que repetir o processo vindo a esse formul�rio novamente
				</p>
			</div>
			<div class="copyright">&copy; MIBEC - Minist�rio Betel em C�lulas <?php echo date('Y'); ?></div>
		</div>
<?php
	}
	else if($return == 2){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Recupera��o de senha</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 200px;">
				<p>
					<i class="fa fa-warning"></i>
					Email n�o encontrado no sistema Web de MIBEC (Minist�rio Betel em C�lulas).
				</p>
			</div>
			<div class="copyright">&copy; MIBEC - Minist�rio Betel em C�lulas <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>