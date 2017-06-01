<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="vuup" />
		<meta name="description" content="" />
		<meta property="og:image" content="" />
		
		<title>Inscrever-se</title>
		
		<!-- start CSS -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end CSS -->
	</head>
	
	
	
	<body>
		<!-- HEADER -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- HEADER -->
		
		
		
		
		
		<!-- MAIN -->
			<main>
				<!-- a href="#" class="bt-facebook br-3" title="Inscreva-se com sua conta do Facebook">
					<i class="fa fa-facebook-square"></i> &nbsp;
					Inscreva-se com sua conta do Facebook
				</a>
				
				<div class="box-or">
					<span class="line-or"></span>
					ou
					<span class="line-or"></span>
				</div -->
				
				<form id="form-login" class="form br-3 form-sign-up">
					<div class="top">
						<h2>Inscrever-se</h2>
						Já tem uma conta? <a href="<?php echo __PATH_FOR_LONG_URL__; ?>login" title="Login">Login</a>
					</div>
					
					<div class="box-field">
						<b>vuup.com.br/</b>
						<input type="text" id="fl-page" class="br-3" placeholder="*Página" maxlength="50" />
						<input id="fl-page-url" type="hidden" value="package/ctrl/CtrlUser.php" />
						<input id="fl-page-method" type="hidden" value="vu-validate-url-person" />
						<div class="box-show-info hackcode-2">
							<i class="fa fa-question-circle"></i>
							<div class="info br-3">
								<div class="arrow-top-right"></div>
								Essa é a URL de sua página no vuup. O seu login é seu email que será cadastrado abaixo.
							</div>
						</div>
						<div class="cl"></div>
						<span class="error" style="margin-left: 170px;">
							<i class="fa fa-times"></i>
							Url personalizada inválida
						</span>
						<div class="mask-input br-3 url-person">
							<img width="16" src="img/system/load/load-01.GIF">
							Validando...
						</div>
					</div>
					
					<div class="box-field left">
						<input type="text" id="fl-fullname" class="br-3" placeholder="*Nome" maxlength="20" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o nome completo
						</span>
					</div>
					<div class="box-field right">
						<input type="text" id="fl-email" class="br-3 short-email" placeholder="*Email (login)" maxlength="100" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Email inválido
						</span>
					</div>
					<div class="cl"></div>
					
					<div class="box-field">
						<input type="password" id="fl-password" class="br-3" placeholder="*Senha" maxlength="30" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o password (mínimo 8 caracteres)
						</span>
					</div>
					<!-- p class="tip br-3">
						<i class="fa fa-info-circle"></i>
						Por que esses dados também? Para que você possa realizar compras de ingresso esses dados são necessários.
					</p>
					<div class="box-field left">
						<input type="text" id="fl-cpf" class="br-3" placeholder="*CPF" maxlength="11" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o CPF
						</span>
					</div>
					<div class="box-field right">
						<input type="text" id="fl-phone-code" class="br-3" placeholder="*DDD" maxlength="2" />
						<input type="text" id="fl-phone-number" class="br-3" placeholder="*Tel." maxlength="10" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe um telefone
						</span>
					</div>
					<div class="cl"></div>
					
					<div class="box-field left">
						<input type="text" id="fl-cep" class="br-3" placeholder="*CEP" maxlength="10" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o CEP
						</span>
					</div>
					<div class="box-field left">
						<input type="text" id="fl-street" class="br-3" placeholder="*Logradouro" maxlength="25" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o logradouro
						</span>
					</div>
					<div class="box-field right">
						<input type="text" id="fl-number" class="br-3" placeholder="*Nº" maxlength="10" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o nº
						</span>
					</div>
					<div class="cl"></div>
					
					<div class="box-field left">
						<input type="text" id="fl-city" class="br-3" placeholder="*Cidade" maxlength="10" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe a cidade
						</span>
					</div>
					<div class="box-field right">
						<select id="fl-state" class="br-3">
							<?php
								//$stateOptions = new State();
								//echo $stateOptions->getOptions();
							?>
						</select>
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o estado
						</span>
					</div>
					<div class="cl"></div -->
					
					<div class="box-field">
						<button type="submit" id="fl-submit-sign-up" class="br-3 bt-form" title="Inscrever">Inscrever</button>
						<div class="cl"></div>
					</div>
					
					<div class="bottom">
						<p>
							Ao inscrever-se, eu concordo com
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>termos-e-condicoes-de-uso" target="_blank" title="Termos e condições de uso">Termos e condições de uso</a>
							e com a
							<a href="<?php echo __PATH_FOR_LONG_URL__; ?>politica-de-privacidade" target="_blank" title="Política de privacidade">Política de privacidade</a>
						</p>
					</div>
				</form>
			</main>
		<!-- MAIN -->
		
		
		
		
		

		
		<!-- start FOOTER -->
			<?php
				require_once(__PATH__.'/view/footer/footer.php');
				require_once(__PATH__.'/view/footer/js.php');
			?>
		<!-- end FOOTER -->
	</body>
</html>