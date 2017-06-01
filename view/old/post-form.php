<?php
	// PROGRAMATION
		$hour = is_object($post) ? (int)date('H', $post->getDate()) : 0;
		$hour = new Hour($hour);
		$html_Hour = $hour->getOptions();
		
		$minute = is_object($post) ? (int)date('i', $post->getDate()) : 0;
		$minute = new Minute($minute);
		$html_Minute = $minute->getOptions();
		
	
	if(strcasecmp('get-form-post', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Post
				<a href="package/ctrl/CtrlPost.php|get-form-update-post" class="inner-link border-radius" title="Editar">Editar</a>
				<a href="package/ctrl/CtrlPost.php|get-form-new-post" class="inner-link select border-radius" title="Novo">Novo</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Principal</div>
						<input type="text" id="fca-title-p" placeholder="*Título (no mínimo 5 caracteres)" />
						<input type="text" id="fca-url-p" placeholder="*URL (no mínimo 5 caracteres)" />
						<br />
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Post disponível
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="checkbox" id="fca-comment-available-p" checked="checked" />
							Comentário disponível
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Programação</div>
						<input type="text" id="fca-date-p" placeholder="dd/mm/yyyy" />
						<div class="aux-date">
							às
							<select id="fca-hour-p">
								<?php
									echo $html_Hour;
								?>
							</select>
							:
							<select id="fca-minute-p">
								<?php
									echo $html_Minute;
								?>
							</select>
						</div>
						<div class="cl"></div>
					</div>
					
					<div class="box-section">
						<div class="title">Descrição inicial</div>
						<textarea id="fca-description-p" placeholder="Descrição (no mínimo 5 caracteres)"></textarea>
						<div class="box-count-post">
							<i class="icon-keyboard"></i>
							<span id="fca-description-p-count"><?php echo __LIMIT_SUMMARY__; ?></span>
							<span class="number"><?php echo __LIMIT_SUMMARY__; ?></span>
						</div>
					</div>
					
					<div class="box-section">
						<div class="title">Thumb</div>
						<div class="box-main-img">
							<img src="img/system/bg/post-01.png" width="100" height="100" />
							<input type="text" id="fca-main-img-name" placeholder="Nome (url) da imagem (no mínimo 5 caracteres)" />
							<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
							<a href="#" title="Carregar">
								<i class="fa fa-cloud-upload"></i>
								Carregar imagem thumb
							</a>
							<div class="proxy">
								Carregando thumb...
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
					
					<div class="box-section">
						<div class="title">Conteúdo principal</div>
						<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-new-post" title="Criar post">
					Criar post
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-new-post', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Principal</div>
				<input type="text" id="fca-title-p" placeholder="*Título (no mínimo 5 caracteres)" />
				<input type="text" id="fca-url-p" placeholder="*URL (no mínimo 5 caracteres)" />
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Post disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" checked="checked" />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Programação</div>
				<input type="text" id="fca-date-p" placeholder="dd/mm/yyyy" />
				<div class="aux-date">
					às
					<select id="fca-hour-p">
						<?php
							echo $html_Hour;
						?>
					</select>
					:
					<select id="fca-minute-p">
						<?php
							echo $html_Minute;
						?>
					</select>
				</div>
				<div class="cl"></div>
			</div>
			
			<div class="box-section">
				<div class="title">Descrição inicial</div>
				<textarea id="fca-description-p" placeholder="Description (no mínimo 5 caracteres)"></textarea>
				<div class="box-count-post">
					<i class="icon-keyboard"></i>
					<span id="fca-description-p-count"><?php echo __LIMIT_SUMMARY__; ?></span>
					<span class="number"><?php echo __LIMIT_SUMMARY__; ?></span>
				</div>
			</div>
			
			<div class="box-section">
				<div class="title">Thumb</div>
				<div class="box-main-img">
					<img src="img/system/bg/post-01.png" width="100" height="100" />
					<input type="text" id="fca-main-img-name" placeholder="Nome (url) da imagem (no mínimo 5 caracteres)" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar imagem thumb
					</a>
					<div class="proxy">
						Carregando thumb...
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
			
			<div class="box-section">
				<div class="title">Conteúdo principal</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-new-post" title="Criar post">
			Criar post
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-post', $_POST['method']) == 0){
		require_once(__PATH__.'/view/post-make-admin.php');
?>
		<fieldset>
			<ul class="sortable edit-post">
				<?php
					echo $html_Post;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(strcasecmp('load-more-post', $_POST['method']) == 0){
		require_once(__PATH__.'/view/post-make-admin.php');
		
		echo $html_Post;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-post', $_POST['method']) == 0){
	
		$checked_Status = $post->getStatus() == 0 ? '' : 'checked="checked"';
		$checked_StatusComment = $post->getStatusComment() == 0 ? '' : 'checked="checked"';
		$time = date('d\/m\/Y', $post->getTime());
		$tamSummary = __LIMIT_SUMMARY__ - strlen($post->getSummary());
		
		$realNameImg = preg_replace('/(.jpg|.JPG|.jpeg|.JPEG|.gif|.GIF|.png|.PNG){1}$/', '', $post->getImage()->getRealName());
?>
		<fieldset>
			<a href="package/ctrl/CtrlPost.php|get-form-update-post" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Principal</div>
				<input type="text" id="fca-title-p" placeholder="*Título (no mínimo 5 caracteres)" value="<?php echo $post->getTitle(); ?>" />
				<input type="text" id="fca-url-p" placeholder="*URL (no mínimo 5 caracteres)" value="<?php echo $post->getUrl(); ?>" />
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $checked_Status; ?> />
					Post disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" <?php echo $checked_StatusComment; ?> />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Programação</div>
				<input type="text" id="fca-date-p" placeholder="dd/mm/yyyy" value="<?php echo $time; ?>" />
				<div class="aux-date">
					às
					<select id="fca-hour-p">
						<?php
							echo $html_Hour;
						?>
					</select>
					:
					<select id="fca-minute-p">
						<?php
							echo $html_Minute;
						?>
					</select>
				</div>
				<div class="cl"></div>
			</div>
			
			<div class="box-section">
				<div class="title">Descrição inicial</div>
				<textarea id="fca-description-p" placeholder="Descrição (no mínimo 5 caracteres)"><?php echo $post->getSummary(); ?></textarea>
				<div class="box-count-post">
					<i class="icon-keyboard"></i>
					<span id="fca-description-p-count"><?php echo $tamSummary; ?></span>
					<span class="number"><?php echo __LIMIT_SUMMARY__; ?></span>
				</div>
			</div>
			
			<div class="box-section">
				<div class="title">Thumb</div>
				<div class="box-main-img">
					<img src="img/post/100-100/<?php echo $post->getImage()->getRealName(); ?>" width="100" height="100" />
					<input type="text" id="fca-main-img-name" placeholder="Nome (url) da imagem (no mínimo 5 caracteres)" value="<?php echo $realNameImg; ?>" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar imagem thumb
					</a>
					<div class="proxy">
						Carregando thumb...
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
			
			<div class="box-section">
				<div class="title">Conteúdo principal</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"><?php echo $post->getContent(); ?></textarea>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-post" title="Atualizar post">
			Atualizar post
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlPost.php|get-form-ok-delete-post|<?php echo $post->getId(); ?>" class="submit delete" id="fca-submit-delete-post" title="Deletar post">
					Deletar post
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $post->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-post', $_POST['method']) == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar post</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão do post todos os dados dele serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-post" class="ok-delete-button border-radius" title="Deletar post">
					Deletar post
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>