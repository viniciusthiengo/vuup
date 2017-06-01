<?php
	
	if(strcasecmp('get-form-user', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Usuários
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-user" class="inner-link border-radius" title="Editar usuário não admin.">Editar usuário não admin.</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-user" class="inner-link select border-radius" title="Novo">Novo</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Dados de acesso</div>
						<input type="text" id="fca-title-p" placeholder="*Nome" />
						<div style="float: left;">
							<input type="text" id="fca-email-p" placeholder="*Email (login)" />
						</div>
						<div style="float: left;">
							<input type="password" id="fca-password-p" placeholder="*Senha" />
						</div>
						<div class="cl"></div>
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Ativo
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="checkbox" id="fca-comment-available-p" checked="checked" />
							Ser alertado sobre novos comentários
						</label>
					</div>
					<div class="box-section">
						<div class="title">Tipo acesso</div>
						<label>
							<input type="radio" name="fca-type-access-p" value="1" checked="checked" />
							Administrador (acesso a edição e criação completo)
						</label>
						<br />
						<label>
							<input type="radio" name="fca-type-access-p" value="2" />
							Publicador
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Imagem de perfil</div>
						<div class="box-main-img">
							<img src="img/system/bg/post-01.png" width="100" height="100" />
							<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
							<a href="#" title="Carregar" style="margin-top: 0;">
								<i class="fa fa-cloud-upload"></i>
								Carregar imagem
							</a>
							<div class="proxy">
								Carregando...
							</div>
							<div href="#" title="Remover" class="remove border-radius">
								<i class="fa fa-trash-o"></i>
							</div>
							<div class="cl"></div>
						</div>
						<div class="box-main-img">
						</div>
						<div class="cl"></div>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-new-user" title="Criar usuário">
					Criar usuário
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-new-user', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Dados de acesso</div>
				<input type="text" id="fca-title-p" placeholder="*Nome" />
				<div style="float: left;">
					<input type="text" id="fca-email-p" placeholder="*Email (login)" />
				</div>
				<div style="float: left;">
					<input type="password" id="fca-password-p" placeholder="*Senha" />
				</div>
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Ativo
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" checked="checked" />
					Ser alertado sobre novos comentários
				</label>
			</div>
			<div class="box-section">
				<div class="title">Tipo acesso</div>
				<label>
					<input type="radio" name="fca-type-access-p" value="1" checked="checked" />
					Administrador (acesso a edição e criação completo)
				</label>
				<br />
				<label>
					<input type="radio" name="fca-type-access-p" value="2" />
					Publicador
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Imagem de perfil</div>
				<div class="box-main-img">
					<img src="img/system/bg/post-01.png" width="100" height="100" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar" style="margin-top: 0;">
						<i class="fa fa-cloud-upload"></i>
						Carregar imagem
					</a>
					<div class="proxy">
						Carregando...
					</div>
					<div href="#" title="Remover" class="remove border-radius">
						<i class="fa fa-trash-o"></i>
					</div>
					<div class="cl"></div>
				</div>
				<div class="box-main-img">
				</div>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-new-user" title="Criar usuário">
			Criar usuário
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-user', $_POST['method']) == 0){
		$tam = count($arrayUser);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_USER__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-user" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// USER TO UPDATE
			$html_User = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayUser[$i]->getId();
				$name = $arrayUser[$i]->getName();
				$image = 'img/user/50-50/'.$arrayUser[$i]->getImage()->getRealName();
				$statusIcon = $arrayUser[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
				
				$html_User .= <<<HTML
					<li id="us-$id">
						<img src="$image" width="50" height="50" />
						<div class="info">
							$name $statusIcon
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-user|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
		
		if(empty($html_User)){
			$html_User = <<<HTML
				<li>
					<i class="fa fa-warning"></i>
					Nenhum usuário não admin encontrado.
				</li>
HTML;
		}
?>
		<fieldset>
			<ul class="sortable edit-post">
				<?php
					echo $html_User;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('load-more-user', $_POST['method']) == 0){
		$tam = count($arrayUser);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_USER__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-user" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// USER TO UPDATE
			$html_User = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayUser[$i]->getId();
				$name = $arrayUser[$i]->getName();
				$image = 'img/user/50-50/'.$arrayUser[$i]->getImage()->getRealName();
				
				$html_User .= <<<HTML
					<li id="us-$id">
						<img src="$image" width="50" height="50" />
						<div class="info">
							$name
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-user|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
?>
		<?php
			echo $html_User;
			echo '|SPDATA|';
			echo $html_LoadMore;
		?>
<?php
	}
	else if(strcasecmp('get-form-update-one-user', $_POST['method']) == 0){
	
		$type = array();
		$type[] = $user->getType() == 1 ? 'checked="checked"' : '';
		$type[] = $user->getType() == 2 ? 'checked="checked"' : '';
		
		$status = $user->getStatus() == 0 ? '' : 'checked="checked"';
		$statusEmailNotification = $user->getStatusEmailNotification() == 0 ? '' : 'checked="checked"';
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-user" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Dados de acesso</div>
				<input type="text" id="fca-title-p" placeholder="*Nome" value="<?php echo $user->getName(); ?>" />
				<input type="text" id="fca-email-p" placeholder="*Email (login)" style="width: 607px;" value="<?php echo $user->getEmail(); ?>" />
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Ativo
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" <?php echo $statusEmailNotification; ?> />
					Ser alertado sobre novos comentários
				</label>
			</div>
			<div class="box-section">
				<div class="title">Tipo acesso</div>
				<label>
					<input type="radio" name="fca-type-access-p" value="1" <?php echo $type[0]; ?> />
					Administrador (acesso a edição e criação completo)
				</label>
				<br />
				<label>
					<input type="radio" name="fca-type-access-p" value="2" <?php echo $type[1]; ?> />
					Publicador
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Imagem de perfil</div>
				<div class="box-main-img">
					<img src="img/user/100-100/<?php echo $user->getImage()->getRealName(); ?>" width="100" height="100" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar" style="margin-top: 0;">
						<i class="fa fa-cloud-upload"></i>
						Carregar imagem
					</a>
					<div class="proxy">
						Carregando...
					</div>
					<div href="#" title="Remover" class="remove border-radius" style="display: block;">
						<i class="fa fa-trash-o"></i>
					</div>
					<div class="cl"></div>
				</div>
				<div class="box-main-img">
				</div>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-user" title="Atualizar usuário">
			Atualizar usuário
		</a>
		<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-user|<?php echo $user->getId(); ?>" class="submit delete" id="fca-submit-delete-user" title="Deletar usuário">
			Deletar usuário
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" id="fca-id" value="<?php echo $user->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-perfil', $_POST['method']) == 0 || empty($_POST['method'])){
		$statusEmailNotification = $user->getStatusEmailNotification() == 1 ? 'checked="checked"' : '';
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Atualizar perfil
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Dados pessoais</div>
						<div style="float: left;">
							<input type="text" id="fca-name-p" placeholder="*Nome" value="<?php echo $user->getName(); ?>" />
							<div class="cl"></div>
						</div>
						<div style="float: left;">
							<input type="text" id="fca-login-p" placeholder="*Email (login)" value="<?php echo $user->getEmail(); ?>" />
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
						<label>
							<input type="checkbox" id="fca-comment-available-p" <?php echo $statusEmailNotification; ?> />
							Ser alertado sobre novos comentários
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Imagem de perfil</div>
						<div class="box-main-img">
							<img src="img/user/100-100/<?php echo $user->getImage()->getRealName(); ?>" width="100" height="100" />
							<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
							<a href="#" title="Carregar" style="margin-top: 0;">
								<i class="fa fa-cloud-upload"></i>
								Carregar imagem
							</a>
							<div class="proxy">
								Carregando...
							</div>
							<div href="#" title="Remover" class="remove border-radius" style="display: block;">
								<i class="fa fa-trash-o"></i>
							</div>
							<div class="cl"></div>
						</div>
						<div class="box-main-img">
						</div>
						<div class="cl"></div>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-update-account" title="Atualizar perfil">
					Atualizar perfil
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-update-password', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Atualizar perfil
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Senha</div>
						<div style="float: left;">
							<input type="password" id="fca-acually-pass-p" placeholder="Senha atual" />
							<div class="cl"></div>
						</div>
						<div style="float: left;">
							<input type="password" id="fca-new-pass-p" placeholder="Nova senha" />
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-update-password" title="Atualizar senha">
					Atualizar senha
				</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete|0" class="submit delete" id="fca-submit-delete-account" title="Deletar conta">
					Deletar conta
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-ok-delete', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar conta</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 190px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão de sua conta você não mais poderá recuperar os dados, pois eles serão permanentemente excluídos.
				</p>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-account" class="border-radius" title="Deletar conta">
					Deletar conta
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-user', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar usuário</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão da conta desse usuário todos os dados dele serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-user" class="ok-delete-button border-radius" title="Deletar usuário">
					Deletar usuário
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}