function setVar(){
    topBox = $('#top');//顶部容器
    leftBox = $('#left');//左边容器
    rightBox = $('#right');//右边容器
    tabBox = $('#tab');//标签容器
    contentBox = $('#content');//内容容器
    topHeight = topBox.outerHeight();//顶部容器高度
    leftWidth = leftBox.outerWidth();//左边容器宽度
    tabHeight = tabBox.height();//标签容器高度
    eachTabWidth = tabBox.find('span').eq(0).width();//单个标签宽度（不包括空白）
    eachTabOuterWidth = tabBox.find('span').eq(0).outerWidth();//单个标签宽度（包括空白）
    iframePaddingTop = parseInt( rightBox.find('iframe').eq(0).css('padding-top') );//iframe留间隔
}
function initSize(){
    winHeight = $(window).height();//窗口高度
    winWidth = $(window).width();//窗口宽度
    leftBox.height(winHeight);
    rightBox.width(winWidth-leftWidth);
    rightBox.height(winHeight);
    rightBox.find('iframe').width(winWidth-leftWidth);
    rightBox.find('iframe').height(winHeight-topHeight-tabHeight-iframePaddingTop);
}
function initTabLinks(){
    $('a[target="_tab"]').click(function(){
        var id = $(this).attr('rel');
        var url = $(this).attr('href');
        var text = $(this).text();
        rightBox.find('iframe').hide();
        tabBox.find('span').attr('class','off');
        if($('#tab_'+id)[0]){
            $('#tab_'+id).attr('class','on');
            $('#content_'+id).attr('src',url).show();
        }else{
            tabBox.append('<span id="tab_'+id+'" class="on" onclick="changeTab(\''+id+'\');">'+text+'<a href="javascript:closeTab(\''+id+'\');">x</a></span>');
            contentBox.append('<iframe id="content_'+id+'" frameborder="0" allowtransparency="true" src="'+url+'"></iframe>');
            initSize();
            resizeTab();
        }
        return false;
    });
}
function initDialogLinks(){
    $('a[target="_dialog"]').click(function(){
        art.dialog.open($(this).attr('href'),{
            id : $(this).attr('rel'),
            fixed : true,
            title : $(this).attr('title'),
            width : $(this).attr('width')+'px',
            height : $(this).attr('height')+'px'
        });
        return false;
    });
}
function initMenu(){
    var tt;
    leftBox.find('.menu').find('li.main').hover(
    function(){
        obj=$(this).children('ul');
        tt=setTimeout(function(){
            leftBox.find('.menu').find('ul.sub').hide();
            obj.show();
         },300);
      },
      function(){
          clearTimeout(tt);
     });
     leftBox.find('.menu').find('ul.sub').eq(0).slideDown('slow');
}
function closeTab(id){
    $('#tab_'+id).remove();
    $('#content_'+id).remove();
    rightBox.find('iframe:last').show();
    tabBox.find('span:last').attr('class','on');
    resizeTab();
}
function changeTab(id){
    rightBox.find('iframe').hide();
    tabBox.find('span').attr('class','off');
    $('#tab_'+id).attr('class','on');
    $('#content_'+id).show();
}
function resizeTab(){
    var tabTotal = tabBox.find('span').size();
    var w = tabBox.width() / tabTotal;
    if( w < eachTabOuterWidth ){
        var padding = eachTabOuterWidth - eachTabWidth;
        tabBox.find('span').width( w - padding );
    }else{
        tabBox.find('span').width( eachTabWidth );
    }
}
function sideBarSwitch(obj){
    if(typeof(leftWidthOrg)=='undefined') leftWidthOrg = leftWidth;
    if(leftWidth==0){
        $(obj).html('<i class="ico icon-arrow-left"></i>隐藏左栏菜单</a>');
        leftWidth = leftWidthOrg;
        initSize();
        leftBox.width(leftWidth);
    }else{
        $(obj).html('<i class="ico icon-arrow-right"></i>展开左栏菜单</a>');
        leftWidth = 0;
        initSize();
        leftBox.width(leftWidth);
    }
}
function setSkin(skin){
    loadSkin(skin);
    setCookie('uadmin_skin',skin,86400000,'/');
}
function loadSkin(){
    var skin = arguments[0] ? arguments[0] : getCookie('uadmin_skin');
    if(skin == null) skin = 'black';
    var skinObj = $('head #skinCss');
    skinObj.attr('href',skinObj.attr('path')+skin+'.css');
    var skinObj2 = $('head #artDialogCss');
    skinObj2.attr('href',skinObj2.attr('path')+skin+'.css');
}
function setCookie(name,value,seconds,path,domain,secure) {
    var expires = new Date();
    expires.setTime( expires.getTime() + parseInt(seconds)*1000 );
    document.cookie = name + "=" + escape (value) +
        ((expires) ? "; expires=" + expires.toGMTString() : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}
function getCookie(name) {
    var $ = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
    if ($ != null) return unescape(unescape($[2]));
    return null
}
$(document).ready(function(){
    setVar();//设置变量
    loadSkin();//加载皮肤CSS
    initMenu();//设置菜单效果
    initSize();//初始化各容器尺寸
    initTabLinks();//设置使用标签页打开的链接
    initDialogLinks();//设置使用窗口打开的链接
});
$(window).load(function(){
    initSize();
});
$(window).resize(function(){
    //窗口的突然变小，会导致滚动条的出现从而影响对各容器的重新设置尺寸（firefox）
    leftBox.height(0);
    rightBox.height(0);
    rightBox.width(0);
    initSize();//这下再重新设置各容器尺寸
    resizeTab();
});