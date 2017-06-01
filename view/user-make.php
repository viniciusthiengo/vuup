<?php
	$html = '';
	
	
	if(preg_match('/^(vu-get-user-sign-up){1}$/', $_POST['method'])){
		if(!$error->hasError()){
			if($return == 1){
				$name = $user->getName();
				$email = $user->getEmail();
				$html = <<<HTML
					<div class="modal-main-content br-3">
						<h2>
							<i class="fa fa-angellist"></i>
							Cadastro realizado... agora é só confirmar
							<a href="#" title="Fechar" class="link-close">
								<i class="fa fa-times-circle"></i>
							</a>
						</h2>
						<div class="wrap-content">
							<div class="login-box">
								<br />
								<br />
								Olá <b>$name</b>,
								<br />
								Seu cadastro foi realizado com sucesso.
								<br /><br />
								Para que seu acesso ao vuup seja liberado você terá de entrar em seu email (<b>$email</b>) e
								<u>clicar no link de confirmação de conta</u> enviado no email de "Confirmação de Cadastro" do vuup.
								<br /><br />
								Seja bem-vindo(a)!
								<br />
								<br />
								<br />
							</div>
						</div>
					</div>
HTML;
			}
			else{
				$html = <<<HTML
					<div class="modal-main-content br-3">
						<h2>
							<i class="fa fa-meh-o"></i>
							Ops! Falhou... tente novamente
							<a href="#" title="Fechar" class="link-close">
								<i class="fa fa-times-circle"></i>
							</a>
						</h2>
						<div class="wrap-content">
							<div class="login-box">
								<br />
								<br />
								Ops!
								<br />
								<br />
								Houve uma falha no momento do cadastro, certifique-se de que preencheu todos os campos e envie novamente o
								cadastro.
								<br />
								<br />
								<br />
							</div>
						</div>
					</div>
HTML;
			}
		}
	}
	
	
	else if(preg_match('/^(vu-user-login){1}$/', $_POST['method'])){
		if($return == 1 && is_object($user) && $user->getStatus() != 2 && $user->getStatus() != 1){
			$return = 0;
			$name = $user->getName();
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-ban"></i>
						Conta desativada
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="login-box">
							<br />
							<br />
							Olá <b>$name</b>,
							<br />
							<br />
							Sua conta no vuup encontra-se desativada, provavelmente você recebeu um email informando o motivo
							da suspensão de conta. Caso ainda tenha suas dúvidas entre em contato pelo email <b>contato@vuup.com.br</b>
							<br /><br />
							Att,
							<br />
							<i>Equipe vuup</i>
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
HTML;
		}
		else if($return == 1 && is_object($user) && $user->getStatus() == 2){
			$return = 0;
			$name = $user->getName();
			$email = $user->getEmail();
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-ban"></i>
						Conta ainda não confirmada
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="login-box">
							<br />
							<br />
							Olá <b></b>,
							<br />
							<br />
							<u>Sua conta no vuup ainda não foi confirmada</u>, você precisa entrar no email <b>$email</b> e confirmar
							o cadastro no vuup. Caso não tenho recebido o email entre em contato com <b>contato@vuup.com.br</b>.
							<br /><br />
							Att,
							<br />
							<i>Equipe vuup</i>
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
HTML;
		}
	}
	else if(preg_match('/^(vu-mob-user-login){1}$/', $_POST['method'])){
		if($return == 1 && is_object($user) && $user->getStatus() != 2 && $user->getStatus() != 1){
			$return = 0;
			$error = new Error();
			$error->setHasError(true);
			$error->setCodeError(1);
			$error->setPasswordError(new ErrorBlock('Sua conta no vuup encontra-se desativada, provavelmente você recebeu um email informando o motivo da suspensão de conta. Caso ainda tenha suas dúvidas entre em contato pelo email contato@vuup.com.br', true));
		}
		else if($return == 1 && is_object($user) && $user->getStatus() == 2){
			$return = 0;
			$email = $user->getEmail();
			$error = new Error();
			$error->setHasError(true);
			$error->setCodeError(1);
			$error->setPasswordError(new ErrorBlock('Sua conta no vuup ainda não foi confirmada, você precisa entrar no email <b>$email</b> e confirmar o cadastro no vuup. Caso não tenho recebido o email entre em contato pelo endereço contato@vuup.com.br', true));
		}
		else if($return == 0){
			$error = new Error();
			$error->setHasError(true);
			$error->setPasswordError(new ErrorBlock('Nome de login e senha inválidos', true));
		}
	}
	
	
	else if(preg_match('/^(vu-get-user-dashboard|vu-get-user-update-form){1}$/', $_POST['method'])){
		$urlSufix = $user->getUrlSufix();
		$name = $user->getName();
		$email = $user->getEmail();
		$description = $user->getDescription();
		$img = $user->getImageUrl('img/user/150-150/');
		$imgClose = $user->getImageCloseStatus();
		/*$cpf = $user->getCpf();
		$phoneCode = $user->getPhone()->getCode();
		$phoneNumber = $user->getPhone()->getNumber();
		$cep = $user->getAddress()->getCep();
		$street = $user->getAddress()->getStreet();
		$number = $user->getAddress()->getNumber();
		$city = $user->getAddress()->getCity();
		$stateOptions = $user->getAddress()->getState();
		$stateOptions = $stateOptions->getOptions();*/
		
	
		$html = <<<HTML
			<div class="form">
				<form class="fct-box-img profile-photo" action="package/ctrl/CtrlFile.php">
					<div class="mask br-3">
						<div class="content">
							<img class="img-load" src="img/system/load/load-01.GIF" width="15" height="15" />
							Carregando foto
						</div>
					</div>
					<img src="$img" class="br-03 main-img" width="150" height="150" />
					<input class="input-file" type="file" name="fct-img">
					<div class="br-03 remove" $imgClose title="Remover"><i class="fa fa-times"></i></div>
					<a href="#" class="load-img br-3" title="Carregar foto">
						<i class="fa fa-upload"></i>
						Carregar foto
					</a>
					<input name="method" type="hidden" value="" />
				</form>
				
				<div class="box-field left-wm sub-container-user">
					<a href="http://www.vuup.com.br/$urlSufix" target="_blank" class="link-url-vuup">
						vuup.com.br/<b>$urlSufix</b>
						<i class="fa fa-external-link-square"></i>
					</a>
					
					<div class="box-field left">
						<input type="text" id="fct-fullname" class="br-3" value="$name" placeholder="*Nome completo" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o nome completo
						</span>
					</div>
					
					<div class="box-field left">
						<input type="text" id="fct-email" value="$email" class="br-3" placeholder="*Email" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Email inválido
						</span>
					</div>
					<div class="cl"></div>
					
					<div class="box-field left">
						<textarea id="fct-fulldescription" class="br-3" placeholder="*Descrição">$description</textarea>
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe uma descrição completa em sua página
						</span>
					</div>
					<div class="cl"></div>
					
					<!-- div class="box-field left">
						<input type="text" id="fct-user-cpf" value="$cpf" class="br-3" placeholder="CPF" maxlength="11" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o CPF
						</span>
					</div>
					<div class="box-field left">
						<input type="text" id="fct-user-phone-code" class="br-3" placeholder="DDD" maxlength="2" value="$phoneCode" />
						<input type="text" id="fct-user-phone-number" class="br-3" placeholder="Telefone" maxlength="10" value="$phoneNumber" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe um telefone
						</span>
					</div>
					<div class="cl"></div>
					
					<div class="box-field left">
						<input type="text" id="fct-user-cep" value="$cep" class="br-3" placeholder="CEP" maxlength="10" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o CEP
						</span>
					</div>
					<div class="box-field left">
						<input type="text" id="fct-user-street" value="$street" class="br-3" placeholder="Logradouro" maxlength="25" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o logradouro
						</span>
					</div>
					<div class="cl"></div>
					
					<div class="box-field left">
						<input type="text" id="fct-user-number" value="$number" class="br-3" placeholder="Número" maxlength="7" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o nº
						</span>
					</div>
					<div class="box-field left">
						<input type="text" id="fct-user-city" value="$city" class="br-3" placeholder="Cidade" maxlength="25" />
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe a cidade
						</span>
					</div>
					<div class="box-field left">
						<select id="fct-user-state" class="br-3">
							$stateOptions
						</select>
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o estado
						</span>
					</div -->
				</div>
				
				<div class="cl"></div>
				<div class="vl"></div>
				
				<div class="box-buttons">
					<a href="#" id="fct-update-user" class="bt br-3" title="Atualizar">
						<i class="fa fa-send"></i>
						Atualizar
					</a>
				</div>
				<div class="cl"></div>
				
				<input id="fct-method" name="method" type="hidden" value="">
			</div>
HTML;

		// DASHBOARD
			if(preg_match('/^(vu-get-user-dashboard){1}$/', $_POST['method'])){
				$html = <<<HTML
					<nav>
							<ul class="box-header-buttons">
								<li>
									<a href="package/ctrl/CtrlUser.php|vu-get-user-update-form" class="selected" title="Dados de perfil">
										<i class="fa fa-chevron-down"></i>
										Dados de perfil
									</a>
								</li>
								<li class="vl"></li>
								<li>
									<a href="package/ctrl/CtrlUser.php|vu-get-user-bank-form" class="open-bank-account" title="Dados conta bancária">
										<i class="fa fa-chevron-right"></i>
										Dados conta bancária
									</a>
								</li>
								<li class="vl"></li>
								<li>
									<a href="package/ctrl/CtrlUser.php|vu-get-user-pass-form" title="Alterar senha">
										<i class="fa fa-chevron-right"></i>
										Alterar senha
									</a>
								</li>
								<!-- li class="vl"></li>
								<li>
									<a href="package/ctrl/CtrlUser.php|vu-get-user-remove-account" title="Remover conta">
										<i class="fa fa-chevron-right"></i>
										Remover conta
									</a>
								</li -->
								<li class="cl"></li>
							</ul>
							<div class="cl"></div>
						</nav>
						<div class="sub-content">
							$html
						</div>
HTML;
			}
	}
	
	
	else if(preg_match('/^(vu-get-user-pass-form){1}$/', $_POST['method'])){
		$html = <<<HTML
			<div class="form">
				<div class="box-field">
					<input type="password" id="fct-actually-password" class="br-3" placeholder="*Senha atual" maxlength="20" />
					<div class="cl"></div>
					<span class="error">
						<i class="fa fa-times"></i>
						Informe a senha atual
					</span>
				</div>
				<div class="cl"></div>
				
				<div class="box-field">
					<input type="password" id="fct-new-password" class="br-3" placeholder="*Nova senha" maxlength="20" />
					<div class="cl"></div>
					<span class="error">
						<i class="fa fa-times"></i>
						Informe a nova senha
					</span>
				</div>
				<div class="cl"></div>
				
				<div class="box-field">
					<input type="password" id="fct-confirm-password" class="br-3" placeholder="*Confirmar nova senha" maxlength="20" />
					<div class="cl"></div>
					<span class="error">
						<i class="fa fa-times"></i>
						Nova senha não confirmada
					</span>
				</div>
				<div class="cl"></div>
				<div class="vl"></div>
				
				<div class="box-buttons">
					<a href="#" id="fct-update-password" class="bt br-3" title="Alterar senha">
						<i class="fa fa-send"></i>
						Alterar senha
					</a>
				</div>
				<div class="cl"></div>
			</div>
HTML;
	}
	
	else if(preg_match('/^(vu-get-user-bank-form|vu-get-user-bank-update){1}$/', $_POST['method'])){
		if(preg_match('/^(vu-get-user-bank-form){1}$/', $_POST['method'])){
			$statusAccount = array('analysis', 'Não há conta bancária válida aceita');
			$typeAccount = array('checked="checked"', '');
			$bankBrand = array('', '', '', '', '');
			$agency = '';
			$number = '';
			$digit = '';
			$operation = '';
			$documentUrl = array('img/system/bg/doc-150x150.png', '#', '');
			
			if(is_object($user->getBank())){
				$statusAccount = array($user->getBank()->getClassStatus(), $user->getBank()->getLabelStatus());
				$typeAccount = array('', '');
				$typeAccount[$user->getBank()->getBankTypeAccount()->getItem() - 1] = 'checked="checked"';
				$bankBrand[$user->getBank()->getBankBrand()->getItem() - 1] = 'checked="checked"';
				$agency = $user->getBank()->getAgency();
				$number = $user->getBank()->getNumber();
				$digit = $user->getBank()->getDigit();
				$operation = $user->getBank()->getOperation();
				$documentUrl[0] = 'img/system/bg/doc-ok-150x150.png';
				$documentUrl[1] = $user->getBank()->getDocumentUrl('file/user/');
				$documentUrl[2] = 'style="display: block;"';
			}
		
			$html = <<<HTML
				<div class="form">
					<p class="tip br-3">
						<i class="fa fa-info-circle"></i>
						Todos os dados aqui devem ser do dono da conta bancária. Esses dados são necessários para que o vuup
						possa depositar o dinheiro diretamente em sua conta. 
					</p>
					
					<div class="box-field">
						<div class="status-bank $statusAccount[0]">
							<i class="fa fa-circle"></i>
							$statusAccount[1]
						</div>
					</div>
					
					<div class="box-field">
						<i class="fa fa-briefcase"></i>
						Tipo conta:<br />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="radio" name="fct-type-account" value="1" $typeAccount[0] />
							Pessoa física
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="radio" name="fct-type-account" value="2" $typeAccount[1] />
							Pessoa jurídica
						</label>
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o tipo de conta
						</span>
					</div>
					
					<div class="box-field">
						<i class="fa fa-bank"></i>
						Banco:<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="radio" name="fct-bank" value="1" $bankBrand[0] />
							Itaú
						</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="radio" name="fct-bank" value="2" $bankBrand[1] />
							Bradesco
						</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="radio" name="fct-bank" value="3" $bankBrand[2] />
							Banco do Brasil
						</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="radio" name="fct-bank" value="4" $bankBrand[3] />
							Santander
						</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
							<input type="radio" name="fct-bank" value="5" $bankBrand[4] />
							Caixa Econômica Federal
						</label>
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Informe o banco
						</span>
					</div>
					<div class="cl"></div>
					<div class="box-account-data">
						<div class="title">
							<i class="fa fa-building"></i>
							Conta:
						</div>
						<div class="bank-sub-content">
							<div class="box-field left">
								<input type="text" id="fct-agency" class="br-3" placeholder="*Agência" value="$agency" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe a agência
								</span>
							</div>
							<div class="box-field left">
								<input type="text" id="fct-account" class="br-3" placeholder="*Nº da conta" value="$number" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe o número da conta
								</span>
							</div>
							<div class="box-field left">
								<input type="text" id="fct-digit" class="br-3" placeholder="*Dígito" value="$digit" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe o dígito
								</span>
							</div>
							<div class="box-field left">
								<input type="text" id="fct-operation" class="br-3" placeholder="*Operação" value="$operation" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe a operação
								</span>
							</div>
						</div>
						<div class="cl"></div>
					</div>
					
					<div class="box-account-data">
						<div class="title">
							<i class="fa fa-folder-open"></i>
							Cópia de um documento oficial com CPF:
						</div>
						
						<div class="bank-sub-content">
							<form class="fct-box-img doc-file" action="package/ctrl/CtrlFile.php">
								<div class="mask br-3">
									<div class="content">
										<img class="img-load" src="img/system/load/load-01.gif" width="15" height="15" />
										Carregando
									</div>
								</div>
								<img src="$documentUrl[0]" class="br-03" width="150" height="150" />
								<input class="input-file" type="file" name="fct-doc-file">
								<div class="br-03 remove" $documentUrl[2] title="Remover"><i class="fa fa-times"></i></div>
								<a href="#" class="load-img br-3" title="Carregar documento">
									<i class="fa fa-upload"></i>
									Carregar documento
								</a>
								<a href="$documentUrl[1]" $documentUrl[2] class="br-3 download-doc" title="Download">
									<i class="fa fa-download"></i>
									Download
								</a>
								<input name="method" type="hidden" value="" />
								<span class="error">
									<i class="fa fa-times"></i>
									Forneça um documento
								</span>
							</form>
							<div class="cl"></div>
						</div>
					</div>
					<div class="cl"><br /><br /></div>
					
					<div class="box-field" style="margin-bottom: 0;">
						<input id="fct-password" class="br-3" type="password" maxlength="20" placeholder="*Senha">
						<div class="cl"></div>
						<span class="error">
							<i class="fa fa-times"></i>
							Senha inválida
						</span>
					</div>
					<div class="vl"></div>
					
					<div class="box-buttons">
						<a href="#" id="fct-bank-account" class="bt br-3" title="Enviar">
							<i class="fa fa-send"></i>
							Enviar
						</a>
					</div>
					<div class="cl"></div>
					
					<input id="fct-method" name="method" type="hidden" value="">
				</div>
HTML;
		}
		else if($return > 1){
			$name = $user->getName();
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-bank"></i>
						Dados conta bancária em análise
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="login-box">
							<br />
							<br />
							Olá <b>$name</b>,
							<br />
							Os dados de sua conta bancária para recebimento de pagamentos foram enviados.
							<br />
							<br />
							Agora basta aguardar a aprovação da conta no vuup. Note que esse passo é necessário para aumentar a segurança dos usuários da plataforma.
							<br /><br />
							Diante desse período de análise (até 24 horas) <u>todos os eventos criados por você ficaram "suspensos"</u> até a aceitação da nova configuração de conta bancária.
							<br /><br />
							Se houver dúvidas você pode estar entrando em contato pelo email <b>contato@vuup.com.br</b>
							<br /><br />
							Att,
							<br />
							Equipe vuup
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
HTML;
		}
	}
	
	else if(preg_match('/^(vu-get-user-remove-account){1}$/', $_POST['method'])){
		$html = <<<HTML
			<div class="form">
				<p class="tip br-3">
					<i class="fa fa-info-circle"></i>
					Informe abaixo o motivo da remoção de conta no vuup. Para poder remover sua conta é necessário
					fornecer a senha para nos certificarmos que é você mesmo.
				</p>
				<div class="box-field box-radios">
					<label>
						<input type="radio" name="fct-remove-account-reason" value="1" />
						Fiz apenas uma conta para conhecer a plataforma;
					</label>
					<label>
						<input type="radio" name="fct-remove-account-reason" value="2" />
						Já utilizo uma outra plataforma de ingressos online;
					</label>
					<label>
						<input type="radio" name="fct-remove-account-reason" value="3" />
						Não consegui entender e utilizar a plataforma;
					</label>
					<label>
						<input type="radio" name="fct-remove-account-reason" value="4" />
						A plataforma não me passou segurança para colocar meus dados de cartão de crédito e bancários;
					</label>
					<label>
						<input type="radio" name="fct-remove-account-reason" value="5" />
						Ainda não me sinto confiante com essas plataformas de ingresso online;
					</label>
					<label>
						<input type="radio" name="fct-remove-account-reason" value="6" />
						Não tem eventos de minha cidade;
					</label>
					<label>
						<input type="radio" name="fct-remove-account-reason" class="radio-other" value="7" />
						Outro:
					</label>
					<input type="text" class="br-3" id="fct-remove-account-reason-other" placeholder="*Motivo" maxlength="150" disabled="disabled" />
					
					<div class="cl"></div>
					<span class="error">
						<i class="fa fa-times"></i>
						Informe o motivo
					</span>
				</div>
				<div class="cl"></div>
				
				<div class="box-field">
					<input type="password" id="fct-password" class="br-3" placeholder="*Senha" />
					<div class="cl"></div>
					<span class="error">
						<i class="fa fa-times"></i>
						Informe a senha
					</span>
				</div>
				<div class="cl"></div>
				<div class="vl"></div>
				
				<div class="box-buttons">
					<a href="#" id="fct-remove-account" class="bt br-3" title="Remover conta">
						<i class="fa fa-send"></i>
						Remover conta
					</a>
				</div>
				<div class="cl"></div>
			</div>
HTML;
	}
	
	else if(preg_match('/^(vu-get-form-promoter-message){1}$/', $_POST['method'])){
		$img = __PATH_FULL_PREFIX__.'img/user/30-30/event-01.jpg';
		$html = <<<HTML
			<div class="modal-main-content br-3">
				<h2>
					<i class="fa fa-envelope"></i>
					Mensagem a promoter
					<a href="#" title="Fechar" class="link-close">
						<i class="fa fa-times-circle"></i>
					</a>
				</h2>
				<div class="wrap-content">
					<div class="contact-box">
						<div class="info">
							<img src="$img" width="30" height="30" />
							<span>
								Juliano Almeida Cunha
							</span>
							<div class="cl"></div>
						</div>
						<div class="vl"></div>
						
						<form class="form">
							<div class="box-field">
								<textarea id="fct-promoter-message" class="br-3" placeholder="*Mensagem"></textarea>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe uma mensagem com no mínimo 5 caracteres.
								</span>
							</div>
						</form>
						<div class="cl"></div>
						<div class="vl"></div>
						
						<a href="#" id="submit-promoter-message" class="bt br-3" title="Enviar">
							<i class="fa fa-send"></i>
							Enviar
						</a>
						<div class="cl"></div>
					</div>
				</div>
			</div>
HTML;
	}
	
	else if(preg_match('/^(vu-get-form-organizer-event-message|vu-get-form-organizer-event-message-in-page){1}$/', $_POST['method'])){
		
		if(is_object($event)){
			$mainId = $event->getId();
			$eventName = '<br /><a href="'.$event->getFullUrl().'" target="_blank" title="'.$event->getName().'"> <i class="fa fa-beer"></i> '.$event->getName().'</a>';
			$eventPhone = '<br /><i class="fa fa-phone"></i> '.$event->getPhone()->getPhoneHumanFormated();
			$ownerImg = $event->getUser()->getImageUrl(__PATH_FULL_PREFIX__.'img/user/50-50/');
			$ownerName = $event->getUser()->getName();
			$ownerUrl = __PATH_FULL_PREFIX__.$event->getUser()->getUrlSufix();
		}
		else{
			$mainId = $ownerUser->getId();
			$ownerImg = $ownerUser->getImageUrl(__PATH_FULL_PREFIX__.'img/user/50-50/');
			$ownerName = $ownerUser->getName();
			$ownerUrl = __PATH_FULL_PREFIX__.$ownerUser->getUrlSufix();
		}
		
		if(preg_match('/^(vu-get-form-organizer-event-message-in-page){1}$/', $_POST['method']) && $user->getId() == 0){
			$html = <<<HTML
				<div class="box-field box-field-mb">
					<input id="fct-name" type="text" class="br-3" placeholder="*Nome" />
					<div class="cl"></div>
					<span class="error">
						<i class="fa fa-times"></i>
						Informe seu nome
					</span>
				</div>
				
				<div class="box-field box-field-mb">
					<input id="fct-email" type="text" class="br-3" placeholder="*Email" />
					<div class="cl"></div>
					<span class="error">
						<i class="fa fa-times"></i>
						Informe seu email para contato
					</span>
				</div>
HTML;
		}
		
		$html = <<<HTML
			<div class="modal-main-content br-3">
				<h2>
					<i class="fa fa-envelope"></i>
					Mensagem a organizador do evento
					<a href="#" title="Fechar" class="link-close">
						<i class="fa fa-times-circle"></i>
					</a>
				</h2>
				<div class="wrap-content">
					<div class="contact-box">
						<div class="info organizer">
							<img src="$ownerImg" width="50" height="50" />
							<span>
								<a href="$ownerUrl" target="_blank" title="$ownerName">
									$ownerName
									<i class="fa fa-external-link"></i>
								</a>
								$eventName
								$eventPhone
							</span>
							<div class="cl"></div>
						</div>
						<div class="vl"></div>
						
						<form class="form">
							$html
							<div class="box-field">
								<textarea id="fct-promoter-message" class="br-3" placeholder="*Mensagem de contato"></textarea>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe uma mensagem com no mínimo 5 caracteres.
								</span>
							</div>
							<input id="fct-main-id" type="hidden" value="$mainId" />
						</form>
						<div class="cl"></div>
						<div class="vl"></div>
						
						<a href="#" id="submit-promoter-message" class="bt br-3" title="Enviar">
							<i class="fa fa-send"></i>
							Enviar
						</a>
						<div class="cl"></div>
					</div>
				</div>
			</div>
HTML;
	}
	
	
	else if(preg_match('/^(vu-get-user-gift-ticket){1}$/', $_POST['method'])){
		for($i = 0, $tamI = count($arrayObj); $i < $tamI; $i++){
			$id = $arrayObj[$i]->getId();
			$name = $arrayObj[$i]->getName();
			$url = __PATH_FOR_LONG_URL__.$arrayObj[$i]->getUrlSufix();
			$img = __PATH_FOR_LONG_URL__.$arrayObj[$i]->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/50-50/');
			$numberEventLabel = $arrayObj[$i]->getNumberEventLabel();
			$numberFollowersLabel = $arrayObj[$i]->getNumberFollowerLabel();
			
			$html .= <<<HTML
				<div class="user br-3">
					<img src="$img" width="50" height="50" />
					<div class="info">
						<a href="$url" class="title" target="_blank" title="$name">
							$name
							<i class="fa fa-external-link"></i>
						</a>
						<div>
							$numberEventLabel
						</div>
						<div>
							$numberFollowersLabel
						</div>
					</div>
					<div class="box-field user-hackcode">
						<input name="fct-radio-user" type="radio" class="br-3" value="$id" />
						<div class="cl"></div>
					</div>
					<div class="cl"></div>
				</div>
HTML;
		}
		
		
		// EMPTY
			if(empty($html)){
				$text = $user->getSearch()->getText();
				$html = <<<HTML
					<p class="no-content">
						<i class="fa fa-frown-o"></i>
						Nenhum usuário encontrado para o nome <b>$text</b>
					</p>
HTML;
			}
	}
	
	
	else if(preg_match('/^(vu-get-gift-ticket-form){1}$/', $_POST['method'])){
		$id = $ticket->getIdTicketPayment();
		$ownerUserId = $ticket->getEvent()->getUser()->getId();
		
		$html = <<<HTML
			<div class="modal-main-content br-3">
				<h2>
					<i class="fa fa-gift"></i>
					Repassar ingresso
					<a href="#" title="Fechar" class="link-close">
						<i class="fa fa-times-circle"></i>
					</a>
				</h2>
				<div class="wrap-content">
					<div class="gift-ticket-box">
						<form class="form">
							<div class="box-field">
								<input id="fct-search-user" type="text" class="br-3" placeholder="*Usuário vuup" />
								<div class="cl"></div>
							</div>
							<div class="vl"></div>
							<div class="users-box"></div>
							<div class="vl"></div>
							<div class="box-error br-3">
								<i class="fa fa-times"></i>
								Selecione o usuário
							</div>
							<input id="fct-owner" type="hidden" value="$ownerUserId" />
							<a href="package/ctrl/CtrlUser.php|vu-get-user-gift-ticket-step-confirm|$id" id="submit-gift-ticket" class="bt br-3" title="Continuar">
								Continuar
								<i class="fa fa-arrow-right"></i>
							</a>
						</form>
					</div>
				</div>
			</div>
HTML;
	}
	
	
	else if(preg_match('/^(vu-get-user-gift-ticket-step-confirm){1}$/', $_POST['method'])){
		$userRepassId = $userRepass->getId();
		$userRepassName = $userRepass->getName();
		$userRepassUrl = __PATH_FOR_LONG_URL__.$userRepass->getUrlSufix();
		$userRepassImg = $userRepass->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/50-50/');
		$numberEventLabel = $userRepass->getNumberEventLabel();
		$numberFollowerLabel = $userRepass->getNumberFollowerLabel();
		
		$eventName = $ticket->getEvent()->getName();
		$eventUrl = $ticket->getEvent()->getFullUrl();
		$eventImg = $ticket->getEvent()->getImgBannerUrl(__PATH_FOR_LONG_URL__.'img/event/67-80/');
		$eventAddress = $ticket->getEvent()->getAddress()->getCity().', '.$ticket->getEvent()->getAddress()->getState()->getLabelCodeItem();
		
		$ticketDayLabel = $ticket->getTicketValidDaysHumanFormat().' a partir:';
		$ticketDayDay = $ticket->getTicketDay()->getDaySeccondsToBrazilDate();
		$ticketDayTime = $ticket->getTicketDay()->getTimeSeccondsToBrazilDate();
		
		$ticketId = $ticket->getIdTicketPayment();
		$ticketPaymentIdAsCode = $ticket->getIdTicketPaymentAsCode();
		$ticketName = $ticket->getName();
		$ticketPrice = $ticket->getEvent()->getTicketTypeCharge() == 1 ? '' : '(R$ '.$ticket->getPriceHumanFormated($ticket->getEvent()->getTicketTypeTaxes(), false, false, true).')';
		$ticketQRCodeImg = $ticket->getQRCodeImg();
		
		$html = <<<HTML
			<div class="contact-box">
				<p class="tip br-3">
					<i class="fa fa-info-circle"></i>
					<u>Com a passagem de ingresso realizada você não mais poderá acessar esse ingresso, pois você terá
					dado ele a outro usuário</u>. Informe sua senha e confirme para finalizar a transação.
				</p>
				<div class="vl"></div>
				<div class="info organizer">
					<img src="$eventImg" height="80" />
					<span>
						<a href="#" target="_blank" title="$eventName">
							<i class="fa fa-beer"></i>
							$eventName
						</a>
						<br />
						<div>
							<i class="fa fa-map-marker"></i>
							$eventAddress
						</div>
						<div class="normal-info">
							<i class="fa fa-qrcode"></i>
							Código: <b>$ticketPaymentIdAsCode</b>
						</div>
						<div>
							<i class="fa fa-calendar"></i>
							$ticketDayLabel $ticketDayDay
							<i class="fa fa-clock-o"></i>
							$ticketDayTime
						</div>
						<div>
							<i class="fa fa-ticket"></i>
							$ticketName $ticketPrice
						</div>
					</span>
					
					<img src="$ticketQRCodeImg" class="img-qrcode" width="70" height="70" />
					<div class="cl"></div>
				</div>
				<div class="vl"></div>
				<div class="info organizer">
					<img src="$userRepassImg" width="50" height="50" />
					<span>
						<a href="$userRepassUrl" target="_blank" title="$userRepassName">
							$userRepassName
							<i class="fa fa-external-link"></i>
						</a>
						<br />
						<div>
							$numberEventLabel
						</div>
						<div>
							$numberFollowerLabel
						</div>
					</span>
					<div class="cl"></div>
				</div>
				<div class="vl"></div>
				
				<form class="form">
					<div class="box-field">
						<input id="fct-password" type="password" class="br-3" placeholder="*Senha" />
						<span class="error">
							<i class="fa fa-times"></i>
							Informe a senha
						</span>
					</div>
					<input id="fct-ticket" type="hidden" value="$ticketId" />
					<input id="fct-user" type="hidden" value="$userRepassId" />
				</form>
				<div class="cl"></div>
				<div class="vl"></div>
				
				<a href="#" class="bt-cancel br-3" title="Voltar">
					<i class="fa fa-reply"></i>
					Voltar
				</a>
				<a href="#" id="submit-repass-ticket" class="bt br-3" title="Confirmar repasse de ingresso">
					<i class="fa fa-send"></i>
					Confirmar repasse de ingresso
				</a>
				<div class="cl"></div>
			</div>
HTML;
	}
	
	
	else if(preg_match('/^(vu-get-user-gift-ticket-step-finish){1}$/', $_POST['method'])){
		if($return == 1){
			$eventUrl = $ticket->getEvent()->getFullUrl();
			$eventName = $ticket->getEvent()->getName();
			
			$userRepassName = $userRepass->getName();
			$userRepassUrl = __PATH_FOR_LONG_URL__.$userRepass->getUrlSufix();
			
			$paymentTime = date('d\/m\/Y \à\s H\hi', $ticket->getPayment()->getTime());
			
			$ticketDayLabel = $ticket->getTicketValidDaysHumanFormat().' a partir:';
			$ticketDayDay = $ticket->getTicketDay()->getDayPage(false).', '.$ticket->getTicketDay()->getDaySeccondsToBrazilDate();
			$ticketDayTime = $ticket->getTicketDay()->getTimeSeccondsToBrazilDate();
			
			$ticketPaymentIdAsCode = $ticket->getIdTicketPaymentAsCode();
			$ticketName = $ticket->getName();
			$ticketPrice = $ticket->getEvent()->getTicketTypeCharge() == 1 ? '' : '(R$ '.$ticket->getPriceHumanFormated($ticket->getEvent()->getTicketTypeTaxes(), false, false, true).')';
			$ticketQRCodeImg = $ticket->getQRCodeImg();
			
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-angellist"></i>
						Ingresso repassado com sucesso!
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="login-box">
							<br />
							<br />
							Olá <b>$name</b>,
							<br />
							O ingresso para o evento <a href="$eventUrl" target="_blank" title="$eventName">$eventName</a>
							foi repassado com sucesso para <a href="$userRepassUrl" target="_blank" title="$userRepassName">$userRepassName</a>
							(ele recebeu uma notificação também em email).
							<br /><br />
							<div class="box-info-ticket br-3">
								<div class="wrap-info">
									<b>Info ingresso:</b>
									<div class="info">
										<div class="normal-info">
											<i class="fa fa-qrcode"></i>
											Código: <b>$ticketPaymentIdAsCode</b>
										</div>
										<div class="normal-info">
											<i class="fa fa-caret-square-o-right"></i>
											Comprado em: $paymentTime
										</div>
										<div class="normal-info">
											<i class="fa fa-calendar"></i>
											$ticketDayLabel $ticketDayDay   
											<i class="fa fa-clock-o"></i>
											$ticketDayTime
										</div>
										<div class="normal-info">
											<i class="fa fa-ticket"></i>
											$ticketName $ticketPrice
										</div>
									</div>
								</div>
								<img src="$ticketQRCodeImg" width="80" height="80" />
								<div class="cl"></div>
							</div>
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
HTML;
		}
	}
	
	
	else if(preg_match('/^(vu-get-user-login-form){1}$/', $_POST['method'])){
		$signUpUrl = __PATH_FULL_PREFIX__.'inscrever-se';
		$forgotPasswordUrl = __PATH_FULL_PREFIX__.'esqueceu-a-senha';
		
		$parametersUrl = '';
		foreach($_POST as $key=>$value){
			$parametersUrl .= $key.'='.$value.'&';
		}
		$parametersUrl = rtrim($parametersUrl, '&');
		
		$html = <<<HTML
			<div class="modal-main-content br-3">
				<h2>
					<i class="fa fa-sign-in"></i>
					Login
					<a href="#" title="Fechar" class="link-close">
						<i class="fa fa-times-circle"></i>
					</a>
				</h2>
				<div class="wrap-content">
					<div class="login-box">
						<p class="tip br-3">
							<i class="fa fa-info-circle"></i>
							Realize o login para continuar com a compra. Se ainda não tem conta cadastre-se
							<a href="$signUpUrl" title="Inscrever-se">clicando aqui.</a>
						</p>
						<div class="vl"></div>
						<form class="form">
							<div class="box-field box-field-mb">
								<input type="text" id="fct-email" class="br-3" placeholder="*Email" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe o email de login
								</span>
							</div>
							
							<div class="box-field">
								<input type="password" id="fct-password" class="br-3" placeholder="*Senha" />
								<div class="cl"></div>
								<span class="error">
									<i class="fa fa-times"></i>
									Informe a senha
								</span>
							</div>
							<input type="hidden" id="fct-parameters" value="$parametersUrl" />
						</form>
						<div class="cl"></div>
						<div class="vl"></div>
						<a href="$signUpUrl" class="bt br-3 signup" title="Inscrever-se">
							Inscrever-se
						</a>
						
						<a href="#" id="submit-login" class="bt br-3" title="Entrar">
							Entrar
						</a>
						<div class="cl"></div>
						
						<div class="box-bottom-data">
							<label>
								<input id="fct-remember" type="checkbox" checked="checked" value="1">
								Mantenha-me conectado
							</label>
							<a title="Esqueceu a senha?" href="$forgotPasswordUrl"> Esqueceu a senha? </a>
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
					</div>
				</div>
			</div>
HTML;
	}
	
	
	else if(preg_match('/^(vu-save-forgot-password|vu-reset-forgot-password){1}$/', $_POST['method'])){
		if(preg_match('/^(vu-save-forgot-password){1}$/', $_POST['method'])){
			if($return >= 1){
				$userName = $forgotPassword->getUser()->getName();
				$userEmail = $forgotPassword->getUser()->getEmail();
				
				$html = <<<HTML
					<div class="modal-main-content br-3">
						<h2>
							<i class="fa fa-shield"></i>
							Processo de recuperação de senha iniciado
							<a href="#" title="Fechar" class="link-close">
								<i class="fa fa-times-circle"></i>
							</a>
						</h2>
						<div class="wrap-content">
							<div class="contact-box">
								<br />
								<br />
								Olá $userName,
								<br />
								<br />
								Um email com o passo necessário para recuperação de senha (resetar senha) foi enviado ao endereço 
								<b>$userEmail</b>.
								<br />
								<br />
								<br />
								<br />
							</div>
						</div>
					</div>
HTML;
			}
		}
		else{
			if($return >= 1){
				$userName = $forgotPassword->getUser()->getName();
				$userEmail = $forgotPassword->getUser()->getEmail();
				
				$html = <<<HTML
					<div class="modal-main-content br-3">
						<h2>
							<i class="fa fa-shield"></i>
							Senha atualizada
							<a href="#" title="Fechar" class="link-close">
								<i class="fa fa-times-circle"></i>
							</a>
						</h2>
						<div class="wrap-content">
							<div class="contact-box links-box">
								<br />
								<br />
								Olá $userName,
								<br />
								<br />
								Sua senha em vuup na conta de email <b>$userEmail</b> foi atualizada com sucesso.
								<br />
								Agora é só acessar sua conta novamente. <a href="../login" title="Login">Login</a>
								<br />
								<br />
								<br />
								<br />
							</div>
						</div>
					</div>
HTML;
			}
		}
	}


	echo json_encode( array('feedback'=>$return,
		'isFollow'=>$isFollow,
		'html'=>utf8_encode($html),
		'user'=>(is_object($user) ? $user->getDataJSON() : ''),
		'error'=>(is_object($error) ? $error->getDataJSON() : ''),
		'synchronizedData'=>$synchronizedData) );
