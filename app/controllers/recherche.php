<?php 





session_start(); 


require_once './body.php';  



generatehead('../../assets/css/main.css');
generateHeader('../../media/news.jpg', 'log_in.php', 'logout.php','../../favorites_list.php');
generatenav('');
rechercheformulaire();
generatefooter('../media/res.jpg');
generateboottraap(); 
?>