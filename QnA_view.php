<?php include "header.php";
include "dbConnect.php";

$id = $_GET['id'];
//print_r($_GET);
$sql = "update board set view = view + 1 where boardId = $id";
mysqli_query($conn, $sql);

$result = mysqli_query($conn, "select * from board where boardId = $id");
$row = mysqli_fetch_array($result);

?>


<!-- 전체공개= 모든 사용자, 비공개= 본인, 회원한테만 보이게 ? -->

<main>
    <h2>QnA</h2>
    <!-- 게시글 작성자(회원) 본인한테만 수정 삭제 버튼 보이게, 하지만 비회원인 경우 본인이 쓴글이든 아니든 전부 수정 삭제 버튼 안보임 -->

    <?php
    if ($_SESSION['name'] == $row['memberId']) {
        ?>

        <a href="/QnA_update.php?id=<?= $row['boardId']; ?>">수정</a>
        <a href="/QnA_delete.php?id=<?= $row['boardId']; ?>">삭제</a>
        <?php
    }
    ?>
    <table>
        <tr>
            <th>제목</th>
            <td><?= $row['title']; ?></td>
        </tr>
        <tr>
            <th>작성자</th>
            <td><?= $row['memberId']; ?></td>
        </tr>
        <tr>
            <th>작성일자</th>
            <td><?= $row['createAt']; ?></td>
        </tr>
        <!-- 댓글이 달리면 자동으로 답변완료, 안달리면 답변대기 ? -->
        <tr>
            <th>답변여부</th>
            <td>답변완료</td>

            <th>조회수</th>
            <td><?= $row['view']; ?></td>
        </tr>
        <tr>
            <th>작성내용</th>
            <td><?= $row['contents']; ?></td>
        </tr>

        <?php
        $sql = mysqli_query($conn, "select * from comments where boardId = $id");
        while ($reply = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <th>댓글 작성자</th>
                <td><?= $reply['commentName'] ?></td>

                <?php
                if ($_SESSION['name'] == $reply['commentName']) {
                    ?>
                    <td>
                        <a href="reply_delete.php?replyId=<?= $reply['Id'] ?>&&boardId=<?= $reply['boardId'] ?>">댓글삭제</a>
                    </td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <th>댓글 작성시간</th>
                <td><?= $reply['commentAt'] ?></td>
            </tr>
            <tr>
                <th>좋아요</th>
                <td><?= $reply['commentGood'] ?></td>
            </tr>

            <tr>
                <th>댓글내용</th>
                <td><?= $reply['commentContents'] ?></td>
            </tr>
            <?php
        }
        ?>
        <?php
        if ($login_success) {
        ?>
        <form action="/QnA_replyOk.php" method="get" name="QnA댓글쓰기">
            <input type="hidden" name="id" value="<?= $id ?>">
            <tr>
                <th>댓글입력</th>
                <td><?= $_SESSION['name'] ?></td>
                <td><textarea id="comments" name="commentContents" placeholder="댓글입력"></textarea></td>
            </tr>
            <tr>
                <?php date_default_timezone_set('Asia/Seoul'); ?>
                <td><?= date('Y-m-d H:i:s') ?></td>
                <td><input type="submit" value="등록"></td>
            </tr>
            <?php
            } else {
                ?>
                <tr>
                    <td>비회원은 댓글을 작성할 수 없습니다.</td>
                </tr>
                <?php
            }
            ?>

        </form>
    </table>
</main>

<?php include "footer.php"; ?>

