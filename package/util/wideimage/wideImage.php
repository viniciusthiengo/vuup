<?php
	// wideImage.php
	
	/*
	* Tutorial para a lib WideImage
	* http://blog.thiagobelem.net/manipulando-imagens-no-php/
	*
	* Tutorial para senhas hash
	* http://blog.thiagobelem.net/criptografando-senhas-no-php-usando-bcrypt-blowfish/
	*/
	
	require_once('lib/WideImage.php');
	
	$img = WideImage::load('Penguins.jpg');
	
	// Redimensiona a imagem para caber em um quadrado de 200x200px
	//$img = $img->resize(30, 30, 'fill');
	
	// Corta um quadrado de 100x80px no meio da imagem
	$img = $img->crop('50% - 50', '50% - 40', 100, 80);
	
	// Salva a imagem em um novo arquivo
	$img->saveToFile('Penguins3.jpg');
	// Limpa a imagem da memória
	$img->destroy();
	
	
	/*
	// Define o tipo de cabeçalho para exibir a imagem corretamente
	header("Content-type: image/jpeg"); 
	// Envia a imagem para o navegador com 80% de qualidade
	$img->asString('jpg', 100);
	*/
?>