<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Tun Rice Milling</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .profile-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 10px 10px 0 0;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #667eea;
            margin: 0 auto 1rem;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd6 0%, #6a4399 100%);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #e63a61 0%, #e64426 100%);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0">Tun Rice Milling</h4>
        </div>
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-cart"></i>
                        Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-box"></i>
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-graph-up"></i>
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-people"></i>
                        Customers
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
            <div class="container-fluid">
                <button class="btn btn-link" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle text-dark" type="button" id="userDropdown"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2"></i>
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                        class="bi bi-person me-2"></i>Profile</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" class="d-inline" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Profile Content -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Profile Information -->
                    <div class="card profile-card mb-4">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <i class="bi bi-person"></i>
                            </div>
                            <h4 class="text-center mb-0">{{ Auth::user()->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                                @csrf
                                @method('patch')
                                 @if (session('profile-updated'))
                                    <div class="alert alert-success">
                                        {{ session('profile-updated') }}
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $user->name) }}" required autofocus>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <div class="alert alert-warning">
                                        <p class="mb-0">Your email address is unverified.</p>
                                        <form method="post" action="{{ route('verification.send') }}" class="mt-2">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0">Click here to re-send the
                                                verification email.</button>
                                        </form>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-end mb-4">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="card profile-card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Update Password</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')
                                @if (session('password-updated'))
                                    <div class="alert alert-success mb-4">
                                        {{ session('password-updated') }}
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password" required>
                                    @error('current_password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="card profile-card">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0 text-danger">Delete Account</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Once your account is deleted, all of its resources and data will be
                                permanently deleted.</p>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteAccountModal">
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete your account? Once your account is deleted, all of its resources
                        and data will be permanently deleted.</p>
                    <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                        @csrf
                        @method('delete')
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>