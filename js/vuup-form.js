// <![CDATA[
	
	// IMAGE
		// SEND
			$(document).on('change', 'input[name^="fct-img"], input[name^="fct-doc-file"]', function(){
				var $handle = $(this);
				var $form = $handle.parents('form');
				var title = $handle.siblings('a').attr('title');
				var html = $handle.siblings('a').html();
				var method = $form.hasClass('doc-file') ? 'set-tmp-doc-file' : 'set-tmp-main-img';
				
				if($handle.val().length > 0){
					$form.find('input[name="method"]').val(method);
					
					if(method == 'set-tmp-main-img' || method == 'set-tmp-main-img-search' || method == 'set-tmp-doc-file'){
						$form.find('.error').hide();
						//$handle.siblings('a').attr('title', 'Carregando...').html('Carregando...');
						$handle.siblings('div.mask').fadeIn('fast', function(){
							$form.ajaxForm({
								success: function(data) {
									data = data.split('|');
									var src = getDefaultImg($handle);
									
									if(data[0].length > 0 && data[0] != '2' && data[0] != '3'){
										src = data[0];
										$handle.parents('form.fct-box-img').eq(0).find('.remove').fadeIn('fast');
									}
									else{
										$handle.parents('form.fct-box-img').eq(0).find('.remove').fadeOut('fast');
									}
									
									if($handle.attr('name').indexOf('fct-img') > -1 || $handle.attr('name').indexOf('fct-doc-file') > -1){
										$handle.siblings('img:not(.img-load)').attr('src', src);
										enabledDownloadButton($handle, data, '');
									}
									
									$handle.siblings('a:not(.download-doc)').attr('title', title).html(html);
									$handle.siblings('div.mask').fadeOut('fast');
									addPhotoSnippet($handle, src);
								}
							}).submit();
						});
					}
				}
			});
		
		// ACTIVATE SEND
			$(document).on('click', 'form.fct-box-img a.load-img', function(e){
				e.preventDefault();
				var $handle = $(this);
				if($handle.text().indexOf('Carregar') > -1){
					$handle.siblings('input[type="file"]').trigger('click');
				}
			});
		
		// REMOVE
			$(document).on('click', 'div.remove', function(e){
				e.preventDefault();
				var $handle = $(this);
				$handle.siblings('img').attr('src', getDefaultImg($handle));
				$handle.fadeOut('fast');
				enabledDownloadButton($handle, [], false);
				
				if($handle.hasClass('remove-photo') && $handle.parents('div.hide-block').find('form.box-photo').length > 1){
					$handle.parents('form.box-photo').stop(true, true).fadeOut('fast', function(){
						$(this).remove();
					});
				}
			});
			
		// DEFAULT IMG
			function getDefaultImg($handler){
				if($handler.parents('form.banner').length > 0){
					return('img/system/bg/img-250x300.png');
				}
				else if($handler.parents('form.background-page').length > 0){
					return('img/system/bg/img-786x300.png');
				}
				else if($handler.parents('form.box-photo').length > 0){
					return('img/system/bg/img-98x98.png');
				}
				else if($handler.parents('form.profile-photo').length > 0){
					return('img/user/150-150/default.gif');
				}
				else if($handler.parents('form.doc-file').length > 0){
					return('img/system/bg/doc-150x150.png');
				}
			}
			
		// ADD PHOTO SCRIPT
			function addPhotoSnippet($handle, src){
				if($handle.parents('form.box-photo').length > 0 && src.indexOf('img-') == -1){
					$handle.parents('form.box-photo').after('<form class="fct-box-img box-photo br-3" action="package/ctrl/CtrlFile.php"> <div class="mask br-3"> <div class="content"> <img class="img-load" src="img/system/load/load-01.GIF" width="15" height="15" /> Carregando </div> </div> <img src="img/system/bg/img-98x98.png" class="br-03 main-img" width="98" height="98" /> <input class="input-file" type="file" name="fct-img"> <div class="br-03 remove remove-photo" title="Remover"><i class="fa fa-times"></i></div> <a href="#" class="load-img br-3" title="Carregar"><i class="fa fa-upload"></i> Carregar</a> <input name="method" type="hidden" value="" /> </form>');
				}
			}
			
		// DOWNLOAD BUTTON
			function enabledDownloadButton($handle, data, status){
				if($handle.siblings('a.download-doc').length > 0){
					if(status !== true && status !== false){
						if(data.length > 1 && data[1].indexOf('.zip') > -1){
							$handle.siblings('a.download-doc').attr('href', data[1]);
							$handle.siblings('a.download-doc').css('display', 'block');
						}
						else{
							$handle.siblings('a.download-doc').hide();
						}
					}
					else{
						if(status){
							$handle.siblings('a.download-doc').css('display', 'block');
						}
						else{
							$handle.siblings('a.download-doc').hide();
						}
					}
				}
			}
	
	
	// PROFILE
		// SIGN UP
			$(document).on('submit', 'form.form-sign-up', function(e){
				e.preventDefault();
				var $form = $(this);
				var $handle = $form.find('button[type="submit"]');
				
				if($handle.attr('title') != 'Inscrever' || $form.find('div.mask-input').is(':visible')){
					return(false);
				}
				
				var urlSufix = $('#fl-page').hasClass('placeholder') ? '' : $.trim($('#fl-page').val());
				var name = $('#fl-fullname').hasClass('placeholder') ? '' : $.trim($('#fl-fullname').val());
				var email = $('#fl-email').hasClass('placeholder') ? '' : $.trim($('#fl-email').val());
				var password = $('#fl-password').hasClass('placeholder') ? '' : $.trim($('#fl-password').val());
				/*var cpf = $('#fl-cpf').hasClass('placeholder') ? '' : $.trim($('#fl-cpf').val().replace(/[^\d]/g, ''));
				var phoneCode = $('#fl-phone-code').hasClass('placeholder') ? '' : $.trim($('#fl-phone-code').val().replace(/[^\d]/g, ''));
				var phoneNumber = $('#fl-phone-number').hasClass('placeholder') ? '' : $.trim($('#fl-phone-number').val().replace(/[^\d]/g, ''));
				var cep = $('#fl-cep').hasClass('placeholder') ? '' : $.trim($('#fl-cep').val().replace(/[^\d]/g, ''));
				var street = $('#fl-street').hasClass('placeholder') ? '' : $.trim($('#fl-street').val());
				var number = $('#fl-number').hasClass('placeholder') ? '' : $.trim($('#fl-number').val().replace(/[^\d]/g, ''));
				var city = $('#fl-city').hasClass('placeholder') ? '' : $.trim($('#fl-city').val());
				var state = $('#fl-state').val();*/
				
				// ERROR
					$form.find('span.error').hide();
					if(!(/^[\d\w_]{2,50}$/.test(urlSufix))){
						$('#fl-page').siblings('span.error').html('<i class="fa fa-times"></i> Url personalizada inv·lida').show();
					}
					if(name.length < 2){
						$('#fl-fullname').siblings('span.error').show();
					}
					if(!isEmail(email)){
						$('#fl-email').siblings('span.error').html('<i class="fa fa-times"></i> Email inv·lido').show();
					}
					if(!(/^([a-zA-Z0-9@*#_]{8,20})$/.test(password))){
						$('#fl-password').siblings('span.error').show();
					}
					/*if(!isCPF(cpf)){
						$('#fl-cpf').siblings('span.error').show();
					}
					if(!(/^[\d]{2}$/.test(phoneCode)) || !(/^[\d]{8,10}$/.test(phoneNumber))){
						$('#fl-phone-code').siblings('span.error').show();
					}
					if(!(/^[\d]{8}$/.test(cep))){
						$('#fl-cep').siblings('span.error').show();
					}
					if(!(/^[\d]{1,10}$/.test(number))){
						$('#fl-number').siblings('span.error').show();
					}
					if(street.length == 0){
						$('#fl-street').siblings('span.error').show();
					}
					if(city.length == 0){
						$('#fl-city').siblings('span.error').show();
					}
					if(state == 0){
						$('#fl-state').siblings('span.error').show();
					}*/
					if($form.find('span.error:visible').length > 0){
						return(false);
					}
				// ERROR
				
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
				$handle.attr('title', 'ENVIANDO...').html('ENVIANDO...');
				
				initModal('Validando cadastro...');
				//setScrollWindow(0, 500);
				$('#modal').stop(true, true).fadeIn('fast', function(){
					$ajaxHandler = $.ajax({
						url: 'package/ctrl/CtrlUser.php',
						type: 'post',
						dataType: 'json',
						data: {
							'method': 'vu-get-user-sign-up',
							'url-sufix': urlSufix,
							'name': name,
							'email': email,
							'password': password,
							/*'cpf': cpf,
							'phone-code': phoneCode,
							'phone-number': phoneNumber,
							'cep': cep,
							'street': street,
							'number': number,
							'city': city,
							'state': state*/
						}
					}).done(function(data){
						$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
							$('body').append(data.html);
							putLightBoxInCenter($('body').find('div.modal-main-content'));
							$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
							
							if(data.feedback == '1'){
								$handle.attr('title', 'CADASTRO REALIZADO!').html('CADASTRO REALIZADO!');
								$('#fl-page').val('');
								$('#fl-fullname').val('');
								$('#fl-email').val('');
								$('#fl-password').val('');
								/*$('#fl-cpf').val('');
								$('#fl-phone-code').val('');
								$('#fl-phone-number').val('');
								$('#fl-street').val('');
								$('#fl-cep').val('');
								$('#fl-number').val('');
								$('#fl-city').val('');
								$('#fl-state').val(0);*/
							}
							else{
								$handle.attr('title', 'FALHOU!').html('FALHOU!');
								if(data.error && data.error.urlSufixError && data.error.urlSufixError.isError){
									$('#modal').fadeOut('fast');
									$('#fl-page').siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.urlSufixError.message).show();
								}
								if(data.error && data.error.emailError && data.error.emailError.isError){
									$('#modal').fadeOut('fast');
									$('#fl-email').siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.emailError.message).show();
								}
							}
							setTimeout(function(){
								$handle.attr('title', 'Inscrever').html('Inscrever');
							}, 3000);
						});
					});
				});
			});
			
			
		// UPDATE
			$(document).on('click', '#fct-update-user', function(e){
				e.preventDefault();
				var $handle = $(this);
				
				if($handle.attr('title') != 'Atualizar'){ return(false); }
				
				var $form = $handle.parents('div.form');
				var name = $('#fct-fullname').hasClass('placeholder') ? '' : $.trim($('#fct-fullname').val());
				var email = $('#fct-email').hasClass('placeholder') ? '' : $.trim($('#fct-email').val());
				var description = $('#fct-fulldescription').hasClass('placeholder') ? '' : $.trim($('#fct-fulldescription').val());
				/*var cpf = $('#fct-user-cpf').hasClass('placeholder') ? '' : $.trim($('#fct-user-cpf').val().replace(/[^\d]/g, ''));
				var phoneCode = $('#fct-user-phone-code').hasClass('placeholder') ? '' : $.trim($('#fct-user-phone-code').val().replace(/[^\d]/g, ''));
				var phoneNumber = $('#fct-user-phone-number').hasClass('placeholder') ? '' : $.trim($('#fct-user-phone-number').val().replace(/[^\d]/g, ''));
				var cep = $('#fct-user-cep').hasClass('placeholder') ? '' : $.trim($('#fct-user-cep').val().replace(/[^\d]/g, ''));
				var street = $('#fct-user-street').hasClass('placeholder') ? '' : $.trim($('#fct-user-street').val());
				var number = $('#fct-user-number').hasClass('placeholder') ? '' : $.trim($('#fct-user-number').val().replace(/[^\d]/g, ''));
				var city = $('#fct-user-city').hasClass('placeholder') ? '' : $.trim($('#fct-user-city').val());
				var state = $('#fct-user-state').val();*/
				var img = $form.find('form.fct-box-img.profile-photo').find('img.main-img').attr('src');
				img = img.indexOf('default') > -1 ? '' : img;
					
				// ERROR
					$form.find('span.error').hide();
					if(name.length < 2){
						$('#fct-fullname').siblings('span.error').show();
					}
					if(!isEmail(email)){
						$('#fct-email').siblings('span.error').html('<i class="fa fa-times"></i> Email inv√°lido').show();
					}
					/*if(!isCPF(cpf)){
						$('#fct-user-cpf').siblings('span.error').show();
					}
					if(!(/^[\d]{2}$/.test(phoneCode)) || !(/^[\d]{8,10}$/.test(phoneNumber))){
						$('#fct-user-phone-code').siblings('span.error').show();
					}
					if(!(/^[\d]{8}$/.test(cep))){
						$('#fct-user-cep').siblings('span.error').show();
					}
					if(!(/^[\d]{1,10}$/.test(number))){
						$('#fct-user-number').siblings('span.error').show();
					}
					if(street.length == 0){
						$('#fct-user-street').siblings('span.error').show();
					}
					if(city.length == 0){
						$('#fct-user-city').siblings('span.error').show();
					}
					if(state == 0){
						$('#fct-user-state').siblings('span.error').show();
					}*/
					if($form.find('span.error:visible').length > 0){
						return(false);
					}
				// ERROR
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
				$handle.attr('title', 'ATUALIZANDO...').html('<img src="img/system/load/load-01.GIF" width="12" height="12" /> ATUALIZANDO...');
				
				$ajaxHandler = $.ajax({
					url: 'package/ctrl/CtrlUser.php',
					type: 'post',
					dataType: 'json',
					data: {
						'method': 'vu-get-user-update',
						'name': name,
						'email': email,
						'description': description,
						/*'cpf': cpf,
						'phone-code': phoneCode,
						'phone-number': phoneNumber,
						'cep': cep,
						'street': street,
						'number': number,
						'city': city,
						'state': state,*/
						'img-file': img
					}
				}).done(function(data){
					$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
					
					if(data.feedback == '1'){
						$handle.attr('title', 'ATUALIZA«√O REALIZADA!').html('ATUALIZA«√O REALIZADA!');
						window.location = './dashboard';
					}
					else{
						$handle.attr('title', 'FALHOU!').html('FALHOU!');
						if(data.error && data.error.emailError && data.error.emailError.isError){
							$('#fct-email').siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.emailError.message).show();
						}
					}
					setTimeout(function(){
						$handle.attr('title', 'Atualizar').html('<i class="fa fa-send"></i> Atualizar');
					}, 3000);
				});
			});
			
			
		// PASSWORD UPDATE
			$(document).on('click', '#fct-update-password', function(e){
				e.preventDefault();
				var $handle = $(this);
				
				if($handle.attr('title') != 'Alterar senha'){ return(false); }
				
				var $form = $handle.parents('div.form');
				var currentPassword = $('#fct-actually-password').hasClass('placeholder') ? '' : $.trim($('#fct-actually-password').val());
				var newPassword = $('#fct-new-password').hasClass('placeholder') ? '' : $.trim($('#fct-new-password').val());
				var confirmNewPassword = $('#fct-confirm-password').hasClass('placeholder') ? '' : $.trim($('#fct-confirm-password').val());
				
				// ERROR
					$form.find('span.error').hide();
					if(!(/^([a-zA-Z0-9@*#_]{8,20})$/.test(currentPassword))){
						$('#fct-actually-password').siblings('span.error').html('<i class="fa fa-times"></i> Senha atual inv√°lida').show();
					}
					if(!(/^([a-zA-Z0-9@*#_]{8,20})$/.test(newPassword))){
						$('#fct-new-password').siblings('span.error').show();
					}
					if(confirmNewPassword != newPassword){
						$('#fct-confirm-password').siblings('span.error').show();
					}
					if($form.find('span.error:visible').length > 0){
						return(false);
					}
				// ERROR
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
				$handle.attr('title', 'ALTERANDO SENHA...').html('<img src="img/system/load/load-01.GIF" width="12" height="12" /> ALTERANDO SENHA...');
				
				$ajaxHandler = $.ajax({
					url: 'package/ctrl/CtrlUser.php',
					type: 'post',
					dataType: 'json',
					data: {
						'method': 'vu-get-user-password-update',
						'current-password': currentPassword,
						'new-password': newPassword,
						'confirm-new-password': confirmNewPassword
					}
				}).done(function(data){
					$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
					
					if(Number(data.feedback) == 1){
						$handle.attr('title', 'SENHA ALTERADA!').html('SENHA ALTERADA!');
						$('#fct-actually-password').val('');
						$('#fct-new-password').val('');
						$('#fct-confirm-password').val('');
					}
					else{
						$handle.attr('title', 'FALHOU!').html('FALHOU!');
						if(data.error && data.error.passwordError && data.error.passwordError.isError){
							$('#fct-actually-password').siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.passwordError.message).show();
							$('#fct-actually-password').val('');
						}
					}
					setTimeout(function(){
						$handle.attr('title', 'Alterar senha').html('<i class="fa fa-send"></i> Alterar senha');
					}, 3000);
				});
			});
			
			
		// BANK ACCOUNT UPDATE
			$(document).on('click', '#fct-bank-account', function(e){
				e.preventDefault();
				var $handle = $(this);
				
				if($handle.attr('title') != 'Enviar'){ return(false); }
				
				var $form = $handle.parents('div.form');
				var currentPassword = $('#fct-password').hasClass('placeholder') ? '' : $.trim($('#fct-password').val());
				var typeAccount = $form.find('input[name="fct-type-account"]:checked').val();
				var bank = $form.find('input[name="fct-bank"]:checked').val();
				var agency = $('#fct-agency').hasClass('placeholder') ? '' : $.trim($('#fct-agency').val());
				var number = $('#fct-account').hasClass('placeholder') ? '' : $.trim($('#fct-account').val());
				var digit = $('#fct-digit').hasClass('placeholder') ? '' : $.trim($('#fct-digit').val());
				var operation = $('#fct-operation').hasClass('placeholder') ? '' : $.trim($('#fct-operation').val());
				var document = $form.find('form.fct-box-img.doc-file').find('a.download-doc').attr('href');
				document = $form.find('form.fct-box-img.doc-file').find('a.download-doc').is(':visible') ? document : '';
				
				// ERROR
					$form.find('span.error').hide();
					if(!(/^([a-zA-Z0-9@*#_]{8,20})$/.test(currentPassword))){
						$('#fct-password').siblings('span.error').show();
					}
					if(!(/^(1|2){1}$/.test(typeAccount))){
						$form.find('input[name="fct-type-account"]').parents('label').siblings('span.error').show();
					}
					if(!(/^(1|2|3|4|5){1}$/.test(bank))){
						$form.find('input[name="fct-bank"]').parents('label').siblings('span.error').show();
					}
					if(agency.length == 0){
						$('#fct-agency').siblings('span.error').show();
					}
					if(number.length == 0){
						$('#fct-account').siblings('span.error').show();
					}
					if(digit.length == 0){
						$('#fct-digit').siblings('span.error').show();
					}
					if(operation.length == 0){
						$('#fct-operation').siblings('span.error').show();
					}
					if(document.length == 0){
						$form.find('form.fct-box-img.doc-file').find('span.error').show();
					}
					if($form.find('span.error:visible').length > 0){
						return(false);
					}
				// ERROR
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
				$handle.attr('title', 'ENVIANDO...').html('<img src="img/system/load/load-01.GIF" width="12" height="12" /> ENVIANDO...');
				
				$ajaxHandler = $.ajax({
					url: 'package/ctrl/CtrlUser.php',
					type: 'post',
					dataType: 'json',
					data: {
						'method': 'vu-get-user-bank-update',
						'type-account': typeAccount,
						'bank': bank,
						'agency': agency,
						'number': number,
						'digit': digit,
						'operation': operation,
						'document': document,
						'current-password': currentPassword
					}
				}).done(function(data){
					$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
					
					if(Number(data.feedback) >= 1){
						if(data.html.length > 0){
							initModal();
							//setScrollWindow(0, 500);
							$('#modal').stop(true, true).fadeIn('fast', function(){
								$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
									$('body').append(data.html);
									putLightBoxInCenter($('body').find('div.modal-main-content'));
								});
							});
							$form.find('div.status-bank').addClass('analysis').removeClass('cancel').removeClass('open');
						}
						
						document = document.split('/');
						document = 'file/user/'+document[document.length - 1];
						$form.find('form.fct-box-img.doc-file').find('a.download-doc').attr('href', document);
						
						$handle.attr('title', 'DADOS ENVIADOS PARA AN√ÅLISE!').html('DADOS ENVIADOS PARA AN√ÅLISE!');
					}
					else{
						$handle.attr('title', 'N√ÉO HOUVE ATUALIZA√á√ÉO!').html('N√ÉO HOUVE ATUALIZA√á√ÉO!');
						if(data.error && data.error.passwordError && data.error.passwordError.isError){
							$('#fct-password').siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.passwordError.message).show();
							$('#fct-password').val('');
						}
					}
					setTimeout(function(){
						$handle.attr('title', 'Enviar').html('<i class="fa fa-send"></i> Enviar');
					}, 3000);
				});
			});
		
		
	// LOGIN submit-login
		$(document).on('submit', 'form.form-login', function(e){
			e.preventDefault();
			var $form = $(this);
			var $handle = $form.find('button[type="submit"]');
			
			if($handle.attr('title') != 'Entrar'){ return(false); }
			
			var email = $('#fl-email').hasClass('placeholder') ? '' : $.trim($('#fl-email').val());
			var password = $('#fl-password').hasClass('placeholder') ? '' : $.trim($('#fl-password').val());
			var keepMeConnected = $('#fl-remember').is(':checked') ? 1 : 0;
			
			// ERROR
				$form.find('span.error').hide();
				if(!isEmail(email)){
					$('#fl-email').siblings('span.error').show();
				}
				if(password.length < 8){
					$('#fl-password').siblings('span.error').show();
				}
				if($form.find('span.error:visible').length > 0){
					return(false);
				}
			// ERROR
			
			$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
			$handle.attr('title', 'VERIFICANDO...').html('VERIFICANDO...');
			
			$ajaxHandler = $.ajax({
				url: 'package/ctrl/CtrlUser.php',
				type: 'post',
				dataType: 'json',
				data: {
					'method': 'vu-user-login',
					'email': email,
					'password': password,
					'keep-me-connected': keepMeConnected
				}
			}).done(function(data){
				if(Number(data.feedback) == 1){
					$handle.attr('title', 'Entrando...').html('Entrando...');
					window.location = './dashboard';
				}
				else{
					if(data.html.length > 0){
						initModal();
						//setScrollWindow(0, 500);
						$('#modal').stop(true, true).fadeIn('fast', function(){
							$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
								$('body').append(data.html);
								putLightBoxInCenter($('body').find('div.modal-main-content'));
							});
						});
					}
					
					$('#fl-password').val('');
					$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
					$handle.attr('title', 'LOGIN INV√ÅLIDO!').html('LOGIN INV√ÅLIDO!');
				}
				setTimeout(function(){
					$handle.attr('title', 'Entrar').html('Entrar');
				}, 3000);
			});
		});
		
		$(document).on('click', '#submit-login', function(e){
			e.preventDefault();
			var $handle = $(this);
			var $form = $handle.parents('div.modal-main-content');
			var urlString;
			
			if($handle.attr('title') != 'Entrar'){ return(false); }
			
			var prefix = $('#event-page').length > 0 ? '../../' : './';
			var email = $('#fct-email').hasClass('placeholder') ? '' : $.trim($('#fct-email').val());
			var password = $('#fct-password').hasClass('placeholder') ? '' : $.trim($('#fct-password').val());
			var keepMeConnected = $('#fct-remember').is(':checked') ? 1 : 0;
			var parameters = $('#fct-parameters').val();
			
			// ERROR
				$form.find('span.error').hide();
				if(!isEmail(email)){
					$('#fct-email').siblings('span.error').show();
				}
				if(password.length < 8){
					$('#fct-password').siblings('span.error').show();
				}
				if($form.find('span.error:visible').length > 0){
					return(false);
				}
			// ERROR
			
			$form.find('a.link-close').hide();
			$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
			$handle.attr('title', 'VERIFICANDO...').html('<img src="'+prefix+'img/system/load/load-01.GIF" width="12" height="12" /> VERIFICANDO...');
			$ajaxHandler = $.ajax({
				url: prefix+'package/ctrl/CtrlUser.php',
				type: 'post',
				dataType: 'json',
				data: {
					'method': 'vu-user-login-go-back-page',
					'email': email,
					'password': password,
					'keep-me-connected': keepMeConnected
				}
			}).done(function(data){
				if(Number(data.feedback) == 1){
					$handle.attr('title', 'Entrando...').html('Entrando...');
					urlString = document.URL+'';
					urlString +=  urlString.indexOf('?') == -1 ? '?'+parameters : '&'+parameters;
					window.location = urlString;
				}
				else{
					$('#fct-password').val('');
					$form.find('a.link-close').show();
					$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
					$handle.attr('title', 'LOGIN INV¡LIDO!').html('LOGIN INV¡ÅLIDO!');
				}
				setTimeout(function(){
					$handle.attr('title', 'Entrar').html('Entrar');
				}, 3000);
			});
		});
		
		
	// EVENT
		// INSERT
			$(document).on('click', '#fct-create-event, #fct-update-event', function(e){
				e.preventDefault();
				var $handle = $(this);
				
				if($handle.attr('title') != 'Criar evento' && $handle.attr('title') != 'Atualizar evento'){ return(false); }
				
				var $form = $handle.parents('div.form');
				var id = $('#fct-event').val();
				var method = id == 0 ? 'vu-event-create' : 'vu-event-update';
				var sentLabel = id == 0 ? 'CRIANDO EVENTO...' : 'ATUALIZANDO EVENTO...';
				var successLabel = id == 0 ? 'EVENTO CRIADO!' : 'EVENTO ATUALIZADO!';
				var backupTitle = $handle.attr('title');
				var backupHtml = $handle.html();
				var successLabel = id == 0 ? 'EVENTO CRIADO!' : 'EVENTO ATUALIZADO!';
				var name = $('#fct-name').hasClass('placeholder') ? '' : $.trim($('#fct-name').val());
				var status = $form.find('input[name="fct-status"]:checked').val();
				var category = $('#fct-category').val();
				var phoneCode = $('#fct-phone-code').hasClass('placeholder') ? '' : $.trim($('#fct-phone-code').val()).replace(/[^\d]/g, '');
				var phoneNumber = $('#fct-phone-number').hasClass('placeholder') ? '' : $.trim($('#fct-phone-number').val()).replace(/[^\d]/g, '');
				var addressStreet = $('#fct-street').hasClass('placeholder') ? '' : $.trim($('#fct-street').val());
				var addressNeighborhood = $('#fct-neighborhood').hasClass('placeholder') ? '' : $.trim($('#fct-neighborhood').val());
				var addressCity = $('#fct-city').hasClass('placeholder') ? '' : $.trim($('#fct-city').val());
				var addressState = $('#fct-state').val();
				var addressNumber = $('#fct-number').hasClass('placeholder') ? '' : $.trim($('#fct-number').val()).replace(/[^\d]/g, '');
				var addressLatitude = $('#fct-latitude').val();
				var addressLongitude = $('#fct-longitude').val();
				var description = $('#fct-description').hasClass('placeholder') ? '' : $.trim($('#fct-description').val());
				var ticketTypeCharge = $form.find('input[name="fct-type"]:checked').val();
				var ticketEmailSend = $form.find('input[name="fct-receiver-email"]').is(':checked') ? 1 : 0;
				var ticketMaximum = $('#fct-max').hasClass('placeholder') ? '' : $.trim($('#fct-max').val()).replace(/[^\d]/g, '');
				var ticketParcels = $('#fct-parcels').val();
				var ticketTypeTaxes = $form.find('input[name="fct-rates"]:checked').val();
				var showUserConfirmed = $form.find('input[name="fct-show-user-confirmed"]').is(':checked') ? 1 : 0;
				var imgBanner = $form.find('form.fct-box-img.banner').find('img.main-img').attr('src');
				imgBanner = imgBanner.indexOf('img-') > -1 ? '' : imgBanner;
				var imgBackground = $form.find('form.fct-box-img.background-page').find('img.main-img').attr('src');
				imgBackground = imgBackground.indexOf('img-') > -1 ? '' : imgBackground;
				var video = $('#fct-video').hasClass('placeholder') ? '' : $.trim($('#fct-video').val());
				var tags = $('#fct-tags').hasClass('placeholder') ? '' : $.trim($('#fct-tags').val());
				tags = tags.split(',');
				tags = tags.join('__SPMAIN__');
				var $tickets = $form.find('div.box-field').find('div.box-lote-ticket');
				var $photos = $form.find('div.hide-block').find('form.fct-box-img.box-photo');
				var dayTicketArray = [], ticketArray, photosArray = [];
				
				// TICKETS
					for(var i = c = 0, tamI = $tickets.length; i < tamI; i++){
						var idTD = $tickets.eq(i).attr('id') == undefined ? 0 : $tickets.eq(i).attr('id').replace(/[^\d]/g, '');
						var dayT = $tickets.eq(i).find('input[id^="fct-ticket-date-day"]').hasClass('placeholder') ? '' : $.trim($tickets.eq(i).find('input[id^="fct-ticket-date-day"]').val());
						var hourT = $tickets.eq(i).find('select[id^="fct-date-hour"]').val();
						var minuteT = $tickets.eq(i).find('select[id^="fct-date-minute"]').val();
						if(/^[\d]{2}\/[\d]{2}\/[\d]{4}$/.test(dayT)){
							var $name = $tickets.eq(i).find('input[id^="fct-ticket-name"]');
							var $max = $tickets.eq(i).find('select[id^="fct-ticket-max"]');
							var $maxSell = $tickets.eq(i).find('input[id^="fct-ticket-max-sell"]');
							var $validDays = $tickets.eq(i).find('select[id^="fct-ticket-days"]');
							var $price = $tickets.eq(i).find('input[id^="fct-ticket-price"]');
							ticketArray = [];
							for(var j = d = 0, tamJ = $max.length; j < tamJ; j++){
								var idT = $tickets.eq(i).find('div.box-content-ticket').eq(j).attr('id') == undefined ? 0 : $tickets.eq(i).find('div.box-content-ticket').eq(j).attr('id').replace(/[^\d]/g, '');
								var statusT = $tickets.eq(i).find('div.box-content-ticket').eq(j).find('input[name="fct-ticket-status-'+idT+'"]').length == 0 ? 0 : $tickets.eq(i).find('div.box-content-ticket').eq(j).find('input[name="fct-ticket-status-'+idT+'"]:checked').val();
								var nameT = $name.eq(j).hasClass('placeholder') ? '' : $.trim($name.eq(j).val());
								var maxT = $max.eq(j).val();
								var maxSellT = $maxSell.eq(j).hasClass('placeholder') ? '' : $.trim($maxSell.eq(j).val());
								var validDaysT = $validDays.eq(j).val();
								var priceT = $price.eq(j).hasClass('placeholder') ? '' : $.trim($price.eq(j).val());
								priceT = Number(priceT.replace(',', '.'));
								if((ticketTypeCharge == 2 && nameT.length > 0 && maxT > 0 && isNumeric(priceT) && Number(priceT) >= 10 && isNumeric(maxSellT) && Number(maxSellT) > 0 && validDaysT > 0)
									|| (ticketTypeCharge == 1 && nameT.length > 0 && isNumeric(maxSellT) && Number(maxSellT) > 0 && validDaysT > 0)){
									ticketArray[d] = [];
									ticketArray[d][0] = idT;
									ticketArray[d][1] = statusT;
									ticketArray[d][2] = nameT;
									ticketArray[d][3] = maxT;
									ticketArray[d][4] = maxSellT;
									ticketArray[d][5] = validDaysT;
									ticketArray[d][6] = priceT;
									ticketArray[d] = ticketArray[d].join('__SPSUBDATA__');
									d++;
								}
							}
							if(ticketArray.length > 0){
								dayTicketArray[c] = [idTD, dayT, hourT, minuteT, ticketArray.join('__SPLINE__')].join('__SPDATA__');
								c++;
							}
						}
					}
					dayTicketArray = dayTicketArray.join('__SPMAIN__');
				
				// PHOTOS
					for(var i = c = 0, tamI = $photos.length; i < tamI; i++){
						var imgPhoto = $photos.eq(i).find('img.main-img').attr('src');
						imgPhoto = imgPhoto.indexOf('img-') > -1 ? '' : imgPhoto;
						
						if(imgPhoto.length > 0){
							photosArray[c++] = imgPhoto;
						}
					}
					photosArray = photosArray.join('__SPMAIN__');
				
				// ERROR
					$form.find('span.error').hide();
					if(imgBanner.length == 0){
						$form.find('form.fct-box-img.banner').find('span.error').show();
					}
					if(name.length < 2){
						$('#fct-name').siblings('span.error').show();
					}
					if(category == 0){
						$('#fct-category').siblings('span.error').show();
					}
					if(!(/^[\d]{2}$/.test(phoneCode)) && !(/^[\d]{8,10}$/.test(phoneNumber))){
						$('#fct-phone-code').siblings('span.error').show();
					}
					if(addressStreet.length == 0){
						$('#fct-street').siblings('span.error').show();
					}
					if(addressNeighborhood.length == 0){
						$('#fct-neighborhood').siblings('span.error').show();
					}
					if(addressCity.length == 0){
						$('#fct-city').siblings('span.error').show();
					}
					if(addressState == 0){
						$('#fct-state').siblings('span.error').show();
					}
					if(!(/^[\d]{1,10}$/.test(addressNumber))){
						$('#fct-number').siblings('span.error').show();
					}
					if(description.length == 0){
						$('#fct-description').siblings('span.error').show();
					}
					if(!(/^[\d]{1,10}$/.test(ticketMaximum))){
						$('#fct-max').siblings('span.error').show();
					}
					if(dayTicketArray.length == 0){
						var textError = '<i class="fa fa-times"></i> Ao menos um dia v·lido de ingresso deve ser definido.';
						textError += ticketTypeCharge == 1 ? '' : ' Para ingressos pagos: mÌnimo de R$ 10,00.';
						$form.find('div.box-field').find('div.box-lote-ticket').parents('div.box-field').find('span.error').html(textError).show();
					}
					if($form.find('span.error:visible').length > 0){
						return(false);
					}
				// ERROR
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
				$handle.attr('title', sentLabel).html('<img src="img/system/load/load-01.GIF" width="12" height="12" /> '+sentLabel);
				
				$ajaxHandler = $.ajax({
					url: 'package/ctrl/CtrlEvent.php',
					type: 'post',
					dataType: 'json',
					data: {
						'method': method,
						'id': id,
						'name': name,
						'status': status,
						'category': category,
						'phone-code': phoneCode,
						'phone-number': phoneNumber,
						'country': 1,
						'street': addressStreet,
						'neighborhood': addressNeighborhood,
						'city': addressCity,
						'state': addressState,
						'number': addressNumber,
						'latitude': addressLatitude,
						'longitude': addressLongitude,
						'description': description,
						'ticket-type-charge': ticketTypeCharge,
						'ticket-email-send': ticketEmailSend,
						'ticket-maximum': ticketMaximum,
						'ticket-parcels': ticketParcels,
						'ticket-type-taxes': ticketTypeTaxes,
						'show-user-confirmed': showUserConfirmed,
						'img-banner': imgBanner,
						'img-background': imgBackground,
						'video': video,
						'tags-array': tags,
						'tickets-array': dayTicketArray,
						'photos-array': photosArray
					}
				}).done(function(data){
					$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
					
					if(Number(data.feedback) >= 1){
						$handle.attr('title', successLabel).html(successLabel);
						if(id == 0){
							$('#fct-name').val('');
							$form.find('input[name="fct-status"]').eq(0).attr('checked', true);
							$('#fct-category').val(0);
							$('#fct-phone-code').val('');
							$('#fct-phone-number').val('');
							$('#fct-street').val('');
							$('#fct-neighborhood').val('');
							$('#fct-city').val('');
							$('#fct-state').val(0);
							$('#fct-number').val('');
							$('#fct-latitude').val('-22.912213');
							$('#fct-longitude').val('-43.188778');
							$('#fct-description').val('');
							$form.find('input[name="fct-type"]').eq(0).attr('checked', true);
							$form.find('input[name="fct-type"]:checked').trigger('change');
							$form.find('input[name="fct-receiver-email"]').attr('checked', true);
							$('#fct-max').val('');
							$('#fct-parcels').val(0);
							$form.find('input[name="fct-rates"]').eq(0).attr('checked', true);
							$form.find('input[name="fct-show-user-confirmed"]').attr('checked', true);
							$form.find('form.fct-box-img.banner').find('div.remove').trigger('click');
							
							$form.find('form.fct-box-img.background-page').find('div.remove').hide();
							$form.find('form.fct-box-img.background-page').parents('div.hide-block:visible').parents('div.box-block').eq(0).find('h2').find('a.bt-more').trigger('click');
							$form.find('form.fct-box-img.background-page').find('div.remove').trigger('click');
							
							$('#fct-video').val('');
							$('#fct-video').parents('div.hide-block').find('div.box-video').slideUp('fast', function(){
								$(this).html('');
								$('#fct-video').parents('div.hide-block:visible').parents('div.box-block').find('h2').find('a.bt-more').trigger('click');
							});
							
							$('#fct-tags').val('');
							$('#fct-tags').parents('div.hide-block:visible').parents('div.box-block').find('h2').find('a.bt-more').trigger('click');
							
							$form.find('div.box-field').find('div.box-lote-ticket').remove();
							$form.find('div.box-field').find('a.bt-day-add').before('<div class="box-lote-ticket br-3"> <a href="#" class="close-day" title="Remover dia"> <i class="fa fa-trash-o"></i> Remover dia </a> <div class="box-day-ticket br-3"> <input type="text" id="fct-ticket-date-day-1" class="br-3" placeholder="*Dia" /> <b>‡s</b> <select id="fct-date-hour-1" class="br-3"> <option value="0" selected="selected">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option> </select> <b>:</b> <select id="fct-date-minute-1" class="br-3"> <option value="0" selected="selected">00</option><option value="1">15</option><option value="2">30</option><option value="3">45</option> </select> <div class="cl"></div> </div> <div class="box-container-ticket"> <div class="box-content-ticket br-3"> <a href="#" class="close-ticket" title="Remover ingresso"> <i class="fa fa-trash-o"></i> Remover ingresso </a> <div class="box-field left-wm"> <input type="text" id="fct-ticket-name-1" class="br-3" placeholder="*Nome ingresso" /> <div class="cl"></div> </div> <div class="box-field left"> <select id="fct-ticket-max-1" class="br-3" disabled="disabled"> <option value="0" selected="selected">*M·ximo compra</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option> </select> <div class="cl"></div> </div> <div class="box-field left"> <input type="text" id="fct-ticket-price-1" class="br-3" placeholder="*R$" disabled="disabled" /> <div class="cl"></div> </div> <div class="cl"></div> <div class="box-field left-wm"> <input type="text" id="fct-ticket-max-sell-1" class="br-3" placeholder="*M·ximo em vendas" /> <div class="box-show-info hackcode-1"> <i class="fa fa-question-circle"></i> <div class="info br-3" style="display: none;"> <div class="arrow-top-right"></div> Quantidade m·xima de ingressos desse tipo que podem ser vendidos para o evento. Exemplo: <em>1000 ingressos masculinos podem ser vendidos para o evento</em> </div> </div> <div class="cl"></div> </div> <div class="box-field left"> <select id="fct-ticket-days-1" class="br-3"> <option value="0" selected="selected">*Validade em dias</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="5">6</option><option value="5">7</option><option value="5">8</option><option value="5">9</option><option value="10">10</option> </select> <div class="box-show-info hackcode-1"> <i class="fa fa-question-circle"></i> <div class="info br-3" style="display: none;"> <div class="arrow-top-right"></div> A quantidade de dias que esse tipo de ingresso È v·lido. Exemplo: <em>se 2 for selecionado isso significa que o usu·rio que comprou esse ingresso poder· ir em 2 dias de evento.</em> </div> </div> <div class="cl"></div> </div> <div class="cl"></div> </div> <a href="#" class="bt br-3 bt-ticket-add" title="Add ingresso"> <i class="fa fa-plus-circle"></i> Add ingresso </a> </div> <div class="cl"></div> </div>');
							generateDatepicker($('input[id^="fct-ticket-date-day-"]'));
							
							$form.find('form.fct-box-img.box-photo').eq(0).parents('div.hide-block:visible').parents('div.box-block').eq(0).find('h2').find('a.bt-more').trigger('click');
							$form.find('form.fct-box-img.box-photo').eq(0).parents('div.hide-block').html('<form class="fct-box-img box-photo br-3" action="package/ctrl/CtrlFile.php"> <div class="mask br-3"> <div class="content"> <img class="img-load" src="img/system/load/load-01.GIF" width="15" height="15" /> Carregando </div> </div> <img src="img/system/bg/img-98x98.png" class="br-03 main-img" width="98" height="98" /> <input class="input-file" type="file" name="fct-img"> <div class="br-03 remove remove-photo" title="Remover"><i class="fa fa-times"></i></div> <a href="#" class="load-img br-3" title="Carregar"><i class="fa fa-upload"></i> Carregar</a> <input name="method" type="hidden" value="" /> </form> <div class="cl"></div>');
						}
						else{
							$handle.siblings('a.update-page').trigger('click');
						}
						setScrollWindow(0, 500);
					}
					else{
						$handle.attr('title', 'FALHOU!').html('FALHOU!');
					}
					
					if(data.html.length > 0){
						initModal();
						$('#modal').stop(true, true).fadeIn('fast', function(){
							$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
								$('body').append(data.html);
								putLightBoxInCenter($('body').find('div.modal-main-content'));
							});
						});
					}
						
					setTimeout(function(){
						$handle.attr('title', backupTitle).html(backupHtml);
					}, 3000);
				});
			});
	
	// TICKET
		$(document).on('click', '#ft-buy-ticket', function(e){
			e.preventDefault();
			var $handle = $(this);
			var config = generateSendObject($handle);
			
			if(modalIsOpen()){ return; }
			var $parent = $handle.parents('ul');
			var $days = $parent.find('li div.box-day > label input[type="checkbox"]:checked');
			var ticketsDays = [];
			
			for(var i = z = 0, tamI = $days.length; i < tamI; i++){
				var $tickets = $days.eq(i).parents('li').find('div.wrap-ticket');
				var tickets = [];
				for(var j = c = 0, tamJ = $tickets.length; j < tamJ; j++){
					if($tickets.eq(j).find('input[type="checkbox"]:checked, input[type="radio"]:checked').length > 0){
						var array = [];
						array[0] = $tickets.eq(j).find('input[type="checkbox"]:checked, input[type="radio"]:checked').eq(0).attr('id').split('-');
						array[0] = array[0][array[0].length - 1];
						array[1] = $tickets.eq(j).find('select').length > 0 ? $tickets.eq(j).find('select').val() : 1;
						tickets[c] = array.join('__SPSUBDATA__');
						c++;
					}
				}
				if(tickets.length > 0){
					ticketsDays[z] = [$days.eq(i).attr('id').replace(/[^\d]/g, ''), tickets.join('__SPDATA__')].join('__SPLINE__');
					z++;
				}
			}
			ticketsDays = ticketsDays.join('__SPMAIN__');
			
			initModal();
			abortAjax();
			//setScrollWindow(0, 500);
			
			// ERROR
				$parent.find('span.error').hide();
				if(ticketsDays.length == 0){
					$('#modal').stop(true, true).fadeIn('fast', function(){
						$('#modal').find('div.box-load').hide();
						$('body').append('<div class="modal-main-content br-3"> <h2> <i class="fa fa-ticket"></i> Obtenha ingressos <a href="#" title="Fechar" class="link-close"> <i class="fa fa-times-circle"></i> </a> </h2> <div class="wrap-content"> <div class="login-box"> <br /> <br /> Escolha ao menos um ingresso para continuar com a aquisiÁ„o. <br /> <br /> <br /> </div> </div> </div>');
						putLightBoxInCenter($('body').find('div.modal-main-content'));
					});
					return(false);
				}
			// ERROR
			
			$('#modal').stop(true, true).fadeIn('fast', function(){
				$ajaxHandler = $ajaxHandler = $.ajax({
					url: config.url,
					type: 'post',
					dataType: 'json',
					data: {
						'method': config.method,
						'id': config.id,
						'tickets-days': ticketsDays
					}
				}).done(function(data){
					$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
						$('body').append(data.html);
						putLightBoxInCenter($('body').find('div.modal-main-content'));
						placeholder({ 'overrideSupport': true });
					});
				});
			});
		});
		
		
	// CONTACT MESSAGE
		$(document).on('click', '#submit-promoter-message', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if($handle.attr('title') != 'Enviar'){ return(false); }
			
			var $form = $handle.parents('div.modal-main-content');
			var prefix = $('#event-page').length > 0 ? '../../' : './'; 
			var isFromEvent = $('#event-page').length > 0 || $('#dashboard-page').length > 0 ? 1 : 0;
			var isFromOrganizer = $('#organizer-page').length > 0 ? 1 : 0;
			var id = $form.find('#fct-main-id').val();
			var name = $form.find('#fct-name').hasClass('placeholder') ? '' : $.trim($form.find('#fct-name').val());
			var email = $form.find('#fct-email').hasClass('placeholder') ? '' : $.trim($form.find('#fct-email').val());
			var message = $form.find('#fct-promoter-message').hasClass('placeholder') ? '' : $.trim($form.find('#fct-promoter-message').val());
			
			// ERROR
				$form.find('span.error').hide();
				if($form.find('#fct-name').length > 0 && name.length < 2){
					$form.find('#fct-name').siblings('span.error').show();
				}
				if($form.find('#fct-email').length > 0 && !isEmail(email)){
					$form.find('#fct-email').siblings('span.error').show();
				}
				if(message.length < 5){
					$form.find('#fct-promoter-message').siblings('span.error').show();
				}
				if($form.find('span.error:visible').length > 0){
					return(false);
				}
			// ERROR
			
			$form.find('a.link-close').hide();
			$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
			$handle.attr('title', 'ENVIANDO MENSAGEM...').html('<img src="'+prefix+'img/system/load/load-01.GIF" width="12" height="12" /> ENVIANDO MENSAGEM...');
			$ajaxHandler = $.ajax({
				url: prefix+'package/ctrl/CtrlUser.php',
				type: 'post',
				dataType: 'json',
				data: {
					'method': 'vu-get-send-organizer-event-message-in-page',
					'is-from-event': isFromEvent,
					'is-from-organizer': isFromOrganizer,
					'id': id,
					'name': name,
					'email': email,
					'message': message
				}
			}).done(function(data){
				$form.find('a.link-close').show();
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
				
				if(Number(data.feedback) >= 1){
					$handle.attr('title', 'EVENTO CRIADO!').html('EVENTO CRIADO!');
					if(data.html.length > 0){
						$('body').find('div.modal-main-content').stop(true, true).fadeOut('fast', function(){
							$(this).remove();
							$('body').append(data.html);
							putLightBoxInCenter($('body').find('div.modal-main-content'));
						});
					}
				}
				else{
					$handle.attr('title', 'FALHOU!').html('FALHOU!');
					if(data.error && data.error.nameError && data.error.nameError.isError){
						$form.find('#fct-name').siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.nameError.message).show();
					}
					if(data.error && data.error.emailError && data.error.emailError.isError){
						$form.find('#fct-email').siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.emailError.message).show();
					}
				}
				setTimeout(function(){
					$handle.attr('title', 'Enviar').html('<i class="fa fa-send"></i> Enviar');
				}, 3000);
			});
		});
		
		
	// FAVORITE
		$(document).on('click', 'a.favorite', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if($handle.attr('title') != 'Favoritar' && $handle.attr('title') != 'Remover de favoritos'){ return(false); }
			
			var prefix = $('#event-page').length > 0 ? '../../' : './';
			var isFromEvent = $('#event-page').length > 0 ? 1 : 0;
			var isFromOrganizer = $('#organizer-page').length > 0 ? 1 : 0;
			var config = generateSendObject($handle);
			var $favoritesLink = $('#event-page').length > 0 ? $handle : $favoritesLink = $handle.parents('div.box-for-load-more').parents('div').eq(0).find('#evg-'+config.id+', #evl-'+config.id).find('a.favorite');
			
			$favoritesLink.attr('title', 'VERIFICANDO...').html('<img src="'+prefix+'img/system/load/load-02.GIF" width="12" height="12" />');
			abortAjax();
			$ajaxHandler = $.ajax({
				url: config.url,
				type: 'post',
				dataType: 'json',
				data: {
					'method': config.method,
					'id': config.id
				}
			}).done(function(data){
				if(Number(data.feedback) == 1){
					if(data.isFavorite == 1){
						$favoritesLink.addClass('selected');
						$favoritesLink.attr('title', 'Remover de favoritos').html('<i class="fa fa-star"></i>');
					}
					else{
						$favoritesLink.removeClass('selected');
						$favoritesLink.attr('title', 'Favoritar').html('<i class="fa fa-star"></i>');
					}
				}
				else if(data.html.length > 0){
					$favoritesLink.attr('title', 'Favoritar').html('<i class="fa fa-star"></i>');
					initModal();
					$('#modal').stop(true, true).fadeIn('fast', function(){
						$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
							$('body').append(data.html);
							putLightBoxInCenter($('body').find('div.modal-main-content'));
							placeholder({ 'overrideSupport': true });
						});
					});
				}
			});
		});
		
		$(document).on('click', 'a.bt-remove-favorites', function(e){
			e.preventDefault();
			var $handle = $(this);
			var config = generateSendObject($handle);
		
			if($handle.attr('title') != 'Remover de favoritos'){ return(false); }
			
			$handle.attr('title', 'REMOVENDO...').html('<img src="img/system/load/load-04.GIF" width="12" height="12" /> REMOVENDO...');
			abortAjax();
			$ajaxHandler = $.ajax({
				url: config.url,
				type: 'post',
				dataType: 'json',
				data: {
					'method': config.method,
					'id': config.id
				}
			}).done(function(data){
				if(Number(data.feedback) == 1){
					$handle.attr('title', 'Removido').html('Removido');
					$handle.parents('div.event-intern').stop(true, true).slideUp('fast', function(){
						$(this).remove();
					});
				}
				else{
					$handle.attr('title', 'Remover de favoritos').html('Remover de favoritos <i class="fa fa-trash-o"></i>');
				}
			});
		});
		
		
	// FOLLOW
		$(document).on('click', 'div.box-follow-bt a, div.box-buttons a.bt-unfollow', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if($handle.attr('title') != 'Seguir' && $handle.attr('title') != 'Deixar de seguir' && $handle.attr('title') != 'Remover de seguidores'){ return(false); }
			
			var prefix = $('#event-page').length > 0 ? '../../' : './';
			var config = generateSendObject($handle);
			var backupTitle = $handle.attr('title');
			var backupHtml = $handle.html();
			
			$handle.attr('title', 'Aguarde...').html('<img src="'+prefix+'img/system/load/load-01.GIF" width="12" height="12" /> Aguarde...');
			abortAjax();
			$ajaxHandler = $.ajax({
				url: config.url,
				type: 'post',
				dataType: 'json',
				data: {
					'method': config.method,
					'id': config.id
				}
			}).done(function(data){
				if(Number(data.feedback) == 1){
					if(!$handle.hasClass('bt-unfollow')){
						if(data.isFollow == 1){
							$handle.attr('title', 'Deixar de seguir').html('Deixar de seguir');
						}
						else{
							$handle.attr('title', 'Seguir').html('Seguir');
						}
					}
					else{
						$handle.parents('div.event').stop(true, true).slideUp('fast', function(){
							$(this).remove();
						});
					}
				}
				else{
					$handle.attr('title', backupTitle).html(backupHtml);
					if(data.html.length > 0){
						initModal();
						$('#modal').stop(true, true).fadeIn('fast', function(){
							$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
								$('body').append(data.html);
								putLightBoxInCenter($('body').find('div.modal-main-content'));
								placeholder({ 'overrideSupport': true });
							});
						});
					}
				}
			});
		});
		
		
	// GET TICKETS
		$(document).on('click', '#submit-finish-buy', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if($handle.attr('title') != 'Finalizar' && $handle.attr('title') != 'Confirmar'){ return(false); }
			
			Iugu.setAccountID("53d20287-2136-4fc2-a485-2c974fd1b5cc");
			//Iugu.setTestMode(true);
			var $form = $handle.parents('div.modal-main-content');
			var backupTitle = $handle.attr('title');
			var backupHtml = $handle.html();
			var typeCharge = $('#fct-type-charge').val();
			var labelButton = typeCharge == 2 ? 'PROCESSANDO PAGAMENTO...' : 'CONFIRMANDO...';
			var prefix = $('#event-page').length > 0 ? '../../' : './';
			var cardBrand = $form.find('input[name="fct-card"]:checked').length > 0 ? $form.find('input[name="fct-card"]:checked').val() : '';
			var cardNumber = $('#fct-card-number').hasClass('placeholder') ? '' : $.trim($('#fct-card-number').val());
			var cardPersonName = $('#fct-card-name').hasClass('placeholder') ? '' : $.trim($('#fct-card-name').val());
			var cardVencMonth = $('#fct-card-month').val();
			var cardVencYear = $('#fct-card-year').val();
			var cardSafeCode = $('#fct-card-safe-code').hasClass('placeholder') ? '' : $.trim($('#fct-card-safe-code').val());
			var cc;
			var auxName = cardPersonName.split(' ');
			var cardPersonLastName = [];
			
			// NAME (FIRST, MIDDLE and LAST)
				cardPersonName = cardPersonName.split(' ')[0];
				for(var i = 1, tam = auxName.length; i < tam; i++){
					cardPersonLastName[i-1] = auxName[i];
				}
				cardPersonLastName.join(' ');
			
			// ERROR
				
				$form.find('span.error, div.box-error-payment').hide();
				if($form.find('input[name="fct-card"]').length > 0 && $form.find('input[name="fct-card"]').length > 0 && cardBrand.length == 0){
					$form.find('input[name="fct-card"]').parents('label').siblings('span.error').show();
				}
				if(typeCharge == 2 && !Iugu.utils.validateCreditCardNumber(cardNumber)){
					$('#fct-card-number').siblings('span.error').show();
				}
				if(typeCharge == 2 && cardPersonName.length == 0){
					$('#fct-card-name').siblings('span.error').show();
				}
				if(typeCharge == 2 && !Iugu.utils.validateCVV(cardSafeCode, cardBrand)){ // Iugu.utils.getBrandByCreditCardNumber(cardNumber)
					$('#fct-card-safe-code').siblings('span.error').show();
				}
				if(typeCharge == 2 && !Iugu.utils.validateExpiration(Number(cardVencMonth), Number(cardVencYear))){
					$('#fct-card-month').siblings('span.error').show();
				}
				if($form.find('span.error:visible').length > 0){
					return(false);
				}
			// ERROR
			
			$form.find('a.link-close').hide();
			$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
			$handle.attr('title', labelButton).html('<img src="'+prefix+'img/system/load/load-01.GIF" width="12" height="12" /> '+labelButton);
			
			if(typeCharge == 2){
				cc = Iugu.CreditCard(cardNumber+'', cardVencMonth+'', cardVencYear+'', cardPersonName+'', cardPersonLastName+'', cardSafeCode+'');
				Iugu.createPaymentToken(cc, function(response) {
					if(response.errors){
						$form.find('a.link-close').show();
						$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
						$handle.attr('title', 'FALHOU!').html('<i class="fa fa-credit-card"></i> FALHOU!');
						$form.find('div.box-error-payment').find('span.error').html('<i class="fa fa-times"></i> Cart„o inv·lido, verifique os dados e envie novamente');
						$form.find('div.box-error-payment').show();
						$form.find('div.box-error-payment').find('span.error').show();
					}
					else{
						sendPayment($handle, backupTitle, backupHtml, response.id);
					}
				});
			}
			else{
				sendPayment($handle, backupTitle, backupHtml, '');
			}
		});
		
		function sendPayment($handle, backupTitle, backupHtml, token){
			var $form = $handle.parents('div.modal-main-content');
			var typeCharge = $('#fct-type-charge').val();
			var successLabelButton = typeCharge == 2 ? 'PAGAMENTO REALIZADO!' : 'RESERVA CONFIRMADA!';
			var prefix = $('#event-page').length > 0 ? '../../' : './';
			var event = $('#fct-event').val();
			var ticketsDays = $('#fct-tickets').val();
			var fullPrice = $('#fct-full-price-before').val();
			var parcels = $('#fct-parcels').length > 0 ? $('#fct-parcels').val()-1 : 0;
			
			$ajaxHandler = $.ajax({
				url: prefix+'package/ctrl/CtrlEvent.php',
				type: 'post',
				dataType: 'json',
				data: {
					'method': 'vu-pay-event-ticket',
					'parcels': parcels,
					'full-price': fullPrice,
					'id': event,
					'tickets-days': ticketsDays,
					'token': token
				}
			}).done(function(data){
				$form.find('a.link-close').show();
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
				if(Number(data.feedback) >= 1){
					$handle.attr('title', successLabelButton).html(successLabelButton);
					if(data.html.length > 0){
						$('body').find('div.modal-main-content').stop(true, true).fadeOut('fast', function(){
							$(this).remove();
							$('body').append(data.html);
							putLightBoxInCenter($('body').find('div.modal-main-content'));
						});
					}
				}
				else{
					$handle.attr('title', 'FALHOU!').html('<i class="fa fa-credit-card"></i> FALHOU!');
					if(data.error && data.error.paymentError && data.error.paymentError.isError){
						$form.find('div.box-error-payment').find('span.error').html('<i class="fa fa-times"></i> '+data.error.paymentError.message);
						$form.find('div.box-error-payment').show();
						$form.find('div.box-error-payment').find('span.error').show();
					}
					setTimeout(function(){
						$handle.attr('title', backupTitle).html(backupHtml);
					}, 3000);
				}				
			});
		}
	
		
	// REPASS TICKET
		$(document).on('click', '#submit-repass-ticket', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if($handle.attr('title') != 'Confirmar repasse de ingresso'){ return(false); }
			
			var $form = $handle.parents('div.modal-main-content');
			var backupTitle = $handle.attr('title');
			var backupHtml = $handle.html();
			var password = $('#fct-password').val();
			var ticket = $('#fct-ticket').val();
			var user = $('#fct-user').val();
			
			// ERROR
				$form.find('span.error').hide();
				if(!(/^([a-zA-Z0-9@*#_]{8,20})$/.test(password))){
					$('#fct-password').siblings('span.error').show();
				}
				if($form.find('span.error:visible').length > 0){
					return(false);
				}
			// ERROR
			
			$form.find('a.link-close').hide();
			$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
			$handle.attr('title', 'CONFIRMANDO...').html('<img src="img/system/load/load-01.GIF" width="12" height="12" /> CONFIRMANDO...');
			$ajaxHandler = $.ajax({
				url: 'package/ctrl/CtrlUser.php',
				type: 'post',
				dataType: 'json',
				data: {
					'method': 'vu-get-user-gift-ticket-step-finish',
					'password': password,
					'ticket': ticket,
					'user': user
				}
			}).done(function(data){
				$form.find('a.link-close').show();
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
				
				if(Number(data.feedback) >= 1){
					if(data.html.length > 0){
						$('body').find('div.modal-main-content').stop(true, true).fadeOut('fast', function(){
							$('body').find('div.modal-main-content').remove();
							$('body').append(data.html);
							putLightBoxInCenter($('body').find('div.modal-main-content'));
						});
					}
					$('#tc-'+ticket).stop(true, true).slideUp('fast', function(){
						$(this).remove();
					});
				}
				else{
					$('#fct-password').val('');
					$handle.attr('title', 'FALHOU!').html('<i class="fa fa-send"></i> FALHOU!');
					if(data.error && data.error.passwordError && data.error.passwordError.isError){
						$('#fct-password').siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.passwordError.message).show();
					}
					setTimeout(function(){
						$handle.attr('title', backupTitle).html(backupHtml);
					}, 3000);
				}				
			});
		});
		
		
	// FORGOT PASSWORD
		$(document).on('submit', 'form.form-forgot-password', function(e){
			e.preventDefault();
			var $form = $(this);
			var $handle = $form.find('button');
			
			if($handle.attr('title') != 'Iniciar processo'){ return(false); }
			
			var backupTitle = $handle.attr('title');
			var backupHtml = $handle.html();
			var email = $('#fl-email').hasClass('placeholder') ? '' : $.trim($('#fl-email').val());
			
			// ERROR
				$form.find('span.error').hide();
				if(!isEmail(email)){
					$('#fl-email').siblings('span.error').show();
				}
				if($form.find('span.error:visible').length > 0){
					return(false);
				}
			// ERROR
			
			$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
			$handle.attr('title', 'INICIANDO PROCESSO...').html('<img src="img/system/load/load-01.GIF" width="12" height="12" /> INICIANDO PROCESSO...');
			$ajaxHandler = $.ajax({
				url: 'package/ctrl/CtrlUser.php',
				type: 'post',
				dataType: 'json',
				data: {
					'method': 'vu-save-forgot-password',
					'email': email
				}
			}).done(function(data){
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
				
				if(Number(data.feedback) >= 1){
					$handle.attr('title', 'EMAIL DE RECUPERA«√O DE SENHA ENVIADO!').html('EMAIL DE RECUPERA«√O DE SENHA ENVIADO!');
					if(data.html.length > 0){
						initModal();
						$('#modal').stop(true, true).fadeIn('fast', function(){
							$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
								$('body').append(data.html);
								putLightBoxInCenter($('body').find('div.modal-main-content'));
							});
						});
					}
					$('#fl-email').val('');
				}
				else{
					$handle.attr('title', 'FALHOU!').html('FALHOU!');
					if(data.error && data.error.emailError && data.error.emailError.isError){
						$handle.siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.emailError.message).show();
					}
					$('#fl-email').val('');
				}	
				
				setTimeout(function(){
					$handle.attr('title', backupTitle).html(backupHtml);
				}, 3000);				
			});
		});
		
		// RESET PASSWORD
			$(document).on('submit', 'form.form-reset-password', function(e){
				e.preventDefault();
				var $form = $(this);
				var $handle = $form.find('button');
				
				if($handle.attr('title') != 'Resetar senha'){ return(false); }
				
				var backupTitle = $handle.attr('title');
				var backupHtml = $handle.html();
				var id = $('#fl-id').val();
				var hash = $('#fl-hash').val();
				var newPassword = $('#fl-new-password').hasClass('placeholder') ? '' : $.trim($('#fl-new-password').val());
				var confirmNewPassword = $('#fl-confirm-password').hasClass('placeholder') ? '' : $.trim($('#fl-confirm-password').val());
				
				// ERROR
					$form.find('span.error').hide();
					if(!(/^([a-zA-Z0-9@*#_]{8,20})$/.test(newPassword))){
						$('#fl-new-password').siblings('span.error').show();
					}
					if(confirmNewPassword != newPassword){
						$('#fl-confirm-password').siblings('span.error').show();
					}
					if($form.find('span.error:visible').length > 0){
						return(false);
					}
				// ERROR
				
				$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', true); });
				$handle.attr('title', 'ALTERANDO SENHA...').html('<img src="img/system/load/load-01.GIF" width="12" height="12" /> ALTERANDO SENHA...');
				$ajaxHandler = $.ajax({
					url: '../package/ctrl/CtrlUser.php',
					type: 'post',
					dataType: 'json',
					data: {
						'method': 'vu-reset-forgot-password',
						'id': id,
						'hash': hash,
						'password': newPassword
					}
				}).done(function(data){
					$form.find('a.link-close').show();
					$form.find('input, textarea, select').each(function(){ $(this).attr('disabled', false); });
					
					if(Number(data.feedback) >= 1){
						$handle.attr('title', 'SENHA ALTERADA COM SUCESSO!').html('SENHA ALTERADA COM SUCESSO!');
						if(data.html.length > 0){
							initModal();
							$('#modal').stop(true, true).fadeIn('fast', function(){
								$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
									$('body').append(data.html);
									putLightBoxInCenter($('body').find('div.modal-main-content'));
								});
							});
						}
					}
					else{
						$handle.attr('title', 'FALHOU!').html('FALHOU!');
						if(data.error && data.error.passwordError && data.error.passwordError.isError){
							$handle.siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.passwordError.message).show();
						}
						$('#fl-email').val('');
					}	
					
					$('#fl-new-password').val('');
					$('#fl-confirm-password').val('');
					setTimeout(function(){
						$handle.attr('title', backupTitle).html(backupHtml);
					}, 3000);				
				});
			});
	
// ]]>