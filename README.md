# 睿米医疗机器人运营管理系统后端API

## 数据接口: `$`
- 功能：数据总接口标识
### 常规用法
`$/实例名/方法名`

### 实例名
#### `init`
方法(Method Name)|传参|返回值|功能|所需权限
:--|:--|:--|:--|:--
`front`|-|`{debug: bool, is_logged_in: bool/int, his_chara: array }`|前端数据初始化|`public_ins`

#### `auth`
方法(Method Name)|传参|返回值|功能|所需权限
:--|:--|:--|:--|:--
`auth_leader`|`{auth_type: string, user_type: string, form_vals: array}`|`{debug: bool, is_logged_in: bool/int, his_chara: array }`|所有类型用户登录及注册的入口|`public_ins`

#### `BaseModel`
方法(Method Name)|传参|返回值|功能|所需权限
:--|:--|:--|:--|:--
`c` | 参数为该模型的字段 | 被创建的模型 | 创建一个模型 | - 
`u` | 参数为该模型的字段 | 被更新的模型 | 更新一个模型 | -
`r` | `{id: int, relation: array}` | 单个模型 | 查询一个模型 | -
`r` | `{limit: int, pageination: int, order_by: string, where: array, super_where: array, where_has: array, supper_where_has: array, relation: array}` | 多个模型 | 查询多个模型 | -
`d` | `{id: int}` | 被删除的模型 | 删除一个模型 | -
`getDoesExistValue`| `{col: string, val: string}` | true 或 false | 查询某个字段是否存在某个值 | -


#### `Hospital`
方法(Method Name)|传参|返回值|功能|所需权限
:--|:--|:--|:--|:--
|||||




## 视图接口: `_`
