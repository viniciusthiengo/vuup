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
	
	if(strcasecmp('get-form-verse-message', $_POST['method']) == 0 || empty($_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Versículo e mensagem
				<a href="package/ctrl/CtrlAdmin.php|get-form-vm-message" class="inner-link border-radius" title="Mensagem (lateral)">Mensagem (lateral)</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-vm-verse" class="inner-link select border-radius" title="Versículo (rodapé)">Versículo (rodapé)</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<div class="box-section">
						<div class="title">Conteúdo</div>
						<input type="text" id="fca-title-p" value="<?php echo $title; ?>" placeholder="*Título" />
						<textarea id="fca-code-p" placeholder="*Versículo"><?php echo $text; ?></textarea>
						<br />
						<label>
							<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
							Disponível
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
	else if(strcasecmp('get-form-vm-verse', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Conteúdo</div>
				<input type="text" id="fca-title-p" value="<?php echo $title; ?>" placeholder="*Título" />
				<textarea id="fca-code-p" placeholder="*Versículo"><?php echo $text; ?></textarea>
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Disponível
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
	else if(strcasecmp('get-form-vm-message', $_POST['method']) == 0){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Conteúdo</div>
				<input type="text" id="fca-title-p" value="<?php echo $title; ?>" placeholder="*Título" />
				<textarea id="fca-code-p" placeholder="*Mensagem"><?php echo $text; ?></textarea>
				<br />
				<label>
					<input type="checkbox" id="fca-available-p" <?php echo $status; ?> />
					Disponível
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