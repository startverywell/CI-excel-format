<style>
.pagination1 a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
}

.pagination1 a.active1 {
  background-color: dodgerblue;
  color: white;
}

.pagination1 a:hover:not(.active1) {background-color: #ddd;}
</style>
<h1 class="mt-4">3PL LIST</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row mb-3">
    <div class="col-md-6"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="<?php echo site_url('/pllist/create')?>">
            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
            Add 3PL
        </a>
        <a class="btn btn-success" href="<?php echo site_url('/pllist/export')?>">
            <i class="fa-solid fa-circle-down fa-beat" style="color: #ffffff;"></i>
            Export Excel
        </a>
        <a class="btn btn-info" href="<?php echo site_url('/pllist/import')?>">
            <i class="fa-solid fa-circle-arrow-up fa-beat-fade" style="color: #fafafa;"></i>
            Import Excel
        </a>
    </div>
</div>
<div class="row">
    <form action="<?php echo site_url('/pllist/pagenation')?>" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="sku_search" placeholder="Search" value="<?php echo $search?>">
            <button class="btn btn-success" type="submit">Search</button>
        </div>
    </form>
    <?php if (isset($returndata)) { ?>
        <table border="1" cellpadding="0" cellspacing="0" class="table table-striped table-hover dataTable no-footer">
            <tr>
                <th>No.</th>
                <th>SKU</th>
                <th>Description</th>
                <th>Description2</th>
                <th>PCS</th>
                <th>Action</th>
            </tr>
            <tbody>
                <?php 
                    $limitstart = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
                    $no = $limitstart*10/10;
                    $no++;
                    if ($returndata != false) {
                        foreach ($returndata as $pl) {
                            echo '<tr>';
                            echo '<td>'.$no++.'</td>';
                            echo '<td>'.$pl->sku.'</td>';
                            echo '<td>'.$pl->description.'</td>';
                            echo '<td>'.$pl->description2.'</td>';
                            echo '<td>'.$pl->qty.'</td>';
                            echo '<td>
                                <a class="btn" href="'.site_url('/pllist/read/'.$pl->id).'">
                                    <i class="fa-solid fa-eye" style="color: green;"></i> 
                                    Read
                                </a> 
                                <a class="btn" href="'.site_url('/pllist/edit/'.$pl->id).'">
                                <i class="fa-regular fa-pencil" style="color: red;"></i>
                                Edit</a>
                                <a class="btn" href="'.site_url('/pllist/delete/'.$pl->id).'">
                                <i class="fa-regular fa-trash-can" style="color: red;"></i>
                                Delete</a>
                                </td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div>No user(s) found.</div>
    <?php } ?>

    <?php if (isset($paginetionlinks)) { ?>
        <?php echo $paginetionlinks ?>
    <?php } ?>
</div>