<?php
	$arrayRadioMusic = $radioList->getArrayRadioMusic();
	$tam = count($arrayRadioMusic);
	$html_RadioMusic = '';
	
	for($i = 0; $i < $tam; $i++){
		$indice = $i + 1;
		$music = $arrayRadioMusic[$i]->getMusic();
		$artist = $arrayRadioMusic[$i]->getArtist();
		$votes = $arrayRadioMusic[$i]->getVotes();
		
		$html_RadioMusic .= <<<HTML
			<li class="embed music">
				<i class="fa fa-volume-up icon-video"></i>
				<input type="text" id="fca-music-p-$indice" placeholder="*Música" value="$music" />
				-
				<input type="text" id="fca-artist-p-$indice" placeholder="*Artista / Banda" value="$artist" />
				-
				<input type="text" id="fca-votes-p-$indice" placeholder="*Votos" value="$votes" />
				<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
				<div class="cl"></div>
			</li>
HTML;
	}
	echo $html_RadioMusic;
?>