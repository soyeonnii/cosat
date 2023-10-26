<?php include "header.php";?>

<main>
    <h2>로그인</h2>
    <div>
        <form action="/login_ok.php" method="post">
            <p>ID : <input type="text" name="loginId"></p>
            <p>PW : <input type="password" name="loginPw"></p>
            <input type="submit" value="로그인">
        </form>
    </div>
    <button type="button" onclick="location.href='/join.php'">회원가입</button>
</main>

<?php include "footer.php";?>

