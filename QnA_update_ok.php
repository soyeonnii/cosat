<?php
include "dbConnect.php";

session_start();
//print_r($_GET);
//
//die();
$id = $_POST['id'];
$title = $_POST['title'];
date_default_timezone_set('Asia/Seoul');
$date = date('Y-m-d H:i:s');
$content = $_POST['contents'];


$url = '/QnA_view.php?id='.$id;


$query = "update board set title='" . $title . "', updateAt='" . $date . "',contents='" . $content . "' where boardId=" . $id;

$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert("<?= "글이 수정 되었습니다." ?>");
        location.replace("<?= $url ?>");
    </script>
    <?php
} else {
    echo "FAIL";
}

?>


