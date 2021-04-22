<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Daftar User
        <small>Add, Edit, Delete</small>
        <a class="btn btn-success pull-right" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Tambah User Baru</a>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><b>DAFTAR USER</b></h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Pencarian"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i> Cari</button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body col-sm-12 table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>NO</th>
                      <th width="250px">NAMA</th>
                      <th>USERNAME</th>
                      <th>LEVEL</th>
                      <th class="text-center">AKSI</th>
                    </tr>
                    <?php
                    $no = 1;
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $record->name ?></td>
                      <td><?php echo $record->username ?></td>
                      <td><?php echo strtoupper($record->level) ?></td>
                      <td class="text-center">
                          <a class="btn btn-xs btn-info" href="<?php echo base_url().'editOld/'.$record->id_user; ?>"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-xs btn-danger deleteUser" href="#" data-userid="<?php echo $record->id_user; ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->

                <a class="btn btn-danger" href="<?php echo base_url(); ?>listuser/export"><i class="fa fa-print"></i> Export EXCEL</a>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
