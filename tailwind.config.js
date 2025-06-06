import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            keyframes: {
                'ufo-float-away': {
                    '0%': { opacity: '1', transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                    '100%': { opacity: '0', transform: 'translateY(-40px)' },
                  },
              },
              animation: {
                'ufo-float-away': 'ufo-float-away 2s ease-in-out forwards',
              },
            fontFamily: {
                space: ['Orbitron', 'sans-serif'],
                jp: ['M PLUS 1p', 'sans-serif'],
            },
            colors: {
                'neon-blue': '#335fe2', 
                'night-deep-blue': '#0A121A', // 深い青みがかった黒
                'night-dark-green': '#081513', // 深い緑がかった黒
                'in-the-rain-darkest': '#050A0B', // ほとんど黒に近い、ごくわずかに青みがかった色
                'in-the-rain-mid': '#091518',    // 少し青みがかった深い暗い緑
                'in-the-rain-light': '#0D2224',  // さらにわずかに明るい青緑（光の源）
                // アクセントとなるネオンカラー (雨粒や光の表現に使えるかも)
                'neon-blue-light': '#8EE0FF', // 淡いネオンブルー
                'neon-green-light': '#00FFCC', // あなたのglow-greenの明るい方
                'neon-purple-light': '#BE82FF', // 幻想的なパープル
            },
            backgroundImage: {
                // 'In The Rain'

                'in-the-rain-bg': 'linear-gradient(to bottom, var(--tw-gradient-stops))', // Tailwind 3.x以降の書き方
                'in-the-rain-custom-gradient': 'linear-gradient(to bottom, #0A121A 0%, #03080F 80%, #010203 100%)', // より具体的な色指定
                'in-the-rain-alt-gradient': 'linear-gradient(to bottom, #081513 0%, #04090C 80%, #010203 100%)', // 緑寄りのグラデーション
                // 画像の雰囲気を再現するグラデーション
                'in-the-rain-bg-final': 'linear-gradient(to bottom, #0D2224 0%, #091518 50%, #050A0B 100%)',
                'in-the-rain-subtle-fade': 'linear-gradient(to bottom, #0D2224 0%, #091518 30%, #050A0B 70%, #020405 100%)',
            }
        },
    },

    plugins: [forms],
};
