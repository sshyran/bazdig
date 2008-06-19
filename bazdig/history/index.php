<?php

    define('WARAQ_ROOT', '../..');
    require_once WARAQ_ROOT .'/'. 'ini.php';

	require "code.php";

	$dbFile = $bazdig->getparam("db")->file;
	$console = $bazdig->get("/console");
	try {
		SqlCode::set_db("sqlite:". $dbFile);
	} catch (Exception $e) {
		$error = "<b>DATABASE ERROR</b> check you have PDO_SQLITE <sub>(". $e->getMessage() .")</sub>";
		die("<div style='background-color: yellow; border: 2px solid red; padding: 10px; margin: 10px;'>$error</div>");
	}

	if ($_GET['q']) {
		$queries = SqlCode::search($_GET['q']);
	} else {
		$queries = SqlCode::select('order by date desc limit 10');	
	}
?>
<title>bazdig history</title>
<link rel="stylesheet" type="text/css" href="../codepress/languages/sql.css" />
<link rel="stylesheet" type="text/css" href="../bazdig.css" />
<div id="nav"><a href="../console/" accesskey="c" title="(c)" class="button">console</a><a href="../bazdig.db" accesskey="s" title="(s)" class="button">save</a>
<form id="search" method="get" action=".">
<input type="text" name="q" value="<?php echo $_GET['q'] ?>"/><input type="submit" value="Search" />
</form>
</div>
<div id="history">
<div id="queries">
<?php
	foreach ($queries as $q) {
		echo '<pre onclick="document.location.href=\''. $console->get_url() .'?q='. rawurlencode($q->code) .'\'" >'. $q->toHTML().'</pre>';
	}
?>
</div>
</div>
