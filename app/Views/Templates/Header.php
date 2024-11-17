<?php
/**
 * @var string $title
 */
?>

<!DOCTYPE HTML>
<html lang="de" data-bs-theme="light">
    <head>
        <title><?= esc($title) . ' | ' . esc(lang('App.DE.ProjectName')) ?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.png') ?>" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />
        <!-- Application CSS -->
        <link rel="stylesheet" href="<?= base_url('assets/css/application.css') ?>" />
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- DataTables JS -->
        <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script>
            const baseURL = "<?= base_url() ?>";
            const lang = <?= toJSON(lang('App.DE')) ?>;
        </script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <!-- Logo -->
                    <a class="navbar-brand" href="javascript:void(0)">
                        <img src="<?= base_url('assets/images/logo.png') ?>" alt="<?= esc(lang('App.DE.AltTexts.Logo')) ?>" class="nav-logo" />
                    </a>

                    <!-- Responsive design navigation trigger icon -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <!-- Transactions -->
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <?= esc(lang('App.DE.Transactions.Titles.Index')) ?>
                                </a>
                            </li>

                            <!-- TransactionTypes -->
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <?= esc(lang('App.DE.TransactionTypes.Titles.Index')) ?>
                                </a>
                            </li>

                            <!-- TransactionGroups -->
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <?= esc(lang('App.DE.TransactionGroups.Titles.Index')) ?>
                                </a>
                            </li>

                            <!-- Roles -->
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <?= esc(lang('App.DE.Roles.Titles.Index')) ?>
                                </a>
                            </li>

                            <!-- Permissions -->
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <?= esc(lang('App.DE.Permissions.Titles.Index')) ?>
                                </a>
                            </li>

                            <!-- Users -->
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <?= esc(lang('App.DE.Users.Titles.Index')) ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>