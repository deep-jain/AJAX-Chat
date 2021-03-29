<?php
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT * FROM userNames";
$result = mysqli_query($con, $query);

$queryChat = "SELECT * FROM chat";
$resultChat = mysqli_query($con, $queryChat);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
    <h1>Chat Application</h1>
    <hr>
    <h3>Available Users:</h3>
    <?php
    while ($rows = mysqli_fetch_assoc($result)) {
    ?>
        <p style="text-align: center;"><?php echo $rows['user']; ?></p>
    <?php
    }
    ?>
    <hr>
    <h3>Send Chat:</h3>
    <div class="inputInfo">
        <form>
            <label>User Name/Password:</label>
            <input type="text" id="user" name="user" placeholder="User Name">
            <input type="password" id="password" name="password" placeholder="Password">
        </form>
    </div>
    <div class="chatbox">
        <h4>Content Transmitted as Typed:</h4>
        <form action="" method="POST">
            <textarea class="txtarea" id="message" name="message" rows="15" cols="75"></textarea><br></br>
            <textarea id="warning" name="warning" rows="3" cols="75" readonly></textarea>
        </form>
    </div>
    <hr>
    <h3>Listen to Chat:</h3>
    <div class="inputInfo">
        <form>
            <label>Enter Valid Name:</label>
            <input type="text" id="seeName" name="seeName" placeholder="Name"><br></br>
            <textarea class="txtarea" id="feedback" name="feedback" rows="3" cols="75" readonly></textarea><br></br>
        </form>
    </div>
    <hr>

    <script>
        document.getElementById('senttext').addEventListener('keyup', chat1);
        document.getElementById('setForm').addEventListener('keyup', name);

        function chat1(e) {
            e.preventDefault();
            var name = document.getElementById('user').value;
            var pass = document.getElementById('password').value;
            var text = document.getElementById('message').value;
            var dataRequest = new XMLHttpRequest();
            dataRequest.open("GET", "sendChat.php?name=" + name + "&pass=" + pass + "&text=" + text, true);

            dataRequest.onload = function() {
                console.log(this.responseText);
                document.getElementById('warning').value = this.responseText;
            }
            dataRequest.send();
        }

        function name(e) {
            setInterval(function() {
                e.preventDefault();
                var name = document.getElementById('seeName').value;
                var dataRequest = new XMLHttpRequest();

                send.open("GET", "receivechat.php?name=" + name, true);

                dataRequest.onload = function() {
                    console.log(this.responseText);
                    document.getElementById("feedback").value = this.responseText;
                }
                dataRequest.send();
            }, 1000);
        }
    </script>
</body>

</html>
