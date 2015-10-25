<html>
<head><meta charset="utf-8"></head>
<p>医生情况统计表 注：参数不可为空</p>
<form action="doctor_condition.PHP" method="post">
时间：从
<input type="text" name="starttime">到<input type="text" name="endtime"> 
（格式为2015-07-01 00:00:00 用一个空格隔开）<br> 
省份id：<input type="text" name="provinceid">  城市id：<input type="text" name="cityid">  <br>
医院id： <input type="text" name="hospitalid"> <br>
<input type="submit">
</form>
</html>