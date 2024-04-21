<?php
// Set headers to indicate image
// header('Content-Type: image/png');
// header('Content-Disposition: attachment; filename="student_id_card.png"');

// Output HTML content
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student ID Card</title>
    <style>
        /* Your CSS styles for the ID card */
        body {
            font-family: Arial, sans-serif;
            /* Use a font that supports Hindi characters */
            margin: 0;
            padding: 0;
        }

        .id-card {
            width: 400px;
            height: 200px;
            background-color: #ffffff;
            padding: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(#03a9f4, #03a9f4 45%, #fff 45%, #fff 100%);
        }

        .card {
            position: relative;
            width: 300px;
            height: 400px;
            background: #fff;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(15px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        }

        .img-bx {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            transform: translateY(30px) scale(0.5);
            transform-origin: top;
        }

        .img-bx img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            padding-bottom: 30px;
        }

        .content .detail {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .content .detail h2 {
            color: #444;
            font-size: 1.6em;
            font-weight: bolder;
        }

        .content .detail h2 span {
            font-size: 0.7em;
            color: #03a9f4;
            font-weight: bold;
        }

        .sci {
            position: relative;
            display: flex;
            margin-top: 5px;
        }

        .sci li {
            list-style: none;
            margin: 4px;
        }

        .sci li a {
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: transparent;
            font-size: 1.5em;
            color: #444;
            text-decoration: none;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            transition: 0.5s;
        }

        .sci li a:hover {
            background: #03a9f4;
            color: #fff;
        }

        /* Add more styles as needed */
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- This is where the student ID card will be rendered -->
    <div id="studentIDCard">
        <div class="card">
            <div class="img-bx">
                <img src="image.png" alt="img" />
            </div>
            <div class="content">
                <div class="detail">
                    <h2>Emilia Roy<br /><span>Senior Designer</span></h2>
                    <ul class="sci">
                        <li>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
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
                html2canvas(element, { scale: 8 }).then(canvas => {
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
</body>

</html>