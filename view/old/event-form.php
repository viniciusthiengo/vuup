<?php
	$hour = new Hour();
	$minute = new Minute();
	
	if(strcasecmp('get-form-calendar', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Calendário (Evento)
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-calendar" class="inner-link border-radius" title="Editar">Editar</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-calendar" class="inner-link select border-radius" title="Novo">Novo</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Informações</div>
						<input type="text" id="fca-title-p" placeholder="*Evento" />
						<br />
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Disponível
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Dscrição completa</div>
						<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
					</div>
					
					<div class="box-section">
						<div class="title">Dias / horários</div>
						<ul class="sortable">
							<li class="embed date">
								<div class="box-aux-date">
									<i class="fa fa-calendar icon-video"></i>
									<input type="text" id="fca-date-p-1" placeholder="dd/mm/aaaa" />
								</div>
								<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
								<div class="box-hour-minute">
									início
									<select id="fca-hour-init-p-1">
										<?php
											echo $hour->getOptions();
										?>
									</select>
									:
									<select id="fca-minute-init-p-1">
										<?php
											echo $minute->getOptions();
										?>
									</select>
									&nbsp;&nbsp;
									término
									<select id="fca-hour-finish-p-1">
										<?php
											echo $hour->getOptions();
										?>
									</select>
									:
									<select id="fca-minute-finish-p-1">
										<?php
											echo $minute->getOptions();
										?>
									</select>
								</div>
								<div class="cl"></div>
							</li>
						</ul>
						<a href="#" class="add-embed" title="Adicionar outro">
							<i class="fa fa-plus-circle"></i>
							Adicionar outro
						</a>
						<div class="cl"></div>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-new-event" title="Criar evento">
					Criar evento
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-new-calendar', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" placeholder="*Evento" />
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Dscrição completa</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
			</div>
			
			<div class="box-section">
				<div class="title">Dias / horários</div>
				<ul class="sortable">
					<li class="embed date">
						<div class="box-aux-date">
							<i class="fa fa-calendar icon-video"></i>
							<input type="text" id="fca-date-p-1" placeholder="dd/mm/aaaa" />
						</div>
						<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
						<div class="box-hour-minute">
							início
							<select id="fca-hour-init-p-1">
								<?php
									echo $hour->getOptions();
								?>
							</select>
							:
							<select id="fca-minute-init-p-1">
								<?php
									echo $minute->getOptions();
								?>
							</select>
							&nbsp;&nbsp;
							término
							<select id="fca-hour-finish-p-1">
								<?php
									echo $hour->getOptions();
								?>
							</select>
							:
							<select id="fca-minute-finish-p-1">
								<?php
									echo $minute->getOptions();
								?>
							</select>
						</div>
						<div class="cl"></div>
					</li>
				</ul>
				<a href="#" class="add-embed" title="Adicionar outro">
					<i class="fa fa-plus-circle"></i>
					Adicionar outro
				</a>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-new-event" title="Criar evento">
			Criar evento
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-calendar', $_POST['method']) == 0){
		$tam = count($arrayEvent);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_EVENT__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-event" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// EVENT TO UPDATE
			$html_Event = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEvent[$i]->getId();
				$title = $arrayEvent[$i]->getTitle();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEvent[$i]->getTime());
				$statusIcon = $arrayEvent[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
				$user = is_object($arrayEvent[$i]->getUser()) ? $arrayEvent[$i]->getUser()->getName() : 'Criador indefinido';
				
				$html_Event .= <<<HTML
					<li id="ev-$id">
						<div class="info">
							<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
							$statusIcon
							<div class="cl"></div>
							$title
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-calendar|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
		
		if(empty($html_Event)){
			$html_Event = <<<HTML
				<li>
					<i class="fa fa-warning"></i>
					Nenhum evento encontrado.
				</li>
HTML;
		}
?>
		<fieldset>
			<ul class="sortable edit-post banners projects">
				<?php
					echo $html_Event;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('load-more-event', $_POST['method']) == 0){
		$tam = count($arrayEvent);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_EVENT__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-event" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// POST TO UPDATE
			$html_Event = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayEvent[$i]->getId();
				$title = $arrayEvent[$i]->getTitle();
				$time = date('d\/m\/Y \à\s H\hi', $arrayEvent[$i]->getTime());
				$statusIcon = $arrayEvent[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
				$user = is_object($arrayEvent[$i]->getUser()) ? $arrayEvent[$i]->getUser()->getName() : 'Criador indefinido';
				
				$html_Event .= <<<HTML
					<li id="ev-$id">
						<div class="info">
							<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
							$statusIcon
							<div class="cl"></div>
							$title
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-calendar|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
			
		echo $html_Event;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-calendar', $_POST['method']) == 0){
		$status = $event->getStatus() == 1 ? 'checked="checked"' : '';
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-calendar" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" value="<?php echo $event->getTitle(); ?>" placeholder="*Evento" />
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Dscrição completa</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"><?php echo $event->getContent(); ?></textarea>
			</div>
			
			<div class="box-section">
				<div class="title">Dias / horários</div>
				<ul class="sortable">
					<?php
						require_once(__PATH__.'/view/event-time-make.php');
					?>
				</ul>
				<a href="#" class="add-embed" title="Adicionar outro">
					<i class="fa fa-plus-circle"></i>
					Adicionar outro
				</a>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-event" title="Atualizar evento">
			Atualizar evento
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-event|<?php echo $event->getId(); ?>" class="submit delete" id="fca-submit-delete-event" title="Deletar evento">
					Deletar evento
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $event->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-event', $_POST['method']) == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar evento</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão do evento todos os dados dele serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-event" class="ok-delete-button border-radius" title="Deletar evento">
					Deletar evento
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>