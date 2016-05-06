/**
 * Created by Administrator on 2016/3/28.
 */
var menu = document.getElementById("menu");

//实现点击的时候展开
menu.onclick = function (e) {
    e = e || window.event;
    var target = e.target || e.srcElement;
    if (/^span$/i.test(target.nodeName)) {
        showHide(target);
    } else if (/^em$/i.test(target.nodeName)) {
        showHide(target.parentNode);
    }
};
//显示隐藏
function showHide(curSpan) {
    var nex = utils.next(curSpan);
    if (nex && nex.nodeName.toLowerCase() === "ul") {
        var isBlock = utils.css(nex, "display");
        var oEm = curSpan.getElementsByTagName("em")[0];
        if (isBlock === "block") {//当前是展开的，隐藏
            nex.style.display = "none";
            utils.removeClass(oEm, "open");

            //当前级收起的时候，让它下面的所有的子级也自动跟着收起
            var childUl = nex.getElementsByTagName("ul");
            for (var i = 0; i < childUl.length; i++) {
                childUl[i].style.display = "none";
                //让其哥哥元素节点中的em移除open的样式
                var pre = utils.prev(childUl[i]);
                var preEm = pre.getElementsByTagName("em")[0];
                utils.removeClass(preEm, "open");
            }

        } else {//当前是隐藏的，展开
            nex.style.display = "block";
            utils.addClass(oEm, "open");
        }
    }
}