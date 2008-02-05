<?php

    define('WARAQ_ROOT', '../..');
    require_once WARAQ_ROOT .'/'. 'ini.php';

	require "code.php";

	$dbFile = $bazdig->get("/bazdig.db");
	$console = $bazdig->get("/console");
	SqlCode::set_db("sqlite:". $dbFile->get_file());

	if ($_GET['q']) {
		$queries = SqlCode::search($_GET['q']);
	} else {
		$queries = SqlCode::select('order by date desc limit 10');	
	}
?>
<title>bazdig history</title>
<link rel="stylesheet" type="text/css" href="../bazdig.css" />
<div id="nav"><a href="../console/" accesskey="c" title="(c)" class="button">console</a><a href="../bazdig.db" accesskey="s" title="(s)" class="button">save</a></div>
<div id="history">
<form method="get" action=".">
<input type="text" name="q" value="<?php echo $_GET['q'] ?>"/><input type="submit" />
</form>
<div id="queries">
<?php
	foreach ($queries as $q) {
		echo '<a href="'. $console->get_url() .'?q='. rawurlencode($q->code) .'" ><pre>'. $q->code .'</pre></a>';
	}
?>
</div>
</div>
