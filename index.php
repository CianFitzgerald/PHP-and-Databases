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
$description_Query = "Select * FROM productlines";
$result = mysqli_query($conn, $description_Query);
    
if (!$description_Query) {
  echo("Error description: " . $mysqli -> error);
}
    
//seperater block with text
echo "<div class='subhead'>Product Lines</div> ";
if($result){
//table headers
echo "<table><tr><th>Product Line</th><th>Description</th><th>More Details</th></tr>";
    
// while loop used to access sql data and retrieve it, displayed in table format with php form used to create a more details button for each product Line 
while($row=mysqli_fetch_array($result))

{
echo "<tr><td>".$row['productLine']."</td><td>".$row['textDescription']."</td><td>"."<form action=".$_SERVER['PHP_SELF']." method='post' >
    <input type='submit' name=\"productinfo\" value='".$row['productLine']."'>"."</td></tr>";

}
echo "</table>";
}


//creating a functon with the POST method, used to retrieve the value that the user has chosen 
if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['productinfo'])){  
        $productinfo = $_POST['productinfo'];
        productLine($productinfo);
    };
    


    
//function to display more information when the form has been submitted
function productLine($productinfo){
    
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
    echo "<div class='subhead'>".$productinfo." Full Listing</div> ";
    
    //sql query 
    $sql = "SELECT * 
            FROM products 
            WHERE productLine='".$productinfo."'";
    
    //error handling
    if (!$sql) {
        echo("Error description: " . $mysqli -> error);
        }
    
    
    $result = mysqli_query($conn, $sql); 
    if($result){
        
    //creating table headers
    echo "<table>
    <tr><th>Product Code</th><th>Product Name
    </th><th>product Scale</th><th>product Vendor</th><th>product Description
    </th><th>quantity In Stock</th><th>buy Price</th><th>MSRP</th></tr>";
    while($row=mysqli_fetch_array($result))
    {
    // while loop used to access sql data and retrieve it, displayed in table format
    echo "<tr><td>".$row['productCode']."</td><td>".$row['productName']."</td><td>".$row['productScale']."</td><td>".$row['productVendor']."</td><td>".$row['productDescription']."</td><td>".$row['quantityInStock']."</td><td>".$row['buyPrice']."</td><td>".$row['MSRP']."</td></tr>";

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
        text-align: center;
        font-family: Charcoal, serif;;
        font-size: 20px;
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
  



    
