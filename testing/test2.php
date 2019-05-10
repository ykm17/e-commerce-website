<?php
// Include pagination library file
include_once 'phpfiles/Pagination.php';

// Include database configuration file
require_once 'phpfiles/init.php';

// Set some useful configuration
$baseURL = 'http://localhost/website0/test2.php';
$limit = 5;

// Paging limit & offset
$offset = !empty($_GET['page'])?(($_GET['page']-1)*$limit):0;

// Count of all records
$query   = $conn->query("SELECT COUNT(*) as rowNum FROM product_details");
$result  = $query->fetch_assoc();
$rowCount= $result['rowNum'];

// Initialize pagination class
$pagConfig = array(
    'baseURL' => $baseURL,
    'totalRows'=>$rowCount,
    'perPage'=>$limit
);
$pagination =  new Pagination($pagConfig);

// Fetch records based on the offset and limit
$query = $conn->query("SELECT * FROM product_details ORDER BY pid DESC LIMIT $offset,$limit");

if($query->num_rows > 0){
?>
    <!-- Display posts list -->
    <div class="post-list">
    <?php while($row = $query->fetch_assoc()){ ?>
        <div class="list-item">
            <a href="javascript:void(0);"><?php echo $row["name"]; ?></a>
        </div>
    <?php } ?>
    </div>
    
    <!-- Display pagination links -->
    <?php echo $pagination->createLinks(); ?>
<?php } ?>