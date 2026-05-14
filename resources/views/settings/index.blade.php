<x-layout>

<x-slot:title>
    Settings
</x-slot:title>

<div class="page-header">
    <h2>Settings</h2>
    <p>Manage your system preferences and configurations.</p>
</div>

<div class="settings-grid">

    <!-- APPEARANCE -->
    <div class="card settings-card">
        <div class="card-header">
            <h3>🎨 Appearance</h3>
        </div>

        <div class="setting-item">
            <label>Dark Mode</label>
            <input type="checkbox">
        </div>

        <div class="setting-item">
            <label>Compact Table View</label>
            <input type="checkbox">
        </div>

        <div class="setting-item">
            <label>Sidebar Collapse</label>
            <input type="checkbox">
        </div>

        <div class="setting-item">
            <label>Dashboard Charts</label>
            <input type="checkbox" checked>
        </div>
    </div>

    <!-- INVENTORY -->
    <div class="card settings-card">
        <div class="card-header">
            <h3>📦 Inventory</h3>
        </div>

        <div class="setting-item">
            <label>Low Stock Threshold</label>
            <input type="number" value="10">
        </div>

        <div class="setting-item">
            <label>Auto Generate SKU</label>
            <input type="checkbox" checked>
        </div>

        <div class="setting-item">
            <label>Allow Negative Stock</label>
            <input type="checkbox">
        </div>

        <div class="setting-item">
            <label>Enable Variant Tracking</label>
            <input type="checkbox" checked>
        </div>
    </div>

    <!-- SECURITY -->
    <div class="card settings-card">
        <div class="card-header">
            <h3>🔒 Security</h3>
        </div>

        <div class="setting-item">
            <label>Enable Audit Logs</label>
            <input type="checkbox" checked>
        </div>

        <div class="setting-item">
            <label>Session Timeout (minutes)</label>
            <input type="number" value="30">
        </div>

        <div class="setting-item">
            <label>Login Alerts</label>
            <input type="checkbox">
        </div>
    </div>

    <!-- NOTIFICATIONS -->
    <div class="card settings-card">
        <div class="card-header">
            <h3>🔔 Notifications</h3>
        </div>

        <div class="setting-item">
            <label>Low Stock Alerts</label>
            <input type="checkbox" checked>
        </div>

        <div class="setting-item">
            <label>Email Notifications</label>
            <input type="checkbox">
        </div>

        <div class="setting-item">
            <label>Supplier Notifications</label>
            <input type="checkbox">
        </div>
    </div>

    <!-- SYSTEM -->
    <div class="card settings-card">
        <div class="card-header">
            <h3>⚙ System</h3>
        </div>

        <div class="setting-item">
            <label>System Name</label>
            <input type="text" value="Fira Inventory">
        </div>

        <div class="setting-item">
            <label>Currency</label>
            <select>
                <option>PHP ₱</option>
                <option>USD $</option>
            </select>
        </div>

        <div class="setting-item">
            <label>Timezone</label>
            <select>
                <option>Asia/Manila</option>
            </select>
        </div>
    </div>

    <!-- AUDIT -->
    <div class="card settings-card">
        <div class="card-header">
            <h3>🧾 Audit & Logs</h3>
        </div>

        <div class="setting-item">
            <label>Track User Activity</label>
            <input type="checkbox" checked>
        </div>

        <div class="setting-item">
            <label>Track IP Address</label>
            <input type="checkbox" checked>
        </div>

        <div class="setting-item">
            <label>Log Retention (days)</label>
            <input type="number" value="90">
        </div>
    </div>

</div>

<div style="margin-top:20px;">
    <button class="btn btn-primary">
        Save Settings
    </button>
</div>

</x-layout>