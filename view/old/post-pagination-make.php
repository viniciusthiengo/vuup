<?php
	$html_Pagination = '';
	
	if($pagination->getQtdPages() > 1){
		$urlCategory = strcasecmp('pagina', $_GET['page']) == 0 ? '' : $_GET['page'];
		if(!empty($_GET['page']) && strcasecmp('pagina', $_GET['page']) != 0 && !empty($_GET['subpage'])
			|| !empty($_GET['page']) && strcasecmp('pagina', $_GET['page']) != 0){
			$urlCategory .= '/';
		}
		
		// FIRST PAGE
			if($pagination->getQtdPages() > __MAX_NUM_PAGINATION__ && $pagination->getNum() > 0 && $pagination->getNum() >= __CENTER_NUM_PAGINATION__)
				$html_Pagination .= '<a href="'.__PATH_FOR_LONG_URL__.trim($urlCategory,'/').'" title="Primeira">&laquo; Primeira</a> ';
		
		// LAST PAGE ACCESS
			if($pagination->getNum() > 0){
				$auxSpan = $pagination->getQtdPages() > __MAX_NUM_PAGINATION__ && $pagination->getNum() >= __CENTER_NUM_PAGINATION__ ? '<span>...</span>' : '';
				$html_Pagination .= '<a href="'.__PATH_FOR_LONG_URL__.$urlCategory.'pagina/'.($pagination->getNum() - 1).'" title="Anterior">&laquo; Anterior</a> '.$auxSpan;
			}
		
		
		if($pagination->getNum() >= __CENTER_NUM_PAGINATION__ && $pagination->getQtdPages() > __MAX_NUM_PAGINATION__ && $pagination->getNum() <= $pagination->getQtdPages() - 3)
			$i = $pagination->getNum() - 3;
		else if($pagination->getNum() >= __CENTER_NUM_PAGINATION__ && $pagination->getQtdPages() > __MAX_NUM_PAGINATION__ && $pagination->getNum() > $pagination->getQtdPages() - 3)
			$i = $pagination->getNum() - (3 + abs($pagination->getQtdPages() - 3 - $pagination->getNum()));
		else
			$i = 1;
			
		
		if($pagination->getNum() >= __CENTER_NUM_PAGINATION__ && $pagination->getNum() < $pagination->getQtdPages()-3 && $pagination->getQtdPages() > __MAX_NUM_PAGINATION__)
			$tam = $pagination->getNum() + 3;
		else if(($pagination->getNum() >= __CENTER_NUM_PAGINATION__ && $pagination->getQtdPages() <= __MAX_NUM_PAGINATION__)
				|| ($pagination->getNum() < __CENTER_NUM_PAGINATION__ && $pagination->getQtdPages() <= __MAX_NUM_PAGINATION__)
				|| ($pagination->getNum() >= __CENTER_NUM_PAGINATION__ && $pagination->getNum() >= $pagination->getQtdPages()-3 && $pagination->getQtdPages() > __MAX_NUM_PAGINATION__))
			$tam = $pagination->getQtdPages();
		else
			$tam = __MAX_NUM_PAGINATION__;

		for(; $i <= $tam; $i++){
			$classAux = $i == $pagination->getNum() ? ' class="select"' : '';
			if($i > 1){
				$html_Pagination .= '<a href="'.__PATH_FOR_LONG_URL__.$urlCategory.'pagina/'.$i.'"'.$classAux.' title="Página '.$i.'">'.$i.'</a> ';
			}
			else{
				$classAux = $pagination->getNum() == 0 ? ' class="select"' : '';
				$html_Pagination .= '<a href="'.__PATH_FOR_LONG_URL__.trim($urlCategory, '/').'"'.$classAux.' title="Página inicial">'.$i.'</a> ';
			}
		}
		
		// NEXT PAGE
			if($pagination->getNum() < $pagination->getQtdPages()){
				$i = $pagination->getNum() == 0 ? 2 : $pagination->getNum()+1;
				$auxSpan = $pagination->getQtdPages() > __MAX_NUM_PAGINATION__ && $pagination->getNum() < $pagination->getQtdPages()-3 ? '<span>...</span>' : '';
				$html_Pagination .= $auxSpan.'<a href="'.__PATH_FOR_LONG_URL__.$urlCategory.'pagina/'.$i.'" title="Próxima">Próxima &raquo;</a> ';
			}
		
		echo '<div class="pagination">'.$html_Pagination.'</div>';
	}
?>