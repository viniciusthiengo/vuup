<?php
	if($return == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Recuperação de senha</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 200px;">
				<p>
					<i class="fa fa-warning"></i>
					Você tem que esperar que o último pedido de recuperação de senha complete 24 horas para realizar um novo pedido,
					porém enquanto o pedido anterior não vence você ainda pode utilizá-lo.
				</p>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
	else if($return == 1){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Recuperação de senha</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 200px;">
				<p>
					<i class="fa fa-warning"></i>
					Um email com o link para reiniciar a senha foi enviado ao email informado. Você tem até 24 horas para utilizar esse link de
					reinicialização de senha. Depois desse tempo você terá que repetir o processo vindo a esse formulário novamente
				</p>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
	else if($return == 2){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Recuperação de senha</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 200px;">
				<p>
					<i class="fa fa-warning"></i>
					Email não encontrado no sistema Web de MIBEC (Ministério Betel em Células).
				</p>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>