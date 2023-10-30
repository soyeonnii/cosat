<?php include_once "../header.php";?>

<main>
<h2>회원가입</h2>
    <div>
        <form action="../join/join_ok.php" method="post">
        <p>ID : <input type="text" name="joinId"></p>
            <p>FW : <input type="password" name="joinPw"></p>
            <p>거주지 : <input type="text" name="liveIn"></p>
            <p>인스타 : <input type="text" name="snsId"></p>
            <input type="submit" value="회원가입">
        </form>
    </div>
</main>

<?php include_once "../footer.php";?>
