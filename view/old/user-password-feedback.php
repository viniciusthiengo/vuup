<?php
	if($return == 0){
		echo '0|Senha atual incorreta!';
	}
	else if($return == 1){
		echo '1|Senha atualizada com sucesso!';
	}
	else if($return == 2){
		echo '2|Nova senha inválida!';
	}
	else if($return == 3){
		echo '3|Conta deletada com sucesso!';
	}
?>