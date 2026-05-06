<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRA — Reports</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --yellow: #fdbf29;
            --yellow-hover: #e6a800;
            --yellow-light: rgba(253,191,41,0.12);
            --dark: #241f26;
            --gray: #6b7280;
            --gray-light: #9ca3af;
            --light-bg: #f7f5f0;
            --white: #ffffff;
            --border: rgba(36,31,38,0.08);
            --red: #ef4444;
            --red-light: rgba(239,68,68,0.1);
            --green: #22c55e;
            --green-light: rgba(34,197,94,0.1);
            --blue-light: rgba(59,130,246,0.1);
            --shadow-sm: 0 2px 8px rgba(36,31,38,0.06);
            --shadow: 0 4px 24px rgba(36,31,38,0.08);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light-bg);
            color: var(--dark);
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 52px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }

        .logo {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 600;
            font-size: 1.55rem;
            color: var(--dark);
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        .logo .dot { color: var(--yellow); }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .avatar {
            width: 36px; height: 36px;
            background: var(--yellow-light);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; font-weight: 700; color: var(--dark);
            border: 2px solid var(--yellow);
        }

        .nav-username {
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--gray);
        }

        .btn-logout {
            background: transparent;
            color: var(--gray);
            border: 1.5px solid var(--border);
            padding: 7px 16px;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .btn-logout:hover { border-color: var(--red); color: var(--red); }

        /* ── PAGE HEADER ── */
        .page-header {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 24px 52px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-header-left h1 {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--dark);
        }

        .page-header-left p {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 4px;
        }

        .page-header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-export {
            background: var(--yellow);
            color: var(--dark);
            border: none;
            padding: 10px 22px;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        .btn-export:hover {
            background: var(--yellow-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(253,191,41,0.4);
        }

        .filter-select {
            background: var(--light-bg);
            border: 1.5px solid var(--border);
            padding: 9px 16px;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            color: var(--dark);
            cursor: pointer;
            outline: none;
        }

        /* ── CONTENT ── */
        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 52px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* ── PLACEHOLDER BANNER ── */
        .placeholder-banner {
            background: linear-gradient(135deg, var(--yellow-light), rgba(253,191,41,0.03));
            border: 1.5px dashed var(--yellow);
            border-radius: 16px;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 14px;
            animation: fadeUp 0.5s ease forwards;
            opacity: 0;
        }
        .placeholder-banner .icon { font-size: 1.4rem; }
        .placeholder-banner h3 { font-size: 0.92rem; font-weight: 700; color: var(--dark); margin-bottom: 2px; }
        .placeholder-banner p { font-size: 0.8rem; color: var(--gray); }

        /* ── ALERT BAR ── */
        .alert-bar {
            background: #fff5f5;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.88rem;
            color: #dc2626;
            font-weight: 500;
            animation: fadeUp 0.5s ease 0.05s forwards;
            opacity: 0;
        }
        .alert-bar a { color: #dc2626; font-weight: 700; margin-left: auto; text-decoration: none; }
        .alert-bar a:hover { text-decoration: underline; }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            animation: fadeUp 0.5s ease 0.1s forwards;
            opacity: 0;
        }

        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 22px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow); }

        .stat-header { display: flex; align-items: center; justify-content: space-between; }

        .stat-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }

        .stat-badge {
            font-size: 0.72rem; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
        }
        .stat-badge.up { background: var(--green-light); color: #16a34a; }
        .stat-badge.down { background: var(--red-light); color: #dc2626; }
        .stat-badge.neutral { background: var(--yellow-light); color: #b45309; }

        .stat-value {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800; font-size: 2rem;
            color: var(--dark); line-height: 1;
        }
        .stat-label { font-size: 0.82rem; color: var(--gray); font-weight: 500; }

        /* ── CHARTS ROW ── */
        .charts-row {
            display: grid;
            grid-template-columns: 1.8fr 1fr;
            gap: 20px;
            animation: fadeUp 0.5s ease 0.15s forwards;
            opacity: 0;
        }

        .chart-card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }

        .chart-header {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .chart-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700; font-size: 1rem; color: var(--dark);
        }
        .chart-subtitle { font-size: 0.78rem; color: var(--gray); margin-top: 2px; }

        .chart-filter {
            background: var(--light-bg); border: none;
            padding: 6px 12px; border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem; color: var(--dark); cursor: pointer;
        }

        /* Bar chart */
        .bar-chart {
            display: flex; align-items: flex-end;
            gap: 16px; height: 180px; padding-bottom: 8px;
        }

        .bar-group {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; gap: 8px;
            height: 100%; justify-content: flex-end;
        }

        .bar {
            width: 100%; border-radius: 8px 8px 0 0;
            transition: opacity 0.2s ease;
            position: relative; cursor: pointer;
        }
        .bar:hover { opacity: 0.8; }

        .bar-tooltip {
            position: absolute; top: -28px; left: 50%;
            transform: translateX(-50%);
            background: var(--dark); color: white;
            font-size: 0.7rem; font-weight: 600;
            padding: 3px 8px; border-radius: 6px;
            white-space: nowrap; opacity: 0;
            pointer-events: none; transition: opacity 0.2s;
        }
        .bar:hover .bar-tooltip { opacity: 1; }
        .bar-label { font-size: 0.75rem; color: var(--gray); font-weight: 500; }

        /* Donut */
        .donut-wrap { display: flex; flex-direction: column; align-items: center; gap: 20px; }
        .donut-svg { overflow: visible; }
        .donut-center-text { text-anchor: middle; dominant-baseline: middle; }
        .donut-legend { display: flex; flex-direction: column; gap: 10px; width: 100%; }
        .legend-item { display: flex; align-items: center; justify-content: space-between; font-size: 0.82rem; }
        .legend-left { display: flex; align-items: center; gap: 8px; }
        .legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
        .legend-name { color: var(--gray); }
        .legend-pct { font-weight: 700; color: var(--dark); }

        /* ── BOTTOM ROW ── */
        .bottom-row {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 20px;
            animation: fadeUp 0.5s ease 0.2s forwards;
            opacity: 0;
        }

        .table-card {
            background: var(--white); border-radius: 16px;
            padding: 24px; box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }

        .table-wrap { overflow-x: auto; margin-top: 16px; }
        table { width: 100%; border-collapse: collapse; }

        th {
            font-size: 0.7rem; font-weight: 700;
            color: var(--gray-light); letter-spacing: 0.06em;
            text-transform: uppercase; padding: 0 12px 10px;
            text-align: left; border-bottom: 1px solid var(--border);
        }

        td {
            padding: 12px; font-size: 0.85rem;
            color: var(--dark); border-bottom: 1px solid var(--border);
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--light-bg); }

        .stock-pill {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.75rem; font-weight: 600;
        }
        .stock-pill.critical { background: var(--red-light); color: #dc2626; }
        .stock-pill.low { background: var(--yellow-light); color: #b45309; }

        /* Top products */
        .top-products { display: flex; flex-direction: column; gap: 12px; margin-top: 16px; }

        .product-row {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; border-radius: 10px;
            transition: background 0.15s ease; cursor: pointer;
        }
        .product-row:hover { background: var(--light-bg); }

        .product-rank {
            width: 26px; height: 26px; border-radius: 8px;
            background: var(--light-bg);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem; font-weight: 700; color: var(--gray); flex-shrink: 0;
        }
        .product-rank.gold { background: var(--yellow-light); color: #b45309; }

        .product-icon {
            font-size: 1.2rem; width: 36px; height: 36px;
            background: var(--light-bg); border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .product-info { flex: 1; min-width: 0; }
        .product-name { font-size: 0.86rem; font-weight: 600; color: var(--dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .product-cat { font-size: 0.75rem; color: var(--gray); margin-top: 1px; }
        .product-stock { font-size: 0.85rem; font-weight: 700; color: var(--dark); }

        .progress-wrap { margin-top: 4px; }
        .progress-bar-bg { background: var(--light-bg); border-radius: 4px; height: 5px; overflow: hidden; }
        .progress-bar-fill { height: 100%; border-radius: 4px; background: var(--yellow); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .charts-row { grid-template-columns: 1fr; }
            .bottom-row { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            nav, .page-header, .content { padding-left: 20px; padding-right: 20px; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<!-- ── NAVBAR ── -->
<nav>
    <a href="/" class="logo">fira<span class="dot">.</span></a>
    <div class="nav-right">
        <span class="nav-username">{{ Auth::user()->first_name ?? 'User' }}</span>
        <div class="avatar">{{ strtoupper(substr(Auth::user()->first_name ?? 'U', 0, 1)) }}</div>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="btn-logout">🚪 Logout</button>
        </form>
    </div>
</nav>

<!-- ── PAGE HEADER ── -->
<div class="page-header">
    <div class="page-header-left">
        <h1>📊 Reports</h1>
        <p>Inventory overview — placeholder data for approval</p>
    </div>
    <div class="page-header-right">
        <select class="filter-select">
            <option>This Month</option>
            <option>Last Month</option>
            <option>This Year</option>
        </select>
        <button class="btn-export">⬇ Export PDF</button>
    </div>
</div>

<!-- ── CONTENT ── -->
<div class="content">

    <!-- Placeholder Notice -->
    <div class="placeholder-banner">
        <span class="icon">🚧</span>
        <div>
            <h3>Placeholder Report — For Approval</h3>
            <p>This page shows sample data. Real inventory data will populate once the full system is connected.</p>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="alert-bar">
        <span>⚠️</span>
        <span><strong>Low Stock Alert:</strong> 4 products are below the minimum threshold.</span>
        <a href="#">Review →</a>
    </div>

    <!-- STAT CARDS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background:var(--yellow-light)">📦</div>
                <span class="stat-badge up">+12 this week</span>
            </div>
            <div class="stat-value">248</div>
            <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background:var(--blue-light)">🏭</div>
                <span class="stat-badge neutral">+1 new</span>
            </div>
            <div class="stat-value">8</div>
            <div class="stat-label">Active Suppliers</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background:var(--red-light)">⚠️</div>
                <span class="stat-badge down">needs attention</span>
            </div>
            <div class="stat-value" style="color:var(--red)">4</div>
            <div class="stat-label">Low Stock Items</div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon" style="background:var(--green-light)">🗂️</div>
                <span class="stat-badge up">stable</span>
            </div>
            <div class="stat-value">6</div>
            <div class="stat-label">Categories</div>
        </div>
    </div>

    <!-- CHARTS ROW -->
    <div class="charts-row">

        <!-- Bar Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">Stock by Category</div>
                    <div class="chart-subtitle">Number of items per clothing category</div>
                </div>
                <select class="chart-filter">
                    <option>Count</option>
                    <option>Value</option>
                </select>
            </div>
            <div class="bar-chart">
                <div class="bar-group">
                    <div class="bar" style="height:60%;background:var(--yellow)">
                        <div class="bar-tooltip">72 items</div>
                    </div>
                    <span class="bar-label">Shirts</span>
                </div>
                <div class="bar-group">
                    <div class="bar" style="height:95%;background:#4a5632">
                        <div class="bar-tooltip">114 items</div>
                    </div>
                    <span class="bar-label">Pants</span>
                </div>
                <div class="bar-group">
                    <div class="bar" style="height:45%;background:#b8a9d9">
                        <div class="bar-tooltip">54 items</div>
                    </div>
                    <span class="bar-label">Dresses</span>
                </div>
                <div class="bar-group">
                    <div class="bar" style="height:30%;background:#e8a8b0">
                        <div class="bar-tooltip">36 items</div>
                    </div>
                    <span class="bar-label">Jackets</span>
                </div>
                <div class="bar-group">
                    <div class="bar" style="height:20%;background:#7ec8e3">
                        <div class="bar-tooltip">24 items</div>
                    </div>
                    <span class="bar-label">Bags</span>
                </div>
                <div class="bar-group">
                    <div class="bar" style="height:15%;background:#e8d5c4">
                        <div class="bar-tooltip">18 items</div>
                    </div>
                    <span class="bar-label">Others</span>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">Category Split</div>
                    <div class="chart-subtitle">Percentage breakdown</div>
                </div>
            </div>
            <div class="donut-wrap">
                <svg width="140" height="140" viewBox="0 0 140 140" class="donut-svg">
                    <circle cx="70" cy="70" r="54" fill="none" stroke="#f0eeea" stroke-width="22"/>
                    <circle cx="70" cy="70" r="54" fill="none" stroke="var(--yellow)"
                        stroke-width="22" stroke-dasharray="98.5 240.5"
                        stroke-dashoffset="0" transform="rotate(-90 70 70)"/>
                    <circle cx="70" cy="70" r="54" fill="none" stroke="#4a5632"
                        stroke-width="22" stroke-dasharray="155.9 182.4"
                        stroke-dashoffset="-98.5" transform="rotate(-90 70 70)"/>
                    <circle cx="70" cy="70" r="54" fill="none" stroke="#b8a9d9"
                        stroke-width="22" stroke-dasharray="74.6 264.5"
                        stroke-dashoffset="-254.4" transform="rotate(-90 70 70)"/>
                    <circle cx="70" cy="70" r="54" fill="none" stroke="#e8a8b0"
                        stroke-width="22" stroke-dasharray="44.2 295"
                        stroke-dashoffset="-329" transform="rotate(-90 70 70)"/>
                    <text x="70" y="66" class="donut-center-text"
                        style="font-family:'Bricolage Grotesque';font-weight:800;font-size:18px;fill:#241f26">248</text>
                    <text x="70" y="82" class="donut-center-text"
                        style="font-family:'DM Sans';font-size:9px;fill:#6b7280">total items</text>
                </svg>
                <div class="donut-legend">
                    <div class="legend-item">
                        <div class="legend-left"><div class="legend-dot" style="background:var(--yellow)"></div><span class="legend-name">Shirts</span></div>
                        <span class="legend-pct">29%</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-left"><div class="legend-dot" style="background:#4a5632"></div><span class="legend-name">Pants</span></div>
                        <span class="legend-pct">46%</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-left"><div class="legend-dot" style="background:#b8a9d9"></div><span class="legend-name">Dresses</span></div>
                        <span class="legend-pct">22%</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-left"><div class="legend-dot" style="background:#e8a8b0"></div><span class="legend-name">Others</span></div>
                        <span class="legend-pct">13%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM ROW -->
    <div class="bottom-row">

        <!-- Low Stock Table -->
        <div class="table-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">⚠️ Low Stock Items</div>
                    <div class="chart-subtitle">Items that need restocking soon</div>
                </div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>White Polo Shirt</td>
                            <td>Shirts</td>
                            <td><strong>2</strong></td>
                            <td><span class="stock-pill critical">● Critical</span></td>
                        </tr>
                        <tr>
                            <td>Black Skinny Jeans</td>
                            <td>Pants</td>
                            <td><strong>5</strong></td>
                            <td><span class="stock-pill low">● Low</span></td>
                        </tr>
                        <tr>
                            <td>Floral Summer Dress</td>
                            <td>Dresses</td>
                            <td><strong>3</strong></td>
                            <td><span class="stock-pill critical">● Critical</span></td>
                        </tr>
                        <tr>
                            <td>Olive Cargo Jacket</td>
                            <td>Jackets</td>
                            <td><strong>7</strong></td>
                            <td><span class="stock-pill low">● Low</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Products -->
        <div class="table-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">🏆 Top Products</div>
                    <div class="chart-subtitle">Highest stocked items this month</div>
                </div>
            </div>
            <div class="top-products">
                <div class="product-row">
                    <div class="product-rank gold">1</div>
                    <div class="product-icon">👕</div>
                    <div class="product-info">
                        <div class="product-name">Classic White T-Shirt</div>
                        <div class="product-cat">Shirts</div>
                        <div class="progress-wrap"><div class="progress-bar-bg"><div class="progress-bar-fill" style="width:90%"></div></div></div>
                    </div>
                    <div class="product-stock">90 pcs</div>
                </div>
                <div class="product-row">
                    <div class="product-rank">2</div>
                    <div class="product-icon">👖</div>
                    <div class="product-info">
                        <div class="product-name">Blue Denim Jeans</div>
                        <div class="product-cat">Pants</div>
                        <div class="progress-wrap"><div class="progress-bar-bg"><div class="progress-bar-fill" style="width:75%"></div></div></div>
                    </div>
                    <div class="product-stock">75 pcs</div>
                </div>
                <div class="product-row">
                    <div class="product-rank">3</div>
                    <div class="product-icon">👗</div>
                    <div class="product-info">
                        <div class="product-name">Maxi Floral Dress</div>
                        <div class="product-cat">Dresses</div>
                        <div class="progress-wrap"><div class="progress-bar-bg"><div class="progress-bar-fill" style="width:55%"></div></div></div>
                    </div>
                    <div class="product-stock">55 pcs</div>
                </div>
                <div class="product-row">
                    <div class="product-rank">4</div>
                    <div class="product-icon">🧥</div>
                    <div class="product-info">
                        <div class="product-name">Oversized Hoodie</div>
                        <div class="product-cat">Jackets</div>
                        <div class="progress-wrap"><div class="progress-bar-bg"><div class="progress-bar-fill" style="width:40%"></div></div></div>
                    </div>
                    <div class="product-stock">40 pcs</div>
                </div>
                <div class="product-row">
                    <div class="product-rank">5</div>
                    <div class="product-icon">👜</div>
                    <div class="product-info">
                        <div class="product-name">Leather Tote Bag</div>
                        <div class="product-cat">Bags</div>
                        <div class="progress-wrap"><div class="progress-bar-bg"><div class="progress-bar-fill" style="width:28%"></div></div></div>
                    </div>
                    <div class="product-stock">28 pcs</div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>