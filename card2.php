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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


<div id="studentIDCard">
    <div class="i-card">
        <div class="i-card-img">
            <img src="<?php echo $profile ?>" alt="img" />
        </div>
        <p class="i-card-name"><?php echo $name ?></p>
        <table class="i-card-table">
            <thead>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $city ?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $phone ?></td>
                </tr>
                <tr>
                    <td>Wing</td>
                    <td>:</td>
                    <td><?php echo $wing ?></td>
                </tr>
                <tr>
                    <td>Designation</td>
                    <td>:</td>
                    <td><?php echo $designation ?></td>
                </tr>
                <tr>
                    <td><?php echo $starCount ?></td>
                    <td>:</td>
                    <td><?php echo $star ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Button to download the ID card image -->
<button id="downloadButton">Download Student ID Card</button>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // Function to convert HTML element to image
    function htmlToImage(element) {
        return new Promise(resolve => {
            html2canvas(element, { scale: 3 }).then(canvas => {
                resolve(canvas.toDataURL('image/png'));
            });
        });
    }

    // Function to trigger download of the image
    function downloadImage(dataUrl) {
        const link = document.createElement('a');
        link.href = dataUrl;
        link.download = 'student_id_card.png';
        link.click();
    }

    // Event listener for download button click
    document.getElementById('downloadButton').addEventListener('click', async () => {
        const studentIDCard = document.getElementById('studentIDCard');
        const dataUrl = await htmlToImage(studentIDCard);
        downloadImage(dataUrl);
    });

</script>