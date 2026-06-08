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
          <span class="menu-title">Kategori</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>

      <li class="nav-item {{ request()->is('buku*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('buku.index') }}">
          <span class="menu-title">Data Buku</span>
          <i class="mdi mdi-book-open-variant menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('barang.index') }}">
          <span class="menu-title">Tag Harga UMKM</span>
          <i class="mdi mdi-tag menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('tugas.js') }}">
          <span class="menu-title">JS Murni</span>
          <i class="mdi mdi-code-tags menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('tugas.wilayah') }}">
          <span class="menu-title">Wilayah</span>
          <i class="mdi mdi-menu-down menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('kasir.index') }}">
          <span class="menu-title">Kasir</span>
          <i class="mdi mdi-menu-down menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('vendor.menu') }}">
          <span class="menu-title">Vendor</span>
          <i class="mdi mdi-menu-down menu-icon"></i>
        </a>
      </li>

    </ul>
</nav>