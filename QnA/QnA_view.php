<?php include_once "../header.php";
include_once "../dbConnect.php";

$id = $_GET['id'];
//print_r($_GET);
$sql = "update board set view = view + 1 where boardId = $id";
mysqli_query($conn, $sql);


//$result = mysqli_query($conn, "select * from board where boardId = $id");
$result = mysqli_query($conn,
    "select *, ifnull(joinId, '비회원') as memberId from ( select * from board where boardId = $id ) as t1
        left join ( select * from member) as t2
        on t1.memberId = t2.joinId");


$row = mysqli_fetch_array($result); ?>


<main>
    <h2>QnA</h2>

    <!-- 회원 본인이 쓴 글에만 수정 삭제 버튼 보임-->
    <?php
    if ($_SESSION['name'] == $row['memberId']) {
        ?>

        <a href="../QnA/QnA_update.php?id=<?= $row['boardId']; ?>">수정</a>
        <a href="../QnA/QnA_delete.php?id=<?= $row['boardId']; ?>">삭제</a>

        <!-- 공개여부를 비공개 선택한 경우, 게시글 비밀번호 확인 후 일치시 view페이지, 불일치시 list페이지 이동 -->
       <?php
    } elseif ($row['privacy'] == '비공개') {
       ?>
        <script>
            var pw = <?=$row['contentsPassword']?>;
            var getPw = prompt("비밀번호 입력" + "");
            if(pw == getPw) {
                alert("확인완료");
                // 이미 이전에 비밀번호 확인 받고 view페이지 노출시키는건데 또 비밀번호 입력하라고 뜸 ㅠㅠ
                //location.replace('../QnA/QnA_view.php?id='.<?php //=$id?>//);
            } else {
                alert("잘못된 비밀번호 입니다");
                location.replace('../QnA/QnA_list.php');
            }
        </script>

        <a href="../QnA/QnA_update.php?id=<?= $row['boardId']; ?>">수정</a>
        <a href="../QnA/QnA_delete.php?id=<?= $row['boardId']; ?>">삭제</a>

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

        <tr>
            <!-- 댓글이 달리면 자동으로 답변완료, 안달리면 기본값 답변대기 (depth, thread ?) -->
            <th>답변여부</th>
            <td><?= $row['answer'] ?></td>

            <th>조회수</th>
            <td><?= $row['view']; ?></td>
        </tr>
        <tr>
            <th>작성내용</th>
            <td><?= $row['contents']; ?></td>
        </tr>

        <?php
        $sql = mysqli_query($conn,
            "select *, ifnull(joinId, '비회원') as commentName from (select * from comments where boardId = $id) as t1
            left join (select * from member) as t2
            on t1.commentName = t2.joinId;");

        while ($reply = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <th>댓글 작성자</th>
                <td><?= $reply['commentName'] ?></td>

                <?php
                if ($_SESSION['name'] == $reply['commentName']) {
                    ?>
                    <td>
                        <a href="../comment/reply_delete.php?replyId=<?= $reply['Id'] ?>&&boardId=<?= $reply['boardId'] ?>">댓글삭제</a>
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
        <form action="../comment/QnA_replyOk.php" method="get" name="QnA댓글쓰기">
            <input type="hidden" name="id" value="<?= $id ?>">
            <tr>
                <th>댓글입력</th>
                <td><?= $row['memberId'] ?></td>
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

<?php include_once "../footer.php"; ?>

