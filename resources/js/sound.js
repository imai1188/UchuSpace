// import * as Tone from 'tone';

// document.addEventListener('DOMContentLoaded', () => {
//     const playSoundButtons = document.querySelectorAll('.playSoundButton'); // クラスで取得

//     playSoundButtons.forEach(button => {
//         button.addEventListener('click', async () => {

//             // Tone.js を開始（ここでユーザーの操作が発生）
//             await Tone.start();

//             // 音を鳴らす
//             const synth = new Tone.Synth().toDestination();
//             synth.triggerAttackRelease('C4', '8n');
//         });
//     });
// });

// import * as Tone from 'tone';

// document.addEventListener('DOMContentLoaded', () => {
//     const playSoundButtons = document.querySelectorAll('.playSoundButton'); // 修正

//     console.log("playSoundButtons:", playSoundButtons);

//     if (playSoundButtons.length > 0) {
//         const pianoSampler = new Tone.Sampler({
//             urls: {
//                  "C4": "http://localhost:8000/audio/oborozuki.mp3"
//                 // "C4": "/audio/oborozuki.mp3"
//             },
//             release: 1,
//         }).toDestination();

//         pianoSampler.onload = () => {
//             console.log("サンプルがロードされました");

//             playSoundButtons.forEach(button => {
//                 console.log("ボタンにイベントリスナーを追加");
//                 button.addEventListener('click', async () => {
//                     console.log("ボタンがクリックされました");
//                     console.log("Tone.start() を呼び出し前:", Tone.context.state);
//                     await Tone.start();
//                     console.log("Tone.start() を呼び出し後:", Tone.context.state);
//                     pianoSampler.triggerAttackRelease('C4', '8n');
//                     console.log("音が再生されました");
//                 });
//             });
//         };

//         pianoSampler.onerror = (error) => {
//             console.error("音声サンプルのロード中にエラーが発生しました:", error);
//         };
//     } else {
//         console.error("playSoundButton が見つかりませんでした");
//     }
// });