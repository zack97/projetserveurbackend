<?php 





session_start(); 


require_once './body.php';  


generatehead('../../assets/css/main.css');
generateHeader('../../database/press_media/media/news.jpg', 'log_in.php', 'logout.php','../../favorites_list.php');
generatenav('');
?>

<div class="full_recherche_content">
<?php rechercheformulaire();?>
</div>
<?php
generatefooter('../media/res.jpg');
generateboottraap(); 
?>