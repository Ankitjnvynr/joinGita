<option value="" selected>---District---</option>
<?php
require ("../partials/_db.php");
if (isset($_GET['country']))
{
    $country = $_GET['country'];
    $optionSql = "SELECT DISTINCT `district` FROM `allselect` WHERE state = '$country' ORDER BY state ASC";
    $result = $conn->query($optionSql);
    while ($row = mysqli_fetch_assoc($result))
    {
        if ($row['district'] != "")
        {
            echo '<option value="' . $row['district'] . '">' . $row['district'] . '</option>';
        }
    }
} else
{
    echo "country not selected";
}
?>