<?php
include_once "C:/Apache24/htdocs/dbConnect.php";
session_start();


$id = $_GET['id'];
$replyContents = $_GET['commentContents'];
$replyName = $_SESSION['name'];
date_default_timezone_set('Asia/Seoul');
$replyDate = date('Y-m-d H:i:s');

$replyUrl = '/QnA/view.php?id=' . $id;

$query = "insert into comments(boardId,commentName,commentContents,commentAt)
values($id,'$replyName','$replyContents','$replyDate')";

$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert("<?= "댓글 등록완료" ?>");
        location.href = '<?= $replyUrl ?>';
    </script>
    <?php
} else {
    echo "FAIL";
}

?>
