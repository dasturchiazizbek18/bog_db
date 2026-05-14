<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bog' Tizimi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green-50:  #EAF3DE;
      --green-100: #C0DD97;
      --green-400: #639922;
      --green-600: #3B6D11;
      --green-800: #27500A;
      --green-900: #173404;
      --gray-bg:   #f6f4ef;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--gray-bg);
      min-height: 100vh;
      color: #2a2a2a;
    }

    /* Stats strip */
    .stats {
      display: flex;
      justify-content: center;
      background: var(--green-900);
    }
    .stat-item {
      flex: 1;
      max-width: 160px;
      padding: 1rem .75rem;
      text-align: center;
      color: var(--green-50);
    }
    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      font-weight: 700;
      line-height: 1;
    }
    .stat-label {
      font-size: 11px;
      opacity: .6;
      text-transform: uppercase;
      letter-spacing: .08em;
      margin-top: 3px;
    }

    /* Section title */
    .section-title {
      text-align: center;
      padding: 2rem 1rem .75rem;
    }
    .section-title h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--green-900);
    }
    .section-title p { font-size: 14px; color: #777; margin-top: .35rem; }

    /* Grid */
    .trees-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
      gap: 1.25rem;
      padding: 0 1.5rem 3rem;
      max-width: 950px;
      margin: 0 auto;
    }

    .tree-card {
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid rgba(0,0,0,.07);
      transition: transform .2s, box-shadow .2s;
    }
    .tree-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 32px rgba(0,0,0,.1);
    }

    .card-top {
      padding: 1.25rem 1.25rem .75rem;
      display: flex;
      align-items: flex-start;
      gap: .85rem;
    }
    .card-icon {
      width: 48px; height: 48px;
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.5rem;
      flex-shrink: 0;
    }
    .card-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      font-weight: 500;
      margin-bottom: 4px;
    }
    .card-badge {
      display: inline-block;
      font-size: 11px;
      letter-spacing: .06em;
      text-transform: uppercase;
      padding: 2px 10px;
      border-radius: 20px;
      font-weight: 500;
    }

    .card-divider { height: 1px; background: #f0eeea; margin: 0 1.25rem; }

    .card-body { padding: .85rem 1.25rem; }
    .info-row {
      display: flex; align-items: center; gap: 8px;
      font-size: 13px; color: #555; padding: 5px 0;
    }
    .info-row svg { width:15px; height:15px; color:#bbb; flex-shrink:0; }
    .info-row strong { margin-left: auto; color: #2a2a2a; font-weight: 500; }

    .fruit-pill {
      margin: .6rem 1.25rem 1rem;
      padding: .5rem .9rem;
      border-radius: 10px;
      font-size: 13px;
      display: flex; align-items: center; gap: 8px;
    }
    .fruit-pill .pill-emoji { margin-left: auto; font-size: 17px; }

    .progress-wrap { padding: 0 1.25rem .2rem; }
    .progress-label {
      display: flex; justify-content: space-between;
      font-size: 11px; color: #aaa; margin-bottom: 4px;
    }
    .progress-bar-bg {
      height: 5px; background: #f0eeea;
      border-radius: 99px; overflow: hidden;
    }
    .progress-bar-fill {
      height: 100%; border-radius: 99px;
      transition: width .8s cubic-bezier(.4,0,.2,1);
    }

    .grow-btn {
      display: block;
      width: calc(100% - 2.5rem);
      margin: 0 1.25rem 1.25rem;
      padding: .55rem 1rem;
      border-radius: 10px; border: 1.5px solid;
      background: transparent;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px; font-weight: 500;
      cursor: pointer;
      transition: background .15s, color .15s;
    }

    @keyframes growPop {
      0%   { transform: scale(1); }
      40%  { transform: scale(1.2); }
      70%  { transform: scale(.93); }
      100% { transform: scale(1); }
    }
    .growing .card-icon { animation: growPop .5s ease forwards; }

    /* Add panel */
    .add-panel {
      max-width: 950px;
      margin: 0 auto 3rem;
      padding: 0 1.5rem;
    }
    .add-panel-inner {
      background: #fff;
      border-radius: 16px;
      border: 1.5px dashed rgba(63,109,17,.3);
      padding: 1.5rem 1.75rem;
    }
    .add-panel-header {
      display: flex; align-items: center; gap: 10px;
      margin-bottom: 1.1rem;
    }
    .add-panel-header h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.05rem; font-weight: 500;
      color: var(--green-900);
    }
    .add-icon {
      width: 32px; height: 32px; border-radius: 9px;
      background: var(--green-50);
      display: flex; align-items: center; justify-content: center;
      font-size: 1rem;
    }
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr auto;
      gap: 10px; align-items: end;
    }
    .form-group label {
      display: block; font-size: 11px;
      text-transform: uppercase; letter-spacing: .06em;
      color: #999; margin-bottom: 5px;
    }
    .form-group input,
    .form-group select {
      width: 100%; padding: .5rem .8rem;
      border: 1px solid #e0ddd6; border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px; background: #fafaf8; color: #2a2a2a;
      outline: none; transition: border-color .15s;
    }
    .form-group input:focus,
    .form-group select:focus {
      border-color: var(--green-400); background: #fff;
    }
    .add-btn {
      padding: .52rem 1.3rem; border-radius: 10px;
      border: none; background: var(--green-600); color: #fff;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px; font-weight: 500;
      cursor: pointer; transition: background .15s, transform .1s;
      white-space: nowrap;
    }
    .add-btn:hover  { background: var(--green-800); }
    .add-btn:active { transform: scale(.97); }

    .error-msg { font-size: 12px; color: #c0392b; margin-top: 7px; min-height: 16px; }

    @media (max-width: 580px) {
      .form-row { grid-template-columns: 1fr 1fr; }
      .form-row .add-btn { grid-column: 1 / -1; }
    }

    footer {
      text-align: center; padding: 1.5rem;
      font-size: 12px; color: #bbb;
      border-top: 1px solid #ebe9e3;
    }
  </style>
</head>
<body>

<?php
require 'db.php';

/* ── Classlar ── */
class Garden {
    public string $name;
    public string $location;
    public function __construct(string $name, string $location) {
        $this->name = $name; $this->location = $location;
    }
}
class Tree {
    public string $treeName;
    public int    $fruitCount;
    public function __construct(string $treeName, int $fruitCount) {
        $this->treeName = $treeName; $this->fruitCount = $fruitCount;
    }
}
class AppleTree extends Tree {
    public function type(): string      { return 'apple';  }
    public function emoji(): string     { return '🍎';     }
    public function fruitName(): string { return 'Olma';   }
}
class CherryTree extends Tree {
    public function type(): string      { return 'cherry'; }
    public function emoji(): string     { return '🍒';     }
    public function fruitName(): string { return 'Gilos';  }
}

/* ── Emoji / type xaritasi ── */
$emojiMap = [
    'Olma'     => ['emoji'=>'🍎','type'=>'apple'],
    'Gilos'    => ['emoji'=>'🍒','type'=>'cherry'],
    'Nok'      => ['emoji'=>'🍐','type'=>'pear'],
    'Shaftoli' => ['emoji'=>'🍑','type'=>'peach'],
    "O'rik"    => ['emoji'=>'🍑','type'=>'peach'],
    'Uzum'     => ['emoji'=>'🍇','type'=>'grape'],
    'Anor'     => ['emoji'=>'🍎','type'=>'apple'],
];

$COLORS = [
    'apple'  => ['bg'=>'#FAECE7','border'=>'#D85A30','text'=>'#4A1B0C','fill'=>'#D85A30'],
    'cherry' => ['bg'=>'#E1F5EE','border'=>'#1D9E75','text'=>'#085041','fill'=>'#1D9E75'],
    'pear'   => ['bg'=>'#FAEEDA','border'=>'#BA7517','text'=>'#633806','fill'=>'#BA7517'],
    'peach'  => ['bg'=>'#FBEAF0','border'=>'#D4537E','text'=>'#4B1528','fill'=>'#D4537E'],
    'grape'  => ['bg'=>'#EEEDFE','border'=>'#7F77DD','text'=>'#26215C','fill'=>'#7F77DD'],
];

/* ── DB dan daraxtlarni olish ── */
$garden = new Garden("Azizbek bog'i", "Toshkent");
$stmt   = $pdo->query("SELECT * FROM daraxtlar ORDER BY id");
$rows   = $stmt->fetchAll();

$trees = [];
foreach ($rows as $row) {
    $m = $emojiMap[$row['meva_turi']] ?? ['emoji'=>'🌳','type'=>'apple'];
    $trees[] = [
        'id'         => $row['id'],
        'treeName'   => $row['daraxt_nomi'],
        'fruitName'  => $row['meva_turi'],
        'fruitCount' => (int)$row['meva_soni'],
        'emoji'      => $m['emoji'],
        'type'       => $m['type'],
    ];
}
$total = array_sum(array_column($trees, 'fruitCount'));
?>

<!-- Stats -->
<div class="stats">
  <div class="stat-item">
    <div class="stat-num" id="stat-count"><?= count($trees) ?></div>
    <div class="stat-label">Daraxt turi</div>
  </div>
  <div class="stat-item">
    <div class="stat-num" id="stat-total"><?= $total ?></div>
    <div class="stat-label">Jami meva</div>
  </div>
  <div class="stat-item">
    <div class="stat-num"><?= date('Y') ?></div>
    <div class="stat-label">Yil</div>
  </div>
</div>

<!-- Section title -->
<div class="section-title">
  <h2>🌿 <?= htmlspecialchars($garden->name) ?></h2>
  <p><?= htmlspecialchars($garden->location) ?> — daraxtlar va mevalar ro'yxati</p>
</div>

<!-- Cards -->
<div class="trees-grid" id="trees-grid">
<?php foreach ($trees as $i => $tree):
  $type = $tree['type'];
  $c    = $COLORS[$type] ?? $COLORS['apple'];
  $pct  = $total > 0 ? round($tree['fruitCount'] / $total * 100) : 0;
?>
  <div class="tree-card" id="card-<?= $i ?>" data-tree-idx="<?= $i ?>">
    <div class="card-top">
      <div class="card-icon" style="background:<?= $c['bg'] ?>"><?= $tree['emoji'] ?></div>
      <div>
        <div class="card-name"><?= htmlspecialchars($tree['treeName']) ?></div>
        <span class="card-badge" style="background:<?= $c['bg'] ?>;color:<?= $c['text'] ?>">
          <?= htmlspecialchars($tree['fruitName']) ?>
        </span>
      </div>
    </div>

    <div class="progress-wrap">
      <div class="progress-label">
        <span>Meva ulushi</span>
        <span class="pct-label"><?= $pct ?>%</span>
      </div>
      <div class="progress-bar-bg">
        <div class="progress-bar-fill" style="width:<?= $pct ?>%;background:<?= $c['fill'] ?>"></div>
      </div>
    </div>

    <div class="card-divider" style="margin-top:.7rem"></div>
    <div class="card-body">
      <div class="info-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
        </svg>
        Holati <strong>O'smoqda 🌱</strong>
      </div>
      <div class="info-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2z"/>
        </svg>
        Mevalar soni <strong><?= $tree['fruitCount'] ?> dona</strong>
      </div>
    </div>

    <div class="fruit-pill" style="background:<?= $c['bg'] ?>;color:<?= $c['text'] ?>">
      <?= htmlspecialchars($tree['fruitName']) ?> berdi
      <span class="pill-emoji"><?= $tree['emoji'] ?></span>
    </div>

    <button class="grow-btn"
      style="border-color:<?= $c['border'] ?>;color:<?= $c['border'] ?>"
      onmouseover="this.style.background='<?= $c['border'] ?>';this.style.color='#fff'"
      onmouseout="this.style.background='transparent';this.style.color='<?= $c['border'] ?>'"
      onclick="growTree(<?= $i ?>)">
      O'stirish simulyatsiyasi ▸
    </button>
  </div>
<?php endforeach; ?>
</div>

<!-- Add panel -->
<div class="add-panel">
  <div class="add-panel-inner">
    <div class="add-panel-header">
      <div class="add-icon">🌳</div>
      <h3>Yangi daraxt qo'shish</h3>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Daraxt nomi</label>
        <input type="text" id="inp-name" placeholder="Nok daraxti" maxlength="40">
      </div>
      <div class="form-group">
        <label>Turi</label>
        <select id="inp-type">
          <option value="apple">🍎 Olma</option>
          <option value="cherry">🍒 Gilos</option>
          <option value="pear">🍐 Nok</option>
          <option value="peach">🍑 Shaftoli</option>
          <option value="grape">🍇 Uzum</option>
        </select>
      </div>
      <div class="form-group">
        <label>Meva soni</label>
        <input type="number" id="inp-count" placeholder="40" min="1" max="9999">
      </div>
      <button class="add-btn" onclick="addTree()">+ Qo'shish</button>
    </div>
    <div class="error-msg" id="err-msg"></div>
  </div>
</div>

<footer>PHP OOP — Bog' tizimi &copy; <?= date('Y') ?></footer>

<script>
const TYPES = {
  apple:  { emoji:'🍎', label:'Olma'     },
  cherry: { emoji:'🍒', label:'Gilos'    },
  pear:   { emoji:'🍐', label:'Nok'      },
  peach:  { emoji:'🍑', label:'Shaftoli' },
  grape:  { emoji:'🍇', label:'Uzum'     },
};
const COLORS = {
  apple:  { bg:'#FAECE7', border:'#D85A30', text:'#4A1B0C', fill:'#D85A30' },
  cherry: { bg:'#E1F5EE', border:'#1D9E75', text:'#085041', fill:'#1D9E75' },
  pear:   { bg:'#FAEEDA', border:'#BA7517', text:'#633806', fill:'#BA7517' },
  peach:  { bg:'#FBEAF0', border:'#D4537E', text:'#4B1528', fill:'#D4537E' },
  grape:  { bg:'#EEEDFE', border:'#7F77DD', text:'#26215C', fill:'#7F77DD' },
};

let treeIndex = <?= count($trees) ?>;
let treesData = [<?php foreach ($trees as $t): ?>{ fruitCount:<?= (int)$t['fruitCount'] ?> },<?php endforeach; ?>];

function getTotal()  { return treesData.reduce((s,t) => s + t.fruitCount, 0); }

function updateAll() {
  const total = getTotal();
  document.getElementById('stat-count').textContent = treesData.length;
  document.getElementById('stat-total').textContent = total;
  document.querySelectorAll('[data-tree-idx]').forEach(card => {
    const idx = parseInt(card.dataset.treeIdx);
    const pct = total > 0 ? Math.round(treesData[idx].fruitCount / total * 100) : 0;
    card.querySelector('.progress-bar-fill').style.width = pct + '%';
    card.querySelector('.pct-label').textContent = pct + '%';
  });
}

function growTree(i) {
  const card = document.getElementById('card-' + i);
  card.classList.add('growing');
  setTimeout(() => card.classList.remove('growing'), 600);
}

async function addTree() {
  const nameEl  = document.getElementById('inp-name');
  const typeEl  = document.getElementById('inp-type');
  const countEl = document.getElementById('inp-count');
  const errEl   = document.getElementById('err-msg');

  const name  = nameEl.value.trim();
  const type  = typeEl.value;
  const count = parseInt(countEl.value);

  errEl.textContent = '';
  if (!name)               { errEl.textContent = 'Daraxt nomini kiriting!'; return; }
  if (!count || count < 1) { errEl.textContent = 'Meva sonini kiriting!';  return; }

  const label = TYPES[type].label;
  const fd    = new FormData();
  fd.append('name',  name);
  fd.append('fruit', label);
  fd.append('count', count);

  const btn = document.querySelector('.add-btn');
  btn.disabled = true;
  btn.textContent = 'Saqlanmoqda...';

  try {
    const res  = await fetch('add_tree.php', { method:'POST', body:fd });
    const data = await res.json();

    if (!data.success) { errEl.textContent = data.message; return; }

    /* UI ga karta qo'sh */
    const idx = treeIndex++;
    treesData.push({ fruitCount: count });
    const total = getTotal();
    const pct   = Math.round(count / total * 100);
    const t = TYPES[type], c = COLORS[type];

    const card = document.createElement('div');
    card.className = 'tree-card';
    card.id = 'card-' + idx;
    card.dataset.treeIdx = idx;
    card.innerHTML = `
      <div class="card-top">
        <div class="card-icon" style="background:${c.bg}">${t.emoji}</div>
        <div>
          <div class="card-name">${name}</div>
          <span class="card-badge" style="background:${c.bg};color:${c.text}">${label}</span>
        </div>
      </div>
      <div class="progress-wrap">
        <div class="progress-label">
          <span>Meva ulushi</span><span class="pct-label">${pct}%</span>
        </div>
        <div class="progress-bar-bg">
          <div class="progress-bar-fill" style="width:${pct}%;background:${c.fill}"></div>
        </div>
      </div>
      <div class="card-divider" style="margin-top:.7rem"></div>
      <div class="card-body">
        <div class="info-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
          Holati <strong>O'smoqda 🌱</strong>
        </div>
        <div class="info-row">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2z"/>
          </svg>
          Mevalar soni <strong>${count} dona</strong>
        </div>
      </div>
      <div class="fruit-pill" style="background:${c.bg};color:${c.text}">
        ${label} berdi <span class="pill-emoji">${t.emoji}</span>
      </div>
      <button class="grow-btn"
        style="border-color:${c.border};color:${c.border}"
        onmouseover="this.style.background='${c.border}';this.style.color='#fff'"
        onmouseout="this.style.background='transparent';this.style.color='${c.border}'"
        onclick="growTree(${idx})">
        O'stirish simulyatsiyasi ▸
      </button>`;

    document.getElementById('trees-grid').appendChild(card);
    updateAll();

    nameEl.value  = '';
    countEl.value = '';
    card.scrollIntoView({ behavior:'smooth', block:'nearest' });

  } catch (e) {
    errEl.textContent = 'add_tree.php topilmadi yoki server xatosi!';
  } finally {
    btn.disabled = false;
    btn.textContent = '+ Qo\'shish';
  }
}
</script>
</body>
</html>
