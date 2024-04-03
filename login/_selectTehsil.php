<option value="" selected>---Tehsil---</option>
<?php
include ("../partials/_db.php");
if (isset($_POST['country']))
{
    $country = $_POST['country'];
    $optionSql = "SELECT DISTINCT `tehsil` FROM `users` WHERE `district` = '$country' ORDER BY tehsil ASC";
    $result = $conn->query($optionSql);
    while ($row = mysqli_fetch_assoc($result))
    {
        if ($row['tehsil'] != "")
        {
            echo '<option value="' . $row['tehsil'] . '">' . $row['tehsil'] . '</option>';
        }
    }
} else
{
    echo "country not selected";
}
?>