<?php
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT * FROM chat";
$result = mysqli_query($con, $query);

$cred = "SELECT * FROM userNames";
$credChat = mysqli_query($con, $cred);

$theName = $_GET['name'];
$thePass = $_GET['pass'];
$theMessage = $_GET['message'];
$test = false;

while ($rows = mysqli_fetch_assoc($credChat)) {
    if ($theName ==  $rows['user']) {
        while ($row = mysqli_fetch_assoc($credChat)) {
            if ($thePass ==  $row['password']) {
                $sql = "INSERT INTO 'dj239'.'chat' (username, message)
                VALUES ($theName, $theMessage)";

                mysqli_query($con, $sql);
                $test = true;
                }
            }
         }
    }

if ($test == FALSE) {
    echo "Data was not sent, check login details";
}
?>
