<?php
include "dbConnect.php";

$id = $_GET['id'];
$query = "delete from board where boardId ='$id';";

$url = '/QnA_list.php';
$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert("<?= "삭제완료" ?>");
        location.replace("<?= $url ?>");
    </script>
    <?php
} else {
    echo "FAIL";
}

?>
