<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pagination</title>
</head>
<body>

<!--
$result = $conn->query($sql);
                    
                        
                    if ($result->num_rows > 0) {
                        // output data of each row
                        $i=1;
                        while($row = $result->fetch_assoc()) {
                    


-->    
    
<?php
// connect to database
require 'phpfiles/init.php';    
// define how many results you want per page
$results_per_page = 10;
// find out the number of results stored in database
$sql='SELECT * FROM product_details';
    
//$result = mysqli_query($con, $sql);
$result = $conn->query($sql);
    
//$number_of_results = mysqli_num_rows($result);
$number_of_results = $result->num_rows;
    
    
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);


// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

    
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
$sql='SELECT * FROM product_details LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  echo $row['pid'] . ' ' . $row['name']. '<br>';
}
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="test.php?page=' . $page . '">' . $page . '</a> ';
}
?>
</body>
</html>
