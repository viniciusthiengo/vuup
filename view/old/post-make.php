<?php
	$tam = count($arrayPost);
	$html_PostLeft = '';
	$html_PostRight = '';

	for($i = 0; $i < $tam; $i++){
		$url = __PATH_FOR_LONG_URL__.$arrayPost[$i]->getUrl();
		$title = $arrayPost[$i]->getTitle();
		$summary = $arrayPost[$i]->getSummary();
		$img = __PATH_FOR_LONG_URL__.'img/post/100-100/'.$arrayPost[$i]->getImage()->getRealName();
		$qtdComment = $arrayPost[$i]->getQtdComment();
		$qtdView = $arrayPost[$i]->getQtdView();
		$comments = $arrayPost[$i]->getStatusComment() == 1 ? '&bull; comentários('.$qtdComment.')' : '';
		
		if($i % 2 == 0){
			$html_PostLeft .= <<<HTML
				<a href="$url" class="post">
					<img src="$img" width="100" height="100" />
					<span>$title</span>
					<b>$comments &bull; views($qtdView)</b>
					$summary
					<em>entrar&nbsp;<i class="fa fa-long-arrow-right"></i></em>
					<div class="cl"></div>
				</a>
				<div class="hl"></div>
HTML;
		}
		else{
			$html_PostRight .= <<<HTML
				<a href="$url" class="post">
					<img src="$img" width="100" height="100" />
					<span>$title</span>
					<b>$comments &bull; views($qtdView)</b>
					$summary
					<em>entrar&nbsp;<i class="fa fa-long-arrow-right"></i></em>
					<div class="cl"></div>
				</a>
				<div class="hl"></div>
HTML;
		}
	}
?>
<div class="content-left">
	<?php
		echo $html_PostLeft;
	?>
</div>
<div class="content-right">
	<?php
		echo $html_PostRight;
	?>
</div>