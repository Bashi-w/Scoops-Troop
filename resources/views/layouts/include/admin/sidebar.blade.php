<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.index')}}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.categories.index')}}">
              <i class="mdi mdi-checkerboard menu-icon"></i>            
              <span class="menu-title">Categories</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.products.index') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Products</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.toppings.index')}}">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Toppings</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.products.stock')}}">
              <i class="mdi mdi-chart-bar menu-icon"></i>
              <span class="menu-title">Stock</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.orders.index')}}">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">Orders</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.customers.index')}}">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Customers</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.customers.addressBook')}}">
              <i class="mdi mdi-view-list menu-icon"></i>
              <span class="menu-title">Address Book</span>
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Logout</span>
              </a>

          </li>
        </ul>
      </nav>