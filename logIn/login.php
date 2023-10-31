<?php include_once "C:/Apache24/htdocs/header.php";?>

<main>
    <h2>로그인</h2>
    <div>
        <form action="/logIn/ok.php" method="post">
            <p>ID : <input type="text" name="loginId"></p>
            <p>PW : <input type="password" name="loginPw"></p>
            <input type="submit" value="로그인">
        </form>
    </div>
    <button type="button" onclick="location.href='/join/join.php'">회원가입</button>
</main>

<?php include_once "C:/Apache24/htdocs/footer.php";?>

