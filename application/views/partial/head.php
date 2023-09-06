  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?= $title ?></title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Data Table CSS -->
    <link href="<?= base_url('assets/vendors/datatables.net-dt/css/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
     
    <!-- Toggles CSS -->
    <link href="<?= base_url('assets/vendors/jquery-toggles/css/toggles.css') ?>" rel="stylesheet" type="text/css">

    <!-- Toastr CSS -->
    <link href="<?= base_url('assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.css') ?>" rel="stylesheet" type="text/css">

    <link href="<?= base_url('assets/vendors/select2/dist/css/select2.min.css') ?>" rel="stylesheet" type="text/css">

    <link href="<?= base_url('assets/vendors/jquery-toggles/css/themes/toggles-light.css') ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/jquery-ui.css') ?>">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/dist/css/style.css') ?>" rel="stylesheet" type="text/css">
    <style type="text/css">
        #datatable th { font-size: 12px; }
        #datatable td { font-size: 11px; }
        #datatable2 th { font-size: 12px; }
        #datatable2 td { font-size: 11px; }
        @media print
        {
            .non-printable { display: none; }
            .hk-wrapper {display: none;}
            .printable { display: block; }
        }

    </style>
  </head>