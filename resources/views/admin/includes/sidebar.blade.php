<aside class="main-sidebar  elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link ml-2" style="text-decoration: none">
      <img src="{{asset('assets/images/main_logo.png')}}"  class="" style="opacity: .8">
      <span class="brand-text text-success" style="font-weight:bold;font-size:22px" id="logo_text">  </span>
    </a>
    <hr/>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-open ">
                <a href="{{route('admin.dashboard')}}" style="border:1px solid #009BCB;border-radius:0%" class="nav-link @if($page == "Dashboard") active  @endif">
                  <i class="nav-icon fas fa-tachometer-alt text-dark @if($page == "Dashboard") text-white  @endif"></i>
                  <p  style="font-size:14px;color:black;font-weight:bold" class="@if($page == "Dashboard") text-white  @endif">
                   DASHBOARD
                  </p>
                </a>
              </li>
              
              
          <li class="nav-item menu-open ">
            <a href="" style="border:1px solid #009BCB;border-radius:0%" class="nav-link @if($page == "Parent_Categories" || $page == "Parent_Categories_Edit" || $page == "Sub_Categories" || $page == "Sub_Categories_Edit" || $page == "Child_Categories" || $page == "Child_Categories_Edit") active  @endif">
              <i class="nav-icon fas fa-tachometer-alt text-dark @if($page == "Parent_Categories" || $page == "Parent_Categories_Edit" || $page == "Sub_Categories" || $page == "Sub_Categories_Edit" || $page == "Child_Categories" || $page == "Child_Categories_Edit") text-white  @endif"></i>
              <p  style="font-size:14px;color:black;" class="@if($page == "Parent_Categories" || $page == "Parent_Categories_Edit" || $page == "Sub_Categories" || $page == "Sub_Categories_Edit" || $page == "Child_Categories" || $page == "Child_Categories_Edit") text-white  @endif">
               CORE FEATURES
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('parent-categories')}}" style="border-radius:0%" class="nav-link @if($page == "Parent_Categories") active2  @endif">
                  <i class="far fa-circle nav-icon text-dark @if($page == "Parent_Categories") text-white  @endif"></i>
                  <p id="side_menu_text" class="@if($page == "Parent_Categories") text-white  @endif" style="font-size:11px">PARENT CATEGORIES</p>
                </a>
              </li>
               {{-- @if($page == "subCategories") active2  @endif --}}
              <li class="nav-item">
                <a href="{{route('sub_categories')}}"  style="border-radius:0%" class="nav-link @if($page == "Sub_Categories") active2  @endif" id="sub_categories">
                  <i class="far fa-circle nav-icon text-dark @if($page == "Sub_Categories") text-white  @endif "></i>
                  <p id="side_menu_text" style="font-size:11px" class="@if($page == "Sub_Categories") text-white  @endif">SUB CATEGORIES</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('child_categories')}}" style="border-radius:0%" class="nav-link @if($page == "Child_Categories") active2  @endif ">
                  <i class="far fa-circle nav-icon text-dark @if($page == "Child_Categories") text-white  @endif "></i>
                  <p id="side_menu_text" style="font-size:11px" class="@if($page == "Child_Categories") text-white  @endif">CHILD CATEGORIES</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="" style="border-radius:0%" class="nav-link">
                  <i class="far fa-circle nav-icon text-dark "></i>
                  <p id="side_menu_text" style="font-size:11px" class="">BRANDS</p>
                </a>
              </li>


            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>