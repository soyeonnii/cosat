<?php include_once "C:/Apache24/htdocs/dbConnect.php"; ?>
<?php
$id = $_GET['id'];
//게시글 삭제시, 해당글에 달린 (board.boardId = comments.boardId 인) 댓글 또한 삭제
//$query = "delete board, comments from board left join comments on board.boardId = comments.boardId where board.boardId = '$id'";
$query = "delete from board where boardId ='$id'";
$url = '/QnA/list.php';
$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert('삭제완료');
        location.href = '<?= $url ?>';
    </script>
    <?php
} else {
    echo "FAIL";
}

?>
