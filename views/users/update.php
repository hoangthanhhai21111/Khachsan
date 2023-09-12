<main id="main" class="main">
  <div class="pagetitle">
    <h1>Thêm Nhân Viên</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
        <li class="breadcrumb-item">Nhân Viên</li>
        <li class="breadcrumb-item active">Thêm Nhân Viên</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Thêm nhân viên</h5>
            <!-- Multi Columns Form -->
            <form onsubmit="return updateUser()" class="row g-3" action="#" method="post" enctype="multipart/form-data">
              <div class="col-md-6">
                <label for="inputName5" class="form-label">Họ Tên: <span style="color:red" id="errorsName">(*)</span></label>
                <input type="text" class="form-control" name='name' value="<?= $row->name ?>" id="inputName5">
              </div>
              <div class="col-md-6">
                <label for="inputZip" class="form-label">Tên Đăng Nhập: <span style="color:red" id="errorsUserName">(*)</span></label>
                <input type="text" class="form-control" value="<?= $row->username ?>" name="username" id="userName">
              </div>
              <div class="col-md-12">
                <label for="inputEmail5" class="form-label">Email: <span style="color:red" id="errorsEmail">(*)</span></label>
                <input type="email" name='email' value="<?= $row->email ?>" class="form-control" id="Email">
              </div>
              <div class="col-6">
                <label for="inputAddress5" class="form-label">Địa Chỉ</label>
                <input type="text" class="form-control" value="<?= $row->address ?>" name="address" id="inputAddres5s" placeholder="Tỉnh, Huyện , Xã">
              </div>
              <div class="col-6">
                <label for="inputAddress5" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" value="<?= $row->day_of_birth ?>" name="day_of_birth" placeholder="some text value...">
              </div>
              <div class="col-12">
                <label for="inputAddress2" class="form-label">Số Điện Thoại</label>
                <input type="text" maxlength="11" value="<?= $row->phone ?>" class="form-control" id="" name="phone">
                <!-- <input type="text" maxlength="2" id="sessionNo" name="sessionNum" onkeypress="return isNumberKey(event)" /> -->

              </div>
              <div class="col-md-6">
                <label for="inputCity" class="form-label">Ảnh</label>
                <input type="file" class="form-control" name="avatar" id="inputCity">
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Chức Vụ</label>
                <select id="inputState" name="group" class="form-select">
                  <?php foreach ($groups as $group) : ?>
                    <option value="<?= $group->id ?>" <?= $row->group_id == $group->id ? 'selected' : ""; ?>><?= $group->name ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- End Multi Columns Form -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script>
  function updateUser() {
    var name = document.getElementById("inputName5").value;
    var errorsName = document.getElementById("errorsName");
    var regexName = /^[\p{L}\p{M}\s.'-]+$/u;
    var nameError = true;
    if (name == "") {
      errorsName.innerHTML = "Tên không được bỏ trống!";
      nameError = false;
    }
    if (!regexName.test(name)) {
      errorsName.innerHTML = "Tên không Đúng định dạng!";
      nameError = false;
    }

    var userName = document.getElementById('userName').value;
    var errorsUserName = document.getElementById("errorsUserName");
    var userNameError = true;
    if (userName == "") {
      errorsUserName.innerHTML = "Tên đăng nhập không được bỏ trống!";
      userNameError = false;
    }

    var Email = document.getElementById('Email').value;
    var errorsEmail = document.getElementById("errorsEmail");
    var regexEmail = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    var userEmail = true;
    if (Email == "") {
      errorsEmail.innerHTML = "Email không được bỏ trống!";
      userEmail = false;
    }
    if(!regexEmail.test(Email)){
      errorsEmail.innerHTML = "Email không đúng định dạng!";
      userEmail = false;
    }

    return false;
  }
</script>