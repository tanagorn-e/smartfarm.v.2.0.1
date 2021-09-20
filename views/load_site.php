
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">เลือกโรงเรือน</div>
            <!-- <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Cards</li>
                    </ol>
                </nav>
            </div> -->
            <!-- <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div> -->
        </div>
        <!--end breadcrumb-->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                
                
        <?php
    session_start();
    require '../routes/connectdb.php';
    $url_host = 'http://' . $_SERVER['HTTP_HOST'];
    $url_part = explode("/", $_SERVER["PHP_SELF"]);
    $url_link = $url_host . '/' . $url_part[1];
    // echo $url_part[1];
    // exit();
    $login_userid = $_SESSION['user_id'];
    // $_SESSION["Username"] ;
    // $_SESSION["login_status"]  ;

    function encode($string)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string . 'zasn'));
    }

    // function decode($string) {
    //     return base64_decode(str_replace(['-','_'], ['+','/'], $string));
    // }

    if ($_SESSION["login_status"] != 1) {
        $site_stmt = $dbcon->query("SELECT * FROM `tb3_userst`INNER JOIN tb2_login ON tb3_userst.userST_loginID = tb2_login.login_id INNER JOIN tb2_site ON tb3_userst.userST_siteID = tb2_site.site_id WHERE tb3_userst.userST_loginID = '$login_userid' GROUP BY userST_siteID ");
    } else {
        $site_stmt = $dbcon->query("SELECT * FROM tb2_site ");
    }
    $i = 1;
    // $row_site = $site_stmt->fetch(PDO::FETCH_BOTH);
    foreach ($site_stmt as $row_site) {
        $co = $row_site["site_id"];
    ?>
        <div class="col">
            <div class="card" style="padding: 1.25rem;">
                <img src="public/images/site/<?= $row_site["site_img"] ?>" style="height: 20vh; width: 100%;" class="card-img-top img-fluid" alt="site01">
                <!-- <div class="card"> -->
                <h5 class="card-title text-bold text-center" style="margin-top: 15px">SITE :
                    <B><B><?= $row_site["site_name"] ?></B></B>
                </h5>
                <div class="d-grid">
                <?php 
                    $stmt2 = $dbcon->query("SELECT * FROM tb2_house WHERE house_siteID ='$co'");
                    foreach ($stmt2 as $row) {
                        echo '<a class="btn btn-outline-info px-5 radius-30" style="margin-top: 10px" href="'. $url_link .'#'. encode($row["house_master"]) .'">'. $row["house_name"].'</a>';
                    }
                ?>
                </div>
            </div>
        </div>





    <?php $i++;
    } ?>
         
    </div>   
</div>