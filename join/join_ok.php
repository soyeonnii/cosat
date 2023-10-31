<?php include_once "C:/Apache24/htdocs/dbConnect.php";

$joinId = $_POST['joinId'];
$joinPW = $_POST['joinPw'];
$liveIn = $_POST['liveIn'];
$snsId = $_POST['snsId'];
date_default_timezone_set('Asia/Seoul');
$joinDate = date('Y-m-d H:i:s');

$query = "insert into member(joinId,joinPw,liveIn,snsId)
values('$joinId',CONCAT('*', UPPER(SHA1(UNHEX(SHA1('$joinPW'))))),'$liveIn','$snsId')";

$result = $conn->query($query);

if ($result) {
    ?>
    <script> alert('회원가입 완료');
        location.href = '/logIn/login.php';
    </script>
    <?php
} else {
    echo "FAIL";
}
?>