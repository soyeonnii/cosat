<?php
if(!session_id()) {
    session_start();
}
session_destroy(); ?>
<script>
    alert('로그아웃 되었습니다.')
    location.replace("/Qna_list.php");
</script>

