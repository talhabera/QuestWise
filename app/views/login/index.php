<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link <?php if (!$model->register) echo "active" ?>" id="login-tab" data-bs-toggle="tab" href="#login-form">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($model->register) echo "active" ?>" id="register-tab" data-bs-toggle="tab" href="#register-form">Register</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade <?php if (!$model->register) echo "show active" ?>" id="login-form">
                            <form action="/login" method="POST">
                                <?php if (!$model->register) echo $model->displayAlertMessage; ?>
                                <div class="mb-3">
                                    <label for="loginUsername" class="form-label">Username</label>
                                    <input required name="username" class="form-control" id="loginUsername" aria-describedby="usernameHelp" placeholder="Enter username">
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <input type="password" name="password" required class="form-control" id="loginPassword" placeholder="Password">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                        <div class="tab-pane fade <?php if ($model->register) echo "show active" ?>" id="register-form">
                            <form action="/register" method="POST">
                                <?php if ($model->register) echo $model->displayAlertMessage; ?>
                                <div class="mb-3">
                                    <label for="registerUsername" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" required id="registerUsername" placeholder="Enter username">
                                </div>
                                <div class="mb-3">
                                    <label for="registerEmail" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" required id="registerEmail" placeholder="Enter email">
                                </div>
                                <div class="mb-3">
                                    <label for="registerPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required id="registerPassword" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <label for="registerPasswordAgain" class="form-label">Password Again</label>
                                    <input type="password" name="passwordAgain" class="form-control" required id="registerPasswordAgain" placeholder="Password Again">
                                </div>
                                <button type="submit" class="btn btn-success">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>