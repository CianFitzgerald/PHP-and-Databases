<!DOCTYPE html>
<html>
<body>
<!--Header and navigation bar--> 
<div class="nav-foot">
    <h1>Classic Models</h1> 
        <?php include 'navigation.php';?>
</div>


<?php
    // connecting to database
$servername = 'localhost';
$dbname = 'classicmodels';
$username = 'root';
$password = '';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 // sql query    
$sql = "SELECT * 
        FROM offices";
    
    
//error handling
if (!$sql) {
    echo("Error description: " . $mysqli -> error);
    }
//seperater block with text
echo "<div class='subhead'>Office Details</div> ";

$result = mysqli_query($conn, $sql);  
if($result){
//table headers
echo "<table><tr><th>City</th><th>Address</th><th>Phone Number</th><th>Employee Details</th>";
while($row=mysqli_fetch_array($result))
// while loop used to access sql data and retrieve it, displayed in table format with php form used to create an employee details button.
{
echo "<tr><td>".$row['city']."</td><td>".$row['addressLine1'].$row['addressLine2'].$row['state'].$row['country']."</td><td>".$row['phone']."</td><td>"."<form action=".$_SERVER['PHP_SELF']." method='post' >
    <input type='submit' name=\"city\" value='".$row['city']."'></input>"."</td></tr>";

}
echo "</table>"; 
}
//creating a functon with the POST method, used to retrieve the value that the user has chosen      
if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['city'])){  
        $OfficeCity = $_POST['city'];
        office($OfficeCity);
    };
    
 //function to display more information when the form has been submitted 
function office($OfficeCity){
    //connecting to database
    $servername = 'localhost';
    $dbname = 'classicmodels';
    $username = 'root';
    $password = '';
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    //error handling
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //sql query 
    $sql = "SELECT * 
            FROM employees
            INNER JOIN offices
            ON employees.officeCode=offices.officeCode
            WHERE offices.city ='".$OfficeCity."'";
    
    //error handling
    if (!$sql) {
        echo("Error description: " . $mysqli -> error);
        }

    $query = mysqli_query($conn, $sql); 
    echo "<div class='subhead'>Employee Details</div> ";
    //creating table headers
    echo "<table><tr><th>Full name</th><th>Job Title</th><th>Employee Number</th><th>Email Address</th></tr>";
    if($query){
        while($row=mysqli_fetch_array($query)){
    // while loop used to access sql data and retrieve it, displayed in table format
            echo "<tr><td>".$row['firstName'].$row['lastName']."</td><td>".$row['jobTitle']."</td><td>".$row['employeeNumber']."</td><td>".$row['email']."</td></tr>";
}
}
echo "</table>";
}  
?>
</body>
<!--footer -->
<div class="nav-foot"><?php include 'footer.php';?></div>
       
  <!--CSS styling -->  
<style> 
    body{
    height:100%;
    position: relative

    }
    /*header and footer styling*/
    div.nav-foot {
      background-color: lightgoldenrodyellow;
      font-size: 3vw;
      color: black;
      text-align: center;
      font-family: Charcoal, serif;
      padding: 1px;
      border: 2px solid black;  
    }
    /*sub header styling*/
    .subhead{
      background-color: lightblue;
      font-size: 3vw;
      color: black;
      text-align: center;
      font-family: Charcoal, serif;
      padding: 1px;
      border: 2px solid black;         
    }
    /*Table styling*/
    table {
        border-collapse: inherit;
        width: 100%;
    }
    /*top row style of text, font size etc.*/
    th {
        border: 1px solid black;
        text-align: left;
        font-family: Charcoal, serif;
        font-size: 2vw;
        padding: 1px;
    }
    /*table row style of text*/
    td {
        font-size: 1.5vw;
        border: 1px solid black;
        padding: 10px; 
    }
    /*bakground colour of table*/
    tr {
        background-color: aliceblue;
    }   
</style>    
</html>
  
