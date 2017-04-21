<div class="container">
    <form action="/user/doRegistration" method="post" enctype="application/x-www-form-urlencoded">
        <div class="form-group">
            <input type="email" id="email" class="form-control" name="email" placeholder="Email max 50 Chars" maxlength="50" required><br><br>
        </div>
        <div class="form-group">
            <input type="text" id="username" class="form-control" name="username" placeholder="Username max 16 Chars" maxlength="16" required><br><br>
        </div>
        <div class="form-group">
            <input type="password" id="password" class="form-control" name="password" placeholder="Password max 50 Chars" maxlength="50" required><br><br>
        </div>
        <div class="form-group">
            <input type="password" id="passwordrep" class="form-control" name="passwordrep" placeholder="Rewrite Password max 50 Chars" maxlength="50" required><br><br>
        </div>
        <button name="reg" type="submit" class="btn btn-default">Submit</button>
    </form>
</div>