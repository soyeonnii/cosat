<?php
include_once "C:/Apache24/htdocs/header.php";
include_once "C:/Apache24/htdocs/dbConnect.php";

//$query = "select * from board order by boardId desc ";

/*$query = "select * , ifnull(joinId, '비회원') as memberId from board left join member on board.memberId = member.joinId order by boardId desc";
$result = mysqli_query($conn, $query);*/

?>

<main>
    <h2>QnA</h2>
    <form action="/QnA/view.php" method="get">
        <div>
            <select name="search">
                <option value="all">전체</option>
                <option value="name">작성자</option>
                <option value="title">제목</option>
                <option value="contents">내용</option>
            </select>
            <input type="text" name="searchText" value="">
            <button type="submit" onclick="location.href=''" value="">검색</button>
        </div>
    </form>


    <div>
        <a href="/QnA/create.php" target="_self">글쓰기</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성자(ID)</th>
            <th>작성일자</th>
            <th>답변여부</th>
        </tr>
        </thead>

        <tbody>
        <?php

        //현재 페이지 번호
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        //한 페이지 당 보여질 게시글 시작 번호
        $start = ($current_page - 1) * 10;
        //한 페이지 당 보여질 게시글 끝 번호
        $end = $start + 10;

        $sql = "select *, date_format(createAt,'%Y/%m/%d') as createAt , ifnull(member.joinId, '비회원') as memberId from board
             left join member on board.memberId = member.joinId order by boardId desc limit $start, $end ";

        $result2 = mysqli_query($conn, $sql);
        //게시글 총 갯수
        $data_num = mysqli_num_rows($result2);
        //페이지 총 갯수 => 얘 왜 안되는겨
        $page_num = ceil($data_num / 10);
        //글 번호
        $board_count = $start + 1;

        //list에서 작성일자 날짜랑 시간 두줄로 보이게
        /*$sql2 = "select *, date_format(createAt,'%h:%m:%s') as createAt from board order by boardId desc";
        date_default_timezone_set('Asia/Seoul');
        $result3 = mysqli_query($conn, $sql2);
        $row3 = mysqli_fetch_array($result3);*/

        while ($row2 = mysqli_fetch_array($result2)) {
            ?>
            <tr>
                <td><?= $board_count ?></td>
                <td><a href="/QnA/view.php?id=<?= $row2['boardId']; ?>&pw_check=N"><?= $row2['title'] ?></a></td>
                <td><?= $row2['memberId'] ?></td>
                <td><?= $row2['createAt'] ?><br><?= $row3['createAt'] ?></td>

                <!-- 댓글 있으면 답변완료, 없으면 답변대기 -->
                <td><?= $row2['answer'] ?></td>
            </tr>
            <?php
            $board_count++;
        }
        ?>
        </tbody>
    </table>

    <form method="get">
        <?php
        //이전 페이지
        if($current_page <= 1) {
            ?> <a href="/QnA/list.php?page=1">이전</a>
        <?php
        } else {
            ?> <a href="/QnA/list.php?page=<?= $current_page - 1 ?>">이전</a>
        <?php
        }

        //페이지 번호 출력
        $page_num = ($data_num / 10) + 1;
        for ($i = 1; $i <= $page_num; $i = $i + 1) {
            echo "<input type = 'submit' name='page' value='$i'>";
        }

        //다음 페이지
        if($current_page >= $page_num) {
        ?> <a href="/QnA/list.php?page=<?= $current_page ?>">다음</a>
        <?php
        } else {
            ?> <a href="/QnA/list.php?page=<?= $current_page + 1?>">다음</a>
        <?php
        }
        ?>
    </form>

</main>

<?php include_once "C:/Apache24/htdocs/footer.php"; ?>

