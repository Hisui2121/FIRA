<x-layout title="Reports">

<style>
.rpt-wrap {
    padding: 28px 32px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    animation: rptFade 0.4s ease forwards;
}

@keyframes rptFade {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

.rpt-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

.rpt-header-left h2 {
    font-size: 1.4rem;
    font-weight: 700;
    color: #241f26;
    margin-bottom: 3px;
}

.rpt-header-left p {
    font-size: 0.8rem;
    color: #9ca3af;
}

.rpt-header-right {
    display: flex;
    align-items: center;
    gap: 8px;
}

.rpt-filter {
    background: #f0eeea;
    border: 1.5px solid transparent;
    border-radius: 8px;
    padding: 8px 13px;
    font-size: 0.82rem;
    color: #241f26;
    cursor: pointer;
    outline: none;
    font-family: inherit;
    transition: border-color 0.2s;
}

.rpt-filter:focus {
    border-color: #fdbf29;
}

.rpt-btn-export {
    background: #fdbf29;
    color: #241f26;
    border: none;
    padding: 9px 18px;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-family: inherit;
    transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
}

.rpt-btn-export:hover {
    background: #e6a800;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(253,191,41,0.35);
}

.rpt-alert {
    background: #fff5f5;
    border: 1px solid #fecaca;
    border-radius: 10px;
    padding: 11px 16px;
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 0.83rem;
    color: #dc2626;
    font-weight: 500;
}

.rpt-alert a {
    margin-left: auto;
    color: #dc2626;
    font-weight: 700;
    text-decoration: none;
    font-size: 0.8rem;
    white-space: nowrap;
}

.rpt-alert a:hover {
    text-decoration: underline;
}

.rpt-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}

.rpt-stat {
    background: #fff;
    border-radius: 14px;
    padding: 18px 20px;
    border: 1px solid rgba(36,31,38,0.07);
    box-shadow: 0 2px 6px rgba(36,31,38,0.04);
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.rpt-stat:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(36,31,38,0.08);
}

.rpt-stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.rpt-stat-icon {
    width: 36px;
    height: 36px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
}

.rpt-badge {
    font-size: 0.68rem;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 20px;
}

.rb-up   { background: rgba(34,197,94,0.1);  color: #16a34a; }
.rb-down { background: rgba(239,68,68,0.1);  color: #dc2626; }
.rb-neu  { background: rgba(59,130,246,0.1); color: #2563eb; }

.rpt-stat-num {
    font-size: 1.8rem;
    font-weight: 800;
    color: #241f26;
    line-height: 1;
    letter-spacing: -0.5px;
}

.rpt-stat-num.danger {
    color: #ef4444;
}

.rpt-stat-lbl {
    font-size: 0.77rem;
    color: #6b7280;
    font-weight: 500;
}

.rpt-charts {
    display: grid;
    grid-template-columns: 1.8fr 1fr;
    gap: 16px;
}

.rpt-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px 22px;
    border: 1px solid rgba(36,31,38,0.07);
    box-shadow: 0 2px 6px rgba(36,31,38,0.04);
}

.rpt-card-hdr {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 16px;
}

.rpt-card-title {
    font-size: 0.9rem;
    font-weight: 700;
    color: #241f26;
    margin-bottom: 2px;
}

.rpt-card-sub {
    font-size: 0.72rem;
    color: #9ca3af;
}

.bar-wrap {
    display: flex;
    align-items: flex-end;
    gap: 10px;
    height: 150px;
    padding-bottom: 5px;
}

.bar-col {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    height: 100%;
    justify-content: flex-end;
}

.bar-body {
    width: 100%;
    border-radius: 6px 6px 0 0;
    position: relative;
    cursor: pointer;
    transition: opacity 0.2s, transform 0.2s;
    transform-origin: bottom;
}

.bar-body:hover {
    opacity: 0.8;
    transform: scaleY(1.04);
}

.bar-tooltip {
    position: absolute;
    top: -24px;
    left: 50%;
    transform: translateX(-50%);
    background: #241f26;
    color: #fff;
    font-size: 0.66rem;
    font-weight: 600;
    padding: 2px 7px;
    border-radius: 5px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.15s;
}

.bar-body:hover .bar-tooltip {
    opacity: 1;
}

.bar-lbl {
    font-size: 0.67rem;
    color: #9ca3af;
    font-weight: 500;
    text-align: center;
}

.donut-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
}

.donut-legend {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
}

.legend-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.77rem;
}

.legend-left {
    display: flex;
    align-items: center;
    gap: 6px;
}

.legend-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.legend-name { color: #6b7280; }
.legend-pct  { font-weight: 700; color: #241f26; }

.rpt-bottom {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.rpt-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
}

.rpt-table th {
    font-size: 0.66rem;
    font-weight: 700;
    color: #9ca3af;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 0 10px 9px;
    text-align: left;
    border-bottom: 1px solid rgba(36,31,38,0.07);
}

.rpt-table td {
    padding: 10px;
    font-size: 0.81rem;
    color: #241f26;
    border-bottom: 1px solid rgba(36,31,38,0.05);
}

.rpt-table tr:last-child td {
    border-bottom: none;
}

.rpt-table tbody tr:hover td {
    background: #f7f5f0;
}

.spill {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
}

.spill-c { background: rgba(239,68,68,0.1);   color: #dc2626; }
.spill-l { background: rgba(253,191,41,0.15); color: #b45309; }

.top-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 12px;
}

.top-row {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 8px 10px;
    border-radius: 9px;
    transition: background 0.15s;
}

.top-row:hover {
    background: #f7f5f0;
}

.top-num {
    width: 22px;
    height: 22px;
    border-radius: 6px;
    background: #f0eeea;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.69rem;
    font-weight: 700;
    color: #6b7280;
    flex-shrink: 0;
}

.top-num.gold {
    background: rgba(253,191,41,0.15);
    color: #b45309;
}

.top-icon {
    width: 32px;
    height: 32px;
    background: #f0eeea;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
}

.top-info {
    flex: 1;
    min-width: 0;
}

.top-name {
    font-size: 0.8rem;
    font-weight: 600;
    color: #241f26;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.top-cat {
    font-size: 0.69rem;
    color: #9ca3af;
    margin-top: 1px;
}

.prog-bg {
    background: #f0eeea;
    border-radius: 3px;
    height: 3px;
    overflow: hidden;
    margin-top: 3px;
}

.prog-fill {
    height: 100%;
    border-radius: 3px;
    background: #fdbf29;
}

.top-qty {
    font-size: 0.79rem;
    font-weight: 700;
    color: #241f26;
    white-space: nowrap;
}

.rpt-empty {
    text-align: center;
    padding: 20px 0;
    font-size: 0.81rem;
    color: #9ca3af;
}

.icon-yellow { background: rgba(253,191,41,0.12); }
.icon-blue   { background: rgba(59,130,246,0.1);  }
.icon-red    { background: rgba(239,68,68,0.1);   }
.icon-green  { background: rgba(34,197,94,0.1);   }

@media (max-width: 1100px) {
    .rpt-stats  { grid-template-columns: repeat(2,1fr); }
    .rpt-charts { grid-template-columns: 1fr; }
    .rpt-bottom { grid-template-columns: 1fr; }
}

@media (max-width: 600px) {
    .rpt-wrap  { padding: 14px; }
    .rpt-stats { grid-template-columns: 1fr 1fr; }
}
</style>

<div class="rpt-wrap">

    {{-- PAGE HEADER --}}
    <div class="rpt-header">
        <div class="rpt-header-left">
            <h2>Reports</h2>
            <p>Inventory overview — {{ now()->format('F d, Y') }}</p>
        </div>
        <div class="rpt-header-right">
            <select class="rpt-filter">
                <option>This Month</option>
                <option>Last Month</option>
                <option>This Year</option>
                <option>All Time</option>
            </select>
            <button class="rpt-btn-export" onclick="window.print()">
                ⬇ Export PDF
            </button>
        </div>
    </div>

    {{-- LOW STOCK ALERT --}}
    @if($lowStockCount > 0)
        <div class="rpt-alert">
            <span>⚠️</span>
            <span>
                <strong>Low Stock Alert:</strong>
                {{ $lowStockCount }} {{ Str::plural('product variant', $lowStockCount) }}
                below minimum threshold.
            </span>
            <a href="{{ route('products.index') }}">Review →</a>
        </div>
    @endif

    {{-- STAT CARDS --}}
    <div class="rpt-stats">
        <div class="rpt-stat">
            <div class="rpt-stat-top">
                <div class="rpt-stat-icon icon-yellow">📦</div>
                <span class="rpt-badge rb-up">Total</span>
            </div>
            <div class="rpt-stat-num">{{ $totalProducts }}</div>
            <div class="rpt-stat-lbl">Total Products</div>
        </div>

        <div class="rpt-stat">
            <div class="rpt-stat-top">
                <div class="rpt-stat-icon icon-blue">🏭</div>
                <span class="rpt-badge rb-neu">Active</span>
            </div>
            <div class="rpt-stat-num">{{ $totalSuppliers }}</div>
            <div class="rpt-stat-lbl">Active Suppliers</div>
        </div>

        <div class="rpt-stat">
            <div class="rpt-stat-top">
                <div class="rpt-stat-icon icon-red">⚠️</div>
                <span class="rpt-badge rb-down">Alert</span>
            </div>
            <div class="rpt-stat-num danger">{{ $lowStockCount }}</div>
            <div class="rpt-stat-lbl">Low Stock Variants</div>
        </div>

        <div class="rpt-stat">
            <div class="rpt-stat-top">
                <div class="rpt-stat-icon icon-green">🗂️</div>
                <span class="rpt-badge rb-up">All</span>
            </div>
            <div class="rpt-stat-num">{{ $totalCategories }}</div>
            <div class="rpt-stat-lbl">Categories</div>
        </div>
    </div>

    {{-- CHARTS ROW --}}
    <div class="rpt-charts">

        {{-- Bar Chart --}}
        <div class="rpt-card">
            <div class="rpt-card-hdr">
                <div>
                    <div class="rpt-card-title">Stock by Category</div>
                    <div class="rpt-card-sub">Total variant stock per clothing category</div>
                </div>
            </div>

            @php
                $barColors = ['#fdbf29','#4a5632','#b8a9d9','#e8a8b0','#7ec8e3','#e8d5c4','#a8d5b5'];
                $maxQty    = $stockByCategory->max('total_quantity') ?: 1;
            @endphp

            <div class="bar-wrap">
                @forelse($stockByCategory as $i => $cat)
                    @php
                        $h = max(round(($cat->total_quantity / $maxQty) * 100), 4);
                        $c = $barColors[$i % count($barColors)];
                    @endphp
                    <div class="bar-col">
                        <div class="bar-body"
                             data-height="{{ $h }}"
                             data-color="{{ $c }}">
                            <div class="bar-tooltip">{{ number_format($cat->total_quantity) }} pcs</div>
                        </div>
                        <span class="bar-lbl">{{ Str::limit($cat->name, 7) }}</span>
                    </div>
                @empty
                    <p class="rpt-empty" style="margin:auto">No category data yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Donut Chart --}}
        <div class="rpt-card">
            <div class="rpt-card-hdr">
                <div>
                    <div class="rpt-card-title">Category Split</div>
                    <div class="rpt-card-sub">Percentage breakdown by stock</div>
                </div>
            </div>

            @php
                $donutColors = ['#fdbf29','#4a5632','#b8a9d9','#e8a8b0','#7ec8e3','#e8d5c4'];
                $totalQty    = $stockByCategory->sum('total_quantity') ?: 1;
                $circ        = 2 * M_PI * 54;
                $offset      = 0;
            @endphp

            <div class="donut-wrap">
                <svg width="140" height="140" viewBox="0 0 140 140">
                    <circle cx="70" cy="70" r="54" fill="none"
                        stroke="#f0eeea" stroke-width="20"/>
                    @foreach($stockByCategory->take(6) as $i => $cat)
                        @php
                            $pct  = $cat->total_quantity / $totalQty;
                            $dash = $pct * $circ;
                            $gap  = $circ - $dash;
                            $col  = $donutColors[$i % count($donutColors)];
                        @endphp
                        <circle cx="70" cy="70" r="54" fill="none"
                            stroke="{{ $col }}"
                            stroke-width="20"
                            stroke-dasharray="{{ round($dash,2) }} {{ round($gap,2) }}"
                            stroke-dashoffset="{{ round(-$offset,2) }}"
                            transform="rotate(-90 70 70)"/>
                        @php $offset += $dash; @endphp
                    @endforeach
                    <text x="70" y="67" text-anchor="middle"
                        style="font-weight:800;font-size:17px;fill:#241f26">
                        {{ $totalProducts }}
                    </text>
                    <text x="70" y="81" text-anchor="middle"
                        style="font-size:8px;fill:#6b7280">
                        total items
                    </text>
                </svg>

                <div class="donut-legend">
                    @foreach($stockByCategory->take(6) as $i => $cat)
                        @php
                            $pct = round(($cat->total_quantity / $totalQty) * 100);
                            $col = $donutColors[$i % count($donutColors)];
                        @endphp
                        <div class="legend-row">
                            <div class="legend-left">
                                <div class="legend-dot" data-color="{{ $col }}"></div>
                                <span class="legend-name">{{ $cat->name }}</span>
                            </div>
                            <span class="legend-pct">{{ $pct }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    {{-- BOTTOM ROW --}}
    <div class="rpt-bottom">

        {{-- Low Stock Table --}}
        <div class="rpt-card">
            <div class="rpt-card-hdr">
                <div>
                    <div class="rpt-card-title">⚠️ Low Stock Items</div>
                    <div class="rpt-card-sub">Products with variants below threshold</div>
                </div>
            </div>
            <div style="overflow-x:auto">
                <table class="rpt-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $product)
                            @php
                                $qty = $product->variants->sum('stock');
                                $cls = $qty <= 2 ? 'spill-c' : 'spill-l';
                                $lbl = $qty <= 2 ? '● Critical' : '● Low';
                            @endphp
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '—' }}</td>
                                <td><strong>{{ $qty }}</strong></td>
                                <td><span class="spill {{ $cls }}">{{ $lbl }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="rpt-empty">
                                    ✅ All products are well stocked.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Top Products --}}
        <div class="rpt-card">
            <div class="rpt-card-hdr">
                <div>
                    <div class="rpt-card-title">🏆 Top Products</div>
                    <div class="rpt-card-sub">Highest stocked items by variant total</div>
                </div>
            </div>

            @php
                $emojiMap = ['👕','👖','👗','🧥','👜','👟','🧣','🎽'];
                $maxTop   = $topProducts->first()?->total_quantity ?? 1;
            @endphp

            <div class="top-list">
                @forelse($topProducts as $i => $product)
                    @php
                        $qty = $product->total_quantity ?? 0;
                        $w   = $maxTop > 0 ? round(($qty / $maxTop) * 100) : 0;
                        $em  = $emojiMap[$i % count($emojiMap)];
                    @endphp
                    <div class="top-row">
                        <div class="top-num {{ $i === 0 ? 'gold' : '' }}">{{ $i + 1 }}</div>
                        <div class="top-icon">{{ $em }}</div>
                        <div class="top-info">
                            <div class="top-name">{{ $product->name }}</div>
                            <div class="top-cat">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            <div class="prog-bg">
                                <div class="prog-fill" data-width="{{ $w }}"></div>
                            </div>
                        </div>
                        <div class="top-qty">{{ number_format($qty) }} pcs</div>
                    </div>
                @empty
                    <p class="rpt-empty">No products found.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>

{{-- Apply dynamic styles via JS to avoid VS Code CSS linter errors --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Bar chart: height + background color
        document.querySelectorAll('.bar-body[data-height]').forEach(function (el) {
            el.style.height      = el.getAttribute('data-height') + '%';
            el.style.background  = el.getAttribute('data-color');
        });

        // Legend dots: background color
        document.querySelectorAll('.legend-dot[data-color]').forEach(function (el) {
            el.style.background = el.getAttribute('data-color');
        });

        // Progress bars: width
        document.querySelectorAll('.prog-fill[data-width]').forEach(function (el) {
            el.style.width = el.getAttribute('data-width') + '%';
        });

    });
</script>

</x-layout>