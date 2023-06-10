<div class="form-group">
                <h4>Quyền hạn</h4>
                <label class="form-check form-switch ">CheckAll
                  <input style="margin-left: 0.5em;" type="checkbox" id="checkAll" class="form-check-input" value="Quyền hạn">
                </label>
                <div class="row">
                  <?php foreach ($position_names as $group_name => $roles) : ?>
                    <div class="list-group list-group-flush list-group-bordered col-lg-4">
                      <div class="list-group-header" style="color:rgb(2, 6, 249) ;">
                        <h5> <?= $group_name ?> </h5>
                      </div>
                      <?php foreach ($roles as $role) : ?>
                        <div class="list-group-item d-flex justify-content-be
                                            tween align-items-center">
                          <span style="color: rgb(103, 40, 40) ;"><?= $role['name'] ?></span>
                          <!-- .switcher-control -->
                          <label class="form-check form-switch ">
                            <input type="checkbox" @checked(in_array($role['id'], $userRoles)) name="roles[]" class="checkItem form-check-input checkItem" value="<?= $role['id'] ?>">
                            <span class="switcher-indicator"></span>
                          </label>
                          <!-- /.switcher-control -->
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>