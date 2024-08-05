<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Lunch_Manager</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ request() -> is('admin') ? 'active': ''}}" href="admin">Trang chủ </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request() -> is('eatery') ? 'active': ''}}" href="eatery">Quán ăn</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request() -> is('cars') ? 'active': ''}}" href="cars">Món ăn</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request() -> is('contact') ? 'active': ''}}" href="contact">Nhân viên</a>
          </li>
        </ul>
        
      </div>
    </div>
</nav>