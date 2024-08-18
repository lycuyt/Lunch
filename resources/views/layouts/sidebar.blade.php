<aside class="main-sidebar">
  <style>
    .main-sidebar {
      position: fixed; /* Đảm bảo sidebar cố định bên cạnh màn hình */
      height: 100%; /* Chiều cao của sidebar bằng 100% chiều cao của cửa sổ trình duyệt */
      overflow-y: auto; /* Thêm thanh cuộn dọc nếu nội dung dài hơn chiều cao màn hình */
    }

    /* Đảm bảo rằng nội dung chính cũng có chiều cao tối thiểu bằng với chiều cao của sidebar */
    .content-wrapper {
      min-height: 100vh; /* Đặt chiều cao tối thiểu cho nội dung trang */
      margin-left: 230px; /* Tương ứng với chiều rộng của sidebar để tránh nội dung bị chồng lên */
    }
  </style>
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ auth()->user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <li class="{{ Request::is('admin') ? 'active' : '' }}">
        <a href="{{ url('admin') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="{{ Request::is('eatery') ? 'active' : '' }}">
          <a href="{{ url('eatery') }}">
            <i class="fa fa-th"></i> <span>Quản lý quán ăn</span>
          </a>
      </li>

      <li class="{{ Request::is('food') ? 'active' : '' }}">
          <a href="{{ url('food') }}">
            <i class="fa fa-th"></i> <span>Quản lý món ăn</span>
          </a>
      </li>

      <li class="{{ Request::is('lunch_request') ? 'active' : '' }}">
          <a href="{{ url('lunch_request') }}">
            <i class="fa fa-th"></i> <span>Lên lịch ăn</span>
          </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>


