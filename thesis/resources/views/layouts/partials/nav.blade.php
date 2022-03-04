<!--start top header-->
<header class="top-header">        
    <nav class="navbar navbar-expand gap-3">
        <div class="mobile-toggle-icon fs-3">
            <i class="bi bi-list"></i>
        </div>
        <div class="chip chip-md bg-dark text-white mt-2">
            Currently Logged In: <span style="color:yellow; text-transform: uppercase;">{{ Auth::user()->email }}</span>
        </div>
        @if(Auth::user()->role_id != 1)
        <div class="chip chip-md bg-dark text-white mt-2">
            Organization: <span style="color:yellow; text-transform: uppercase;">{{ Auth::user()->organization->organization_acronym }}</span>
        </div>
        @endif
        <div class="chip chip-md bg-dark text-white mt-2">
            Role: <span style="color:yellow; text-transform: uppercase;">{{ Auth::user()->role->role }}</span>
        </div>
    </nav>
</header>
<!--end top header-->