# Foreman Report System
Built for a mid sized construction company for foreman's daily reporting and retrieval of time sheets by the office staff.


### To insert/create a new foreman report:
From the navbar, choose Forean Report. Opens index.php
```
index.php >> newfr.php (NEW WINDOW) >> verifyfr.php >> insertfr.php (WINDOW CLOSE)
```


### To view an existing foreman report:
From the navbar, choose Get Reports. Opens reports.php
```
reports.php >> 2019reports.imbed.php (AJAX CALL) >> pullfr.php (AJAX CALL) >> getfr.php (NEW WINDOW)
```


### Timesheet is a single page app with php includes.
From the navbar, choose Get Reports. Opens reports.php
```
reports.php >> timesheet.php (NEW WINDOW)
```


### An admin page allows the adding or updating of database info.
From the navbar, choose Admin Panel. Opens admin.php
```
admin.php >> imbed.editdb.php (AJAX CALL) >> imbed.updatedb.php (AJAX CALL) >> reloads admin.php upon submit
```


## Built By
Shaun Moore