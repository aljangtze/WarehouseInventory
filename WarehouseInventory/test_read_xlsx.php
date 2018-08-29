<?php
  $page_title = 'Edit User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php include_once('layouts/header.php'); ?>

<?php include_once('layouts/footer.php'); ?>

<script>
    var jsonData = [
            [
                "入库单（研发）"
            ],
            [],
            [
                "单位：四川蓝光英诺生物科技股份有限公司",
                null,
                null,
                null,
                null,
                null,
                "入库日期：",
                "7/13/18"
            ],
            [
                "部门：研发中心",
                null,
                null,
                null,
                null,
                null,
                "单据编号：",
                "RK18071301"
            ],
            [
                "供应商：四川诚必达科技有限公司  "
            ],
            [],
            [
                "序号",
                "品名",
                "规格",
                "单位",
                "数量",
                "单价",
                " 总价 ",
                " 项目 ",
                "备注"
            ],
            [
                "1",
                "CD31",
                "RD公司",
                "支",
                "1",
                "4,526.21",
                "4,526.21",
                "动物实验",
                "QG18242"
            ],
            [
                "2",
                "a-SMA",
                "abcom公司",
                "支",
                "1",
                "3,620.39",
                "3,620.39",
                "动物实验",
                "QG18242"
            ],
            [
                "3",
                "CollagenⅠ",
                "abcom公司",
                "支",
                "1",
                "3,626.21",
                "3,626.21",
                "动物实验",
                "QG18242"
            ],
            [
                "4",
                "CollagenⅠ",
                "abcom公司",
                "支",
                "1",
                "3,878.64",
                "3,878.64",
                "动物实验",
                "QG18242"
            ],
            [
                "5",
                "CollagenⅠ",
                "Thermo公司",
                "支",
                "1",
                "4,640.78",
                "4,640.78",
                "动物实验",
                "QG18242"
            ],
            [
                "6",
                "Elastin",
                "abcom公司",
                "支",
                "1",
                "3,572.82",
                "3,572.82",
                "动物实验",
                "QG18242"
            ],
            [
                "7",
                "HRP, Anti-Rabbit",
                "CST公司",
                "支",
                "1",
                "3,881.55",
                "3,881.55",
                "动物实验",
                "QG18242"
            ],
            [
                "8",
                "HRP, Anti-Mouse",
                "CST公司",
                "支",
                "1",
                "3,763.11",
                "3,763.11",
                "动物实验",
                "QG18242"
            ],
            [
                "9",
                "HRP， Anti-Goat",
                "Sigma公司",
                "支",
                "1",
                "1,742.72",
                "1,742.72",
                "动物实验",
                "QG18242"
            ],
            [
                "10",
                "Goat anti-Rabbit",
                "Thermo公司",
                "支",
                "1",
                "2,510.68",
                "2,510.68",
                "动物实验",
                "QG18242"
            ],
            [
                "11",
                "Donkey anti-Goat",
                "Thermo公司",
                "支",
                "1",
                "2,687.38",
                "2,687.38",
                "动物实验",
                "QG18242"
            ],
            [
                "12",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "13",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "14",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "15",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "16",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "17",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "18",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "19",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "20",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "21",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "22",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "23",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [
                "24",
                "Chicken anti-Mouse",
                "Thermo公司",
                "支",
                "1",
                "2,769.90",
                "2,769.90",
                "动物实验",
                "QG18242"
            ],
            [],
            [],
            [
                null,
                null,
                "合计",
                null,
                null,
                null,
                "74,459.22"
            ]
        ]
    ;

    var data = [
        { name: "Barack Obama", pres: 44 },
        { name: "Donald Trump", pres: 45 }
    ];

    var workbook = XLSX.utils.book_new();
    var ws1 = XLSX.utils.json_to_sheet(jsonData);
    XLSX.utils.book_append_sheet(workbook, ws1, "Presidents");

    XLSX.writeFile(workbook, "test.xlsx")

    /*
    var workbook = XLSX.readFile("godownentry.xlsx");

    var data = [
        { name: "Barack Obama", pres: 44 },
        { name: "Donald Trump", pres: 45 }
    ];

    /* generate a worksheet */
    //var ws = XLSX.utils.json_to_sheet(data);

    /* add to workbook */
    //var wb = XLSX.utils.book_new();
    //XLSX.utils.book_append_sheet(wb, ws, "Presidents");

    /* write workbook and force a download */
    //XLSX.writeFile(wb, "sheetjs.xlsx");

    //console.log(workbook.SheetNames);
</script>
