<?php include "dbConnect.php";
session_start();

$memberNumber = $_POST['memberNum'];
$updateId = $_POST['updateId'];
$updateLiveIn = $_POST['updateLiveIn'];
$updateSnsId = $_POST['updateSnsId'];

$url = '/myPage.php?num=' . $memberNumber;

$query = "update member set joinId='" . $updateId . "', liveIn='" . $updateLiveIn . "',snsId='" . $updateSnsId . "' 
where memberNum=" . $memberNumber;


$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert('수정되었습니다');
        location.replace("<?=$url?>");
    </script>
    <?php
} else {
    ?>
    <script>
        alert('잘못된 정보입니다');
    </script>
    <?php
}
?>

