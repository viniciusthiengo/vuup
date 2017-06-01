<?php
	if(count($widget) > 0){
		$title = $widget[0]->getTitle();
		$text = $widget[0]->getText();
		$status = $widget[0]->getStatus() == 1 ? 'checked="checked"' : '';
		$type = $widget[0]->getType();
	}
	else{
		$widget = new Widget();
		$title = '';
		$text = '';
		$status = 'checked="checked"';
		$type = $widget->getTypeByMethod($_POST['method']);
	}
	
	if(strcasecmp('get-form-map', $_POST['method']) == 0){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Mapa MIBEC
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Embed mapa</div>
						<input type="text" id="fca-title-p" value="<?php echo $title; ?>" placeholder="*Título" />
						<textarea id="fca-code-p" placeholder="*Embed code <?php echo htmlentities('</>'); ?>"><?php echo $text; ?></textarea>
						<br />
						<label>
							<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
							Disponível
						</label>
					</div>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-update-map" title="Atualizar widget">
					Atualizar widget
				</a>
				<input type="hidden" id="fca-type" value="<?php echo $type; ?>" />
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
?>