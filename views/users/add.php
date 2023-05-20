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
            <form onsubmit="return addUser()" class="row g-3" method="post" enctype="multipart/form-data">

              <div class="col-md-6">
                <label for="inputName5" class="form-label">Họ Tên: <span style="color:red" id="errorsName">(*)</span></label>
                <input type="text" class="form-control name" name='name' id="name">
              </div>
              <div class="col-md-6">
                <label for="inputZip" class="form-label">Tên Đăng Nhập:<span style="color:red" id="errorsUserName">(*)</span></label>
                <input type="text" class="form-control" name="username" id="userName">
              </div>
              <div class="col-md-6">
                <label for="inputEmail5" class="form-label">Địa Chỉ Email: <span style="color:red" id="errorsEmail">(*)</span></label>
                <input type="text" name='email' class="form-control" id="email">
              </div>
              <div class="col-md-6">
                <label for="inputPassword5" class="form-label">Mật Khẩu: <span style="color:red" id="errorsPassword">(*)</span></label>
                <input type="password" name="password" class="form-control" id="password">
              </div>
              <div class="col-6">
                <label for="inputAddress5" class="form-label">Địa Chỉ: <span style="color:red" id="errorsAddress">(*)</span></label>
                <input type="text" class="form-control" name="address" id="Address" placeholder="Xã, Huyện, Tỉnh">
              </div>
              <div class="col-6">
                <label for="inputAddress5" class="form-label">Ngày sinh:<span style="color:red" id="errorsBirthDay">(*)</span></label>
                <input type="date" class="form-control" name="day_of_birth" id="BirthDay">
              </div>
              <div class="col-12">
                <label for="inputAddress2" class="form-label">Số Điện Thoại:<span style="color:red" id="errorsPhone">(*)</span></label>
                <input type="text" maxlength="11" class="form-control" id="Phone" name="phone">
              </div>
              <div class="col-md-6">
                <label for="inputCity" class="form-label">Ảnh:</label>
                <input type="file" class="form-control" name="avatar" id="inputCity">
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Chức Vụ:</label>
                <select id="inputState" name="group" class="form-select">
                  <?php foreach ($rows as $row) : ?>
                    <option value="<?= $row->id ?>"><?= $row->name ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary" name="store">Submit</button>
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

    var userName = document.getElementById("userName").value;
    var errorsUserName = document.getElementById("errorsUserName");
    var username = '';
    const usernames = [1];
    <?php foreach ($users as $iii) : ?>
      usernames.push("<?php echo ($iii['username']); ?>")
    <?php endforeach ?>
    for (var i = 0; i < usernames.length; i++) {
      if (userName == "" || userName == null) {
        errorsUserName.innerHTML = "Tên đăng nhập không được bỏ trống!";
        break;
      } else if (userName == usernames[i]) {
        errorsUserName.innerHTML = "Tên đăng nhập đã tồn tại!";
        break;
      } else {
        errorsUserName.innerHTML = "";
        username = true;
      }
    }

    var Email = document.getElementById("email").value;
    var errorsEmail = document.getElementById("errorsEmail");
    var regexEmail = /[A-Z0-9._%+-]+@[A-Z0-9]+.+.[A-Z]{2,4}/igm;
    var email = '';
    const emails = [1];
    <?php foreach ($users as $iii) : ?>
      emails.push("<?php echo ($iii['email']); ?>")
    <?php endforeach ?>
    for (var i = 0; i < emails.length; i++) {
      if (Email == "" || Email == null) {
        errorsEmail.innerHTML = "Email không được bỏ trống!";
        break;
      }
      if (Email == emails[i]) {
        errorsEmail.innerHTML = "Email nhập đã tồn tại!";
        break;
      } else {
        errorsEmail.innerHTML = "";
        email = true;
      }

    }

    var password = document.getElementById("password").value;
    var errorsPassword = document.getElementById("errorsPassword");
    var Password = '';
    if (password == "" || password == null) {
      errorsPassword.innerHTML = "Mật khẩu không được bỏ trống!";
    } else {
      errorsPassword.innerHTML = "";
      Password = true;
    }

    var Address = document.getElementById("Address").value;
    var errorsAddress = document.getElementById("errorsAddress");
    var address = '';
    if (Address == "" || Address == null) {
      errorsAddress.innerHTML = "Địa chỉ không được bỏ trống!";
    } else {
      errorsAddress.innerHTML = "";
      address = true;
    }

    var BirthDay = document.getElementById("BirthDay").value;
    var errorsBirthDay = document.getElementById("errorsBirthDay");
    var birthday = '';
    if (BirthDay == "" || BirthDay == null) {
      errorsBirthDay.innerHTML = "Ngày sinh không được bỏ trống!";
    } else {
      errorsBirthDay.innerHTML = "";
      birthday = true;
    }

    var Phone = document.getElementById("Phone").value;
    var errorsPhone = document.getElementById("errorsPhone");
    var phone = '';
    const phones = [1];
    <?php foreach ($users as $iii) : ?>
      phones.push("<?php echo ($iii['phone']); ?>")
    <?php endforeach ?>
    for (var i = 0; i < phones.length; i++) {
      if (Phone == "" || Phone == null) {
        errorsPhone.innerHTML = "Số điện thoại không được bỏ trống!";
        break;
      }
      if (Phone == phones[i]) {
        errorsPhone.innerHTML = "Số điện thoại đã tồn tại!";
        break;
      } else {
        errorsPhone.innerHTML = "";
        phone = true;
      }
    }
    if (username && name && Password && address && birthday && phone && email) {
      return true;
    } else {
      return false;
    }
  }
</script>