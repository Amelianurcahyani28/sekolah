<?php include 'header.php'; ?>

<style>
:root {
    --primary: #4f46e5;
    --secondary: #7c3aed;
    --accent: #ec4899;
    --bg-game: #f8fafc;
    --card-back: linear-gradient(135deg, #4f46e5, #9333ea);
    --glass-bg: rgba(255, 255, 255, 0.85);
    --glass-border: rgba(255, 255, 255, 0.4);
    --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.15);
}

.game-container {
    padding: 60px 0;
    background: radial-gradient(circle at top right, #e0e7ff, #f3e8ff, #fce7f3);
    min-height: 80vh;
    font-family: 'Nunito', 'Inter', sans-serif;
}

.game-header { text-align: center; margin-bottom: 40px; }
.game-header h1 { font-weight: 800; color: #1e293b; font-size: 3rem; margin-bottom: 10px; text-shadow: 2px 2px 4px rgba(0,0,0,0.05); letter-spacing: -1px; }

.nav-pills {
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--glass-border);
    padding: 10px;
    border-radius: 50px;
    box-shadow: var(--shadow-soft);
    display: inline-flex !important;
}

.nav-pills .nav-link {
    border-radius: 40px; padding: 12px 25px; font-weight: 700; color: #64748b;
    border: none; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); font-size: 1.1rem;
    position: relative; overflow: hidden;
    border-radius: 50px; padding: 12px 25px; font-weight: 700; color: #64748b;
    border: 2px solid transparent; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-size: 1rem;
}
.nav-pills .nav-link:hover {
    transform: translateY(-2px);
    color: var(--primary);
}
.nav-pills .nav-link.active {
    background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
    color: white !important; box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    transform: translateY(-2px);
}

.game-stats { display: flex; justify-content: center; gap: 20px; margin-bottom: 30px; }
.stat-box {
    background: rgba(255, 255, 255, 0.8); padding: 10px 25px; border-radius: 50px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.05); font-weight: 800; color: #475569;
    display: flex; align-items: center; gap: 10px; border: 1px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
    font-size: 1.1rem;
}
.stat-box span { color: var(--primary); font-size: 1.3rem; }
.stat-box span.text-danger { color: #ef4444 !important; }

/* Memory Game */
.memory-game { display: grid; grid-template-columns: repeat(4, 1fr); grid-gap: 15px; max-width: 480px; margin: 0 auto; perspective: 1000px; }
.memory-card { aspect-ratio: 1/1; position: relative; transform-style: preserve-3d; transition: transform .6s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
.memory-card:hover { transform: scale(1.05); }
.memory-card.flip { transform: rotateY(180deg); }
.front-face, .back-face { width: 100%; height: 100%; position: absolute; border-radius: 16px; backface-visibility: hidden; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; }
.front-face { background: rgba(255, 255, 255, 0.9); transform: rotateY(180deg); border: 2px solid #e2e8f0; }
.back-face { background: var(--card-back); color: white; border: 2px solid rgba(255,255,255,0.2); }

/* Common Game Card */
.game-card-custom {
    text-align: center; max-width: 550px; margin: 0 auto; 
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px);
    padding: 40px; border-radius: 40px; 
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    border: 1px solid rgba(255, 255, 255, 0.8);
}
.game-card-custom h5 { font-size: 1.5rem; font-weight: 800; color: #334155; margin-bottom: 20px; }

/* Color Game */
.target-color-box { width: 120px; height: 120px; border-radius: 30px; margin: 20px auto; border: 6px solid white; box-shadow: 0 10px 25px rgba(0,0,0,0.1); transition: background-color 0.3s; }
.options-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 30px; }
.color-btn { height: 80px; border-radius: 20px; border: 4px solid white; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
.color-btn:hover { transform: scale(1.05) translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15); }

/* Counting Game */
.count-display { 
    min-height: 140px; display: flex; flex-wrap: wrap; justify-content: center; 
    align-items: center; gap: 15px; font-size: 3.5rem; margin: 30px 0;
    background: rgba(255, 255, 255, 0.5); border-radius: 30px; padding: 25px;
    border: 2px dashed #cbd5e1;
}
.number-options { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
.num-btn { 
    height: 70px; border-radius: 20px; border: none; background: white;
    font-size: 1.8rem; font-weight: 800; color: #475569; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
}
.num-btn:hover { transform: translateY(-3px) scale(1.05); color: white; background: linear-gradient(135deg, #6366f1, #8b5cf6); box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3); }

/* Modal */
#result-modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(10px); z-index: 10000; align-items: center; justify-content: center; }
.modal-content { background: rgba(255, 255, 255, 0.95); padding: 50px; border-radius: 40px; text-align: center; max-width: 450px; width: 90%; animation: bounceIn .6s cubic-bezier(0.68, -0.55, 0.265, 1.55); box-shadow: 0 25px 50px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.8); }
@keyframes bounceIn { 0% { transform: scale(0.3); opacity: 0; } 50% { transform: scale(1.05); } 100% { transform: scale(1); opacity: 1; } }
.btn-restart { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; border: none; padding: 15px 40px; border-radius: 50px; font-weight: 800; font-size: 1.2rem; cursor: pointer; margin-top: 30px; transition: all 0.3s; box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4); }
.btn-restart:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 15px 30px rgba(99, 102, 241, 0.6); }
</style>

<div class="game-container">
    <div class="container">
        <div class="game-header">
            <span class="badge rounded-pill bg-primary px-3 py-2 mb-3">Taman Belajar Maessar</span>
            <h1>Dunia Bermain Anak</h1>
            
            <ul class="nav nav-pills justify-content-center mt-4 gap-2" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="pills-memory-tab" data-bs-toggle="pill" data-bs-target="#pills-memory" type="button" onclick="resetGame('memory')">🧠 Memori</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="pills-color-tab" data-bs-toggle="pill" data-bs-target="#pills-color" type="button" onclick="resetGame('color')">🎨 Warna</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="pills-count-tab" data-bs-toggle="pill" data-bs-target="#pills-count" type="button" onclick="resetGame('count')">🔢 Berhitung</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="pills-shape-tab" data-bs-toggle="pill" data-bs-target="#pills-shape" type="button" onclick="resetGame('shape')">🔺 Bentuk</button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <!-- Game 1: Memory -->
            <div class="tab-pane fade show active" id="pills-memory" role="tabpanel">
                <div class="game-stats">
                    <div class="stat-box">Gerakan: <span id="mem-moves">0</span></div>
                    <div class="stat-box">Waktu: <span id="mem-timer" class="text-danger">50s</span></div>
                </div>
                <div class="memory-game" id="mem-board"></div>
            </div>

            <!-- Game 2: Color -->
            <div class="tab-pane fade" id="pills-color" role="tabpanel">
                <div class="game-stats">
                    <div class="stat-box">Skor: <span id="col-score">0</span></div>
                    <div class="stat-box">Waktu: <span id="col-timer" class="text-danger">50s</span></div>
                </div>
                <div class="game-card-custom">
                    <h5>Samakan Warnanya!</h5>
                    <div class="target-color-box" id="target-color"></div>
                    <div class="options-grid" id="color-options"></div>
                </div>
            </div>

            <!-- Game 3: Counting -->
            <div class="tab-pane fade" id="pills-count" role="tabpanel">
                <div class="game-stats">
                    <div class="stat-box">Skor: <span id="cnt-score">0</span></div>
                    <div class="stat-box">Waktu: <span id="cnt-timer" class="text-danger">50s</span></div>
                </div>
                <div class="game-card-custom">
                    <h5>Ada Berapa Bendanya?</h5>
                    <div class="count-display" id="count-display"></div>
                    <div class="number-options" id="count-options">
                        <!-- Buttons 1-9 generated -->
                    </div>
                </div>
            </div>

            <!-- Game 4: Shape -->
            <div class="tab-pane fade" id="pills-shape" role="tabpanel">
                <div class="game-stats">
                    <div class="stat-box">Skor: <span id="shp-score">0</span></div>
                    <div class="stat-box">Waktu: <span id="shp-timer" class="text-danger">50s</span></div>
                </div>
                <div class="game-card-custom">
                    <h5>Pilih Bentuk: <br><span id="target-shape-name" style="color: var(--primary); font-weight: bold; font-size: 1.8rem; display: block; margin-top: 10px;"></span></h5>
                    <div class="options-grid" id="shape-options"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="result-modal">
    <div class="modal-content">
        <div id="res-icon" style="font-size: 6rem; margin-bottom: 20px; text-shadow: 0 10px 20px rgba(0,0,0,0.1);">🎉</div>
        <h2 id="res-title" style="font-weight: 800; color: #1e293b; font-size: 2.5rem; margin-bottom: 10px;">Hebat!</h2>
        <p id="res-body" style="color: #64748b; font-size: 1.2rem;">Kamu pintar sekali!</p>
        <button class="btn-restart" onclick="closeModal()">Main Lagi 🚀</button>
    </div>
</div>

<script>
let activeGame = 'memory';
let timerInterval;
let timeLeft = 50;

// Game State
const memoryEmojis = ['🐶', '🐱', '🐭', '🐹', '🐰', '🦊', '🦁', '🐯'];
let memFlipped = false, memLock = false, memFirst, memSecond, memMoves = 0, memPairs = 0;

const colorPalette = [
    { name: 'Merah', hex: '#ef4444' }, { name: 'Biru', hex: '#3b82f6' },
    { name: 'Hijau', hex: '#22c55e' }, { name: 'Kuning', hex: '#eab308' },
    { name: 'Ungu', hex: '#a855f7' }, { name: 'Oranye', hex: '#f97316' }
];
let colScore = 0, targetColor = null;

const countEmojis = ['🍎', '🍌', '⭐', '🎈', '🚗', '🧸', '🍦', '🍩'];
let cntScore = 0, currentCount = 0;

// Shape Game State
const shapes = [
    { name: 'Lingkaran', emoji: '🔴' },
    { name: 'Persegi', emoji: '🟩' },
    { name: 'Segitiga', emoji: '🔺' },
    { name: 'Bintang', emoji: '⭐' },
    { name: 'Hati', emoji: '❤️' },
    { name: 'Bulan', emoji: '🌙' },
    { name: 'Awan', emoji: '☁️' },
    { name: 'Matahari', emoji: '☀️' }
];
let shpScore = 0, targetShape = null;

// Timer
function startTimer(type) {
    clearInterval(timerInterval);
    timeLeft = 50;
    updateTimerUI(type);
    timerInterval = setInterval(() => {
        timeLeft--;
        updateTimerUI(type);
        if (timeLeft <= 0) { clearInterval(timerInterval); endGame(type, false); }
    }, 1000);
}

function updateTimerUI(type) {
    let id = 'mem-timer';
    if (type === 'color') id = 'col-timer';
    else if (type === 'count') id = 'cnt-timer';
    else if (type === 'shape') id = 'shp-timer';
    document.getElementById(id).textContent = timeLeft + 's';
}

// Memory Game
function initMemory() {
    const board = document.getElementById('mem-board');
    board.innerHTML = '';
    memMoves = 0; memPairs = 0; memFlipped = false; memLock = false; memFirst = null;
    document.getElementById('mem-moves').textContent = 0;
    let cards = [...memoryEmojis, ...memoryEmojis].sort(() => Math.random() - 0.5);
    cards.forEach(emoji => {
        const card = document.createElement('div');
        card.classList.add('memory-card');
        card.dataset.emoji = emoji;
        card.innerHTML = `<div class="front-face">${emoji}</div><div class="back-face"></div>`;
        card.onclick = flipCard;
        board.appendChild(card);
    });
    startTimer('memory');
}

function flipCard() {
    if (memLock || this === memFirst) return;
    this.classList.add('flip');
    if (!memFlipped) { memFlipped = true; memFirst = this; return; }
    memSecond = this;
    memMoves++; document.getElementById('mem-moves').textContent = memMoves;
    if (memFirst.dataset.emoji === memSecond.dataset.emoji) {
        memPairs++; if (memPairs === memoryEmojis.length) endGame('memory', true);
        memFirst.onclick = null; memSecond.onclick = null;
        [memFlipped, memLock] = [false, false]; memFirst = null;
    } else {
        memLock = true;
        setTimeout(() => { 
            memFirst.classList.remove('flip'); memSecond.classList.remove('flip'); 
            [memFlipped, memLock] = [false, false]; memFirst = null;
        }, 800);
    }
}

// Color Game
function initColor() {
    colScore = 0; document.getElementById('col-score').textContent = 0;
    nextColor(); startTimer('color');
}

function nextColor() {
    const targetEl = document.getElementById('target-color');
    const optionsEl = document.getElementById('color-options');
    optionsEl.innerHTML = '';
    targetColor = colorPalette[Math.floor(Math.random() * colorPalette.length)];
    targetEl.style.backgroundColor = targetColor.hex;
    let opts = [targetColor];
    while(opts.length < 4) {
        let r = colorPalette[Math.floor(Math.random() * colorPalette.length)];
        if(!opts.includes(r)) opts.push(r);
    }
    opts.sort(() => Math.random() - 0.5).forEach(o => {
        const b = document.createElement('button');
        b.classList.add('color-btn'); b.style.backgroundColor = o.hex;
        b.onclick = () => { if(o.hex === targetColor.hex) { colScore++; document.getElementById('col-score').textContent = colScore; nextColor(); } };
        optionsEl.appendChild(b);
    });
}

// Counting Game
function initCount() {
    cntScore = 0; document.getElementById('cnt-score').textContent = 0;
    const optsEl = document.getElementById('count-options');
    optsEl.innerHTML = '';
    for(let i=1; i<=9; i++) {
        const b = document.createElement('button');
        b.classList.add('num-btn'); b.textContent = i;
        b.onclick = () => checkCount(i);
        optsEl.appendChild(b);
    }
    nextCount(); startTimer('count');
}

function nextCount() {
    const display = document.getElementById('count-display');
    display.innerHTML = '';
    currentCount = Math.floor(Math.random() * 9) + 1;
    let emoji = countEmojis[Math.floor(Math.random() * countEmojis.length)];
    for(let i=0; i<currentCount; i++) {
        const s = document.createElement('span'); s.textContent = emoji;
        display.appendChild(s);
    }
}

function checkCount(num) {
    if(num === currentCount) { cntScore++; document.getElementById('cnt-score').textContent = cntScore; nextCount(); }
}

// Shape Game
function initShape() {
    shpScore = 0; document.getElementById('shp-score').textContent = 0;
    nextShape(); startTimer('shape');
}

function nextShape() {
    const nameEl = document.getElementById('target-shape-name');
    const optionsEl = document.getElementById('shape-options');
    optionsEl.innerHTML = '';
    targetShape = shapes[Math.floor(Math.random() * shapes.length)];
    nameEl.textContent = targetShape.name;
    
    let opts = [targetShape];
    while(opts.length < 4) {
        let r = shapes[Math.floor(Math.random() * shapes.length)];
        if(!opts.includes(r)) opts.push(r);
    }
    opts.sort(() => Math.random() - 0.5).forEach(o => {
        const b = document.createElement('button');
        b.classList.add('num-btn');
        b.style.fontSize = '2.5rem';
        b.textContent = o.emoji;
        b.onclick = () => { if(o.emoji === targetShape.emoji) { shpScore++; document.getElementById('shp-score').textContent = shpScore; nextShape(); } };
        optionsEl.appendChild(b);
    });
}

// Global
function endGame(type, won) {
    clearInterval(timerInterval);
    const modal = document.getElementById('result-modal');
    document.getElementById('res-icon').textContent = won ? '🎉' : '⏰';
    document.getElementById('res-title').textContent = won ? 'Hebat Sekali!' : 'Waktu Habis!';
    
    let scoreText = '';
    if (type === 'memory') {
        if (won) {
            scoreText = `Kamu berhasil menyelesaikannya dalam ${memMoves} gerakan dengan sisa waktu ${timeLeft} detik!`;
        } else {
            scoreText = `Waktu habis! Kamu baru menemukan ${memPairs} pasang gambar. Ayo coba lagi!`;
        }
    } else if (type === 'color') {
        scoreText = `Skor akhir kamu: ${colScore}! ` + (colScore > 0 ? 'Hebat!' : 'Ayo coba lagi!');
    } else if (type === 'count') {
        scoreText = `Skor akhir kamu: ${cntScore}! ` + (cntScore > 0 ? 'Hebat!' : 'Ayo coba lagi!');
    } else if (type === 'shape') {
        scoreText = `Skor akhir kamu: ${shpScore}! ` + (shpScore > 0 ? 'Hebat!' : 'Ayo coba lagi!');
    }
    
    document.getElementById('res-body').textContent = scoreText;
    modal.style.display = 'flex';
}

function resetGame(type) {
    activeGame = type;
    
    // Manual tab switching to ensure compatibility on hosting
    document.querySelectorAll('.tab-pane').forEach(el => {
        el.classList.remove('show', 'active');
    });
    document.querySelectorAll('.nav-link').forEach(el => {
        el.classList.remove('active');
    });
    
    const targetPane = document.getElementById('pills-' + type);
    const targetTab = document.getElementById('pills-' + type + '-tab');
    if (targetPane) targetPane.classList.add('show', 'active');
    if (targetTab) targetTab.classList.add('active');

    if (type === 'memory') initMemory();
    else if (type === 'color') initColor();
    else if (type === 'count') initCount();
    else if (type === 'shape') initShape();
}

function closeModal() { document.getElementById('result-modal').style.display = 'none'; resetGame(activeGame); }

document.addEventListener('DOMContentLoaded', initMemory);
</script>

<?php include 'footer.php'; ?>
