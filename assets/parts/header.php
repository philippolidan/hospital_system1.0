<?php
include('assets/includes/db_connect.php'); 

?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Hospital</title>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/color.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="assets/css/smart_wizard.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/smart_wizard_theme_arrows.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/smart_wizard_theme_circles.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/smart_wizard_theme_dots.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/jasny-bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<style>
	@import url('https://fonts.googleapis.com/css?family=Raleway');
	@import url('https://fonts.googleapis.com/css?family=Poppins');

	h1, h2, h3, h4, h5, h6{
		font-family: 'Poppins'
	}

	body{
		font-family: 'Raleway';
		font-size: 13px;
	}

	.slider {
		-webkit-appearance: none;
		width: 100%;
		height: 25px;
		background: #d3d3d3;
		outline: none;
		opacity: 0.7;
		-webkit-transition: .2s;
		transition: opacity .2s;
	}

	.slider:hover {
		opacity: 1;
	}

	.slider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 25px;
		height: 25px;
		background: #4CAF50;
		cursor: pointer;
	}

	.slider::-moz-range-thumb {
		width: 25px;
		height: 25px;
		background: #4CAF50;
		cursor: pointer;
	}

	.sw-toolbar-bottom{
		display: none;
	}

	.billing-patient-details{
		margin-bottom: 0;
	}

	p{
		margin-bottom: 0.5rem;
	}

	.autocomplete {
		/*the container must be positioned relative:*/
		position: relative;
		display: inline-block;
	}

	input {
		border: 1px solid transparent;
		padding: 10px;
		font-size: 16px;
	}
	input[type=text] {
		width: 100%;
	}
	input[type=submit] {
		background-color: DodgerBlue;
		color: #fff;
	}
	.autocomplete-items {
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;
		border-top: none;
		z-index: 99;
		/*position the autocomplete items to be the same width as the container:*/
		top: 100%;
		left: 0;
		right: 0;
	}
	.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #fff; 
		border-bottom: 1px solid #d4d4d4; 
	}
	.autocomplete-items div:hover {
		/*when hovering an item:*/
		background-color: #e9e9e9; 
	}
	.autocomplete-active {
		/*when navigating through the items using the arrow keys:*/
		background-color: DodgerBlue !important; 
		color: #ffffff; 
	}
	
</style>
</head>

<body>