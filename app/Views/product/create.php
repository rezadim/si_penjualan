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

                    <?= form_open_multipart('product/store'); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                            // echo form_label('Category');
                                            // echo form_dropdown('category_id', $categories, ['class'=>'form-control']);
                                        ?>
                                        <label>Category</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Pilih Kategori</option>
                                            
                                            <?php foreach($categories as $c): ?>
                                            <option value="<?= $c['category_id']; ?>"><?= $c['category_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo form_label('Name');
                                            $product_name = [
                                                'type'=>'text',
                                                'name'=>'product_name',
                                                'id'=>'product_name',
                                                'class'=>'form-control'
                                            ];
                                            echo form_input($product_name);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo form_label('Price');
                                            $product_price = [
                                                'type'=>'number',
                                                'name'=>'product_price',
                                                'id'=>'product_price',
                                                'class'=>'form-control'
                                            ];
                                            echo form_input($product_price);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <?php
                                                echo form_label('SKU');
                                                $product_sku = [
                                                    'type'=>'text',
                                                    'name'=>'product_sku',
                                                    'id'=>'product_sku',
                                                    'class'=>'form-control'
                                                ];
                                                echo form_input($product_sku);
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                // echo form_label('Status', 'Status');
                                                // echo form_dropdown('product_status', [''=>'PILIH', 'Active'=>'Active', 'Inactive'=>'Inactive'], ['class'=>'form-control']);
                                            ?>
                                            <label>Status</label>
                                            <select name="product_status" class="form-control">
                                                <option value="">Pilih</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                echo form_label('Image');
                                                echo form_upload('product_image', '', ['class'=>'form-control']);
                                            ?>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                        <?php
                                            echo form_label('Description');
                                            $product_desc = [
                                                'type'=>'text',
                                                'name'=>'product_description',
                                                'id'=>'product_description',
                                                'class'=>'form-control',
                                                'rows' => '2'
                                            ];
                                            echo form_textarea($product_desc);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="<?= base_url('product'); ?>" class="btn btn-outline-info">Back</a>
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </div>

                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    </div>

    <?= view('_partials/footer'); ?>