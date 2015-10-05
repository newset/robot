<form ng-submit="SIns.cu(SIns.current_row)"
      name="form_employee">
    <div class="form-group">
        <label>新密码</label>
        <input ng-model="SIns.current_row.password"
               class="form-control"
               type="password"
               ng-minlength="5"
               ng-maxlength="64"
               name="password"
               required>
        <label class="error"
               ng-if="form_employee.password.$invalid && form_employee.password.$touched">密码长度需在5至64位之间</label>
    </div>
    <div class="form-group">
        <label>确认密码</label>
        <input ng-model="SIns.current_row.password2"
               class="form-control"
               type="password"
               ng-minlength="5"
               ng-maxlength="64"
               name="password2"
               compare-to="SIns.current_row.password"
               required>
        <label class="error"
               ng-if="form_employee.password2.$invalid && form_employee.password2.$touched">两次输入不一致</label>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_employee.$invalid">修改</button>
    </div>
</form>