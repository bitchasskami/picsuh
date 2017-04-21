<?php
if(isset($_SESSION['user'])) {
    echo '
        <div class="container">
            <form action="/user/doAlter" method="post" enctype="application/x-www-form-urlencoded">
                <div class="form-group">
                    <label for="username">Change Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username"  maxlength="16" required>
                </div>
                <button name="alterusrnm" type="submit" class="btn btn-default">Change</button><br><br>
            </form>
            <form action="/user/doAlter" method="post" enctype="application/x-www-form-urlencoded">
                <div class="form-group">
                    <label for="password">Change Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password"  maxlength="50" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="passwordrep" placeholder="Rewrite Password"  maxlength="50" required>
                </div>
                <button name="alterpw" type="submit" class="btn btn-default">Change</button>
            </form>
        </div>';
    echo '<a href="/user/doDelete">Delete Account</a>';
}
    else header('Location: /user/login');