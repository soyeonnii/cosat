<?php include_once "C:/Apache24/htdocs/dbConnect.php";

$memberNumber = $_POST['memberNum'];
$updateId = $_POST['updateId'];
$updateLiveIn = $_POST['updateLiveIn'];
$updateSnsId = $_POST['updateSnsId'];

$url = '/myPage/index.php?num=' . $memberNumber;

$query = "update member set joinId='" . $updateId . "', liveIn='" . $updateLiveIn . "',snsId='" . $updateSnsId . "' 
where memberNum=" . $memberNumber;

$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert('수정되었습니다');
        location.href = '<?=$url?>';
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

