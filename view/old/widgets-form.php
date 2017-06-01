<?php
	
	if(strcasecmp('get-form-widgets', $_POST['method']) == 0 || empty($_POST['method'])){
	
		
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php">
			<h2>
				Widgets laterais
			</h2>
			<div class="content-inner">
				<fieldset>
					<ul class="sortable widgets-side">
						<?php
							if(!is_null($arrayWidgetPosition) && count($arrayWidgetPosition) > 0){
								
								$html_WidgetPosition = '';
								for($i = 0, $tam = count($arrayWidgetPosition); $i < $tam; $i++){
									$name = $arrayWidgetPosition[$i]->getName();
									$label = $arrayWidgetPosition[$i]->getLabel();
									$position = $arrayWidgetPosition[$i]->getPosition().'º';
									
									$html_WidgetPosition .= <<<HTML
										<li>
											<div class="direction border-radius"><i class="fa fa-arrows-v"></i></div>
											<div class="info">
												<span title="$name">$label</span>
											</div>
											<div class="position border-radius">
												$position
											</div>
											<div class="cl"></div>
										</li>
HTML;
								}
								echo $html_WidgetPosition;
							}
							else{
								require_once(__PATH__.'/view/widgets-make.php');
							}
						?>
					</ul>
				</fieldset>
				<a href="#" class="submit" id="fca-submit-update-widget-side" style="margin-top: 20px;" title="Atualizar posições widgets">
					Atualizar posições widgets
				</a>
				<div class="cl"></div>
			</div>
		</form>
<?php
	}
?>