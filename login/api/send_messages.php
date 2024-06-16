<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
include ("../../partials/_db.php");
include ('_api_config.php');

$currentURL = "http://$_SERVER[HTTP_HOST]/";
// filtering data
if (isset($_POST['get-data']))
{
    $sql = "SELECT * FROM `users` ORDER BY `id` DESC ";
    $filters = array();
    $byCountry = $_POST['filterCountry'];
    $byState = $_POST['filterState'];
    $filterdistrict = $_POST['filterdistrict'];
    $bytehsil = $_POST['bytehsil'];
    $selectedMediaIds = isset($_POST['selectedMedia']) ? $_POST['selectedMedia'] : '';

    if ($byCountry || $byState || $filterdistrict || $bytehsil)
    {
        $newStr = ' WHERE ';
    }

    if ($byCountry)
    {
        $byCountry = " country LIKE '" . $byCountry . "%'";
        array_push($filters, $byCountry);
    }
    if ($byState)
    {
        $byState = " state LIKE '" . $byState . "%'";
        array_push($filters, $byState);
    }
    if ($filterdistrict)
    {
        $filterdistrict = " district LIKE '" . $filterdistrict . "%'";
        array_push($filters, $filterdistrict);
    }
    if ($bytehsil)
    {
        $bytehsil = " tehsil LIKE '" . $bytehsil . "%'";
        array_push($filters, $bytehsil);
    }

    $newStr = $newStr . implode(" AND ", $filters);
    $sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY name ASC;";

    // Fetch selected media paths and captions
    $mediaPaths = [];
    $mediaCaptions = [];
    if (!empty($selectedMediaIds))
    {
        $ids = implode(",", $selectedMediaIds);
        $mediaSql = "SELECT image_path, image_caption FROM api_content WHERE id IN ($ids)";
        $mediaResult = $conn->query($mediaSql);

        while ($mediaRow = $mediaResult->fetch_assoc())
        {
            $mediaPaths[] = $mediaRow['image_path'];
            $mediaCaptions[] = $mediaRow['image_caption'];
        }
    }
}

function convert_to_str($arr, $currentURL)
{
    $prefix = $currentURL . 'imgs/api_content/'; // Prefix to add
    $prefixedArray = array_map(function ($item) use ($prefix) {
        return $prefix . $item;
    }, $arr);
    return implode(',', $prefixedArray);
}
$allMediaStr = convert_to_str($mediaPaths, $currentURL);
$allCaptionStr = implode(',', $mediaCaptions);


$country_code = array(
    "Australia" => "61",
    "Canada" => "1",
    "United Kingdom" => "44",
    "India" => "91",
    "Japan" => "81",
    "New Zealand" => "64",
    "United Arab Emirates" => "971",
    "United States" => "1",
    "USA" => "1",
    "UK" => "+44",
    "England" => "+44",
);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIEO Gita : Custom message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: #f7e092;
            overflow-x: hidden;
        }

        .filterform select {
            flex: 1 0 150px;
        }

        .filterform>button {
            flex: 1 0 100px;
        }

        .tablediv {
            overflow-x: scroll;
            font-size: 1rem;
        }

        #myTable {}
    </style>
</head>

<body>

    <?php include '_api_option.php'; ?>


    <div class="container tablediv pt-3">
        <table style="font-size: small;" id="myTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">City</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                Showing :-
                <?php
                if (isset($_POST['get-data']))
                {
                    $messageSelect = $_POST['messageSelect'];
                    $msgsql = "SELECT * FROM `messages` WHERE `title` = '$messageSelect'";
                    $msgresult = mysqli_query($conn, $msgsql);
                    $msgrow = mysqli_fetch_assoc($msgresult);
                    $message = $msgrow['msg'];

                    $sr = 0;
                    $result = $conn->query($sql);
                    echo $totalresult = mysqli_num_rows($result);
                    if ($totalresult > 0)
                    {
                        while ($row = mysqli_fetch_array($result))
                        {
                            $code = $country_code[$row['country']];
                            $sr++;
                            $user_id = $row['id'];
                            $country = $row['country'];
                            $name = $row['name'];
                            $phone = $row['phone'];
                            $name = $row['name'];
                            $designation = $row['designation'];
                            $email = $row['email'];
                            $dikshit = $row['dikshit'];
                            $marital_status = $row['marital_status'];
                            $state = $row['state'];
                            $district = $row['district'];
                            $tehsil = $row['tehsil'];
                            $address = $row['address'];
                            $wing = $row['interest'];
                            $occupation = $row['occupation'];
                            $education = $row['education'];
                            $dob = $row['dob'];
                            $aniver_date = $row['aniver_date'];
                            $joinOn = $row['dt'];
                            $pic = $row['pic'];

                            $message = html_entity_decode($message);
                            $message = urldecode($message);

                            //preparing full message
                            $msg = 'गीता प्रिय ' . $row['name'] . ' जी , %0A 🌹 &ast; जय श्री कृष्ण &ast; 🌹 %0A' . $message . ' %0A %0ATo view profile Click here- ' . $currentURL . 'member.php?member=' . md5($phone);


                            echo '
                            <tr>
                                <th scope="row">' . $sr . '</th>
                                <td>' . $name . '</td>
                                <td><a style="text-decoration:none;" href="tel:' . $phone . '"><span  class="text-black" >' . $phone . '</span></a></td>
                                <td>' . $tehsil . '</td>
                                <td>';

                            $status_msg = send_wa_messages($name, $code, $phone, $msg, $allMediaStr, $allCaptionStr);
                            if ($status_msg['status'] == '200')
                            {
                                echo '<span class="badge text-bg-success">' . $status_msg['message'] . '</span>';
                            } elseif (($status_msg['status'] == '400'))
                            {
                                echo '<span class="badge text-bg-danger">' . $status_msg['error'] . '</span>';
                            } elseif (($status_msg['status'] == '424'))
                            {
                                echo '<span class="badge text-bg-danger">' . $status_msg['error'] . '</span>';
                            } elseif (($status_msg['status'] == '403'))
                            {
                                echo '<span class="badge text-bg-danger">Not Allowed</span>';
                            } else
                            {
                                echo '<span class="badge text-bg-danger">' . $status_msg['error'] . '</span>';
                            }

                            echo '
                                </td>
                            </tr>
                            ';





                            '<a href="https://wa.me/' . $code . $row['phone'] . '?text=गीता प्रिय ' . $row['name'] . ' जी , %0A 🌹 &ast; जय श्री कृष्ण &ast; 🌹 %0A' . $message . ' %0A %0ATo view profile Click here- ' . $currentURL . 'member.php?member=' . md5($phone) . ' &attachment=' . $currentURL . '/imgs/65f7fc772d3bf.png" target="_blank"><i class="fa-solid fs-3  fa-brands fa-whatsapp text-success "></i>
                                    </a>';
                        }
                    } else
                    {
                        echo '
                    <tr>
                        <td class="text-center" colspan="7"> No data found </td>
                    </tr>
                    ';
                    }
                } else
                {
                    echo '
                    <tr>
                        <td class="text-center" colspan="7"> Select filter to view data</td>
                    </tr>
                    ';
                }
                ?>
            </tbody>
        </table>

        <?php
        echo '<div class="text-center"><a href="custom-message.php" class="btn btn-danger" >Done, Go Back-></a></div>';
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $('.totalCount').load('../_totalProfiles.php');
        setInterval(() => {
            $('.totalCount').load('../_totalProfiles.php');
        }, 3000);
    </script>
</body>

</html>