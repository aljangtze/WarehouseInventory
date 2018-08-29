<?php
require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table)
{
    global $db;
    if (tableExists($table)) {
        return find_by_sql("SELECT * FROM " . $db->escape($table));
    }
}

/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
    global $db;
    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table, $id)
{
    global $db;
    $id = (int)$id;
    if (tableExists($table)) {
        $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
        if ($result = $db->fetch_assoc($sql))
            return $result;
        else
            return null;
    }
}

function find_specifications_by_name($name)
{
    global $db;

    $result = $db->query("select name,specification from product where name='{$db->escape($name)}' group by name, specification");
    $result_set = $db->while_loop($result);
    return $result_set;
}


function find_model_number_by_name($name, $specification)
{
    global $db;

    $sql = "select a.* from product as a where name='{$db->escape($name)}' and specification='{$db->escape($specification)}'";
    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function find_rule_by_id($id)
{
    global $db;
    $id = (int)$id;

    $result = $db->query("select a.*, b.id as relation_id, case when role_id is null then 0 else 1 end as checked from rule as a left join role_rules as b on b.rule_id=a.id and b.role_id='{$db->escape($id)}'");
    $result_set = $db->while_loop($result);
    return $result_set;

    /*global $db;
    $result = $db->query($sql);*/
    //$result_set = $db->while_loop($result);
    //return $result_set;
}


/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table, $id)
{
    global $db;
    if (tableExists($table)) {
        $sql = "DELETE FROM " . $db->escape($table);
        $sql .= " WHERE id=" . $db->escape($id);
        $sql .= " LIMIT 1";
        $db->query($sql);
        return ($db->affected_rows() === 1) ? true : false;
    }
}

/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table)
{
    global $db;
    if (tableExists($table)) {
        $sql = "SELECT COUNT(id) AS total FROM " . $db->escape($table);
        $result = $db->query($sql);
        return ($db->fetch_assoc($result));
    }
}

/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table)
{
    global $db;
    $table_exit = $db->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->escape($table) . '"');
    if ($table_exit) {
        if ($db->num_rows($table_exit) > 0)
            return true;
        else
            return false;
    }
}

/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
/* coming from the login form.
/*--------------------------------------------------------------*/
function authenticate($username = '', $password = '')
{
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if ($db->num_rows($result)) {
        $user = $db->fetch_assoc($result);
        $password_request = sha1($password);
        if ($password_request === $user['password']) {
            return $user['id'];
        }
    }
    return false;
}

/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
/* coming from the login_v2.php form.
/* If you used this method then remove authenticate function.
/*--------------------------------------------------------------*/
function authenticate_v2($username = '', $password = '')
{
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if ($db->num_rows($result)) {
        $user = $db->fetch_assoc($result);
        $password_request = sha1($password);
        if ($password_request === $user['password']) {
            return $user;
        }
    }
    return false;
}


/*--------------------------------------------------------------*/
/* Find current log in user by session id
/*--------------------------------------------------------------*/
function current_user()
{
    static $current_user;
    global $db;
    if (!$current_user) {
        if (isset($_SESSION['user_id'])):
            $user_id = intval($_SESSION['user_id']);
            $current_user = find_by_id('users', $user_id);
        endif;
    }
    return $current_user;
}

/*--------------------------------------------------------------*/
/* Find all user by
/* Joining users table and user gropus table
/*--------------------------------------------------------------*/
function find_all_user()
{
    global $db;
    $results = array();
    $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
    $sql .= "g.group_name ";
    $sql .= "FROM users u ";
    $sql .= "LEFT JOIN user_groups g ";
    $sql .= "ON g.group_level=u.user_level ORDER BY u.name ASC";
    $result = find_by_sql($sql);
    return $result;
}

/*--------------------------------------------------------------*/
/* Function to update the last log in of a user
/*--------------------------------------------------------------*/

function updateLastLogIn($user_id)
{
    global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
}

/*--------------------------------------------------------------*/
/* Find all Group name
/*--------------------------------------------------------------*/
function find_by_groupName($val)
{
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return ($db->num_rows($result) === 0 ? true : false);
}

function find_by_roleName($val)
{
    global $db;
    $sql = "SELECT id FROM role WHERE name = '{$db->escape($val)}' LIMIT 1 ";
    $dbquery = $db->query($sql);
    $result = $db->fetch_assoc($dbquery);
    if ($result)
        return $result;
    else
        return null;


    #return($db->num_rows($result) === 0 ? true : false);
}

function is_exist_by_rule_name($name)
{
    global $db;
    $sql = "SELECT id FROM rule WHERE name = '{$db->escape($name)}' LIMIT 1 ";
    $result = $db->query($sql);
    return ($db->num_rows($result) === 0 ? true : false);
}

/*--------------------------------------------------------------*/
/* Find group level
/*--------------------------------------------------------------*/
function find_by_groupLevel($level)
{
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return ($db->num_rows($result) === 0 ? true : false);
}

/*--------------------------------------------------------------*/
/* Function for cheaking which user level has access to page
/*--------------------------------------------------------------*/
function page_require_level($require_level)
{
    global $session;
    $current_user = current_user();
    $login_level = find_by_groupLevel($current_user['user_level']);
    //if user not login
    if (!$session->isUserLoggedIn(true)):
        $session->msg('d', 'Please login...');
        redirect('index.php', false);
    //if Group status Deactive
    elseif ($login_level['group_status'] === '0'):
        $session->msg('d', 'This level user has been band!');
        redirect('home.php', false);
    //cheackin log in User level and Require level is Less than or equal to
    elseif ($current_user['user_level'] <= (int)$require_level):
        return true;
    else:
        $session->msg("d", "Sorry! you dont have permission to view the page.");
        redirect('home.php', false);
    endif;

}

/*--------------------------------------------------------------*/
/* Function for Finding all product name
/* JOIN with categorie  and media database table
/*--------------------------------------------------------------*/
function join_product_table()
{
    global $db;
    $sql = " SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.date,c.name";
    $sql .= " AS categorie,m.file_name AS image";
    $sql .= " FROM products p";
    $sql .= " LEFT JOIN categories c ON c.id = p.categorie_id";
    $sql .= " LEFT JOIN media m ON m.id = p.media_id";
    $sql .= " ORDER BY p.id ASC";
    return find_by_sql($sql);

}

/*--------------------------------------------------------------*/
/* Function for Finding all product name
/* Request coming from ajax.php for auto suggest
/*--------------------------------------------------------------*/

function find_product_by_title($product_name)
{
    global $db;
    $p_name = remove_junk($db->escape($product_name));
    $sql = "SELECT name FROM products WHERE name like '%$p_name%' LIMIT 5";
    $result = find_by_sql($sql);
    return $result;
}

/*--------------------------------------------------------------*/
/* Function for Finding all product info by product title
/* Request coming from ajax.php
/*--------------------------------------------------------------*/
function find_all_product_info_by_title($title)
{
    global $db;
    $sql = "SELECT * FROM products ";
    $sql .= " WHERE name ='{$title}'";
    $sql .= " LIMIT 1";
    return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Update product quantity
/*--------------------------------------------------------------*/
function update_product_qty($qty, $p_id)
{
    global $db;
    $qty = (int)$qty;
    $id = (int)$p_id;
    $sql = "UPDATE products SET quantity=quantity -'{$qty}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return ($db->affected_rows() === 1 ? true : false);

}

/*--------------------------------------------------------------*/
/* Function for Display Recent product Added
/*--------------------------------------------------------------*/
function find_recent_product_added($limit)
{
    global $db;
    $sql = " SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
    $sql .= "m.file_name AS image FROM products p";
    $sql .= " LEFT JOIN categories c ON c.id = p.categorie_id";
    $sql .= " LEFT JOIN media m ON m.id = p.media_id";
    $sql .= " ORDER BY p.id DESC LIMIT " . $db->escape((int)$limit);
    return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Find Highest saleing Product
/*--------------------------------------------------------------*/
function find_higest_saleing_product($limit)
{
    global $db;
    $sql = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.qty) AS totalQty";
    $sql .= " FROM sales s";
    $sql .= " LEFT JOIN products p ON p.id = s.product_id ";
    $sql .= " GROUP BY s.product_id";
    $sql .= " ORDER BY SUM(s.qty) DESC LIMIT " . $db->escape((int)$limit);
    return $db->query($sql);
}

/*--------------------------------------------------------------*/
/* Function for find all sales
/*--------------------------------------------------------------*/
function find_all_sale()
{
    global $db;
    $sql = "SELECT s.id,s.qty,s.price,s.date,p.name";
    $sql .= " FROM sales s";
    $sql .= " LEFT JOIN products p ON s.product_id = p.id";
    $sql .= " ORDER BY s.date DESC";
    return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Display Recent sale
/*--------------------------------------------------------------*/
function find_recent_sale_added($limit)
{
    global $db;
    $sql = "SELECT s.id,s.qty,s.price,s.date,p.name";
    $sql .= " FROM sales s";
    $sql .= " LEFT JOIN products p ON s.product_id = p.id";
    $sql .= " ORDER BY s.date DESC LIMIT " . $db->escape((int)$limit);
    return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date, $end_date)
{
    global $db;
    $start_date = date("Y-m-d", strtotime($start_date));
    $end_date = date("Y-m-d", strtotime($end_date));
    $sql = "SELECT s.date, p.name,p.sale_price,p.buy_price,";
    $sql .= "COUNT(s.product_id) AS total_records,";
    $sql .= "SUM(s.qty) AS total_sales,";
    $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price,";
    $sql .= "SUM(p.buy_price * s.qty) AS total_buying_price ";
    $sql .= "FROM sales s ";
    $sql .= "LEFT JOIN products p ON s.product_id = p.id";
    $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
    $sql .= " GROUP BY DATE(s.date),p.name";
    $sql .= " ORDER BY DATE(s.date) DESC";
    return $db->query($sql);
}

/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function dailySales($year, $month)
{
    global $db;
    $sql = "SELECT s.qty,";
    $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
    $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
    $sql .= " FROM sales s";
    $sql .= " LEFT JOIN products p ON s.product_id = p.id";
    $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
    $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
    return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function monthlySales($year)
{
    global $db;
    $sql = "SELECT s.qty,";
    $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
    $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
    $sql .= " FROM sales s";
    $sql .= " LEFT JOIN products p ON s.product_id = p.id";
    $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
    $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.product_id";
    $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
    return find_by_sql($sql);
}


function getRequestionCode()
{
    global $db;
    $sql = $db->query("SELECT number+1 as number, year, concat('QG', concat(year, LPAd(number+1, 4, '0'))) as code FROM requestion_code where year=year(now()) order by year,number desc limit 1");
    if ($result = $db->fetch_assoc($sql))
        return $result;
    else
        return null;
}

function getGoDownCode()
{
    global $db;
    $sql = $db->query("SELECT year(now()) as year, month(now()) as month, 
              day(now()) as day, number+1 as number, concat('RK', year(now()), LPAD(month(now()),2,'0'), LPAd(day(now()), 2, '0') , LPAd(number+1, 4, '0')) as code FROM godown_entry_code 
              where year=year(now()) order by year,number desc limit 1");
    if ($result = $db->fetch_assoc($sql))
        return $result;
    else
        return null;
}

function getOutgoingCode()
{
    global $db;
    $sql = $db->query("SELECT year(now()) as year, month(now()) as month, 
              day(now()) as day, number+1 as number, concat('CK', year(now()), LPAD(month(now()),2,'0'), LPAd(day(now()), 2, '0') , LPAd(number+1, 4, '0')) as code FROM outgoing_entry_code 
              where year=year(now()) order by year,number desc limit 1");
    if ($result = $db->fetch_assoc($sql))
        return $result;
    else
        return null;
}


function find_product()
{
    global $db;
    $sql = "select min(id) id, name from product group by name order by id";
    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function find_product_info()
{
    global $db;
    $sql = "SELECT a.*,b.name as username FROM product as a left join users as b  on a.initiator=b.id;";
    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function do_insert($sql)
{
    global $db;
    if ($db->query($sql)) {
        //sucess
        return true;
    } else {
        //failed
        return false;
    }
}

function get_last_auto_id()
{
    global $db;
    $sql = $db->query("select LAST_INSERT_ID() as id");
    if ($result = $db->fetch_assoc($sql))
        return $result['id'];
    else
        return null;

}

function count_by_sql($sql)
{
    global $db;
    $result = $db->query($sql);
    if ($result = $db->fetch_assoc($result))
        return $result['count'];
    else
        return null;
}

function find_id_by_sql($sql)
{
    global $db;
    $result = $db->query($sql);
    if ($result = $db->fetch_assoc($result)) {
        return $result['id'];
    } else {
        return null;
    }
}


function get_requestion_by_id($id)
{
    global $db;

    $sql = "select a.*, ifnull(b.name, '')  as  initiator_name,ifnull(c.name, '') as operator_name from requestion as a 
            left join users as b on a.initiator=b.id 
            left join users as c on a.operator=c.id 
            where a.id = {$db->escape($id)} order by date";
    $result = $db->query($sql);
    $result_set = $db->fetch_assoc($result);
    return $result_set;
}


function get_all_requestion()
{
    global $db;

    $sql = "select a.*, ifnull(b.name, '')  as  initiator_name,ifnull(c.name, '') as operator_name from requestion as a 
            left join users as b on a.initiator=b.id 
            left join users as c on a.operator=c.id 
            order by date";
    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function get_godown_entrys()
{
    global $db;

    $sql = "select  distinct a.*, ifnull(b.name, '')  as  initiator_name,ifnull(c.name, '') as operator_name from requestion as a 
            left join users as b on a.initiator=b.id 
            left join users as c on a.operator=c.id 
            left join requestion_details as rd on rd.requestion_id=a.id where rd.requestion_number > rd.godown_number
            order by date";
    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function get_requestion_by_code($code)
{
    global $db;

    $sql = "select a.*, ifnull(b.name, '') as initiator_name, ifnull(c.name, '') as operator_name from requestion as a  
            left join users as b on a.initiator=b.id
            left join users as c on a.operator =c.id
            where code='{$db->escape($code)}'";
    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function get_requestion_by_initiator($id, $status)
{
    global $db;
    $sql = "";
    if ($status < 0) {
        $sql = "select a.*, b.name as  initiator_name,c.name as operator_name from requestion as a left join users as b on a.initiator=b.id
        left join users as c on a.operator=c.id 
        where b.id={$db->escape($id)} order by date";
    } else {
        $sql = "select a.*, b.name as  initiator_name,c.name as operator_name from requestion as a left join users as b on a.initiator=b.id
        left join users as c on a.operator=c.id 
        where b.id={$db->escape($id)} and a.status={$db->escape($status)} order by date";
    }

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

//按操作员获取请购单信息
function get_requestion_by_operator($id, $status)
{
    global $db;
    $sql = "";
    if ($status < 0) {
        $sql = "select a.id, a.code,a.initiator, a.operator, date(date) as date, a.status, b.name as initiator_name,c.name as operator_name from requestion as a 
        left join users as c on a.operator=c.id 
        where c.id={$db->escape($id)} order by date";
    } else {
        $sql = "select a.id, a.code,a.initiator, a.operator, date(date) as date, a.status, b.name as initiator_name,c.name as operator_name from requestion as a 
			left join users as b on a.initiator=b.id
			left join users as c on a.operator=c.id 
			where c.id={$db->escape($id)} and a.status={$db->escape($status)} order by date";
    }

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);

    $jarr = array();
    foreach ($result_set as $result) {
        $count = count($result);//不能在循环语句中，由于每次删除 row数组长度都减小
        for ($i = 0; $i < $count; $i++) {
            unset($result[$i]);//删除冗余数据
        }
        array_push($jarr, $result);
    }

    return $jarr;

    //return $result_set;

}

//获取请购单的详细物料信息
function get_requestion_details_by_id($id)
{
    global $db;
    $sql = "select a.id, rq.code, pj.name as project_name, a.requestion_id, DATE(a.requestion_date) as requestion_date, Date(a.expect_date) as expect_date, 
            a.reference,pt.name as product_type_name,
            b.name, b.specification, concat(b.name, ',', b.specification,',', b.model_number) as product_name, a.memo,
            q.qualification_info,a.is_test, a.is_reprocess, concat(a.requestion_number, ' ', b.unit) as requestion_info,
            b.model_number,  a.requestion_number, a.godown_number, b.unit from requestion_details as a 
            left join project as pj on a.project_id=pj.id
            left join product as b on a.product_id=b.id 
            left join qualification as q on a.qualification_id=q.id
            left join requestion as rq on a.requestion_id=rq.id
            left join product_type as pt on b.type = pt.id
            where a.requestion_id={$db->escape($id)} order by a.requestion_id,a.id";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);

    $jarr = array();
    foreach ($result_set as $result) {
        $count = count($result);//不能在循环语句中，由于每次删除 row数组长度都减小
        for ($i = 0; $i < $count; $i++) {
            unset($result[$i]);//删除冗余数据
        }
        array_push($jarr, $result);
    }

    return $jarr;
}

function get_godown_entry_summary()
{
    global $db;
    $sql = "select a.*,b.code as requestion_code, c.name supplier_name,u.name user_name from godown_entry as a left join requestion as b on a.requestion_id=b.id
            left join supplier as c on a.supplier_id=c.id
            left join users as u on a.initiator=u.id;";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function get_godown_entry_summary_by_id($entry_id)
{
    global $db;
    $sql = "select a.*,b.code as requestion_code, c.name supplier_name,u.name user_name from godown_entry as a left join requestion as b on a.requestion_id=b.id
            left join supplier as c on a.supplier_id=c.id
            left join users as u on a.initiator=u.id 
            where a.id={$db->escape($entry_id)};";

    $result = $db->query($sql);
    $result_set = $db->fetch_assoc($result);
    return $result_set;
}

function get_godown_entry_details_summary_by_id($entry_id)
{
    global $db;
    $sql = "select a.*,b.name as product_name, b.specification, b.model_number as model_name, b.unit, c.requestion_number from godown_entry_details as a  
            left join requestion_details as c on c.id=a.requestion_details_id
            left join product as b on b.id = c.product_id
            where a.godown_entry_id={$db->escape($entry_id)}";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function get_godown_entry_details_by_id($entry_id)
{

}

//获取某个请购单的详细请购信息，按内容展示
function get_godown_details_by_id($requestion_id)
{
    global $db;
    $sql = "select a.*, b.name as product_name, concat(b.specification, ',', b.model_number) as product_model, b.unit,p.name as project_name from godown_entry_details as a 
            left join requestion_details as c on c.id=a.requestion_details_id
            left join product as b on b.id = c.product_id
            left join project as p on c.project_id = p.id
            where a.godown_entry_id={$db->escape($requestion_id)}";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function get_requestion_details_by_code($requestion_code)
{
    global $db;
    $sql = "select a.id, f.code as requestion_code, a.requestion_id, Date(a.requestion_date) as requestion_date, '分组' as usergroup, a.code, '请购人' as username, c.name project_name, b.specification, 
                b.model_number,  a.requestion_number, a.godown_number, b.unit, a.reference, b.name  as product_name, d.name as product_type_name, Date(a.expect_date) as expect_date, e.qualification_info,
                case a.is_test when 1 then '是'  else '否' end as is_test, case a.is_reprocess when 1 then '是'  else '否' end as is_reprocess, a.memo
                 from requestion_details as a 
                left join product as b on a.product_id=b.id 
                left join project as c on a.project_id =c.id
                left join product_type as d on b.type=d.id
                left join qualification as e on a.qualification_id=e.id 
                left join requestion as f on a.requestion_id=f.id
                where f.code = '{$db->escape($requestion_code)}' and a.requestion_number>a.godown_number order by a.requestion_id,a.id ";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);
    return $result_set;
}

function get_requestion_product_details($status)
{
    global $db;
    $sql = "select a.id, Date(rq.date) as date, rq.code, pj.name as project_name, a.requestion_id, DATE(a.requestion_date) as requestion_date, Date(a.expect_date) as expect_date, u.name as initiator_name,
            a.reference,pt.name as product_type_name,ifnull(s.name, '') as supplier_name, ifnull(s.id, 0) as supplier_id, a.status,
            b.name, b.specification, concat(b.name, ',', b.specification,',', b.model_number) as product_name, a.memo,
            q.qualification_info,a.is_test, a.is_reprocess, concat(a.requestion_number, ' ', b.unit) as requestion_info,
            b.model_number,  a.requestion_number, a.godown_number, b.unit from requestion_details as a 
            left join project as pj on a.project_id=pj.id
            left join product as b on a.product_id=b.id 
            left join qualification as q on a.qualification_id=q.id
            left join requestion as rq on a.requestion_id=rq.id
            left join product_type as pt on b.type = pt.id
            left join users as u on u.id=rq.initiator
            left join supplier as s on a.supplier_id=s.id 
            where (a.supplier_id is null or a.supplier_id=0)
            order by a.status, rq.date,u.name";

    $result = $db->query($sql);
    $result_set = $db->while_loop($result);

    $jarr = array();
    foreach ($result_set as $result) {
        $count = count($result);//不能在循环语句中，由于每次删除 row数组长度都减小
        for ($i = 0; $i < $count; $i++) {
            unset($result[$i]);//删除冗余数据
        }
        array_push($jarr, $result);
    }

    return $jarr;
}

?>
