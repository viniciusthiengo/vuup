<?php
	if(count($arrayBannerTop) > 0){
		
		$html_BannerTop = '';
		for($i = 0, $tam = count($arrayBannerTop); $i < $tam; $i++){
			$img = $arrayBannerTop[$i]->getImage()->getRealName();
			$title = $arrayBannerTop[$i]->getTitle();
			$description = $arrayBannerTop[$i]->getDescription();
			$url = $arrayBannerTop[$i]->getUrl();
			
			$html_BannerTop .= <<<HTML
				<div class="container" title="">
					<img src="img/banner/690-306/$img" alt="Shore" width="690" height="306" />
					<a href="$url" title="$title" target="_blank">
						<span>$title</span>
						$description
						<em>entrar&nbsp;<i class="fa fa-long-arrow-right"></i></em>
					</a>
				</div>
HTML;
		}
		
		$html_BannerTop = <<<HTML
			<div class="slide">
				$html_BannerTop
			</div>
			<div class="cl"></div>
HTML;
		echo $html_BannerTop;
	}
?>