<?php include_once "../dbConnect.php";

if(!session_id()) {
    session_start();
}
$loginId = $_POST['loginId'];
$loginPw = $_POST['loginPw'];

$query = "select * from member where joinId= '$loginId' and joinPw = CONCAT('*', UPPER(SHA1(UNHEX(SHA1('$loginPw')))))";
$result = $conn->query($query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);

    if($row !== null) {
        //로그인 정보 일치시  세션 생성
        $_SESSION['name'] = $loginId;
        $_SESSION['memberNum'] = $row['memberNum'];
        ?>
        <script>alert('로그인 완료');
        location.replace("../QnA/Qna_list.php");
        </script>
        <?php
    } else {
        ?>
        <script>alert('아이디 또는 비밀번호를 확인해주세요.');
            history.back();
        </script>
        <?php
    }
}
?>