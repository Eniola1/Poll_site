<?php

session_start();

$_SESSION['user_id'] = 54;

$con = mysqli_connect("localhost", "root", "", "poll");

$db = new PDO('mysql:host=localhost; dbname=poll', 'root', '');