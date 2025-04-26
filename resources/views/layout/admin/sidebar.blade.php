<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse fixed">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('admin.auth.dashboard') }}">
                    <i class="bi bi-house-door"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text"></i>
                    <span class="ms-2">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.products.index') }}">
                    <i class="bi bi-cart3"></i>
                    <span class="ms-2">Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people-fill"></i>
                    <span class="ms-2">User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.roles.index') }}">
                    <i class="bi bi-person-gear"></i>
                    <span class="ms-2">Roles&Permissions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.roles.index') }}">
                    <i class="bi bi-people"></i>
                    <span class="ms-2">Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bar-chart-line"></i>
                    <span class="ms-2">Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-layers"></i>
                    <span class="ms-2">Integrations</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
