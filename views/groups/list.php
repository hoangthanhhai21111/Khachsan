<?php
include_once "./model/Group.php";
$Group = new Group();
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Chức Vụ</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Trang Chủ</a></li>
        <li class="breadcrumb-item active">Danh Sách Các chức vụ</li>
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
              <div class=" col-lg-6 cat">
                <h5 class="card-title">Danh Sách Các Chức vụ</h5>
              </div>
              <div class="col-lg-6 cat cat1">
                <?php if ($group->haspermission('add_group')) : ?>
                  <div class='cat' style="text-align:right">
                    <a href="?controller=groups&&page=add" class="btn" style="color:#0022ff;"><u>Thêm mới</u> <i class="bi bi-plus" style="width:100px"></i></a>|
                  </div>
                <?php endif; ?>
                <!-- lọc nâng cao -->
                <!-- <div class='cat'>
                  <button class="btn" style="color:#0022ff;" onclick="seach()"><u>Lọc nâng cao <i class="bi bi-funnel-fill"></i></u></button>|
                </div> -->
                <!-- loc nâng cao -->
                <form method="post" action>
                  <input type="hidden" name="controller" value="users" />
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
                  <th scope="col" class="checked" width="20%">Tên chức vụ </th>
                  <!-- <th scope="col" class="checked" width="30%">Ảnh</th> -->
                  <th scope="col" style="text-align: center;" width="5%"> Chọn</th>
                  <th scope="col" width="15%">Tùy chọn</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $row) : ?>
                  <tr class="item-<?= $row->id ?>">
                    <th scope="row"><?= $row->id ?></th>
                    <td><?= $row->name ?></td>
                    <!-- <td><img src="http://localhost/Quan_ly_khach_san_code_thuan/<?php // echo $row->avatar
                                                                                      ?>" alt=""></td> -->
                    <td style="text-align: center" ;><input type="checkbox" class="form-check-input" name="id[]" value="<?= $row->id ?>"></td>
                    <td>
                      <?php if ($Group->haspermission('show_group')) : ?>
                        <a title="xem" href="?controller=groups&page=show&id=<?php echo $row->id; ?>" class="btn btn-info"><i class="bi bi-zoom-in" style=""></i></a>
                      |<?php endif; ?>
                      <?php if ($group->haspermission('update_group')) : ?> 
                        <a title="sửa" href="?controller=groups&&page=edit&&id=<?php echo $row->id; ?>" class="btn btn-secondary"><i class="bi bi-pencil-square" style=""></i></a>
                      |<?php endif; ?>
                      <?php if ($group->haspermission('delete_group')) : ?> 
                        <a title="xóa" data-url="?controller=groups&&page=delete&&id=<?php echo $row->id; ?>" id="<?php echo $row->id; ?>" class="btn deleteIcon btn-danger">
                          <div class="icon"><i class="bi bi-trash" style=""></i></div>
                        </a>
                      <?php endif; ?>
                      <!-- </a> -->
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
                  <li class="page-item"><a class="page-link" href="?controller=groups&&page=list&&pages=<?php echo (isset($_GET["pages"])) ? (($_GET["pages"] - 1) != 0 ? ($_GET["pages"] - 1) : 1) : 1; ?>">Trang Trước</a></li>
                  <?php for ($i = 1; $i <= $number_page; $i++) : ?>
                    <li class="page-item <?= $pages == $i ? "active" : "" ?> "><a class="page-link" href="?controller=groups&&page=list&&pages=<?= $i ?>"><?= $i ?></a></li>
                  <?php endfor; ?>
                  <li class="page-item"><a class="page-link" href="?controller=groups&&page=list&&pages=<?= (isset($_GET["pages"])) ? (($_GET["pages"] + 1) <= $number_page ? ($_GET["pages"] + 1) : $number_page) : $pages + 1 ?>">trang tiếp</a></li>
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
<!-- <script>
  function seach() {
    var x = document.getElementById("seachs");
    if (x.style.display == "none") {
      x.style = "display:block;";
    } else {
      x.style = "display:none;";
    }
  }
</script> -->
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