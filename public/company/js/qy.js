//轮播图效果开始---------------------
{
    let imgs = document.querySelectorAll('.banner li');
    let dians = document.querySelectorAll('.qy-dianbox li');
    let num = 0;
    setInterval(zidong, 3000);
    function zidong() {
        num++;
        if (num === imgs.length) {
            num = 0;
        }
        for (let i = 0; i < imgs.length; i++) {
            imgs[i].classList.remove('qy-active');
            dians[i].classList.remove('dian-active');
        }
        imgs[num].classList.add('qy-active');
        dians[num].classList.add('dian-active');
    }
    //点击轮播点效果
    dians.forEach(function (e, index) {
        e.onclick = function () {
            for (let i = 0; i < imgs.length; i++) {
                imgs[i].classList.remove('qy-active');
                dians[i].classList.remove('dian-active');
            }
            imgs[index].classList.add('qy-active');
            e.classList.add('dian-active');
            num = index;
        }
    })
}
//轮播图效果结束
//