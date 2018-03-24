<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>

        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-user"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">用户管理</h3>
            <ul class='control-sidebar-menu'>


                <li>
                    <a href='/admin/show'>
                        <i class="menu-icon fa fa-users bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">显示用户</h4>

                            <p></p>
                        </div>
                    </a>
                </li>

                <li>
                    <a href='/admin/insert'>
                        <i class="menu-icon fa fa-user-plus bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">添加用户</h4>

                            <p></p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">角色管理</h3>
            <ul class='control-sidebar-menu'>


                <li>
                    <a href='/role/index'>
                        <i class="menu-icon fa fa-users bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">显示角色</h4>

                            <p></p>
                        </div>
                    </a>
                </li>

                <li>
                    <a href='/role/insert'>
                        <i class="menu-icon fa fa-user-plus bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">添加角色</h4>

                            <p></p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->
            <h3 class="control-sidebar-heading">权限管理</h3>
            <ul class='control-sidebar-menu'>


                <li>
                    <a href='/permission/index'>
                        <i class="menu-icon fa fa-users bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">显示权限</h4>

                            <p></p>
                        </div>
                    </a>
                </li>

                <li>
                    <a href='/permission/insert'>
                        <i class="menu-icon fa fa-user-plus bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">添加权限</h4>

                            <p></p>
                        </div>
                    </a>
                </li>
            </ul>

        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked/>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right"/>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>