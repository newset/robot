<div class="panel panel-default" ng-controller="CDepartmentHome">
    <div class="panel-body">
        <div class="col-md-12"> 
            <h2>医院信息</h2> 
            <hr class="home-hr"/>
              <p>可用Mark:[:marks.mark_count:]个</p>   <h2>科室信息</h2> 
            <hr class="home-hr"/>
             
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="info" > 
                    <th>人员</th>
                    <th>本月使用</th>
                    <th>未归档</th>
                    <th>总计使用</th>
                    <th>总计归档</th>
                </tr>
                </thead> 
                <tbody>
                    <tr ng-repeat="mark in marks.data">
                        <td ng-bind="mark.a" ng-if="!$last"></td>
                        <td ng-if="$last" class="h5 text-right">合计</td>
                        <td ng-bind="mark.b"></td>
                        <td ng-bind="mark.c"></td>
                        <td ng-bind="mark.d"></td>
                        <td ng-bind="mark.e"></td>
                    </tr>
                </tbody>
            </table>
        </div> 
    </div>
</div>
