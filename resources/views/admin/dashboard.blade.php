<x-app-layout>

   
        <style>
            .admin-body {
                min-height: 100vh;
                background-color: #f8f9fa;
            }
    
            .sidebar {
                min-height: 100vh;
                background-color: #343a40;
                color: #fff;
            }
    
            .sidebar a {
                color: #adb5bd;
                text-decoration: none;
            }
    
            .sidebar a:hover {
                color: #fff;
            }
    
            .content {
                padding: 20px;
            }
        </style>

        <div class="admin-body">
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                        <div class="position-sticky">
                            <h5 class="sidebar-heading text-center py-3">Admin Panel</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">
                                        <i class="bi bi-speedometer2"></i> Dashboard
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
        
                    <!-- Main Content -->
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">Dashboard</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-bg-primary mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Users</h5>
                                        <p class="card-text">102 Registered Users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-bg-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Active Users</h5>
                                        <p class="card-text">95 Currently Active</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-bg-warning mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Pending Tasks</h5>
                                        <p class="card-text">7 Pending Approvals</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    
     
       
</x-app-layout>
