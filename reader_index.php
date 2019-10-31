<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');

$sql="select name from reader_card where reader_id={$userid}";
$res=mysqli_query($dbc,$sql);
$result=mysqli_fetch_array($res);
date_default_timezone_set("KR");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>마이 도서관</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            width: 100%;
            overflow: hidden;
            background-repeat: repeat;
            background-image: url("../bg.jpg");
            background-size:cover;
            color: antiquewhite;
        }
        #gonggao{
            position: absolute;
            left: 40%;
            top: 50%;
        }
    </style>
</head>
<body>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">마이 도서관</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="reader_index.php">홈페이지</a></li>
                <li><a href="../reader_querybook.php">도서 조회</a></li>
                <li ><a href="reader_borrow.php">마이 대출</a></li>
                <li><a href="reader_info.php">개인 정보</a></li>
                <li><a href="reader_repass.php">암호 수정</a></li>
                <li><a href="reader_guashi.php">분실신고</a></li>
                <li><a href="index.php">로그아웃</a></li>
            </ul>
        </div>
    </div>
</nav>
<br/><br/><h3 style="text-align: center"><?php echo $result['name'];  ?>님,안녕하십니까?</h3><br/>
<h4 style="text-align: center"><?php
    $sqla="select count(*) a from lend_list where reader_id={$userid} and back_date is NULL;";

    $resa=mysqli_query($dbc,$sqla);
    $resulta=mysqli_fetch_array($resa);
    echo "당신 지금 까지 빌려한 책은 {$resulta['a']}권입니다";
    ?>
</h4>
<h4 style="text-align: center">
    <?php
    $sqlb="select DATE_ADD(lend_date,INTERVAL 1 MONTH) AS yhrq from lend_list where reader_id={$userid} and back_date is NULL;";
    $counta=0;
    $resb=mysqli_query($dbc,$sqlb);

    foreach ($resb as $row){
        if(strtotime(date("y-m-d"))>strtotime($row['yhrq'])) $counta++;
    };

    if($counta==0) echo "지금까지 초기한 미반납 책은 없다";
    else echo "{$counta}권 책은 초기했습니다.실시간 반납하시오";


    ?>
</h4>ㄴ
<div id="gonggao">
    <a href="notice1.php" style="font-style: italic;color: white;text-decoration:replace-underline">공지상황:추석연휴 휴관 안내</a><br>
    <a href="notice2.php" style="font-style: italic;color: white">문의상황：추연구비 구매도서 등록 확인서 양식 어디서 다운받나요.</a><br>
    <a href="notice3.php" style="font-style: italic;color: white">여름휴가에 이 책 읽어보세요</a><br>

</div>

</body>
</html>
