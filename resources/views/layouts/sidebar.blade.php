<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">David Grey. H</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
<li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
  <a class="nav-link" href="{{ url('/') }}">
    <span class="menu-title">Dashboard</span>
    <i class="mdi mdi-home menu-icon"></i>
  </a>
</li>

<li class="nav-item {{ request()->is('kategori*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('kategori.index') }}">
    <span class="menu-title">Kategori Buku</span>
    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
  </a>
</li>

<li class="nav-item {{ request()->is('buku*') ? 'active' : '' }}">
  <a class="nav-link" href="#">
    <span class="menu-title">Data Buku</span>
    <i class="mdi mdi-book-open-variant menu-icon"></i>
  </a>
</li>
          </ul>
        </nav>