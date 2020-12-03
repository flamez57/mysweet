window.onload=function (ev) {
    top_nav();
    bottom_nav();

};
// 上导航条
function top_nav(ev)
{
    var oUl=document.getElementById('top-nav');
    var aA=oUl.getElementsByTagName('a');

    var aDiv=document.getElementsByClassName('main-container');

    for (var i=0;i<aA.length;i++)
    {
        aA[i].index=i;
        aA[i].onclick=function ()
        {
            for (var i=0;i<aA.length;i++)
            {
                aA[i].className='';
                aDiv[i].style.display='none';
            }
            this.className='nav-action';
            aDiv[this.index].style.display='block';
        };
    }

}
//下导航条当前位置
function bottom_nav(ev)
{
    var oNav=document.getElementById('con-nav');
    var aA=oNav.getElementsByTagName('a');
    for (var i=1;i<aA.length-1;i++)
    {
        aA[i].onclick=function ()
        {
            for (var i=0;i<aA.length;i++)
            {
                aA[i].className='';
            }
            this.className='nav-action';
        };
    }
}

