<x-layout>
<x-slot:title>Appearance</x-slot:title>

<div class="settings-layout">

    @include('settings.sidebar')

    <div class="settings-content">

        <div class="settings-header">
            <h1>Appearance</h1>
            <p>
                Customize your workspace appearance and interface behavior.
            </p>
        </div>

        <form action="{{ route('settings.appearance.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="settings-panel">

                <!-- THEME -->
                <div class="settings-group">

                    <div class="group-info">
                        <h3>Theme</h3>
                        <p>
                            Choose between light and dark appearance.
                        </p>
                    </div>

                    <div class="modern-options">

                        <!-- LIGHT -->
                        <label class="modern-option">
                            <input type="radio"
                                   name="theme"
                                   value="light"
                                   {{ $setting->theme == 'light' ? 'checked' : '' }}>

                            <div class="option-preview light-preview">
                                <div class="preview-sidebar"></div>
                                <div class="preview-content"></div>
                            </div>

                            <div class="option-text">
                                <strong>Light</strong>
                                <span>Bright interface for daytime use.</span>
                            </div>
                        </label>

                        <!-- DARK -->
                        <label class="modern-option">
                            <input type="radio"
                                   name="theme"
                                   value="dark"
                                   {{ $setting->theme == 'dark' ? 'checked' : '' }}>

                            <div class="option-preview dark-preview">
                                <div class="preview-sidebar"></div>
                                <div class="preview-content"></div>
                            </div>

                            <div class="option-text">
                                <strong>Dark</strong>
                                <span>Reduced eye strain in low light.</span>
                            </div>
                        </label>

                    </div>
                </div>

                <!-- DENSITY -->
                <div class="settings-group">

                    <div class="group-info">
                        <h3>Table Density</h3>
                        <p>
                            Adjust spacing inside tables and lists.
                        </p>
                    </div>

                    <div class="density-grid">

                        <label class="density-modern">
                            <input type="radio"
                                   name="table_density"
                                   value="default"
                                   {{ $setting->table_density == 'default' ? 'checked' : '' }}>

                            <div class="density-box">
                                <div class="density-preview"></div>

                                <div class="density-text">
                                    <strong>Default</strong>
                                    <span>Balanced spacing.</span>
                                </div>
                            </div>
                        </label>

                        <label class="density-modern">
                            <input type="radio"
                                   name="table_density"
                                   value="compact"
                                   {{ $setting->table_density == 'compact' ? 'checked' : '' }}>

                            <div class="density-box">
                                <div class="density-preview compact"></div>

                                <div class="density-text">
                                    <strong>Compact</strong>
                                    <span>More data visible.</span>
                                </div>
                            </div>
                        </label>

                        <label class="density-modern">
                            <input type="radio"
                                   name="table_density"
                                   value="spacious"
                                   {{ $setting->table_density == 'spacious' ? 'checked' : '' }}>

                            <div class="density-box">
                                <div class="density-preview spacious"></div>

                                <div class="density-text">
                                    <strong>Spacious</strong>
                                    <span>Comfortable spacing.</span>
                                </div>
                            </div>
                        </label>

                    </div>
                </div>

                <!-- ACCENT -->
                <div class="settings-group">

                    <div class="settings-row">

                        <div>
                            <h3>Accent Color</h3>
                            <p>
                                Personalize your primary highlight color.
                            </p>
                        </div>

                        <div class="accent-picker">
                            <input type="color"
                                   name="accent_color"
                                   value="{{ $setting->accent_color }}">
                        </div>

                    </div>

                </div>

                <!-- ACTION -->
                <div class="settings-footer">
                    <button type="submit" class="btn btn-primary">
                        Save Preferences
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

</x-layout>