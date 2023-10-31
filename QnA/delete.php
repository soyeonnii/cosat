<?php
include_once "C:/Apache24/htdocs/dbConnect.php";

// 삭제 버튼 누르면 한번 더 게시글 비밀번호 확인하고 삭제
/*$sql = "select contentsPassword from board ";
$result2 = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_array($result2);
*/?><!--


    <script>
        var pw = <?php /*=$row2['contentsPassword']*/?>;
        var getPw = prompt("비밀번호 입력" + "");
        if(pw == getPw) { alert("확인완료");
    } else {
        alert("잘못된 비밀번호 입니다");
        location.back(-1);
    }
</script>
-->
<?php
$id = $_GET['id'];
$query = "delete from board where boardId ='$id';";

$url = '/QnA/list.php';
$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert("<?= "삭제완료" ?>");
        location.href = '<?= $url ?>';
    </script>
    <?php
} else {
    echo "FAIL";
}

?>
