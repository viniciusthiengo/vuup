<?php
	// Create.index.php
	include('Database.class.php');
	
	$conn = new Database();
	
	
	// PF_INDEX_SUMMARY_QUESTION
	$pf_index_summary_question = <<<SQL
		ALTER TABLE
			pf_question
			ADD FULLTEXT
				pf_index_summary_question(summary)
SQL;
	$conn->getConn()->query($pf_index_summary_question);
	echo '<strong>pf_index_summary_question</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	
	// PF_INDEX_SUMMARY_DESCRIPTION_QUESTION
	$pf_index_summary_description_question = <<<SQL
		ALTER TABLE
			pf_question
			ADD FULLTEXT
				pf_index_summary_description_question(summary, descrition)
SQL;
	$conn->getConn()->query($pf_index_summary_description_question);
	echo '<strong>pf_index_summary_description_question</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	
	// PF_INDEX_MESSAGE_MESSAGE
	$pf_index_message_message = <<<SQL
		ALTER TABLE
			pf_message
			ADD FULLTEXT
				pf_index_message_message(message)
SQL;
	$conn->getConn()->query($pf_index_message_message);
	echo '<strong>pf_index_message_message</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	
	// PF_INDEX_KEYWORD_IMAGE
	$pf_index_keyword_image = <<<SQL
		ALTER TABLE
			pf_image
			ADD FULLTEXT
				pf_index_keyword_image(keyword)
SQL;
	$conn->getConn()->query($pf_index_keyword_image);
	echo '<strong>pf_index_keyword_image</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	
	// PF_INDEX_TITLE_POSSIBLE_TOPIC
	$pf_index_title_possible_topic = <<<SQL
		ALTER TABLE
			pf_possible_topic
			ADD FULLTEXT
				pf_index_title_possible_topic(title)
SQL;
	$conn->getConn()->query($pf_index_title_possible_topic);
	echo '<strong>pf_index_title_possible_topic</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	
	// PF_INDEX_AUTHOR_POSSIBLE_TOPIC
	$pf_index_author_possible_topic = <<<SQL
		ALTER TABLE
			pf_possible_topic
			ADD FULLTEXT
				pf_index_author_possible_topic(author)
SQL;
	$conn->getConn()->query($pf_index_author_possible_topic);
	echo '<strong>pf_index_author_possible_topic</strong>: '.($conn->getConn()->affected_rows + 1).'<br />';
	
	
	$conn->getConn()->close();
