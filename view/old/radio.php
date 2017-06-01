<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="MIBEC, Ministério Betel em Células" />
		<meta name="description" content="Ministério Betel em Células" />
		
		<title>Rádio</title>
		
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				//require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end TOP -->
	</head>
	
	
	
	<body>
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- end TOP -->
		
		
		
		
		<!-- start CENTER -->
			<section id="center">
				<div class="left page">
					<h1>Rádio</h1>
					
					<br />
					<br />
					
					<?php
						// RADIO
							if($radio->getStatus() == 1){
								echo '<iframe id="radio-iframe" src="http://player.dyb.fm/igrejaadefe?theme=minihc4&chromeColor=cc3333&fontColor=ffffff&play=1" style="width:690px; height:130px;border:0;" frameborder="0" allowtransparency="true"></iframe>';
								//echo '<frame id="radio-iframe" name="topFrame" scrolling="no" toolbar="yes" width="600" height="600" src="http://www.maisouvida.com/~maisouve/?r=Mibec&amp;s=885aacplus10912.stream&amp;i=74.222.3.235&amp;p=10912&amp;w=inforwebhost2.virtuaserver.com.br&amp;a=pt10912aac885112&amp;on=9d1t4rrknk3u"></iframe>';
							}
					
					
						// TOP DAY
							if(count($arrayTopDay) > 0){
								echo '<div class="top-10-box">';
								echo '<div class="title">Top '.$radio->getTotal().' do Dia</div>';
								
								$html_Top = '';
								for($i = 0, $tam = count($arrayTopDay); $i < $tam; $i++){
									
									$html_Top .= '<td><span>'.($i + 1).'ª</span> '.$arrayTopDay[$i]->getArtist().' - '.$arrayTopDay[$i]->getMusic().'</td>';
									$html_Top = $i % 2 == 1 ? '<tr>'.$html_Top.'</tr>' : $html_Top;
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
									
									$html_Top .= '<td><span>'.($i + 1).'ª</span> '.$arrayTopWeek[$i]->getArtist().' - '.$arrayTopWeek[$i]->getMusic().'</td>';
									$html_Top = $i % 2 == 1 ? '<tr>'.$html_Top.'</tr>' : $html_Top;
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
									
									$html_Top .= '<td><span>'.($i + 1).'ª</span> '.$arrayTopMonth[$i]->getArtist().' - '.$arrayTopMonth[$i]->getMusic().'</td>';
									$html_Top = $i % 2 == 1 ? '<tr>'.$html_Top.'</tr>' : $html_Top;
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
									
									$html_Top .= '<td><span>'.($i + 1).'ª</span> '.$arrayTopYear[$i]->getArtist().' - '.$arrayTopYear[$i]->getMusic().'</td>';
									$html_Top = $i % 2 == 1 ? '<tr>'.$html_Top.'</tr>' : $html_Top;
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
									<div class="fb-comments" data-href="http://www.mibec.com.br/radio" data-width="690" data-numposts="50" data-colorscheme="light"></div>
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
				
				
				
				
				<!-- start RIGHT -->
					<?php
						require_once(__PATH__.'/view/body/right.php');
					?>
				<!-- end RIGHT -->
				<div class="cl"></div>
			</section>
		<!-- end CENTER -->
		
		
		
      

		
		<!-- start FOOTER -->
			<?php
				require_once(__PATH__.'/view/footer/footer.php');
				require_once(__PATH__.'/view/footer/js.php');
			?>
			<script type="text/javascript">
				var urlCtrl = 'package/ctrl/CtrlAdmin.php';
				var methodLikes = 'radio-update-likes-facebook';
				var methodComments = 'radio-update-comments-facebook';
				var url = '<?php echo $_SERVER['SCRIPT_URI']; ?>';
				var post = <?php echo $radio->getId(); ?>;
				getfbcount(urlCtrl, methodLikes, url, post);
				getfbcommentscount(urlCtrl, methodComments, url, post);
			</script>
		<!-- end FOOTER -->
	</body>
</html>