art = parent.art;

$(document).ready(function(){
//固定表头。必须在设置artDialog前面，否则会影响
   $("thead").floatingHeadFoot();
//编辑，新增链接
   $("._add,._edit").click(function(){
        art.dialog.open($(this).attr('href'),{
            fixed : true,
            title : $(this).attr('title'),
            width : typeof(win_width)!='undefined' ? win_width : '680px',
            height : typeof(win_height)!='undefined' ? win_height : '420px',
            close : function(){window.location.href=window.location.href;}
        });
        return false;
    });
//小窗口
   $(".win_small").click(function(){
        art.dialog.open($(this).attr('href'),{
            fixed : true,
            title : $(this).attr('title'),
            width : '400px',
            height : '300px'
        });
        return false;
    });
//正常窗口
   $(".win_normal").click(function(){
        art.dialog.open($(this).attr('href'),{
            fixed : true,
            title : $(this).attr('title'),
            width : '680px',
            height : '420px'
        });
        return false;
    });
//大窗口
   $(".win_big").click(function(){
        art.dialog.open($(this).attr('href'),{
            fixed : true,
            title : $(this).attr('title'),
            width : '80%',
            height : '80%'
        });
        return false;
    });
//超级窗口
   $(".win_super").click(function(){
        art.dialog.open($(this).attr('href'),{
            fixed : true,
            title : $(this).attr('title'),
            width : '98%',
            height : '98%'
        });
        return false;
    });
//自定义窗口
   $('a[target="_dialog"]').click(function(){
        art.dialog.open($(this).attr('href'),{
            fixed : true,
            title : $(this).attr('title'),
            width : $(this).attr('width'),
            height : $(this).attr('height')
        });
        return false;
    });
//列表数据鼠标滑过改变背景色
    $('.datalist').hover(
        function(){$(this).addClass('hover');},
        function(){$(this).removeClass('hover');}
    );
//列表数据隔行变色
    $('.datalist:odd').addClass('odd');
    $('.datalist:even').addClass('even');
});

//  jquery.floating-head-foot
(function(e){var g=[];var b=true;function d(h){return e("<div>").addClass(h).css({paddingLeft:0,paddingRight:0,borderLeft:0,borderRight:0,marginLeft:0,marginRight:0})}function a(i,j){var h=i.clone();h.children(":not("+j+")").remove();h.removeAttr("id");h.css({paddingTop:0,paddingBottom:0,borderTop:0,borderBottom:0,margin:0});i.children(j).find("*").andSelf().removeAttr("id");return h}function c(){for(var m in g){var p=g[m];var l="";var h=true;var k={visibility:"visible",position:"absolute",top:"",bottom:""};if(p.t[0].tagName=="THEAD"){var o=e(window).scrollTop()+p.topOffset;var n=p.t.offset().top+p.t.outerHeight()-p.container.outerHeight(true);var j=p.parent.offset().top+p.parent.outerHeight()-p.container.outerHeight(true);if(p.stickToTable&&o<n){l="origin";k.top=n;k.visibility="hidden"}else{if(p.stickToTable&&o>j){l="opposite";k.top=j}else{l="fix-top";if(b){h=false;k.position="fixed";k.top=p.topOffset}else{k.top=o}}}}else{if(p.t[0].tagName=="TFOOT"){var o=e(window).scrollTop()+e(window).height()-p.container.outerHeight(true)-p.bottomOffset;var n=p.t.offset().top;var j=p.parent.offset().top;if(p.stickToTable&&o>n){l="origin";k.top=n}else{if(p.stickToTable&&o<j){l="opposite";k.top=j}else{l="fix-btm";if(b){h=false;k.position="fixed";k.bottom=p.bottomOffset}else{k.top=o}}}}}if(h||p.position!=l){p.div.css(k);p.position=l}p.container.css("margin-left",p.fitIn.offset().left-p.div.offset().left)}}function f(){for(var j in g){var l=g[j];var h=l.t.children().children("th,td");var k=l.clonedParent.children().children().children("th,td");l.container.width(l.fitIn.outerWidth());l.clonedParent.width(l.parent.outerWidth());k.each(function(m){var n=e(this);var i=h.eq(m);n.width(i.width())});l.clonedParent.css("margin-left",l.parent.offset().left-l.container.offset().left)}}e.fn.floatingHeadFoot=function(j){var i=e.extend({fitIn:null,stickToTable:true,topOffset:0,bottomOffset:0,windowScrollCallback:null,windowResizeCallback:null},j);if(e.browser.msie&&parseInt(e.browser.version,10)<7){b=false}var h=false;this.each(function(){if(e(this).is("thead")||e(this).is("tfoot")){h=true;var k={t:e(this),parent:e(this).parent("table"),position:"init",div:e('<div class="float-thead-tfoot">').appendTo(e("body")),fitIn:e(this),stickToTable:i.stickToTable,topOffset:i.topOffset,bottomOffset:i.bottomOffset};if(i.fitIn!=null&&i.fitIn.length){k.fitIn=i.fitIn}k.container=d("floating_"+k.t[0].tagName.toLowerCase()+"_container").appendTo(k.div);k.clonedParent=a(k.parent,e(this)[0].tagName);k.container.append(k.clonedParent);g.push(k)}});if(h){c();f();e(window).scroll(function(){c();if(typeof i.windowScrollCallback=="function"){i.windowScrollCallback.call(this)}});e(window).resize(function(){c();f();if(typeof i.windowResizeCallback=="function"){i.windowResizeCallback.call(this)}})}}})(jQuery);