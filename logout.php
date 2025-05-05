<?php
	// abre sess�o
	session_start();
	session_destroy();
	header("Location: index.html");
?>