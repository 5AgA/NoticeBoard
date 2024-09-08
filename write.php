<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Validate the input
    if (empty($title) || empty($content)) {
        echo "빈칸을 채워주세요";
    } else {
        $sql = "INSERT INTO board (board_title, board_content, user_id) VALUES ('$title', '$content', '$_SESSION[id]')";
        query($sql);
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>글쓰기</title>
</head>
<body>
    <div class="write">
        <h1>글을 작성하세요</h1>
        <hr/>
        <form method="POST" action="write.php">
            <table class="writeTable">
                <tr>
                    <th width="50">제목</th>
                    <td><input type="text" name="title" placeholder="제목을 입력하세요" required></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td><textarea name="content" rows="5" cols="40" placeholder="내용을 입력하세요" required ></textarea></td>
                </tr>
            </table>
            <ul>
                <li><button type="button" onclick="location.href='index.php'">취소</button></li>
                <li><input class="button" type="submit" value="작성 완료"></li>
            </ul>
        </form>
    </div>
</body>
</html>