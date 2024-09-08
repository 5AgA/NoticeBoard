<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $pw = isset($_POST['pw']) ? $_POST['pw'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;

    if ($email == null || $pw == null || $name == null) {
        echo "<script>alert('이메일, 비밀번호, 이름을 입력해주세요.'); location.href='register.php';</script>";
        exit();
    }

    $stmt = $db->prepare("SELECT COUNT(user_id) as cnt FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_count);
    $stmt->fetch();
    $stmt->close();

    if ($user_count == 1) {
        echo "<script>alert('이미 존재하는 이메일입니다.'); location.href='register.php';</script>";
        exit();
    }

    $bcrypt_pw = password_hash($pw, PASSWORD_BCRYPT);

    $sql = query("INSERT INTO user (user_email, user_pw, user_name) VALUES ('$email', '$bcrypt_pw', '$name')");

    if ($sql) {
        echo "<script>alert('회원가입 되었습니다.'); location.href='login.php';</script>";
    } else {
        echo "<script>alert('회원가입에 실패했습니다.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>회원가입</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login">
        <h1>회원가입</h1>
        <form method="post" action="register.php">
            <table>
                <tr>
                    <td style="text-align:right; font-weight:bolder;">이메일</td>
                    <td style="text-align:left;"><input type="email" name="email" required placeholder="이메일" size="40"></td>
                </tr>
                <tr>
                    <td style="text-align:right; font-weight:bolder;">비밀번호</td>
                    <td style="text-align:left;"><input type="password" name="pw" required placeholder="비밀번호" size="40"></td>
                </tr>
                <tr>
                    <td style="text-align:right; font-weight:bolder;">이름</td>
                    <td style="text-align:left;"><input type="text" name="name" required placeholder="이름" size="40"></td>
                </tr>
                <tr class="loginSubmit">
                    <td colspan="2"><input type="submit" value="회원가입"></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 15px;">이미 회원이신가요? <a href="login.php">로그인</a></td>
                </tr>
        </form>
    </div>
</body>
</html>