
<div class="container">
    <form action="/user/doLogin" method="post" enctype="application/x-www-form-urlencoded">
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required value = "<?= (!empty($submittedemail)) ? $submittedemail : "" ?>" ><br><br>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <?= (!empty($message)) ? $message : "" ?>
        <button type="submit" class="btn btn-default" name="login">Login</button>
    </form>
</div>