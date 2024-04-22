<?php
include ("partials/_db.php");
if (!isset($_GET['member']))
{
    // header('location:view-profile.php');
    exit;
}
$memberId = false;
$memberId = $_GET['member'];
$sql = "SELECT * FROM `users` WHERE `hash_id` = '$memberId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (!$row)
{
    echo "not";
    // header("location:view-profile.php?pnot=true");
}

$profile = 'imgs/' . $row['pic'];
$name = $row['name'];
$city = $row['tehsil'];
$phone = $row['phone'];
$wing = $row['interest'];
$designation = $row['designation'];
$star = $row['star'] !== null ? $row['star'] : false;
$starCount = "⭐";
if ($star == 'null')
{
    $star = "";
} else
{
    if ($star == "Trustee")
    {
        $starCount = "⭐";
    } elseif ($star == "Patern Trustee")
    {
        $starCount = "⭐⭐";
    } elseif ($star == "Corporate Trustee")
    {
        $starCount = "⭐⭐⭐";
    }
}



?>

<link rel="stylesheet" href="css/icard.css">

<div id="studentIDCard">
    <div class="i-card">
        <div class="i-card-img">
            <img src="<?php echo $profile ?>" alt="img" />
        </div>

    </div>
</div>
