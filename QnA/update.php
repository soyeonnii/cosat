<?php include_once "C:/Apache24/htdocs/header.php";
include_once "C:/Apache24/htdocs/dbConnect.php";

$id = $_GET['id'];
//print_r($_GET);
$result = mysqli_query($conn, "select * from board where boardId = $id");
// in(select joinPw from member)
$row = mysqli_fetch_array($result);

?>

<main>
    <h2>QnA 수정</h2>

    <form action="/QnA/update_ok.php" id ="submit" method="post" name="QnA글수정페이지">
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
                <td><?= $row['updateAt'] ?></td>
            </tr>
            <tr>
                <th>내용</th>
                <td><textarea id="contents" name="contents"> <?= $row['contents'] ?> </textarea></td>
            </tr>
        </table>
        <input type="submit" value="수정하기">
<!--        <a href ='/QnA/update_ok.php' onclick="document.getElementById('submit').submit();">수정하기</a>-->


<!--        <?php
/*        //회원의 경우 본인(회원가입) 비밀번호 확인 완료시 수정/삭제 가능, 비회원의 경우 걍 수정/삭제 ..?
        $result2 = mysqli_query($conn, "select joinPw from member");
        $row2 = mysqli_fetch_array($result2);

        if ($_SESSION['memberNum']) {
            */?>
            <script>
                var pw = <?php /*=$row2['joinPw'] */?>;
                var getPw = prompt("비밀번호 입력" + "");
                if (pw == getPw) {
                    alert("확인완료");
                } else {
                    alert("잘못된 비밀번호 입니다");
                    location.href = '/QnA/list.php';
                }
            </script>
        <?php
/*        } else {
        */?>
            <script>
                var pw = <?php /*=$row['contentsPassword'] */?>;
                var getPw = prompt("비밀번호 입력" + "");
                if (pw == getPw) {
                    alert("확인완료");
                } else {
                    alert("잘못된 비밀번호 입니다");
                    location.href = '/QnA/list.php';
                }
            </script>
            --><?php
/*        }
        */?>


    </form>
</main>


<?php include_once "C:/Apache24/htdocs/footer.php"; ?>
