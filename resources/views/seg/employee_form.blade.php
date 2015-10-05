<form ng-submit="SIns.cu(SIns.current_row)"
      name="form_employee"
      ng-controller="CPageEmployee as cPageEmployee">
    <div class="form-group">
        <label>登录名</label>
        <input ng-model="SIns.current_row.username"
               la-exist="employee.username"
               class="form-control"
               name="username"
               ng-model-options="{debounce: 300}"
               required>
        <label class="error" ng-if="form_employee.username.$error.laExist">登录名已存在</label>
    </div>
    <div class="form-group">
        <label>密码</label>
        <input ng-model="SIns.current_row.password"
               class="form-control"
               ng-minlength="5"
               ng-maxlength="64"
               name="password"
               required>
        <label class="error" ng-if="form_employee.password.$invalid && form_employee.password.$touched">密码长度需在5至64位之间</label>
    </div>
    <div class="form-group">
        <label>真实姓名</label>
        <input ng-model="SIns.current_row.name"
               class="form-control"
               name="name"
               required>
    </div>
    <div class="form-group">
        <label>电话</label>
        <input ng-model="SIns.current_row.phone"
               class="form-control"
               name="phone">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input ng-model="SIns.current_row.email"
               class="form-control"
               name="email">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_employee.$invalid">提交</button>
    </div>
</form>