<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">System Settings</h1>
        </div>
        <div class="card-body">
            <form id="settingForm" method="post" class="needs-validation" novalidate>
                <strong>Application Detail</strong>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="applicationName">Application Name</label>
                            <input type="text" name="applicationName" id="applicationName" class="form-control" maxlength="50" placeholder="Acme Company" value="<?= $setting['applicationName'] ?>" required>
                            <small class="text-muted">maxlength is 50 character</small>
                        </div>
                        <div class="form-group">
                            <label for="applicationDescription">Application Description</label>
                            <textarea name="applicationDescription" id="applicationDescription" class="form-control" placeholder="Your short and great company explaination..." maxlength="45" required><?= $setting['applicationDescription'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="appId">AppID</label>
                            <input type="text" class="form-control bg-secondary" value="<?= $setting['appId'] ?>" readonly>
                            <small class="text-muted">Use AppID to connect with SleekwareDB API</small>
                        </div>
                        <div class="form-group">
                            <label for="appSecret">App Secret</label>
                            <input type="text" class="form-control bg-secondary" value="<?= $setting['appSecret'] ?>" readonly>
                            <small class="text-muted">Use App Secret to connect with SleekwareDB API</small>
                        </div>
                    </div>
                </div>
                <hr>
                <strong>Administrator Detail</strong>
                <hr>
                <div class="form-group row">
                    <div class="col-6 mb-3">
                        <label for="fullname">Fullname</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Robert J. Kaff" value="<?= $user['fullname'] ?>" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="robert@email.com" value="<?= $user['email'] ?>" required>
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
            </form>
        </div>
    </div>
</div>
