<?php include_once "../header.php";
include_once "../dbConnect.php";

$memberNum = $_SESSION['memberNum'];
$result = mysqli_query($conn, "select * from member where memberNum = $memberNum");
$row = mysqli_fetch_array($result);
?>

<main>
    <h2>마이페이지</h2>
    <form action="../myPage/myPage_update_ok.php" method="post" name="myPage_update">
        <input type="hidden" name="memberNum" value="<?= $row['memberNum']?>">
    <table>
        <tr>
            <th>ID</th>
            <td><input type="text" name="updateId" value="<?= $row['joinId'] ?>"></td>
        </tr>
        <tr>
            <th>활동 지역</th>
            <td><input type="text" name="updateLiveIn" value="<?= $row['liveIn'] ?>"></td>
        </tr>
        <tr>
            <th>인스타그램 아이디</th>
            <td><input type="text" name="updateSnsId" value="<?= $row['snsId'] ?>"></td>
        </tr>
        <tr>
            <th>가입일</th>
            <td><?= $row['joinDate'] ?></td>
        </tr>
    </table>
        <input type="submit" value="수정완료">
    </form>
</main>

<?php include "../footer.php" ?>
