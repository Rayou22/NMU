<?php
echo "<link rel='stylesheet' href='css/bootstrap.css'>";
$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli("localhost", "root", "", "nmureport");
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
}
else {
    $stmt = $conn->prepare("select * from registration where username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();

        if ($data['password'] === $password) {
            //echo "<h2>Login Successfully</h2>";
            //echo "<h1>សូមស្វាគមន៌​មកកាន់សាកលវិទ្យាល័យជាតិមានជ័យ</h1>";
            $myfile = fopen("NMU/NMU.html", "r") or die("Unable to open file!");
            echo fread($myfile, filesize("NMU/NMU.html"));
            fclose($myfile);
        }

        else {
            echo "<div class='alert alert-danger' role='alert'>
        Invalid password!
      </div>";
        }
    }

    else {
        echo "<div class='alert alert-danger' role='alert'>
        Invalid username and password!
      </div>";
    }

}
?>