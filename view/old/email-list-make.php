<?php
	$html_EmailList = '';
	$tam = count($arrayEmailList);
	$html_LoadMore = '';
	
	
	if($tam == __LIMIT_EMAIL_LIST__ && $type == 1){
		$tam--;
		$html_LoadMore = <<<HTML
			<tr style="background: transparent;">
				<td colspan="4" style="padding: 0;">
					<a href="package/ctrl/CtrlAdmin.php|load-more-email-list" class="load-more border-radius" title="Carregar mais">
						<i class="icon-circle-arrow-down"></i>
						Carregar mais
					</a>
				</td>
			</tr>
HTML;
	}
	
	
	for($i = 0; $i < $tam; $i++){
		$id = $arrayEmailList[$i]->getId();
		$date = date('d/m/Y \&\a\g\r\a\v\e\;\s H:i:s', $arrayEmailList[$i]->getTime());
		$email = $arrayEmailList[$i]->getUser()->getEmail();
		$registration = $arrayEmailList[$i]->getEmailListType()->getLabelItem();
		$status = $arrayEmailList[$i]->getStatusLabel();
		$open = $arrayEmailList[$i]->getOpen() == 1 ? 'Sim' : 'N&atilde;o';
		
		if($typeTable == 1){
			$html_EmailList .= <<<HTML
				<tr id="el-$id">
					<td>$email</td>
					<td>$date</td>
					<td>$registration</td>
					<td>$status</td>
					<td>$open</td>
				</tr>
HTML;
		}
		else if($typeTable == 2){
			$html_EmailList .= <<<HTML
				<tr>
					<td><input id="el-$id" type="checkbox" checked="checked" /></td>
					<td>$email</td>
					<td>N&atilde;o enviado</td>
				</tr>
HTML;
		}
		else if($typeTable == 3){
			$statusEmail = $arrayEmailList[$i]->getStatus() == 1 ? 'Enviado' : 'N&atilde;o enviado';
			$statusUser = $arrayEmailList[$i]->getUser()->getStatus() == 3 ? 'Unsubscribe' : 'Ativo';
			$html_EmailList .= <<<HTML
				<tr>
					<td>$email</td>
					<td>$statusEmail</td>
					<td>$open</td>
					<td>$statusUser</td>
				</tr>
HTML;
		}
	}
?>