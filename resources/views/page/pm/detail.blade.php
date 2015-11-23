<div class="panel panel-default">
	<div class="panel-body">
	   <a ui-sref="base.pm.list" title="返回" class="btn btn-default">返回</a>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
	   <dl class="dl-horizontal">
		   	<dt>发件人</dt>
		   	<dd>
		   	  <span ng-if="message.sendertype==1">[:message.sendername:](柏惠维康)</span>
		   	  <span ng-if="message.sendertype==2">[:message.sendername:]</span>
	   	    </dd>
		   	<dt>发送时间</dt>
		   	<dd>[:message.sendtime:]</dd>
		   	<dt>内容</dt>
		   	<dd>[:message.messagecontent:]</dd>
		   	<dt></dt>
		   	<dd ng-if="canReply()">
		   		<textarea name="msg" class="form-control" rows="10" ng-model="msg">
		   		</textarea>
		   		<button type="button" class="btn btn-primary pull-right mt10" ng-click="reply(msg)">回复</button>
		   	</dd>
	   </dl>
	</div>
</div>