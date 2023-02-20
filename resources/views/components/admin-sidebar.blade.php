<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('adminDashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#projects-users" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="projects-users" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('all-users')}}">
              <i class="bi bi-circle"></i><span>All Users</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Project Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#projects-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Banners</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="projects-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('all-banner')}}">
              <i class="bi bi-circle"></i><span>All Banner</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-banner')}}">
              <i class="bi bi-circle"></i><span>Add Banner</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Project Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('all-category')}}">
              <i class="bi bi-circle"></i><span>All Categories</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-category')}}">
              <i class="bi bi-circle"></i><span>Add Category</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Employee Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-products" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-products" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('all-products')}}">
              <i class="bi bi-circle"></i><span>All Products</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-product')}}">
              <i class="bi bi-circle"></i><span>Add Products</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Attendance Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#projects-order" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart"></i><span>Orders</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="projects-order" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('all-orders')}}">
              <i class="bi bi-circle"></i><span>All Orders</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-orders')}}">
              <i class="bi bi-circle"></i><span>Add Order</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Orders Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('logout')}}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li>
      <!-- End Logout Nav -->

    </ul>

  </aside>
  <!-- End Sidebar-->