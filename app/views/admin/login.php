<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#login-form">Login</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="login-form">
                            <form action="/questwise/admin/login" method="POST">
                                <?php if ($model) echo $model; ?>
                                <div class="mb-3">
                                    <label for="loginUsername" class="form-label">Username</label>
                                    <input required name="username" class="form-control" id="loginUsername" aria-describedby="usernameHelp" placeholder="Enter username">
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <input type="password" name="password" required class="form-control" id="loginPassword" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>