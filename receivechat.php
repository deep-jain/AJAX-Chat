<?php
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT * FROM chat";
$result = mysqli_query($con, $query);


$theName = $_GET['name'];

while ($rows = mysqli_fetch_assoc($result)) {
    if ($theName ==  $rows['username']) {
        echo $theName . 'say' . $rows['message'];
    }
}
?>
