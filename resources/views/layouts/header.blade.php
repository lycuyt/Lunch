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
            <a class="nav-link {{ request() -> is('food') ? 'active': ''}}" href="food">Món ăn</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request() -> is('statistics') ? 'active': ''}}" href="statistics">Thống kê</a>
          </li>
        </ul>
        <form class="d-flex px-5" action="/logout" method="POST">
          @csrf
          <button class="btn btn-primary" type="submit">Log out</button>
      </form>
      
      </div>
    </div>
</nav>