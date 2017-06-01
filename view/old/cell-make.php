<?php
	$arrayCellMember = $cell->getArrayCellMember();
	$tam = count($arrayCellMember);
	$html_CellMember = '';
	
	for($i = 0; $i < $tam; $i++){
		$indice = $i + 1;
		$name = $arrayCellMember[$i]->getName();
		$function = $arrayCellMember[$i]->getFunction();
		$image = $arrayCellMember[$i]->getImage()->getRealName();
		$status = $arrayCellMember[$i]->getStatus() == 1 ? 'checked="checked"' : '';
		$position = $arrayCellMember[$i]->getPosition().'º';
		
		
		$html_CellMember .= <<<HTML
			<li class="embed box-main-img member">
				<form action="package/ctrl/CtrlFile.php">
					<div class="direction"><i class="fa fa-arrows-v"></i></div>
					<img src="img/cell/100-100/$image" width="100" height="100" />
					<div href="#" title="Remover" class="remove border-radius" style="display: block;">
						<i class="fa fa-trash-o"></i>
					</div>
					<div class="info-photo">
						<input type="text" id="fca-title-photo-p-$indice" placeholder="*Nome" value="$name" />
						<input type="text" id="fca-position-member-p-$indice" placeholder="*Posição" value="$function" />
						<label>
							<input type="checkbox" id="fca-active-member-p-$indice" $status />
							Ativo
						</label>
					</div>
					<div class="info-photo-util">
						<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
						<div class="cl"></div>
						<div class="position border-radius"> $position</div>
						<div class="cl"></div>
					</div>
					<div class="cl"></div>
					<div class="proxy">
						Carregando foto membro...
					</div>
					<input type="file" class="input-file" name="fca-main-img" id="fca-main-img-$indice" />
					<a href="#" title="Carregar" class="load-img">
						<i class="fa fa-cloud-upload"></i>
						Carregar foto membro
					</a>
					<input type="hidden" name="method" id="fca-method" value="" />
					<div class="cl"></div>
				</form>
			</li>
HTML;
	}
	echo $html_CellMember;
?>