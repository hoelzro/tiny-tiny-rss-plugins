<?php

/*
	This plugin requires that you are running MySQL/MariaDB 5.6 or better.

	Run the following against your MySQL installation in the database that contains TinyTinyRSS:

	CREATE FULLTEXT INDEX title_content_search ON ttrss_entries (title, content);
*/

class Search_MySQL_FullText extends Plugin {
	function about() {
		return array(1.0,
			"Use MySQL's fulltext indexes for searching",
			"hoelzro",
			true);
	}

	function init($host) {
		$host->add_hook($host::HOOK_SEARCH, $this);
	}

	function hook_search($search) {
		return array("MATCH(ttrss_entries.title, ttrss_entries.content) AGAINST('".
			db_escape_string(mb_strtolower($search))."')", array());
	}

	function api_version() {
		return 2;
	}
}
?>
