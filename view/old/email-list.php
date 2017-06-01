<?php
	if(preg_match('/^(get-email-list){1}$/', $_POST['method'])){
?>
		<form id="form-comum-admin" action="package/ctrl/CtrlFile.php" method="post">
			<h2>
				<i class="icon-envelope"></i>
				Lista emails
				<a href="package/ctrl/CtrlAdmin.php|get-form-report-email-sent" class="inner-link border-radius" title="Relatório email enviado">Relatório email enviado</a>
				<a href="package/ctrl/CtrlAdmin.php|get-form-email-list" class="inner-link border-radius" title="Enviar email">Enviar email</a>
				<a href="package/ctrl/CtrlAdmin.php|get-only-email-list" class="inner-link selected border-radius" title="Lista">Lista</a>
				<div class="cl"></div>
			</h2>
			<div class="content-inner">
				<fieldset>
					<a href="#" class="email-list-csv border-radius" title="Download CSV">
						<i class="icon-cloud-download"></i>
						Download CSV
					</a>
					<table>
						<tr>
							<th><i class="icon-envelope"></i> Email</th>
							<th><i class="icon-calendar"></i> Data / horário</th>
							<th><i class="icon-asterisk"></i> Inscrição</th>
							<th>Confirmado <i class="icon-question-sign"></i></th>
							<th>Abriu <i class="icon-folder-open"></i></th>
						</tr>
						<?php
							echo $html_EmailList;
							echo $html_LoadMore;
						?>
					</table>
				</fieldset>
			</div>
		</form>
<?php
	}
	else if(preg_match('/^(get-only-email-list){1}$/', $_POST['method'])){
?>
		<fieldset>
			<a href="#" class="email-list-csv border-radius" title="Download CSV">
				<i class="icon-cloud-download"></i>
				Download CSV
			</a>
			<table>
				<tr>
					<th><i class="icon-envelope"></i> Email</th>
					<th><i class="icon-calendar"></i> Data / horário</th>
					<th><i class="icon-asterisk"></i> Inscrição</th>
					<th>Confirmado <i class="icon-question-sign"></i></th>
					<th>Abriu <i class="icon-folder-open"></i></th>
				</tr>
				<?php
					echo $html_EmailList;
					echo $html_LoadMore;
				?>
			</table>
		</fieldset>
<?php
	}
	else if(preg_match('/^(get-form-email-list){1}$/', $_POST['method'])){
?>
		<fieldset>
			<div class="box-section">
				<div class="title">Conteúdo email</div>
				<input type="text" id="fca-title-email-p" placeholder="*Nome envio" maxlength="100" />
				<br />
				<input type="text" id="fca-subject-email-p" placeholder="*Assunto" maxlength="30" />
				<br /><br />
				<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
			</div>
			<div class="box-section">
				<div class="title">Emails</div>
				<table class="send-email">
					<tr>
						<th>Enviar?</th>
						<th><i class="icon-envelope"></i> Email</th>
						<th>Status</th>
					</tr>
					<?php
						echo $html_EmailList;
					?>
				</table>
			</div>
		</fieldset>
		<a href="#" class="submit" id="fca-submit-submit-emails" title="Enviar">
			Enviar
		</a>
		<input type="hidden" name="method" id="fca-method" value="" />
		<div class="cl"></div>
<?php
	}
	else if(preg_match('/^(get-form-report-email-sent){1}$/', $_POST['method'])){
		
		$html_SelctorEmail = '<option value="0">Emails enviados</option>';
		for($i = 0, $tam = count($arrayEmail); $i < $tam; $i++){
			$date = date('d\/m\/Y H:i', $arrayEmail[$i]->getTime());
			$html_SelctorEmail .= '<option value="'.$arrayEmail[$i]->getId().'">'.$arrayEmail[$i]->getName().' ('.$date.')</option>';
		}
?>
		<fieldset>
			<select id="fcp-email-sent-p">
				<?php
					echo $html_SelctorEmail;
				?>
			</select>
			<div class="box-section">
				<div class="title">Emails</div>
				<table class="send-email">
					<tr>
						<th><i class="icon-envelope"></i> Email</th>
						<th>Status envio</th>
						<th>Abriu?</th>
						<th>Status email</th>
					</tr>
				</table>
			</div>
		</fieldset>
<?php
	}