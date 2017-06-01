<?php
	if($return == 1){
?>
		<div id="box-modal-content">
			<h2>
				<i class="icon-envelope"></i>
				Inscrição na lista de emails MIBEC - Ministério Betel em Células
				<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			</h2>
			<div class="content">
				<strong>Você esta quase confirmado.</strong>
				<br /><br />
				Foi enviado ao seu email (<strong><?php echo $emailList->getUser()->getEmail(); ?></strong>) uma mensagem de confirmação.
				<br />
				Basta clicar no link de confirmação contido no email.
				<br /><br /><br />
				<i>Até breve.</i>
			</div>
			<div class="copyright"> &copy; MIBEC - Ministério Betel em Células </div>
		</div>
<?php
	}
	else if($return == 2){
?>
		<div id="box-modal-content">
			<h2>
				<i class="icon-envelope"></i>
				Inscrição na lista de emails MIBEC - Ministério Betel em Células
				<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			</h2>
			<div class="content">
				O cadastro de seu email foi realizado com sucesso.
				<br /><br />
				Seja bem vindo(a) a lista de emails MIBEC - Ministério Betel em Células
				<br />
				Frequentemente vamos lhe enviar emails que engrandecem a pessoa.
				<br /><br /><br />
				<i>Até breve.</i>
			</div>
			<div class="copyright"> &copy; MIBEC - Ministério Betel em Células </div>
		</div>
<?php
	}
	else if($return == 0){
?>
		<div id="box-modal-content">
			<h2>
				<i class="icon-envelope"></i>
				Inscrição na lista de emails MIBEC - Ministério Betel em Células
				<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			</h2>
			<div class="content">
				Tudo bem?
				<br /><br />
				Esse email já está cadastrado,
				<br />
				Porém <b>Ainda Não Foi Confirmado</b>.
				<br /><br />
				Caso não tenha recebido o email, entre na área de <a href="./contato" title="Contato">Contato</a> do site e solicite a liberação do email (informando se email).
				<br /><br /><br />
				<i>Até breve.</i>
			</div>
			<div class="copyright"> &copy; MIBEC - Ministério Betel em Células </div>
		</div>
<?php
	}
	else if($return == 3){
?>
		<div id="box-modal-content">
			<h2>
				<i class="icon-envelope"></i>
				Inscrição na lista de emails MIBEC - Ministério Betel em Células
				<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			</h2>
			<div class="content">
				Tudo bem?
				<br /><br />
				Esse email foi <b>Descadastrado</b> da lista de emails de MIBEC.
				<br /><br />
				Para poder voltar a receber os emails do site você deverá entrar em contato
				pelo email <b>mibec@gmail.com.br</b> e utilizando o email <b><?php echo $emailList->getUser()->getEmail()?></b>.
				<br />
				No corpo da mensagem informe que você quer a reativação de seu email na lista do site.
				<br /><br />
				Outra maneira é você acessar o email de confirmação de inscrição enviado a você anteriormente
				e então clicar no link de confirmação novamente.
				<br /><br /><br />
				<i>Até breve.</i>
			</div>
			<div class="copyright"> &copy; MIBEC - Ministério Betel em Células </div>
		</div>
<?php
	}
?>