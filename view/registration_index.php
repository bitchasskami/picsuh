<div class="container">
    <form action="/user/doRegistration" method="post" enctype="application/x-www-form-urlencoded">
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required><br><br>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required><br><br>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required><br><br>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="passwordrep" placeholder="Rewrite Password" required><br><br>
        </div>
        <button name="reg" type="submit" class="btn btn-default">Submit</button>
    </form>
</div>