window.onload = function () {

  leftNav();
  screenStatus();
  //文章功能
  viewFn('post-tbody');
  searchTest('post-search-text', 'post-search-btn', 'post-table', 'post-search-box');
  createArch('add-post', 'arch-manage-title-ul', 'manage-container-body1-1', 'manage-container-body1-2');
  //分类功能
  viewFn('cate-tbody');
  viewFn('cate-post-tbody');
  searchTest('cate-search-text', 'cate-search-btn', 'cate-table', 'cate-search-box');
  createArch('add-cate', 'cate-manage-title-ul', 'manage-container-body2-1', 'manage-container-body2-2');


  leftNavMove();
};

//帖子的浏览和删除功能的显示 封装
function viewFn(objTbody) {
  var oTable = document.getElementById(objTbody);
  var aTr = oTable.getElementsByTagName('tr');

  var aDiv = oTable.getElementsByClassName('edit');
  for (var i=0;i<aTr.length;i++)
  {
    aTr[i].index = i;
    aTr[i].onmouseover = function () {
      aDiv[this.index].style.opacity = '1';
      aDiv[this.index].style.filter = 'alpha(opacity:100)';
    };
    aTr[i].onmouseout = function () {
      aDiv[this.index].style.opacity = '0';
      aDiv[this.index].style.filter = 'alpha(opacity:0)';
    };
  }
}

//创建文章跳转 封装
function createArch(objBtn, objUl, objBody1, objBody2) {
  var oA = document.getElementById(objBtn);
  var oUl = document.getElementById(objUl);

  var oDiv = document.getElementById(objBody1);
  var oDiv1 = document.getElementById(objBody2);

  var oLi = document.createElement('li');


  oA.onclick = function (ev) {
    oDiv.style.display = 'none';
    oDiv1.style.display = 'block';

    oLi.className = 'main-container-titel main-container-titel-child';
    oLi.innerHTML = oA.textContent;

    oUl.appendChild(oLi);
    // console.log(oUl.childElementCount);
  };
  oUl.firstElementChild.onclick = function (ev) {
    oDiv1.style.display = 'none';
    oDiv.style.display = 'block';

    //判断一级子元素的数量
    if (oUl.childElementCount > 1) {
      oUl.removeChild(oLi);
    }
    // console.log(oUl.childElementCount);
  };

}

//模糊查询 封装
function searchTest(objText, objBtn, objTab, objSearch) {
  var oTxt = document.getElementById(objText);
  var oBtn = document.getElementById(objBtn);

  var oTab = document.getElementById(objTab);
  var oSearch = document.getElementById(objSearch);

  function search(ev) {
    for (var i = 0; i < oTab.tBodies[0].rows.length; i++) {
      var sTxt = oTxt.value.toLowerCase();   //获取文本框内容
      var sTab = oTab.tBodies[0].rows[i].cells[0].innerHTML.toLowerCase();

      var arr = sTxt.split(' ');
      oTab.tBodies[0].rows[i].style.display = 'none';
      for (var j = 0; j < arr.length; j++) {
        if (sTab.search(arr[j]) != -1) {
          oTab.tBodies[0].rows[i].style.display = '';
        }
      }
    }
  }

  oBtn.onclick = function (ev) {
    search();
  };

  //键盘响应
  oSearch.onkeydown = function (ev) {
    var Event = ev || event;
    if (Event.keyCode == 13) {
      search();
    }

  };

}

//左边导航
function leftNav(ev) {
  var oUl = document.getElementById('ul1');
  var aLi = oUl.getElementsByTagName('li');

  var aDiv = document.getElementsByClassName('main-container');

  for (var i = 0; i < aLi.length - 1; i++) {
    aLi[i].index = i;
    aLi[i].onclick = function (ev) {
      for (var i = 0; i < aLi.length - 1; i++) {
        aLi[i].className = 'left-nav-item';
        aDiv[i].style.display = 'none';
      }
      this.className = 'left-nav-action';
      aDiv[this.index].style.display = 'block';
    };
  }
}

//左边导航隐藏或展开
function leftNavMove() {
  var timer = null;
  var a = true;

  var oLi = document.getElementById('control-left-nav');

  oLi.onclick = function (ev) {
    if (a) {
      startMove(-240);
      a = false;
    }
    else {
      startMove(0);
      a = true;
    }

  };


  function startMove(iTarget) {    //传值
    var oDiv = document.getElementById('left-sidebar');

    clearInterval(timer);
    timer = setInterval(function () {
      var speed = (iTarget - oDiv.offsetLeft) / 10;
      speed = speed > 0 ? Math.ceil(speed) : Math.floor(speed);

      if (oDiv.offsetLeft == iTarget) {
        clearInterval(timer);
      }
      else {
        oDiv.style.left = oDiv.offsetLeft + speed + 'px';
      }
    }, 30);
  }
}

//个人中心下拉菜单
function dropDown(ev) {
  var oLi = document.getElementById('li1');
  var oDiv = document.getElementById('drop-down');

  var k = true;

  oLi.onclick = function (ev) {
    if (k) {
      oDiv.style.display = 'block';
      k = false;
    }
    else {
      oDiv.style.display = 'none';
      k = true;
    }
  };
}

//文章筛选
function screenStatus() {
  var oTab = document.getElementById('post-table');

  var oDiv = document.getElementById('post-left-direction-inner');
  var aA = oDiv.getElementsByTagName('a');
  var aLength = aA.length - 1;

  var arr = ['', '草稿', '发布'];
  var a;

  for (var i = 0; i < aLength; i++) {
    aA[i].index = i;
    aA[i].onclick = function () {
      for (var i = 0; i < aLength; i++) {
        aA[i].className = 'inner';
      }
      this.className = 'action';
      a = this.index;
      // alert(a);
      for (a; a < arr.length; i++) {
        for (var j = 0; j < oTab.tBodies[0].rows.length; j++) {
          var sTab = oTab.tBodies[0].rows[j].cells[1].innerHTML.toLowerCase();

          // if (sTab.search(arr[a]) != -1) {
          if (sTab.match(arr[a])) {
            oTab.tBodies[0].rows[j].style.display = '';
          } else {
            oTab.tBodies[0].rows[j].style.display = 'none';
          }
        }
        break;
      }
    };
  }
}



