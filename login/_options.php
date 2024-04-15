<div class="container bg-danger-subtle my-2 mb-3 shadow rounded-3 sticky-top">
    <div class="  py-2 my-2 rounded d-flex gap-2 flex-wrap justify-content-between">
        <img data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"
            style="width: 40px; cursor:pointer;" src="../imgs/hamburger-menu.svg" alt="">
        <h4 class="text-center text-danger  py-1 ">GIEO Gita</h4>
        <div style="width:70px"
            class="border border-danger rounded-3 bg-white d-flex flex-column text-center text-danger position-relative pb-1 ">
            <span class="totalCount fw-bold fw-3 fs-5"></span>
            <span style="transform:translatex(8px)"
                class=" text-center p-0 m-0 fs-6 position-absolute top-50 ">Profiles</span>
        </div>


    </div>
</div>

</div>





<div style="max-width:70%" class="offcanvas offcanvas-start bg-warning-subtle" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-danger" id="offcanvasExampleLabel">Admin </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <div>
            <div class=" rounded-full overflow-hidden mb-3  text-center">
                <img width="100px" style="border-radius:50%;" class="boorder border-circle shadow-sm"
                    src="../imgs/logo.png" alt="">
            </div>
            <div class="d-flex flex-column gap-1">
                <a class="btn btn-danger" href="all-card.php">All Profiles</a>
                <a class="btn btn-danger" href="masik-parwas.php">Masik Parwas</a>
                <a class="btn btn-danger" href="rastrSuchna.php">राष्ट्र सूचना</a>
                <a class="btn btn-danger" href="report.php">Report</a>
                <a class="btn btn-danger" href="birthday.php">Birthday/Aniversary</a>
                <a class="btn btn-danger" href="custom-message.php">Custom Message</a>
                <a class="btn btn-danger" href="addTehsil.php">Add Tehsils</a>
                <a class="btn btn-danger" href="music.php">Bhajans</a>
            </div>
        </div>
        <div>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

    </div>
</div>