import * as THREE from "three";
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

// グローバルに宣言
let scene, camera, renderer, pointLight, controls;

window.addEventListener("load", init);

function init() {
    // シーンを追加
    scene = new THREE.Scene();

    // カメラを追加
    camera = new THREE.PerspectiveCamera(
        50,
        window.innerWidth / window.innerHeight,
        0.1,
        1000
    );
    camera.position.set(0, 0, 500);

    // レンダラーを追加
    renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    document.getElementById('three-container').appendChild(renderer.domElement);

    // 平行光源を追加
    const directionalLight = new THREE.DirectionalLight(0xffffff, 7);
    directionalLight.position.set(1, 1, 1);
    scene.add(directionalLight);

    // ポイント光源
    pointLight = new THREE.PointLight(0xffffff, 1);
    pointLight.position.set(-100, -200, -200);
    scene.add(pointLight);

    // 環境光
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);

    // カメラ操作
    controls = new OrbitControls(camera, renderer.domElement);

    // パーティクル用のテクスチャ
    const textureLoader = new THREE.TextureLoader();
    const ParticlesTexture = textureLoader.load("/textures/1.png");

    // パーティクルジオメトリとカラー
    const particlesGeometry = new THREE.BufferGeometry();
    const count = 750;
    const positionArray = new Float32Array(count * 3);
    const colorArray = new Float32Array(count * 3);

    // ネオンブルー系の色
    const neonBlueShades = [
        [1.0, 0.5, 0.7], [0.0, 0.6, 1.0], [0.2, 0.8, 1.0], [0.0, 1.0, 1.0],
        [0.0, 0.3, 0.7], [0.2, 0.4, 1.0], [0.3, 0.9, 0.9], [0.6, 0.9, 1.0],
        [0.5, 1.0, 0.9], [0.6, 0.4, 1.0], [0.8, 1.0, 1.0], [1.0, 0.9, 0.5],
    ];

    const minDistance = 300;
    const maxDistance = 700;

    for (let i = 0; i < count; i++) {
        const i3 = i * 3;
        const color = neonBlueShades[Math.floor(Math.random() * neonBlueShades.length)];

        let x, y, z, distance;
        do {
            x = (Math.random() - 0.5) * 2 * maxDistance;
            y = (Math.random() - 0.5) * 2 * maxDistance;
            z = (Math.random() - 0.5) * 2 * maxDistance;
            distance = Math.sqrt(x * x + y * y + z * z);
        } while (distance < minDistance);

        positionArray[i3] = x;
        positionArray[i3 + 1] = y;
        positionArray[i3 + 2] = z;

        colorArray[i3] = color[0];
        colorArray[i3 + 1] = color[1];
        colorArray[i3 + 2] = color[2];
    }

    particlesGeometry.setAttribute("position", new THREE.BufferAttribute(positionArray, 3));
    particlesGeometry.setAttribute("color", new THREE.BufferAttribute(colorArray, 3));

    // マテリアル
    const pointMaterial = new THREE.PointsMaterial({
        size: 7,
        sizeAttenuation: false,
        depthTest: true,
        alphaMap: ParticlesTexture,
        transparent: true,
        depthWrite: false,
        vertexColors: true,
        blending: THREE.AdditiveBlending,
    });

    // パーティクル作成
    const Particles = new THREE.Points(particlesGeometry, pointMaterial);
    scene.add(Particles);

    animate();
}

function animate() {
    // 光源を動かす
    pointLight.position.set(
        200 * Math.sin(Date.now() / 500),
        200 * Math.sin(Date.now() / 1000),
        200 * Math.cos(Date.now() / 500),
    );

    renderer.render(scene, camera);
    requestAnimationFrame(animate);
}
