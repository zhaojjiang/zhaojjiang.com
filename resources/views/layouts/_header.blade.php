<header class="p-1 text-white" style="background: darkgrey">
    <div class="d-flex align-items-center justify-content-center justify-content-start">
        <ul class="nav me-auto justify-content-center">
            <li><a href="/" class="nav-link px-2 text-white">首页</a></li>
            <li><a href="{{ route('content.index') }}" class="nav-link px-2 text-white">内容</a></li>
            <li><a href="{{ route('tag.index') }}" class="nav-link px-2 text-white">标签</a></li>
            <li><a href="{{ route('page.about') }}" class="nav-link px-2 text-white">关于</a></li>
        </ul>

        <div class="text-end">
            @if(\Illuminate\Support\Facades\Auth::user())
                <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-dark">退出</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark">登录</a>
            @endif
        </div>
    </div>
</header>
