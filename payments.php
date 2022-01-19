<!DOCTYPE html>
<html>
<!--Header and navigation bar--> 
<body>

<header class="nav-foot">
    <h1>Classic Models</h1> 
        <?php include 'navigation.php';?>
</header>
  
  
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
        FROM payments
        order by STR_TO_DATE(paymentDate, '%Y-%m-%d') DESC 
        LIMIT 20";
    
//error handling
if (!$sql) {
    echo("Error description: " . $mysqli -> error);
    }

$result = mysqli_query($conn, $sql);  
//seperater block with text
echo "<div class='subhead'>Payment Details</div> ";
if($result){
//table headers
echo "<table>
<tr><th>Check Number</th><th>payment Date</th><th>Amount</th><th>Customer Number</th></tr>";
while($row=mysqli_fetch_array($result))
// while loop used to access sql data and retrieve it, displayed in table format with php form used to create an customer details button displaying the custoer number
{
echo "<tr><td>".$row['checkNumber']."</td><td>".$row['paymentDate']."</td><td>".$row['amount']."</td><td>"."<form action=".$_SERVER['PHP_SELF']." method='post' >
    <input type='submit' name=\"payments\" value=".$row['customerNumber'].">"."</td></tr>";

}
echo "</table>";
}
//creating a functon with the POST method, used to retrieve the value that the user has chosen      
if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['payments'])){  
        $customerid = $_POST['payments'];
        customer($customerid);
    };
    
     
 //function to display more information when the form has been submitted    
function customer($customerid){
    //connecting to database    
    $servername = 'localhost';
    $dbname = 'classicmodels';
    $username = 'root';
    $password = '';
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    //sql query 
    $sql = "SELECT * 
            FROM customers
            WHERE customerNumber=".$customerid;
    
    //error handling
    if (!$sql) {
        echo("Error description: " . $mysqli -> error);
        }
    $query = mysqli_query($conn, $sql); 
    //seperater block with text specific to the chosen user
    echo "<div class='subhead'>Customer Number ".$customerid." Details</div> ";
    //creating table headers
    echo "<table><tr><th>Phone Number</th><th>Sales Rep</th><th>credit Limit</th></tr>";
    if($query){
    // while loop used to access sql data and retrieve it, displayed in table format
        while($row=mysqli_fetch_array($query)){

            echo "<tr><td>".$row['phone']."</td><td>".$row['salesRepEmployeeNumber']."</td><td>".$row['creditLimit']."</td></tr>";
        }
        }
    echo "</table>";
    //sql query     
    $sql = "SELECT * 
        FROM payments
        WHERE customerNumber=".$customerid;
    
    //error handling
    if (!$sql) {
        echo("Error description: " . $mysqli -> error);
        }
    $query = mysqli_query($conn, $sql); 
    //seperater block with text specific to the chosen user
    echo "<div class='subhead'>Customer Number ".$customerid." Payment History</div> ";
    //creating table headers
    echo "<table><tr><th>Check Number</th><th>payment Date</th><th>Amount</th></tr>";
    if($query){
        // while loop used to access sql data and retrieve it, displayed in table format
        while($row=mysqli_fetch_array($query)){
            echo "<tr><td>".$row['checkNumber']."</td><td>".$row['paymentDate']."</td><td>".$row['amount']."</td></tr>";
        }
        }
    echo "</table>"; 
    //sql query 
    $sql = "SELECT sum(amount)
            AS amount_sum
            FROM payments
            WHERE customerNumber=".$customerid;
    
    //error handling
    if (!$sql) {
        echo("Error description: " . $mysqli -> error);
        }
    $result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_assoc($result);
    //displaying sum amount of customer transactons
    echo "<div class='total'>Total amount paid by Customer ".$customerid.": €".$row['amount_sum']."<div>";
}
?>
</body>
<!--footer -->
<footer class="nav-foot"><?php include 'footer.php';?></footer>
    
<!--CSS styling -->   
<style> 
    body{
    height:100%;
    position: relative

    }
    /*header and footer styling*/
    .nav-foot {
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
    
    /*Total amount block styling*/
    .total{
      background-color: aliceblue;
      font-size: 2vw;
      color: black;
      text-align: left;
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
  

