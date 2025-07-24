<?php
session_start();
session_unset();
session_destroy();

require_once "../helper/redirect_helper.php";
redirect_with("../index.php");
?>