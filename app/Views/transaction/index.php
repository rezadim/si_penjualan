<?= view('_partials/header'); ?>
<?= view('_partials/sidebar'); ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transaction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Transaction</li>
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
                            List Transaction
                            <div class="btn-group float-right">
                                <a href="<?= base_url('transaction/import'); ?>" class="btn btn-primary btn-sm">Import</a>
                                <a href="<?= base_url('transaction/export'); ?>" class="btn btn-success btn-sm">Export</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <?php if(!empty(session()->getFlashdata('success'))): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success'); ?>        
                            </div>
                            <?php endif; ?>
                            <?php if(!empty(session()->getFlashdata('info'))): ?>
                            <div class="alert alert-info">
                                <?= session()->getFlashdata('info'); ?>        
                            </div>
                            <?php endif; ?>
                            <?php if(!empty(session()->getFlashdata('warning'))): ?>
                            <div class="alert alert-warning">
                                <?= session()->getFlashdata('warning'); ?>        
                            </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($transactions as $key => $row): ?>
                                        <tr>
                                            <td><?= $key+1; ?></td>
                                            <td><?= $row['product_name']; ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['trx_date'])); ?></td>
                                            <td><?= "Rp.".number_format($row['trx_price']); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= view('_partials/footer'); ?>