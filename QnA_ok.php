<?php
include "dbConnect.php";
session_start();
//print_r($_GET);
//
//die();
$title = $_POST['title'];
$name = $_SESSION['name'];
$name = $_SESSION['name'] ?: '비회원';
date_default_timezone_set('Asia/Seoul');
$date = date('Y-m-d H:i:s');
$content = $_POST['contents'];
$privacy = $_POST['공개여부'];
$password = $_POST['password'];


$query = "insert into board (title,memberId,createAt,contents,privacy,contentsPassword,answer) 
            values('$title','$name','$date','$content','$privacy','$password','답변대기')";

$result = $conn->query($query);

$_SESSION['boardPw'] = $password;

if ($result) {
    $last_uid = mysqli_insert_id($conn);
    $url = '/QnA_view.php?id=' . $last_uid;
    ?>

    <script>
        alert("<?= "글이 등록되었습니다." ?>");
        location.replace("<?= $url ?>");
    </script>
    <?php
} else {
    echo "FAIL";
}

?>


