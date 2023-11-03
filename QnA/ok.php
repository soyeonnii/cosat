<?php
include_once "C:/Apache24/htdocs/dbConnect.php";
session_start();

//print_r($_GET);
//
//die();
$title = $_POST['title'];
$name = $_SESSION['name'];
$name = $_SESSION['name'] ?: '비회원';
// date default timezone set 날리고 php 세팅
date_default_timezone_set('Asia/Seoul');
$date = date('Y-m-d H:i:s');
$content = $_POST['contents'];
$privacy = $_POST['공개여부'];
$password = $_POST['password'] ?: 0;

if (!$_SESSION['memberNum'] and ($password == 0)) {
    $password = $_POST['password'];
    ?>
    <script>
        alert('비회원은 비공개글만 작성하실 수 있습니다');
        location.href ='/QnA/create.php';
    </script>
    <?php
}
$query = "insert into board (title,memberId,createAt,contents,privacy,contentsPassword,answer) 
            values('$title','$name','$date','$content','$privacy','$password','답변대기')";

$result = $conn->query($query);

if ($result) {
    $last_uid = mysqli_insert_id($conn);
    $url = '/QnA/view.php?id=' . $last_uid;
    ?>

    <script>
        alert("<?= "글이 등록되었습니다." ?>");
        location.href = '<?= $url ?>';
    </script>


    <?php
} else {
    echo "FAIL";
}
?>
