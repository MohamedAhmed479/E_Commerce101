<?php

session_abort();
session_start();

$conn = mysqli_connect("localhost", "root", "", "e_commerce");