<footer style="background: darkgrey;">
    <div class="col-10 offset-1 d-flex">
        @if(!empty($beian_icp = \App\Models\Setting::get('beian_icp')))
        <a href="https://beian.miit.gov.cn" class="nav-link text-white" target="_blank">{{ $beian_icp }}</a>
        @endif

        <span class="nav-link text-white">
            &copy;{{ date('Y', strtotime(\App\Models\Setting::get('date', date('Y-m-d')))) }}
        </span>

        @if(!empty($beian_code = \App\Models\Setting::get('beian_code')) && !empty($beian_text = \App\Models\Setting::get('beian_text')))
        <span class="nav-link text-white">
            <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode={{ $beian_code }}" target="_blank">
                <img src="{{ asset('assets/icon/beian.png') }}" alt=""> {{ $beian_text }}
            </a>
        </span>
        @endif
    </div>
</footer>
