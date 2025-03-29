import './bootstrap';
import './sound.js';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// function getBackgroundImage() {
//                     const now = new Date();
//                     const hour = now.getHours();
                
//                     if (hour >= 5 && hour < 12) {
//                         return '/images/morning.webp';
//                     } else if (hour >= 12 && hour < 18) {
//                         return '/images/afternoon.webp';
//                     } else {
//                         return '/images/evening.webp';
//                     }
//                 }
                
//                 // DOMContentLoaded イベントリスナーを追加
//                 document.addEventListener('DOMContentLoaded', function() {
//                     // body 要素の背景画像を設定
//                     document.body.style.backgroundImage = `url('${getBackgroundImage()}')`;
//                 });