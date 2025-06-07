import * as THREE from "three";

let scene, camera, renderer;

window.addEventListener("DOMContentLoaded", init);

function init() {
    // シーンとカメラ
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 1000);
    camera.position.z = 400;

    // レンダラー
    renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.getElementById("particle-bg").appendChild(renderer.domElement);

    // パーティクルの設定
    const textureLoader = new THREE.TextureLoader();
    const particleTexture = textureLoader.load("/textures/1.png");

    const particleCount = 60;
    const positions = new Float32Array(particleCount * 3);
    const colors = new Float32Array(particleCount * 3);

    const colorOptions = [
    [0.0, 0.6, 1.0],  // ネオンブルー
    [0.2, 0.8, 1.0],  // エレクトリックブルー
    [0.0, 1.0, 1.0],  // サイアンブルー
    [0.2, 0.4, 1.0],  // コバルトブルー
    [0.3, 0.9, 0.9],  // ターコイズブルー
    [1.0, 0.5, 0.7],  // ベビーネオンピンク
    [0.95, 0.4, 0.65], // ミルキーネオンピンク
    ];

    const geometry = new THREE.BufferGeometry();
    for (let i = 0; i < particleCount; i++) {
        const i3 = i * 3;
        const color = colorOptions[Math.floor(Math.random() * colorOptions.length)];

        positions[i3] = (Math.random() - 0.5) * 1000;
        positions[i3 + 1] = (Math.random() - 0.5) * 1000;
        positions[i3 + 2] = (Math.random() - 0.5) * 1000;

        colors[i3] = color[0];
        colors[i3 + 1] = color[1];
        colors[i3 + 2] = color[2];
    }

    geometry.setAttribute("position", new THREE.BufferAttribute(positions, 3));
    geometry.setAttribute("color", new THREE.BufferAttribute(colors, 3));

    const material = new THREE.PointsMaterial({
        size: 2,
        map: particleTexture,
        transparent: true,
        depthWrite: false,
        blending: THREE.AdditiveBlending,
        vertexColors: true,
        sizeAttenuation: true
    });

    const points = new THREE.Points(geometry, material);
    scene.add(points);

    animate();
}

function animate() {
    requestAnimationFrame(animate);
    scene.rotation.y += 0.0001;
    scene.rotation.x += 0.0001;
    renderer.render(scene, camera);
}
