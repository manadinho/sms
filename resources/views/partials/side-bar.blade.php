<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <i class="bx bxs-cube-alt nav_logo-icon"></i>
                <span class="nav_logo-name">Social 360</span>
            </a>
            <div class="nav_list">
                <a href="{{ route('welcome') }}" class="nav_link {{ request()->route()->getPrefix() === '' ? 'active' : '' }}">
                    <i class="bx bx-home nav_icon"></i>
                    <span class="nav_name">Planner</span>
                </a>
                <a href="{{ route('socials.index') }}" class="nav_link {{request()->route()->getPrefix() === '/socials' ? 'active' : ''}}">
                    <i class="bx bx-message-square-detail nav_icon"></i>
                    <span class="nav_name">Socials</span>
                </a>
                <a href="#" class="nav_link">
                    <i class="bx bx-refresh nav_icon"></i>
                    <span class="nav_name">Automation</span>
                </a>
                <a href="{{ route('ecommerce') }}" class="nav_link {{request()->route()->getPrefix() === '/ecommerce' ? 'active' : ''}}">
                    <i class="bx bx-shopping-bag  nav_icon"></i>
                    <span class="nav_name">Ecommerce</span>
                </a>
                <a href="{{ route('analytics') }}" class="nav_link {{request()->route()->getPrefix() === '/analytics' ? 'active' : ''}}">
                    <i class="bx bx-bar-chart-alt nav_icon"></i>
                    <span class="nav_name">Analytics</span>
                </a>
                <a href="#" class="nav_link">
                    <i class="bx bx-wrench nav_icon"></i>
                    <span class="nav_name">AI Tool</span>
                </a>
                <a href="{{ route('setting') }}" class="nav_link {{request()->route()->getPrefix() === '/setting' ? 'active' : ''}}">
                    <i class="bx bx-cog nav_icon nav_icon"></i>
                    <span class="nav_name">Settings</span>
                </a>
                {{-- <a href="#" class="nav_link">
                    <i class="bx bx-log-out nav_icon"></i>
                    <span class="nav_name">SignOut</span>
                </a> --}}
            </div>
        </div>
    </nav>
</div>
