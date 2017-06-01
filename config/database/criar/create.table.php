<?php
	require_once('../package/class/thiengo/Database.php');
	
	$conn = new Database();
	
	
	// th_user
	$table = <<<SQL
		CREATE TABLE th_user(
			id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
			name VARCHAR(30) NOT NULL,
			email VARCHAR(100) NOT NULL,
			password CHAR(80) NOT NULL,
			PRIMARY KEY(id),
			UNIQUE(email)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_user</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_message_day
	$table = <<<SQL
		CREATE TABLE th_message_day(
			id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
			id_user TINYINT UNSIGNED NOT NULL,
			author VARCHAR(50) NOT NULL,
			message VARCHAR(500) NOT NULL,
			status TINYINT NOT NULL,
			time INT UNSIGNED NOT NULL,
			PRIMARY KEY(id)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_message_day</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_email_list
	$table = <<<SQL
		CREATE TABLE th_email_list(
			id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			email VARCHAR(100) NOT NULL,
			registration TINYINT NOT NULL,
			status TINYINT NOT NULL,
			time INT UNSIGNED NOT NULL,
			PRIMARY KEY(id),
			UNIQUE(email)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_email_list</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_contact
	$table = <<<SQL
		CREATE TABLE th_contact(
			id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			name VARCHAR(30) NOT NULL,
			email VARCHAR(100) NOT NULL,
			subject TINYINT UNSIGNED NOT NULL,
			message VARCHAR(1000) NOT NULL,
			ip BIGINT NOT NULL,
			time INT UNSIGNED NOT NULL,
			PRIMARY KEY(id)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_contact</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post
	$table = <<<SQL
		CREATE TABLE th_post(
			id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
			id_user SMALLINT UNSIGNED NOT NULL,
			type TINYINT NOT NULL,
			title VARCHAR(200) NOT NULL UNIQUE,
			author VARCHAR(30) NOT NULL,
			url VARCHAR(300) NOT NULL UNIQUE,
			status TINYINT NOT NULL,
			content TEXT NOT NULL,
			qtd_comment INT UNSIGNED NOT NULL DEFAULT 0,
			qtd_view INT UNSIGNED NOT NULL DEFAULT 0,
			time INT UNSIGNED NOT NULL,
			PRIMARY KEY(id)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_view
	$table = <<<SQL
		CREATE TABLE th_post_view(
			id_post SMALLINT UNSIGNED NOT NULL,
			session_id CHAR(32) NOT NULL UNIQUE,
			ip INT UNSIGNED NOT NULL UNIQUE,
			qtd SMALLINT UNSIGNED NOT NULL DEFAULT 1,
			PRIMARY KEY(id_post)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_view</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_metatag
	$table = <<<SQL
		CREATE TABLE th_metatag(
			id_post SMALLINT UNSIGNED NOT NULL,
			keywords VARCHAR(200) NOT NULL,
			description VARCHAR(156) NOT NULL,
			PRIMARY KEY(id_post)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_metatag</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_tag
	$table = <<<SQL
		CREATE TABLE th_tag(
			id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
			tag VARCHAR(50) NOT NULL UNIQUE,
			count MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
			PRIMARY KEY(id)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_tag</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_tag
	$table = <<<SQL
		CREATE TABLE th_post_tag(
			id_post SMALLINT UNSIGNED NOT NULL,
			id_tag SMALLINT UNSIGNED NOT NULL,
			PRIMARY KEY(id_post, id_tag)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_tag</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_recommendation
	$table = <<<SQL
		CREATE TABLE th_post_recommendation(
			id_post SMALLINT UNSIGNED NOT NULL,
			id_post_recommendation SMALLINT UNSIGNED NOT NULL,
			PRIMARY KEY(id_post, id_post_recommendation)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_recommendation</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_benefit
	$table = <<<SQL
		CREATE TABLE th_post_benefit(
			id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
			id_post SMALLINT UNSIGNED NOT NULL,
			benefit VARCHAR(200) NOT NULL,
			PRIMARY KEY(id)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_benefit</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_summary
	$table = <<<SQL
		CREATE TABLE th_post_summary(
			id_post SMALLINT UNSIGNED NOT NULL,
			summary VARCHAR(200) NOT NULL,
			PRIMARY KEY(id_post)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_summary</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_conf_book
	$table = <<<SQL
		CREATE TABLE th_post_conf_book(
			id_post SMALLINT UNSIGNED NOT NULL,
			type TINYINT NOT NULL,
			author VARCHAR(50) NOT NULL,
			publishing VARCHAR(50) NOT NULL,
			year SMALLINT NOT NULL,
			num_pages SMALLINT NOT NULL,
			rating TINYINT NOT NULL,
			PRIMARY KEY(id_post)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_conf_book</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_download
	$table = <<<SQL
		CREATE TABLE th_post_download(
			id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
			id_post SMALLINT UNSIGNED NOT NULL,
			file VARCHAR(100) NOT NULL,
			count SMALLINT UNSIGNED NOT NULL DEFAULT 0,
			PRIMARY KEY(id)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_download</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_url_demo
	$table = <<<SQL
		CREATE TABLE th_post_url_demo(
			id_post SMALLINT UNSIGNED NOT NULL,
			url VARCHAR(200) NOT NULL,
			PRIMARY KEY(id_post)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_url_demo</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	// th_post_comment
	$table = <<<SQL
		CREATE TABLE th_post_comment(
			id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
			id_user SMALLINT UNSIGNED NOT NULL,
			id_post SMALLINT UNSIGNED NOT NULL,
			name VARCHAR(30) NOT NULL,
			email VARCHAR(100) NOT NULL,
			web_site VARCHAR(2000) NOT NULL,
			comment TEXT NOT NULL,
			likeit SMALLINT UNSIGNED NOT NULL DEFAULT 0,
			dislikeit SMALLINT UNSIGNED NOT NULL DEFAULT 0,
			id_comment_parent SMALLINT UNSIGNED NOT NULL,
			status TINYINT NOT NULL,
			ip BIGINT NOT NULL,
			time INT UNSIGNED NOT NULL,
			PRIMARY KEY(id)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_comment</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	
	// th_post_comment_like
	$table = <<<SQL
		CREATE TABLE th_post_comment_like(
			id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			id_comment SMALLINT UNSIGNED NOT NULL,
			session_id CHAR(32) NOT NULL UNIQUE,
			ip INT UNSIGNED NOT NULL UNIQUE,
			likeit TINYINT NOT NULL,
			PRIMARY KEY(id)
		) ENGINE = MyISAM;
SQL;
	$conn->getConn()->query($table);
	echo '<strong>th_post_comment_like</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	
	$conn->getConn()->close();
