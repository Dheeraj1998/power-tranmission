<?php

//Login details
$servername = "mysql4.gear.host";
$username = "station1";
$password = "Rs21_nW6R?13";

if(isset($_GET['check_server'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
//    $sql = "CREATE TABLE Substation1 (ID VARCHAR(10), Users VARCHAR(5), TimeOff DATETIME, TimeOn DATETIME, DownTime TIME, PowerUsage VARCHAR(4))";
//    $sql = "CREATE TABLE Substation2 (ID VARCHAR(10), Users VARCHAR(5), TimeOff DATETIME, TimeOn DATETIME, DownTime TIME, PowerUsage VARCHAR(4))";
//    $sql = "DROP TABLE Substation1";
//    $sql = "DROP TABLE Substation2";
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
    
    $sql = "DELETE FROM Substation1";
    $conn->query($sql);
    
    $sql = "DELETE FROM Substation2";
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
    
    $sql = "SELECT * FROM Substation1";

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

elseif(isset($_GET['station2']) && isset($_GET['admin'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
    $sql = "SELECT * FROM Substation2";

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
    
    $sql = "INSERT INTO Substation1 (ID, Users, TimeOff, TimeOn, PowerUsage) VALUES ($id, $numbers, NOW() - INTERVAL 30 MINUTE - INTERVAL 12 HOUR, '0000-00-00 00:00:00', $power)";

    if ($conn->query($sql) === TRUE) {
        echo "Data has been added.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

elseif(isset($_GET['insert_off']) && isset($_GET['num_customer']) && isset($_GET['UID']) && isset($_GET['power_use']) && isset($_GET['station2'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
    $id = $_GET['UID'];
    $numbers = $_GET['num_customer'];
    $power = $_GET['power_use'];
    
    $sql = "INSERT INTO Substation2 (ID, Users, TimeOff, TimeOn, PowerUsage) VALUES ($id, $numbers, NOW() - INTERVAL 30 MINUTE - INTERVAL 12 HOUR, '0000-00-00 00:00:00', $power)";

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
    
    $sql = "UPDATE Substation1 SET TimeOn = NOW() - INTERVAL 30 MINUTE - INTERVAL 12 HOUR WHERE TimeOn = '0000-00-00 00:00:00'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Switch on data has been added.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

elseif(isset($_GET['insert_on']) && isset($_GET['station2'])){
    $dbname = "station1";
    $conn = new mysqli("$servername", $username, $password, $dbname);
    
    $sql = "UPDATE Substation2 SET TimeOn = NOW() - INTERVAL 30 MINUTE - INTERVAL 12 HOUR WHERE TimeOn = '0000-00-00 00:00:00'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Switch on data has been added.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>