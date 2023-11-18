<?php
include("../partials/_db.php");

$sql = "SELECT * FROM `masik_parvas` ORDER BY `dt` DESC ";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo '
                    <div class="grid-item p-2 position-relative">
                        <!-- <input type="disable" value = "' . $row['id'] . '"> -->
                        <button id = '. $row["id"] . '"  type="button" class="btn-close myacisdjfs;l position-absolute" data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Close"></button>
                        <img class="imgs  rounded bg-white m-md-1 my-1" src="../masik_parwas/' . $row['pic'] . '" alt="hello">
                    </div>
                    ';
}


?>
