<?php
	if($return == 1){
?>
		<div id="box-modal-content">
			<h2>
				<i class="icon-envelope"></i>
				Inscri��o na lista de emails MIBEC - Minist�rio Betel em C�lulas
				<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			</h2>
			<div class="content">
				<strong>Voc� esta quase confirmado.</strong>
				<br /><br />
				Foi enviado ao seu email (<strong><?php echo $emailList->getUser()->getEmail(); ?></strong>) uma mensagem de confirma��o.
				<br />
				Basta clicar no link de confirma��o contido no email.
				<br /><br /><br />
				<i>At� breve.</i>
			</div>
			<div class="copyright"> &copy; MIBEC - Minist�rio Betel em C�lulas </div>
		</div>
<?php
	}
	else if($return == 2){
?>
		<div id="box-modal-content">
			<h2>
				<i class="icon-envelope"></i>
				Inscri��o na lista de emails MIBEC - Minist�rio Betel em C�lulas
				<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			</h2>
			<div class="content">
				O cadastro de seu email foi realizado com sucesso.
				<br /><br />
				Seja bem vindo(a) a lista de emails MIBEC - Minist�rio Betel em C�lulas
				<br />
				Frequentemente vamos lhe enviar emails que engrandecem a pessoa.
				<br /><br /><br />
				<i>At� breve.</i>
			</div>
			<div class="copyright"> &copy; MIBEC - Minist�rio Betel em C�lulas </div>
		</div>
<?php
	}
	else if($return == 0){
?>
		<div id="box-modal-content">
			<h2>
				<i class="icon-envelope"></i>
				Inscri��o na lista de emails MIBEC - Minist�rio Betel em C�lulas
				<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			</h2>
			<div class="content">
				Tudo bem?
				<br /><br />
				Esse email j� est� cadastrado,
				<br />
				Por�m <b>Ainda N�o Foi Confirmado</b>.
				<br /><br />
				Caso n�o tenha recebido o email, entre na �rea de <a href="./contato" title="Contato">Contato</a> do site e solicite a libera��o do email (informando se email).
				<br /><br /><br />
				<i>At� breve.</i>
			</div>
			<div class="copyright"> &copy; MIBEC - Minist�rio Betel em C�lulas </div>
		</div>
<?php
	}
	else if($return == 3){
?>
		<div id="box-modal-content">
			<h2>
				<i class="icon-envelope"></i>
				Inscri��o na lista de emails MIBEC - Minist�rio Betel em C�lulas
				<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			</h2>
			<div class="content">
				Tudo bem?
				<br /><br />
				Esse email foi <b>Descadastrado</b> da lista de emails de MIBEC.
				<br /><br />
				Para poder voltar a receber os emails do site voc� dever� entrar em contato
				pelo email <b>mibec@gmail.com.br</b> e utilizando o email <b><?php echo $emailList->getUser()->getEmail()?></b>.
				<br />
				No corpo da mensagem informe que voc� quer a reativa��o de seu email na lista do site.
				<br /><br />
				Outra maneira � voc� acessar o email de confirma��o de inscri��o enviado a voc� anteriormente
				e ent�o clicar no link de confirma��o novamente.
				<br /><br /><br />
				<i>At� breve.</i>
			</div>
			<div class="copyright"> &copy; MIBEC - Minist�rio Betel em C�lulas </div>
		</div>
<?php
	}
?>