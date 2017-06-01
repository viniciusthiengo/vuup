<?php
	// config.php
	
	// PATH
	define('__PATH__', @fopen('package/ctrl/CtrlEvent.php', 'r') ? './' : '../../'); // http://www.thiengo.com.br // @fopen('C:/AppServ/www/vinicius/peffans') ? 'C:/AppServ/www/vinicius/peffans' : 'C:/AppServ/www/vinicius/peffans'
	//define('__PATH_FULL_PREFIX__', 'http://www.peffans.com/');
	define('__PATH_FULL_PREFIX__', 'http://localhost:8888/vinicius/vuup/');
	
	//define('__PATH_FOR_LONG_URL__', preg_match('/^(fotos|videos|celulas|projetos|confirmar|descadastrar|reiniciar-senha){1}$/', $_GET['page']) && !empty($_GET['subpage']) ? '../' : './');
	if(!empty($_GET['subpage']) && !empty($_GET['subsubpage'])){
		define('__PATH_FOR_LONG_URL__', '../../');
	}
	else if(!empty($_GET['subpage']) && empty($_GET['subsubpage'])){
		define('__PATH_FOR_LONG_URL__', '../');
	}
	else{
		define('__PATH_FOR_LONG_URL__', './');
	}
	
	// SYSTEM
		define('__VUUP_PHONE__', '(21) 4063-4141');
	
	// TAXES
		define('__TAX_MIN__', 3);
		define('__TAX_PERCENT__', 0.1);
		define('__MIN_PRICE__', (__TAX_PERCENT__*100)*__TAX_MIN__);
	
	// LIMITS
		define('__LIMIT_EVENTS__', 14);
		define('__LIMIT_FOLLOWS_PAGE__', 25);
		define('__LIMIT_USERS_CONFIRMED__', 25);
		define('__LIMIT_TICKETS__', 14);
		define('__LIMIT_USERS_PASS_TICKET__', 15);
		define('__LIMIT_USERS_CONFIRMED_MOB__', 10);
	
	// POINTS
		define('__POINTS_WALKER_IN_WALK__', 25);
		define('__POINTS_DOG_OWNER_IN_WALK__', 20);
		define('__POINTS_CANCEL_CONTRACT__', 30);
		define('__POINTS_ORDER_ACCEPTED__', 10);
		define('__POINTS_REVIEW__', 30);
	
	// PAGINATION
		define('__MAX_NUM_PAGINATION__', 8);
		define('__CENTER_NUM_PAGINATION__', 5);
	
	// SOCIAL NETWORK
		define('__FACEBOOK_ID__', '657926134229159');
		define('__FACEBOOK_SECRET__', 'db916d458319c4423a1c4b715fc82546');
		define('__GOOGLE_ID__', '');
		define('__GOOGLE_SECRET__', '');
	
	// TIME
		define('__TIME_DELAY_LAST_CONNECTION__', (5*60));
		define('__TIME_DOG_WAIT_CONFIRM__', (5*60));
		define('__TIME_ACCERT__', (60 * 60 * 2));
		define('__TIME_REJECT_ORDER_REPLY__', 60);
		define('__TIME_RECOVERY_PASSWORD__', (24*60*60));
		define('__TIME_EXTRA_EVENT__', (10*60*60));
		define('__TIME_EXTRA_FOR_TICKET__', (5*60*60));
	
	// GCM
		define('__GOOGLE_API_KEY__', 'AIzaSyCBPrAgppgYhLG8AOew_x5hmrdJavAZmTY');
		define('__HAS_NOTIFICATION__', 1);
	
	// COOKIE TIME
		define('__COOKIE_KEEP_CONNNECTED__', sha1('vuup.brazil.canada'));
		define('__COOKIE_KEEP_CONNNECTED_TIME__', time()+(31*24*60*60));
	
	// SEPARATORS
		define('__COMP_URL_MOBILE__', '');
		define('__SPMAIN__', '__SPMAIN__');
		define('__SPLINE__', '__SPLINE__');
		define('__SPDATA__', '__SPDATA__');
		define('__SPSUBDATA__', '__SPSUBDATA__');
	
	// SES
		define('__SES_TOKEN__', 'AKIAIYJDGCRR634A67ZQ');
		define('__SES_KEY__', 'E6S3Fuhx05NbdeMmJ7wfyFooosY5C1bsXQ3JZYr8');
		define('__SES_EMAIL_FROM__', 'peffans.eventos@gmail.com');
		define('__SES_EMAIL_REPLY__', 'peffans.eventos@gmail.com');
		//define('__SES_EMAIL_REPLY__', 'no-reply@vuup.com.br');
	
	// ERROR CODE
		define('__ERROR_USER_INACTIVE__', 9001);
		define('__ERROR_EVENT_INACTIVE__', 9002);
		define('__ERROR_TICKET_INACTIVE__', 9003);
