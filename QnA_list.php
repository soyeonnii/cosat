<?php
include "header.php";
include "dbConnect.php";

$query = "select * from board order by boardId desc ";
$result = mysqli_query($conn, $query);
?>

<main>
    <h2>QnA</h2>

    <div>
        <form action="#" method="get">
        <select name="search">
            <option value="all">전체</option>
            <option value="name">작성자</option>
            <option value="title">제목</option>
            <option value="contents">내용</option>
        </select>
        <input type="text" name="serchText" value="">
        <button type="submit" onclick="location.href=''" value="">검색</button>
        </form>
    </div>

    <div>
        <a href="/QnA_create.php" target="_self">글쓰기</a>
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
        /* 1. while 을 이용해서 숫자를 ++ 한다 */
        /* 2. for문을 이용해서 숫자값을 넣어준다*/
        while ($row = mysqli_fetch_array($result)) {

        ?>
            <tr>
                <td><?=$row['boardId'] ?></td>
                <td><a href="/QnA_view.php?id=<?=$row['boardId'];?>"><?= $row['title']?></a></td>
                <td><?=$row['memberId']?></td>
                <td><?=$row['createAt']?></td>
                <td><?=$row['answer']?></td>
            </tr>

        <?php
        }
        ?>

        </tbody>
    </table>
</main>


<?php include "footer.php"; ?>

