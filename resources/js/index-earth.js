import * as THREE from "three";

let scene, camera, renderer;
let earthMesh, moonMesh;

window.addEventListener("DOMContentLoaded", init);

function init() {
    const container = document.getElementById('three-index');
    const width = container.clientWidth;
    const height = container.clientHeight;
   // ローディングマネージャー
    const manager = new THREE.LoadingManager();
    const textureLoader = new THREE.TextureLoader(manager);
    const earthTexture = textureLoader.load("/textures/earth.jpg");
    const moonTexture = textureLoader.load("/textures/moon.jpg");

    manager.onLoad = function () {
    // シーンとカメラ
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(40, width / height, 0.1, 9000);
    camera.position.set(350, 0, 400);
    camera.lookAt(new THREE.Vector3(90, 0, 0)); // 地球と月の間あたりを見る

    // レンダラー
    renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(window.devicePixelRatio);
    container.appendChild(renderer.domElement);

    // 地球
    const earthGeo = new THREE.SphereGeometry(100, 64, 32);
    const earthMat = new THREE.MeshStandardMaterial({ map: earthTexture });
    earthMesh = new THREE.Mesh(earthGeo, earthMat);
    scene.add(earthMesh);

    // 月
    const moonGeo = new THREE.SphereGeometry(35, 64, 32);
    const moonMat = new THREE.MeshStandardMaterial({ map: moonTexture });
    moonMesh = new THREE.Mesh(moonGeo, moonMat);
    moonMesh.position.set(220, 0, 0); // 地球から右方向に少し
    scene.add(moonMesh);

    // 光源
    const light = new THREE.DirectionalLight(0xffffff, 4);
    light.position.set(1, 1, 1);
    scene.add(light);

    animate();
};
}

function animate() {
    earthMesh.rotation.y += 0.001;
    moonMesh.rotation.y += 0.002; 

    renderer.render(scene, camera);
    requestAnimationFrame(animate);
}


