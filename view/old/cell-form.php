<?php
	
	if(strcasecmp('get-form-cell', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<div id="form-comum-admin">
			<h2>
				Célula
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-cell" class="inner-link border-radius" title="Editar">Editar</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-cell" class="inner-link select border-radius" title="Nova">Nova</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section info-text">
						<i class="fa fa-bullhorn"></i>
						Note que somente membros que tenham todos os dados completos (incluindo a foto) é que serão salvos.
					</div>
					<div class="box-section">
						<div class="title">Informações</div>
						<input type="text" id="fca-title-p" placeholder="*Nome" />
						<input type="text" id="fca-url-p" placeholder="*URL" />
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Célula ativa
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="checkbox" id="fca-comment-available-p" checked="checked" />
							Comentário disponível
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Membros</div>
						<ul class="sortable">
							<li class="embed box-main-img member">
								<form action="package/ctrl/CtrlFile.php">
									<div class="direction"><i class="fa fa-arrows-v"></i></div>
									<img src="img/system/bg/post-01.png" width="100" height="100" />
									<div href="#" title="Remover" class="remove border-radius">
										<i class="fa fa-trash-o"></i>
									</div>
									<div class="info-photo">
										<input type="text" id="fca-title-photo-p-1" placeholder="*Nome" />
										<input type="text" id="fca-position-member-p-1" placeholder="*Posição" />
										<label>
											<input type="checkbox" id="fca-active-member-p-1" checked="checked" />
											Ativo
										</label>
									</div>
									<div class="info-photo-util">
										<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
										<div class="cl"></div>
										<div class="position border-radius"> 1º</div>
										<div class="cl"></div>
									</div>
									<div class="cl"></div>
									<div class="proxy">
										Carregando foto membro...
									</div>
									<input type="file" class="input-file" name="fca-main-img" id="fca-main-img-1" />
									<a href="#" title="Carregar" class="load-img">
										<i class="fa fa-cloud-upload"></i>
										Carregar foto membro
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
				<a href="#" class="submit" id="fca-submit-new-cell" title="Criar célula">
					Criar célula
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</div>
<?php
	}
	else if(strcasecmp('get-form-new-cell', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section info-text">
				<i class="fa fa-bullhorn"></i>
				Note que somente membros que tenham todos os dados completos (incluindo a foto) é que serão salvos.
			</div>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" placeholder="*Nome" />
				<input type="text" id="fca-url-p" placeholder="*URL" />
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Célula ativa
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" checked="checked" />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Membros</div>
				<ul class="sortable">
					<li class="embed box-main-img member">
						<form action="package/ctrl/CtrlFile.php">
							<div class="direction"><i class="fa fa-arrows-v"></i></div>
							<img src="img/system/bg/post-01.png" width="100" height="100" />
							<div href="#" title="Remover" class="remove border-radius">
								<i class="fa fa-trash-o"></i>
							</div>
							<div class="info-photo">
								<input type="text" id="fca-title-photo-p-1" placeholder="*Nome" />
								<input type="text" id="fca-position-member-p-1" placeholder="*Posição" />
								<label>
									<input type="checkbox" id="fca-active-member-p-1" checked="checked" />
									Ativo
								</label>
							</div>
							<div class="info-photo-util">
								<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
								<div class="cl"></div>
								<div class="position border-radius"> 1º</div>
								<div class="cl"></div>
							</div>
							<div class="cl"></div>
							<div class="proxy">
								Carregando foto membro...
							</div>
							<input type="file" class="input-file" name="fca-main-img" id="fca-main-img-1" />
							<a href="#" title="Carregar" class="load-img">
								<i class="fa fa-cloud-upload"></i>
								Carregar foto membro
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
		<a href="#" class="submit" id="fca-submit-new-cell" title="Criar célula">
			Criar célula
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-cell', $_POST['method']) == 0){
		require_once(__PATH__.'/view/cells-make-admin.php');
?>
		<fieldset>
			<ul class="sortable edit-post banners projects">
				<?php
					echo $html_Cell;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(strcasecmp('load-more-cell', $_POST['method']) == 0){
		require_once(__PATH__.'/view/cells-make-admin.php');
		
		echo $html_Cell;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(preg_match('/^(load-more-cell-production){1}$/', $_POST['method'])){
		require_once(__PATH__.'/view/cells-make-production.php');
		
		echo $html_Cell;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-cell', $_POST['method']) == 0){
		$status = $cell->getStatus() == 1 ? 'checked="checked"' : '';
		$statusComment = $cell->getStatusComment() == 1 ? 'checked="checked"' : '';
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-cell" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section info-text">
				<i class="fa fa-bullhorn"></i>
				Note que somente membros que tenham todos os dados completos (incluindo a foto) é que serão salvos.
			</div>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" value="<?php echo $cell->getName(); ?>" placeholder="*Nome" />
				<input type="text" id="fca-url-p" value="<?php echo $cell->getUrl(); ?>" placeholder="*URL" />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Célula ativa
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" <?php echo $statusComment; ?> />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Membros</div>
				<ul class="sortable">
					<?php
						require_once(__PATH__.'/view/cell-make.php');
					?>
				</ul>
				<a href="#" class="add-embed" title="Adicionar outro">
					<i class="fa fa-plus-circle"></i>
					Adicionar outro
				</a>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-cell" title="Atualizar célula">
			Atualizar célula
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-cell|<?php echo $cell->getId(); ?>" class="submit delete" id="fca-submit-delete-cell" title="Deletar célula">
					Deletar célula
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $cell->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-cell', $_POST['method']) == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar célula</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão da célula todos os dados dela serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-cell" class="ok-delete-button border-radius" title="Deletar célula">
					Deletar célula
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>