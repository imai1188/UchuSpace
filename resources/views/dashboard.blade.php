<x-app-layout>

    {{-- Three.js--}}
    <div id="three-container" style="width: 100%; height: 600px; opacity: 1;"></div>
    @vite('resources/js/dashboard.js')


     {{-- WELCOMEメッセージ --}}
     <div class="centered-message" style="display: none; opacity: 0; transition: opacity 1s;">
        <h2 class="font-semibold text-3xl welcome-msg leading-tight tracking-widest">
            {{ __('Welcome') }}<i class="fas fa-user-astronaut spacesuit spacesuit-floating"></i>
        </h2>
    </div>

    {{-- 投稿一覧へリダイレクト --}}
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                // 地球と星をフェードアウト
                const container = document.getElementById("three-container");
                container.style.transition = "opacity 2s ease";
                container.style.opacity = 0;

                // メッセージを表示
                const message = document.querySelector(".centered-message");
                message.style.display = "block";
                setTimeout(() => {
                    message.style.opacity = 1;
                }, 100); // 軽い遅延で自然な表示に

                // リダイレクト
                setTimeout(() => {
                document.body.style.transition = "opacity 1.5s ease";
                document.body.style.opacity = 0;

                setTimeout(() => {
                    window.location.href = "/post";
                }, 1500); 
            }, 3000);
        }, 7500);
    });
    </script>
    
</x-app-layout>
