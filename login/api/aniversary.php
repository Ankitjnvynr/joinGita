<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location: index.php");
    exit;
}
include ("../../partials/_db.php");

// Add CORS headers
header('Access-Control-Allow-Origin: https://parivaar.gieogita.org/'); // Use a specific domain instead of * for security in production
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
{
    // Send response to OPTIONS request and exit to avoid further processing
    header('HTTP/1.1 200 OK');
    exit;
}

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

        .filterform select,
        input {
            flex: 1 0 150px;
        }

        .filterform>button {
            flex: 1 0 100px;
        }

        .tablediv {
            overflow-x: scroll;
            font-size: 1rem;
        }

        .fs-7 {
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

    <?php
    include '_api_option.php';

    ?>


    <h5 class="text-center my-3">Sending Aniversary message</h5>
    <div class="container bg-light p-1">
        <form id="getDataForm" action="" method="POST" class="filterform d-flex flex-wrap gap-1">
            <input type="number" name="aniDate" class="form-control form-control-sm  inputfields"
                placeholder="Enter Date" value="<?php echo date('d') ?>" oninput="validateDate(this)" required>

            <input type="number" name="aniMonth" class="form-control form-control-sm inputfields"
                placeholder="Enter Month" value="<?php echo date('m') ?>" oninput="validateMonth(this)" required>

            <select class="form-select form-select-sm inputfields" name="messageSelect"
                aria-label="Small select example" required>
                <?php
                $message_select_sql = "SELECT * FROM `messages` ";
                $message_select_result = mysqli_query($conn, $message_select_sql);
                while ($message_select_row = mysqli_fetch_assoc($message_select_result))
                {
                    $selected = $message_select_row['title'] == 'Aniversary' ? "Selected" : "";
                    echo '<option value="' . $message_select_row['title'] . '" ' . $selected . '>' . $message_select_row['title'] . '</option>';
                }
                ?>
            </select>




            <button id="sendBtn" type="submit" name="get-data" class="btn btn-danger">send ></button>
        </form>
    </div>

    <div class="container fs-7">
        <table class="table my-3 fs-7">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="resultData">


            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="../../js/api.js"></script>

    <script>
        function validateDate(input) {
            if (input.value < 1) {
                input.value = "";
            } else if (input.value > 31) {
                input.value = 31;
            }
        }

        function validateMonth(input) {
            if (input.value < 1) {
                input.value = "";
            } else if (input.value > 12) {
                input.value = 12;
            }
        }
        let loadMessages = () => {

            $.ajax({
                url: '_viewAllMessages.php',
                method: 'POST',
                success: function (response) {
                    $('#allMessage').html(response)
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error('Error updating content:', error);
                }
            });
        }

        function updateContent(textarea, sr) {
            var newText = textarea.value;
            $.ajax({
                url: '_update_message.php',
                method: 'POST',
                data: {
                    sr: sr,
                    msg: newText
                },
                success: function (response) {
                    // Handle success

                    console.log('Content updated successfully');
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error('Error updating content:', error);
                }
            });
        }
        let deleteMsg = (e, sr) => {
            let card = e.parentNode.parentNode;
            if (confirm("Are You sure")) {
                $.ajax({
                    url: '_deletemsg.php',
                    method: 'POST',
                    data: {
                        sr: sr,
                    },
                    success: function (response) {
                        card.classList.add("deleteditem");
                        setInterval(() => {
                            card.style.display = "none";
                        }, 1000);
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error('Error updating content:', error);
                    }
                });
            }
        }


    </script>


</body>

</html>