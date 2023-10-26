<?php include "header.php"; ?>

    <main>
        <h2>QnA</h2>
        <form action="/QnA_ok.php" method="post" name="QnA글쓰기페이지">
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
                    <td>
                        <label>전체공개<input type="radio" name="공개여부" value="전체공개" checked="checked"></label>
                        <label>비공개<input type="radio" name="공개여부" value="비공개"></label>
                    </td>
                </tr>
                <tr>
                    <th>비밀번호</th>
                    <td><input type="number" name="password" value=""></td>
                </tr>
            </table>
            <input type="submit" value="등록하기">
        </form>
    </main>


<?php include "footer.php"; ?>