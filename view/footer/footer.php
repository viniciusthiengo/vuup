<?php
	$arraySelected = array('como-funciona'=>'',
							'criar-conta'=>'',
							'login'=>'',
							'busca'=>'',
							'perguntas-frequentes'=>'',
							'programa-de-indicacao'=>'',
							'dicas-para-organizadores'=>'',
							'trabalhe-conosco'=>'',
							'blog'=>'',
							'termos-e-condicoes-de-uso'=>'',
							'politica-de-privacidade'=>'');
							
	$arraySelected[$_GET['page']] = ' class="selected"';
?>
<footer>
	<div class="container">
		<div class="left">
			<!-- div class="box-nav">
				<div class="title">Usando o vuup</div>
				
				<ul class="first-nav">
					<li>
						<ul>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>como-funciona" title="Como funciona" <?php echo $arraySelected['como-funciona']; ?>>Como funciona</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>login" title="Criar evento" <?php echo $arraySelected['criar-evento']; ?>>Criar evento</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca" title="Buscar evento" <?php echo $arraySelected['busca']; ?>>Buscar evento</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>perguntas-frequentes" title="Perguntas frequentes" <?php echo $arraySelected['perguntas-frequentes']; ?>>Perguntas frequentes</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>programa-de-indicacao" title="Programa de indicação" <?php echo $arraySelected['programa-de-indicacao']; ?>>Programa de indicação</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>login" title="Acessar" <?php echo $arraySelected['login']; ?>>Acessar</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>dicas-para-organizadores" title="Dicas para organizadores" <?php echo $arraySelected['dicas-para-organizadores']; ?>>Dicas para organizadores</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>trabalhe-conosco" title="Trabalhe conosco" <?php echo $arraySelected['trabalhe-conosco']; ?>>Trabalhe conosco</a></li>
							<li><a href="#" title="Blog" <?php echo $arraySelected['blog']; ?>>Blog</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="vl"></div -->
			
			<div class="box-nav">
				<div class="title">Categorias</div>
				
				<ul class="first-nav">
					<li>
						<ul>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca" title="Todas as categorias">Todas as categorias</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca?ec=3" title="Curso, workshop">Curso, workshop</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca?ec=8" title="Show, música e festa">Show, música e festa</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca?ec=1" title="Congresso, seminário">Congresso, seminário</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca?ec=4" title="Encontro, networking">Encontro, networking</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca?ec=5" title="Esportivo">Esportivo</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca?ec=6" title="Feira, exposição">Feira, exposição</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca?ec=2" title="Culinária">Culinária</a></li>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>busca?ec=7" title="Religioso">Religioso</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="vl"></div>
			
			<div class="box-nav">
				<ul class="first-nav without-title">
					<li>
						<ul>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>termos-e-condicoes-de-uso" title="Termos e condições de uso" <?php echo $arraySelected['termos-e-condicoes-de-uso']; ?>>Termos e condições de uso</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li><a href="<?php echo __PATH_FOR_LONG_URL__; ?>politica-de-privacidade" title="Política de privacidade" <?php echo $arraySelected['politica-de-privacidade']; ?>>Política de privacidade</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li><a href="https://vuup.zendesk.com" target="_blank" title="Perguntas frequentes">Perguntas frequentes</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		
		
		<div class="right">
			<div class="like-box">
				<div class="fb-like-box" data-href="https://www.facebook.com/vuupbr" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-width="235" data-height="200" data-show-border="false"></div>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=350312291805346&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
			</div>
			
			<div class="box-nav">
				<div class="title">Fale conosco</div>
				<ul class="first-nav">
					<li class="info-contact">
						<ul>
							<li>
								<br /><br />
								<i class="fa fa-phone"></i>
								+55 <?php echo __VUUP_PHONE__; ?>
							</li>
							<li>
								<i class="fa fa-envelope"></i>
								contato@vuup.com.br
							</li>
							<li>
								<a href="https://www.facebook.com/vuupbr" target="_blank" title="Facebook">
									<i class="fa fa-facebook-square"></i>
									Facebook
								</a>
							</li>
							<li>
								<a href="https://twitter.com/Vuupbr" target="_blank" title="Facebook">
									<i class="fa fa-twitter"></i>
									Twitter
								</a>
							</li>
							<!-- li>
								<i class="fa fa-skype"></i>
								vuupbr
							</li -->
						</ul>
					</li>
					<!-- li>
						<ul>
							<li>
								<a href="#" title="Blog">
									<i class="fa fa-comment"></i>
									Blog
								</a>
							</li>
							<li>
								<a href="#" title="Twitter">
									<i class="fa fa-twitter-square"></i>
									Twitter
								</a>
							</li>
							<li>
								<a href="https://www.facebook.com/vuupbr" target="_blank" title="Facebook">
									<i class="fa fa-facebook-square"></i>
									Facebook
								</a>
							</li>
							<li>
								<a href="#" title="Google+">
									<i class="fa fa-google-plus-square"></i>
									Google+
								</a>
							</li>
						</ul>
					</li -->
				</ul>
			</div>
			
			<div class="cl"></div>
			<div class="vl"></div>
			
			<a href="http://iugu.com/" class="payment-method" target="_blank" title="Pagamento por Iugu">
				<img src="<?php echo __PATH_FOR_LONG_URL__; ?>img/system/logo/pagamentos-por-iugu-padrao.png" height="30" />
			</a>
		</div>
		<div class="cl"></div>
		<div class="vl full"></div>
		
		<div class="box-copyright">
			&copy; <?php echo date('Y'); ?> vuup - Todos os direitos reservados
		</div>
	</div>
</footer>

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?2RDPzkn8LjwwpcL5LYoX1ZuMcZ5a9aKt';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->