<?php
	include 'db.php';
	
	$id = $_GET['id'];
	$sql = query("DELETE FROM board WHERE board_id='$id';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=index.php" />