<?php
include "dbConnect.php";

//댓글 삭제 후 받아올 url에서 boardID필요하니까 같이 넘겨주고 받아옴
$boardId = $_GET['boardId'];

//댓글 삭제시 boardId는 필요없고, 댓글의 pk인 Id값만 필요
$replyId = $_GET['replyId'];
$query = "delete from comments where Id = '$replyId'";

$url = '/QnA_view.php?id='.$boardId;
$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert("<?= "댓글 삭제완료" ?>");
        location.replace("<?= $url ?>");
    </script>
    <?php
} else {
    echo "FAIL";
}

?>
