<option value="" selected>---District---</option>
<?php
include ("../partials/_db.php");
if (isset ($_POST['country']))
{
    $country = $_POST['country'];
    $optionSql = "SELECT DISTINCT `district` FROM `users` WHERE `state` = '$country' ORDER BY district ASC";
    $result = $conn->query($optionSql);
    while ($row = mysqli_fetch_assoc($result))
    {
        echo '<option value="' . $row['district'] . '">' . $row['district'] . '</option>';
    }
} else
{
    echo "country not selected";
}
?>