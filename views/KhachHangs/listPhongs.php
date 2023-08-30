<main id="main" class="main">
    <div class="pagetitle">
        <h1>Chọn Phòng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                <li class="breadcrumb-item">Chức vụ</li>
                <li class="breadcrumb-item active">Thêm Chức Vụ</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><u>Thông tin khách hàng</u></h5>
                        <!-- Multi Columns Form -->
                        <form onsubmit="return addUser()" class="row g-3" method="post" enctype="multipart/form-data">
                            <!-- <div class="col-md-8"> -->
                            <table>
                                <tr>
                                    <th>
                                        <h5><b>Họ tên: </b> </h5>
                                    </th>
                                    <td>
                                        <h5><?= $khachs->ten ?></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <h5><b>Số đt: </b></h5>
                                    </th>
                                    <td>
                                        <h5><?= $khachs->sdt ?></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <h5><b>Số cmnd/cccd: </b></h5>
                                    </th>
                                    <td>
                                        <h5><?= $khachs->cmnd ?></h5>
                                    </td>
                                </tr>
                            </table>
                            <hr width="30%" align="center" />
                            <h5 class="card-title"><u>Chọn phòng</u></h5>
                            <div class="form-group">
                                <div class="row">
                                    <?php foreach ($hangs as $hangs => $phongs) : ?>
                                        <div class="list-group list-group-flush list-group-bordered col-lg-4">
                                            <div class="list-group-header" style="color:rgb(2, 6, 249) ;">
                                                <h5> <?= $hangs ?></h5>
                                            </div>
                                            <?php foreach ($phongs as $phong) : ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span style="color: rgb(103, 40, 40);"><b><?= $phong['name'] ?></b> &emsp;  [ <?= number_format($phong['gia'])  ?> vnđ ] </span>
                                                    <!-- .switcher-control -->
                                                    <?php if ($phong['name'] != '') : ?>
                                                        <label class="form-check form-switch ">
                                                            <input type="checkbox" name="roles[]" class="checkItem form-check-input checkItem" value="<?= $phong['id'] ?>">
                                                            <span class="switcher-indicator"></span>
                                                        </label>
                                                    <?php endif; ?>
                                                    <!-- /.switcher-control -->
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="store">Đặt phòng</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $('#checkAll').click(function() {
        $(':checkbox.checkItem').prop('checked', this.checked);
    });
</script>
<!-- <script>
    function addUser() {
        var Name = document.getElementById("name").value;
        var errorsName = document.getElementById("errorsName");
        var regexName = /^[^\d+]*[\d+]{0}[^\d+]*$/;
        var name = "";
        if (Name == "" || Name == null) {
            errorsName.innerHTML = "Tên không được bỏ trống!";
        } else if (!regexName.test(Name)) {
            errorsName.innerHTML = "Tên Sai định dạng!";
        } else {
            errorsName.innerHTML = "";
            name = true;
        }
        if (name) {
            return true;
        } else {
            return false;
        }
    }
</script> -->