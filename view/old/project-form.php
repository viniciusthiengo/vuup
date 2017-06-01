<?php
	if(strcasecmp('get-form-project', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Projeto
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-project" class="inner-link border-radius" title="Editar">Editar</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-project" class="inner-link select border-radius" title="Novo">Novo</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Principal</div>
						<input type="text" id="fca-title-p" placeholder="*Nome" />
						<input type="text" id="fca-url-p" placeholder="*URL" />
						<br />
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Projeto disponível
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="checkbox" id="fca-comment-available-p" checked="checked" />
							Comentário disponível
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Descrição de apresentação</div>
						<textarea id="fca-description-p" placeholder="Descrição"></textarea>
						<div class="box-count-post">
							<i class="icon-keyboard"></i>
							<span id="fca-description-p-count"><?php echo __LIMIT_PROJECT_DESCRIPTION__; ?></span>
							<span class="number"><?php echo __LIMIT_PROJECT_DESCRIPTION__; ?></span>
						</div>
					</div>
					
					<div class="box-section">
						<div class="title">Conteúdo</div>
						<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-new-project" title="Criar projeto">
					Criar projeto
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-new-project', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Principal</div>
				<input type="text" id="fca-title-p" placeholder="*Nome" />
				<input type="text" id="fca-url-p" placeholder="*URL" />
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Projeto disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" checked="checked" />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Descrição de apresentação</div>
				<textarea id="fca-description-p" placeholder="Descrição"></textarea>
				<div class="box-count-post">
					<i class="icon-keyboard"></i>
					<span id="fca-description-p-count"><?php echo __LIMIT_PROJECT_DESCRIPTION__; ?></span>
					<span class="number"><?php echo __LIMIT_PROJECT_DESCRIPTION__; ?></span>
				</div>
			</div>
			
			<div class="box-section">
				<div class="title">Conteúdo</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-new-project" title="Criar projeto">
			Criar projeto
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-project', $_POST['method']) == 0){
		require_once(__PATH__.'/view/project-make-admin.php');
?>
		<fieldset>
			<ul class="sortable edit-post projects">
				<?php
					echo $html_Project;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(strcasecmp('load-more-project', $_POST['method']) == 0){
		require_once(__PATH__.'/view/project-make-admin.php');
		
		echo $html_Project;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('load-more-project-production', $_POST['method']) == 0){
		require_once(__PATH__.'/view/project-make-production.php');
		
		echo $html_Project;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-project', $_POST['method']) == 0){
		$status =  $project->getStatus() == 1 ? 'checked="checked"' : '';
		$statusComment =  $project->getStatusComment() == 1 ? 'checked="checked"' : '';
		$tamText = __LIMIT_PROJECT_DESCRIPTION__ - strlen($project->getDescription());
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-project" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Principal</div>
				<input type="text" id="fca-title-p" value="<?php echo $project->getName(); ?>" placeholder="*Nome" />
				<input type="text" id="fca-url-p" value="<?php echo $project->getUrl(); ?>" placeholder="*URL" />
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Projeto disponível
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input type="checkbox" id="fca-comment-available-p" <?php echo $statusComment; ?> />
					Comentário disponível
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Descrição de apresentação</div>
				<textarea id="fca-description-p" placeholder="Description"><?php echo $project->getDescription(); ?></textarea>
				<div class="box-count-post">
					<i class="icon-keyboard"></i>
					<span id="fca-description-p-count"><?php echo $tamText; ?></span>
					<span class="number"><?php echo __LIMIT_PROJECT_DESCRIPTION__; ?></span>
				</div>
			</div>
			
			<div class="box-section">
				<div class="title">Conteúdo</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"><?php echo $project->getContent(); ?></textarea>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-project" title="Atualizar projeto">
			Atualizar projeto
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-project|<?php echo $project->getId(); ?>" class="submit delete" id="fca-submit-delete-project" title="Deletar projeto">
					Deletar projeto
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $project->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-project', $_POST['method']) == 0){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar projeto</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão desse projeto todos os dados dele serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-project" class="ok-delete-button border-radius" title="Deletar projeto">
					Deletar projeto
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>