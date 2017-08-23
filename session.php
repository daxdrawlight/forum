<?php
session_start();
		if (!isset($_SESSION['signed_in']) || !isset($_SESSION['user_name']))
		{
			//If not isset -> set with dumy value
			$_SESSION['signed_in'] = "";
			$_SESSION['user_name'] = "";
		} 
		if (!isset($_SESSION['user_level']))
		{
			//If not isset -> set with dumy value
			$_SESSION['user_level'] = "";
		} 
?>