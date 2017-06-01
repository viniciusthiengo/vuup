<?php
	if(!empty($emailWidget)){
		$label = $emailWidget->getLabel();
		$status = $emailWidget->getStatus() == 1 ? 'checked="checked"' : '';
	}
	else{
		$label = '';
		$status = 'checked="checked"';
	}
	
	if(strcasecmp('get-form-email-list', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Email
				<a href="package/ctrl/CtrlAdmin.php|get-form-report-email-list" class="inner-link border-radius" title="Relatório emails lista">Relatório emails lista</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-report-email-send-list" class="inner-link border-radius" title="Relatório emails enviados">Relatório emails enviados</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-send-email-list" class="inner-link border-radius" title="Enviar email">Enviar email</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-email-list-list" class="inner-link border-radius" title="Lista">Lista</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-email-list-widget" class="inner-link select border-radius" title="Widget">Widget</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Informações</div>
						<input type="text" id="fca-title-p" placeholder="*Rótulo" value="<?php echo $label; ?>" />
						<br />
						<label>
							<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
							Coletor de email disponível
						</label>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-update-email-widget" title="Atualizar widget">
					Atualizar widget
				</a>
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-email-list-widget', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" placeholder="*Rótulo" value="<?php echo $label; ?>" />
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Coletor de email disponível
				</label>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-email-widget" title="Atualizar widget">
			Atualizar widget
		</a>
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-email-list-list', $_POST['method']) == 0 || empty($_POST['method'])){
		$tam = count($arrayEmailList);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_EMAIL_LIST__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-email-list|'.$arrayEmailList[0]->getTypeSort().'|'.$arrayEmailList[0]->getNumSort().'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// EMAIL LIST
			$html_EmailList = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEmailList[$i]->getId();
				$email = $arrayEmailList[$i]->getUser()->getEmail();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEmailList[$i]->getTime());
				$confirm = $arrayEmailList[$i]->getStatusLabel();
				$open = $arrayEmailList[$i]->getOpen() == 1 ? 'Sim' : 'Não';
				
				$html_EmailList .= <<<HTML
					<tr id="em-$id">
						<td>$email</td>
						<td>$time</td>
						<td>$confirm</td>
						<td>$open</td>
					</tr>
HTML;
			}
		
		if(empty($html_EmailList)){
			$html_EmailList = <<<HTML
				<tr>
					<td colspan="4">Nenhum email encontrado</td>
				</tr>
HTML;
		}
?>
		<fieldset>
			<table class="email-list">
				<tr class="titles">
					<th><a href="sort-email-list|1" class="border-radius sort-link" title="Email">Email <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list|2" class="border-radius select sort-link" title="Data / horário">Data / horário <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list|3" class="border-radius sort-link" title="Confirmou">Confirmou <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list|4" class="border-radius sort-link" title="Abriu">Abriu <i class="fa fa-caret-down"></i></a></th>
				</tr>
				<?php
					echo $html_EmailList;
				?>
			</table>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(preg_match('/^(load-more-email-list|sort-email-list){1}$/', $_POST['method'])){
		$tam = count($arrayEmailList);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_EMAIL_LIST__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-email-list|'.$arrayEmailList[0]->getTypeSort().'|'.$arrayEmailList[0]->getNumSort().'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// EMAIL LIST
			$html_EmailList = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEmailList[$i]->getId();
				$email = $arrayEmailList[$i]->getUser()->getEmail();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEmailList[$i]->getTime());
				$confirm = $arrayEmailList[$i]->getStatusLabel();
				$open = $arrayEmailList[$i]->getOpen() == 1 ? 'Sim' : 'Não';
				
				$html_EmailList .= <<<HTML
					<tr id="em-$id">
						<td>$email</td>
						<td>$time</td>
						<td>$confirm</td>
						<td>$open</td>
					</tr>
HTML;
			}
		
		echo $html_EmailList;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-send-email-list', $_POST['method']) == 0){
		$tam = count($arrayEmailList);
		
		// EMAIL LIST
			$html_EmailList = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEmailList[$i]->getId();
				$email = $arrayEmailList[$i]->getUser()->getEmail();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEmailList[$i]->getTime());
				$confirm = $arrayEmailList[$i]->getStatusLabel();
				$open = $arrayEmailList[$i]->getOpen() == 1 ? 'Sim' : 'Não';
				
				$html_EmailList .= <<<HTML
					<tr id="em-$i">
						<td><input id="el-$id" type="checkbox" name="send-email-chk" checked="checked" value="$i" /></td>
						<td>$email</td>
						<td>Não enviado</td>
					</tr>
HTML;
			}
		
		if(empty($html_EmailList)){
			$html_EmailList = <<<HTML
				<tr>
					<td colspan="3">Nenhum email confirmado encontrado.</td>
				</tr>
HTML;
		}
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Informações de envio</div>
				<input type="text" id="fca-urllink-p" placeholder="*Label de relatório" />
				<input type="text" id="fca-title-p" placeholder="*Assunto" />
			</div>
			
			<div class="box-section">
				<div class="title">Corpo</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
			</div>
			
			<table class="email-list">
				<tr class="titles">
					<th>Enviar</th>
					<th>Email</th>
					<th>Status envio</th>
				</tr>
				<?php
					echo $html_EmailList;
				?>
			</table>
		</fieldset>
		<br />
		<a href="#" class="submit" id="fca-submit-send-email-to-list" title="Enviar emails">
			Enviar emails
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-report-email-send-list', $_POST['method']) == 0){
		$tam = count($arrayEmailSent);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_EMAIL_SENT__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-email-sent" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// EMAIL SENT
			$html_EmailSent = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEmailSent[$i]->getId();
				$name = $arrayEmailSent[$i]->getName();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEmailSent[$i]->getTime());
				$user = is_object($arrayEmailSent[$i]->getUser()) ? $arrayEmailSent[$i]->getUser()->getName() : 'Criador indefinido';
				
				$html_EmailSent .= <<<HTML
					<li id="em-$id">
						<div class="info">
							<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
							<div class="cl"></div>
							$name
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-one-report-email-send-list|$id" class="edit-post-bt inner-link border-radius" title="Acessar">Acessar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
		
		if(empty($html_EmailSent)){
			$html_EmailSent = <<<HTML
				<li>
					<i class="fa fa-warning"></i>
					Nenhum registro de email enviado encontrado.
				</li>
HTML;
		}
?>
		<fieldset>
			<ul class="sortable edit-post projects">
				<?php
					echo $html_EmailSent;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(strcasecmp('load-more-email-sent', $_POST['method']) == 0){
		$tam = count($arrayEmailSent);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_EMAIL_SENT__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-email-sent" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// EMAIL SENT
			$html_EmailSent = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEmailSent[$i]->getId();
				$name = $arrayEmailSent[$i]->getName();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEmailSent[$i]->getTime());
				$user = is_object($arrayEmailSent[$i]->getUser()) ? $arrayEmailSent[$i]->getUser()->getName() : 'Criador indefinido';
				
				$html_EmailSent .= <<<HTML
					<li id="em-$id">
						<div class="info">
							<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
							<div class="cl"></div>
							$name
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-one-report-email-send-list|$id" class="edit-post-bt inner-link border-radius" title="Acessar">Acessar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
			
		echo $html_EmailSent;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-one-report-email-send-list', $_POST['method']) == 0){
		// USERS EMAIL SENT
			$arrayUsersEmail = $emailSent->getArrayUsersEmailWasSent();
			$tam = count($arrayUsersEmail);
			$html_UsersEmail = '';
			for($i = 0; $i < $tam; $i++){
				$email = $arrayUsersEmail[$i]->getUser()->getEmail();
				$statusEmail = $arrayUsersEmail[$i]->getStatus();
				$openEmail = $arrayUsersEmail[$i]->getOpen();
				$status = $arrayUsersEmail[$i]->getUser()->getStatus();
				
				$html_UsersEmail .= <<<HTML
					<tr>
						<td>$email</td>
						<td>$statusEmail</td>
						<td>$openEmail</td>
						<td>$status</td>
					</tr>
HTML;
			}
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-report-email-send-list" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Informações de envio</div>
				<input type="text" id="fca-url-p" placeholder="*Label de relatório" value="<?php echo $emailSent->getName(); ?>" disabled="disabled" />
				<input type="text" id="fca-title-p" placeholder="*Assunto" value="<?php echo $emailSent->getSubject(); ?>" disabled="disabled" />
			</div>
			
			<div class="box-section">
				<div class="title">Corpo</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"><?php echo $emailSent->getContent(); ?></textarea>
			</div>
			
			<table class="email-list">
				<tr class="titles">
					<th><a href="sort-email-list-sent|5" class="border-radius select sort-link" title="Email">Email <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list-sent|6" class="border-radius sort-link" title="Status envio">Status envio <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list-sent|7" class="border-radius sort-link" title="Status abertura">Status abertura <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list-sent|8" class="border-radius sort-link" title="Status email">Status email <i class="fa fa-caret-down"></i></a></th>
				</tr>
				<?php
					echo $html_UsersEmail;
				?>
			</table>
		</fieldset>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $emailSent->getId(); ?>" />
<?php
	}
	else if(preg_match('/^(sort-email-list-sent){1}$/', $_POST['method'])){
		// USERS EMAIL SENT
			$arrayUsersEmail = $emailSent->getArrayUsersEmailWasSent();
			$tam = count($arrayUsersEmail);
			$html_UsersEmail = '';
			for($i = 0; $i < $tam; $i++){
				$email = $arrayUsersEmail[$i]->getUser()->getEmail();
				$statusEmail = $arrayUsersEmail[$i]->getStatus();
				$openEmail = $arrayUsersEmail[$i]->getOpen();
				$status = $arrayUsersEmail[$i]->getUser()->getStatus();
				
				$html_UsersEmail .= <<<HTML
					<tr>
						<td>$email</td>
						<td>$statusEmail</td>
						<td>$openEmail</td>
						<td>$status</td>
					</tr>
HTML;
			}
		
		echo $html_UsersEmail;
		echo '|SPDATA|';
	}
	else if(strcasecmp('get-form-report-email-list', $_POST['method']) == 0){
		$tam = count($arrayEmailList);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_EMAIL_LIST__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-email-list-report|'.$arrayEmailList[0]->getTypeSort().'|'.$arrayEmailList[0]->getNumSort().'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// EMAIL LIST
			$html_EmailList = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEmailList[$i]->getId();
				$email = $arrayEmailList[$i]->getUser()->getEmail();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEmailList[$i]->getTime());
				$confirm = $arrayEmailList[$i]->getStatusLabel();
				$totalSent = $arrayEmailList[$i]->getTotalSent();
				$totalOpened = $arrayEmailList[$i]->getTotalOpened();
				$html_DeleteColumn = $user->getType() == 1 ? '<td><a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-email-list|$id" class="delete-email" title="Deletar email"><i class="fa fa-times-circle"></i></a></td>' : '';
				
				$html_EmailList .= <<<HTML
					<tr id="em-$id">
						<td>$email</td>
						<td>$time</td>
						<td>$confirm</td>
						<td>$totalSent</td>
						<td>$totalOpened</td>
						$html_DeleteColumn
					</tr>
					
HTML;
			}
			$html_DeleteColumn = $user->getType() == 1 ? '<th></th>' : '';
			$num_Colspan = $user->getType() == 1 ? 6 : 5;
		
		if(empty($html_EmailList)){
			$html_EmailList = <<<HTML
				<tr>
					<td colspan="$num_Colspan">Nenhum email encontrado</td>
				</tr>
HTML;
		}
?>
		<fieldset>
			<table class="email-list">
				<tr class="titles">
					<th><a href="sort-email-list-report|1" class="border-radius sort-link" title="Email">Email <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list-report|2" class="border-radius select sort-link" title="Cadastro">Cadastro <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list-report|3" class="border-radius sort-link" title="Status email">Status email <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list-report|9" class="border-radius sort-link" title="Emails enviados">Emails enviados <i class="fa fa-caret-down"></i></a></th>
					<th><a href="sort-email-list-report|10" class="border-radius sort-link" title="Emails abertos">Emails abertos <i class="fa fa-caret-down"></i></a></th>
					<?php
						echo $html_DeleteColumn;
					?>
				</tr>
				<?php
					echo $html_EmailList;
				?>
			</table>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(preg_match('/^(load-more-email-list-report|sort-email-list-report){1}$/', $_POST['method'])){
		$tam = count($arrayEmailList);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_EMAIL_LIST__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-email-list-report|'.$arrayEmailList[0]->getTypeSort().'|'.$arrayEmailList[0]->getNumSort().'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// EMAIL LIST
			$html_EmailList = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEmailList[$i]->getId();
				$email = $arrayEmailList[$i]->getUser()->getEmail();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEmailList[$i]->getTime());
				$confirm = $arrayEmailList[$i]->getStatusLabel();
				$totalSent = $arrayEmailList[$i]->getTotalSent();
				$totalOpened = $arrayEmailList[$i]->getTotalOpened();
				$html_DeleteColumn = $user->getType() == 1 ? '<td><a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-email-list|$id" class="delete-email" title="Deletar email"><i class="fa fa-times-circle"></i></a></td>' : '';
				
				$html_EmailList .= <<<HTML
					<tr id="em-$id">
						<td>$email</td>
						<td>$time</td>
						<td>$confirm</td>
						<td>$totalSent</td>
						<td>$totalOpened</td>
						$html_DeleteColumn
					</tr>
HTML;
			}
		
		echo $html_EmailList;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-ok-delete-email-list', $_POST['method']) == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar email</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão desse email todos os dados referentes a ele serão excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-email-list" class="ok-delete-button border-radius" title="Deletar email">
					Deletar email
				</a>
				<input type="hidden" id="fca-id" value="<?php echo $_POST['id']; ?>" />
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>