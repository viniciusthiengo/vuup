-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tempo de Geração: Dez 29, 2013 as 10:18 PM
-- Versão do Servidor: 5.0.51
-- Versão do PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Banco de Dados: thiengo
-- 

-- --------------------------------------------------------

create database mibec;
use mibec;

-- 
-- Estrutura da tabela th_contact
-- 

CREATE TABLE mi_contact (
  id mediumint(8) unsigned NOT NULL auto_increment,
  name varchar(30) NOT NULL,
  email varchar(100) NOT NULL,
  subject tinyint(3) unsigned NOT NULL,
  message varchar(1000) NOT NULL,
  ip bigint(20) NOT NULL,
  time int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Extraindo dados da tabela th_contact
-- 

INSERT INTO mi_contact VALUES (1, 'contato 1', 'contato1@gmail.com', 1, 'O viLLopim Classificados foi criado com o objetivo de ser mais um canal de divulgação de produtos, serviços, entre outros. Apenas mais um canal de divulgação? Não! O viLLopim Classificados acredita que um método limpo de busca agrada a todos, os que anúnciam e os que procuram por algo, logo o viLLopim Classificados leva a seus usuários uma interface limpa com a maioria dos filtros junto a caixa de pesquisa do site e, principalmente, o viLLopim Classificados não permite propagandas espalhadas pelos cantos de suas páginas e pelos topos e fundos de suas páginas.', 2130706433, 1383043749);
INSERT INTO mi_contact VALUES (2, 'contato 2', 'contato2@gmail.com', 7, 'O viLLopim Classificados foi criado com o objetivo de ser mais um canal de divulgação de produtos, serviços, entre outros. Apenas mais um canal de divulgação? Não! O viLLopim Classificados acredita que um método limpo de busca agrada a todos, os que anúnciam e os que procuram por algo, logo o viLLopim Classificados leva a seus usuários uma interface limpa com a maioria dos filtros junto a caixa de pesquisa do site e, principalmente, o viLLopim Classificados não permite propagandas espalhadas pelos cantos de suas páginas e pelos topos e fundos de suas páginas.O viLLopim Classificados foi criado com o objetivo de ser mais um canal de divulgação de produtos, serviços, entre outros. Apenas mais um canal de divulgação? Não! O viLLopim Classificados acredita que um método limpo de busca agrada a todos, os que anúnciam e os que procuram por algo, logo o viLLopim Classificados leva a seus usuários uma interface limpa com a maioria dos filtros junto a caixa de pesquisa do site e, principalmente', 2130706433, 1383043763);
INSERT INTO mi_contact VALUES (3, 'contato 3', 'contato3@gmail.com', 3, 'fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg fhdfg sd gsdg sdfg sdg', 2130706433, 1383043780);
INSERT INTO mi_contact VALUES (4, 'contato 4', 'contato4@gmail.com', 4, 'dkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsd', 2130706433, 1383043824);
INSERT INTO mi_contact VALUES (5, 'contato 5', 'contato5@gmail.com', 5, 'dkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsd', 2130706433, 1383043835);
INSERT INTO mi_contact VALUES (6, 'contato 6', 'contato6@gmail.com', 6, 'dkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsd', 2130706433, 1383043844);
INSERT INTO mi_contact VALUES (7, 'contato 7', 'contato7@gmail.com', 8, 'dkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsddkfg sdfg ksjdfkaj fkas dkajfj ksdkjfsdjk fsdf sdfsdf sdfs dfs df sdfsdf sdfssdf sdfsds sdfas dfsa sdf a', 2130706433, 1383043856);
INSERT INTO mi_contact VALUES (8, 'contato 8', 'contato8@gmail.com', 9, 'dfg jgb sdkj sdhf sg6d5f 456sdf4 6gd5f46 gsd46g sd6f54g6sd54f 6gsf6 ds456 gsd64fg dsfgdfg jgb sdkj sdhf sg6d5f 456sdf4 6gd5f46 gsd46g sd6f54g6sd54f 6gsf6 ds456 gsd64fg dsfgdfg jgb sdkj sdhf sg6d5f 456sdf4 6gd5f46 gsd46g sd6f54g6sd54f 6gsf6 ds456 gsd64fg dsfgdfg jgb sdkj sdhf sg6d5f 456sdf4 6gd5f46 gsd46g sd6f54g6sd54f 6gsf6 ds456 gsd64fg dsfg', 2130706433, 1383043873);
INSERT INTO mi_contact VALUES (9, 'contato 9', 'contato9@gmail.com', 5, 'dfg jgb sdkj sdhf sg6d5f 456sdf4 6gd5f46 gsd46g sd6f54g6sd54f 6gsf6 ds456 gsd64fg dsfgdfg jgb sdkj sdhf sg6d5f 456sdf4 6gd5f46 gsd46g sd6f54g6sd54f 6gsf6 ds456 gsd64fg dsfgdfg jgb sdkj sdhf sg6d5f 456sdf4 6gd5f46 gsd46g sd6f54g6sd54f 6gsf6 ds456 gsd64fg dsfgdfg jgb sdkj sdhf sg6d5f 456sdf4 6gd5f46 gsd46g sd6f54g6sd54f 6gsf6 ds456 gsd64fg dsfg', 2130706433, 1383043890);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_email
-- 

CREATE TABLE mi_email (
  email varchar(60) NOT NULL,
  count mediumint(8) unsigned NOT NULL,
  status tinyint(4) NOT NULL,
  PRIMARY KEY  (email)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_email
-- 

INSERT INTO mi_email VALUES ('peffans.1@peffans.com', 2, 1);
INSERT INTO mi_email VALUES ('peffans.2@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.3@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.4@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.5@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.6@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.7@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.8@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.9@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.10@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.11@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.12@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.13@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.14@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.15@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.16@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.17@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.18@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.19@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.20@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.21@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.22@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.23@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.24@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.25@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.26@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.27@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.28@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.29@peffans.com', 1, 1);
INSERT INTO mi_email VALUES ('peffans.30@peffans.com', 1, 1);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_email_list
-- 

CREATE TABLE mi_email_list (
  id mediumint(8) unsigned NOT NULL auto_increment,
  email varchar(100) NOT NULL,
  hash char(40) NOT NULL,
  registration tinyint(4) NOT NULL,
  status tinyint(4) NOT NULL,
  open tinyint(4) NOT NULL default '0',
  time int(10) unsigned NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY email (email),
  UNIQUE KEY hash (hash)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Extraindo dados da tabela th_email_list
-- 

INSERT INTO mi_email_list VALUES (7, 'viniciusthiengo@gmail.com', 'e9461157eca9ef472dbbaabbeccddacd0711a73f', 0, 2, 1, 1383417169);
INSERT INTO mi_email_list VALUES (14, 'vinicius.aha@hotmail.com', '6125b848f5b07b38b58df7d79bd154d560088152', 0, 0, 0, 1385938108);
INSERT INTO mi_email_list VALUES (13, 'thiengocalopsita@gmail.com', '76a687ec26db2e626b47c2906cac9b7cc8540d31', 0, 3, 0, 1385938031);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_email_sent
-- 

CREATE TABLE mi_email_sent (
  id smallint(5) unsigned NOT NULL auto_increment,
  name varchar(100) NOT NULL,
  subject varchar(30) NOT NULL,
  content text NOT NULL,
  time int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Extraindo dados da tabela th_email_sent
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_email_sent_user
-- 

CREATE TABLE mi_email_sent_user (
  id_email_sent smallint(5) unsigned NOT NULL,
  id_user smallint(5) unsigned NOT NULL,
  status tinyint(4) NOT NULL default '0',
  open tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (id_email_sent,id_user)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_email_sent_user
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_gcm_code
-- 

CREATE TABLE mi_gcm_code (
  code_sha1 char(40) NOT NULL,
  code varchar(500) NOT NULL,
  PRIMARY KEY  (code_sha1)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_gcm_code
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_message_day
-- 

CREATE TABLE mi_message_day (
  id smallint(5) unsigned NOT NULL auto_increment,
  id_user tinyint(3) unsigned NOT NULL,
  author varchar(50) NOT NULL,
  message varchar(500) NOT NULL,
  status tinyint(4) NOT NULL,
  send_gcm_notification tinyint(4) NOT NULL default '0',
  time int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Extraindo dados da tabela th_message_day
-- 

INSERT INTO mi_message_day VALUES (1, 1, 'df asb kjasbfi yuag fasbkf asf asdf asdf as', 'df asb kjasbfi yuag fasbkf asf asdf asdf as', 0, 0, 1382920559);
INSERT INTO mi_message_day VALUES (2, 1, 'Martin Luther King Jr.', 'Se não der para voar, ande. Se não der para andar, rasteje. Mas sempre siga em frente.', 1, 0, 1382921871);
INSERT INTO mi_message_day VALUES (3, 1, 'Joel Baker', 'Visão sem ação não passa de sonho; ação sem visão é só passatempo; visão com ação pode mudar o mundo.', 1, 0, 1383505136);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_partner
-- 

CREATE TABLE mi_partner (
  id smallint(5) unsigned NOT NULL auto_increment,
  name varchar(100) NOT NULL,
  url varchar(100) NOT NULL,
  image varchar(100) NOT NULL,
  status tinyint(4) NOT NULL,
  position tinyint(3) unsigned NOT NULL,
  time int(10) unsigned NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY name (name,url,image)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Extraindo dados da tabela th_partner
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post
-- 

CREATE TABLE mi_post (
  id smallint(5) unsigned NOT NULL auto_increment,
  id_user smallint(5) unsigned NOT NULL,
  type tinyint(4) NOT NULL,
  title varchar(200) NOT NULL,
  author varchar(30) NOT NULL,
  url varchar(300) NOT NULL,
  status tinyint(4) NOT NULL,
  content text NOT NULL,
  qtd_comment int(10) unsigned NOT NULL default '0',
  qtd_comment_facebook smallint(5) unsigned NOT NULL default '0',
  qtd_view int(10) unsigned NOT NULL default '0',
  qtd_like_facebook smallint(5) unsigned NOT NULL default '0',
  qtd_like_twitter smallint(5) unsigned NOT NULL default '0',
  image varchar(200) NOT NULL,
  image_side tinyint(4) NOT NULL,
  image_in_content tinyint(4) NOT NULL,
  image_legend varchar(200) NOT NULL,
  send_gcm_notification tinyint(4) NOT NULL default '0',
  time int(10) unsigned NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY title (title),
  UNIQUE KEY url (url)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Extraindo dados da tabela th_post
-- 

INSERT INTO mi_post VALUES (1, 1, 1, 'Casa dos Artistas f', 'Vinícius Thiengo', 'casa-dos-artistas fs', 1, '<p>1 - Aceita? dos termos e condi?s de uso do viLLopim Classificados:<br /><br />??? O viLLopim Classificados oferece uma variedade de recursos em suas p?nas e esses recursos ser?definidos aqui como "Servi?</p>', 0, 0, 0, 0, 0, 'jquery-ui-book', 1, 0, '', 0, 1382892503);
INSERT INTO mi_post VALUES (4, 1, 4, 'jQuery UI', 'Vinícius Thiengo', 'jquery-ui', 1, '<p>O viLLopim Classificados foi criado com o objetivo de ser mais um canal de divulga? de produtos, servi?, entre outros. Apenas mais um canal de divulga?? N? O viLLopim Classificados acredita que um m?do limpo de busca agrada a todos, os que an?am e os que procuram por algo, logo o viLLopim Classificados leva a seus usu?os uma interface limpa com a maioria dos filtros junto a caixa de pesquisa do site e, principalmente, o viLLopim <strong>Classificados n?permite propagandas espalhadas pelos cantos de suas p&aacute;ginas e pelos topos e fundos de suas p&aacute;nas.</strong><br /><br />O viLLopim Classificados n?est?dotando uma ideologia radical em rela? a propaganda em suas p?nas. N?mesmo! O viLLopim Classificados sabe a import?ia do "marketing" nas p?nas da Web, inclusive em suas p?nas, mas o viLLopim Classificados est?eguindo a linha na qual o "marketing" indireto deve ser mais importante quando se trata de busca por podrutos, servi?, entre outros. Pois o viLLopim Classificados acredita que "muita coisa piscando ou mexendo" na tela do usu?o que est?rocurando por algo n??penas uma propaganda e sim, juntando todas as propagandas piscantes e m?s, parte de um labirinto que pode confundir o usu?o. Por tanto o viLLopim Classificados adota o m?do de estabelecer uma busca agrad?l e r?da aos usu?os que procuram por algo e oferecer an?os em um formato padr?para que os an?antes n?se confundam e nem confundam quem pode, de alguma forma, se interessar pelo o que est?m seu(s) an?o(s).<br /><br />O viLLopim Classificados n?quer denigrir os m?dos utilizados em outros sites de classificados espalhados pela grande rede, mas sim oferecer mais um m?do de an?os na Internet, um m?do ainda pouco explorado quando se falando de an?os na Internet. Se algo informado nas p?nas, inclusive nessa p?na, do viLLopim Classificados de alguma forma ofendeu os seus princ?os ou linhas de pensamento, desde j? viLLopim Classificados deixa claro que esses nunca foram e nunca ser?o seus objetivos, pois o viLLopim Classificados n?? dono da verdade e muito menos o melhor dos "scripters" e dos "marketings", o viLLopim Classificados foi criado com o prop?o de oferecer mais formas de an?os e de buscas por produtos, servi?... Tendo em vista que na Internet h?spa?para todos e tudo. Mas se mesmo assim voc?cha que algo deve ser dito ao viLLopim Classificados, devido a qualquer tipo de conte?expresso em suas p?nas, voc?ode estar acessando, se poss?l, a p?na de Coment?os para assim expressar o seu pensamento sobre o que ?ostrado (imagens, textos, an?os, c?os, etc) nas p?nas do viLLopim Classificados.</p>', 5, 0, 2, 0, 0, 'fbdfbdfbdf.4', 1, 1, 'dfbdfbdfbdfbd', 0, 1382908739);
INSERT INTO mi_post VALUES (6, 1, 1, 'Aprendizado mais aprendizagem', 'Thiengo', 'aprendizado-mais-aprendizagem', 1, '<p>Aprimore sua capacidade de <strong>Avaliar</strong> e de <strong>Desenvolver</strong> <strong>Sistemas Web</strong> e <strong>Android</strong>. Inscreva-se. ??p>', 15, 0, 2, 0, 0, 'amarelo-e-preto', 3, 0, '', 0, 1383051257);
INSERT INTO mi_post VALUES (5, 1, 1, 'Casa dos Artistas', 'Vinícius Thiengo', 'casa-dos-artistas', 1, '<p>dfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd g <br /><br /> dfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd g <br /><br /> dfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd g <br /><br /> dfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd gdfgsdfg sdfg sdfgsdxfd g</p>', 0, 0, 1, 0, 0, 'dfbdfbd.jpeg', 1, 1, 'A Casa dos Artistas Livre', 0, 1382911823);
INSERT INTO mi_post VALUES (7, 1, 2, 'Avaliação Site Victoria Secrets', 'Vinícius Thiengo', 'avaliacao-site-victoria-secrets', 1, '<p><iframe src="http://www.youtube.com/embed/QGVYbgKABb4" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p> <p>&nbsp;</p> <p>O viLLopim Classificados foi criado com o objetivo de ser mais um canal de divulga&ccedil;&atilde;o de produtos, servi&ccedil;os, entre outros. <strong>Apenas mais um canal de divulga&ccedil;&atilde;o?</strong> N&atilde;o! O viLLopim Classificados acredita que um m&eacute;todo limpo de busca agrada a todos, os que an&uacute;nciam e os que procuram por algo, logo o viLLopim Classificados leva a seus usu&aacute;rios uma interface limpa com a maioria dos filtros junto a caixa de pesquisa do site e, principalmente, o viLLopim Classificados n&atilde;o permite propagandas espalhadas pelos cantos de suas p&aacute;ginas e pelos topos e fundos de suas p&aacute;ginas.<br /><br />O viLLopim Classificados n&atilde;o est&aacute; adotando uma ideologia radical em rela&ccedil;&atilde;o a propaganda em suas p&aacute;ginas. N&atilde;o mesmo! O viLLopim Classificados sabe a import&acirc;ncia do "marketing" nas p&aacute;ginas da Web, inclusive em suas p&aacute;ginas, mas o viLLopim Classificados est&aacute; seguindo a linha na qual o "marketing" indireto deve ser mais importante quando se trata de busca por podrutos, servi&ccedil;os, entre outros. Pois o viLLopim Classificados acredita que "muita coisa piscando ou mexendo" na tela do usu&aacute;rio que est&aacute; procurando por algo n&atilde;o &eacute; apenas uma propaganda e sim, juntando todas as propagandas piscantes e m&oacute;veis, parte de um labirinto que pode confundir o usu&aacute;rio. Por tanto o viLLopim Classificados adota o m&eacute;todo de estabelecer uma busca agrad&aacute;vel e r&aacute;pida aos usu&aacute;rios que procuram por algo e oferecer an&uacute;ncios em um formato padr&atilde;o para que os an&uacute;nciantes n&atilde;o se confundam e nem confundam quem pode, de alguma forma, se interessar pelo o que est&aacute; em seu(s) an&uacute;ncio(s).<br /><br />O viLLopim Classificados n&atilde;o quer denigrir os m&eacute;todos utilizados em outros sites de classificados espalhados pela grande rede, mas sim oferecer mais um m&eacute;todo de an&uacute;ncios na Internet, um m&eacute;todo ainda pouco explorado quando se falando de an&uacute;ncios na Internet. Se algo informado nas p&aacute;ginas, inclusive nessa p&aacute;gina, do viLLopim Classificados de alguma forma ofendeu os seus princ&iacute;pios ou linhas de pensamento, desde j&aacute; o viLLopim Classificados deixa claro que esses nunca foram e nunca ser&atilde;o o seus objetivos, pois o viLLopim Classificados n&atilde;o &eacute; o dono da verdade e muito menos o melhor dos "scripters" e dos "marketings", o viLLopim Classificados foi criado com o prop&oacute;sito de oferecer mais formas de an&uacute;ncios e de buscas por produtos, servi&ccedil;os... Tendo em vista que na Internet h&aacute; espa&ccedil;o para todos e tudo. Mas se mesmo assim voc&ecirc; acha que algo deve ser dito ao viLLopim Classificados, devido a qualquer tipo de conte&uacute;do expresso em suas p&aacute;ginas, voc&ecirc; pode estar acessando, se poss&iacute;vel, a p&aacute;gina de <a class="linkPadrao" title="Ir para a p&aacute;gina de coment&aacute;rios." href="http://www.villopim.com.br/contatoComentario/contatoComentario.php">Coment&aacute;rios</a> para assim expressar o seu pensamento sobre o que &eacute; mostrado (imagens, textos, an&uacute;ncios, c&oacute;digos, etc) nas p&aacute;ginas do viLLopim Classificados.</p>', 0, 0, 1, 0, 0, 'victoria-secrets.jpeg', 1, 0, '', 0, 1383052394);
INSERT INTO mi_post VALUES (8, 1, 2, 'Avaliação Site Ignição Digital', 'Vinícius Thiengo', 'avaliacao-site-Ignicao-digital', 1, '<p><iframe src="http://www.youtube.com/embed/QGVYbgKABb4" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe> <br /><br /> O viLLopim Classificados foi criado com o objetivo de ser mais um canal de divulga&ccedil;&atilde;o de produtos, servi&ccedil;os, entre outros. <strong>Apenas mais um canal de divulga&ccedil;&atilde;o?</strong> N&atilde;o! O viLLopim Classificados acredita que um m&eacute;todo limpo de busca agrada a todos, os que an&uacute;nciam e os que procuram por algo, logo o viLLopim Classificados leva a seus usu&aacute;rios uma interface limpa com a maioria dos filtros junto a caixa de pesquisa do site e, principalmente, o viLLopim Classificados n&atilde;o permite propagandas espalhadas pelos cantos de suas p&aacute;ginas e pelos topos e fundos de suas p&aacute;ginas.</p>', 0, 0, 1, 0, 0, 'ignicao-digital.jpeg', 3, 0, '', 0, 1383052565);
INSERT INTO mi_post VALUES (9, 1, 3, 'Instalando o Bundle do Android', 'VAT', 'instalando-o-bundle-do-android', 1, '<p>sdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsd</p>', 0, 0, 1, 0, 0, 'sdfg-sdgf-sdf-gsdg-asf.jpeg', 2, 0, '', 0, 1383158853);
INSERT INTO mi_post VALUES (10, 1, 3, 'Configurando o Bundle do Android', 'VAT', 'configurando-o-bundle-do-android', 1, '<p>sdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsd</p>', 4, 0, 3, 0, 0, 'sdfg-sdgf-sdf-gsdg-asf.jpeg', 2, 0, '', 0, 1383158880);
INSERT INTO mi_post VALUES (11, 1, 4, 'startup de $100', 'Thiengo', 'startup-de-100', 1, '<p>fghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf s</p>', 1, 0, 1, 0, 0, 'sdgsdfsdfsdfs.3', 2, 0, '', 0, 1383159040);
INSERT INTO mi_post VALUES (12, 1, 4, 'A arte da não conformidade', 'Thiengo', 'a-arte-da-nao-conformidade', 1, '<p>fghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf sfghd fghsdgdsf gsdf s</p>', 0, 0, 1, 0, 0, 'a-arte-da-nao-conformidade.3', 2, 1, 'A Arte da Não Conformidade (capa)', 0, 1383159108);
INSERT INTO mi_post VALUES (13, 1, 2, 'Calopsitas', 'Thiengo', 'calopsitas', 1, '<p>sdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfssdg sdg sdgf sdgfs</p>', 1, 0, 2, 0, 0, 'calopsitas.jpeg', 1, 1, 'Matrix', 0, 1383330267);
INSERT INTO mi_post VALUES (14, 1, 3, 'O que é uma Intent', 'Thiengo', 'o-que-e-uma-Intent', 1, '<p>Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes</p>', 0, 0, 1, 0, 0, 'intent.png', 2, 1, 'Intent Class', 0, 1383331122);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_benefit
-- 

CREATE TABLE mi_post_benefit (
  id smallint(5) unsigned NOT NULL auto_increment,
  id_post smallint(5) unsigned NOT NULL,
  benefit varchar(200) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=229 ;

-- 
-- Extraindo dados da tabela th_post_benefit
-- 

INSERT INTO mi_post_benefit VALUES (175, 6, 'Aprender mais');
INSERT INTO mi_post_benefit VALUES (165, 1, 'beneficio 8');
INSERT INTO mi_post_benefit VALUES (164, 1, 'beneficio 7');
INSERT INTO mi_post_benefit VALUES (163, 1, 'beneficio 6');
INSERT INTO mi_post_benefit VALUES (162, 1, 'beneficio 5');
INSERT INTO mi_post_benefit VALUES (161, 1, 'beneficio 4');
INSERT INTO mi_post_benefit VALUES (221, 5, 'beneficio 2');
INSERT INTO mi_post_benefit VALUES (220, 5, 'beneficio 1');
INSERT INTO mi_post_benefit VALUES (158, 1, 'Entedendimento do que verdadeiramente é Desenvolvimento Web');
INSERT INTO mi_post_benefit VALUES (159, 1, 'beneficio 2');
INSERT INTO mi_post_benefit VALUES (160, 1, 'beneficio 3');
INSERT INTO mi_post_benefit VALUES (179, 7, 'Aprendizado sibre avaliação de site');
INSERT INTO mi_post_benefit VALUES (203, 8, 'Aprender a encontrar verdadeiros bugs');
INSERT INTO mi_post_benefit VALUES (202, 8, 'Aprendizado sibre avaliação de site');
INSERT INTO mi_post_benefit VALUES (196, 9, 'sdfg sdgf sdf gsdg asf');
INSERT INTO mi_post_benefit VALUES (197, 9, 'sdfg sdgf sdf gsdg asfasd as das');
INSERT INTO mi_post_benefit VALUES (198, 9, 'sdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asf');
INSERT INTO mi_post_benefit VALUES (199, 10, 'sdfg sdgf sdf gsdg asf');
INSERT INTO mi_post_benefit VALUES (200, 10, 'sdfg sdgf sdf gsdg asfasd as das');
INSERT INTO mi_post_benefit VALUES (201, 10, 'sdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asf');
INSERT INTO mi_post_benefit VALUES (228, 13, 'sdffg sdg sdf saf sadfsdffg sdg sdf saf sadfsdffg sdg sdf saf sadf');
INSERT INTO mi_post_benefit VALUES (227, 13, 'sdffg sdg sdf saf sadfsdffg sdg sdf saf sadf');
INSERT INTO mi_post_benefit VALUES (226, 13, 'sdffg sdg sdf saf sadf');
INSERT INTO mi_post_benefit VALUES (225, 14, 'Desvendar uma das classes mais importantes em dev. Android');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_comment
-- 

CREATE TABLE mi_post_comment (
  id smallint(5) unsigned NOT NULL auto_increment,
  id_user smallint(5) unsigned NOT NULL,
  id_post smallint(5) unsigned NOT NULL,
  name varchar(30) NOT NULL,
  email varchar(100) NOT NULL,
  web_site varchar(2000) NOT NULL,
  comment text NOT NULL,
  image varchar(100) NOT NULL,
  likeit smallint(5) unsigned NOT NULL default '0',
  dislikeit smallint(5) unsigned NOT NULL default '0',
  id_comment_parent smallint(5) unsigned NOT NULL,
  id_comment_answer smallint(8) unsigned NOT NULL default '0',
  status tinyint(4) NOT NULL,
  ip bigint(20) NOT NULL,
  sent_email tinyint(4) NOT NULL default '0',
  time int(10) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- 
-- Extraindo dados da tabela th_post_comment
-- 

INSERT INTO mi_post_comment VALUES (1, 0, 6, 'sdgsbfsd', 'dfjbsvd@gmail.com', 'www.dbfbdfvsdvsdvs.com.br', 'xdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd f', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383176023);
INSERT INTO mi_post_comment VALUES (2, 0, 6, 'sdgsbfsds asdf sdfsad', 'dfjbssdvsdvvd@gmail.com', 'www.dvsdvs.com.br', 'xdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd f', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383176033);
INSERT INTO mi_post_comment VALUES (3, 0, 6, 'sdg sajdfj as ifsa', 'dfgddvvd@gmail.com', 'www.dvsdsdsdvsdvsdvs.com.br', 'xdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd f', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383176065);
INSERT INTO mi_post_comment VALUES (4, 0, 6, 'sdg sajdfj', 'vvd@gmail.com', 'www.vs.com.br', 'xdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fgsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fgsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fgsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fgsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fgsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fgsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fgsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fs gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd f', '', 1, 0, 0, 0, 1, 2130706433, 0, 1383176084);
INSERT INTO mi_post_comment VALUES (5, 0, 6, 'sdg sajdfj sddfsd', 'vvsdvsdd@gmail.com', 'www.vsdvsdvs.com.br', 'xdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s gsd fasd fxdg s g', '', 1, 0, 0, 0, 1, 2130706433, 0, 1383176095);
INSERT INTO mi_post_comment VALUES (6, 0, 6, 'Vinicius Thiengo', 'viniciusthiengo@gmail.com', 'http://www.thiengo.com.br', 'dfj asf sd fasdfasdf asdf sa fda', '', 1, 0, 0, 0, 1, 2130706433, 0, 1383183972);
INSERT INTO mi_post_comment VALUES (7, 0, 6, 'cfghffd', 'dfdfbdfbdfb@gmail.com', 'www.sdgdsbsf.com', 'dfsdf gsdfg sdf gsdfg sdfg dsf', '', 1, 0, 1, 0, 1, 2130706433, 0, 1383239046);
INSERT INTO mi_post_comment VALUES (8, 0, 6, 'João Cosmo', 'jc@gmail.com', 'www.jc.com.br', 'fdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asdfdg sdfg sdgf asdf sadf asd', '', 1, 0, 1, 0, 1, 2130706433, 0, 1383265493);
INSERT INTO mi_post_comment VALUES (9, 0, 11, 'svsdvs sdvs', 'asasc@gmail.com', '', 'fgh sdfh dfg sdfg sdg asfgh sdfh dfg sdfg sdg asfgh sdfh dfg sdfg sdg asfgh sdfh dfg sdfg sdg asfgh sdfh dfg sdfg sdg asfgh sdfh dfg sdfg sdg as', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383267314);
INSERT INTO mi_post_comment VALUES (10, 1, 5, 'Vinícius Thiengo', 'viniciusthiengo@gmail.com', '', 'Apenas um comentário', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383346013);
INSERT INTO mi_post_comment VALUES (11, 1, 6, 'Vinícius Thiengo', 'viniciusthiengo@gmail.com', '', 'Essa é a minha resposta quanto a isso tudo', '', 1, 0, 5, 0, 1, 2130706433, 0, 1383346279);
INSERT INTO mi_post_comment VALUES (12, 1, 6, 'Vinícius Thiengo', 'viniciusthiengo@gmail.com', '', 'Quase concordei com vc...\n\nNote que nem sempre é assim', '', 0, 1, 1, 0, 1, 2130706433, 0, 1383346666);
INSERT INTO mi_post_comment VALUES (13, 0, 6, 'skjf ksajdbfkajsdfas', 'viniciusthiengo@gmail.com', '', 'dfbsdfg sdfg sdfg sd', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383351294);
INSERT INTO mi_post_comment VALUES (14, 0, 6, 'Jason', 'jason@gmail.com', 'www.jason.com.br', 'Jks kjbskbv sbkserkg ad fasdhf kasdbfkjasd jfasfdbaskbfd ksajbdf ksajb dfkbsafd asdfkjasb dfkjsabkdf bskabdf kasbfdkb sadfJks kjbskbv sbkserkg ad fasdhf kasdbfkjasd jfasfdbaskbfd ksajbdf ksajb dfkbsafd asdfkjasb dfkjsabkdf bskabdf kasbfdkb sadfJks kjbskbv sbkserkg ad fasdhf kasdbfkjasd jfasfdbaskbfd ksajbdf ksajb dfkbsafd asdfkjasb dfkjsabkdf bskabdf kasbfdkb sadfJks kjbskbv sbkserkg ad fasdhf kasdbfkjasd jfasfdbaskbfd ksajbdf ksajb dfkbsafd asdfkjasb dfkjsabkdf bskabdf kasbfdkb sadf', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383351615);
INSERT INTO mi_post_comment VALUES (15, 0, 6, 'Ramirez', 'ramirez@hotmail.com', 'www.hotmail.com.br', 'sdf asfakjsfd baskbf dlasgdf kjasfdjklbaskfdj baskljbf djsadkfasbd flsabd fjlbaskjdfbaskf kas dfahs fdhjvasjhdf assdf asfakjsfd baskbf', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383351689);
INSERT INTO mi_post_comment VALUES (16, 0, 6, 'ascascaaa', 'ascasca@gmail.com', '', 'shdga cgascgakjsgcasgc avsc akvcjhavskcvahjvs hcjhasv kjcahvs jcha', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383351772);
INSERT INTO mi_post_comment VALUES (17, 0, 6, 'Ilor', 'ilor@gmail.com', '', 'sv sgasf aksjbf as fasb fasgfjksa kdlfbslkjfd as f', '', 0, 0, 6, 0, 1, 2130706433, 0, 1383352562);
INSERT INTO mi_post_comment VALUES (18, 0, 6, 'Carmem', 'carmem@hotmail.com', '', 'sfjs djfbaskfbasf asbf ksjaf jas fsadf as', '', 0, 0, 6, 0, 1, 2130706433, 0, 1383352608);
INSERT INTO mi_post_comment VALUES (19, 0, 13, 'sdf asdfasdf', 'ascascs@gmail.com', 'dxsdsdfsafs', 'dfg sdfasfasdfsadf', '', 1, 0, 0, 0, 1, 2130706433, 0, 1383431343);
INSERT INTO mi_post_comment VALUES (20, 0, 10, 'dfsfgdsfg', 'sdsdvsdvsd@gmail.com', 'ssdvsdvsd', 'dfjkgsd fbasdjfhba skhfsjdhf jasfh as djfhvasjdkf asjkhvjashvdf kjsvdf jshv sad fasdf', '', 0, 0, 0, 0, 0, 2130706433, 0, 1383432473);
INSERT INTO mi_post_comment VALUES (21, 0, 6, 'dfdfbd', 'dssvdsvsdvs@dfbdfb.com', '', 'dfbdfb', '', 0, 0, 16, 0, 1, 2130706433, 1, 1383437537);
INSERT INTO mi_post_comment VALUES (22, 0, 6, 'dfbsdvsd', 'sdvsdv@gmail.com', '', 'sdvsdvs sdfsadfasfd asdfasdf sadfasfd asdf', '', 0, 0, 16, 0, 1, 2130706433, 0, 1383437639);
INSERT INTO mi_post_comment VALUES (23, 0, 6, 'dfbsdvsdv', 'sdvsdv@gmail.com', '', 'zdbdfbdfsdf sdfasdf asdf asdfa', '', 0, 0, 0, 0, 1, 2130706433, 0, 1383437660);
INSERT INTO mi_post_comment VALUES (24, 0, 10, 'Vinícius Thiengo', 'viniciusthiengo@gmail.com', '', 'mexendo com android', '', 0, 0, 0, 0, 1, 2130706433, 1, 1383442326);
INSERT INTO mi_post_comment VALUES (25, 0, 10, 'Carlitos', 'viniciusthiengo@gmail.com', '', 'resposta sdgsdfasf sf as', '', 0, 0, 24, 0, 1, 2130706433, 1, 1383443712);
INSERT INTO mi_post_comment VALUES (26, 0, 10, 'Julião Almeida', 'viniciusthiengo@gmail.com', '', 'sdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas dsdf asdfas d', '', 0, 0, 24, 0, 1, 2130706433, 1, 1383444340);
INSERT INTO mi_post_comment VALUES (27, 0, 4, 'Vinícius Thiengo', 'viniciusthiengo@gmail.com', '', 'Livro muito bom... super recomendo', '', 0, 1, 0, 0, 1, 2130706433, 1, 1383497228);
INSERT INTO mi_post_comment VALUES (28, 0, 4, 'Vérsailes Almeida', 'viniciusthiengo@gmail.com', '', 'Literalmente comcordo com vc, o livro é mt bom, vale mt a leitura, porém o estilo é orientado a manual e não a projeto.', '', 0, 1, 27, 27, 1, 2130706433, 1, 1383497428);
INSERT INTO mi_post_comment VALUES (29, 0, 4, 'Ok Master', 'viniciusthiengo@gmail.com', '', 'Até concordaria, porém já li alguns mais inteligentes, mas mesmo assim eu sei quem é Maujor, é daqueles que quando passa é para ser respeitado', '', 1, 0, 27, 28, 1, 2130706433, 1, 1383499263);
INSERT INTO mi_post_comment VALUES (30, 0, 4, 'Rodney América', 'vinicius.aha@hotmail.com', '', 'Vamos que vamos, ta é rendendo esse comentário...', '', 0, 0, 27, 29, 1, 2130706433, 1, 1383499367);
INSERT INTO mi_post_comment VALUES (31, 0, 4, 'WS Developer', 'desenvolvimento@wstecnologia.com.br', '', 'é vero, mas tem umas coisas mais interessantes aqui no blog, é só procurar', '', 0, 0, 27, 30, 1, 2130706433, 1, 1383499706);
INSERT INTO mi_post_comment VALUES (32, 0, 4, 'Souza Gonçalves', 'vinicius.aha@hotmail.com', '', 'hgdfha sdhfsvadkfvashj dvfkjshvd jkashv djfhasvd jkfasvdjfkvasdjfasjd fksajhdvfashjd jfksa dkfvasd fvaskdjf askd vfakjsvdfa', '', 0, 0, 0, 0, 0, 2130706433, 0, 1383500084);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_comment_like
-- 

CREATE TABLE mi_post_comment_like (
  id mediumint(8) unsigned NOT NULL auto_increment,
  id_comment smallint(5) unsigned NOT NULL,
  session_id char(32) NOT NULL,
  ip int(10) unsigned NOT NULL,
  likeit tinyint(4) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- Extraindo dados da tabela th_post_comment_like
-- 

INSERT INTO mi_post_comment_like VALUES (3, 6, '28731708019c74c0acb3b29023ace982', 2130706433, 1);
INSERT INTO mi_post_comment_like VALUES (4, 5, '28731708019c74c0acb3b29023ace982', 2130706433, 1);
INSERT INTO mi_post_comment_like VALUES (5, 4, '28731708019c74c0acb3b29023ace982', 2130706433, 1);
INSERT INTO mi_post_comment_like VALUES (6, 8, '28731708019c74c0acb3b29023ace982', 2130706433, 1);
INSERT INTO mi_post_comment_like VALUES (7, 11, '28731708019c74c0acb3b29023ace982', 2130706433, 1);
INSERT INTO mi_post_comment_like VALUES (8, 19, 'dfbdeff34a70b8559e676a01cfcdfb77', 2130706433, 1);
INSERT INTO mi_post_comment_like VALUES (9, 7, '2ed9cba407bf3056b5f7afde25d89a68', 2130706433, 1);
INSERT INTO mi_post_comment_like VALUES (10, 12, '2ed9cba407bf3056b5f7afde25d89a68', 2130706433, 2);
INSERT INTO mi_post_comment_like VALUES (11, 29, '1bdeb8278d52ea1d23dfaf33d5867e17', 2130706433, 1);
INSERT INTO mi_post_comment_like VALUES (12, 28, '1bdeb8278d52ea1d23dfaf33d5867e17', 2130706433, 2);
INSERT INTO mi_post_comment_like VALUES (13, 27, '1bdeb8278d52ea1d23dfaf33d5867e17', 2130706433, 2);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_conf_book
-- 

CREATE TABLE mi_post_conf_book (
  id_post smallint(5) unsigned NOT NULL,
  type tinyint(4) NOT NULL,
  author varchar(50) NOT NULL,
  publishing varchar(50) NOT NULL,
  year smallint(6) NOT NULL,
  edition char(3) NOT NULL,
  num_pages smallint(6) NOT NULL,
  rating tinyint(4) NOT NULL,
  PRIMARY KEY  (id_post)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_post_conf_book
-- 

INSERT INTO mi_post_conf_book VALUES (3, 1, 'Mauricio Maujor', 'Novatec', 2012, '', 700, 3);
INSERT INTO mi_post_conf_book VALUES (4, 1, 'Mauricio Maujor', 'Novatec', 2012, '1ª', 700, 5);
INSERT INTO mi_post_conf_book VALUES (11, 3, 'zsjdhf ksjfsd', 'sdvsdv', 2013, '1ª', 255, 5);
INSERT INTO mi_post_conf_book VALUES (12, 3, 'zsjdhf ksjfsd', 'sdvsdv', 2013, '1ª', 566, 5);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_download
-- 

CREATE TABLE mi_post_download (
  id smallint(5) unsigned NOT NULL auto_increment,
  id_post smallint(5) unsigned NOT NULL,
  file varchar(100) NOT NULL,
  count smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Extraindo dados da tabela th_post_download
-- 

INSERT INTO mi_post_download VALUES (12, 13, '28731708019c74c0acb3b29023ace982a0e93883d3c4cda7b9062bfdf0814886.zip', 0);
INSERT INTO mi_post_download VALUES (9, 4, '46e44250070d652639a7d13abd36818a89945b7871a3e460d269758a1dd4648d.jpg', 0);
INSERT INTO mi_post_download VALUES (11, 5, '46e44250070d652639a7d13abd36818a70298f20b98cd4800d80bd1fa92a3a8a.jpg', 0);
INSERT INTO mi_post_download VALUES (8, 1, '46e44250070d652639a7d13abd36818a1784a62de1998e400ee86d41e9927442.jpg', 0);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_metatag
-- 

CREATE TABLE mi_post_metatag (
  id_post smallint(5) unsigned NOT NULL,
  keywords varchar(200) NOT NULL,
  description varchar(156) NOT NULL,
  PRIMARY KEY  (id_post)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_post_metatag
-- 

INSERT INTO mi_post_metatag VALUES (1, 'desenvolvimento web, aprendendo desenvolvimento web', 'Aprenda a desenvolver para Web');
INSERT INTO mi_post_metatag VALUES (3, 'jQuery UI, jquery', 'Aprenda jQuery UI mais a fundo');
INSERT INTO mi_post_metatag VALUES (4, 'jQuery UI, jquery', 'Aprenda jQuery UI mais a fundo');
INSERT INTO mi_post_metatag VALUES (5, 'devem, mudar, periodicamente', 'Se você acredita que o seu trabalho foi copiado ou reproduzido de qualquer forma que infrinja as leis de direitos autorais e de propriedade, por favor noti.');
INSERT INTO mi_post_metatag VALUES (6, 'casa 22', 'casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22casa 22');
INSERT INTO mi_post_metatag VALUES (7, 'avaliação Site, victoria secrets', 'Avaliação do site da famosa grife de lingerie Victoria Secrets');
INSERT INTO mi_post_metatag VALUES (8, 'avaliação Site, ignição digital', 'Avaliação do site da famosa grife de lingerie Ignição Digital');
INSERT INTO mi_post_metatag VALUES (9, 'asa,asasd,asdasd,asdasd', 'sdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsd');
INSERT INTO mi_post_metatag VALUES (10, 'asa,asasd,asdasd,asdasd', 'sdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsd');
INSERT INTO mi_post_metatag VALUES (11, 'xfbdfb,dfghsdfg,sdfgsdf', 'dfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf d');
INSERT INTO mi_post_metatag VALUES (12, 'xfbdfb,dfghsdfg,sdfgsdf', 'dfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf ddfdfg df dfgd fgdf dfgdf d');
INSERT INTO mi_post_metatag VALUES (13, 'dfgdfg,dgfsdgs,sdgfsdfg,sdffgsd,sdfgds,dfgdsfgs', 'dfg sdgsdfg dgf sdg sdfg sdgsdfg dgf sdg sdfg sdgsdfg dgf sdg sdfg sdgsdfg dgf sdg sdfg sdgsdfg dgf sdg sdfg sdgsdfg dgf sdg sdfg sdgsdfg dgf sdg sdfg sdgsd');
INSERT INTO mi_post_metatag VALUES (14, 'fh, rhsgsf, sdg', 'Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais important');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_recommendation
-- 

CREATE TABLE mi_post_recommendation (
  id_post smallint(5) unsigned NOT NULL,
  id_post_recommendation smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (id_post,id_post_recommendation)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_post_recommendation
-- 

INSERT INTO mi_post_recommendation VALUES (1, 4);
INSERT INTO mi_post_recommendation VALUES (4, 4);
INSERT INTO mi_post_recommendation VALUES (4, 5);
INSERT INTO mi_post_recommendation VALUES (4, 6);
INSERT INTO mi_post_recommendation VALUES (4, 10);
INSERT INTO mi_post_recommendation VALUES (5, 1);
INSERT INTO mi_post_recommendation VALUES (5, 4);
INSERT INTO mi_post_recommendation VALUES (5, 5);
INSERT INTO mi_post_recommendation VALUES (5, 6);
INSERT INTO mi_post_recommendation VALUES (6, 1);
INSERT INTO mi_post_recommendation VALUES (6, 4);
INSERT INTO mi_post_recommendation VALUES (6, 5);
INSERT INTO mi_post_recommendation VALUES (7, 1);
INSERT INTO mi_post_recommendation VALUES (7, 4);
INSERT INTO mi_post_recommendation VALUES (7, 5);
INSERT INTO mi_post_recommendation VALUES (7, 6);
INSERT INTO mi_post_recommendation VALUES (8, 1);
INSERT INTO mi_post_recommendation VALUES (8, 4);
INSERT INTO mi_post_recommendation VALUES (8, 5);
INSERT INTO mi_post_recommendation VALUES (8, 6);
INSERT INTO mi_post_recommendation VALUES (9, 5);
INSERT INTO mi_post_recommendation VALUES (9, 6);
INSERT INTO mi_post_recommendation VALUES (9, 7);
INSERT INTO mi_post_recommendation VALUES (9, 8);
INSERT INTO mi_post_recommendation VALUES (10, 5);
INSERT INTO mi_post_recommendation VALUES (10, 6);
INSERT INTO mi_post_recommendation VALUES (10, 7);
INSERT INTO mi_post_recommendation VALUES (10, 8);
INSERT INTO mi_post_recommendation VALUES (11, 7);
INSERT INTO mi_post_recommendation VALUES (11, 8);
INSERT INTO mi_post_recommendation VALUES (11, 9);
INSERT INTO mi_post_recommendation VALUES (11, 10);
INSERT INTO mi_post_recommendation VALUES (12, 7);
INSERT INTO mi_post_recommendation VALUES (12, 8);
INSERT INTO mi_post_recommendation VALUES (12, 9);
INSERT INTO mi_post_recommendation VALUES (12, 10);
INSERT INTO mi_post_recommendation VALUES (13, 8);
INSERT INTO mi_post_recommendation VALUES (13, 9);
INSERT INTO mi_post_recommendation VALUES (13, 11);
INSERT INTO mi_post_recommendation VALUES (13, 12);
INSERT INTO mi_post_recommendation VALUES (14, 4);
INSERT INTO mi_post_recommendation VALUES (14, 5);
INSERT INTO mi_post_recommendation VALUES (14, 6);
INSERT INTO mi_post_recommendation VALUES (14, 7);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_summary
-- 

CREATE TABLE mi_post_summary (
  id_post smallint(5) unsigned NOT NULL,
  summary varchar(200) NOT NULL,
  PRIMARY KEY  (id_post)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_post_summary
-- 

INSERT INTO mi_post_summary VALUES (1, 'Desvende a verdadeira realidade do desenvolvimento Web');
INSERT INTO mi_post_summary VALUES (5, 'beneficio 1 beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1beneficio 1b');
INSERT INTO mi_post_summary VALUES (6, 'Aprimore sua capacidade de Avaliar e de Desenvolver Sistemas Web e Android. Inscreva-se.');
INSERT INTO mi_post_summary VALUES (7, 'Aprendizado sibre avaliação de siteAprendizado sibre avaliação de siteAprendizado sibre avaliação de site');
INSERT INTO mi_post_summary VALUES (8, 'Aprendizado sibre avaliação de siteAprendizado sibre avaliação de siteAprendizado sibre avaliação de site');
INSERT INTO mi_post_summary VALUES (9, 'sdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsd');
INSERT INTO mi_post_summary VALUES (10, 'sdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsdfg sdgf sdf gsdg asfsd');
INSERT INTO mi_post_summary VALUES (13, 'dgsdg sdg sdg sdgsdg sdg sdg sdgsdg sdg sdg sdgsdg sdg sdg sdgsdg sdg sdg sdgsdg sdg sdg sdgsdg sdg sdg sdgsdg sdg sdg sdgsdg sdg sdg s');
INSERT INTO mi_post_summary VALUES (14, 'Desvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes mais importantes em dev. AndroidDesvendar uma das classes');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_tag
-- 

CREATE TABLE mi_post_tag (
  id_post smallint(5) unsigned NOT NULL,
  id_tag smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (id_post,id_tag)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_post_tag
-- 

INSERT INTO mi_post_tag VALUES (1, 1);
INSERT INTO mi_post_tag VALUES (1, 2);
INSERT INTO mi_post_tag VALUES (3, 3);
INSERT INTO mi_post_tag VALUES (3, 4);
INSERT INTO mi_post_tag VALUES (4, 3);
INSERT INTO mi_post_tag VALUES (4, 4);
INSERT INTO mi_post_tag VALUES (5, 5);
INSERT INTO mi_post_tag VALUES (5, 6);
INSERT INTO mi_post_tag VALUES (6, 8);
INSERT INTO mi_post_tag VALUES (7, 9);
INSERT INTO mi_post_tag VALUES (7, 10);
INSERT INTO mi_post_tag VALUES (8, 9);
INSERT INTO mi_post_tag VALUES (8, 11);
INSERT INTO mi_post_tag VALUES (9, 12);
INSERT INTO mi_post_tag VALUES (9, 13);
INSERT INTO mi_post_tag VALUES (9, 14);
INSERT INTO mi_post_tag VALUES (10, 12);
INSERT INTO mi_post_tag VALUES (10, 13);
INSERT INTO mi_post_tag VALUES (10, 14);
INSERT INTO mi_post_tag VALUES (11, 15);
INSERT INTO mi_post_tag VALUES (11, 16);
INSERT INTO mi_post_tag VALUES (11, 17);
INSERT INTO mi_post_tag VALUES (12, 15);
INSERT INTO mi_post_tag VALUES (12, 16);
INSERT INTO mi_post_tag VALUES (12, 17);
INSERT INTO mi_post_tag VALUES (13, 18);
INSERT INTO mi_post_tag VALUES (13, 19);
INSERT INTO mi_post_tag VALUES (13, 20);
INSERT INTO mi_post_tag VALUES (13, 21);
INSERT INTO mi_post_tag VALUES (13, 22);
INSERT INTO mi_post_tag VALUES (13, 23);
INSERT INTO mi_post_tag VALUES (14, 24);
INSERT INTO mi_post_tag VALUES (14, 25);
INSERT INTO mi_post_tag VALUES (14, 26);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_url_demo
-- 

CREATE TABLE mi_post_url_demo (
  id_post smallint(5) unsigned NOT NULL,
  url varchar(200) NOT NULL,
  PRIMARY KEY  (id_post)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Extraindo dados da tabela th_post_url_demo
-- 

INSERT INTO mi_post_url_demo VALUES (1, 'o-que-e-desenvolvimento-web-demonstracao');
INSERT INTO mi_post_url_demo VALUES (3, '');
INSERT INTO mi_post_url_demo VALUES (4, 'fhsdg dsf');
INSERT INTO mi_post_url_demo VALUES (5, 'Se você acredita que o seu trabalho foi copiado');
INSERT INTO mi_post_url_demo VALUES (6, '');
INSERT INTO mi_post_url_demo VALUES (7, '');
INSERT INTO mi_post_url_demo VALUES (8, '');
INSERT INTO mi_post_url_demo VALUES (9, '');
INSERT INTO mi_post_url_demo VALUES (10, '');
INSERT INTO mi_post_url_demo VALUES (11, '');
INSERT INTO mi_post_url_demo VALUES (12, '');
INSERT INTO mi_post_url_demo VALUES (13, 'http://fontawesome.io/icons/#new');
INSERT INTO mi_post_url_demo VALUES (14, '');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_post_view
-- 

CREATE TABLE mi_post_view (
  id int(10) unsigned NOT NULL auto_increment,
  id_post smallint(5) unsigned NOT NULL,
  session_id char(32) NOT NULL,
  ip int(10) unsigned NOT NULL,
  qtd smallint(5) unsigned NOT NULL default '1',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- Extraindo dados da tabela th_post_view
-- 

INSERT INTO mi_post_view VALUES (1, 11, 'effee56cd4e95f2a4f83822b41c5365a', 2130706433, 26);
INSERT INTO mi_post_view VALUES (2, 6, '28731708019c74c0acb3b29023ace982', 2130706433, 200);
INSERT INTO mi_post_view VALUES (3, 13, '28731708019c74c0acb3b29023ace982', 2130706433, 14);
INSERT INTO mi_post_view VALUES (4, 12, '28731708019c74c0acb3b29023ace982', 2130706433, 4);
INSERT INTO mi_post_view VALUES (5, 5, '28731708019c74c0acb3b29023ace982', 2130706433, 8);
INSERT INTO mi_post_view VALUES (6, 10, 'dfbdeff34a70b8559e676a01cfcdfb77', 2130706433, 18);
INSERT INTO mi_post_view VALUES (7, 4, '2ed9cba407bf3056b5f7afde25d89a68', 2130706433, 15);
INSERT INTO mi_post_view VALUES (8, 14, '2ed9cba407bf3056b5f7afde25d89a68', 2130706433, 1);
INSERT INTO mi_post_view VALUES (9, 9, '2ed9cba407bf3056b5f7afde25d89a68', 2130706433, 2);
INSERT INTO mi_post_view VALUES (10, 8, '2ed9cba407bf3056b5f7afde25d89a68', 2130706433, 1);
INSERT INTO mi_post_view VALUES (11, 7, '2ed9cba407bf3056b5f7afde25d89a68', 2130706433, 1);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_read_book
-- 

CREATE TABLE mi_read_book (
  id smallint(6) NOT NULL auto_increment,
  title varchar(200) NOT NULL,
  type tinyint(4) NOT NULL,
  author varchar(100) NOT NULL,
  publishing varchar(50) NOT NULL,
  year smallint(6) NOT NULL,
  edition char(3) NOT NULL,
  pages smallint(6) NOT NULL,
  image varchar(100) NOT NULL,
  send_gcm_notification tinyint(4) NOT NULL default '0',
  status tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (id),
  UNIQUE KEY title (title)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Extraindo dados da tabela th_read_book
-- 

INSERT INTO mi_read_book VALUES (1, 'O X da Questão', 3, 'Eike Batista', 'Sextante / Gmt', 2011, '1ª', 160, 'o-x-da-questao.jpeg', 0, 1);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_tag
-- 

CREATE TABLE mi_tag (
  id smallint(5) unsigned NOT NULL auto_increment,
  tag varchar(50) NOT NULL,
  count mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  UNIQUE KEY tag (tag)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- 
-- Extraindo dados da tabela th_tag
-- 

INSERT INTO mi_tag VALUES (1, 'desenvolvimento web', 14);
INSERT INTO mi_tag VALUES (2, 'aprendendo desenvolvimento web', 14);
INSERT INTO mi_tag VALUES (3, 'jQuery UI', 14);
INSERT INTO mi_tag VALUES (4, 'jquery', 14);
INSERT INTO mi_tag VALUES (5, 'devem', 18);
INSERT INTO mi_tag VALUES (6, 'mudar', 18);
INSERT INTO mi_tag VALUES (7, 'periodicamente', 6);
INSERT INTO mi_tag VALUES (8, 'casa 22', 5);
INSERT INTO mi_tag VALUES (9, 'avaliação Site', 11);
INSERT INTO mi_tag VALUES (10, 'victoria secrets', 1);
INSERT INTO mi_tag VALUES (11, 'ignição digital', 9);
INSERT INTO mi_tag VALUES (12, 'asa', 1);
INSERT INTO mi_tag VALUES (13, 'asasd', 1);
INSERT INTO mi_tag VALUES (14, 'asdasd', 3);
INSERT INTO mi_tag VALUES (15, 'xfbdfb', 7);
INSERT INTO mi_tag VALUES (16, 'dfghsdfg', 7);
INSERT INTO mi_tag VALUES (17, 'sdfgsdf', 7);
INSERT INTO mi_tag VALUES (18, 'dfgdfg', 1);
INSERT INTO mi_tag VALUES (19, 'dgfsdgs', 1);
INSERT INTO mi_tag VALUES (20, 'sdgfsdfg', 1);
INSERT INTO mi_tag VALUES (21, 'sdffgsd', 1);
INSERT INTO mi_tag VALUES (22, 'sdfgds', 1);
INSERT INTO mi_tag VALUES (23, 'dfgdsfgs', 1);
INSERT INTO mi_tag VALUES (24, 'fh', 0);
INSERT INTO mi_tag VALUES (25, 'rhsgsf', 0);
INSERT INTO mi_tag VALUES (26, 'sdg', 0);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela th_user
-- 

CREATE TABLE mi_user (
  id tinyint(3) unsigned NOT NULL auto_increment,
  name varchar(30) NOT NULL,
  email varchar(100) NOT NULL,
  password char(47) NOT NULL,
  image varchar(50) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY email (email)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Extraindo dados da tabela th_user
-- 

INSERT INTO mi_user VALUES (1, 'Vinícius Thiengo', 'viniciusthiengo@gmail.com', 'effcb26269dfa8a66d3780d67fa335a49a0a69f8f54c6b1', 'img/post/comment/60-60/vinicius-thiengo.jpg');
