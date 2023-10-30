<?php include_once "../header.php";
include_once "../dbConnect.php";

if ($login_success) {

    $memberNum = $_SESSION['memberNum'];
    $result = mysqli_query($conn, "select * from member where memberNum = $memberNum");
    $row = mysqli_fetch_array($result);
    ?>
    <main>
        <h2>마이페이지</h2>
        <!-- 수정버튼 누르면 비밀번호 인증 한번더 .. ? -->
        <button type="button" onclick="location.href='../myPage/myPage_update.php'">수정</button>
        <table>
            <tr>
                <th>ID</th>
                <td><?= $row['joinId'] ?></td>
            </tr>
            <tr>
                <th>활동 지역</th>
                <td><?= $row['liveIn'] ?></td>
            </tr>
            <tr>
                <th>인스타그램 아이디</th>
                <td><?= $row['snsId'] ?></td>
            </tr>
            <tr>
                <th>가입일</th>
                <td><?= $row['joinDate'] ?></td>
            </tr>
        </table>
    </main>
    <?php
} else {
    ?>
    <script>
        alert('로그인이 필요합니다');
        location.replace("../log/login.php");
    </script>
    <?php
}
?>