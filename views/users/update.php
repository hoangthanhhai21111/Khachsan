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
                <label for="inputAddress5" class="form-label">Địa Chỉ: <span style="color:red" id="orrorsAddress">(*)</span></label>
                <input type="text" class="form-control" value="<?= $row->address ?>" name="address" id="address" placeholder="Tỉnh, Huyện , Xã">
              </div>
              <div class="col-6">
                <label for="inputAddress5" class="form-label">Ngày sinh: <span style="color:red" id="orrorsDayOfBirth">(*)</span></label>
                <input type="date" class="form-control" value="<?= $row->day_of_birth ?>" id="dayOfBirth" name="day_of_birth" placeholder="some text value...">
              </div>
              <div class="col-12">
                <label for="inputAddress2" class="form-label">Số Điện Thoại: <span style="color:red" id="orrorsPhone">(*)</span></label>
                <input type="text" maxlength="11" value="<?= $row->phone ?>" class="form-control" id="phone" name="phone">
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
    var errorName = document.getElementById("errorsName");
    var regexName = /^[\p{L}\p{M}\s.'-]+$/u;
    var nameExist = true;
    var nameError = false;
    if (name == "") {
      errorName.innerHTML = "Tên không được bỏ trống!";
      nameExist = false;
    }
    if (!regexName.test(name)) {
      errorName.innerHTML = "Tên không Đúng định dạng!";
      nameExist = false;
    }
    if (nameExist) {
      nameError = true;
    }

    var userName = document.getElementById('userName').value;
    var errorsUserName = document.getElementById("errorsUserName");
    var userNameExist = true;
    var userNameError = false;
    if (userName == "") {
      errorsUserName.innerHTML = "Tên đăng nhập không được bỏ trống!";
      userNameExist = false;
    } else {
      errorsUserName.innerHTML = "";
      userNameExist = true;
    }
    if (userNameExist) {
      userNameError = true;
    }

    var Email = document.getElementById('Email').value;
    var errorsEmail = document.getElementById("errorsEmail");
    var regexEmail = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    var EmailExist = true;
    var emailError = false;
    if (Email == "") {
      errorsEmail.innerHTML = "Email không được bỏ trống!";
      EmailExist = false;
    }
    if (!regexEmail.test(Email)) {
      errorsEmail.innerHTML = "Email không đúng định dạng!";
      EmailExist = false;
    }
    if (EmailExist) {
      emailError = true;
    }

    var address = document.getElementById("address").value;
    var orrorsAddress = document.getElementById("orrorsAddress");
    var addresExist = true;
    var addressError = false;
    if (address == "") {
      orrorsAddress.innerHTML = "Địa chỉ không được bỏ trống!";
      addresExist = false;
    }
    if (addresExist) {
      addressError = true;
    }

    var dayOfBirth = document.getElementById("dayOfBirth").value;
    var orrorsDayOfBirth = document.getElementById("orrorsDayOfBirth");
    var dayOfBirthExist = true;
    var dayOfBirthError = false;
    if (dayOfBirth == "") {
      orrorsDayOfBirth.innerHTML = "Địa chỉ không được bỏ trống!";
      dayOfBirthExist = false;
    }
    if (dayOfBirthExist) {
      dayOfBirthError = true;
    }

    var phone = document.getElementById("phone").value;
    var errorsPhone = document.getElementById("orrorsPhone");
    var regexPhone = /^(09|03|02|07)\d{8}$/;
    var phoneExist = true;
    var phoneError = false;
    if (phone == "") {
      orrorsPhone.innerHTML = "Số điện thoại không được bỏ trống!";
      phoneExist = false;
    } else
    if (!regexPhone.test(phone)) {
      errorsPhone.innerHTML = "Số điện thoại không đúng định dạng!";
      phoneExist = false;
    } else {
      errorsPhone.innerHTML = "";
      phoneExist = true;
    }
    if (phoneExist) {
      phoneError = true;
    }
    if (nameError && phoneError && userNameError && addressError && emailError && dayOfBirthError) {
      return true;
    } else {
      return false;
    }
  }
</script>