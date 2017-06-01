<?php
	if(strcasecmp('get-form-banner', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Banners
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-banner-lateral" class="inner-link border-radius" title="Editar (lateral)">Editar (lateral)</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-banner-lateral" class="inner-link border-radius" title="Novo (lateral)">Novo (lateral)</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-sort-banner" class="inner-link border-radius" title="Ordem (home)">Ordem (home)</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-update-banner" class="inner-link border-radius" title="Editar (home)">Editar (home)</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-new-banner" class="inner-link select border-radius" title="Novo (home)">Novo (home)</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Dados</div>
						<input type="text" id="fca-urllink-p" placeholder="*URL (link na web ou site mibec, para onde o usuário será direcionado no clique)" />
						<input type="text" id="fca-title-p" placeholder="*Título" />
						<textarea id="fca-description-p" placeholder="Descrição"></textarea>
						<div class="box-count-post">
							<i class="icon-keyboard"></i>
							<span id="fca-description-p-count"><?php echo __LIMIT_DESCRIPTION_BANNER__; ?></span>
							<span class="number"><?php echo __LIMIT_DESCRIPTION_BANNER__; ?></span>
						</div>
						<div class="cl"></div>
						<label>
							<input type="checkbox" id="fca-available-p" checked="checked" />
							Ativo
						</label>
					</div>
					
					<div class="box-section">
						<div class="title">Imagem banner <span>(dimensões recomendadas: 690 x 306)</span></div>
						<div class="box-main-img banner-home">
							<img src="img/system/bg/post-02.png" style="margin-right: 0;" width="627" height="278" />
							<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
							<a href="#" title="Carregar">
								<i class="fa fa-cloud-upload"></i>
								Carregar banner
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
				<a href="#" class="submit" id="fca-submit-new-banner" title="Criar banner">
					Criar banner
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<input type="hidden" name="type" id="fca-type" value="1" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-new-banner', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Dados</div>
				<input type="text" id="fca-urllink-p" placeholder="*URL (link na web ou site mibec, para onde o usuário será direcionado no clique)" />
				<input type="text" id="fca-title-p" placeholder="*Título" />
				<textarea id="fca-description-p" placeholder="Descrição"></textarea>
				<div class="box-count-post">
					<i class="icon-keyboard"></i>
					<span id="fca-description-p-count"><?php echo __LIMIT_DESCRIPTION_BANNER__; ?></span>
					<span class="number"><?php echo __LIMIT_DESCRIPTION_BANNER__; ?></span>
				</div>
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Ativo
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Imagem banner (home) <span>(dimensões recomendadas: 690 x 306)</span></div>
				<div class="box-main-img banner-home">
					<img src="img/system/bg/post-02.png" style="margin-right: 0;" width="627" height="278" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar banner
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
		<a href="#" class="submit" id="fca-submit-new-banner" title="Criar banner">
			Criar banner
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="type" id="fca-type" value="1" />
		<div class="cl"></div>
<?php
	}
	else if(preg_match('/^(get-form-update-banner|get-form-update-banner-lateral){1}$/', $_POST['method'])){
		$tam = count($arrayBanner);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_BANNER__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|'.$arrayBanner[0]->getMethodLoadMore().'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// BANNER TO UPDATE
			$html_Banner = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayBanner[$i]->getId();
				$title = $arrayBanner[$i]->getTitle();
				$time = date('d\/m\/Y \à\s H\hi', $arrayBanner[$i]->getTime());
				
				$method = $arrayBanner[$i]->getMethod();
				$width = $arrayBanner[$i]->getType() == 1 ? 113 : 50;
				$image = $arrayBanner[$i]->getPathImg().$arrayBanner[$i]->getImage()->getRealName();
				
				$statusIcon = $arrayBanner[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
				$user = is_object($arrayBanner[$i]->getUser()) ? $arrayBanner[$i]->getUser()->getName() : 'Criador indefinido';
				
				$html_Banner .= <<<HTML
					<li id="bn-$id">
						<img src="$image" width="$width" height="50" />
						<div class="info">
							<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
							$statusIcon
							<div class="cl"></div>
							$title
						</div>
						<a href="package/ctrl/CtrlAdmin.php|$method|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
		
		// INFORM TO BANNER LATERAL
			$inform = '';
			if($tam > 0 && $arrayBanner[0]->getType() == 2){
				$inform = <<<HTML
					<div class="box-section info-text">
						<i class="fa fa-bullhorn"></i>
						Note que somente o último banner lateral ativo é que será apresentado na faixa lateral do site.
					</div>
HTML;
			}
		
		if(empty($html_Banner)){
			$html_Banner = <<<HTML
				<li>
					<i class="fa fa-warning"></i>
					Nenhum banner encontrado.
				</li>
HTML;
		}
?>
		<fieldset>
			<?php
				echo $inform;
			?>
			<ul class="sortable edit-post banners">
				<?php
					echo $html_Banner;
				?>
			</ul>
			<?php
				echo $html_LoadMore;
			?>
		</fieldset>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(preg_match('/^(load-more-banner|load-more-banner-lateral){1}$/', $_POST['method'])){
		$tam = count($arrayBanner);
		$html_LoadMore = '';
		
		// LOAD MORE BUTTON
			if($tam == __LIMIT_BANNER__){
				$tam--;
				$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|'.$arrayBanner[0]->getMethodLoadMore().'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
			}
		
		// BANNER TO UPDATE
			$html_Banner = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayBanner[$i]->getId();
				$title = $arrayBanner[$i]->getTitle();
				$time = date('d\/m\/Y \à\s H\hi', $arrayBanner[$i]->getTime());
				$image = $arrayBanner[$i]->getImage()->getRealName();
				
				$method = $arrayBanner[$i]->getMethod();
				$width = $arrayBanner[$i]->getType() == 1 ? 113 : 50;
				$image = $arrayBanner[$i]->getPathImg().$arrayBanner[$i]->getImage()->getRealName();
				
				$statusIcon = $arrayBanner[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
				$user = is_object($arrayBanner[$i]->getUser()) ? $arrayBanner[$i]->getUser()->getName() : 'Criador indefinido';
				
				$html_Banner .= <<<HTML
					<li id="bn-$id">
						<img src="$image" width="$width" height="50" />
						<div class="info">
							<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
							$statusIcon
							<div class="cl"></div>
							$title
						</div>
						<a href="package/ctrl/CtrlAdmin.php|$method|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
						<div class="cl"></div>
					</li>
HTML;
			}
		echo $html_Banner;
		echo '|SPDATA|';
		echo $html_LoadMore;
	}
	else if(strcasecmp('get-form-update-one-banner', $_POST['method']) == 0){
		$tam = __LIMIT_DESCRIPTION_BANNER__ - strlen($banner->getDescription());
		$status = $banner->getStatus() == 1 ? 'checked="checked"' : '';
		$image = $banner->getImage()->getRealName();
		
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-banner" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Dados</div>
				<input type="text" id="fca-urllink-p" value="<?php echo $banner->getUrl(); ?>" placeholder="*URL (link na web ou site mibec, para onde o usuário será direcionado no clique)" />
				<input type="text" id="fca-title-p" value="<?php echo $banner->getTitle(); ?>" placeholder="*Título" />
				<textarea id="fca-description-p" placeholder="Descrição"><?php echo $banner->getDescription(); ?></textarea>
				<div class="box-count-post">
					<i class="icon-keyboard"></i>
					<span id="fca-description-p-count"><?php echo $tam; ?></span>
					<span class="number"><?php echo __LIMIT_DESCRIPTION_BANNER__; ?></span>
				</div>
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Ativo
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Imagem banner (home) <span>(dimensões recomendadas: 690 x 306)</span></div>
				<div class="box-main-img banner-home">
					<img src="img/banner/690-306/<?php echo $image; ?>" style="margin-right: 0;" width="627" height="278" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar banner
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
		<a href="#" class="submit" id="fca-submit-update-banner" title="Atualizar banner">
			Atualizar banner
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-banner|<?php echo $banner->getId(); ?>" class="submit delete" id="fca-submit-delete-banner" title="Deletar banner">
					Deletar banner
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="type" id="fca-type" value="<?php echo $banner->getType(); ?>" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $banner->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-ok-delete-banner', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<div id="box-modal-content" style="display: block;">
			<h2>Deletar banner</h2>
			<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
			<div class="container" style="height: 250px;">
				<p>
					<i class="fa fa-warning"></i>
					Note que se você confirmar a exclusão do banner todos os dados dele serão permanentemente excluídos.
				</p>
				<div>
					<input type="password" id="pass-to-delete" class="border-radius" placeholder="*Senha" />
				</div>
				<a href="#" id="cancel-delete-account" class="border-radius" title="Cancelar pedido">
					Cancelar pedido
				</a>
				<a href="#" id="ok-delete-banner" class="ok-delete-button border-radius" title="Deletar banner">
					Deletar banner
				</a>
			</div>
			<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
		</div>
<?php
	}
	else if(strcasecmp('get-form-new-banner-lateral', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Dados</div>
				<input type="text" id="fca-urllink-p" placeholder="*URL (link na web ou site mibec, para onde o usuário será direcionado no clique)" />
				<input type="text" id="fca-title-p" placeholder="*Título" />
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" checked="checked" />
					Ativo
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Imagem banner (lateral) <span>(dimensões recomendadas: 300px de largura)</span></div>
				<div class="box-main-img banner-home banner-lateral">
					<img src="img/system/bg/post-03.png" style="margin-right: 0;" width="300" height="300" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar banner
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
		<a href="#" class="submit" id="fca-submit-new-banner" title="Criar banner">
			Criar banner
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="type" id="fca-type" value="2" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-update-one-banner-lateral', $_POST['method']) == 0){
		$status = $banner->getStatus() == 1 ? 'checked="checked"' : '';
		$image = $banner->getImage()->getRealName();
?>
		<fieldset>
			<a href="package/ctrl/CtrlAdmin.php|get-form-update-banner-lateral" class="inner-link back-update-list border-radius" title="Voltar">Voltar</a>
			<div class="cl"></div>
			<div class="box-section">
				<div class="title">Dados</div>
				<input type="text" id="fca-urllink-p" value="<?php echo $banner->getUrl(); ?>" placeholder="*URL (link na web ou site mibec, para onde o usuário será direcionado no clique)" />
				<input type="text" id="fca-title-p" value="<?php echo $banner->getTitle(); ?>" placeholder="*Título" />
				<div class="cl"></div>
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Ativo
				</label>
			</div>
			
			<div class="box-section">
				<div class="title">Imagem banner lateral <span>(dimensões recomendadas: 300px de largura)</span></div>
				<div class="box-main-img banner-home banner-lateral">
					<img src="img/banner/300/<?php echo $image; ?>" style="margin-right: 0;" width="300" height="300" />
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img" />
					<a href="#" title="Carregar">
						<i class="fa fa-cloud-upload"></i>
						Carregar banner
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
		<a href="#" class="submit" id="fca-submit-update-banner" title="Atualizar banner">
			Atualizar banner
		</a>
		<?php
			if($user->getType() == 1){
		?>
				<a href="package/ctrl/CtrlAdmin.php|get-form-ok-delete-banner|<?php echo $banner->getId(); ?>" class="submit delete" id="fca-submit-delete-banner" title="Deletar banner">
					Deletar banner
				</a>
		<?php
			}
		?>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="type" id="fca-type" value="2" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $banner->getId(); ?>" />
		<div class="cl"></div>
<?php
	}
	else if(strcasecmp('get-form-sort-banner', $_POST['method']) == 0){
		$tam = count($arrayBanner);
		$html_UpdateButton = '';
			
		// BANNER TO UPDATE
			$html_Banner = '';
			for($i = 0; $i < $tam; $i++){
				$id = $arrayBanner[$i]->getId();
				$title = $arrayBanner[$i]->getTitle();
				$image = $arrayBanner[$i]->getImage()->getRealName();
				$position = ($i+1).'º';
				
				$html_Banner .= <<<HTML
					<li id="bn-$id">
						<div class="direction border-radius"><i class="fa fa-arrows-v"></i></div>
						<img src="img/banner/113-50/$image" width="113" height="50" />
						<div class="info">
							$title
						</div>
						<div class="position border-radius">
							$position
						</div>
						<div class="cl"></div>
					</li>
HTML;
			}
			
			if(empty($html_Banner)){
				$html_Banner = <<<HTML
					<li id="sp-$id">
						<i class="fa fa-warning"></i>
						Nenhum banner encontrado.
					</li>
HTML;
			}
			else{
				$html_UpdateButton = <<<HTML
					<a href="package/ctrl/CtrlAdmin.php|update-banner-position" class="submit" id="fca-submit-update-banners-position" style="margin-top: 20px;" title="Atualizar posições">
						Atualizar posições
					</a>
HTML;
			}
?>
		<fieldset>
			<div class="box-section info-text">
				<i class="fa fa-bullhorn"></i>
				Defina a ordem de apresentação dos banners que estão na parte superior da home do site. Note que apenas banners
				ativos serão apresentados para serem ordenados. Caso não tenha ao menos um banner ativo a galeria de banners na
				home não será apresentada.
			</div>
			<ul class="sortable">
				<?php
					echo $html_Banner;
				?>
			</ul>
		</fieldset>
		<?php
			echo $html_UpdateButton;
		?>
		<div class="cl"></div>
<?php
	}
?>