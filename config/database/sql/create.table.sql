

CREATE TABLE vu_user (
	id int unsigned NOT NULL auto_increment,
	url_sufix varchar(50) UNIQUE NOT NULL,
	name varchar(25) NOT NULL,
	email varchar(100) UNIQUE NOT NULL,
	image varchar(100) NOT NULL,
	password varchar(47) UNIQUE NOT NULL,
	status tinyint NOT NULL DEFAULT 2,
	id_facebook varchar(100) NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_user_bank (
	id int unsigned NOT NULL auto_increment,
	id_user int unsigned NOT NULL,
	type_account tinyint NOT NULL,
	bank tinyint NOT NULL,
	agency varchar(50) NOT NULL,
	number varchar(50) NOT NULL,
	digite varchar(10) NOT NULL,
	operation varchar(10) NOT NULL,
	document varchar(100) NOT NULL,
	status tinyint NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_user_address (
	id_user int unsigned NOT NULL,
	cep varchar(10) NOT NULL,
	street varchar(30) NOT NULL,
	city varchar(30) NOT NULL,
	state tinyint NOT NULL,
	number varchar(10) NOT NULL,
	PRIMARY KEY (id_user)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event (
	id int unsigned NOT NULL auto_increment,
	name varchar(25) NOT NULL,
	status tinyint NOT NULL,
	category tinyint NOT NULL,
	phone_code char(2) NOT NULL,
	phone_number varchar(20) NOT NULL,
	description text(10000) NOT NULL,
	ticket_type tinyint NOT NULL,
	ticket_send_email tinyint NOT NULL,
	ticket_maximum mediumint NOT NULL,
	ticket_parcells tinyint NOT NULL,
	banner_main varchar(100) NOT NULL,
	banner_background varchar(100) NOT NULL,
	promoter_status tinyint NOT NULL DEFAULT 0,
	promoter_percentage tinyint NOT NULL DEFAULT 0,
	video varchar(500) NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event_address (
	id_event int unsigned NOT NULL,
	street varchar(30) NOT NULL,
	neighborhood varchar(30) NOT NULL,
	city varchar(30) NOT NULL,
	state tinyint NOT NULL,
	number varchar(10) NOT NULL,
	latitude varchar(30) NOT NULL,
	longitude varchar(30) NOT NULL,
	PRIMARY KEY (id_event)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event_ticket_day (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	time_day int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event_ticket (
	id int unsigned NOT NULL auto_increment,
	id_ticket_day int unsigned NOT NULL,
	name varchar(15) NOT NULL,
	maximum mediumint NOT NULL,
	price DECIMAL(7,2) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event_photo (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	photo varchar(100) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event_tag (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	tag varchar(50) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_contact_message (
	id int unsigned NOT NULL auto_increment,
	id_user_to int unsigned NOT NULL,
	id_user_from int unsigned NOT NULL,
	name_user_from varchar(25) NOT NULL,
	email_user_from varchar(100) NOT NULL,
	message text(5000) NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event_view (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	id_user int unsigned NOT NULL,
	ip bigint(20) NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event_favorite (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	id_user int unsigned NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_user_follow (
	id int unsigned NOT NULL auto_increment,
	id_user_followed int unsigned NOT NULL,
	id_user_following int unsigned NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE vu_payment (
	id int unsigned NOT NULL auto_increment,
	id_user int unsigned NOT NULL,
	id_event int unsigned NOT NULL,
	id_user_following int unsigned NOT NULL,
	full_price DECIMAL(10,2) NOT NULL,
	status tinyint NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_payment (
	id int unsigned NOT NULL auto_increment,
	id_user int unsigned NOT NULL,
	id_event int unsigned NOT NULL,
	id_user_following int unsigned NOT NULL,
	full_price DECIMAL(10,2) NOT NULL,
	status tinyint NOT NULL,
	time int(10) unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_payment_ticket_day (
	id int unsigned NOT NULL auto_increment,
	id_payment int unsigned NOT NULL,
	id_ticket_day int unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_payment_ticket (
	id int unsigned NOT NULL auto_increment,
	id_payment_ticket_day int unsigned NOT NULL,
	id_ticket int unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_payment_iugu (
	id_payment int unsigned NOT NULL,
	success tinyint NOT NULL,
	message varchar(1000) NOT NULL,
	invoice_id varchar(100) NOT NULL,
	url varchar(1000) NOT NULL,
	pdf varchar(1000) NOT NULL,
	token varchar(1000) NOT NULL,
	PRIMARY KEY (id_payment)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

/*
CREATE TABLE vu_event_report_ticket_sold (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	amount smallint unsigned NOT NULL,
	time int unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;*/
CREATE TABLE vu_event_report_comments (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	amount smallint unsigned NOT NULL,
	year smallint NOT NULL,
	month tinyint NOT NULL,
	day tinyint NOT NULL,
	time int unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE vu_event_report_views (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	amount smallint unsigned NOT NULL,
	year smallint NOT NULL,
	month tinyint NOT NULL,
	day tinyint NOT NULL,
	time int unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE vu_event_report_favorites (
	id int unsigned NOT NULL auto_increment,
	id_event int unsigned NOT NULL,
	amount smallint unsigned NOT NULL,
	year smallint NOT NULL,
	month tinyint NOT NULL,
	day tinyint NOT NULL,
	time int unsigned NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_event_report_data (
	id_event int unsigned NOT NULL,
	type tinyint NOT NULL,
	amount smallint unsigned NOT NULL default 1,
	time int unsigned NOT NULL,
	PRIMARY KEY (id_event,type,time)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE vu_event_report_ticket (
	id_event int unsigned NOT NULL,
	id_ticket_day int unsigned NOT NULL,
	id_ticket int unsigned NOT NULL,
	amount smallint unsigned NOT NULL default 1,
	time int unsigned NOT NULL,
	PRIMARY KEY (id_event,id_ticket_day,id_ticket,time)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE vu_forgot_password (
	id int unsigned NOT NULL auto_increment,
	id_user int unsigned NOT NULL,
	hash varchar(40) NOT NULL,
	status tinyint NOT NULL default 1,
	time int unsigned NOT NULL,
	PRIMARY KEY (id_event,id_ticket_day,id_ticket,time)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
