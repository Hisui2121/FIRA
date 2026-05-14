<div class="settings-sidebar">

    <h2>Settings</h2>

    <a href="{{ route('settings.appearance') }}"
       class="{{ request()->routeIs('settings.appearance') ? 'active' : '' }}">
       <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 12C2 17.5228 6.47715 22 12 22C13.6569 22 15 20.6569 15 19V18.5C15 18.0356 15 17.8034 15.0257 17.6084C15.2029 16.2622 16.2622 15.2029 17.6084 15.0257C17.8034 15 18.0356 15 18.5 15H19C20.6569 15 22 13.6569 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M7 13C7.55228 13 8 12.5523 8 12C8 11.4477 7.55228 11 7 11C6.44772 11 6 11.4477 6 12C6 12.5523 6.44772 13 7 13Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M16 9C16.5523 9 17 8.55228 17 8C17 7.44772 16.5523 7 16 7C15.4477 7 15 7.44772 15 8C15 8.55228 15.4477 9 16 9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10 8C10.5523 8 11 7.55228 11 7C11 6.44772 10.5523 6 10 6C9.44772 6 9 6.44772 9 7C9 7.55228 9.44772 8 10 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>Appearance
    </a>

    <a href="{{ route('settings.security') }}"
       class="{{ request()->routeIs('settings.security') ? 'active' : '' }}">
       <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 10V8C17 5.23858 14.7614 3 12 3C9.23858 3 7 5.23858 7 8V10M12 14.5V16.5M8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C17.7202 10 16.8802 10 15.2 10H8.8C7.11984 10 6.27976 10 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> Security
    </a>

    <a href="{{ route('settings.preferences') }}"
       class="{{ request()->routeIs('settings.preferences') ? 'active' : '' }}">
       <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 8L15 8M15 8C15 9.65686 16.3431 11 18 11C19.6569 11 21 9.65685 21 8C21 6.34315 19.6569 5 18 5C16.3431 5 15 6.34315 15 8ZM9 16L21 16M9 16C9 17.6569 7.65685 19 6 19C4.34315 19 3 17.6569 3 16C3 14.3431 4.34315 13 6 13C7.65685 13 9 14.3431 9 16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> Preferences
    </a>

    <a href="{{ route('settings.account') }}"
       class="{{ request()->routeIs('settings.account') ? 'active' : '' }}">
       <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5ZM11 21L14.1014 20.1139C14.2499 20.0715 14.3241 20.0502 14.3934 20.0184C14.4549 19.9902 14.5134 19.9558 14.5679 19.9158C14.6293 19.8707 14.6839 19.8161 14.7932 19.7068L21.25 13.25C21.9404 12.5597 21.9404 11.4403 21.25 10.75C20.5597 10.0596 19.4404 10.0596 18.75 10.75L12.2932 17.2068C12.1839 17.3161 12.1293 17.3707 12.0842 17.4321C12.0442 17.4866 12.0098 17.5451 11.9816 17.6066C11.9497 17.6759 11.9285 17.7501 11.8861 17.8987L11 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> Account
    </a>

    <a href="{{ route('settings.system') }}"
       class="{{ request()->routeIs('settings.system') ? 'active' : '' }}">
       <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 14L22 14M8 21H16M6.8 18H17.2C18.8802 18 19.7202 18 20.362 17.673C20.9265 17.3854 21.3854 16.9265 21.673 16.362C22 15.7202 22 14.8802 22 13.2V7.8C22 6.11984 22 5.27976 21.673 4.63803C21.3854 4.07354 20.9265 3.6146 20.362 3.32698C19.7202 3 18.8802 3 17.2 3H6.8C5.11984 3 4.27976 3 3.63803 3.32698C3.07354 3.6146 2.6146 4.07354 2.32698 4.63803C2 5.27976 2 6.11984 2 7.8V13.2C2 14.8802 2 15.7202 2.32698 16.362C2.6146 16.9265 3.07354 17.3854 3.63803 17.673C4.27976 18 5.11984 18 6.8 18Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> System
    </a>

</div>