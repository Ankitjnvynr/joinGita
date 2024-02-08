<table class="table caption-top shadow rounded" id="myTable">
    <caption>List of users</caption>
    <thead>
        <tr>
            <th scope="col">Sr.</th>
            <th scope="col">Country</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Whatsapp</th>
            <th scope="col">Email</th>
            <th scope="col">Dikshit</th>
            <th scope="col">Marital_Status</th>
            <th scope="col">State</th>
            <th scope="col">District</th>
            <th scope="col">Tehsil</th>
            <th scope="col">Address</th>
            <th scope="col">Intrest_Field</th>
            <th scope="col">Occupation</th>
            <th scope="col">Education</th>
            <th scope="col">DOB</th>
            <th scope="col">Aniversary</th>


        </tr>
    </thead>
    <tbody>



        <?php
        include("../partials/_db.php");
        $newStr = null;
        $sr = 0;
        $sql = "SELECT * FROM `users` ORDER BY `id` DESC ";

        $filters = array();
        $byPhone = $_POST['phone'];
        $byName = $_POST['filterName'];
        $byEmail = $_POST['filterEmail'];
        $byCountry = $_POST['filterCountry'];
        $byState = $_POST['filterState'];
        $byCity = $_POST['filterCity'];

        if ($byPhone || $byEmail || $byCountry || $byState || $byCity || $byName) {
            $newStr = ' WHERE ';
        }

        if ($byCountry) {
            // unset($filters[1]);
            // unset($filters[2]);
            $filters = array();
            $byCountry = " country LIKE '" . $byCountry . "%'";
            // array_splice($filters, 1, 2);  
            array_push($filters, $byCountry);
        }
        if ($byName) {
            $byName = " name LIKE '" . $byName . "%'";
            array_push($filters, $byName);
        }
        if ($byState) {
            $byState = " state LIKE '" . $byState . "%'";
            array_push($filters, $byState);
        }
        if ($byCity) {
            $byCity = " district LIKE '" . $byCity . "%'";
            array_push($filters, $byCity);
        }
        if ($byPhone) {
            $byPhone = " phone LIKE '" . $byPhone . "%'";
            array_push($filters, $byPhone);
        }
        if ($byEmail) {
            $byEmail = " email LIKE '%" . $byEmail . "%'";
            array_push($filters, $byEmail);
        }

        // echo var_dump($filters);
        $newStr = $newStr . implode(" AND ", $filters);
        // echo ($newStr);
        
        $sql = "SELECT * FROM `users`  " . $newStr . "  ORDER BY `id` DESC ";


        // SELECT * FROM `users` WHERE phone LIKE '89%' AND name LIKE '%an%' ORDER BY `id` DESC LIMIT 3;
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_array($result)) {
            $sr++;
            $country = $row['country'];
            $name = $row['name'];
            $phone = $row['phone'];
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
            $message = $row['message'];
            echo '
                            <tr>
                            <th scope="row">' . $sr . '</th>
                            <td>' . $country . '</td>
                            <td>' . $name . '</td>
                            <td>' . $phone . '</td>
                            <td>' . $designation . '</td>
                            <td>' . $email . '</td>
                            <td>' . $dikshit . '</td>
                            <td>' . $marital_status . '</td>
                            <td>' . $state . '</td>
                            <td>' . $district . '</td>
                            <td>' . $tehsil . '</td>
                            <td class="w-150" >' . $address . '</td>
                            <td>' . $wing . '</td>
                            <td>' . $occupation . '</td>
                            <td>' . $education . '</td>
                            <td>' . $dob . '</td>
                            <td>' . $aniver_date . '</td>
                            </tr>
                            ';
        }

        ?>

    </tbody>
</table>