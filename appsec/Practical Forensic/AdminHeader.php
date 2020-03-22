<?php session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Practical Forensics 101</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
   
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
		<nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius: 0px;">
		  <div class="container">
			<div class="navbar-header">
			  <a class="navbar-brand" style="color:white; font-family: serif; font-size: 20px;">Practical Forensics 101</a>
			</div>
			<ul class="nav navbar-nav">
			  <li><a href="AddCase.php">Add Case</a></li>
			  <li><a href="ManageCase.php">Manage Case</a></li>
			  <li><a href="AddQuest.php">Add Question</a></li>
			  <li><a href="ViewUsers.php">View Users</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
			</ul>
		  </div>
		</nav>
