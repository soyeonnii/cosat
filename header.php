<?php
session_start();
//세션의 loginId값이 있다면(로그인 상태라면) true할당
if (isset($_SESSION['name'])) {
    $login_success = TRUE;
}
?>
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>Cosat</title>

        <style>
            h1 {
                font-size: 50px;
                color: black;
                text-align: center;
            }

            .menu {
                font-size: small;
                color: black;
                text-align: right;
            }

            header {
                background-color: lightgrey;
                width: 100%;
                height: 300px;
            }

            .naviBar li a {
                background-color: text-decoration: none;
                font-weight: bold;
                color: black;
                display: block;
                text-align: center;
                padding: 10px;
            }

            .naviBar {
                list-style: none;
                float: left;
                width: 100%;
                height: 70px;
            }

            .naviBar ul li a {
                display: block;
                text-align: center;
            }
        </style>
    </head>
<body>
<?php
if ($login_success) {
    ?>
    <header>
        <div>
            <h1><a href="#메인페이지">Cosat</a></h1>
            <div class="menu">
                <p><?= $_SESSION['name'] . '님' ?></p>
                <a href="/myPage.php">마이페이지</a>
                <a href="/logout.php">로그아웃</a>
            </div>

            <nav>
                <ul class="naviBar">
                    <li><a href="/QnA_list.php">QnA</a></li>
                    <li><a href="#가입신청">가입신청</a></li>
                    <li><a href="#최근활동">최근활동</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <?php
} else {
    ?>
    <header>
        <div>
            <h1><a href="#메인페이지">Cosat</a></h1>
            <div class="menu">
                <a href="/login.php">로그인</a>
                <a href="/join.php">회원가입</a>
                <a href="/myPage.php">마이페이지</a>
            </div>

            <nav>
                <ul class="naviBar">
                    <li><a href="/QnA_list.php">QnA</a></li>
                    <li><a href="#가입신청">가입신청</a></li>
                    <li><a href="#최근활동">최근활동</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php
}
?>