<?php

/**************************
 * Ceci contient  toute la structure et le css, les fonctions de la publicité
 * 
 * ********************************************************************************** */


 function publicite()
 {
     ?>
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Popup Ad</title>
         <style>
             body {
                 font-family: Arial, sans-serif;
                 margin: 0;
                 padding: 0;
             }
 
             .popup-ad {
                 position: fixed;
                 top: 50%;
                 left: 50%;
                 transform: translate(-50%, -50%);
                 background: #fff;
                 border: 2px solid #ccc;
                 box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                 z-index: 1000;
                 width: 300px;
                 padding: 20px;
                 text-align: center;
                 display: none;
             }
 
             .popup-ad img {
                 width: 100px;
                 height: 100px;
                 margin-bottom: 10px;
             }
 
             .popup-ad h2 {
                 font-size: 18px;
                 margin: 10px 0;
             }
 
             .popup-ad p {
                 font-size: 14px;
                 color: #555;
                 margin-bottom: 15px;
             }
 
             .popup-ad button {
                 padding: 10px 20px;
                 background: #007bff;
                 color: white;
                 border: none;
                 cursor: pointer;
                 font-size: 14px;
             }
 
             .popup-ad button:hover {
                 background: #0056b3;
             }
 
             .popup-overlay {
                 position: fixed;
                 top: 0;
                 left: 0;
                 width: 100%;
                 height: 100%;
                 background: rgba(0, 0, 0, 0.5);
                 z-index: 999;
                 display: none;
             }
         </style>
     </head>
     <body>
         <div class="popup-overlay" id="popupOverlay"></div>
 
         <!-- Popup Ad -->
         <div class="popup-ad" id="popupAd">
             <img src="https://lirp.cdn-website.com/fbdae4c0/dms3rep/multi/opt/Newswire_SocialNetworkImage-1920w.png" alt="Ad Image">
             <h2>Real News Delivered!</h2>
             <p>Get the latest real news straight to your inbox!</p>
             <button onclick="window.open('./View/controllers/recherche.php', '_blank')">Search More</button>
             <button onclick="closePopup()">Close</button>
         </div>
 
         <script>
             document.addEventListener('DOMContentLoaded', function () {
                 const popupAd = document.getElementById('popupAd');
                 const popupOverlay = document.getElementById('popupOverlay');
 
                 // Check if ad has been shown in the current session
                 const adShown = sessionStorage.getItem('adShown');
 
                 if (!adShown) {
                     // Show the popup after 2 seconds
                     setTimeout(() => {
                         popupAd.style.display = 'block';
                         popupOverlay.style.display = 'block';
                     }, 2000);
 
                     // Mark the ad as shown for this session
                     sessionStorage.setItem('adShown', 'true');
                 }
             });
 
             // Close the popup
             function closePopup() {
                 document.getElementById('popupAd').style.display = 'none';
                 document.getElementById('popupOverlay').style.display = 'none';
             }
         </script>
     </body>
     </html>
     <?php
 }
 
 ?>