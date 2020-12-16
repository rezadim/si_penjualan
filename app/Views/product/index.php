<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            List Product
                            <a href="<?= base_url('product/create'); ?>" class="btn btn-primary float-right">Tambah</a>
                        </div>
                        <div class="card-body">

                            <?php if(!empty(session()->getFlashdata('success'))): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php endif;?>
                            <?php if(!empty(session()->getFlashdata('info'))): ?>
                                <div class="alert alert-info">
                                    <?= session()->getFlashdata('info'); ?>
                                </div>
                            <?php endif;?>
                            <?php if(!empty(session()->getFlashdata('warning'))): ?>
                                <div class="alert alert-warning">
                                    <?= session()->getFlashdata('warning'); ?>
                                </div>
                            <?php endif;?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                        echo form_label('Category');
                                        echo form_dropdown('category', $categories, $category, ['class' => 'form-control', 'id' => 'category']); 
                                    ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                        echo form_label('Search');
                                        $form_keyword = [
                                            'type'  => 'text',
                                            'name'  => 'keyword',
                                            'id'    => 'keyword',
                                            'value' => $keyword,
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter keyword ...'
                                        ];
                                        echo form_input($form_keyword);
                                    ?>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hovered">
                                    <thead>
                                        <th width="10px" class="text-center">#</th>
                                        <th>Thumbnail</th>
                                        <th>SKU</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $no=0; foreach($products as $key => $row):?>
                                        <tr>
                                            <td class="text-center"><?= ++$no; ?></td>
                                            <td>
                                                <img src="<?= base_url('uploads/'.$row['product_image']); ?>" class="rounded-circle" width="50" height="50">
                                            </td>
                                            <td><?= $row['product_sku']; ?></td>
                                            <td><?= $row['product_name']; ?></td>
                                            <td><?= $row['category_name']; ?></td>
                                            <td><?= "Rp.".number_format($row['product_price']); ?></td>
                                            <td><?= $row['product_status']; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('product/show/'.$row['product_id']); ?>" class="btn btn-sm btn-info">
                                                    <li class="fa fa-eye"></li>
                                                </a>
                                                <a href="<?= base_url('product/edit/'.$row['product_id']); ?>" class="btn btn-sm btn-success">
                                                    <li class="fa fa-edit"></li>
                                                </a>
                                                <a href="<?= base_url('product/delete/'.$row['product_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin???');">
                                                    <li class="fa fa-trash-alt"></li>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-3 float-right">
                                <div class="col-md-12">
                                    <?= $pager->links('product', 'bootstrap_pagination'); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= view('_partials/footer'); ?>