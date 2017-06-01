<?php
	if(count($widget) > 0){
		$title = $widget[0]->getTitle();
		$code = $widget[0]->getText();
		$status = $widget[0]->getStatus() == 1 ? 'checked="checked"' : '';
		$type = $widget[0]->getType();
	}
	else{
		$widget = new Widget();
		$title = '';
		$code = '';
		$status = 'checked="checked"';
		$type = $widget->getTypeByMethod($_POST['method']);
	}
		
	if(strcasecmp('get-form-network-widget', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Widgets redes sociais
				<a href="package/ctrl/CtrlAdmin.php|get-form-nw-video" class="inner-link border-radius" title="Vídeo em destaque">Vídeo em destaque</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-nw-twitter" class="inner-link border-radius" title="Twitter">Twitter</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-nw-youtube" class="inner-link border-radius" title="YouTube">YouTube</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-nw-facebook" class="inner-link select border-radius" title="Facebook">Facebook</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section info-text">
						<i class="fa fa-bullhorn"></i>
						É recomendado que o plugin tenha a largura de 240px para que o layout do box lateral não seja afetado.
					</div>
					<div class="box-section">
						<div class="title">Codificação</div>
						<input type="text" id="fca-title-p" value="<?php echo $title; ?>" placeholder="*Título do widget lateral" />
						<textarea id="fca-code-p" placeholder="*Código plugin social"><?php echo $code; ?></textarea>
						<br />
						<label>
							<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
							Box social disponível
						</label>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-update-np" title="Atualizar widget">
					Atualizar widget
				</a>
				<input type="hidden" id="fca-type" value="<?php echo $type; ?>" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
	else if(strcasecmp('get-form-nw-facebook', $_POST['method']) == 0 || strcasecmp('get-form-nw-twitter', $_POST['method']) == 0 || strcasecmp('get-form-nw-youtube', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section info-text">
				<i class="fa fa-bullhorn"></i>
				É recomendado que o plugin tenha a largura de 240px para que o layout do box lateral não seja afetado.
			</div>
			<div class="box-section">
				<div class="title">Codificação</div>
				<input type="text" id="fca-title-p" value="<?php echo $title; ?>" placeholder="*Título do widget lateral" />
				<textarea id="fca-code-p" placeholder="*Código plugin social"><?php echo $code; ?></textarea>
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Box social disponível
				</label>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-np" title="Atualizar widget">
			Atualizar widget
		</a>
		<input type="hidden" id="fca-type" value="<?php echo $type; ?>" />
		<div class="cl"></div>
<?php
}
	else if(strcasecmp('get-form-nw-video', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section info-text">
				<i class="fa fa-bullhorn"></i>
				É recomendado que o vídeo tenha a largura de 240px para que o layout do box lateral não seja afetado.
			</div>
			<div class="box-section">
				<div class="title">Codificação</div>
				<textarea id="fca-code-p" placeholder="Embed code <?php echo htmlentities('</>'); ?>"><?php echo $code; ?></textarea>
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Vídeo em destaque disponível
				</label>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-update-np" title="Atualizar widget">
			Atualizar widget
		</a>
		<input type="hidden" id="fca-type" value="<?php echo $type; ?>" />
		<div class="cl"></div>
<?php
	}
?>