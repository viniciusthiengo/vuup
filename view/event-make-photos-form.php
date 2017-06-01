<?php
	$html_Photos = <<<HTML
		<form class="fct-box-img box-photo br-3" action="package/ctrl/CtrlFile.php">
			<div class="mask br-3">
				<div class="content">
					<img class="img-load" src="img/system/load/load-01.GIF" width="15" height="15" />
					Carregando
				</div>
			</div>
			<img src="img/system/bg/img-98x98.png" class="br-03 main-img" width="98" height="98" />
			<input class="input-file" type="file" name="fct-img">
			<div class="br-03 remove remove-photo" title="Remover"><i class="fa fa-times"></i></div>
			<a href="#" class="load-img br-3" title="Carregar">
				<i class="fa fa-upload"></i>
				Carregar
			</a>
			<input name="method" type="hidden" value="" />
		</form>
HTML;

	if(is_object($event) && count($event->getPhotosArray()) > 0){
		$arrayObj = $event->getPhotosArray();
		$boxPhotosStatus = 'style="display: block;"';
		$boxPhotosIcon = '<i class="fa fa-chevron-circle-down"></i>';
		$html_aux = '';
		
		for($i = 0, $tamI = count($arrayObj); $i < $tamI; $i++){
			$photoUrl = __PATH_FOR_LONG_URL__.'img/event/photo/98-98/'.$arrayObj[$i]->getName();
			$html_aux .= <<<HTML
				<form class="fct-box-img box-photo br-3" action="package/ctrl/CtrlFile.php">
					<div class="mask br-3">
						<div class="content">
							<img class="img-load" src="img/system/load/load-01.GIF" width="15" height="15" />
							Carregando
						</div>
					</div>
					<img src="$photoUrl" class="br-03 main-img" width="98" height="98" />
					<input class="input-file" type="file" name="fct-img">
					<div class="br-03 remove remove-photo" title="Remover" style="display: block;"><i class="fa fa-times"></i></div>
					<a href="#" class="load-img br-3" title="Carregar">
						<i class="fa fa-upload"></i>
						Carregar
					</a>
					<input name="method" type="hidden" value="" />
				</form>
HTML;
		}
		$html_Photos = $html_aux.$html_Photos;
	}
?>