/**
 * Created by zzzzz on 2016-08-15.
 */
/*
 验证用户名
 */

function checkName(node) {
    var reg = /^[a-zA-Z0-9]+$/;
    var re = new RegExp(reg);
    return re.test(node);
}
/*
 邮箱验证方法
 */
function checkEmail(node) {
    var reg = /^[\w0-9]+@[a-zA-Z0-9]+(\.[a-zA-Z]+){1,2}$/;
    return reg.test(node);
}