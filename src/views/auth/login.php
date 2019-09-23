<div class="row">
    <div class="container">
        <div class="col-md-6">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email"
                           type="email" class="form-control"
                           id="exampleInputEmail1"
                           aria-describedby="emailHelp"
                           required
                           placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password"
                           type="password" class="form-control"
                           id="password"
                           aria-describedby="emailHelp"
                           required
                           placeholder="Enter password">
                </div>

                <?php if (isset($errors)) : ?>
                    <span class="text-danger"> Invalid cridetials</span>
                    <p></p>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary">Login</button>

            </form>
        </div>
    </div>
</div>
