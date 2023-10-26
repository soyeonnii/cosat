<?php include "header.php";
include "dbConnect.php";

$id = $_GET['id'];
//print_r($_GET);
$result = mysqli_query($conn, "select * from board where boardId = $id");
$row = mysqli_fetch_array($result);

?>

<main>
    <h2>QnA 수정</h2>

    <form action="/QnA_update_ok.php" method="post" name="QnA글수정페이지">
        <input type="hidden" name="id" value="<?= $row['boardId'] ?>">

        <table>
            <tr>
                <th>제목</th>
                <td><input type="text" name="title" value="<?= $row['title'] ?>"></td>
            </tr>
            <tr>
                <th>작성자</th>
                <td><?= $row['memberId'] ?></td>
            </tr>
            <tr>
                <th>작성일</th>
                <td><?= $row['createAt'] ?></td>
            </tr>
        <tr>
            <th>수정일</th>
            <td><?=$row['updateAt']?></td>
        </tr>
            <tr>
                <th>내용</th>
                <td><textarea id="contents" name="contents"> <?= $row['contents'] ?> </textarea></td>
            </tr>
        </table>
        <input type="submit" value="수정하기">
    </form>
</main>


<?php include "footer.php"; ?>
