import * as THREE from "three";
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

let scene, camera, renderer, pointLight, controls, ballMesh;

window.addEventListener("load", () => {
    Promise.all([
        loadTexture("/textures/earth_night.jpg"),  
        loadTexture("/textures/1.png")
    ]).then(([earthTexture, particleTexture]) => {
        init(earthTexture, particleTexture);
    });
});

function loadTexture(path) {
    return new Promise((resolve) => {
        new THREE.TextureLoader().load(path, (texture) => {
            resolve(texture);
        });
    });
}

function init(earthTexture, particleTexture) {
    // シーン
    scene = new THREE.Scene();

    // カメラ
    camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set(0, 0, 500);

    // レンダラー
    renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    document.getElementById('three-container').appendChild(renderer.domElement);

    // 地球
    const ballGeometry = new THREE.SphereGeometry(100, 64, 32);
    const ballMaterial = new THREE.MeshPhysicalMaterial({ map: earthTexture });
    ballMesh = new THREE.Mesh(ballGeometry, ballMaterial);
    scene.add(ballMesh);

    // 光源
    const directionalLight = new THREE.DirectionalLight(0xffffff, 5);
    directionalLight.position.set(1, 1, 1);
    scene.add(directionalLight);

    pointLight = new THREE.PointLight(0xffffff, 1);
    pointLight.position.set(-200, -200, -200);
    scene.add(pointLight);

    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);

    // マウス操作
    controls = new OrbitControls(camera, renderer.domElement);

    // パーティクル
    const particlesGeometry = new THREE.BufferGeometry();
    const count = 170;
    const positionArray = new Float32Array(count * 3);
    const colorArray = new Float32Array(count * 3);

    const neonBlueShades = [
      [0.0, 0.6, 1.0],  // ネオンブルー
      [0.2, 0.8, 1.0],  // エレクトリックブルー
      [0.0, 1.0, 1.0],  // サイアンブルー
      [0.2, 0.4, 1.0],  // コバルトブルー
      [0.3, 0.9, 0.9],  // ターコイズブルー
      [1.0, 0.5, 0.7],  // ベビーネオンピンク
      [0.95, 0.4, 0.65], // ミルキーネオンピンク
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

    const pointMaterial = new THREE.PointsMaterial({
        size: 4,
        sizeAttenuation: false,
        depthTest: true,
        alphaMap: particleTexture,
        transparent: true,
        depthWrite: false,
        vertexColors: true,
        blending: THREE.AdditiveBlending,
    });

    const particles = new THREE.Points(particlesGeometry, pointMaterial);
    scene.add(particles);

    animate();
}

function animate() {
    rotation();
    pointLight.position.set(
        200 * Math.sin(Date.now() / 500),
        200 * Math.sin(Date.now() / 1000),
        200 * Math.cos(Date.now() / 500)
    );
    renderer.render(scene, camera);
    requestAnimationFrame(animate);
}

const rotation = () => {
    if (ballMesh) {
        ballMesh.rotation.y += 0.001;
    }
};
