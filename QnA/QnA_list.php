<?php
include_once "../header.php";
include_once "../dbConnect.php";

//$query = "select * from board order by boardId desc ";

$query = "select * , ifnull(joinId, '비회원') as memberId from board left join member on board.memberId = member.joinId order by boardId desc";
$result = mysqli_query($conn, $query);


?>

<main>
    <h2>QnA</h2>

    <div>
        <form action="../QnA/QnA_view.php" method="get">
        <select name="search">
            <option value="all">전체</option>
            <option value="name">작성자</option>
            <option value="title">제목</option>
            <option value="contents">내용</option>
        </select>
        <input type="text" name="searchText" value="">
        <button type="submit" onclick="location.href=''" value="">검색</button>
        </form>
    </div>

    <div>
        <a href="../QnA/QnA_create.php" target="_self">글쓰기</a>
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
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?=$row['boardId'] ?></td>
                <td><a href="../QnA/QnA_view.php?id=<?=$row['boardId'];?>"><?= $row['title']?></a></td>
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


<?php include_once "../footer.php"; ?>

