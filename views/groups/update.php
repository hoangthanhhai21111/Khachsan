<main id="main" class="main">
  <div class="pagetitle">
    <h1>Thêm Nhân Viên</h1>
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
            <h5 class="card-title">Thêm Chức Vụ</h5>
            <!-- Multi Columns Form -->
            <form onsubmit="return addUser()" class="row g-3" method="post" enctype="multipart/form-data">

              <div class="col-md-8">
                <label for="inputName5" class="form-label">Tên chức vụ: <span style="color:red" id="errorsName">(*)</span></label>
                <input type="text" class="form-control name" name='name' id="name" value="<?=$groups->name?>">
              </div>

              <div class="form-group">
                            <h4>Quyền hạn</h4>
                            <label class="form-check form-switch ">CheckAll
                                <input style="margin-left: 0.5em;" type="checkbox" id="checkAll" class="form-check-input"
                                    value="Quyền hạn">
                            </label>
                            <div class="row">
                                <?php foreach ($position_names as $group_name => $roles):?>
                                    <div class="list-group list-group-flush list-group-bordered col-lg-4">
                                        <div class="list-group-header" style="color:rgb(2, 6, 249) ;">
                                            <h5> <?=$group_name?></h5>
                                        </div>
                                       <?php foreach ($roles as $role):?>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <span style="color: rgb(103, 40, 40) ;"><?=$role['name']?></span>
                                                <!-- .switcher-control -->
                                                <label class="form-check form-switch ">
                                                    <input type="checkbox" <?php foreach ($group_role as $group){if($group->role_id == $role['id']){echo 'checked="checked"';}}?>  name="roles[]"
                                                        class="checkItem form-check-input checkItem"
                                                        value="<?= $role['id'] ?>">
                                                    <span class="switcher-indicator"></span>
                                                </label>
                                                <!-- /.switcher-control -->
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary" name="update">Submit</button>
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
<script>
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
</script>