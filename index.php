<?php 
$host = "satuwebapp.database.windows.net";
$user = "satuwebapp";
$pass = "Satu123#";
$db = "satuwebapp";

try {
    $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(Exception $e) {
    echo "Failed: " . $e;
}
if (isset($_POST['submit'])) {
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $created = date("Y-m-d");
        // Insert data
        $sql_insert = "INSERT INTO Users (name, email, username, password, created) 
                    VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $username);
        $stmt->bindValue(4, $password);
        $stmt->bindValue(5, $created);
        $stmt->execute();
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
} else {
    try {
        $sql_select = "SELECT * FROM Users";
        $stmt = $conn->query($sql_select);
        $users = $stmt->fetchAll(); 
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Azure WebApp1</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- css -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
        <link rel="stylesheet" 	href="css/font-awesome.min.css" type="text/css" media="all">
        <!--// css -->
        <!-- font -->
        <link href='//fonts.googleapis.com/css?family=Josefin+Sans:400,100,100italic,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <!-- //font -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.js"></script>

    </head>
    <body>
        <div class="main-w3">
            <h1>Simple WebApp</h1>
            <div class="col-md-12">
                <div class="resp-tabs-container">
                <div class="facts">
                    <div class="contact-form">
                        <form action="" method="post">
                            <div>
                                <input name="name" type="text" placeholder="Full Name" class="textbox">
                            </div>
                            <div>
                                <input name="email" type="text" placeholder="E-mail" class="textbox">
                            </div>
                            <div>
                                <input name="username" type="text" placeholder="Name"  class="textbox">
                            </div>
                            <div>
                                <input name="password" type="password" placeholder="Password" class="textbox">
                            </div>
                            <div>
                                <span><input type="submit" name="submit" value="Submit"></span>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <h1>List Users</h1>
            <div class="col-md-12">
                
                <div class="resp-tabs-container">
                    <div class="facts">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Date Created</th>
                            </tr>
                            <?php if(count($users) > 0): foreach($users as $user): ?>
                            <tr>
                                <td><?php echo $user['name'];?></td>
                                <td><?php echo $user['email'];?></td>
                                <td><?php echo $user['username'];?></td>
                                <td><?php echo $user['created'];?></td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="4">Empty data</td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>

        </div> 
    </body>
</html>