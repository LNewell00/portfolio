<!-- The Modal -->
<div class="modal fade" id="Settings">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Settings Page</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="/model/login.php">
                <!-- Modal body -->
                <div class="modal-body mb-3 mt-3">
                    <div class="mb-3 mt-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="mb-3 mt-3">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                    </div>
                    <div class="mb-3 mt-3">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                    </div>
                    <div class="mb-3 mt-3">
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
                        <br>
                        <input type="password" class="form-control" id="cpwd" name="cpwd" placeholder="Confirm Password">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer mb-3 mt-3">
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>