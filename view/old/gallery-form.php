<?php
	if(empty($gallery)){
		$gallery = new Gallery();
	}
	
	if(strcasecmp('get-form-gallery-video', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<div id="form-comum-admin">
			<h2>
				Galeria
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-gallery-photo" class="inner-link border-radius" title="Editar (foto)">Editar (foto)</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-gallery-photo" class="inner-link border-radius" title="Novo (foto)">Novo (foto)</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-gallery-video" class="inner-link border-radius" title="Editar (vídeo)">Editar (vídeo)</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-gallery-video" class="inner-link select border-radius" title="Novo (vídeo)">Novo (vídeo)</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Informações</div>
						<input type="text" id="fca-title-p" placeholder="*Nome" />
						<input type="text" id="fca-url-p" placeholder="*URL" />
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Galeria disponível
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="checkbox" id="fca-comment-available-p" checked="checked" />
							Comentário disponível
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Vídeos (embed code)</div>
						<ul class="sortable">
							<li class="embed">
								<div class="direction"><i class="fa fa-arrows-v"></i></div>
								<i class="fa fa-video-camera icon-video"></i>
								<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
								<input type="text" id="fca-embed-p-1" placeholder="*Embed code </>" />
								<div class="position border-radius"> 1º</div>
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
				<a href="#" class="submit" id="fca-submit-new-gallery" title="Criar galeria">
					Criar galeria
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<input type="hidden" name="type" id="fca-type" value="<?php echo $gallery->getTypeByMethod($_POST['method']); ?>" />
				<div class="cl"></div>
			</div>
		</div>
<?php
	}
	else if(strcasecmp('get-form-new-gallery-video', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" placeholder="*Nome" />
				<input type="text" id="fca-url-p" placeholder="*URL" />
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Galeria disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" checked="checked" />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Vídeos (embed code)</div>
				<ul class="sortable">
					<li class="embed">
						<div class="direction"><i class="fa fa-arrows-v"></i></div>
						<i class="fa fa-video-camera icon-video"></i>
						<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
						<input type="text" id="fca-embed-p-1" placeholder="*Embed code </>" />
						<div class="position border-radius"> 1º</div>
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
		<a href="#" class="submit" id="fca-submit-new-gallery" title="Criar galeria">
			Criar galeria
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="type" id="fca-type" value="<?php echo $gallery->getTypeByMethod($_POST['method']); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(preg_match('/^(get-form-update-gallery-video|get-form-update-gallery-photo){1}$/', $_POST['method'])){
		require_once(__PATH__.'/view/gallery-make-admin.php');
?>
		<fieldset>
			<ul class="sortable edit-post banners projects">
				<?php
					echo $html_Gallery;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(preg_match('/^(load-more-gallery-video|load-more-gallery-photo){1}$/', $_POST['method'])){
		require_once(__PATH__.'/view/gallery-make-admin.php');
		
		echo $html_Gallery;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(preg_match('/^(load-more-gallery-video-production|load-more-gallery-photo-production){1}$/', $_POST['method'])){
		if(preg_match('/^(load-more-gallery-video-production){1}$/', $_POST['method']))
			require_once(__PATH__.'/view/videos-make-production.php');
		else
			require_once(__PATH__.'/view/photos-make-production.php');
		
		echo $html_Gallery;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-gallery-video', $_POST['method']) == 0){
		$status = $gallery->getStatus() == 1 ? 'checked="checked"' : '';
		$statusComment = $gallery->getStatusComment() == 1 ? 'checked="checked"' : '';
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-gallery-video" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" value="<?php echo $gallery->getTitle(); ?>" placeholder="*Nome" />
				<input type="text" id="fca-url-p" value="<?php echo $gallery->getUrl(); ?>" placeholder="*URL" />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Galeria disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" <?php echo $statusComment; ?> />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Vídeos (embed code)</div>
				<ul class="sortable">
					<?php
						require_once(__PATH__.'/view/gallery-make.php');
					?>
				</ul>
				<a href="#" class="add-embed" title="Adicionar outro">
					<i class="fa fa-plus-circle"></i>
					Adicionar outro
				</a>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-gallery" title="Atualizar galeria">
			Atualizar galeria
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-gallery|<?php echo $gallery->getId(); ?>" class="submit delete" id="fca-submit-delete-gallery" title="Deletar galeria">
					Deletar galeria
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="type" id="fca-type" value="<?php echo $gallery->getType(); ?>" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $gallery->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-new-gallery-photo', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" placeholder="*Nome" />
				<input type="text" id="fca-url-p" placeholder="*URL" />
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Galeria disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" checked="checked" />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Fotos</div>
				<ul class="sortable">
					<li class="embed box-main-img">
						<form action="package/ctrl/CtrlFile.php">
							<div class="direction"><i class="fa fa-arrows-v"></i></div>
							<img src="img/system/bg/post-01.png" width="100" height="100" />
							<div href="#" title="Remover" class="remove border-radius">
								<i class="fa fa-trash-o"></i>
							</div>
							<div class="info-photo">
								<input type="text" id="fca-title-photo-p-1" placeholder="Título" />
								<textarea type="text" id="fca-desc-photo-p-1" placeholder="Descrição"></textarea>
							</div>
							<div class="info-photo-util">
								<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
								<div class="cl"></div>
								<div class="position border-radius"> 1º</div>
								<div class="cl"></div>
							</div>
							<div class="cl"></div>
							<div class="proxy">
								Carregando foto...
							</div>
							<input type="file" class="input-file" name="fca-main-img" id="fca-main-img-1" />
							<a href="#" title="Carregar" class="load-img">
								<i class="fa fa-cloud-upload"></i>
								Carregar foto
							</a>
							<input type="hidden" name="method" id="fca-method" value="" />
							<div class="cl"></div>
						</form>
					</li>
				</ul>
				<a href="#" class="add-embed" title="Adicionar outro">
					<i class="fa fa-plus-circle"></i>
					Adicionar outro
				</a>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-new-gallery" title="Criar galeria">
			Criar galeria
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="type" id="fca-type" value="<?php echo $gallery->getTypeByMethod($_POST['method']); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-one-gallery-photo', $_POST['method']) == 0){
		$status = $gallery->getStatus() == 1 ? 'checked="checked"' : '';
		$statusComment = $gallery->getStatusComment() == 1 ? 'checked="checked"' : '';
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-gallery-photo" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" value="<?php echo $gallery->getTitle(); ?>" placeholder="*Nome" />
				<input type="text" id="fca-url-p" value="<?php echo $gallery->getUrl(); ?>" placeholder="*URL" />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Galeria disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" <?php echo $statusComment; ?> />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Fotos</div>
				<ul class="sortable">
					<?php
						require_once(__PATH__.'/view/gallery-make.php');
					?>
				</ul>
				<a href="#" class="add-embed" title="Adicionar outro">
					<i class="fa fa-plus-circle"></i>
					Adicionar outro
				</a>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-gallery" title="Atualizar galeria">
			Atualizar galeria
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-gallery|<?php echo $gallery->getId(); ?>" class="submit delete" id="fca-submit-delete-gallery" title="Deletar galeria">
					Deletar galeria
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="type" id="fca-type" value="<?php echo $gallery->getType(); ?>" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $gallery->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-gallery', $_POST['method']) == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar post</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão dessa galeria todos os dados dela serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-gallery" class="ok-delete-button border-radius" title="Deletar galeria">
					Deletar galeria
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>