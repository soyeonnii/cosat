<?php
include "dbConnect.php";
session_start();

$id = $_GET['id'];
$replyContents = $_GET['commentContents'];
$replyName = $_SESSION['name'];
date_default_timezone_set('Asia/Seoul');
$replyDate = date('Y-m-d H:i:s');

$replyUrl = '/QnA_view.php?id=' . $id;

$query = "insert into comments(boardId,commentName,commentContents,commentAt)
values($id,'$replyName','$replyContents','$replyDate')";

$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert("<?= "댓글 등록완료" ?>");
        location.replace("<?= $replyUrl ?>");
    </script>
    <?php
} else {
    echo "FAIL";
}

?>


