<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				//require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
			<link type="text/css" rel="stylesheet" href="<?php echo __PATH_FOR_LONG_URL__; ?>css/mibec-mobile.css" media="all" />
		<!-- end TOP -->
		<style type="text/css">
			
		</style>
	</head>
	
	
	
	<body>
		<!-- start CENTER -->
			<section id="center">
				<div class="left page">
					<h1>Rádio</h1>
					
					<br />
					<?php
						// RADIO
							if($radio->getStatus() == 1){
								//echo '<iframe id="radio-iframe" src="http://player.dyb.fm/igrejaadefe?theme=minihc4&chromeColor=cc3333&fontColor=ffffff&play=0" style="width:100%; height:130px;border:0;" frameborder="0" allowtransparency="true"></iframe>';
							}
					
					
						// TOP DAY
							if(count($arrayTopDay) > 0){
								echo '<div class="top-10-box">';
								echo '<div class="title">Top '.$radio->getTotal().' do Dia</div>';
								
								$html_Top = '';
								for($i = 0, $tam = count($arrayTopDay); $i < $tam; $i++){
									
									$html_Top .= '<tr><td><span>'.($i + 1).'ª</span> '.$arrayTopDay[$i]->getArtist().' - '.$arrayTopDay[$i]->getMusic().'</td></tr>';
								}
								echo '<table>'.$html_Top.'</table>';
								echo '</div>';
							}
						
						// TOP WEEK
							if(count($arrayTopWeek) > 0){
								echo '<div class="top-10-box">';
								echo '<div class="title">Top '.$radio->getTotal().' da Semana</div>';
								
								$html_Top = '';
								for($i = 0, $tam = count($arrayTopWeek); $i < $tam; $i++){
									
									$html_Top .= '<tr><td><span>'.($i + 1).'ª</span> '.$arrayTopWeek[$i]->getArtist().' - '.$arrayTopWeek[$i]->getMusic().'</td></tr>';
								}
								echo '<table>'.$html_Top.'</table>';
								echo '</div>';
							}
							
						// TOP MONTH
							if(count($arrayTopMonth) > 0){
								echo '<div class="top-10-box">';
								echo '<div class="title">Top '.$radio->getTotal().' do Mês</div>';
								
								$html_Top = '';
								for($i = 0, $tam = count($arrayTopMonth); $i < $tam; $i++){
									
									$html_Top .= '<tr><td><span>'.($i + 1).'ª</span> '.$arrayTopMonth[$i]->getArtist().' - '.$arrayTopMonth[$i]->getMusic().'</td></tr>';
								}
								echo '<table>'.$html_Top.'</table>';
								echo '</div>';
							}
							
						// TOP YEAR
							if(count($arrayTopYear) > 0){
								echo '<div class="top-10-box">';
								echo '<div class="title">Top '.$radio->getTotal().' do Ano</div>';
								
								$html_Top = '';
								for($i = 0, $tam = count($arrayTopYear); $i < $tam; $i++){
									
									$html_Top .= '<tr><td><span>'.($i + 1).'ª</span> '.$arrayTopYear[$i]->getArtist().' - '.$arrayTopYear[$i]->getMusic().'</td></tr>';
								}
								echo '<table>'.$html_Top.'</table>';
								echo '</div>';
							}
						
						// COMMENT
							if($radio->getStatusComment() == 1){
					?>
								<div class="comment-box">
									<div class="title">
										Comentários
									</div>
									<div class="cl"></div>
									<div class="fb-comments" data-href="http://www.villopimdw.com/radio" data-width="690" data-numposts="50" data-colorscheme="light"></div>
									<script>(function(d, s, id) {
									  var js, fjs = d.getElementsByTagName(s)[0];
									  if (d.getElementById(id)) return;
									  js = d.createElement(s); js.id = id;
									  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=574639209279867";
									  fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));</script>
								</div>
					<?php
						}
					?>
				</div>
			</section>
		<!-- end CENTER -->
		
		
		<!-- start JS -->
			<script type="text/javascript">
				MibecJavaScript.destroyProgressBar();
			</script>
			<?php
				require_once(__PATH__.'/view/footer/js.php');
			?>
			<script type="text/javascript">
				function turnOffRadio(){
					$('#radio-iframe').remove();
				}
			</script>
		<!-- end JS -->
	</body>
</html>