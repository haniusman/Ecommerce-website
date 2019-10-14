<?php $url = url()->current(); ?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Alexander Pierce</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li  class="<?php if (preg_match("/dashboard/i",$url)) { ?> active <?php } ?> treeview menu-open">
            <a href="{{url('admin1/dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
<!-- Users Option -->
        <li class="<?php if (preg_match("/user/i",$url)) { ?> active <?php } ?> treeview menu-open">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Users</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?php if (preg_match("/userslist/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/userslist')}}"><i class="fa fa-circle-o"></i> Users list</a></li>
                <li class="<?php if (preg_match("/users/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/users/create')}}"><i class="fa fa-circle-o"></i> Add new user</a></li>
            </ul>
        </li>

<!-- Categories options -->
        <li class="<?php if (preg_match("/categor/i",$url)) { ?> active <?php } ?>  treeview menu-open">
            <a href="#" id="categories_sidebar">
                <i class="fa fa-dashboard"></i> <span>Categories</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul id="categories_list" class="treeview-menu">
                <li class="<?php if (preg_match("/categorieslist/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/categorieslist')}}"><i class="fa fa-circle-o"></i> Categories list</a></li>
                <li class="<?php if (preg_match("/add-category/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/add-category')}}"><i class="fa fa-circle-o"></i> Add new category</a></li>
            </ul>
        </li>

        <!-- Products options -->
        <li class="<?php if (preg_match("/product/i",$url)) { ?> active <?php } ?> treeview menu-open">
            <a href="#" id="categories_sidebar">
                <i class="fa fa-dashboard"></i> <span>Products</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul id="products_list" class="treeview-menu">
                <li class="<?php if (preg_match("/productslist/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/productslist')}}"><i class="fa fa-circle-o"></i> Products list</a></li>
                <li class="<?php if (preg_match("/add_product/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/add_product')}}"><i class="fa fa-circle-o"></i> Add new product</a></li>
            </ul>
        </li>

        <!-- Coupons options -->
        <li class="<?php if (preg_match("/coupon/i",$url)) { ?> active <?php } ?> treeview menu-open">
            <a href="#" id="categories_sidebar">
                <i class="fa fa-dashboard"></i> <span>Coupons</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul id="products_list" class="treeview-menu">
                <li class="<?php if (preg_match("/couponslist/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/couponslist')}}"><i class="fa fa-circle-o"></i> Coupons list</a></li>
                <li class="<?php if (preg_match("/add-coupon/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/add-coupon')}}"><i class="fa fa-circle-o"></i> Add new Coupon</a></li>
            </ul>
        </li>

        <!-- Orders options -->
        <li class="<?php if (preg_match("/order/i",$url)) { ?> active <?php } ?> treeview menu-open">
            <a href="#" id="categories_sidebar">
                <i class="fa fa-dashboard"></i> <span>Orders</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul id="products_list" class="treeview-menu">
                <li class="<?php if (preg_match("/orderslist/i",$url)) { ?> active <?php } ?> "><a href="{{url('admin1/orderslist')}}"><i class="fa fa-circle-o"></i> Orders list</a></li>
            </ul>
        </li>

        <!-- Banners options -->
        <li class="<?php if (preg_match("/banner/i",$url)) { ?> active <?php } ?> treeview menu-open">
            <a href="#" id="categories_sidebar">
                <i class="fa fa-dashboard"></i> <span>Banners</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul id="products_list" class="treeview-menu">
                <li class="<?php if (preg_match("/bannerslist/i",$url)) { ?> active <?php } ?> "> <a href="{{url('/admin1/bannerslist')}}"><i class="fa fa-circle-o"></i> Banners list</a></li>
                <li class="<?php if (preg_match("/add-banner/i",$url)) { ?> active <?php } ?>"><a href="{{url('/admin1/add-banner')}}"><i class="fa fa-circle-o"></i> Add new Banner</a></li>
            </ul>
        </li>



    </ul>
</section>
<!-- /.sidebar -->