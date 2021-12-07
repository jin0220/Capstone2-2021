<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');
    include 'db/dbcon.php';

    $plant3 = $_GET['plant3'];

    $sql="select * from information where plant3='$plant3'";
    $result = mysqli_query($connect,$sql);

    $row = mysqli_fetch_array($result);

    $num = $row['num'];
    $title = $row['title'];
    $content = nl2br($row['content']); //개행 처리
    $image= $row['image'];
    // $date = ;
    $date = explode(" ",$row['date']);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>우리집 앞마당 모니터링</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet">

        <link href="css/pages/reports.css" rel="stylesheet">
        <link href="css/comunity_styles.css" rel="stylesheet" />

    </head>
    <style>
        .btn_container {
            margin-left: 85%;
        }
        .btn{
            font-size:10px;        }

        a:link {
            text-decoration: none;
            color: #333333;
        }

        a:visited {
            text-decoration: none;
            color: #333333;
        }

        a:active {
            text-decoration: none;
            color: #333333;
        }

        a:hover {
            text-decoration: underline wavy;
        }

        .card-img-top {
            width:100%;
            /* height:auto !important; */
            object-fit: cover;
        }

    </style>

    <body>
        <!-- Navigation-->
        <?php include 'header.php'?>

        <div class="main">

            <div class="main-inner">
                <div class="container">

                    <div class="row">

                        <div class="span12">

                            <div class="info-box">
                                <div class="row-fluid stats-box">
                                    <!-- 관리자일 경우에 작성버튼 생김 -->
                                    <?php if($userid == "admin"){?> 
                                    <div class="btn_container">
                                        <button class="btn btn-primary" onclick="location.href='editor.php?mode=browse_write&&mode2=update&&plant3=<?=$plant3?>'">수정하기</button>
                                        <button class="btn btn-primary" onclick="location.href='db/browse_insert.php?sql_mode=delete&&num=<?=$num?>'">삭제</button>
                                    </div>
                                    
                                    <?php }?>
                                    <!-- Page Content-->
                                    <div class="container2">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h1 class="my-4">찾아보기 <i class="icon-leaf"></i></h1>
                                                <div class="list-group">
                                                    <?php 
                                                        $plant1 = $_GET['plant1'];
                                                        $plant2 = $_GET['plant2'];
                                                        $sql_2="select plant3 from plant where plant1 = '$plant1' and plant2 = '$plant2'";
                                                        $result_2 = mysqli_query($connect,$sql_2);
                                                        $total_record_2 = mysqli_num_rows($result_2);

                                                        for($i=0;$i<$total_record_2;$i++){
                                                            $row_2 = mysqli_fetch_array($result_2);

                                                            $plant3=$row_2['plant3'];
                                                    ?>
                                                        <a class="list-group-item" href="browse1.php?plant1=<?=$plant1?>&&plant2=<?=$plant2?>&&plant3=<?=$plant3?>"><?=$plant3?></a>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="card mt-4">
                                                    <img class="card-img-top"
                                                        src="../files/<?=$image?>" alt="..." />
                                                    <div class="card-body">
                                                        <h3 class="card-title"><?=$title?></h3>
                                                        <p class="card-text"><?=$plant1?> > <?=$plant2?> </p>
                                                        <!-- <span class="text-warning">★ ★ ★ ★ ☆</span>
                                                        4.0 stars -->
                                                    </div>
                                                </div>
                                                <div class="card card-outline-secondary my-4">
                                                    <div class="card-header">키우는 방법</div>
                                                    <div class="card-body">
                                                        <p><?=$content?></p>
                                                        <small class="text-muted"><?=$date[0]?> by 관리자 </small>
                                                        <hr /> 
                                                        <a class="btn btn-success" href="javascript:history.back();">목록</a>
                                                    </div>
                                                </div>
                                            </div><!--col-lg-9-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>

</html>
