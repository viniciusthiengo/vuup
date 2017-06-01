<?php
	
	if(strcasecmp('get-form-sponsor', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Patrocinadores
				<a href="package/ctrl/CtrlAdmin.php|get-form-sort-sponsor" class="inner-link border-radius" title="Ordem">Ordem</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-sponsor" class="inner-link border-radius" title="Editar">Editar</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-sponsor" class="inner-link select border-radius" title="Novo">Novo</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Dados de acesso</div>
						<input type="text" id="fca-title-p" placeholder="*Patrocinador" />
						<input type="text" id="fca-urllink-p" placeholder="*URL site" />
						<div class="cl"></div>
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Ativo
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Imagem patrocinador <span>(dimensões recomendadas: 240px de largura)</span></div>
						<div class="box-main-img banner-home banner-lateral banner-sponsor">
							<img src="img/system/bg/post-04.png" width="240" height="240" />
							<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
							<a href="#" title="Carregar">
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
				<a href="#" class="submit" id="fca-submit-new-sponsor" title="Criar patrocinador">
					Criar patrocinador
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-new-sponsor', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Dados de acesso</div>
				<input type="text" id="fca-title-p" placeholder="*Patrocinador" />
				<input type="text" id="fca-urllink-p" placeholder="*URL site" />
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Ativo
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Imagem patrocinador <span>(dimensões recomendadas: 240px de largura)</span></div>
				<div class="box-main-img banner-home banner-lateral banner-sponsor">
					<img src="img/system/bg/post-04.png" width="240" height="240" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar">
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
		<a href="#" class="submit" id="fca-submit-new-sponsor" title="Criar patrocinador">
			Criar patrocinador
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-sponsor', $_POST['method']) == 0){
		$tam = count($arraySponsor);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_SPONSOR__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-sponsor" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
			
		// SPONSOR TO UPDATE
			$html_Sponsor = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arraySponsor[$i]->getId();
				$name = $arraySponsor[$i]->getName();
				$image = $arraySponsor[$i]->getImage()->getRealName();
				$statusIcon = $arraySponsor[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
				
				$html_Sponsor .= <<<HTML
					<li id="sp-$id">
						<img src="img/sponsor/50-50/$image" width="50" height="50" />
						<div class="info">
							$name $statusIcon
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-sponsor|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
			
			if(empty($html_Sponsor)){
				$html_Sponsor = <<<HTML
					<li id="sp-$id">
						<i class="fa fa-warning"></i>
						Nenhum patrocinador encontrado.
					</li>
HTML;
			}
?>
		<fieldset>
			<ul class="sortable edit-post">
				<?php
					echo $html_Sponsor;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
<?php
	}
	else if(strcasecmp('load-more-sponsor', $_POST['method']) == 0){
		$tam = count($arraySponsor);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_SPONSOR__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-sponsor" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
			
		// SPONSOR TO UPDATE
			$html_Sponsor = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arraySponsor[$i]->getId();
				$name = $arraySponsor[$i]->getName();
				$image = $arraySponsor[$i]->getImage()->getRealName();
				
				$html_Sponsor .= <<<HTML
					<li id="sp-$id">
						<img src="img/sponsor/50-50/$image" width="50" height="50" />
						<div class="info">
							$name
						</div>
						<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-sponsor|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
			
		echo $html_Sponsor;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-sponsor', $_POST['method']) == 0){
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-sponsor" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Dados de acesso</div>
				<input type="text" id="fca-title-p" placeholder="*Patrocinador" value="<?php echo $sponsor->getName(); ?>" />
				<input type="text" id="fca-urllink-p" placeholder="*URL site" value="<?php echo $sponsor->getUrl(); ?>" />
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Ativo
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Imagem patrocinador <span>(dimensões recomendadas: 240px de largura)</span></div>
				<div class="box-main-img banner-home banner-lateral banner-sponsor">
					<img src="img/sponsor/240-1000/<?php echo $sponsor->getImage()->getRealName(); ?>" width="240" height="240" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar imagem
					</a>
					<div class="proxy">
						Carregando...
					</div>
					<div href="#" title="Remover" style="display: block;" class="remove border-radius">
						<i class="fa fa-trash-o"></i>
					</div>
					<div class="cl"></div>
				</div>
				<div class="box-main-img">
				</div>
				<div class="cl"></div>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-sponsor" title="Atualizar patrocinador">
			Atualizar patrocinador
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-sponsor|<?php echo $sponsor->getId(); ?>" class="submit delete" id="fca-submit-delete-sponsor" title="Deletar patrocinador">
					Deletar patrocinador
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $sponsor->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-sort-sponsor', $_POST['method']) == 0){
		$tam = count($arraySponsor);
		$html_UpdateButton = '';
			
		// SPONSOR TO UPDATE
			$html_Sponsor = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arraySponsor[$i]->getId();
				$name = $arraySponsor[$i]->getName();
				$image = $arraySponsor[$i]->getImage()->getRealName();
				$position = ($i+1).'º';
				
				$html_Sponsor .= <<<HTML
					<li id="sp-$id">
						<div class="direction border-radius"><i class="fa fa-arrows-v"></i></div>
						<img src="img/sponsor/50-50/$image" width="50" height="50"  />
						<div class="info">
							$name
						</div>
						<div class="position border-radius">
							$position
						</div>
						<div class="cl"></div>
					</li>
HTML;
			}
			
			if(empty($html_Sponsor)){
				$html_Sponsor = <<<HTML
					<li id="sp-$id">
						<i class="fa fa-warning"></i>
						Nenhum patrocinador encontrado.
					</li>
HTML;
			}
			else{
				$html_UpdateButton = <<<HTML
					<a href="package/ctrl/CtrlAdmin.php|update-sponsor-position" class="submit" id="fca-submit-update-sponsors-position" style="margin-top: 20px;" title="Atualizar posições">
						Atualizar posições
					</a>
HTML;
			}
?>
		<fieldset>
			<div class="box-section info-text">
				<i class="fa fa-bullhorn"></i>
				Defina a ordem de apresentação dos patrocinadores que estão na lateral direita do site. Note que apenas patrocinadores
				ativos serão apresentados para serem ordenados. Caso não tenha ao menos um patrocinador ativo a parte de patrocinadores
				na lateral direita será omitida.
			</div>
			<ul class="sortable">
				<?php
					echo $html_Sponsor;
				?>
			</ul>
		</fieldset>
		<?php
			echo $html_UpdateButton;
		?>
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-sponsor', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar patrocinador</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão do patrocinador todos os dados dele serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-sponsor" class="ok-delete-button border-radius" title="Deletar patrocinador">
					Deletar patrocinador
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
?>