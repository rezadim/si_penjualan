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
                    <form action="<?= base_url('category/store'); ?>" method="post">
                        <div class="card">
                            <div class="card-body">

                                <?php
                                    $inputs = session()->getFlashdata('inputs');
                                    $errors = session()->getFlashdata('errors');
                                ?>

                                <?php if(!empty($errors)): ?>
                                <div class="alert alert-danger" role="alert">
                                    Whoops! Ada kesalahan saat input data, yaitu:
                                    <ul>
                                        <?php foreach($errors as $error): ?>
                                        <li><?= esc($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label>Name</label>
                                    
                                    <input type="text" name="category_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="category_status" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('category'); ?>" class="btn btnoutline-info">Back</a>
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?= view('_partials/footer'); ?>