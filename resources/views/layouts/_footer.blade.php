<footer style="background: darkgrey;">
    <div class="col-10 offset-1 d-flex">
        @if(!empty($ICP = \App\Models\Setting::get('ICP')))
        <a href="https://beian.miit.gov.cn" class="nav-link text-white" target="_blank">{{ $ICP }}</a>
        @endif

        <span class="nav-link text-white">
            &copy;{{ date('Y', strtotime(\App\Models\Setting::get('date', date('Y-m-d')))) }}
        </span>
    </div>
</footer>
