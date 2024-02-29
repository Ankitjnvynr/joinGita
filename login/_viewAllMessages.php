<?php
include("../partials/_db.php");

$sql = "SELECT * FROM `messages`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo '
            <div class="card">
            <h5 class="card-header d-flex justify-content-between"><span>' . $row['title'] . '</span><i onclick="deleteMsg(this,' . $row['sr'] . ',)" class="fa-solid fa-trash text-danger btn"></i></h5> 
            <div class="card-body">
                    <textarea onkeyup="updateContent(this, ' . ($row['sr']) . ')"  class="form-control" style="height: 100px" placeholder="Type here......">' . urldecode($row['msg']) . '</textarea>
                
            </div>
            </div>
        ';                      
    }
} else {
    echo 'No Messages Found. Add message to see. <span><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#newModal">Add New</button></span>';
}
?>