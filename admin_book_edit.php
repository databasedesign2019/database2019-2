<?php
session_start();
$userid=$_SESSION['userid'];
include ('mysqli_connect.php');
$xgid=$_GET['id'];

$sqlb="select name,author,publish,ISBN,introduction,language,price,pubdate,class_id,pressmark,
state from book_info where book_id={$xgid}";
$resb=mysqli_query($dbc,$sqlb);
$resultb=mysqli_fetch_array($resb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>도서관 | | 서적정보 수정</title>
    <style>
        body{
            width: 100%;
            overflow: hidden;
            background: url("bg.jpg") repeat;
            background-size:cover;
            color: antiquewhite;
        }

    </style>
</head>

<body>
<div class="col-xs-5 col-md-offset-3" style="position: relative;top: 25%">
    <div style="text-align: center">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">서적정보 수정</h3>
            </div>
            <div class="panel-body">
    <form  action="admin_book_edit.php?id=<?php echo $xgid; ?>"" method="POST" style="text-align: center" class="bs-example bs-example-form" role="form">
    <div id="login">
        <div class="input-group"><span  class="input-group-addon">제목</span><input value="<?php echo $resultb['name']; ?>" name="nname" type="text" placeholder="수정한 제목 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">저자</span><input value="<?php echo $resultb['author']; ?>" name="nauthor" type="text" placeholder="수정한 저자 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">출판사</span><input value="<?php echo $resultb['publish']; ?>"  name="npublish" type="text" placeholder="수정한 출판사 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">ISBN</span><input value="<?php echo $resultb['ISBN']; ?>" name="nISBN" type="text" placeholder="새러운 ISBN 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">소개</span><input  value="<?php echo $resultb['introduction']; ?>" name="nintroduction" type="text" placeholder="새러운 소개 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">언어</span><input value="<?php echo $resultb['language']; ?>" name="nlanguage" type="text" placeholder="수정한 언어 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">가격</span><input value="<?php echo $resultb['price']; ?>" name="nprice" type="text" placeholder="수정한 가격 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span  class="input-group-addon">출반 일기</span><input value="<?php echo $resultb['pubdate']; ?>" name="npubdate" type="text" placeholder="수정한 출반 일기 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">구분 <select id="selector" select name="nclass_id"><option value="1">컴퓨터 과학</option><option value="2">철학</option><option value="3">사회 과학 </option><option value="4">정치 법률</option><option value="5">군사</option><option value="6">경제</option><option value="7">문화</option><option value="8">언어</option><option value="9">문학</option><option value="10">예술</option><option value="11">역사 지리</option><option value="12">자연 과학</option><option value="13">수리 과학과 화학</option><option value="14">천문학, 지구 과학</option><option value="15">생물과학</option><option value="16">의약, 위생</option><option value="17">농업과학</option><option value="18">공업 기술</option><option value="19">교통운수</option><option value="20">항공, 우주 비행</option><option value="21">환경 과학</option><option value="22">종합</option></select></span></div><br/>
        <div class="input-group"><span  class="input-group-addon">책장호</span><input value="<?php echo $resultb['pressmark']; ?>" name="npressmark" type="text" placeholder="수정한 책장호 입력하시오" class="form-control"></div><br/>
        <div class="input-group"><span class="input-group-addon">상태 <select id="box" select name="nstate"><option value="0">대출중</option><option value="1">대출가능</option><option value="2">상태정보없음</option></select></div></span><br/>
        <label><input type="submit" value="확인" class="btn btn-default"></label>
        <label><input type="reset" value="리셋" class="btn btn-default"></label>
        </div>
    </form>

            </div>
            </form>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function(){
        $("#selector").val(<?php echo $resultb['class_id']; ?>);
        $("#box").val(<?php echo $resultb['state']; ?>);
    })

</script>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $boid=$_GET['id'];
    $nnam = $_POST["nname"];
    $naut = $_POST["nauthor"];
    $npubl = $_POST["npublish"];
    $nisb = $_POST["nISBN"];
    $nint = $_POST["nintroduction"];
    $nlan = $_POST["nlanguage"];
    $npri = $_POST["nprice"];
    $npubd = $_POST["npubdate"];
    $ncla = $_POST["nclass_id"];
    $npre = $_POST["npressmark"];
    $nsta= $_POST["nstate"];



    $sqla="update book_info set name='{$nnam}',author='{$naut}',publish='{$npubl}',
ISBN='{$nisb}',introduction='{$nint}',language='{$nlan}',price='{$npri}',pubdate='{$npubd}',
class_id={$ncla},pressmark={$npre},state={$nsta} where book_id=$boid;";
    $resa=mysqli_query($dbc,$sqla);


    if($resa==1)
    {

        echo "<script>alert('수정 성공！')</script>";
        echo "<script>window.location.href='admin_book.php'</script>";

    }
    else
    {
        echo "<script>alert('수정 실패! 다시 입력해주세요!');</script>";

    }

}


?>
</body>
</html>
