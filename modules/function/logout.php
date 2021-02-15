<?php
	define(root, $_SERVER["DOCUMENT_ROOT"]);
	require_once root."/modules/sessions.php";
	$_SESSION["user_id"] = null;
	$_SESSION["user_login"] = null;
?>