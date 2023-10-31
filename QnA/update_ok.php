<?php
include_once "C:/Apache24/htdocs/dbConnect.php";

$id = $_POST['id'];
$title = $_POST['title'];
date_default_timezone_set('Asia/Seoul');
$date = date('Y-m-d H:i:s');
$content = $_POST['contents'];


$url = '/QnA/view.php?id='.$id.'&pw_check=Y';


$query = "update board set title='" . $title . "', updateAt='" . $date . "',contents='" . $content . "' where boardId=" . $id;

$result = $conn->query($query);

if ($result) {
    ?>
    <script>
        alert("<?= "글이 수정 되었습니다." ?>");
        location.href = '<?= $url ?>';
    </script>
    <?php
} else {
    echo "FAIL";
}

?>
