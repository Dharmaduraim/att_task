<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h4 class="mb-3 text-center">Login</h4>
<?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('auth/do_login') ?>">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" />
                    <small class="text-danger"><?= form_error('username') ?></small>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" />
                    <small class="text-danger"><?= form_error('password') ?></small>
                </div>
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>
<!--                 <h6 style="text-align-last: end;"><a href="<?= base_url('auth/sign_up') ?>">Sign-up</a></h6>
 -->
        </div>
    </div>
</body>
</html>
