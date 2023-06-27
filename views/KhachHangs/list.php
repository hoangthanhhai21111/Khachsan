<main id="main" class="main">
  <div class="pagetitle">
    <h1>Nhân Viên</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Trang Chủ</a></li>
        <li class="breadcrumb-item active">Danh Sách Nhân Viên</li>
        <!-- <li class="breadcrumb-item ">General</li> -->
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="col-lg-12">
              <!-- lọc nâng cao -->
              <div class=" col-lg-12" id="seachs" style="display:<?= ($ten != '' || $cmnd != '' || $sdt != '') ? 'block' : 'none' ?>;">
                <br>
                <form action="" method="GET">
                  <input type="hidden" name="controller" value="khachhangs" />
                  <input type="hidden" name="page" value="list" />
                  <input type="hidden" name="pages" value="1" />
                  <div class=" col-lg-4 cat">
                    <input type="text" class="form-control" value="<?= $ten ?>" name="ten" placeholder="Tên Khách Hàng ">
                  </div>
                  <div class=" col-lg-4 cat">
                    <input class="form-control" type="text" value="<?= $cmnd ?>" name="cmnd" placeholder="Số CMND">
                  </div>
                  <div class=" col-lg-4 cat">
                    <div class=" col-lg-8 cat">
                      <input class="form-control" type="text" value="<?= $sdt ?>" name="sdt" placeholder="Số điện thoại">
                      <!-- <select class="form-control" name="" name="" id="">
                        <option value="">--Chức vụ--</option>
                      </select> -->
                    </div>
                    <div class=" col-lg-4cat">
                      <button type="submit" class="btn btn-primary">Tim kiếm</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end lọc nang cao -->
              <div class=" col-lg-6 cat">
                <h5 class="card-title">Danh Sách khách hàng</h5>
              </div>
              <div class="col-lg-6 cat cat1">
                <div class='cat' style="text-align:right">
                  <a href="?controller=khachhangs&&page=add" class="btn" style="color:#0022ff;"><u>Thêm mới</u> <i class="bi bi-plus" style="width:100px"></i></a>|
                </div>
                <div class='cat'>
                  <button class="btn" style="color:#0022ff;" onclick="seach()"><u>Lọc nâng cao <i class="bi bi-funnel-fill"></i></u></button>|
                </div>
                <form method="post" action>
                  <input type="hidden" name="controller" value="khachhangs" />
                  <input type="hidden" name="page" value="list" />
                  <input type="hidden" name="pages" value="1" />
                  <div class='cat'>
                    <button onclick=" return confirm('Bạn chắc chăn muốn xóa ?'); " type="submit" class="btn" style="color:#0022ff;"><u>Xóa mục đã chọn</u></button>
                  </div>
              </div>
              <style>
                .cat {
                  float: left;
                }

                .cat1 {
                  margin: 15px 0px 0px 0px;
                }
              </style>
            </div>
            <table class="table table-bordered border-primary">
              <thead>
                <tr>
                  <th scope="col" width="5%">#</th>
                  <th scope="col" class="checked" width="20%">Họ và tên </th>
                  <!-- <th scope="col" class="checked" width="30%">Ảnh</th> -->
                  <th scope="col">Số CMND/CCCD</th>
                  <th scope="col">Số Điện Thoại</th>
                  <th scope="col" width="15%">Phòng</th>
                  <th scope="col" width="15%">Thời Gian đặt</th>
                  <th scope="col" width="5%"> Chọn</th>
                  <th scope="col" width="15%">Tùy chọn</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $row) : ?>
                  <tr class="item-<?= $row->id ?>">
                    <th scope="row"><?= $row->id ?></th>

                    <!-- <td><img src="http://localhost/Quan_ly_khach_san_code_thuan/<?php // echo $row->avatar
                                                                                      ?>" alt=""></td> -->
                    <td><?= $row->ten ?></td>
                    <td><?= $row->cmnd ?></td>
                    <td><?= $row->sdt ?></td>
                    <td><?= $row->name ?></td>
                    <td><?= $row->thoi_gian_dat ?></td>
                    <td style="text-align: center" ;><input type="checkbox" class="form-check-input" name="id[]" value="<?= $row->id ?>"></td>
                    <td> <a href="?controller=khachhangs&page=show&id=<?php echo $row->id; ?>" class="btn"><i class="bi bi-zoom-in" style="color:#0022ff;"></i></a>
                      <a href="?controller=khachhangs&&page=edit&&id=<?php echo $row->id; ?>" class="btn"><i class="bi bi-pencil-square" style="color:#0022ff;"></i></a>
                      <a data-url="?controller=khachhangs&&page=delete&&id=<?php echo $row->id; ?>" id="<?php echo $row->id; ?>" class="btn deleteIcon">
                        <div class="icon"><i class="bi bi-trash" style="color:#0022ff;"></i></div>
                      </a>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </form>
            <!-- End Primary Color Bordered Table -->
            <!-- phan trang -->
            <?php if ($number_page >= 2) :
              $pages = 1;
              if (isset($_GET['pages'])) {
                $pages = $_GET['pages'];
              }
            ?>
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="?controller=khachhangs&&page=list&&pages=<?php echo (isset($_GET["pages"])) ? (($_GET["pages"] - 1) != 0 ? ($_GET["pages"] - 1) : 1) : 1; ?>">Trang Trước</a></li>
                  <?php for ($i = 1; $i <= $number_page; $i++) : ?>
                    <li class="page-item <?= $pages == $i ? "active" : "" ?> "><a class="page-link" href="?controller=khachhangs&&page=list&&pages=<?= $i ?>"><?= $i ?></a></li>
                  <?php endfor; ?>
                  <li class="page-item"><a class="page-link" href="?controller=khachhangs&&page=list&&pages=<?= (isset($_GET["pages"])) ? (($_GET["pages"] + 1) <= $number_page ? ($_GET["pages"] + 1) : $number_page) : $pages + 1 ?>">trang tiếp</a></li>
                </ul>
              </nav>
            <?php endif; ?>
            <!-- end phan trang -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script>
  function seach() {
    var x = document.getElementById("seachs");
    if (x.style.display == "none") {
      x.style = "display:block;";
    } else {
      x.style = "display:none;";
    }
  }
</script>
<script>
  $(document).on('click', '.deleteIcon', function(e) {
    e.preventDefault();
    let id = $(this).attr('id');
    let url = $(this).data('url');
    // let csrf = '{{csrf_token()}}';
    Swal.fire({
      title: 'bạn chắc chắn muốn xóa?',
      text: "bạn sẽ không thể khôi phục khi xóa!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'vâng, xóa nó đi!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: url,
          // method: 'delete',
          data: {
            id: id,
            // _token: csrf
          },
          success: function(res) {
            Swal.fire(
              'Xóa thành công!',
              'Tập tin đã được xóa.',
              'success'
            )
            $('.item-' + id).remove();
          }
        });
      }
    });
  });
</script>