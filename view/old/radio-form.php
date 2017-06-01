<?php
	if(!is_null($radio)){
		$id = $radio->getId();
		$total = $radio->getTotal();
		$statusComment = $radio->getStatusComment() == 1 ? 'checked="checked"' : '';
		$status = $radio->getStatus() == 1 ? 'checked="checked"' : '';
		$topDay = $radio->getTopDay() == 1 ? 'checked="checked"' : '';
		$topWeek = $radio->getTopWeek() == 1 ? 'checked="checked"' : '';
		$topMonth = $radio->getTopMonth() == 1 ? 'checked="checked"' : '';
		$topYear = $radio->getTopYear() == 1 ? 'checked="checked"' : '';
	}
	else{
		$id = 1;
		$total = 10;
		$statusComment = 'checked="checked"';
		$status = 'checked="checked"';
		$topDay = 'checked="checked"';
		$topWeek = '';
		$topMonth = '';
		$topYear = '';
	}
		
		
	if(strcasecmp('get-form-radio', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Rádio
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-radio-list" class="inner-link border-radius" title="Editar lista">Editar lista</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-radio-list" class="inner-link border-radius" title="Nova lista">Nova lista</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-generally-radio" class="inner-link select border-radius" title="Geral">Geral</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Principal</div>
						<label for="fca-qtd-musics-p">
							Quantidade músicas em Top:
						</label>
						<input type="text" id="fca-qtd-musics-p" placeholder="*qtd" value="<?php echo $total; ?>" />
						<br /><br />
						<label>
							<input type="checkbox" id="fca-activate-p" <?php echo $status; ?> />
							Rádio disponível
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="checkbox" id="fca-comment-available-p" <?php echo $statusComment; ?> />
							Comentário disponível
						</label>
					</div>
					<div class="box-section">
						<div class="title">Tops</div>
						<label>
							<input type="checkbox" id="fca-top-day-p" <?php echo $topDay; ?> />
							Mostrar Tops do Dia
						</label>
						<br /><br />
						<label>
							<input type="checkbox" id="fca-top-week-p" <?php echo $topWeek; ?> />
							Mostrar Tops da Semana
						</label>
						<br /><br />
						<label>
							<input type="checkbox" id="fca-top-month-p" <?php echo $topMonth; ?> />
							Mostrar Tops do Mês
						</label>
						<br /><br />
						<label>
							<input type="checkbox" id="fca-top-year-p" <?php echo $topYear; ?> />
							Mostrar Tops do Ano
						</label>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-update-radio" title="Atualizar rádio">
					Atualizar rádio
				</a>
				<input type="hidden" id="fca-id" value="<?php echo $id; ?>" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-generally-radio', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Principal</div>
				<label for="fca-qtd-musics-p">
					Quantidade músicas em Top:
				</label>
				<input type="text" id="fca-qtd-musics-p" placeholder="*qtd" value="<?php echo $total; ?>" />
				<br /><br />
				<label>
					<input type="checkbox" id="fca-activate-p" <?php echo $status; ?> />
					Rádio disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" <?php echo $statusComment; ?> />
					Comentário disponível
				</label>
			</div>
			<div class="box-section">
				<div class="title">Tops</div>
				<label>
					<input type="checkbox" id="fca-top-day-p" <?php echo $topDay; ?> />
					Mostrar Tops do Dia
				</label>
				<br /><br />
				<label>
					<input type="checkbox" id="fca-top-week-p" <?php echo $topWeek; ?> />
					Mostrar Tops da Semana
				</label>
				<br /><br />
				<label>
					<input type="checkbox" id="fca-top-month-p" <?php echo $topMonth; ?> />
					Mostrar Tops do Mês
				</label>
				<br /><br />
				<label>
					<input type="checkbox" id="fca-top-year-p" <?php echo $topYear; ?> />
					Mostrar Tops do Ano
				</label>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-radio" title="Atualizar rádio">
			Atualizar rádio
		</a>
		<input type="hidden" id="fca-id" value="<?php echo $id; ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-new-radio-list', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Status</div>
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Lista disponível
				</label>
			</div>
			<div class="box-section">
				<div class="title">Músicas lista</div>
				<ul class="sortable">
					<li class="embed music">
						<i class="fa fa-volume-up icon-video"></i>
						<input type="text" id="fca-music-p-1" placeholder="*Música" />
						-
						<input type="text" id="fca-artist-p-1" placeholder="*Artista / Banda" />
						-
						<input type="text" id="fca-votes-p-1" placeholder="*Votos" />
						<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
						<div class="cl"></div>
					</li>
				</ul>
				<a href="#" class="add-embed" title="Adicionar outra">
					<i class="fa fa-plus-circle"></i>
					Adicionar outra
				</a>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-new-radio-list" title="Criar lista">
			Criar lista
		</a>
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-radio-list', $_POST['method']) == 0){
		$tam = count($arrayRadioList);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_RADIO_LIST__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-radio-list" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// RADIO LIST TO UPDATE
			$html_RadioList = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayRadioList[$i]->getId();
				$time = date('d\/m\/Y \à\s H\hi', $arrayRadioList[$i]->getTime());
				$statusIcon = $arrayRadioList[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
				$user = is_object($arrayRadioList[$i]->getUser()) ? $arrayRadioList[$i]->getUser()->getName() : 'Criador indefinido';
				
				$html_RadioList .= <<<HTML
					<li id="rd-$id">
						<div class="info">
							$statusIcon
							<i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user
							<div class="cl"></div>
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-radio-list|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
		
		if(empty($html_RadioList)){
			$html_RadioList = <<<HTML
				<li>
					<i class="fa fa-warning"></i>
					Nenhuma lista encontrada.
				</li>
HTML;
		}
?>
		<fieldset>
			<ul class="sortable edit-post banners projects">
				<?php
					echo $html_RadioList;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(strcasecmp('load-more-radio-list', $_POST['method']) == 0){
		$tam = count($arrayRadioList);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_RADIO_LIST__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-radio-list" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// RADIO LIST TO UPDATE
			$html_RadioList = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayRadioList[$i]->getId();
				$time = date('d\/m\/Y \à\s H\hi', $arrayRadioList[$i]->getTime());
				$statusIcon = $arrayRadioList[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
				$user = is_object($arrayRadioList[$i]->getUser()) ? $arrayRadioList[$i]->getUser()->getName() : 'Criador indefinido';
				
				$html_RadioList .= <<<HTML
					<li id="rd-$id">
						<div class="info">
							$statusIcon
							<i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user
							<div class="cl"></div>
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-radio-list|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
			
		echo $html_RadioList;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-radio-list', $_POST['method']) == 0){
		$status = $radioList->getStatus() == 1 ? 'checked="checked"' : '';
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-radio-list" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Status</div>
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Lista disponível
				</label>
			</div>
			<div class="box-section">
				<div class="title">Músicas lista</div>
				<ul class="sortable">
					<?php
						require_once(__PATH__.'/view/radio-make.php');
					?>
				</ul>
				<a href="#" class="add-embed" title="Adicionar outra">
					<i class="fa fa-plus-circle"></i>
					Adicionar outra
				</a>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-radio-list" title="Atualizar lista">
			Atualizar lista
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-radio-list|<?php echo $radioList->getId(); ?>" class="submit delete" id="fca-submit-delete-radio-list" title="Deletar lista">
					Deletar lista
				</a>
		<?php
			}
		?>
		<input type="hidden" name="id" id="fca-id" value="<?php echo $radioList->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-radio-list', $_POST['method']) == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar lista</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão dessa lista de músicas todos os dados dela serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-radio-list" class="ok-delete-button border-radius" title="Deletar lista">
					Deletar lista
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>