<?php include_once "C:/Apache24/htdocs/header.php";

?>

    <main>
        <h2>QnA</h2>
        <form action="/QnA/ok.php" method="post" name="QnA글쓰기페이지">
            <table>
                <tr>
                    <th>제목</th>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <th>작성자(ID)</th>
                    <?php
                    if ($login_success) {
                        ?>
                        <td><?= $_SESSION['name'] ?></td>
                        <?php
                    } else {
                        ?>
                        <td>비회원</td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <th>작성일</th>
                    <?php date_default_timezone_set('Asia/Seoul'); ?>
                    <td><?= date('Y-m-d H:i:s') ?></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td><textarea id="contents" name="contents" placeholder="내용을 입력하세요."></textarea></td>
                </tr>
                <tr>
                    <!-- 비회원인경우 공개여부 기본값이 비공개(무조건) , 회원(로그인완료)의 경우 전체공개가 기본값, 전체공개 비공개 선택가능 -->
                    <?php
                    if (!$_SESSION['memberNum']) {
                        ?>
                        <td>
                            <label> 비공개<input type="radio" name="공개여부" value="비공개" checked="checked"></label>
                        </td>
                        <?php
                    } else {
                        ?>
                        <td>
                            <label> 전체공개<input type="radio" name="공개여부" value="전체공개" checked="checked"></label>
                            <label> 비공개<input type="radio" name="공개여부" value="비공개"></label>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <!-- 입력값이 없어도 등록가능하게 ? or 공개여부를 전체공개 선택시 비밀번호input안뜨고, 비공개선택시 비밀번호input뜨게? -->
                    <th>비밀번호</th>
                    <td><input type="number" name="password" value=""></td>
                </tr>
            </table>
            <input type="submit" value="등록하기">
        </form>
    </main>


<?php include_once "C:/Apache24/htdocs/footer.php"; ?>