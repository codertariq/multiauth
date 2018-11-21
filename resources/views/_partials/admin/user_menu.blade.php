<div class="sidebar-user">
    <div class="card-body">
        <div class="media">
            <div class="mr-3">
                <a href="#"><img src="{{ Auth::user('admin')->image ? asset(Auth::user()->image) : multiauth_asset('images/placeholders/placeholder.jpg') }}"  width="38" height="38" class="rounded-circle" alt=""></a>
            </div>
            <div class="media-body">
                <div class="media-title font-weight-semibold">{{Auth::user()->first_name. ' '.Auth::user()->last_name}}</div>
                <div class="font-size-xs opacity-50">
                    <i class="icon-pin font-size-sm"></i> &nbsp;{{Auth::user()->address. ', '.Auth::user()->city}}
                </div>
            </div>
        </div>
    </div>
</div>