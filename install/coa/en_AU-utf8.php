<?php
InsertRecord('accountsection',array('sectionid'),array(10),array('sectionid','sectionname'),array(10,'Assets'));
InsertRecord('accountsection',array('sectionid'),array(20),array('sectionid','sectionname'),array(20,'Liabilities'));
InsertRecord('accountsection',array('sectionid'),array(30),array('sectionid','sectionname'),array(30,'Income'));
InsertRecord('accountsection',array('sectionid'),array(40),array('sectionid','sectionname'),array(40,'Costs'));
InsertRecord('accountgroups',array('groupname'),array('CAPITAL ASSETS'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('10','CAPITAL ASSETS','10','0','3000','',''));
InsertRecord('accountgroups',array('groupname'),array('CAR EXPENSES'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('20','CAR EXPENSES','40','1','12000','',''));
InsertRecord('accountgroups',array('groupname'),array('COST OF GOODS SOLD'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('30','COST OF GOODS SOLD','40','1','9000','',''));
InsertRecord('accountgroups',array('groupname'),array('CURRENT ASSETS'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('40','CURRENT ASSETS','10','0','1000','',''));
InsertRecord('accountgroups',array('groupname'),array('CURRENT LIABILITIES'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('50','CURRENT LIABILITIES','20','0','4000','',''));
InsertRecord('accountgroups',array('groupname'),array('EQUITY'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('60','EQUITY','20','0','6000','',''));
InsertRecord('accountgroups',array('groupname'),array('GENERAL & ADMINISTRATIVE EXPEN'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('70','GENERAL & ADMINISTRATIVE EXPEN','40','1','11000','',''));
InsertRecord('accountgroups',array('groupname'),array('LONG TERM LIABILITIES'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('80','LONG TERM LIABILITIES','20','0','5000','',''));
InsertRecord('accountgroups',array('groupname'),array('OTHER REVENUE'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('90','OTHER REVENUE','30','1','8000','',''));
InsertRecord('accountgroups',array('groupname'),array('PAYROLL EXPENSES'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('100','PAYROLL EXPENSES','40','1','10000','',''));
InsertRecord('accountgroups',array('groupname'),array('SALES REVENUE'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('110','SALES REVENUE','30','1','7000','',''));
InsertRecord('accountgroups',array('groupname'),array('STOCK ON HAND'),array('groupcode','groupname','sectioninaccounts','pandl','sequenceintb','parentgroupname','parentgroupcode'),array('120','STOCK ON HAND','10','0','2000','',''));
InsertRecord('chartmaster',array('accountcode'),array('1060'),array('accountcode','accountname','group_'),array('1060','Cheque Account','CURRENT ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1065'),array('accountcode','accountname','group_'),array('1065','Cash / Paid From Private Accounts','CURRENT ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1205'),array('accountcode','accountname','group_'),array('1205','Less: Provision Doubtful Debts','CURRENT ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1210'),array('accountcode','accountname','group_'),array('1210','Trade Debtors / Australia - with GST','CURRENT ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1220'),array('accountcode','accountname','group_'),array('1220','Trade Debtors / Exports - GST free','CURRENT ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1230'),array('accountcode','accountname','group_'),array('1230','GST / Refund','CURRENT ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1520'),array('accountcode','accountname','group_'),array('1520','SOH / Leather','STOCK ON HAND'));
InsertRecord('chartmaster',array('accountcode'),array('1530'),array('accountcode','accountname','group_'),array('1530','SOH / PVC','STOCK ON HAND'));
InsertRecord('chartmaster',array('accountcode'),array('1540'),array('accountcode','accountname','group_'),array('1540','SOH / Fabrics','STOCK ON HAND'));
InsertRecord('chartmaster',array('accountcode'),array('1550'),array('accountcode','accountname','group_'),array('1550','SOH / Metal Hardware / Fasteners / Accessories','STOCK ON HAND'));
InsertRecord('chartmaster',array('accountcode'),array('1560'),array('accountcode','accountname','group_'),array('1560','SOH / Paint / Glue / Dye','STOCK ON HAND'));
InsertRecord('chartmaster',array('accountcode'),array('1570'),array('accountcode','accountname','group_'),array('1570','SOH / Threads / Tapes / Cords / Laces','STOCK ON HAND'));
InsertRecord('chartmaster',array('accountcode'),array('1580'),array('accountcode','accountname','group_'),array('1580','SOH / Other Goods','STOCK ON HAND'));
InsertRecord('chartmaster',array('accountcode'),array('1820'),array('accountcode','accountname','group_'),array('1820','Plant & Equipment - at Cost','CAPITAL ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1825'),array('accountcode','accountname','group_'),array('1825','Less: Accumulated Depreciation','CAPITAL ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1840'),array('accountcode','accountname','group_'),array('1840','Motor Vehicles - at Cost','CAPITAL ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('1845'),array('accountcode','accountname','group_'),array('1845','Less: Accumulated Depreciation','CAPITAL ASSETS'));
InsertRecord('chartmaster',array('accountcode'),array('2100'),array('accountcode','accountname','group_'),array('2100','Trade Creditors','CURRENT LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2160'),array('accountcode','accountname','group_'),array('2160','Taxation - Payable','CURRENT LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2210'),array('accountcode','accountname','group_'),array('2210','Workers Compensation - Payable','CURRENT LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2250'),array('accountcode','accountname','group_'),array('2250','Superannuation - Payable','CURRENT LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2260'),array('accountcode','accountname','group_'),array('2260','Insurance - Payable','CURRENT LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2290'),array('accountcode','accountname','group_'),array('2290','GST / Payable','CURRENT LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2300'),array('accountcode','accountname','group_'),array('2300','GST Payments / Refunds','CURRENT LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2310'),array('accountcode','accountname','group_'),array('2310','GST Adjustments','CURRENT LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2620'),array('accountcode','accountname','group_'),array('2620','Bank Loans','LONG TERM LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2640'),array('accountcode','accountname','group_'),array('2640','Hire Purchase','LONG TERM LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('2650'),array('accountcode','accountname','group_'),array('2650','Other Loans','LONG TERM LIABILITIES'));
InsertRecord('chartmaster',array('accountcode'),array('3350'),array('accountcode','accountname','group_'),array('3350','Issued & Paid up Capital','EQUITY'));
InsertRecord('chartmaster',array('accountcode'),array('3360'),array('accountcode','accountname','group_'),array('3360','Payments for G & S for own Use','EQUITY'));
InsertRecord('chartmaster',array('accountcode'),array('3370'),array('accountcode','accountname','group_'),array('3370','Opening Account Balance','EQUITY'));
InsertRecord('chartmaster',array('accountcode'),array('3380'),array('accountcode','accountname','group_'),array('3380','Credit Payments / Holding Account','EQUITY'));
InsertRecord('chartmaster',array('accountcode'),array('3390'),array('accountcode','accountname','group_'),array('3390','Retained Profits','EQUITY'));
InsertRecord('chartmaster',array('accountcode'),array('4020'),array('accountcode','accountname','group_'),array('4020','Sales / Manufactured Products','SALES REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('4030'),array('accountcode','accountname','group_'),array('4030','Sales / General','SALES REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('4410'),array('accountcode','accountname','group_'),array('4410','Shop Labour','OTHER REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('4420'),array('accountcode','accountname','group_'),array('4420','Design / Patternmaking','OTHER REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('4430'),array('accountcode','accountname','group_'),array('4430','Shipping & Handling','OTHER REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('4440'),array('accountcode','accountname','group_'),array('4440','Interest Received','OTHER REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('4450'),array('accountcode','accountname','group_'),array('4450','Foreign Exchange Profit','OTHER REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('4460'),array('accountcode','accountname','group_'),array('4460','Mark-Up / Price Adjustment','OTHER REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('4470'),array('accountcode','accountname','group_'),array('4470','Computer Consultancy / Training','OTHER REVENUE'));
InsertRecord('chartmaster',array('accountcode'),array('5020'),array('accountcode','accountname','group_'),array('5020','COGS / Leather','COST OF GOODS SOLD'));
InsertRecord('chartmaster',array('accountcode'),array('5030'),array('accountcode','accountname','group_'),array('5030','COGS / PVC','COST OF GOODS SOLD'));
InsertRecord('chartmaster',array('accountcode'),array('5040'),array('accountcode','accountname','group_'),array('5040','COGS / Fabrics','COST OF GOODS SOLD'));
InsertRecord('chartmaster',array('accountcode'),array('5050'),array('accountcode','accountname','group_'),array('5050','COGS / Metal Hardware / Fasteners / Accessories','COST OF GOODS SOLD'));
InsertRecord('chartmaster',array('accountcode'),array('5060'),array('accountcode','accountname','group_'),array('5060','COGS / Paint / Glue / Dye','COST OF GOODS SOLD'));
InsertRecord('chartmaster',array('accountcode'),array('5070'),array('accountcode','accountname','group_'),array('5070','COGS / Threads / Tapes / Cords / Laces','COST OF GOODS SOLD'));
InsertRecord('chartmaster',array('accountcode'),array('5080'),array('accountcode','accountname','group_'),array('5080','COGS / Other Goods','COST OF GOODS SOLD'));
InsertRecord('chartmaster',array('accountcode'),array('5410'),array('accountcode','accountname','group_'),array('5410','Wages','PAYROLL EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('5430'),array('accountcode','accountname','group_'),array('5430','Superannuation','PAYROLL EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('5440'),array('accountcode','accountname','group_'),array('5440','Workers Compensation','PAYROLL EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('5470'),array('accountcode','accountname','group_'),array('5470','Staff Amenities','PAYROLL EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('5605'),array('accountcode','accountname','group_'),array('5605','External labour costs','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5610'),array('accountcode','accountname','group_'),array('5610','Accountancy','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5611'),array('accountcode','accountname','group_'),array('5611','Legal Fees','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5613'),array('accountcode','accountname','group_'),array('5613','Postage / Printing / Stationery','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5614'),array('accountcode','accountname','group_'),array('5614','Freight and Cartage','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5615'),array('accountcode','accountname','group_'),array('5615','Advertising & Promotions','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5620'),array('accountcode','accountname','group_'),array('5620','Bad Debts','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5650'),array('accountcode','accountname','group_'),array('5650','Capital Cost Allowance Expense','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5660'),array('accountcode','accountname','group_'),array('5660','Interest Expenses','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5670'),array('accountcode','accountname','group_'),array('5670','Depreciation Expenses','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5680'),array('accountcode','accountname','group_'),array('5680','Taxation','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5685'),array('accountcode','accountname','group_'),array('5685','Insurance','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5686'),array('accountcode','accountname','group_'),array('5686','Security','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5690'),array('accountcode','accountname','group_'),array('5690','Bank Fees And Charges','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5695'),array('accountcode','accountname','group_'),array('5695','Other Fees And Charges','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5700'),array('accountcode','accountname','group_'),array('5700','Office Supplies','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5760'),array('accountcode','accountname','group_'),array('5760','Rent on Land & Buildings','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5765'),array('accountcode','accountname','group_'),array('5765','Repairs & Maintenance','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5766'),array('accountcode','accountname','group_'),array('5766','Fixtures & Fittings','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5770'),array('accountcode','accountname','group_'),array('5770','Replacements (tools, etc)','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5780'),array('accountcode','accountname','group_'),array('5780','Telephone','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5782'),array('accountcode','accountname','group_'),array('5782','Computer Expenses','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5783'),array('accountcode','accountname','group_'),array('5783','Research & Development','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5785'),array('accountcode','accountname','group_'),array('5785','Travel, Accommodation & Conference','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5790'),array('accountcode','accountname','group_'),array('5790','Hire / Rent of Plant & Equipment','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5795'),array('accountcode','accountname','group_'),array('5795','Registration & Insurance','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5800'),array('accountcode','accountname','group_'),array('5800','Licenses','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5810'),array('accountcode','accountname','group_'),array('5810','Foreign Exchange Loss','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5811'),array('accountcode','accountname','group_'),array('5811','Electricity','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5812'),array('accountcode','accountname','group_'),array('5812','Gas','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5813'),array('accountcode','accountname','group_'),array('5813','Sundry Expenses','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5820'),array('accountcode','accountname','group_'),array('5820','Goods & Services for own Use','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5830'),array('accountcode','accountname','group_'),array('5830','Discounts / Refunds / Rounding','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('5840'),array('accountcode','accountname','group_'),array('5840','Fines - NON DEDUCTIBLE EXPENSES','GENERAL & ADMINISTRATIVE EXPEN'));
InsertRecord('chartmaster',array('accountcode'),array('6010'),array('accountcode','accountname','group_'),array('6010','M/V Commercial - Fuels / Oils / Parts','CAR EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('6020'),array('accountcode','accountname','group_'),array('6020','M/V Commercial - Repairs','CAR EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('6040'),array('accountcode','accountname','group_'),array('6040','M/V Commercial - Reg / Insurance','CAR EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('6050'),array('accountcode','accountname','group_'),array('6050','M/V Commercial - Depreciation Expenses','CAR EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('6060'),array('accountcode','accountname','group_'),array('6060','M/V Commercial - Interest Expenses','CAR EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('6070'),array('accountcode','accountname','group_'),array('6070','M/V Private Use - Depreciation Expenses','CAR EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('6080'),array('accountcode','accountname','group_'),array('6080','M/V Private Use - Interest Expenses','CAR EXPENSES'));
InsertRecord('chartmaster',array('accountcode'),array('6090'),array('accountcode','accountname','group_'),array('6090','M/V Private Use - Other Expenses','CAR EXPENSES'));
?>