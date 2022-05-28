  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Buku</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php if (session()->getFlashdata('msg')) : ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif; ?>

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ISBN</th>
                      <th>Judul</th>
                      <th>Deskripsi</th>
                      <th>Cover</th>
                      <th>Harga</th>
                      <th>Stock</th>
                      <th>Category</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($books as $row) {
                    ?>
                      <tr>
                        <td><?= $row['isbn']; ?></td>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td><img src="<?= base_url(); ?>/uploads/covers/<?= $row['cover'] ?>" alt="" class="img-thumbnail" /></td>
                        <td>Rp. <?= $row['price']; ?></td>
                        <td><?= $row['quantity']; ?></td>
                        <td><?php foreach ($categories as $key => $value) : ?>
                            <?= $value->name ?>,
                          <?php endforeach ?></td>
                      </tr>
                    <?php
                    }
                    ?>
                    <!-- <tr>
                                        <td>Trident</td>
                                        <td>Internet
                                            Explorer 4.0
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet
                                            Explorer 5.0
                                        </td>
                                    </tr> -->
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->