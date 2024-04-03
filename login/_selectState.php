<option value="" selected>---State---</option>
<?php
include ("../partials/_db.php");
if (isset($_POST['country']))
{
    $country = $_POST['country'];
    // $optionSql = "SELECT DISTINCT `state` FROM `users` WHERE country = '$country' ORDER BY 'state' ASC";
    $optionSql = "SELECT DISTINCT `state` FROM `users` WHERE country = '$country' ORDER BY state ASC";
    $result = $conn->query($optionSql);
    while ($row = mysqli_fetch_assoc($result))
    {
        if ($row['state'] != "" )
        {
            echo '<option value="' . $row['state'] . '">' . $row['state'] . '</option>';
        }
    }
} else
{
    echo "country not selected";
}
?>