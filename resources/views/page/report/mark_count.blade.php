﻿
<p>Mark情况统计表 注：参数不可为空</p>
<form action="/report/mark_count" method="post" id="report-form">
时间：从
<input type="text" name="starttime" ng-model="cond.starttime">到<input type="text" name="endtime" ng-model="cond.endtime"> 
（格式为2015-07-01 00:00:00 用一个空格隔开）<br> 
	
	<button type="button" ng-click="query()">查询</button>
</form>
<div class="" id="report-result">
	
</div>
