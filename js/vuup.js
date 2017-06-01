// <![CDATA[
	
	
	// CONFIG
		placeholder({ 'overrideSupport': true });
		var $ajaxHandler;
		//map('fct-map', -22.912213, -43.188778, 13, 'roadmap', true);
	
	// MAP
		/*if($('div.box-more-information div.box-location #map').length > 0){
			map('map', -22.912213, -43.188778, 13, 'roadmap', true);
		}*/
		
	// GALLERY
		initImageShadowbox();
		
	// TOP USER CONNECTED MENU
		$('header div.box-user-connected').hover(function(){
			$(this).addClass('hover');
			$(this).find('ul, div.mask-shadow').show();
		},
		function(){
			$(this).removeClass('hover');
			$(this).find('ul, div.mask-shadow').hide();
		});
	
	// EVENTS
		putEventHoverListener();
		
	// FAQS
		$('main.faq div.question a').click(function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if($handle.hasClass('selected')){
				$handle.removeClass('selected');
				$handle.find('i').addClass('fa-chevron-circle-right').removeClass('fa-chevron-circle-down');
				$handle.siblings('div.content').stop(true, true).slideUp('normal');
			}
			else{
				$handle.addClass('selected');
				$handle.find('i').addClass('fa-chevron-circle-down').removeClass('fa-chevron-circle-right');
				$handle.siblings('div.content').stop(true, true).slideDown('normal');
			}
		});
		
		
		// VALIDATE CONTENT
			$(document).on('change', '#fct-video, #fl-page', function(){
				var $handle = $(this);
				
				if($.trim($handle.val()).length > 0){
					$handle.siblings('div.mask-input').css({
						width: $handle.outerWidth()+'px',
						height: $handle.outerHeight()+'px',
						lineHeight: ($handle.outerHeight()+8)+'px'
					});
					$handle.siblings('div.mask-input').stop(true, true).fadeIn('fast', function(){
						$ajaxHandler = $.ajax({
							url: $('#'+$handle.attr('id')+'-url').val(),
							type: 'post',
							dataType: 'json',
							data: {
								'method': $('#'+$handle.attr('id')+'-method').val(),
								'val': $handle.val()
							}
						}).done(function(data){
							$handle.siblings('div.mask-input').stop(true, true).fadeOut('fast');
							
							if(data.isVideo){
								if(data.html.length > 0){
									$handle.parents('div.hide-block').find('div.box-video').html('<iframe width="786" height="400" src="'+data.html+'" frameborder="0" allowfullscreen></iframe>');
									$handle.parents('div.hide-block').find('div.box-video').stop(true, true).fadeIn('fast');
									$handle.parents('div.hide-block').find('div.box-video').attr('title', data.html);
								}
								else{
									$handle.parents('div.hide-block').find('div.box-video').html('');
									$handle.parents('div.hide-block').find('div.box-video').stop(true, true).fadeOut('fast');
									$handle.parents('div.hide-block').find('div.box-video').attr('title', '');
								}
							}
							else if(data.isUrlPerson){
								if(data.error && data.error.urlSufixError && data.error.urlSufixError.isError){
									$handle.siblings('span.error').html('<i class="fa fa-times"></i> '+data.error.urlSufixError.message).show();
								}
								else{
									$handle.siblings('span.error').hide();
								}
							}
						});
					});
				}
				else{
					$handle.parents('div.hide-block').find('div.box-video').html('');
					$handle.parents('div.hide-block').find('div.box-video').stop(true, true).fadeOut('fast');
					$handle.parents('div.hide-block').find('div.box-video').attr('title', '');
				}
			});
		
		
	// FORM TICKETS
		$('#form-ticket ul li div.box-day > label input[type="checkbox"]').click(function(){
			var $handle = $(this);
			
			if(!$handle.is(':checked')){
				$handle.parents('div.box-day').find('div.box-ticket-type').stop(true, true).slideUp('normal');
			}
			else{
				$handle.parents('div.box-day').find('div.box-ticket-type').stop(true, true).slideDown('normal');
			}
		});
		$('#form-ticket ul li input[type="checkbox"]').click(function(){
			calcTotal();
		});
		$('#form-ticket ul li select').click(function(){
			calcTotal();
		});
		
		function calcTotal(){
			var $priceHandle = $('#form-ticket ul li.box-total');
			var $checkboxies = $('#form-ticket ul li div.box-day > label input[type="checkbox"]:checked');
			var i, tamI, id, j, tamJ;
			var total = 0, $checkboxiesChild, $hidden, $select;
			
			for(i = 0, tamI = $checkboxies.length; i < tamI; i++){
				$checkboxiesChild = $checkboxies.eq(i).parents('div.box-day').find('div.box-ticket-type').find('input[type="checkbox"]:checked');
				for(j = 0, tamJ = $checkboxiesChild.length; j < tamJ; j++){
					$hidden = $('#'+$checkboxiesChild.eq(j).attr('id')+'-p');
					$select = $('#'+$checkboxiesChild.eq(j).attr('id')+'-s');
					total += (parseFloat($hidden.val()) * parseFloat($select.val()));
				}
			}
			$priceHandle.html('R$ '+parseFloat(total).toFixed(2).replace('.', ','));
		}
		
		
	// TYPE LIST / GRADE EVENTS
		$(document).on('click', 'div.box-description h2 a, div.box-mode-search a', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if($handle.hasClass('selected')){return;}
			
			if($handle.parents('div.box-description').length > 0){
				$handle.parents('div.box-description').find('.'+$handle.siblings('a.selected').attr('href')).stop(true, true).fadeOut('fast');
				$handle.parents('div.box-description').find('.'+$handle.attr('href')).stop(true, true).fadeIn('fast');
			}
			else{
				$handle.parents('div.box-mode-search').siblings('div.right').find('.'+$handle.siblings('a.selected').attr('href')).stop(true, true).fadeOut('fast');
				$handle.parents('div.box-mode-search').siblings('div.right').find('.'+$handle.attr('href')).stop(true, true).fadeIn('fast');
			}
			$handle.siblings('a.selected').removeClass('selected');
			$handle.addClass('selected');
		});
		
		
	// SECTIONS
		$(document).on('click', 'h2.section', function(e){
			e.preventDefault();
			var $handle = $(this);
			var $sectioBox = $handle.next().next('div.section-box');
			
			if($sectioBox.is(':visible')){
				$sectioBox.stop(true, true).slideUp('normal');
				$handle.find('span').html('&raquo; mais');
			}
			else{
				$sectioBox.stop(true, true).slideDown('normal');
				$handle.find('span').html('&raquo; esconder');
			}
		});
		
	
	/*// THEME SLIDE
		$(document).on('click', 'a.layout-arrow', function(e){
			e.preventDefault();
			var $handle = $(this);
			var $layoutBox = $handle.siblings('div.layout-box');
			var $actual = $layoutBox.find('div.actual');
			var $themeName = $handle.siblings('#fl-theme');
			
			if($handle.hasClass('ar-left')){
				
				if($actual.prev('.theme').length > 0){
					$actual.removeClass('actual');
					$actual.stop(true, true).fadeOut('fast');
					$actual.prev('.theme').stop(true, true).fadeIn('fast');
					$actual.prev('.theme').addClass('actual');
					$themeName.val($actual.prev('.theme').attr('title'));
				}
				else{
					$actual.removeClass('actual');
					$actual.stop(true, true).fadeOut('fast');
					$layoutBox.find('.theme:last').stop(true, true).fadeIn('fast');
					$layoutBox.find('.theme:last').addClass('actual');
					$themeName.val($layoutBox.find('.theme:last').attr('title'));
				}
			}
			else{
				if($actual.next('.theme').length > 0){
					$actual.removeClass('actual');
					$actual.stop(true, true).fadeOut('fast');
					$actual.next('.theme').stop(true, true).fadeIn('fast');
					$actual.next('.theme').addClass('actual');
					$themeName.val($actual.next('.theme').attr('title'));
				}
				else{
					$actual.removeClass('actual');
					$actual.stop(true, true).fadeOut('fast');
					$layoutBox.find('.theme:first').stop(true, true).fadeIn('fast');
					$layoutBox.find('.theme:first').addClass('actual');
					$themeName.val($layoutBox.find('.theme:first').attr('title'));
				}
			}
		});*/
		
	
	// EVENT FORM
		// DATEPICKER
			if($('input[id^="fct-ticket-date-day-"]').length > 0){
				generateDatepicker($('input[id^="fct-ticket-date-day-"]'));
			}
			if($('#ffse-date-start').length > 0){
				generateDatepicker($('#ffse-date-start'));
				generateDatepicker($('#ffse-date-end'));
			}
			
			
		// SHOW OPTIONAL DATA IN EVENT
			$(document).on('click', 'h2 a.bt-more', function(e){
				e.preventDefault();
				var $handle = $(this);
				
				if($handle.find('i.fa-chevron-circle-right').length > 0){
					$handle.find('i').addClass('fa-chevron-circle-down').removeClass('fa-chevron-circle-right');
					$handle.parents('h2').siblings('div.hide-block').stop(true, true).slideDown('fast');
				}
				else{
					$handle.find('i').addClass('fa-chevron-circle-right').removeClass('fa-chevron-circle-down');
					$handle.parents('h2').siblings('div.hide-block').stop(true, true).slideUp('fast');
				}
			});
			
			
		// PROMOTER PART IN EVENT FORM
			$(document).on('change', 'input[name="fct-promoter"]', function(e){
				var $handle = $(this);
				$('.'+$handle.attr('name')).attr('disabled', $handle.val() == 1 ? false : true);
			});
			
		// ENABLED PRICE INPUT BY TYPE TICKET
			$(document).on('change', 'input[name="fct-type"]', function(e){
				enableInputByTicket($(this).val() == 1);
			});
			
			function enableInputByTicket(status){
				var $maxTicket = $('div.box-lote-ticket').find('select[id^="fct-ticket-max-"]');
				var $priceTicket = $('div.box-lote-ticket').find('input[id^="fct-ticket-price-"]');
				
				for(var i = 0, tam = $maxTicket.length; i < tam; i++){
					$maxTicket.eq(i).attr('disabled', status);
					$priceTicket.eq(i).attr('disabled', status);
				}
				
				$('#fct-parcels').attr('disabled', status);
				$('input[name="fct-rates"]').attr('disabled', status);
			}
			
		// ADD / REMOVE DAY
			$(document).on('click', 'a.bt-day-add', function(e){
				e.preventDefault();
				var $handle = $(this);
				var $container = $handle.parents('div.box-field').eq(0);
				var indexId = 0;
				
				if($container.find('div.box-lote-ticket').length < 10){
					for(var i = 1, tam = 10; i <= tam; i++){
						if($('#fct-ticket-date-day-'+i).length == 0){
							indexId = i;
							break;
						}
					}
					//$container.find('div.box-lote-ticket:last').after('<div class="box-lote-ticket br-3" style="display: none;"> <a href="#" class="close-day" title="Remover dia"> <i class="fa fa-trash-o"></i> Remover dia </a> <div class="box-day-ticket br-3"> <input type="text" id="fct-ticket-date-day-'+indexId+'" class="br-3" placeholder="*Dia" /> <b>Ã s</b> <select id="fct-date-hour-'+indexId+'" class="br-3"> <option value="0">00</option> <option value="1">01</option> <option value="2">02</option> <option value="3">03</option> <option value="4">04</option> <option value="5">05</option> <option value="6">06</option> <option value="7">07</option> <option value="8">08</option> <option value="9">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> <option value="13">13</option> <option value="14">14</option> <option value="15">15</option> <option value="16">16</option> <option value="17">17</option> <option value="18">18</option> <option value="19">19</option> <option value="20">20</option> <option value="21">21</option> <option value="22">22</option> <option value="23">23</option> </select> <b>:</b> <select id="fct-date-minute-'+indexId+'" class="br-3"> <option value="0">00</option> <option value="1">15</option> <option value="2">30</option> <option value="3">45</option> </select> <div class="cl"></div> </div> <div class="box-container-ticket"> <div class="box-content-ticket br-3"> <a href="#" class="close-ticket" title="Remover ingresso"> <i class="fa fa-trash-o"></i> Remover ingresso </a> <div class="box-field left-wm"> <input type="text" id="fct-ticket-name-1" class="br-3" placeholder="*Nome ingresso" /> <div class="cl"></div> </div> <div class="box-field left"> <select id="fct-ticket-max-1" class="br-3"> <option value="0">*MÃ¡ximo compra</option> <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option> </select> <div class="cl"></div> </div> <div class="box-field left"> <input type="text" id="fct-ticket-price-1" class="br-3" placeholder="*R$" /> <div class="cl"></div> </div> <div class="cl"></div> </div> <a href="#" class="bt br-3 bt-ticket-add" title="Add ingresso"><i class="fa fa-plus-circle"></i> Add ingresso</a> </div> <div class="cl"></div> </div>');
					$container.find('div.box-lote-ticket:last').after('<div class="box-lote-ticket br-3" style="display: none;"> <a href="#" class="close-day" title="Remover dia"> <i class="fa fa-trash-o"></i> Remover dia </a> <div class="box-day-ticket br-3"> <input type="text" id="fct-ticket-date-day-'+indexId+'" class="br-3" placeholder="*Dia" /> <b>às</b> <select id="fct-date-hour-'+indexId+'" class="br-3"> <option value="0" selected="selected">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option> </select> <b>:</b> <select id="fct-date-minute-'+indexId+'" class="br-3"> <option value="0" selected="selected">00</option><option value="1">15</option><option value="2">30</option><option value="3">45</option> </select> <div class="cl"></div> </div> <div class="box-container-ticket"> <div class="box-content-ticket br-3"> <a href="#" class="close-ticket" title="Remover ingresso"> <i class="fa fa-trash-o"></i> Remover ingresso </a> <div class="box-field left-wm"> <input type="text" id="fct-ticket-name-'+indexId+'" class="br-3" placeholder="*Nome ingresso" /> <div class="cl"></div> </div> <div class="box-field left"> <select id="fct-ticket-max-'+indexId+'" class="br-3" disabled="disabled"> <option value="0" selected="selected">*Máximo compra</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option> </select> <div class="cl"></div> </div> <div class="box-field left"> <input type="text" id="fct-ticket-price-'+indexId+'" class="br-3" placeholder="*R$" disabled="disabled" /> <div class="cl"></div> </div> <div class="cl"></div> <div class="box-field left-wm"> <input type="text" id="fct-ticket-max-sell-'+indexId+'" class="br-3" placeholder="*Máximo em vendas" /> <div class="box-show-info hackcode-1"> <i class="fa fa-question-circle"></i> <div class="info br-3" style="display: none;"> <div class="arrow-top-right"></div> Quantidade máxima de ingressos desse tipo que podem ser vendidos para o evento. Exemplo: <em>1000 ingressos masculinos podem ser vendidos para o evento</em> </div> </div> <div class="cl"></div> </div> <div class="box-field left"> <select id="fct-ticket-days-'+indexId+'" class="br-3"> <option value="0" selected="selected">*Validade em dias</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="5">6</option><option value="5">7</option><option value="5">8</option><option value="5">9</option><option value="10">10</option> </select> <div class="box-show-info hackcode-1"> <i class="fa fa-question-circle"></i> <div class="info br-3" style="display: none;"> <div class="arrow-top-right"></div> A quantidade de dias que esse tipo de ingresso é válido. Exemplo: <em>se 2 for selecionado isso significa que o usuário que comprou esse ingresso poderá ir em 2 dias de evento.</em> </div> </div> <div class="cl"></div> </div> <div class="cl"></div> </div> <a href="#" class="bt br-3 bt-ticket-add" title="Add ingresso"> <i class="fa fa-plus-circle"></i> Add ingresso </a> </div> <div class="cl"></div> </div>');
					$container.find('div.box-lote-ticket:last').stop(true, true).slideDown('fast');
					generateDatepicker($('#fct-ticket-date-day-'+i));
					
					if($container.find('div.box-lote-ticket').length >= 10){
						$handle.stop(true, true).slideUp('fast');
					}
					enableInputByTicket($('input[name="fct-type"]:checked').val() == 1);
				}
			});
			
			$(document).on('click', 'a.close-day', function(e){
				e.preventDefault();
				var $handle = $(this).parents('div.box-lote-ticket');
				
				if($handle.parents('div.box-field').eq(0).find('div.box-lote-ticket').length > 1){
					$(this).parents('div.box-lote-ticket').stop(true, true).slideUp('fast', function(){
						$(this).remove();
					});
				}
				$handle.parents('div.box-field').eq(0).find('a.bt-day-add').stop(true, true).slideDown('fast');
			});
			
		// ADD / REMOVE TICKET
			$(document).on('click', 'a.bt-ticket-add', function(e){
				e.preventDefault();
				var $handle = $(this);
				var $container = $handle.parents('div.box-container-ticket');
				var indexId = 0;
				
				if($container.find('div.box-content-ticket').length < 10){
					for(var i = 1, tam = 10; i <= tam; i++){
						if($('#fct-ticket-name-'+i).length == 0){
							indexId = i;
							break;
						}
					}
					//$container.find('div.box-content-ticket:last').after('<div class="box-content-ticket br-3" style="display: none;"> <a href="#" class="close-ticket" title="Remover ingresso"> <i class="fa fa-trash-o"></i> Remover ingresso </a> <div class="box-field left-wm"> <input type="text" id="fct-ticket-name-'+indexId+'" class="br-3" placeholder="*Nome ingresso" /> <div class="cl"></div> </div> <div class="box-field left"> <select id="fct-ticket-max-'+indexId+'" class="br-3"> <option value="0">*MÃ¡ximo compra</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> </select> <div class="cl"></div> </div> <div class="box-field left"> <input type="text" id="fct-ticket-price-'+indexId+'" class="br-3" placeholder="*R$" /> <div class="cl"></div> </div> <div class="cl"></div> </div>');
					$container.find('div.box-content-ticket:last').after('<div class="box-content-ticket br-3" style="display: none;"> <a href="#" class="close-ticket" title="Remover ingresso"> <i class="fa fa-trash-o"></i> Remover ingresso </a> <div class="box-field left-wm"> <input type="text" id="fct-ticket-name-'+indexId+'" class="br-3" placeholder="*Nome ingresso" /> <div class="cl"></div> </div> <div class="box-field left"> <select id="fct-ticket-max-'+indexId+'" class="br-3" disabled="disabled"> <option value="0" selected="selected">*Máximo compra</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option> </select> <div class="cl"></div> </div> <div class="box-field left"> <input type="text" id="fct-ticket-price-'+indexId+'" class="br-3" placeholder="*R$" disabled="disabled" /> <div class="cl"></div> </div> <div class="cl"></div> <div class="box-field left-wm"> <input type="text" id="fct-ticket-max-sell-'+indexId+'" class="br-3" placeholder="*Máximo em vendas" /> <div class="box-show-info hackcode-1"> <i class="fa fa-question-circle"></i> <div class="info br-3" style="display: none;"> <div class="arrow-top-right"></div> Quantidade máxima de ingressos desse tipo que podem ser vendidos para o evento. Exemplo: <em>1000 ingressos masculinos podem ser vendidos para o evento</em> </div> </div> <div class="cl"></div> </div> <div class="box-field left"> <select id="fct-ticket-days-'+indexId+'" class="br-3"> <option value="0" selected="selected">*Validade em dias</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="5">6</option><option value="5">7</option><option value="5">8</option><option value="5">9</option><option value="10">10</option> </select> <div class="box-show-info hackcode-1"> <i class="fa fa-question-circle"></i> <div class="info br-3" style="display: none;"> <div class="arrow-top-right"></div> A quantidade de dias que esse tipo de ingresso é válido. Exemplo: <em>se 2 for selecionado isso significa que o usuário que comprou esse ingresso poderá ir em 2 dias de evento.</em> </div> </div> <div class="cl"></div> </div> <div class="cl"></div> </div>');
					$container.find('div.box-content-ticket:last').stop(true, true).slideDown('fast');
					
					if($container.find('div.box-content-ticket').length >= 10){
						$handle.stop(true, true).slideUp('fast');
					}
					enableInputByTicket($('input[name="fct-type"]:checked').val() == 1);
				}
			});
			
			$(document).on('click', 'a.close-ticket', function(e){
				e.preventDefault();
				var $handle = $(this).parents('div.box-content-ticket');
				
				if($handle.parents('div.box-container-ticket').find('div.box-content-ticket').length > 1){
					$(this).parents('div.box-content-ticket').stop(true, true).slideUp('fast', function(){
						$(this).remove();
					});
				}
				$handle.parents('div.box-container-ticket').find('a.bt-ticket-add').stop(true, true).slideDown('fast');
			});
			
			
		// TICKET
			$(document).on('click', 'a.avanced-options', function(e){
				e.preventDefault();
				var $table = $(this).parents('table');
				
				if($table.find('tr.tr-avanced-options').eq(0).is(':visible')){
					$table.find('tr.tr-avanced-options').hide();
				}
				else{
					$table.find('tr.tr-avanced-options').show();
				}
			});
			
			
			// ADD
				$(document).on('click', 'a.bt-create-ticket, a.bt-update-ticket', function(e){
					e.preventDefault();
					var id = $('#fl-ticket-id').val().length == 0 ? 0 : Number($('#fl-ticket-id').val());
					var $table = $('#fl-table-ticket');
					var type = $('#fl-ticket-type').val();
					var price = Number($('#fl-ticket-price').val().replace(',', '.'));
					var rate = 3.00;
					var priceSell = price + rate;
					var qtd = $('#fl-ticket-qtd').val();
					var i = 1;
					var hideContent = '';
					
					for(; true; i++){
						if($('#tkt-'+i).length == 0){
							break;
						}
					}
					
					hideContent += '<input type="hidden" class="fl-ticket-type" value="'+type+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-price" value="'+price+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-qtd" value="'+qtd+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-description" value="'+$('#fl-ticket-description').val()+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-init-sell" value="'+$('#fl-ticket-init-sell').val()+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-init-hour" value="'+$('#fl-ticket-init-hour').val()+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-init-minute" value="'+$('#fl-ticket-init-minute').val()+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-finish-sell" value="'+$('#fl-ticket-finish-sell').val()+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-finish-hour" value="'+$('#fl-ticket-finish-hour').val()+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-finish-minute" value="'+$('#fl-ticket-finish-minute').val()+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-min-qtd" value="'+$('#fl-ticket-min-qtd').val()+'" />';
					hideContent += '<input type="hidden" class="fl-ticket-max-qtd" value="'+$('#fl-ticket-max-qtd').val()+'" />';
					
					if(id == 0){
						$(this).parents('table').find('input, select').each(function(){
							$(this).val('');
						});
						
						$table.append('<tr id="tkt-'+i+'"> <td>'+type+' '+hideContent+'</td> <td>R$ '+price.toFixed(2).replace('.', ',')+'</td> <td>R$ '+rate.toFixed(2).replace('.', ',')+'</td> <td>R$ '+priceSell.toFixed(2).replace('.', ',')+'</td> <td>'+qtd+'</td> <td colspan="2"><a href="#" class="ticket-update" title="Editar">Editar</a></td> <td colspan="2"><a href="#" class="ticket-remove" title="Remover">Remover</a></td> </tr>');
					}
					else{
						$('#tkt-'+id).after('<tr id="tkt-'+i+'"> <td>'+type+' '+hideContent+'</td> <td>R$ '+price.toFixed(2).replace('.', ',')+'</td> <td>R$ '+rate.toFixed(2).replace('.', ',')+'</td> <td>R$ '+priceSell.toFixed(2).replace('.', ',')+'</td> <td>'+qtd+'</td> <td colspan="2"><a href="#" class="ticket-update" title="Editar">Editar</a></td> <td colspan="2"><a href="#" class="ticket-remove" title="Remover">Remover</a></td> </tr>');
						$('#tkt-'+id).remove();
						$('#fl-ticket-id').val(i);
					}
				});
				
				
			// UPDATE
				$(document).on('click', 'a.ticket-update', function(e){
					e.preventDefault();
					var $handle = $(this);
					var $tr = $handle.parents('tr');
					var $table = $('div.ticket-box table').eq(0);
					
					$table.find('a.bt-create-ticket').hide();
					$table.find('a.bt-update-ticket').show();
					$table.find('a.bt-back-create').show();
					
					$('#fl-ticket-type').val($tr.find('input.fl-ticket-type').val());
					$('#fl-ticket-price').val($tr.find('input.fl-ticket-price').val());
					$('#fl-ticket-qtd').val($tr.find('input.fl-ticket-qtd').val());
					$('#fl-ticket-description').val($tr.find('input.fl-ticket-description').val());
					$('#fl-ticket-init-sell').val($tr.find('input.fl-ticket-init-sell').val());
					$('#fl-ticket-init-hour').val($tr.find('input.fl-ticket-init-hour').val());
					$('#fl-ticket-init-minute').val($tr.find('input.fl-ticket-init-minute').val());
					$('#fl-ticket-finish-sell').val($tr.find('input.fl-ticket-finish-sell').val());
					$('#fl-ticket-finish-hour').val($tr.find('input.fl-ticket-finish-hour').val());
					$('#fl-ticket-finish-minute').val($tr.find('input.fl-ticket-finish-minute').val());
					$('#fl-ticket-min-qtd').val($tr.find('input.fl-ticket-min-qtd').val());
					$('#fl-ticket-max-qtd').val($tr.find('input.fl-ticket-max-qtd').val());
					$('#fl-ticket-id').val($tr.attr('id').replace(/[^\d]/g, ''));
				});
				
				$(document).on('click', 'a.bt-back-create', function(e){
					e.preventDefault();
					var $table = $('div.ticket-box table').eq(0);
					
					$table.find('a.bt-create-ticket').show();
					$table.find('a.bt-update-ticket').hide();
					$table.find('a.bt-back-create').hide();
					
					$(this).parents('table').find('input, select').each(function(){
						$(this).val('');
					});
				});
			
			
			// REMOVE
				$(document).on('click', 'a.ticket-remove', function(e){
					e.preventDefault();
					
					$(this).parents('tr').stop(true, true).slideDown('normal', function(){
						$(this).remove();
					});
				});
				
		
	// MODAL
		$('#modal').find('a.close').click(function(e){
			e.preventDefault();
			$(this).parents('#modal').stop(true, true).fadeOut('normal');
		});
		
		$('#partner-bt').click(function(e){
			e.preventDefault();
			$('#modal').stop(true, true).fadeIn('normal');
		});
		
		
	// INFO BOX
		$(document).on('mouseover', 'div.box-show-info i', function(){
			$(this).siblings('div.info').stop(true, true).fadeIn('fast');
		}).on('mouseout', 'div.box-show-info', function(){
			$(this).find('div.info').stop(true, true).fadeOut('fast');
		});
		
		
	// CHARTS
		$(document).on('change', 'main .box-chart .data-filter select[name="fct-filter-month"]', function(){
			var $handle = $(this);
			var type = $handle.parents('div.box-data-filter').find('input[name="fct-chart-type"]').val();
			var id = $('#fct-id').val();
			var $chartLine = $handle.parents('div.box-chart').find('div[id^="chart-line"]');
			var $chartBar = $handle.parents('div.box-chart').find('div[id^="chart-bar"]');
			var $chartPie = $handle.parents('div.box-chart').find('div[id^="chart-pie"]');
			var method = $handle.parents('div.box-chart').find('input[name="fct-method"]').val();
			var user = $handle.parents('div.promoter').length == 0 ? 0 : $handle.parents('div.promoter').attr('id').replace(/[^\d]/g, '');
			var year, month = $handle.val().split('__SPMAIN__');
			year = month[1];
			month = month[0];
			
			$handle.parents('div.box-data-filter').find('select, input').each(function(){ $(this).attr('disabled', true); });
			if($chartLine.is(':visible')){
				$chartLine.html('<div class="load-subcontent'+($chartPie.length > 0 ? ' container-pie-chart' : '')+'"> <img width="16" height="16" src="img/system/load/load-03.GIF"> Carregando... </div>');
			}
			else{
				$chartBar.html('<div class="load-subcontent'+($chartPie.length > 0 ? ' container-pie-chart' : '')+'" style="height: 300px;"> <img width="16" height="16" src="img/system/load/load-03.GIF"> Carregando... </div>');
			}
			
			if($chartPie.length > 0){
				$chartPie.stop(true, true).fadeTo(100, 0.01);
			}
			
			$ajaxHandler = $.ajax({
				url: 'package/ctrl/CtrlEvent.php',
				type: 'post',
				dataType: 'json',
				data: {
					'method': method,
					'id': id,
					'user': user,
					'type': type,
					'year': year,
					'month': month
				}
			}).done(function(data){
				$handle.parents('div.box-data-filter').find('select, input').each(function(){ $(this).attr('disabled', false); });
				lineChart($chartLine,
					data.charLine.title,
					data.charLine.subTitle,
					data.charLine.titleXAxis,
					data.charLine.titleYAxis,
					data.charLine.xAxisLabels,
					data.charLine.labelData,
					data.charLine.data);
				barChart($chartBar,
					data.charBar.title,
					data.charBar.subTitle,
					data.charBar.titleXAxis,
					data.charBar.titleYAxis,
					data.charBar.labelData,
					data.charBar.data);
				if($chartPie.length > 0){
					$chartPie.stop(true, true).fadeTo(100, 1);
					pieChart($chartPie, data.charPie.title, data.charPie.labelData, data.charPie.data);
				}
			});
		});
		
		$(document).on('change', 'main .box-chart .data-filter input[type="radio"]', function(){
			var $handle = $(this);
			
			if($handle.val() == 1){
				$handle.parents('div.box-chart').find('div[id^="chart-bar"]').hide();
				$handle.parents('div.box-chart').find('div[id^="chart-line"]').show();
			}
			else{
				$handle.parents('div.box-chart').find('div[id^="chart-line"]').hide();
				$handle.parents('div.box-chart').find('div[id^="chart-bar"]').show();
			}
		});
	
	
	// FIXED BAR NAVIGATOR
		/*var barNavigatorStatus = false;
		$(window).scroll(function(){
			if($('#top-fixed').length == 0)
				return;
		
			var position = parseInt($('#top-fixed').offset().top);
			if(position > 100 && !barNavigatorStatus){
				barNavigatorStatus = !barNavigatorStatus;
				$('#top-fixed').stop(true, true).fadeIn('normal');
			}
			else if(position <= 100 && barNavigatorStatus){
				barNavigatorStatus = !barNavigatorStatus;
				$('#top-fixed').stop(true, true).fadeOut('normal');
			}
			
			// BUTTONS SELECTED
				var p1 = parseInt($('#how-it-works').offset().top) - (position + 100);
				var p2 = parseInt($('#awards').offset().top) - (position + 100);
				var p3 = parseInt($('#press').offset().top) - (position + 100);
				var p4 = parseInt($('#contact').offset().top) - (position + 100);
				
				if(p1 <= 0 && p2 > 0){
					removeSelectedClassBar();
					$('#top-fixed').find('ul').find('li').find('a').eq(0).addClass('selected');
				}
				else if(p2 <= 0 && p3 > 0){
					removeSelectedClassBar();
					$('#top-fixed').find('ul').find('li').find('a').eq(1).addClass('selected');
				}
				else if(p3 <= 0 && p4 > 0){
					removeSelectedClassBar();
					$('#top-fixed').find('ul').find('li').find('a').eq(2).addClass('selected');
				}
				else if(p4 <= 0){
					removeSelectedClassBar();
					$('#top-fixed').find('ul').find('li').find('a').eq(3).addClass('selected');
				}
				else{
					removeSelectedClassBar();
				}
		});*/
	
	
	// TOP NAVIGATOR LINKS
		/*$('#top, #top-fixed').find('span.wrap-link').hover(function(){
			$(this).addClass('temp-selected');
			$(this).find('a').addClass('temp-selected');
		}, function(){
			$(this).removeClass('temp-selected');
			$(this).find('a').removeClass('temp-selected');
		});*/
		
		
	// SLIDE PAGE BODY
		//$('#top, #top-fixed').find('div.left-side').find('ul').find('li').find('a:not(.click)').click(function(e){
		/*$('#top').find('div.right-side').find('ul').find('li:not(.share-content)').find('a').click(function(e){
			e.preventDefault();
			setScrollLinkEvent($(this));
		});
		$('#top-fixed').find('a.fixed-logo').click(function(e){
			e.preventDefault();
			setScrollLinkEvent($(this));
		});
		$('#top-fixed').find('div.left-side').find('ul').find('li:not(.share-content)').find('a:not(.click)').click(function(e){
			e.preventDefault();
			setScrollLinkEvent($(this));
		});
		$('#center').find('div.ribow-menu').find('ul').find('li:not(.share-content)').find('a:not(.video)').click(function(e){
			e.preventDefault();
			setScrollLinkEvent($(this));
		});*/
		
		
	// FADE SHARE BUTTONS
		/*$('#center').find('div.ribow-menu').find('ul').find('li.share-content').find('a').hover(function(){
			$(this).stop(true, true).fadeTo('fast', 0.7);
		},function(){
			$(this).stop(true, true).fadeTo('slow', 1);
		});
		$('#top-fixed').find('div.left-side').find('ul').find('li.share-content').find('a').hover(function(e){
			$(this).stop(true, true).fadeTo('fast', 0.7);
		},function(){
			$(this).stop(true, true).fadeTo('slow', 1);
		});*/
		
		
	// FOOTER TOP BUTTON
		/*$('#top-bt').click(function(e){
			e.preventDefault();
			setScrollWindow(0, 600);
		});*/
		
		
	// QRCODE ENLARGE
		$(document).on('click', 'a.bt-open-img', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if(modalIsOpen()){ return; }
			initModal();
			$('#modal').stop(true, true).fadeIn('fast');
			
			$('body').append('<img id="qrcode-enlarge" src="'+$handle.parents('div.event').find('img.img-qrcode').attr('src')+'" width="300" height="300" />');
			$('#modal').bind('click', function(){
				$('#qrcode-enlarge').stop(true, true).fadeOut('fast', function(){
					$(this).remove();
				});
				$(this).stop(true, true).fadeOut('fast', function(){
					$(this).unbind('click');
				});
			});
		});
		
	// POPUP
		$(document).on('click', 'a.bt-call-popup', function(e){
			e.preventDefault();
			var $handle = $(this);
			var isFromEvent = $('#event-page').length > 0 || $('#dashboard-page').length > 0 ? 1 : 0;
			var isFromOrganizer = $('#organizer-page').length > 0 ? 1 : 0;
			var config = generateSendObject($handle);
			
			if(modalIsOpen()){ return; }
			initModal();
			abortAjax();
			//setScrollWindow(0, 500);
			
			$('#modal').stop(true, true).fadeIn('fast', function(){
				$.ajax({
					url: config.url,
					type: 'post',
					dataType: 'json',
					data: {
						'method': config.method,
						'is-from-event': isFromEvent,
						'is-from-organizer': isFromOrganizer,
						'id': config.id
					}
				}).done(function(data){
					$('#modal').find('div.box-load').stop(true, true).fadeOut('fast', function(){
						$('body').append(data.html);
						putLightBoxInCenter($('body').find('div.modal-main-content'));
						placeholder({ 'overrideSupport': true });
						
						if(data.isMap){
							var latitude = data.map.isEdit ? $('#fct-latitude').val() : data.map.latitude;
							var longitude = data.map.isEdit ? $('#fct-longitude').val() : data.map.longitude;
							var zoom = data.map.isEdit ? $('#fct-zoom').val() : data.map.zoom;
							
							map('fct-map', Number(latitude), Number(longitude), Number(zoom), 'roadmap', data.map.isEdit);
						}
					});
				});
			});
		});
		
		$(document).on('click', 'div.modal-main-content a.link-close, div.modal-main-content a.bt-map-definid', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			if(!$handle.hasClass('bt-modal-2')){
				$(this).parents('div.modal-main-content').stop(true, true).fadeOut('fast', function(){
					$(this).remove();
				});
				finishModal();
			}
			else{
				//setScrollWindow(0, 500);
				$handle.parents('div.modal-main-content').stop(true, true).fadeOut('fast', function(){
					$(this).remove();
					$('div.modal-main-content').stop(true, true).fadeIn('fast');
				});
			}
		});
		
		// PRICE PARCELS
			$(document).on('change', '#fct-parcels', function(){
				var $handle = $(this);
				var parcels = Number($handle.find('option[value="'+$handle.val()+'"]').attr('data'));
				var realVal = Number($('#fct-full-price').val()), realPrice;
				
				/*parcels = parcels / 100;
				realVal = realVal + (realVal * parcels);
				realPrice = realVal.toFixed(2);
				realVal = (realPrice+'').replace('.', ',');*/
				//$handle.parents('div.payment-box').find('div.box-total-price').find('b').html('R$ '+realVal);
				//$handle.parents('div.payment-box').find('#fct-full-price-before').val(realPrice);
				
				var totalLabel = parcels == 0 ? 'Total:' : 'Total (+'+parcels+'% juros parcelas):';
				$handle.parents('div.payment-box').find('div.box-total-price').find('div.box-center').find('span').html(totalLabel);
			});
		
		// GIFT TICKET USER (RADIO BUTOON)
			$(document).on('click', 'div.modal-main-content div.gift-ticket-box div.users-box div.user', function(){
				var $handle = $(this);
				
				$handle.siblings('div.user.selected').removeClass('selected');
				if($handle.hasClass('selected')){
					$handle.removeClass('selected');
					$handle.find('input[type="radio"]').attr('checked', false);
				}
				else{
					$handle.addClass('selected');
					$handle.find('input[type="radio"]').attr('checked', true);
					$handle.parents('div.gift-ticket-box').find('div.box-error').hide();
				}
			});
			
			$(document).on('keyup', 'div.modal-main-content div.gift-ticket-box #fct-search-user', function(){
				var $handle = $(this);
				var $container = $handle.parents('form.form').find('div.users-box');
				var id = $('#fct-owner').length == 0 ? 0 : $('#fct-owner').val();
				
				abortAjax();
				$container.html('<div class="load-content"><img src="img/system/load/load-03.GIF" width="16" height="16" /> Carregando...</div>');
				checkImage($container.find('div.load-content').find('img'), 'img/system/load/load-03.GIF');
				$container.stop(true, true).fadeIn('fast', function(){					
					$ajaxHandler = $.ajax({
						url: 'package/ctrl/CtrlUser.php',
						type: 'post',
						dataType: 'json',
						data: {
							'method': 'vu-get-user-gift-ticket',
							'search': $handle.val(),
							'id': id
						}
					}).done(function(data){
						$container.html(data.html);
					});
				});
			});
			
			// STEP CONFIRM PASS TICKET AS GIFT
				$(document).on('click', '#submit-gift-ticket', function(e){
					e.preventDefault();
					var $handle = $(this);
					var config = generateSendObject($handle);
					var user = $handle.parents('form.form').find('div.user.selected');
					
					if(user.length == 0){
						$handle.siblings('div.box-error').show();
						return;
					}
					user = user.find('input[type="radio"]').val();
					//setScrollWindow(0, 500);
					
					$handle.parents('div.modal-main-content').stop(true, true).fadeOut('fast', function(){
						$('body').append('<div class="modal-main-content br-3 modal-2" style="display: none;"> <h2> <i class="fa fa-gift"></i> Confirmação repasse de ingresso <a href="#" title="Fechar" class="link-close bt-modal-2"> <i class="fa fa-times-circle"></i> </a> </h2> <div class="wrap-content"> <div class="load-content"> <img src="img/system/load/load-03.GIF" width="16" height="16" /> Carregando... </div> </div> </div>');
						checkImage($('div.modal-2 div.load-content div.wrap-content div.load-content img'), 'img/system/load/load-03.GIF');
						
						$('body').find('div.modal-2').stop(true, true).fadeIn('fast', function(){
							putLightBoxInCenter($('body').find('div.modal-2'));
							$ajaxHandler = $.ajax({
								url: config.url,
								type: 'post',
								dataType: 'json',
								data: {
									'method': config.method,
									'ticket': config.id,
									'user': user
								}
							}).done(function(data){
								$('body').find('div.modal-2').find('div.wrap-content').html(data.html);
								putLightBoxInCenter($('body').find('div.modal-2'));
							});
						});
					});
				});
				
				// BACK BUTTON
					$(document).on('click', 'div.modal-main-content a.bt-cancel', function(e){
						e.preventDefault();
						var $handle = $(this);
						//setScrollWindow(0, 500);
						$handle.parents('div.modal-main-content').stop(true, true).fadeOut('fast', function(){
							$(this).remove();
							$('div.modal-main-content').stop(true, true).fadeIn('fast');
						});
					});
		
		
	// NAVBAR CONTENT
		$(document).on('click', 'main div.left ul.nav-dashboard li a, main div.left h2 a.bt-load-content, main ul li a.bt-load-content, a.open-new-content', function(e){
			e.preventDefault();
			var $handle = $(this);
			var $container = $('div.container-form').length > 0 ? $('div.container-form') : $('div.container-dinamic');
			var config = generateSendObject($handle);
			
			if($handle.hasClass('selected')){ return; }
			abortAjax();
			
			if(!$handle.hasClass('bt-load-content')){
				$handle.parents('ul').find('a.selected').removeClass('selected');
				$handle.addClass('selected');
			}
			
			// MODAL HACKCODE
				$handle.parents('div.modal-main-content').stop(true, true).fadeOut('fast');
				$('#modal').stop(true, true).fadeOut('fast');
				selectedNavByUrl($handle);
			
			$container.stop(true, true).fadeOut('fast', function(){
				$container.html('<div class="load-content"><img src="img/system/load/load-03.GIF" width="16" height="16" /> Carregando...</div>');
				checkImage($container.find('div.load-content img'), 'img/system/load/load-03.GIF');
				
				$container.stop(true, true).fadeIn('fast', function(){					
					$ajaxHandler = $.ajax({
						url: config.url,
						type: 'post',
						dataType: 'json',
						data: {
							'method': config.method,
							'id': config.id
						}
					}).done(function(data){
						$container.stop(true, true).fadeOut('fast', function(){
							$container.html(data.html);
							$container.stop(true, true).fadeIn('fast', function(){
								if($handle.hasClass('open-bank-account')){
									$('main nav ul.box-header-buttons li a.open-bank-account').trigger('click');
								}
							});
							putEventHoverListener();
							initImageShadowbox();
							if(data.hasDate){
								generateDatepicker($('input[id^="fct-ticket-date-day-"]'));
							}
						});
					});
				});
			});
		});
		
		function selectedNavByUrl($handle){
			if($handle.hasClass('open-new-content')){
				var url = $handle.attr('href');
				//url = url.split('|');
				var $a = $('main').find('div.left').find('ul.nav-dashboard').find('li').find('a');
				//var $a = $parentNav.find('a');
				
				for(var i = 0, tam = $a.length; i < tam; i++){
					if($a.eq(i).attr('href') == url){
						$a.eq(i).parents('ul').find('a.selected').removeClass('selected');
						$a.eq(i).addClass('selected');
						break;
					}
				}
			}
		}
		
		
	// NAVBAR SUBCONTENT
		$(document).on('click', 'main nav ul.box-header-buttons li a, main a.bt-subcontent, main a.bt-come-back, .update-page', function(e){
			e.preventDefault();
			var $handle = $(this);
			var $container = $('div.sub-content');
			var config = generateSendObject($handle);
			
			if($handle.hasClass('selected')){ return; }
			abortAjax();
			
			if($handle.parents('nav').length > 0){
				$handle.parents('ul').find('a.selected').find('i').addClass('fa-chevron-right').removeClass('fa-chevron-down');
				$handle.parents('ul').find('a.selected').removeClass('selected');
				$handle.find('i').addClass('fa-chevron-down').removeClass('fa-chevron-right');
			}
			$handle.addClass('selected');
			
			$container.stop(true, true).fadeOut('fast', function(){
				$container.html('<div class="load-content"><img src="img/system/load/load-03.GIF" width="16" height="16" /> Carregando...</div>');
				checkImage($container.find('div.load-content img'), 'img/system/load/load-03.GIF');
				
				$container.stop(true, true).fadeIn('fast', function(){					
					$ajaxHandler = $.ajax({
						url: config.url,
						type: 'post',
						dataType: 'json',
						data: {
							'method': config.method,
							'id': config.id,
							'status': config.status
						}
					}).done(function(data){
						$container.stop(true, true).fadeOut('fast', function(){
							$container.html(data.html);
							$container.stop(true, true).fadeIn('fast');
							
							if(data.hasDate){
								generateDatepicker($('input[id^="fct-ticket-date-day-"]'));
							}
							if(data.hasReport){
								lineChart($('#chart-line-tickets-sell'), data.charLineTickesSell.title, data.charLineTickesSell.subTitle, data.charLineTickesSell.titleXAxis, data.charLineTickesSell.titleYAxis, data.charLineTickesSell.xAxisLabels, data.charLineTickesSell.labelData, data.charLineTickesSell.data);
								barChart($('#chart-bar-tickets-sell'), data.charBarTickesSell.title, data.charBarTickesSell.subTitle, data.charBarTickesSell.titleXAxis, data.charBarTickesSell.titleYAxis, data.charBarTickesSell.labelData, data.charBarTickesSell.data);
								pieChart($('#chart-pie-tickets-sell'), data.charPieTickesSell.title, data.charPieTickesSell.labelData, data.charPieTickesSell.data);
								lineChart($('#chart-line-views'), data.charLineViews.title, data.charLineViews.subTitle, data.charLineViews.titleXAxis, data.charLineViews.titleYAxis, data.charLineViews.xAxisLabels, data.charLineViews.labelData, data.charLineViews.data);
								barChart($('#chart-bar-views'), data.charBarViews.title, data.charBarViews.subTitle, data.charBarViews.titleXAxis, data.charBarViews.titleYAxis, data.charBarViews.labelData, data.charBarViews.data);
							}
						});
					});
				});
			});
		});
		
		
	// NAVBAR SUBCONTENT FILTER
		$(document).on('click', 'main div.sub-content a.bt-submenu', function(e){
			e.preventDefault();
			var $handle = $(this);
			var $container = $('div.sub-sub-content');
			var config = generateSendObject($handle);
			
			if($handle.hasClass('selected')){ return; }
			abortAjax();
			
			$handle.siblings('a.selected').removeClass('selected');
			$handle.addClass('selected');
			
			$container.stop(true, true).fadeOut('fast', function(){
				$container.html('<div class="load-content"><img src="img/system/load/load-03.GIF" width="16" height="16" /> Carregando...</div>');
				checkImage($container.find('div.load-content img'), 'img/system/load/load-03.GIF');
				
				$container.stop(true, true).fadeIn('fast', function(){					
					$ajaxHandler = $.ajax({
						url: config.url,
						type: 'post',
						dataType: 'json',
						data: {
							'method': config.method,
							'id': config.id
						}
					}).done(function(data){
						$container.stop(true, true).fadeOut('fast', function(){
							$container.html(data.html);
							$container.stop(true, true).fadeIn('fast');
							
							if(data.hasReport){
								if(data.hasReportPromoter){
									var i, $boxPromoter = $('div.promoter');
									
									for(i = 0, tam = $boxPromoter.length; i < tam; i++){
										lineChart($boxPromoter.eq(i).find('div[id^="chart-line-"]'), data.usersData[i].title, data.usersData[i].subTitle, data.usersData[i].titleXAxis, data.usersData[i].titleYAxis, data.usersData[i].xAxisLabels, data.usersData[i].labelData, data.usersData[i].data);
										barChart($boxPromoter.eq(i).find('div[id^="chart-bar-"]'), data.usersData[i].title, data.usersData[i].subTitle, data.usersData[i].titleXAxis, data.usersData[i].titleYAxis, data.usersData[i].labelData, data.usersData[i].data);
									}
								}
								else{
									lineChart($('#chart-line-tickets-sell'), data.charLineTickesSell.title, data.charLineTickesSell.subTitle, data.charLineTickesSell.titleXAxis, data.charLineTickesSell.titleYAxis, data.charLineTickesSell.xAxisLabels, data.charLineTickesSell.labelData, data.charLineTickesSell.data);
									barChart($('#chart-bar-tickets-sell'), data.charBarTickesSell.title, data.charBarTickesSell.subTitle, data.charBarTickesSell.titleXAxis, data.charBarTickesSell.titleYAxis, data.charBarTickesSell.labelData, data.charBarTickesSell.data);
									pieChart($('#chart-pie-tickets-sell'), data.charPieTickesSell.title, data.charPieTickesSell.labelData, data.charPieTickesSell.data);
									lineChart($('#chart-line-views'), data.charLineViews.title, data.charLineViews.subTitle, data.charLineViews.titleXAxis, data.charLineViews.titleYAxis, data.charLineViews.xAxisLabels, data.charLineViews.labelData, data.charLineViews.data);
									barChart($('#chart-bar-views'), data.charBarViews.title, data.charBarViews.subTitle, data.charBarViews.titleXAxis, data.charBarViews.titleYAxis, data.charBarViews.labelData, data.charBarViews.data);
								}
							}
						});
					});
				});
			});
			
			/*e.preventDefault();
			var $handle = $(this);
			var $container = $('div.sub-sub-content');
			
			if($handle.hasClass('selected') && !$handle.hasClass('order-bt')){ return; }
			abortAjax();
			
			var config = generateSearchObject($handle);
			$handle.siblings('a.selected').removeClass('selected');
			$handle.filter(':not(.searching-bt)').addClass('selected');
			$handle.parents('#form-header-filter').find('a.order-bt:not(.selected)').find('i.fa-caret-up').addClass('fa-caret-down').removeClass('fa-caret-up');
			
			$container.stop(true, true).fadeOut('fast', function(){
				$container.html('<div class="load-content"><i class="fa fa-spinner"></i> Carregando...</div>');
				$container.stop(true, true).fadeIn('fast', function(){					
					$ajaxHandler = $.ajax({
						url: config.url,
						type: 'post',
						dataType: 'html',
						data: {
							'method': config.method,
							'status': config.status,
							'type': config.type,
							'search': config.search,
							'state': config.state,
							'city': config.city,
							'order-by-time': config.orderByTime,
							'order-by-contracts-open': config.orderByContractsOpen,
							'order-by-contracts-close': config.orderByContractsClose,
							'order-by-dogs': config.orderByDogs,
							'order-by-dogs': config.orderByDogs,
							'order-by-walks': config.orderByWalks,
							'order-by-points': config.orderByPoints,
							'order-direction': config.orderDirection
						}
					}).done(function(data){
						$container.stop(true, true).fadeOut('fast', function(){
							$container.html(data);
							$container.stop(true, true).fadeIn('fast');
						});
					});
				});
			});*/
		});
		
		
	// LOAD MORE
		$(document).on('click', 'a.link-more', function(e){
			e.preventDefault();
			var $handle = $(this);
			var config = generateSendObject($handle);
			
			config.lastId = !$handle.prev().hasClass('vl') && !$handle.prev().hasClass('cl') ? $handle.prev().attr('id').replace(/[^\d]/g, '') : $handle.prev().prev().attr('id').replace(/[^\d]/g, '');
			config.isIndex = $handle.hasClass('link-more-in-index') ? 1 : 0;
			config.id = $('#organizer-page').length > 0 ? $('span.id-organizer').html() : 0;
			
			if($handle.attr('title') == 'Carregando...'){ return; }
			abortAjax();
			
			// IDS
				if($handle.parents('div').eq(0).find('div.event-intern, div.event').length > 0){
					config.ids = [];
					for(var i = 0, tamI = $handle.parents('div').eq(0).find('div.event-intern, div.event').length; i < tamI; i++){
						config.ids[i] = $handle.parents('div').eq(0).find('div.event-intern, div.event').eq(i).attr('id').replace(/[^\d]/g, '');
					}
					config.ids = config.ids.join(',');
				}
			// SEARCH
				if($('#search-page').length > 0){
					config.search.isSearch = 1;
					config.search.q = $('#ffse-search-hidden').val();
					config.search.ec = $('#ffse-category-hidden').val();
					config.search.s = $('#ffse-state-hidden').val();
					config.search.c = $('#ffse-city-hidden').val();
					config.search.sd = $('#ffse-date-start-hidden').val();
					config.search.ed = $('#ffse-date-end-hidden').val();
					config.search.of = $('#ffse-only-free-hidden').val();
					config.search.op = $('#ffse-only-payment-hidden').val();
				}
			
			$handle.attr('title', 'Carregando...').html('<img src="img/system/load/load-01.GIF" width="12" height="12" /> Carregando...');
			checkImage($handle.find('img'), 'img/system/load/load-01.GIF');
			
			$ajaxHandler = $.ajax({
				url: config.url,
				type: 'post',
				dataType: 'json',
				data: {
					'method': config.method,
					'last-id': config.lastId,
					'ids': config.ids,
					'is-index': config.isIndex,
					'is-search': config.search.isSearch,
					'q': config.search.q,
					'ec': config.search.ec,
					's': config.search.s,
					'c': config.search.c,
					'sd': config.search.sd,
					'ed': config.search.ed,
					'of': config.search.of,
					'op': config.search.op,
					'id': config.id
				}
			}).done(function(data){
				if(data.htmlList && data.htmlList.length == 0 && data.htmlGrade && data.htmlGrade.length == 0){
					$handle.prev().after(data.html);
					$handle.remove();
				}
				else if($handle.parents('div.box-for-load-more').length > 0){
					var $box = $handle.parents('div.box-for-load-more').parents('div').eq(0);
					$box.find('div.box-grade').find('a.link-more').eq(0).remove();
					$box.find('div.box-grade').append(data.htmlGrade);
					$box.find('div.box-list').find('a.link-more').eq(0).remove();
					$box.find('div.box-list').append(data.htmlList);
					putEventHoverListener();
				}
				else{
					$handle.after(data.html);
					$handle.remove();
				}
			});
		});
		
		// FILTER
			$(document).on('click', 'a.load-more-filter', function(e){
				e.preventDefault();
				var $handle = $(this);
				var config = generateSearchObject($handle);
				
				if($handle.attr('title') == 'Carregando...'){ return; }
				abortAjax();
				$handle.attr('title', 'Carregando...').html('<i class="fa fa-spinner"></i> Carregando...');
				
				$ajaxHandler = $.ajax({
					url: config.url,
					type: 'post',
					dataType: 'html',
					data: {
						'method': 'gw-admin-users-type-load-more',
						'status': config.status,
						'type': config.type,
						'search': config.search,
						'state': config.state,
						'city': config.city,
						'order-by-time': config.orderByTime,
						'order-by-contracts-open': config.orderByContractsOpen,
						'order-by-contracts-close': config.orderByContractsClose,
						'order-by-dogs': config.orderByDogs,
						'order-by-dogs': config.orderByDogs,
						'order-by-walks': config.orderByWalks,
						'order-by-points': config.orderByPoints,
						'order-direction': config.orderDirection,
						'last-ids': config.lastIds
					}
				}).done(function(data){
					$handle.parents().eq(0).before(data);
					$handle.parents().eq(0).remove();
				});
			});
		
		
	/*// USERS FILTER
		$(document).on('click', '#center div.user-filter a.more-information, #center div.user-filter a.notification, #center div.user-filter a.deactivate', function(e){
			e.preventDefault();
			var $handle = $(this);
			
			$handle.siblings('a.selected').trigger('click');
			
			if(!$handle.hasClass('selected')){
				$handle.parents('div.user-filter').find($handle.attr('href')).stop(true, true).slideDown('fast');
				$handle.addClass('selected');
				if($handle.find('i.fa').length > 0){
					$handle.attr('title', 'Menos informações');
					$handle.find('i.fa-plus').addClass('fa-minus').removeClass('fa-plus');
				}
			}
			else{
				$handle.parents('div.user-filter').find($handle.attr('href')).stop(true, true).slideUp('fast');
				$handle.removeClass('selected');
				if($handle.find('i.fa').length > 0){
					$handle.attr('title', 'Mais informações');
					$handle.find('i.fa-minus').addClass('fa-plus').removeClass('fa-minus');
				}
			}
		});*/
		
		
	/*// PARTNER
		// PRODUCTS
			$(document).on('click', 'a.fp-pr-more', function(e){
				e.preventDefault();
				var $handle = $(this).parents('div.fp-products-box');
				var box = '<form style="display: none;" class="fp-pr-form br-03" action="package/ctrl/CtrlFile.php"> <a href="#" class="fp-pr-close br-03"><i class="fa fa-times"></i></a> <div class="fct-box-img"> <div class="mask"><i class="fa fa-spinner"></i></div> <img src="img/system/bg/default-01.png" class="br-03" width="150" height="150" /> <input id="fct-img" class="input-file" type="file" name="fct-img"> <div class="br-03 remove" title="Remover"><i class="fa fa-times"></i></div> <a href="#" class="load-img br-03" title="*Carregar imagem">*Carregar imagem</a> </div> <div class="fp-pr-information"> <div class="box-field left"> <input type="text" class="fp-pr-name" placeholder="*Nome" /> </div> <div class="box-field left"> <input type="text" class="fp-pr-qtd" placeholder="*Quantidade" /> </div> <div class="box-field left"> <input type="text" class="fp-pr-price" placeholder="*R$" /> </div> <div class="cl"></div> <div class="box-field left"> <textarea class="fp-pr-details" placeholder="*Detalhes"></textarea> </div> <div class="box-field"> <textarea class="fp-pr-conditions" placeholder="*Condições para troca (caso tenha dúvida para preencher as condições deixe em branco que nós entraremos em contato para preencher junto com você)"></textarea> </div> <div class="cl"></div> </div> <div class="fp-pr-places-box br-03"> <h4>Locais de entrega <span>(vázio indica entrega a todo o Brasil</span>)</h4> <div class="fp-pr-place br-03"> <select class="fp-pr-state"> <option value="0">*Estado</option><option value="1">Acre (AC)</option><option value="2">Alagoas (AL)</option><option value="3">Amapá (AP)</option><option value="4">Amazonas (AM)</option><option value="5">Bahia (BA)</option><option value="6">Ceará (CE)</option><option value="7">Distrito Federal (DF)</option><option value="8">Espírito Santo (ES)</option><option value="9">Goiás (GO)</option><option value="10">Maranhão (MA)</option><option value="11">Mato Grosso (MT)</option><option value="12">Mato Grosso do Sul (MS)</option><option value="13">Minas Gerais (MG)</option><option value="14">Pará (PA)</option><option value="15">Paraíba (PB)</option><option value="16">Paraná (PR)</option><option value="17">Pernambuco (PE)</option><option value="18">Piauí (PI)</option><option value="19">Rio de Janeiro (RJ)</option><option value="20">Rio Grande do Norte (RN)</option><option value="21">Rio Grande do Sul (RS)</option><option value="22">Rondônia (RO)</option><option value="23">Roraima (RR)</option><option value="24">Santa Catarina (SC)</option><option value="25">São Paulo (SP)</option><option value="26">Sergipe (SE)</option><option value="27">Tocantins (TO)</option> </select> <div class="box-field left"> <input type="text" class="fp-pr-city" placeholder="*Cidade" /> </div> <a href="#" class="fp-pr-place-close br-03"><i class="fa fa-times"></i></a> <div class="cl"></div> </div> <a href="#" class="fp-pr-place-more br-03"><i class="fa fa-plus"></i> mais</a> <div class="cl"></div> </div> <input id="fct-method" name="method" type="hidden" value=""> <div class="cl"></div> </form>';
				
				if($handle.find('form.fp-pr-form').length < 20){
					$handle.find('form.fp-pr-form:last').after(box);
					$handle.find('form.fp-pr-form:last').stop(true, true).slideDown('fast');
				}
			});
			
			// CLOSE
				$(document).on('click', 'a.fp-pr-close', function(e){
					e.preventDefault();
					var $handle = $(this).parents('form.fp-pr-form');
					var $parent = $handle.parents('div.fp-products-box');
					
					if($parent.find('form.fp-pr-form').length > 1){
						$handle.stop(true, true).slideUp('fast', function(){
							$(this).remove();
						});
					}
				});
		
			// PLACES
				$(document).on('click', 'a.fp-pr-place-more', function(e){
					e.preventDefault();
					var $handle = $(this).parents('div.fp-pr-places-box');
					var box = '<div style="display: none;" class="fp-pr-place br-03"> <select class="fp-pr-state"> <option value="0">*Estado</option><option value="1">Acre (AC)</option><option value="2">Alagoas (AL)</option><option value="3">Amapá (AP)</option><option value="4">Amazonas (AM)</option><option value="5">Bahia (BA)</option><option value="6">Ceará (CE)</option><option value="7">Distrito Federal (DF)</option><option value="8">Espírito Santo (ES)</option><option value="9">Goiás (GO)</option><option value="10">Maranhão (MA)</option><option value="11">Mato Grosso (MT)</option><option value="12">Mato Grosso do Sul (MS)</option><option value="13">Minas Gerais (MG)</option><option value="14">Pará (PA)</option><option value="15">Paraíba (PB)</option><option value="16">Paraná (PR)</option><option value="17">Pernambuco (PE)</option><option value="18">Piauí (PI)</option><option value="19">Rio de Janeiro (RJ)</option><option value="20">Rio Grande do Norte (RN)</option><option value="21">Rio Grande do Sul (RS)</option><option value="22">Rondônia (RO)</option><option value="23">Roraima (RR)</option><option value="24">Santa Catarina (SC)</option><option value="25">São Paulo (SP)</option><option value="26">Sergipe (SE)</option><option value="27">Tocantins (TO)</option> </select> <div class="box-field left"> <input type="text" class="fp-pr-city" placeholder="*Cidade" /> </div> <a href="#" class="fp-pr-place-close br-03"><i class="fa fa-times"></i></a> <div class="cl"></div> </div>';
					
					if($handle.find('div.fp-pr-place').length < 20){
						$handle.find('div.fp-pr-place:last').after(box);
						$handle.find('div.fp-pr-place:last').stop(true, true).slideDown('fast');
					}
				});
				
				// CLOSE
					$(document).on('click', 'a.fp-pr-place-close', function(e){
						e.preventDefault();
						var $handle = $(this).parents('div.fp-pr-place');
						var $parent = $handle.parents('div.fp-pr-places-box');
						
						if($parent.find('div.fp-pr-place').length > 1){
							$handle.stop(true, true).slideUp('fast', function(){
								$(this).remove();
							});
						}
					});
		*/
		
		
	// USER ADMIN FORM
		$(document).on('change', '.form input[name="fct-remove-account-reason"]', function(){
			if($(this).parents('div').eq(0).find('input[type="radio"]:checked').hasClass('radio-other')){
				$('#fct-remove-account-reason-other').attr('disabled', false);
			}
			else{
				$('#fct-remove-account-reason-other').attr('disabled', true);
			}
		});
		
		
		
		
		
		
		
		
	/* ************************ FUNCTIONS *********************** */
		function abortAjax(){
			if($ajaxHandler != undefined){
				$ajaxHandler.abort();
			}
		}
		
		function generateSendObject($handle){
			var aux = $handle.attr('href').split('|');
			var obj = {
				url: aux[0],
				method: aux[1],
				id: aux[2] != undefined ? aux[2] : 0,
				lastId: 0,
				ids: 0,
				status: aux[2] != undefined ? aux[2] : 0,
				isIndex: 0,
				search:{
					isSearch: 0,
					q: '',
					ec: 0,
					s: 0,
					c: '',
					sd: '',
					ed: '',
					of: 0,
					op: 0
				}
			};
			return(obj);
		}
		
		function generateSearchObject($handle){
			var obj = { url: '',method: '',type: 0,search: '',state: 0,city: '',orderByTime: 0,orderByContractsOpen: 0,orderByContractsClose: 0,orderByDogs: 0,orderByDogs: 0,orderByWalks: 0,orderByPoints: 0,orderDirection: 0,lastIds: 0 };
			var $parents = $handle.parents('div.sub-content').find('#form-header-filter');//$handle.parents('#form-header-filter'); 
			var aux = $handle.hasClass('type-bt') ? $parents.find('a.type-bt:not(.selected)').attr('href').split('|') : $parents.find('a.type-bt.selected').attr('href').split('|');
			
			obj.url = aux[0];
			obj.method = aux[1];
			obj.type = aux[2];
			aux = $parents.parents('div.container-content').find('div.box-header-buttons').find('a.selected').attr('href').split('|');
			obj.status = aux[2];
			aux = $parents.find('#fhf-city').val().split('|');
			obj.search = $parents.find('#fhf-name').hasClass('placeholder') ? '' : $.trim( $parents.find('#fhf-name').val());
			obj.state = aux[0];
			obj.city = aux[1];
			
			if((!$handle.hasClass('type-bt') && $parents.find('a.type-bt.selected').attr('title') == 'Walkers') || $handle.attr('title') == 'Walkers'){
				$parents.find('a.by-dogs').stop(true, true).fadeOut('fast');
			}
			else{
				$parents.find('a.by-dogs').stop(true, true).fadeIn('fast');
			}
			
			if(!$handle.hasClass('order-bt')){
				obj.orderByTime = $parents.find('a.order-bt').eq(0).hasClass('selected') ? 1 : 0;
				obj.orderByContractsOpen = $parents.find('a.order-bt').eq(1).hasClass('selected') ? 1 : 0;
				obj.orderByContractsClose = $parents.find('a.order-bt').eq(2).hasClass('selected') ? 1 : 0;
				obj.orderByDogs = $parents.find('a.order-bt').eq(3).hasClass('selected') ? 1 : 0;
				obj.orderByWalks = $parents.find('a.order-bt').eq(4).hasClass('selected') ? 1 : 0;
				obj.orderByPoints = $parents.find('a.order-bt').eq(5).hasClass('selected') ? 1 : 0;
				obj.orderDirection = $parents.find('a.order-bt.selected').find('i.fa-caret-up').length > 0 ? 1 : 0;
			}
			else{
				obj.orderByTime = $handle.hasClass('by-time') ? 1 : 0;
				obj.orderByContractsOpen = $handle.hasClass('by-contracts-open') ? 1 : 0;
				obj.orderByContractsClose = $handle.hasClass('by-contracts-close') ? 1 : 0;
				obj.orderByDogs = $handle.hasClass('by-dogs') ? 1 : 0;
				obj.orderByWalks = $handle.hasClass('by-walks') ? 1 : 0;
				obj.orderByPoints = $handle.hasClass('by-points') ? 1 : 0;
				obj.orderDirection = $handle.find('i.fa-caret-down').length > 0 ? 1 : 0;
			}
			
			if($handle.find('i.fa-caret-down').length > 0){
				$handle.find('i.fa-caret-down').addClass('fa-caret-up').removeClass('fa-caret-down');
			}
			else if($handle.find('i.fa-caret-up').length > 0){
				$handle.find('i.fa-caret-up').addClass('fa-caret-down').removeClass('fa-caret-up');
			}
			
			if($handle.hasClass('load-more-filter')){
				obj.lastIds = [];
				$users = $handle.parents('div.sub-sub-content').find('div.user-filter');
				for(i = 0, tam = $users.length; i < tam; i++){
					obj.lastIds[i] = $users.eq(i).attr('id').replace(/[^\d]/g, '');
				}
				obj.lastIds = obj.lastIds.join(',');
			}
			return(obj);
		}
	
		function placeholder(){
			$(":input[placeholder]").placeholder({
				activeClass: 'placeholder',
				overrideSupport: true
			});
		}
		
		function loadModal(){
			$('#modal').css({
				width: $(window).width+'px',
				height: $(window).height+'px'
			}).stop(true, true).fadeIn('normal');
		}
		
		function setScrollWindow(px, time){
			$('html, body').stop(true, true).animate({
				scrollTop: px+'px'
			}, time);
		}
		
		function removeSelectedClassBar(){
			$('#top-fixed').find('ul').find('li').find('span.selected').removeClass('selected');
			$('#top-fixed').find('ul').find('li').find('a.selected').removeClass('selected');
		}
		
		function isEmail(email){
			var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
			var check=/@[\w\-]+\./;
			var checkend=/\.[a-zA-Z]{2,3}$/;
			if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
			else{ return true; }
		}
		
		function generateDatepicker($handle){
			$.datepicker.regional['pt-BR'] = {
				closeText: 'Fechar',
				prevText: '&#x3c;Anterior',
				nextText: 'Pr&oacute;ximo&#x3e;',
				currentText: 'Hoje',
				monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
				dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'S&aacute;bado'],
				dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
				dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
				weekHeader: 'Sm',
				dateFormat: 'dd/mm/yy',
				firstDay: 0,
				isRTL: false,
				showMonthAfterYear: false,
				yearSufix: ''
			};
			$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
			$handle.datepicker({
				minDate: new Date(),
				hideIfNoPrevNext: false,
				showOn: 'focus',
				buttonText: '',
				show: false
			});
			//$handle.datepicker('show');
			//$handle.datepicker('getDate');
		}
		
		function getCorrectMonth(month){
			if(month == 'Jan'){ return('01'); }
			else if(month == 'Feb'){ return('02'); }
			else if(month == 'Mar'){ return('03'); }
			else if(month == 'Apr'){ return('04'); }
			else if(month == 'May'){ return('05'); }
			else if(month == 'Jun'){ return('06'); }
			else if(month == 'Jul'){ return('07'); }
			else if(month == 'Aug'){ return('08'); }
			else if(month == 'Sep'){ return('09'); }
			else if(month == 'Oct'){ return('10'); }
			else if(month == 'Nov'){ return('11'); }
			else if(month == 'Dec'){ return('12'); }
		}
		
		function isCPF(cpf){
			cpf = cpf.replace(/[^\d]+/g,'');
			if(cpf == '')
				return false;
			
			// Elimina CPFs invalidos conhecidos
			if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
				return false;
				
			// Valida 1o digito
			add = 0;
			for(i=0; i < 9; i ++)
				add += parseInt(cpf.charAt(i)) * (10 - i); 
			rev = 11 - (add % 11);
			if(rev == 10 || rev == 11)
				rev = 0;
			if(rev != parseInt(cpf.charAt(9)))
				return false;
				
			// Valida 2o digito
			add = 0;
			for(i = 0; i < 10; i ++)
				add += parseInt(cpf.charAt(i)) * (11 - i);
			rev = 11 - (add % 11);
			if(rev == 10 || rev == 11)
				rev = 0;
			if(rev != parseInt(cpf.charAt(10)))
				return false;
			return true;
		}
		
		function openVideo(){
			var box = '<div id="modal-video"><iframe width="848" height="480" src="//www.youtube.com/embed/DUbahkmGgUY" frameborder="0" allowfullscreen></iframe></div>';
			$('body').append(box);
			
			$('#modal-video').click(function(){
				$(this).stop(true, true).fadeOut('fast', function(){
					$(this).remove();
				});
			});
			
			$('#modal-video').stop(true, true).fadeIn('fast');
		}
		
		function setScrollLinkEvent($handle){
			var id = $handle.attr('href');
			var positionY = parseInt($(id).offset().top);
			setScrollWindow(positionY, 600);
		}
		
		function modalIsOpen(){
			return($('#modal').is(':visible'));
		}
		
		function initModal(text){
			text = text == undefined || text.length == 0 ? 'Carregando...' : text;
			$('#modal').css({
				width: $(window).width()+'px',
				height: $(window).height()+'px'
			});
			//$('#modal').html('<div class="box-load"> <img src="img/system/load/load-01.GIF" width="32" /> Carregando... </div>');
			$('#modal').html('<div class="box-load"> <img src="img/system/load/load-01.GIF" width="32" /> '+text+' </div>');
			checkImage($('#modal').find('div.box-load').find('img'), 'img/system/load/load-01.GIF');
		}
		function finishModal(){
			$('#modal').stop(true, true).fadeOut('fast');
		}
		
		
	// CHARTS
		function lineChart($handle, chtTitle, chtSubTitle, chtXAxisTitle, chtYAxisTitle, chtXAxis, chtLabel, chtData){
			$handle.highcharts({
				chart: {
					type: 'line'
				},
				title: {
					text: chtTitle
				},
				subtitle: {
					text: chtSubTitle
				},
				xAxis: {
					categories: chtXAxis,
					title: {
						text: chtXAxisTitle
					}
				},
				legend: {
					layout: 'vertical',
					align: 'bottom', // right
					verticalAlign: 'bottom', // middle
					borderWidth: 0
				},
				yAxis: {
					title: {
						text: chtYAxisTitle
					}
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: true
					}
				},
				series: chtData/*[{
						name: chtLabel,
						data: chtData
					}]*/
			});
		}
		
		function barChart($handle, chtTitle, chtSubTitle, chtXAxisTitle, chtYAxisTitle, chtSeriesName, chtData){
			for(var i = 0, tam = chtData.length; i < tam; i++){
				chtData[i].dataLabels = {
						enabled: true,
						rotation: -90,
						color: '#999',
						align: 'right',
						x: 4,
						y: -15,
						style: {
							fontSize: '9px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
			}
			
			$handle.highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: chtTitle
				},
				subtitle: {
					text: chtSubTitle
				},
				xAxis: {
					type: 'category',
					labels: {
						rotation: -45,
						style: {
							fontSize: '13px',
							fontFamily: 'Verdana, sans-serif'
						}
					},
					title: {
						text: chtXAxisTitle
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: chtYAxisTitle
					}
				},
				legend: {
					layout: 'vertical',
					align: 'bottom', // right
					verticalAlign: 'bottom', // middle
					borderWidth: 0
				},
				series: chtData /*[{
					name: chtSeriesName,
					data: chtData,
					dataLabels: {
						enabled: true,
						rotation: -90,
						color: '#999',
						align: 'right',
						x: 4,
						y: -15,
						style: {
							fontSize: '9px',
							fontFamily: 'Verdana, sans-serif'
						}
					}
				}]*/
			});
		}
		
		function pieChart($handle, chtTitle, chtLabelModal, chtData){
			$handle.highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: 1,//null,
					plotShadow: false
				},
				title: {
					text: chtTitle
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>:{point.y} ({point.percentage:.1f}%)',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				series: [{
					type: 'pie',
					name: chtLabelModal,
					data: chtData
				}]
			});
		}
	
	function checkImage($handle, src) {
		var img = new Image();
		img.onload = function(){
			$handle.attr('src', src);
		}; 
		img.onerror = function(){
			checkImage($handle, '../'+src);
		};
		img.src = src;
	}
	
	function isNumeric(obj) {
		return !jQuery.isArray( obj ) && (obj - parseFloat( obj ) + 1) >= 0;
	}
		
	function putLightBoxInCenter($handle){
		if($handle.innerHeight() < $(window).innerHeight()){
			$handle.css({
				position: 'fixed',
				top: '50%',
				left: '50%',
				marginTop: '-'+($handle.innerHeight()/2)+'px',
				marginLeft: '-'+($handle.innerWidth()/2)+'px'
			});
		}
		else{
			setScrollWindow(0, 500);
		}
	}
	
	function putEventHoverListener(){
		$('div.event div.center').off('mouseenter mouseleave');
		$('div.event div.center').hover(function(){
			$(this).find('div.info').stop(true, true).fadeIn('fast');
		},
		function(){
			$(this).find('div.info').stop(true, true).fadeOut('normal');
		});
	}
	
	function initImageShadowbox(){
		Shadowbox.init({
			overlayOpacity: 0.8,
			skipSetup: true
		});
		setupDemos();		
	}
// ]]>