<?php

use yii\helpers\Url;

?>
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?= Url::home() ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/images/logo_ico.png" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="/images/logo2.png" alt="" height="48">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?= Url::home() ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="/images/logo_ico.png" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="/images/logo2.png" alt="" height="48">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a href="<?= Url::to('/cabinet/index') ?>" class="nav-link">
                        <i class="mdi mdi-card-account-details"></i>
                        <span data-key="t-cabinet"><?= Yii::t('app', 'Cabinet') ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to('/cabinet/wallet') ?>" class="nav-link">
                        <i class="mdi mdi-wallet"></i>
                        <span data-key="t-wallet"><?= Yii::t('app', 'Wallet') ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to('/cabinet/transactions') ?>" class="nav-link">
                        <i class="mdi mdi-transfer"></i>
                        <span data-key="t-transactions"><?= Yii::t('app', 'Transactions') ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to('/cabinet/deposits') ?>" class="nav-link">
                        <i class="mdi mdi-cash-plus"></i>
                        <span data-key="t-deposits"><?= Yii::t('app', 'Deposits') ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to('/cabinet/investments') ?>" class="nav-link">
                        <i class="mdi mdi-chart-box-outline"></i>
                        <span data-key="t-investments"><?= Yii::t('app', 'Investments') ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to('/cabinet/team') ?>" class="nav-link">
                        <i class="mdi mdi-account-group"></i>
                        <span data-key="t-team"><?= Yii::t('app', 'Team') ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Url::to('/cabinet/promo') ?>" class="nav-link">
                        <i class="mdi mdi-medal"></i>
                        <span data-key="t-promo"><?= Yii::t('app', 'Promo') ?></span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>