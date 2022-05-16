<div class="container my-5 d-flex align-items-center justify-content-center">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title text-center"><?= $title ?></h1>
        </div>
        <div class="card-body">
            <form id="installForm" method="post" class="needs-validation" novalidate>
                <div class="card-text text-center">Preparation for installation before using Sleek preDB. Please fill in all the fields provided.</div>
                <hr>
                <h3 class="text-center">Application Detail</h3>
                <hr>
                <div class="form-group">
                    <label for="applicationName">Application Name</label>
                    <input type="text" name="applicationName" id="applicationName" class="form-control" maxlength="50" placeholder="Acme Company" required>
                    <small class="text-muted">maxlength is 50 character</small>
                </div>
                <div class="form-group">
                    <label for="applicationDescription">Application Description</label>
                    <textarea name="applicationDescription" id="applicationDescription" class="form-control" placeholder="Your short and great company explaination..." maxlength="45" required></textarea>
                </div>
                <hr>
                <h3 class="text-center">Administrator Detail</h3>
                <hr>
                <div class="form-group row">
                    <div class="col-6 mb-3">
                        <label for="fullname">Fullname</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Robert J. Kaff" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Robert J. Kaff" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" minlength="8" placeholder="Enter your password" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="rePassword">Retype Password</label>
                        <input type="password" name="rePassword" id="rePassword" class="form-control" minlength="8" placeholder="Enter again your password" required>
                    </div>
                </div>
                <?php $appId = bin2hex(random_bytes('8'));  ?>
                <input type="hidden" name="appId" value="<?= $appId ?>">
                <input type="hidden" name="appSecret" value="<?= sha1($appId . time()) ?>">
                <input type="hidden" name="role" value="super">
                <button class="btn btn-block btn-primary">Install SleekwareDB</button>
            </form>
        </div>
    </div>
</div>
