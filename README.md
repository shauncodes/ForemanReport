Can this exact app (or even better??) be done with node.js and mongo or something?

Genuine question, not rhetorical. I hope to find out immedietely after launching this MVP.


Heres how it works:

To insert/create a new foreman report:
From the navbar, choose Foreman Report. Opens FR/index.php
>> index.php
>> newfr.php (NEW WINDOW)
>> verifyfr.php
>> insertfr.php (WINDOW CLOSE)


To view an existing foreman report:
From the navbar, choose Get Reports. Opens FR/reports.php
>> reports.php
>> 2019reports.imbed.php (AJAX CALL)
>> pullfr.php (AJAX CALL)
>> getfr.php (NEW WINDOW)


Timesheet is single page app with some background PHP
From the navbar, choose Get Reports. Opens FR/reports.php
>> reports.php
>> timesheet.php


Admin page is similar to get reports:
From the navbar, choose Admin Panel. Opens FR/admin.php
>> admin.php
>> imbed.editdb.php (AJAX CALL)
>> imbed.updatedb.php (AJAX CALL)
>> reloads admin.php upon submit.

