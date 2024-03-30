<?php $error = isset($data['error'])?$data['error']:''; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/login.css">
    <title>Login</title>
</head>
<body>
    <div id="login-form-wrapper">
        <form action="" method="POST">
            <h1 id="form-header">Đăng nhập</h1>
            <input type="text" name="username" placeholder="Username" value="<?php echo set_value('username') ?>">
            <div class="login-error"><?php form_error('username') ?></div>
            <input type="password" name="password" placeholder="Password" value="<?php echo set_value('password') ?>">
            <div class="login-error"><?php form_error('password') ?></div>
            <div><input type="checkbox" name="remember" id="remember-me"><label for="remember-me">Ghi nhớ tôi</label><br></div>
            <button type="submit" name="login-btn" id="login-btn">Đăng nhập</button>
            <div><?php form_error('login') ?></div>
        </form>
        <a href="?mod=users&action=forget_pass" id="lost-pass">Quên mật khẩu?</a><br>
        <a href="?mod=users&action=reg">Đăng kí</a>
    </div>
</body>
</html>