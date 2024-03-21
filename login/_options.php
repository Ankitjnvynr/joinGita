<div class="container bg-danger-subtle my-2 mb-3 shadow rounded-3 sticky-top">
    <div class="  py-2 my-2 rounded d-flex gap-2 flex-wrap justify-content-between">
        <img data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" 
            style="width: 40px; cursor:pointer; margin-left:10px" src="../imgs/hamburger-menu.svg" alt="">
        <div class="border border-danger rounded-3 bg-white  text-danger  p-2 py-1"> Total Profiles :
            <span class="totalCount fw-bold fw-3 fs-5"></span>
        </div>
        <a href="logout.php" class="btn btn-danger">Logout</a>

    </div>
</div>

</div>





<div style="max-width:70%" class="offcanvas offcanvas-start bg-warning-subtle" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-danger" id="offcanvasExampleLabel">Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>

        </div>
        <div class="d-flex flex-column gap-3">
            <a class="btn btn-danger" href="all-card.php">All Profiles</a>
            <a class="btn btn-danger" href="masik-parwas.php">Masik Parwas</a>
            <a class="btn btn-danger" href="report.php">Report</a>
            <a class="btn btn-danger" href="birthday.php">Birthday/Aniversary</a>
            <a class="btn btn-danger" href="custom-message.php">Custom Message</a>
        </div>

    </div>
</div>