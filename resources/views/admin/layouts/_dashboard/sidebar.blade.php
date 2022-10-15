<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
     <div class="nav">
        <a class="nav-link {{ set_active('dashboard.index') }}" href="{{ route('dashboard.index') }}">
           <div class="sb-nav-link-icon">
              <i class="fas fa-tachometer-alt"></i>
           </div>
           Dashboard
        </a>
        <div class="sb-sidenav-menu-heading">HomePage</div>
        <div class="sb-sidenav-menu-heading">Pages</div>
        {{-- posts --}}
        <a class="nav-link {{ set_active(['posts.index','posts.create', 'posts.edit']) }}" " href="{{ route('posts.index') }}">
           <div class="sb-nav-link-icon">
              <i class="far fa-newspaper"></i>
           </div>
           Posts
        </a>
        {{-- categories --}}
        <a class="nav-link {{ set_active(['categories.index','categories.create', 'categories.edit']) }}" href="{{ route('categories.index', ) }}">
           <div class="sb-nav-link-icon">
              <i class="fas fa-bookmark"></i>
           </div>
           Categories
        </a>
        <div class="sb-sidenav-menu-heading">Games / Quiz</div>
        {{-- Team --}}
        <a class="nav-link {{ set_active(['categories.index','categories.create', 'categories.edit']) }}" href="{{ route('categories.index', ) }}">
         <div class="sb-nav-link-icon">
            <i class="fas fa-bookmark"></i>
         </div>
         Teams
      </a>
        {{-- Matches --}}
         <a class="nav-link {{ set_active(['categories.index','categories.create', 'categories.edit']) }}" href="{{ route('categories.index', ) }}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-bookmark"></i>
            </div>
            Matches
         </a>
        <a class="nav-link {{ set_active(['categories.index','categories.create', 'categories.edit']) }}" href="{{ route('categories.index', ) }}">
         <div class="sb-nav-link-icon">
            <i class="fas fa-bookmark"></i>
         </div>
         Questions
      </a>
      {{-- Matches --}}
      <a class="nav-link {{ set_active(['categories.index','categories.create', 'categories.edit']) }}" href="{{ route('categories.index', ) }}">
         <div class="sb-nav-link-icon">
            <i class="fas fa-bookmark"></i>
         </div>
         Answer
      </a>

        <div class="sb-sidenav-menu-heading">Users</div>
        
        
        
       
       
     </div>
  </div>
  <div class="sb-sidenav-footer">
     <div class="small">Logged in as:</div>
     <!-- show username -->
  </div>
</nav>
