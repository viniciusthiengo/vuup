<?php

	/*$name = 'Minist�rio';
	$id = 2;
	if(preg_match('/^(get-form-page|get-form-page-mission){1}$/', $_POST['method'])){
		$name = 'Miss�o';
		$id = 1;
	}*/
	
	
	if(strcasecmp('get-form-page', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				P�ginas
				<a href="package/ctrl/CtrlAdmin.php|<?php echo $arrayPage[1]->getUrl(); ?>|<?php echo $arrayPage[1]->getId(); ?>" class="inner-link border-radius" title="Minist�rio"><?php echo $arrayPage[1]->getName(); ?></a>
				<a href="package/ctrl/CtrlAdmin.php|<?php echo $arrayPage[0]->getUrl(); ?>|<?php echo $arrayPage[0]->getId(); ?>" class="inner-link select border-radius" title="Miss�o"><?php echo $arrayPage[0]->getName(); ?></a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Conte�do principal</div>
						<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"><?php echo $arrayPage[0]->getContent(); ?></textarea>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-update-page" title="Atualizar p�gina">
					Atualizar p�gina
				</a>
				<input type="hidden" name="method" id="fca-method" value="" />
				<input type="hidden" name="id" id="fca-id" value="<?php echo $arrayPage[0]->getId(); ?>" />
				<input type="hidden" name="name" id="fca-name" value="<?php echo $arrayPage[0]->getName(); ?>" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-page-mission', $_POST['method']) == 0 || strcasecmp('get-form-page-ministery', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Conte�do principal</div>
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"><?php echo $page->getContent(); ?></textarea>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-page" title="Atualizar p�gina">
			Atualizar p�gina
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<input type="hidden" name="id" id="fca-id" value="<?php echo $page->getId(); ?>" />
		<input type="hidden" name="name" id="fca-name" value="<?php echo $page->getName(); ?>" />
		<div class="cl"></div>
<?php
	}