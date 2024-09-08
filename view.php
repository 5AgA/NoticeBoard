<?php include 'db.php'; ?> 
<!DOCTYPE html>
<html>
<head>
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        $id = $_GET['id'];
        $views = query("UPDATE board SET board_views = board_views + 1 WHERE board_id = $id");
        $sql = query("SELECT * FROM board WHERE board_id = $id");
        $board = $sql->fetch_array();  
        $row = $sql->fetch_array();
    ?>

    <div class="view">
        <h2><?php echo $board['board_title']; ?></h2>
        <div class="user_info">
            <p><b>작성자 </b>
                <?php 
                $user_sql = query("SELECT user_name FROM user WHERE user_id = " . $board['user_id']);
                $user_data = $user_sql->fetch_array();  
                $user_name = $user_data['user_name']; 
                echo $user_name; ?>  |  <?php echo $board['board_date']; ?>  |  <b>조회수</b> <?php echo $board['board_views']; ?></p>
        </div>

        <hr>
        
        <div class="content">
            <?php echo nl2br($board['board_content']); ?>
        </div>

        <div class="viewButton">
            <ul>
                <li><button onclick="location.href='index.php'">목록</button></li>
                <?php
                    if ($board['user_id'] == $_SESSION['id']) { ?>
                <li><button onclick="location.href='modify.php?id=<?php echo $board['board_id']; ?>'">수정</button></li>
                <li><button onclick="location.href='delete.php?id=<?php echo $board['board_id']; ?>'">삭제</button></li>  
                <?php } ?>
            </ul>
        </div>
    </div>
</body>