<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
   <div class="app-brand demo">
     <a href="index.html" class="app-brand-link">
       <span class="app-brand-logo demo">

       </span>
       <span class="app-brand-text demo menu-text fw-bolder ms-2">ExtraJoss</span>
     </a>

     <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
       <i class="bx bx-chevron-left bx-sm align-middle"></i>
     </a>
   </div>

   <div class="menu-inner-shadow"></div>

   <ul class="menu-inner py-1">
     <!-- Dashboard -->
    <li class="menu-item {{ set_active('dashboard.index') }}">
       <a href="{{ route('dashboard.index') }}" class="menu-link">
         <i class="menu-icon tf-icons bx bx-home-circle"></i>
         <div data-i18n="Analytics">Dashboard</div>
       </a>
    </li>
    <li class="menu-item {{ set_active('dashboard.leaderboard') }}">
      <a href="{{ route('dashboard.leaderboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Leaderboard</div>
      </a>
    </li>
    @if (!Auth::user()->email == 'syahril.anwar@b7leap.com')
      <li class="menu-item {{ set_active(['sliders.index','sliders.create', 'sliders.edit']) }}">
        <a href="{{ route('sliders.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-image"></i>
          <div data-i18n="Analytics">Slider / Banner</div>
        </a>
      </li>
    @endif
    <li class="menu-header small text-uppercase">
       <span class="menu-header-text">Pages</span>
    </li>
    @if (!Auth::user()->email == 'syahril.anwar@b7leap.com')
    <!-- Pages -->
    <li class="menu-item {{ set_active(['posts.index','posts.create', 'posts.edit']) }} {{ set_open(['posts.index','posts.create', 'posts.edit']) }} ">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-news"></i>
        <div data-i18n="Layouts">Posts</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ set_active(['posts.index']) }} ">
          <a href="{{ route('posts.index') }}" class="menu-link">
            <div data-i18n="Without menu">List</div>
          </a>
        </li>
        <li class="menu-item {{ set_active(['posts.create']) }}">
          <a href="{{ route('posts.create') }}" class="menu-link">
            <div data-i18n="Without navbar">Create</div>
          </a>
        </li>
      </ul>
    </li>
    @endif

    @if (!Auth::user()->email == 'syahril.anwar@b7leap.com')
     <!-- Components -->
     <li class="menu-header small text-uppercase"><span class="menu-header-text">Games / Quiz</span></li>
     <li class="menu-item {{ set_active(['teams.index','teams.edit','matchs.create', 'matchs.edit']) }} {{ set_open(['teams.index','matchs.index', 'teams.edit', 'matchs.create','rounds.index']) }} ">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-football"></i>
        <div data-i18n="Layouts">Footbals</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ set_active(['teams.index','teams.edit']) }} ">
          <a href="{{ route('teams.index') }}" class="menu-link">
            <div data-i18n="Without menu">List Teams</div>
          </a>
        </li>
        <li class="menu-item {{ set_active(['matchs.index']) }}">
          <a href="{{ route('matchs.index') }}" class="menu-link">
            <div data-i18n="Without navbar">List Matches</div>
          </a>
        </li>
        <li class="menu-item {{ set_active(['rounds.index']) }}">
          <a href="{{ route('rounds.index') }}" class="menu-link">
            <div data-i18n="Without navbar">List Rounds</div>
          </a>
        </li>
        <li class="menu-item {{ set_active(['matchs.create']) }}">
          <a href="{{ route('matchs.create') }}" class="menu-link">
            <div data-i18n="Without navbar">Create Matches</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item {{ set_active(['quizs.index','quizs.create', 'quizs.edit', 'quizchoices.create']) }} {{ set_open(['quizs.index','quizs.create','quizchoices.create']) }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-message-check"></i>
        <div data-i18n="Layouts">Quiz</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ set_active(['quizs.index']) }}">
          <a href="{{ route('quizs.index') }}" class="menu-link">
            <div data-i18n="Without menu">List Quiz</div>
          </a>
        </li>
        <li class="menu-item  {{ set_active(['quizs.create']) }}">
          <a href="{{ route('quizs.create') }}" class="menu-link">
            <div data-i18n="Without navbar">Create Quiz</div>
          </a>
        </li>
        <li class="menu-item  {{ set_active(['quizchoices.create']) }}">
          <a href="{{ route('quizchoices.create') }}" class="menu-link">
            <div data-i18n="Without navbar">Create Quiz Option</div>
          </a>
        </li>
      </ul>
    </li>
    @endif

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">User</span></li>
      <li class="menu-item  {{ set_active(['users.index']) }}">
        <a href="{{ route('users.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-group"></i>
          <div data-i18n="Tables">Participant</div>
        </a>
      </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>
  </ul>
 </aside>
 <!-- / Menu -->
 <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>