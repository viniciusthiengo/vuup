<?php
	
	if(strcasecmp('get-form-download', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Download
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-download" class="inner-link border-radius" title="Editar">Editar</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-download" class="inner-link select border-radius" title="Novo">Novo</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Informações</div>
						<input type="text" id="fca-title-p" placeholder="*Nome do arquivo" />
						<textarea id="fca-description-p" class="download" placeholder="Descrição"></textarea>
						<div class="box-count-post">
							<i class="icon-keyboard"></i>
							<span id="fca-description-p-count"><?php echo __LIMIT_DOWNLOAD_DESCRIPTION__; ?></span>
							<span class="number"><?php echo __LIMIT_DOWNLOAD_DESCRIPTION__; ?></span>
						</div>
						<div class="cl"></div>
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Ativo
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Arquivo <span>(recomendo arquivo compactado .zip)</span></div>
						<div class="box-main-img banner-home download">
							<div class="down-file-name">
								<i class="fa fa-file"></i>
								Forneça um arquivo para download
							</div>
							<input type="file" class="input-file" name="fca-file-download" id="fca-file-download" />
							<a href="#" title="Carregar">
								<i class="fa fa-cloud-upload"></i>
								Carregar arquivo
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
				<a href="#" class="submit" id="fca-submit-new-download" title="Criar download">
					Criar download
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-new-download', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" placeholder="*Nome do arquivo" />
				<textarea id="fca-description-p" class="download" placeholder="Descrição"></textarea>
				<div class="box-count-post">
					<i class="icon-keyboard"></i>
					<span id="fca-description-p-count"><?php echo __LIMIT_DOWNLOAD_DESCRIPTION__; ?></span>
					<span class="number"><?php echo __LIMIT_DOWNLOAD_DESCRIPTION__; ?></span>
				</div>
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Ativo
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Arquivo <span>(recomendo arquivo compactado .zip)</span></div>
				<div class="box-main-img banner-home download">
					<div class="down-file-name">
						<i class="fa fa-file"></i>
						Forneça um arquivo para download
					</div>
					<input type="file" class="input-file" name="fca-file-download" id="fca-file-download" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar arquivo
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
		<a href="#" class="submit" id="fca-submit-new-download" title="Criar download">
			Criar download
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-download', $_POST['method']) == 0){
		require_once(__PATH__.'/view/download-make-admin.php');
?>
		<fieldset>
			<ul class="sortable edit-post projects">
				<?php
					echo $html_Download;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(strcasecmp('load-more-download', $_POST['method']) == 0){
		require_once(__PATH__.'/view/download-make-admin.php');
		
		echo $html_Download;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('load-more-download-production', $_POST['method']) == 0){
		require_once(__PATH__.'/view/download-make-production.php');
		
		echo $html_Download;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-download', $_POST['method']) == 0){
		$status = $download->getStatus() == 1 ? 'checked="checked"' : '';
		$tam = __LIMIT_DOWNLOAD_DESCRIPTION__ - strlen($download->getDescription());
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-download" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Informações</div>
				<input type="text" id="fca-title-p" value="<?php echo $download->getName(); ?>" placeholder="*Nome do arquivo" />
				<textarea id="fca-description-p" class="download" placeholder="Descrição"><?php echo $download->getDescription(); ?></textarea>
				<div class="box-count-post">
					<i class="icon-keyboard"></i>
					<span id="fca-description-p-count"><?php echo $tam; ?></span>
					<span class="number"><?php echo __LIMIT_DOWNLOAD_DESCRIPTION__; ?></span>
				</div>
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Ativo
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Arquivo <span>(recomendo arquivo compactado .zip)</span></div>
				<div class="box-main-img banner-home download">
					<div class="down-file-name" title="<?php echo $download->getFile()->getName(); ?>">
						<i class="fa fa-file"></i>
						Arquivo pronto
						<i class="fa fa-check"></i>
					</div>
					<input type="file" class="input-file" name="fca-file-download" id="fca-file-download" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar arquivo
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
		<a href="#" class="submit" id="fca-submit-update-download" title="Atualizar download">
			Atualizar download
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-download|<?php echo $download->getId(); ?>" class="submit delete" id="fca-submit-delete-download" title="Deletar download">
					Deletar download
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $download->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-download', $_POST['method']) == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar download</h2>
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
				<a href="#" id="ok-delete-download" class="ok-delete-button border-radius" title="Deletar download">
					Deletar download
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>