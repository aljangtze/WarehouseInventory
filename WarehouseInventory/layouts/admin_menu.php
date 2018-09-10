<ul>
    <li>
        <a href="admin.php">
            <i class="glyphicon glyphicon-home"></i>
            <span>概览</span>
        </a>
    </li>
    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "00000"); ?>">
            <i class="glyphicon glyphicon-shopping-cart"></i>
            <span>请购单管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="add_requestion.php"
                   style="<?php getDisplayRule($rule_result_list, "00001", "00000"); ?>">发起请购单</a></li>
            <li><a href="manage_requestion_details.php"
                   style="<?php getDisplayRule($rule_result_list, "00002", "00000"); ?>">待处理请购单</a></li>
            <li><a href="manage_requestion_products.php"
                   style="<?php getDisplayRule($rule_result_list, "00003", "00000"); ?>">待采购物料</a></li>
            <li><a href="manage_requestions.php" style="<?php getDisplayRule($rule_result_list, "00004", "00000"); ?>">我的请购单</a>
            </li>
            <li><a href="manage_requestions.php" style="<?php getDisplayRule($rule_result_list, "00005", "00000"); ?>">我请购的物料</a>
            </li>
            <li><a href="manage_requestions.php" style="<?php getDisplayRule($rule_result_list, "00006", "00000"); ?>">管理请购单</a>
            </li>
            <li><a href="manage_requestions.php" style="<?php getDisplayRule($rule_result_list, "00007", "00000"); ?>">管理请购的物料</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "10000", "10000"); ?>">
            <i class="glyphicon glyphicon-list-alt"></i>
            <span>合同管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="gennerate_contract.php" style="<?php getDisplayRule($rule_result_list, "10001", "10000"); ?>">未生成合同</a>
            </li>
            <li><a href="manage_contract_price.php"
                   style="<?php getDisplayRule($rule_result_list, "10002", "10000"); ?>">合同价格维护</a></li>
            <li><a href="manage_contract_details.php"
                   style="<?php getDisplayRule($rule_result_list, "10003", "10000"); ?>">管理合同请购单</a></li>
            <li><a href="manage_contract_details.php"
                   style="<?php getDisplayRule($rule_result_list, "10004", "10000"); ?>">所有合同</a></li>
        </ul>
    </li>

    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "20000"); ?>">
            <i class="glyphicon glyphicon-save"></i>
            <span>入库管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="add_godown.php" style="<?php getDisplayRule($rule_result_list, "20001"); ?>">新增入库</a></li>
            <li><a href="manage_godown_entrys.php"
                   style="<?php getDisplayRule($rule_result_list, "20002"); ?>">入库单明细</a></li>
            <li><a href="manage_godown_entrys.php" style="<?php getDisplayRule($rule_result_list, "20003"); ?>">入库报表</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "30000"); ?>">
            <i class="glyphicon glyphicon-open"></i>
            <span>出库管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="add_outgoing.php"
                   style="<?php getDisplayRule($rule_result_list, "30001", "30000"); ?>">新增出库</a></li>
        </ul>
        <ul class="nav submenu">
            <li><a href="manage_outgoing_entrys.php"
                   style="<?php getDisplayRule($rule_result_list, "30002", "30000"); ?>">出库单明细</a></li>
        </ul>
        <ul class="nav submenu">
            <li><a href="manage_godown_entrys.php"
                   style="<?php getDisplayRule($rule_result_list, "30003", "30000"); ?>">出库报表</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "80000"); ?>">
            <i class="glyphicon glyphicon-indent-left"></i>
            <span>物料管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="manage_products.php" style="<?php getDisplayRule($rule_result_list, "80001"); ?>">物料维护</a></li>
            <li><a href="#">用户关联物料</a></li>
        </ul>

    </li>
    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "40000"); ?>">
            <i class="glyphicon glyphicon-phone-alt"></i>
            <span>供应商管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="manage_suppliers.php" style="<?php getDisplayRule($rule_result_list, "40001"); ?>">供应商信息维护</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "50000"); ?>">
            <i class="glyphicon glyphicon-signal"></i>
            <span>报表查询</span>
        </a>
        <ul class="nav submenu">
            <li><a href="sales_report.php">入库报表</a></li>
            <li><a href="monthly_sales.php">出库报表</a></li>
            <li><a href="daily_sales.php">库存报表</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "90000"); ?>">
            <i class="glyphicon glyphicon-folder-open"></i>
            <span>专利管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="add_patent.php">新增专利 </a></li>
            <li><a href="manage_patent.php">专利信息一览</a></li>
            <li><a href="daily_sales.php">Daily sales</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "11000", ""); ?>">
            <i class="glyphicon glyphicon-user"></i>
            <span>项目管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="#">项目管理</a></li>
            <li><a href="#">项目成员管理</a></li>
        </ul>
    </li>
    <li style="<?php getDisplayRule($rule_result_list, "12000", ""); ?>">
        <a href="#" class="submenu-toggle">
            <i class="glyphicon glyphicon-user"></i>
            <span>用户管理</span>
        </a>
        <ul class="nav submenu">
            <li style="display: none;"><a href="group.php">成员分组</a></li>
            <li><a href="users.php">用户信息管理</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="submenu-toggle" style="<?php getDisplayRule($rule_result_list, "70000", ""); ?>">
            <i class="glyphicon glyphicon-lock"></i>
            <span>角色权限管理</span>
        </a>
        <ul class="nav submenu">
            <li><a href="role.php" style="<?php getDisplayRule($rule_result_list, "70001", ""); ?>">角色管理</a></li>
            <li><a href="rule.php" style="<?php getDisplayRule($rule_result_list, "70002", ""); ?>">权限管理</a></li>
            <li><a href="role_group.php" style="<?php getDisplayRule($rule_result_list, "70002", ""); ?>">角色组管理</a></li>
        </ul>
    </li>


</ul>
