<?php include_once "C:/Apache24/htdocs/header.php";
include_once "C:/Apache24/htdocs/dbConnect.php";

$id = $_GET['id'];
//print_r($_GET);
$sql = "update board set view = view + 1 where boardId = $id";
mysqli_query($conn, $sql);


//$result = mysqli_query($conn, "select * from board where boardId = $id");
$result = mysqli_query($conn,
    /*   "select *, ifnull(joinId, '비회원') as memberId from ( select * from board where boardId = $id ) as board
            left join ( select joinId from member) as member
            on board.memberId = member.joinId");*/
    "select *, ifnull(joinId, '비회원') as memberId from ( select * from board where boardId = $id) as board 
    left join member on board.memberId = member.joinId");

$row = mysqli_fetch_array($result); ?>


<main>
    <h2>QnA</h2>

    <!-- 회원 본인이 쓴 글에만 수정 삭제 버튼 보임-->
    <?php
    if ($_SESSION['name'] == $row['memberId']) {
        ?>

        <a href="/QnA/update.php?id=<?= $row['boardId']; ?>">수정</a>
        <a href="/QnA/delete.php?id=<?= $row['boardId']; ?>">삭제</a>

    <?php
    } elseif ($row['privacy'] == '비공개') {
    if ($_GET['pw_check'] == 'N') {
    ?>
        <script>
            var pw = <?=$row['contentsPassword']?>;
            var getPw = prompt("비밀번호 입력" + "");
            if (pw == getPw) {
                alert("확인완료");
            } else {
                alert("잘못된 비밀번호 입니다");
                location.href = '/QnA/list.php';
            }
        </script>

        <a href="/QnA/update.php?id=<?= $row['boardId']; ?>">수정</a>
        <a href="/QnA/delete.php?id=<?= $row['boardId']; ?>">삭제</a>

        <?php
    }
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

        <?php

        $sql = mysqli_query($conn,
            "select *, ifnull(memberId, '비회원') as commentName from (select * from comments where boardId = $id) as comments
           left join (select memberId from board) as board on comments.commentName = board.memberId");

        $reply = mysqli_fetch_array($sql);
        ?>

        <tr>
            <!-- 댓글이 달리면 자동으로 답변완료, 안달리면 기본값 답변대기 -->
            <th>답변여부</th>
            <?php
            if ($reply['Id']) {
                ?>
                <td>답변완료</td>
                <?php
            } else {
                ?>
                <td>답변대기</td>
                <?php
            }
            ?>

            <th>조회수</th>
            <td><?= $row['view']; ?></td>
        </tr>
        <tr>
            <th>작성내용</th>
            <td><?= $row['contents']; ?></td>
        </tr>

        <?php
        while ($reply = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <th>댓글 작성자</th>
                <td><?= $reply['commentName'] ?></td>

                <?php
                if ($_SESSION['name'] == $reply['commentName']) {
                    ?>
                    <td>
                        <a href="/comment/delete.php?replyId=<?= $reply['Id'] ?>&&boardId=<?= $reply['boardId'] ?>">댓글삭제</a>
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
                <!-- 댓글 좋아요 버튼 클릭시 좋아요 수 자동으로 + 1, 취소가능 ? -->
                <?php
                /* $login_user = $_SESSION['name'];
                $good_sql = "select * from comments where commentName = '$login_user'";
                $good_result = mysqli_query($conn, $good_sql);
                $good_row = mysqli_fetch_array($good_result);
                $good = $good_row['commentGood'];

                // 1이면 색깔 칠해져 있는 하트, 0이면 빈 하얀 하트 출력?
                if($good)
                 */ ?>
                <!-- <script src="https://kit.fontawesome.com/6478f529f2.js" crossorigin="anonymous"></script> -->
            </tr>


            <tr>
                <th>댓글내용</th>
                <td><?= $reply['commentContents'] ?></td>
            </tr>
            <?php
        }
        ?>

        <?php
        if ($_SESSION['memberNum']) {
        ?>
        <form action="/comment/replyOk.php" method="get" name="QnA댓글쓰기">
            <input type="hidden" name="id" value="<?= $id ?>">
            <tr>
                <th>댓글입력</th>
                <td><?= $_SESSION['name'] ?></td>
                <td>
                    <textarea id="comments" name="commentContents" placeholder="댓글입력"></textarea>
                </td>
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

<?php include_once "C:/Apache24/htdocs/footer.php"; ?>

