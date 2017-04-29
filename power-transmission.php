<?php

//Login details
$servername = "mysql4.gear.host";
$username = "station1";
$password = "Rs21_nW6R?13";

if(isset($_GET['check_server'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
    $sql = "CREATE TABLE SubstationData (ID VARCHAR(10), Users VARCHAR(5), TimeOff DATETIME, TimeOn DATETIME, PowerUsage VARCHAR(4))";
    $conn->query($sql);
    
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    echo "Connected successfully.";
    $conn->close();
}

elseif(isset($_GET['delete_values'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
    $sql = "DELETE FROM SubstationData";
    $conn->query($sql);
    
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Deleted successfully.";
    $conn->close();
}

//http://localhost/Practice_Files/power-tranmission/power-transmission.php/?station1&insert_on
elseif(isset($_GET['station1']) && isset($_GET['admin'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
    $sql = "SELECT * FROM SubstationData";

    $result = mysqli_query($conn ,$sql);
    $array = [];
    
    while($row = $result->fetch_assoc()){
        $array[] = $row;
    }
    
    header('Content-Type:Application/json');
    echo json_encode($array);
    mysqli_free_result($result);
    
    $conn->close();
}

//http://localhost/Practice_Files/power-tranmission/power-transmission.php/?station1&insert_off&UID="123123"&power_use="123"&num_customer="11"
elseif(isset($_GET['insert_off']) && isset($_GET['num_customer']) && isset($_GET['UID']) && isset($_GET['power_use']) && isset($_GET['station1'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
    $id = $_GET['UID'];
    $numbers = $_GET['num_customer'];
    $power = $_GET['power_use'];
    
    $sql = "INSERT INTO SubstationData (ID, Users, TimeOff, TimeOn, PowerUsage) VALUES ($id, $numbers, NOW() - INTERVAL 30 MINUTE, '0000-00-00 00:00:00', $power)";

    if ($conn->query($sql) === TRUE) {
        echo "Data has been added.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

//http://localhost/Practice_Files/power-tranmission/power-transmission.php/?station1&insert_on
elseif(isset($_GET['insert_on']) && isset($_GET['station1'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
    $sql = "UPDATE SubstationData SET TimeOn = NOW() - INTERVAL 30 MINUTE WHERE TimeOn = '0000-00-00 00:00:00'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Switch on data has been added.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>