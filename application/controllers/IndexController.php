<?php
namespace application\controllers;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use application\models\installModels;
use application\models\exampleModels;
use application\models\example2Models;
use application\models\wampModels;
use hl\HLController;
use application\services\exampleServices;
use application\services\installServices;

class IndexController extends HLController
{
    /*
    ** 默认首页
    */
    public function indexAction()
    {
        $json = '[{"regionCode":"AC","regionName":"阿森松岛","regionFlag":"🇦🇨","regionSyllables":["a","sen","song","dao"],"callingCode":"+247"},{"regionCode":"AD","regionName":"安道尔","regionFlag":"🇦🇩","regionSyllables":["an","dao","er"],"callingCode":"+376"},{"regionCode":"AE","regionName":"阿拉伯联合酋长国","regionFlag":"🇦🇪","regionSyllables":["a","la","bo","lian","he","qiu","zhang","guo"],"callingCode":"+971"},{"regionCode":"AF","regionName":"阿富汗","regionFlag":"🇦🇫","regionSyllables":["a","fu","han"],"callingCode":"+93"},{"regionCode":"AG","regionName":"安提瓜和巴布达","regionFlag":"🇦🇬","regionSyllables":["an","ti","gua","he","ba","bu","da"],"callingCode":"+1-268"},{"regionCode":"AI","regionName":"安圭拉","regionFlag":"🇦🇮","regionSyllables":["an","gui","la"],"callingCode":"+1-264"},{"regionCode":"AL","regionName":"阿尔巴尼亚","regionFlag":"🇦🇱","regionSyllables":["a","er","ba","ni","ya"],"callingCode":"+355"},{"regionCode":"AM","regionName":"亚美尼亚","regionFlag":"🇦🇲","regionSyllables":["ya","mei","ni","ya"],"callingCode":"+374"},{"regionCode":"AO","regionName":"安哥拉","regionFlag":"🇦🇴","regionSyllables":["an","ge","la"],"callingCode":"+244"},{"regionCode":"AQ","regionName":"南极洲","regionFlag":"🇦🇶","regionSyllables":["nan","ji","zhou"],"callingCode":"+672"},{"regionCode":"AR","regionName":"阿根廷","regionFlag":"🇦🇷","regionSyllables":["a","gen","ting"],"callingCode":"+54"},{"regionCode":"AS","regionName":"美属萨摩亚","regionFlag":"🇦🇸","regionSyllables":["mei","shu","sa","mo","ya"],"callingCode":"+1-684"},{"regionCode":"AT","regionName":"奥地利","regionFlag":"🇦🇹","regionSyllables":["ao","de","li"],"callingCode":"+43"},{"regionCode":"AU","regionName":"澳大利亚","regionFlag":"🇦🇺","regionSyllables":["ao","da","li","ya"],"callingCode":"+61"},{"regionCode":"AW","regionName":"阿鲁巴","regionFlag":"🇦🇼","regionSyllables":["a","lu","ba"],"callingCode":"+297"},{"regionCode":"AX","regionName":"奥兰群岛","regionFlag":"🇦🇽","regionSyllables":["ao","lan","qun","dao"],"callingCode":"+358"},{"regionCode":"AZ","regionName":"阿塞拜疆","regionFlag":"🇦🇿","regionSyllables":["a","sai","bai","jiang"],"callingCode":"+994"},{"regionCode":"BA","regionName":"波斯尼亚和黑塞哥维那","regionFlag":"🇧🇦","regionSyllables":["bo","si","ni","ya","he","hei","sai","ge","wei","na"],"callingCode":"+387"},{"regionCode":"BB","regionName":"巴巴多斯","regionFlag":"🇧🇧","regionSyllables":["ba","ba","duo","si"],"callingCode":"+1-246"},{"regionCode":"BD","regionName":"孟加拉国","regionFlag":"🇧🇩","regionSyllables":["meng","jia","la","guo"],"callingCode":"+880"},{"regionCode":"BE","regionName":"比利时","regionFlag":"🇧🇪","regionSyllables":["bi","li","shi"],"callingCode":"+32"},{"regionCode":"BF","regionName":"布基纳法索","regionFlag":"🇧🇫","regionSyllables":["bu","ji","na","fa","suo"],"callingCode":"+226"},{"regionCode":"BG","regionName":"保加利亚","regionFlag":"🇧🇬","regionSyllables":["bao","jia","li","ya"],"callingCode":"+359"},{"regionCode":"BH","regionName":"巴林","regionFlag":"🇧🇭","regionSyllables":["ba","lin"],"callingCode":"+973"},{"regionCode":"BI","regionName":"布隆迪","regionFlag":"🇧🇮","regionSyllables":["bu","long","di"],"callingCode":"+257"},{"regionCode":"BJ","regionName":"贝宁","regionFlag":"🇧🇯","regionSyllables":["bei","ning"],"callingCode":"+229"},{"regionCode":"BL","regionName":"圣巴泰勒米","regionFlag":"🇧🇱","regionSyllables":["sheng","ba","tai","lei","mi"],"callingCode":"+590"},{"regionCode":"BM","regionName":"百慕大","regionFlag":"🇧🇲","regionSyllables":["bai","mu","da"],"callingCode":"+1-441"},{"regionCode":"BN","regionName":"文莱","regionFlag":"🇧🇳","regionSyllables":["wen","lai"],"callingCode":"+673"},{"regionCode":"BO","regionName":"玻利维亚","regionFlag":"🇧🇴","regionSyllables":["bo","li","wei","ya"],"callingCode":"+591"},{"regionCode":"BQ","regionName":"荷属加勒比区","regionFlag":"🇧🇶","regionSyllables":["he","shu","jia","lei","bi","qu"],"callingCode":"+599"},{"regionCode":"BR","regionName":"巴西","regionFlag":"🇧🇷","regionSyllables":["ba","xi"],"callingCode":"+55"},{"regionCode":"BS","regionName":"巴哈马","regionFlag":"🇧🇸","regionSyllables":["ba","ha","ma"],"callingCode":"+1-242"},{"regionCode":"BT","regionName":"不丹","regionFlag":"🇧🇹","regionSyllables":["bu","dan"],"callingCode":"+975"},{"regionCode":"BW","regionName":"博茨瓦纳","regionFlag":"🇧🇼","regionSyllables":["bo","ci","wa","na"],"callingCode":"+267"},{"regionCode":"BY","regionName":"白俄罗斯","regionFlag":"🇧🇾","regionSyllables":["bai","e","luo","si"],"callingCode":"+375"},{"regionCode":"BZ","regionName":"伯利兹","regionFlag":"🇧🇿","regionSyllables":["bo","li","zi"],"callingCode":"+501"},{"regionCode":"CA","regionName":"加拿大","regionFlag":"🇨🇦","regionSyllables":["jia","na","da"],"callingCode":"+1"},{"regionCode":"CC","regionName":"科科斯（基林）群岛","regionFlag":"🇨🇨","regionSyllables":["ke","ke","si","ji","lin","qun","dao"],"callingCode":"+61"},{"regionCode":"CD","regionName":"刚果（金）","regionFlag":"🇨🇩","regionSyllables":["gang","guo","jin"],"callingCode":"+243"},{"regionCode":"CF","regionName":"中非共和国","regionFlag":"🇨🇫","regionSyllables":["zhong","fei","gong","he","guo"],"callingCode":"+236"},{"regionCode":"CG","regionName":"刚果（布）","regionFlag":"🇨🇬","regionSyllables":["gang","guo","bu"],"callingCode":"+242"},{"regionCode":"CH","regionName":"瑞士","regionFlag":"🇨🇭","regionSyllables":["rui","shi"],"callingCode":"+41"},{"regionCode":"CI","regionName":"科特迪瓦","regionFlag":"🇨🇮","regionSyllables":["ke","te","di","wa"],"callingCode":"+225"},{"regionCode":"CK","regionName":"库克群岛","regionFlag":"🇨🇰","regionSyllables":["ku","ke","qun","dao"],"callingCode":"+682"},{"regionCode":"CL","regionName":"智利","regionFlag":"🇨🇱","regionSyllables":["zhi","li"],"callingCode":"+56"},{"regionCode":"CM","regionName":"喀麦隆","regionFlag":"🇨🇲","regionSyllables":["ka","mai","long"],"callingCode":"+237"},{"regionCode":"CN","regionName":"中国","regionFlag":"🇨🇳","regionSyllables":["zhong","guo"],"callingCode":"+86"},{"regionCode":"CO","regionName":"哥伦比亚","regionFlag":"🇨🇴","regionSyllables":["ge","lun","bi","ya"],"callingCode":"+57"},{"regionCode":"CR","regionName":"哥斯达黎加","regionFlag":"🇨🇷","regionSyllables":["ge","si","da","li","jia"],"callingCode":"+506"},{"regionCode":"CU","regionName":"古巴","regionFlag":"🇨🇺","regionSyllables":["gu","ba"],"callingCode":"+53"},{"regionCode":"CV","regionName":"佛得角","regionFlag":"🇨🇻","regionSyllables":["fu","de","jiao"],"callingCode":"+238"},{"regionCode":"CW","regionName":"库拉索","regionFlag":"🇨🇼","regionSyllables":["ku","la","suo"],"callingCode":"+599 9"},{"regionCode":"CX","regionName":"圣诞岛","regionFlag":"🇨🇽","regionSyllables":["sheng","dan","dao"],"callingCode":"+61"},{"regionCode":"CY","regionName":"塞浦路斯","regionFlag":"🇨🇾","regionSyllables":["sai","pu","lu","si"],"callingCode":"+357"},{"regionCode":"CZ","regionName":"捷克","regionFlag":"🇨🇿","regionSyllables":["jie","ke"],"callingCode":"+420"},{"regionCode":"DE","regionName":"德国","regionFlag":"🇩🇪","regionSyllables":["de","guo"],"callingCode":"+49"},{"regionCode":"DJ","regionName":"吉布提","regionFlag":"🇩🇯","regionSyllables":["ji","bu","ti"],"callingCode":"+253"},{"regionCode":"DK","regionName":"丹麦","regionFlag":"🇩🇰","regionSyllables":["dan","mai"],"callingCode":"+45"},{"regionCode":"DM","regionName":"多米尼克","regionFlag":"🇩🇲","regionSyllables":["duo","mi","ni","ke"],"callingCode":"+1-767"},{"regionCode":"DO","regionName":"多米尼加共和国","regionFlag":"🇩🇴","regionSyllables":["duo","mi","ni","jia","gong","he","guo"],"callingCode":"+1-849"},{"regionCode":"DZ","regionName":"阿尔及利亚","regionFlag":"🇩🇿","regionSyllables":["a","er","ji","li","ya"],"callingCode":"+213"},{"regionCode":"EC","regionName":"厄瓜多尔","regionFlag":"🇪🇨","regionSyllables":["e","gua","duo","er"],"callingCode":"+593"},{"regionCode":"EE","regionName":"爱沙尼亚","regionFlag":"🇪🇪","regionSyllables":["ai","sha","ni","ya"],"callingCode":"+372"},{"regionCode":"EG","regionName":"埃及","regionFlag":"🇪🇬","regionSyllables":["ai","ji"],"callingCode":"+20"},{"regionCode":"EH","regionName":"西撒哈拉","regionFlag":"🇪🇭","regionSyllables":["xi","sa","ha","la"],"callingCode":"+212"},{"regionCode":"ER","regionName":"厄立特里亚","regionFlag":"🇪🇷","regionSyllables":["e","li","te","li","ya"],"callingCode":"+291"},{"regionCode":"ES","regionName":"西班牙","regionFlag":"🇪🇸","regionSyllables":["xi","ban","ya"],"callingCode":"+34"},{"regionCode":"ET","regionName":"埃塞俄比亚","regionFlag":"🇪🇹","regionSyllables":["ai","sai","e","bi","ya"],"callingCode":"+251"},{"regionCode":"FI","regionName":"芬兰","regionFlag":"🇫🇮","regionSyllables":["fen","lan"],"callingCode":"+358"},{"regionCode":"FJ","regionName":"斐济","regionFlag":"🇫🇯","regionSyllables":["fei","ji"],"callingCode":"+679"},{"regionCode":"FK","regionName":"福克兰群岛","regionFlag":"🇫🇰","regionSyllables":["fu","ke","lan","qun","dao"],"callingCode":"+500"},{"regionCode":"FM","regionName":"密克罗尼西亚","regionFlag":"🇫🇲","regionSyllables":["mi","ke","luo","ni","xi","ya"],"callingCode":"+691"},{"regionCode":"FO","regionName":"法罗群岛","regionFlag":"🇫🇴","regionSyllables":["fa","luo","qun","dao"],"callingCode":"+298"},{"regionCode":"FR","regionName":"法国","regionFlag":"🇫🇷","regionSyllables":["fa","guo"],"callingCode":"+33"},{"regionCode":"GA","regionName":"加蓬","regionFlag":"🇬🇦","regionSyllables":["jia","peng"],"callingCode":"+241"},{"regionCode":"GB","regionName":"英国","regionFlag":"🇬🇧","regionSyllables":["ying","guo"],"callingCode":"+44"},{"regionCode":"GD","regionName":"格林纳达","regionFlag":"🇬🇩","regionSyllables":["ge","lin","na","da"],"callingCode":"+1-473"},{"regionCode":"GE","regionName":"格鲁吉亚","regionFlag":"🇬🇪","regionSyllables":["ge","lu","ji","ya"],"callingCode":"+995"},{"regionCode":"GF","regionName":"法属圭亚那","regionFlag":"🇬🇫","regionSyllables":["fa","shu","gui","ya","na"],"callingCode":"+594"},{"regionCode":"GG","regionName":"根西岛","regionFlag":"🇬🇬","regionSyllables":["gen","xi","dao"],"callingCode":"+44"},{"regionCode":"GH","regionName":"加纳","regionFlag":"🇬🇭","regionSyllables":["jia","na"],"callingCode":"+233"},{"regionCode":"GI","regionName":"直布罗陀","regionFlag":"🇬🇮","regionSyllables":["zhi","bu","luo","tuo"],"callingCode":"+350"},{"regionCode":"GL","regionName":"格陵兰","regionFlag":"🇬🇱","regionSyllables":["ge","ling","lan"],"callingCode":"+299"},{"regionCode":"GM","regionName":"冈比亚","regionFlag":"🇬🇲","regionSyllables":["gang","bi","ya"],"callingCode":"+220"},{"regionCode":"GN","regionName":"几内亚","regionFlag":"🇬🇳","regionSyllables":["ji","nei","ya"],"callingCode":"+224"},{"regionCode":"GP","regionName":"瓜德罗普","regionFlag":"🇬🇵","regionSyllables":["gua","de","luo","pu"],"callingCode":"+590"},{"regionCode":"GQ","regionName":"赤道几内亚","regionFlag":"🇬🇶","regionSyllables":["chi","dao","ji","nei","ya"],"callingCode":"+240"},{"regionCode":"GR","regionName":"希腊","regionFlag":"🇬🇷","regionSyllables":["xi","la"],"callingCode":"+30"},{"regionCode":"GS","regionName":"南乔治亚和南桑威奇群岛","regionFlag":"🇬🇸","regionSyllables":["nan","qiao","zhi","ya","he","nan","sang","wei","qi","qun","dao"],"callingCode":"+500"},{"regionCode":"GT","regionName":"危地马拉","regionFlag":"🇬🇹","regionSyllables":["wei","de","ma","la"],"callingCode":"+502"},{"regionCode":"GU","regionName":"关岛","regionFlag":"🇬🇺","regionSyllables":["guan","dao"],"callingCode":"+1-671"},{"regionCode":"GW","regionName":"几内亚比绍","regionFlag":"🇬🇼","regionSyllables":["ji","nei","ya","bi","shao"],"callingCode":"+245"},{"regionCode":"GY","regionName":"圭亚那","regionFlag":"🇬🇾","regionSyllables":["gui","ya","na"],"callingCode":"+595"},{"regionCode":"HK","regionName":"中国香港","regionFlag":"🇭🇰","regionSyllables":["zhong","guo","xiang","gang"],"callingCode":"+852"},{"regionCode":"HM","regionName":"赫德岛和麦克唐纳群岛","regionFlag":"🇭🇲","regionSyllables":["he","de","dao","he","mai","ke","tang","na","qun","dao"],"callingCode":"+672"},{"regionCode":"HN","regionName":"洪都拉斯","regionFlag":"🇭🇳","regionSyllables":["hong","dou","la","si"],"callingCode":"+504"},{"regionCode":"HR","regionName":"克罗地亚","regionFlag":"🇭🇷","regionSyllables":["ke","luo","de","ya"],"callingCode":"+385"},{"regionCode":"HT","regionName":"海地","regionFlag":"🇭🇹","regionSyllables":["hai","de"],"callingCode":"+509"},{"regionCode":"HU","regionName":"匈牙利","regionFlag":"🇭🇺","regionSyllables":["xiong","ya","li"],"callingCode":"+36"},{"regionCode":"ID","regionName":"印度尼西亚","regionFlag":"🇮🇩","regionSyllables":["yin","du","ni","xi","ya"],"callingCode":"+62"},{"regionCode":"IE","regionName":"爱尔兰","regionFlag":"🇮🇪","regionSyllables":["ai","er","lan"],"callingCode":"+353"},{"regionCode":"IL","regionName":"以色列","regionFlag":"🇮🇱","regionSyllables":["yi","se","lie"],"callingCode":"+972"},{"regionCode":"IM","regionName":"马恩岛","regionFlag":"🇮🇲","regionSyllables":["ma","en","dao"],"callingCode":"+44"},{"regionCode":"IN","regionName":"印度","regionFlag":"🇮🇳","regionSyllables":["yin","du"],"callingCode":"+91"},{"regionCode":"IO","regionName":"英属印度洋领地","regionFlag":"🇮🇴","regionSyllables":["ying","shu","yin","du","yang","ling","de"],"callingCode":"+246"},{"regionCode":"IQ","regionName":"伊拉克","regionFlag":"🇮🇶","regionSyllables":["yi","la","ke"],"callingCode":"+964"},{"regionCode":"IR","regionName":"伊朗","regionFlag":"🇮🇷","regionSyllables":["yi","lang"],"callingCode":"+98"},{"regionCode":"IS","regionName":"冰岛","regionFlag":"🇮🇸","regionSyllables":["bing","dao"],"callingCode":"+354"},{"regionCode":"IT","regionName":"意大利","regionFlag":"🇮🇹","regionSyllables":["yi","da","li"],"callingCode":"+39"},{"regionCode":"JE","regionName":"泽西岛","regionFlag":"🇯🇪","regionSyllables":["ze","xi","dao"],"callingCode":"+44"},{"regionCode":"JM","regionName":"牙买加","regionFlag":"🇯🇲","regionSyllables":["ya","mai","jia"],"callingCode":"+1-876"},{"regionCode":"JO","regionName":"约旦","regionFlag":"🇯🇴","regionSyllables":["yue","dan"],"callingCode":"+962"},{"regionCode":"JP","regionName":"日本","regionFlag":"🇯🇵","regionSyllables":["ri","ben"],"callingCode":"+81"},{"regionCode":"KE","regionName":"肯尼亚","regionFlag":"🇰🇪","regionSyllables":["ken","ni","ya"],"callingCode":"+254"},{"regionCode":"KG","regionName":"吉尔吉斯斯坦","regionFlag":"🇰🇬","regionSyllables":["ji","er","ji","si","si","tan"],"callingCode":"+996"},{"regionCode":"KH","regionName":"柬埔寨","regionFlag":"🇰🇭","regionSyllables":["jian","bu","zhai"],"callingCode":"+855"},{"regionCode":"KI","regionName":"基里巴斯","regionFlag":"🇰🇮","regionSyllables":["ji","li","ba","si"],"callingCode":"+686"},{"regionCode":"KM","regionName":"科摩罗","regionFlag":"🇰🇲","regionSyllables":["ke","mo","luo"],"callingCode":"+269"},{"regionCode":"KN","regionName":"圣基茨和尼维斯","regionFlag":"🇰🇳","regionSyllables":["sheng","ji","ci","he","ni","wei","si"],"callingCode":"+1-869"},{"regionCode":"KP","regionName":"朝鲜","regionFlag":"🇰🇵","regionSyllables":["chao","xian"],"callingCode":"+850"},{"regionCode":"KR","regionName":"韩国","regionFlag":"🇰🇷","regionSyllables":["han","guo"],"callingCode":"+82"},{"regionCode":"KW","regionName":"科威特","regionFlag":"🇰🇼","regionSyllables":["ke","wei","te"],"callingCode":"+965"},{"regionCode":"KY","regionName":"开曼群岛","regionFlag":"🇰🇾","regionSyllables":["kai","man","qun","dao"],"callingCode":"+345"},{"regionCode":"KZ","regionName":"哈萨克斯坦","regionFlag":"🇰🇿","regionSyllables":["ha","sa","ke","si","tan"],"callingCode":"+7"},{"regionCode":"LA","regionName":"老挝","regionFlag":"🇱🇦","regionSyllables":["lao","wo"],"callingCode":"+856"},{"regionCode":"LB","regionName":"黎巴嫩","regionFlag":"🇱🇧","regionSyllables":["li","ba","nen"],"callingCode":"+961"},{"regionCode":"LC","regionName":"圣卢西亚","regionFlag":"🇱🇨","regionSyllables":["sheng","lu","xi","ya"],"callingCode":"+1-758"},{"regionCode":"LI","regionName":"列支敦士登","regionFlag":"🇱🇮","regionSyllables":["lie","zhi","dun","shi","deng"],"callingCode":"+423"},{"regionCode":"LK","regionName":"斯里兰卡","regionFlag":"🇱🇰","regionSyllables":["si","li","lan","ka"],"callingCode":"+94"},{"regionCode":"LR","regionName":"利比里亚","regionFlag":"🇱🇷","regionSyllables":["li","bi","li","ya"],"callingCode":"+231"},{"regionCode":"LS","regionName":"莱索托","regionFlag":"🇱🇸","regionSyllables":["lai","suo","tuo"],"callingCode":"+266"},{"regionCode":"LT","regionName":"立陶宛","regionFlag":"🇱🇹","regionSyllables":["li","tao","wan"],"callingCode":"+370"},{"regionCode":"LU","regionName":"卢森堡","regionFlag":"🇱🇺","regionSyllables":["lu","sen","bao"],"callingCode":"+352"},{"regionCode":"LV","regionName":"拉脱维亚","regionFlag":"🇱🇻","regionSyllables":["la","tuo","wei","ya"],"callingCode":"+371"},{"regionCode":"LY","regionName":"利比亚","regionFlag":"🇱🇾","regionSyllables":["li","bi","ya"],"callingCode":"+218"},{"regionCode":"MA","regionName":"摩洛哥","regionFlag":"🇲🇦","regionSyllables":["mo","luo","ge"],"callingCode":"+212"},{"regionCode":"MC","regionName":"摩纳哥","regionFlag":"🇲🇨","regionSyllables":["mo","na","ge"],"callingCode":"+377"},{"regionCode":"MD","regionName":"摩尔多瓦","regionFlag":"🇲🇩","regionSyllables":["mo","er","duo","wa"],"callingCode":"+373"},{"regionCode":"ME","regionName":"黑山","regionFlag":"🇲🇪","regionSyllables":["hei","shan"],"callingCode":"+382"},{"regionCode":"MF","regionName":"法属圣马丁","regionFlag":"🇲🇫","regionSyllables":["fa","shu","sheng","ma","ding"],"callingCode":"+590"},{"regionCode":"MG","regionName":"马达加斯加","regionFlag":"🇲🇬","regionSyllables":["ma","da","jia","si","jia"],"callingCode":"+261"},{"regionCode":"MH","regionName":"马绍尔群岛","regionFlag":"🇲🇭","regionSyllables":["ma","shao","er","qun","dao"],"callingCode":"+692"},{"regionCode":"MK","regionName":"马其顿","regionFlag":"🇲🇰","regionSyllables":["ma","qi","dun"],"callingCode":"+389"},{"regionCode":"ML","regionName":"马里","regionFlag":"🇲🇱","regionSyllables":["ma","li"],"callingCode":"+223"},{"regionCode":"MM","regionName":"缅甸","regionFlag":"🇲🇲","regionSyllables":["mian","dian"],"callingCode":"+95"},{"regionCode":"MN","regionName":"蒙古","regionFlag":"🇲🇳","regionSyllables":["meng","gu"],"callingCode":"+976"},{"regionCode":"MO","regionName":"中国澳门","regionFlag":"🇲🇴","regionSyllables":["zhong","guo","ao","men"],"callingCode":"+853"},{"regionCode":"MP","regionName":"北马里亚纳群岛","regionFlag":"🇲🇵","regionSyllables":["bei","ma","li","ya","na","qun","dao"],"callingCode":"+1-670"},{"regionCode":"MQ","regionName":"马提尼克","regionFlag":"🇲🇶","regionSyllables":["ma","ti","ni","ke"],"callingCode":"+596"},{"regionCode":"MR","regionName":"毛里塔尼亚","regionFlag":"🇲🇷","regionSyllables":["mao","li","ta","ni","ya"],"callingCode":"+222"},{"regionCode":"MS","regionName":"蒙特塞拉特","regionFlag":"🇲🇸","regionSyllables":["meng","te","sai","la","te"],"callingCode":"+1-664"},{"regionCode":"MT","regionName":"马耳他","regionFlag":"🇲🇹","regionSyllables":["ma","er","ta"],"callingCode":"+356"},{"regionCode":"MU","regionName":"毛里求斯","regionFlag":"🇲🇺","regionSyllables":["mao","li","qiu","si"],"callingCode":"+230"},{"regionCode":"MV","regionName":"马尔代夫","regionFlag":"🇲🇻","regionSyllables":["ma","er","dai","fu"],"callingCode":"+960"},{"regionCode":"MW","regionName":"马拉维","regionFlag":"🇲🇼","regionSyllables":["ma","la","wei"],"callingCode":"+265"},{"regionCode":"MX","regionName":"墨西哥","regionFlag":"🇲🇽","regionSyllables":["mo","xi","ge"],"callingCode":"+52"},{"regionCode":"MY","regionName":"马来西亚","regionFlag":"🇲🇾","regionSyllables":["ma","lai","xi","ya"],"callingCode":"+60"},{"regionCode":"MZ","regionName":"莫桑比克","regionFlag":"🇲🇿","regionSyllables":["mo","sang","bi","ke"],"callingCode":"+258"},{"regionCode":"NA","regionName":"纳米比亚","regionFlag":"🇳🇦","regionSyllables":["na","mi","bi","ya"],"callingCode":"+264"},{"regionCode":"NC","regionName":"新喀里多尼亚","regionFlag":"🇳🇨","regionSyllables":["xin","ka","li","duo","ni","ya"],"callingCode":"+687"},{"regionCode":"NE","regionName":"尼日尔","regionFlag":"🇳🇪","regionSyllables":["ni","ri","er"],"callingCode":"+227"},{"regionCode":"NF","regionName":"诺福克岛","regionFlag":"🇳🇫","regionSyllables":["nuo","fu","ke","dao"],"callingCode":"+672"},{"regionCode":"NG","regionName":"尼日利亚","regionFlag":"🇳🇬","regionSyllables":["ni","ri","li","ya"],"callingCode":"+234"},{"regionCode":"NI","regionName":"尼加拉瓜","regionFlag":"🇳🇮","regionSyllables":["ni","jia","la","gua"],"callingCode":"+505"},{"regionCode":"NL","regionName":"荷兰","regionFlag":"🇳🇱","regionSyllables":["he","lan"],"callingCode":"+31"},{"regionCode":"NO","regionName":"挪威","regionFlag":"🇳🇴","regionSyllables":["nuo","wei"],"callingCode":"+47"},{"regionCode":"NP","regionName":"尼泊尔","regionFlag":"🇳🇵","regionSyllables":["ni","po","er"],"callingCode":"+977"},{"regionCode":"NR","regionName":"瑙鲁","regionFlag":"🇳🇷","regionSyllables":["nao","lu"],"callingCode":"+674"},{"regionCode":"NU","regionName":"纽埃","regionFlag":"🇳🇺","regionSyllables":["niu","ai"],"callingCode":"+683"},{"regionCode":"NZ","regionName":"新西兰","regionFlag":"🇳🇿","regionSyllables":["xin","xi","lan"],"callingCode":"+64"},{"regionCode":"OM","regionName":"阿曼","regionFlag":"🇴🇲","regionSyllables":["a","man"],"callingCode":"+968"},{"regionCode":"PA","regionName":"巴拿马","regionFlag":"🇵🇦","regionSyllables":["ba","na","ma"],"callingCode":"+507"},{"regionCode":"PE","regionName":"秘鲁","regionFlag":"🇵🇪","regionSyllables":["bi","lu"],"callingCode":"+51"},{"regionCode":"PF","regionName":"法属波利尼西亚","regionFlag":"🇵🇫","regionSyllables":["fa","shu","bo","li","ni","xi","ya"],"callingCode":"+689"},{"regionCode":"PG","regionName":"巴布亚新几内亚","regionFlag":"🇵🇬","regionSyllables":["ba","bu","ya","xin","ji","nei","ya"],"callingCode":"+675"},{"regionCode":"PH","regionName":"菲律宾","regionFlag":"🇵🇭","regionSyllables":["fei","lu","bin"],"callingCode":"+63"},{"regionCode":"PK","regionName":"巴基斯坦","regionFlag":"🇵🇰","regionSyllables":["ba","ji","si","tan"],"callingCode":"+92"},{"regionCode":"PL","regionName":"波兰","regionFlag":"🇵🇱","regionSyllables":["bo","lan"],"callingCode":"+48"},{"regionCode":"PM","regionName":"圣皮埃尔和密克隆群岛","regionFlag":"🇵🇲","regionSyllables":["sheng","pi","ai","er","he","mi","ke","long","qun","dao"],"callingCode":"+508"},{"regionCode":"PN","regionName":"皮特凯恩群岛","regionFlag":"🇵🇳","regionSyllables":["pi","te","kai","en","qun","dao"],"callingCode":"+872"},{"regionCode":"PR","regionName":"波多黎各","regionFlag":"🇵🇷","regionSyllables":["bo","duo","li","ge"],"callingCode":"+1-939"},{"regionCode":"PS","regionName":"巴勒斯坦领土","regionFlag":"🇵🇸","regionSyllables":["ba","lei","si","tan","ling","tu"],"callingCode":"+970"},{"regionCode":"PT","regionName":"葡萄牙","regionFlag":"🇵🇹","regionSyllables":["pu","tao","ya"],"callingCode":"+351"},{"regionCode":"PW","regionName":"帕劳","regionFlag":"🇵🇼","regionSyllables":["pa","lao"],"callingCode":"+680"},{"regionCode":"PY","regionName":"巴拉圭","regionFlag":"🇵🇾","regionSyllables":["ba","la","gui"],"callingCode":"+595"},{"regionCode":"QA","regionName":"卡塔尔","regionFlag":"🇶🇦","regionSyllables":["ka","ta","er"],"callingCode":"+974"},{"regionCode":"RE","regionName":"留尼汪","regionFlag":"🇷🇪","regionSyllables":["liu","ni","wang"],"callingCode":"+262"},{"regionCode":"RO","regionName":"罗马尼亚","regionFlag":"🇷🇴","regionSyllables":["luo","ma","ni","ya"],"callingCode":"+40"},{"regionCode":"RS","regionName":"塞尔维亚","regionFlag":"🇷🇸","regionSyllables":["sai","er","wei","ya"],"callingCode":"+381"},{"regionCode":"RU","regionName":"俄罗斯","regionFlag":"🇷🇺","regionSyllables":["e","luo","si"],"callingCode":"+7"},{"regionCode":"RW","regionName":"卢旺达","regionFlag":"🇷🇼","regionSyllables":["lu","wang","da"],"callingCode":"+250"},{"regionCode":"SA","regionName":"沙特阿拉伯","regionFlag":"🇸🇦","regionSyllables":["sha","te","a","la","bo"],"callingCode":"+966"},{"regionCode":"SB","regionName":"所罗门群岛","regionFlag":"🇸🇧","regionSyllables":["suo","luo","men","qun","dao"],"callingCode":"+677"},{"regionCode":"SC","regionName":"塞舌尔","regionFlag":"🇸🇨","regionSyllables":["sai","she","er"],"callingCode":"+248"},{"regionCode":"SD","regionName":"苏丹","regionFlag":"🇸🇩","regionSyllables":["su","dan"],"callingCode":"+249"},{"regionCode":"SE","regionName":"瑞典","regionFlag":"🇸🇪","regionSyllables":["rui","dian"],"callingCode":"+46"},{"regionCode":"SG","regionName":"新加坡","regionFlag":"🇸🇬","regionSyllables":["xin","jia","po"],"callingCode":"+65"},{"regionCode":"SH","regionName":"圣赫勒拿","regionFlag":"🇸🇭","regionSyllables":["sheng","he","lei","na"],"callingCode":"+290"},{"regionCode":"SI","regionName":"斯洛文尼亚","regionFlag":"🇸🇮","regionSyllables":["si","luo","wen","ni","ya"],"callingCode":"+386"},{"regionCode":"SJ","regionName":"斯瓦尔巴和扬马延","regionFlag":"🇸🇯","regionSyllables":["si","wa","er","ba","he","yang","ma","yan"],"callingCode":"+47"},{"regionCode":"SK","regionName":"斯洛伐克","regionFlag":"🇸🇰","regionSyllables":["si","luo","fa","ke"],"callingCode":"+421"},{"regionCode":"SL","regionName":"塞拉利昂","regionFlag":"🇸🇱","regionSyllables":["sai","la","li","ang"],"callingCode":"+232"},{"regionCode":"SM","regionName":"圣马力诺","regionFlag":"🇸🇲","regionSyllables":["sheng","ma","li","nuo"],"callingCode":"+378"},{"regionCode":"SN","regionName":"塞内加尔","regionFlag":"🇸🇳","regionSyllables":["sai","nei","jia","er"],"callingCode":"+221"},{"regionCode":"SO","regionName":"索马里","regionFlag":"🇸🇴","regionSyllables":["suo","ma","li"],"callingCode":"+252"},{"regionCode":"SR","regionName":"苏里南","regionFlag":"🇸🇷","regionSyllables":["su","li","nan"],"callingCode":"+597"},{"regionCode":"SS","regionName":"南苏丹","regionFlag":"🇸🇸","regionSyllables":["nan","su","dan"],"callingCode":"+211"},{"regionCode":"ST","regionName":"圣多美和普林西比","regionFlag":"🇸🇹","regionSyllables":["sheng","duo","mei","he","pu","lin","xi","bi"],"callingCode":"+239"},{"regionCode":"SV","regionName":"萨尔瓦多","regionFlag":"🇸🇻","regionSyllables":["sa","er","wa","duo"],"callingCode":"+503"},{"regionCode":"SX","regionName":"荷属圣马丁","regionFlag":"🇸🇽","regionSyllables":["he","shu","sheng","ma","ding"],"callingCode":"+1-721"},{"regionCode":"SY","regionName":"叙利亚","regionFlag":"🇸🇾","regionSyllables":["xu","li","ya"],"callingCode":"+963"},{"regionCode":"SZ","regionName":"斯威士兰","regionFlag":"🇸🇿","regionSyllables":["si","wei","shi","lan"],"callingCode":"+268"},{"regionCode":"TA","regionName":"特里斯坦-达库尼亚群岛","regionFlag":"🇹🇦","regionSyllables":["te","li","si","tan-da","ku","ni","ya","qun","dao"],"callingCode":"+290"},{"regionCode":"TC","regionName":"特克斯和凯科斯群岛","regionFlag":"🇹🇨","regionSyllables":["te","ke","si","he","kai","ke","si","qun","dao"],"callingCode":"+1-649"},{"regionCode":"TD","regionName":"乍得","regionFlag":"🇹🇩","regionSyllables":["zha","de"],"callingCode":"+235"},{"regionCode":"TG","regionName":"多哥","regionFlag":"🇹🇬","regionSyllables":["duo","ge"],"callingCode":"+228"},{"regionCode":"TH","regionName":"泰国","regionFlag":"🇹🇭","regionSyllables":["tai","guo"],"callingCode":"+66"},{"regionCode":"TJ","regionName":"塔吉克斯坦","regionFlag":"🇹🇯","regionSyllables":["ta","ji","ke","si","tan"],"callingCode":"+992"},{"regionCode":"TK","regionName":"托克劳","regionFlag":"🇹🇰","regionSyllables":["tuo","ke","lao"],"callingCode":"+690"},{"regionCode":"TL","regionName":"东帝汶","regionFlag":"🇹🇱","regionSyllables":["dong","di","wen"],"callingCode":"+670"},{"regionCode":"TM","regionName":"土库曼斯坦","regionFlag":"🇹🇲","regionSyllables":["tu","ku","man","si","tan"],"callingCode":"+993"},{"regionCode":"TN","regionName":"突尼斯","regionFlag":"🇹🇳","regionSyllables":["tu","ni","si"],"callingCode":"+216"},{"regionCode":"TO","regionName":"汤加","regionFlag":"🇹🇴","regionSyllables":["tang","jia"],"callingCode":"+676"},{"regionCode":"TR","regionName":"土耳其","regionFlag":"🇹🇷","regionSyllables":["tu","er","qi"],"callingCode":"+90"},{"regionCode":"TT","regionName":"特立尼达和多巴哥","regionFlag":"🇹🇹","regionSyllables":["te","li","ni","da","he","duo","ba","ge"],"callingCode":"+1-868"},{"regionCode":"TV","regionName":"图瓦卢","regionFlag":"🇹🇻","regionSyllables":["tu","wa","lu"],"callingCode":"+688"},{"regionCode":"TW","regionName":"中国台湾","regionFlag":"🇨🇳","regionSyllables":["zhong","guo","tai","wan"],"callingCode":"+886"},{"regionCode":"TZ","regionName":"坦桑尼亚","regionFlag":"🇹🇿","regionSyllables":["tan","sang","ni","ya"],"callingCode":"+255"},{"regionCode":"UA","regionName":"乌克兰","regionFlag":"🇺🇦","regionSyllables":["wu","ke","lan"],"callingCode":"+380"},{"regionCode":"UG","regionName":"乌干达","regionFlag":"🇺🇬","regionSyllables":["wu","gan","da"],"callingCode":"+256"},{"regionCode":"UM","regionName":"美国本土外小岛屿","regionFlag":"🇺🇸","regionSyllables":["mei","guo","ben","tu","wai","xiao","dao","yu"],"callingCode":"+1"},{"regionCode":"US","regionName":"美国","regionFlag":"🇺🇸","regionSyllables":["mei","guo"],"callingCode":"+1"},{"regionCode":"UY","regionName":"乌拉圭","regionFlag":"🇺🇾","regionSyllables":["wu","la","gui"],"callingCode":"+598"},{"regionCode":"UZ","regionName":"乌兹别克斯坦","regionFlag":"🇺🇿","regionSyllables":["wu","zi","bie","ke","si","tan"],"callingCode":"+998"},{"regionCode":"VA","regionName":"梵蒂冈","regionFlag":"🇻🇦","regionSyllables":["fan","di","gang"],"callingCode":"+379"},{"regionCode":"VC","regionName":"圣文森特和格林纳丁斯","regionFlag":"🇻🇨","regionSyllables":["sheng","wen","sen","te","he","ge","lin","na","ding","si"],"callingCode":"+1-784"},{"regionCode":"VE","regionName":"委内瑞拉","regionFlag":"🇻🇪","regionSyllables":["wei","nei","rui","la"],"callingCode":"+58"},{"regionCode":"VG","regionName":"英属维尔京群岛","regionFlag":"🇻🇬","regionSyllables":["ying","shu","wei","er","jing","qun","dao"],"callingCode":"+1-284"},{"regionCode":"VI","regionName":"美属维尔京群岛","regionFlag":"🇻🇮","regionSyllables":["mei","shu","wei","er","jing","qun","dao"],"callingCode":"+1-340"},{"regionCode":"VN","regionName":"越南","regionFlag":"🇻🇳","regionSyllables":["yue","nan"],"callingCode":"+84"},{"regionCode":"VU","regionName":"瓦努阿图","regionFlag":"🇻🇺","regionSyllables":["wa","nu","a","tu"],"callingCode":"+678"},{"regionCode":"WF","regionName":"瓦利斯和富图纳","regionFlag":"🇼🇫","regionSyllables":["wa","li","si","he","fu","tu","na"],"callingCode":"+681"},{"regionCode":"WS","regionName":"萨摩亚","regionFlag":"🇼🇸","regionSyllables":["sa","mo","ya"],"callingCode":"+685"},{"regionCode":"XK","regionName":"科索沃","regionFlag":"🇽🇰","regionSyllables":["ke","suo","wo"],"callingCode":"+383"},{"regionCode":"YE","regionName":"也门","regionFlag":"🇾🇪","regionSyllables":["ye","men"],"callingCode":"+967"},{"regionCode":"YT","regionName":"马约特","regionFlag":"🇾🇹","regionSyllables":["ma","yue","te"],"callingCode":"+262"},{"regionCode":"ZA","regionName":"南非","regionFlag":"🇿🇦","regionSyllables":["nan","fei"],"callingCode":"+27"},{"regionCode":"ZM","regionName":"赞比亚","regionFlag":"🇿🇲","regionSyllables":["zan","bi","ya"],"callingCode":"+260"},{"regionCode":"ZW","regionName":"津巴布韦","regionFlag":"🇿🇼","regionSyllables":["jin","ba","bu","wei"],"callingCode":"+263"}]';
        $arr = json_decode($json, true);
        foreach ($arr as $_arr) {
            echo "update zko_country set flag = '{$_arr['regionCode']}.png' where zh_name = '{$_arr['regionName']}';";
        }
        var_dump($arr);
        //框架欢迎页
        /*$body_param = '{"scene":"19","page":"pages/common/redirect","width":null,"auto_color":null,"line_color":null}';
        $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=46_G-zH5sa-qvB-YXlpMZ-qzFny5J6p5liXRAyawq7WMGey4Ek4Yd-zPj07ch2RacYrVzgiBawZ2RkleTd0XbJN9LgkRBZrJOSWgWJqULlhIuf619vY45_uNldpnBiEW6-nboEau_lUcWPaRJXcDDJcABAQQW';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body_param);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($data == NULL) {
		    $errInfo = "call http err :" . curl_errno($ch) . " - " . curl_error($ch);
		    curl_close($ch);
        } elseif($responseCode  != "200") {
		    $errInfo = "call http err httpcode=" . $responseCode;
		    curl_close($ch);
        } else {
		    curl_close($ch);
        }
//        curl_close($ch);
		var_dump($errInfo);
		var_dump($data);*/
    }

    //安装
    public function installAction()
    {
        //显示安装页面
    }

    //执行安装
    public function installDoAction()
    {
        $host = $this->getPost('host', 'localhost');
        $dbname = $this->getPost('dbname', 'mysweet');
        $username = $this->getPost('username', 'root');
        $password = $this->getPost('password', 'vagrant');
        $adminName = $this->getPost('adminm', 'admin');
        $adminPwd = $this->getPost('adminp', 'admin');
        $adminPwd2 = $this->getPost('adminpt', 'admin');
        //链接数据库
        installServices::getInstance()->wdbConfig($host, $username, $password, '');
        //建表插入基础数据
        installServices::getInstance()->createTableAndInsertData($dbname, 'default');
        //链接数据库
        installServices::getInstance()->wdbConfig($host, $username, $password, $dbname);
        //创建管理员账号
        installServices::getInstance()->createAdmin($adminName, $adminPwd, $adminPwd2);
    }

    public function test58Action()
    {
        die();
        ini_set('max_execution_time', '3600');
        /*$rows = exampleModels::getInstance()->aa(
            "select DISTINCT m.member_id,m.code,case when mp.role = 1 then '店主' when mp.role = 2 then '主管' when mp.role > 2 then '经理' else '普通用户' end AS role
from sl_order o 
left join sl_member m on m.member_id = o.member_id 
left join sl_member_plus mp on mp.member_id = m.member_id
where o.create_time >= UNIX_TIMESTAMP('2020-01-01') and o.status > 0"
        );
        echo '一共'.count($rows).'<br>';
        foreach ($rows as $_row) {
            if ($_row['member_id'] > 96800532) {
                wampModels::getInstance()->insert(
                    'sl_gold_egg',
                    [
                        'member_id' => $_row['member_id'],
                        'role' => $_row['role'],
                        'code' => $_row['code'],
                    ]
                );
            }
        }
        echo 'success';
        die;
        $data = [];*/
        $id = $this->getQuery('id', 94099265);
        while ($rows = wampModels::getInstance()->aa(
            "select member_id from sl_gold_egg where member_id > {$id} order by member_id asc limit 1000"
        )) {
            foreach ($rows as $_row) {
                $updata = [];
                $useSql = "select member_id,sum(total_egg) AS num,sum(last_amount) AS amount,FROM_UNIXTIME(create_time, '%m') AS mon
from sl_order  
where member_id = {$_row['member_id']} and create_time >= UNIX_TIMESTAMP('2020-11-01') and status > 0 group by FROM_UNIXTIME(create_time, '%m')";
                $ores = exampleModels::getInstance()->aa($useSql);
                if (!empty($ores)) {
                    foreach ($ores as $_ore) {
                        switch ($_ore['mon']) {
                            case '01':
                                $updata['b_1'] = $_ore['num'];
                                $updata['c_1'] = $_ore['amount'];
                                break;
                            case '11':
                                $updata['b_11'] = $_ore['num'];
                                $updata['c_11'] = $_ore['amount'];
                                break;
                            case '12':
                                $updata['b_12'] = $_ore['num'];
                                $updata['c_12'] = $_ore['amount'];
                                break;
                        }
                    }
                }

                $getSql = "select sum(change_num) AS num,FROM_UNIXTIME(create_time, '%m') AS mon
from sl_member_gold_egg_log  
where member_id = {$_row['member_id']} and create_time >= UNIX_TIMESTAMP('2020-11-01') and change_num > 0 group by FROM_UNIXTIME(create_time, '%m')";
                $getArr = exampleModels::getInstance()->aa($getSql);
                if (!empty($getArr)) {
                    foreach ($getArr as $_get) {
                        switch ($_get['mon']) {
                            case '01':
                                $updata['a_1'] = $_get['num'];
                                break;
                            case '11':
                                $updata['a_11'] = $_get['num'];
                                break;
                            case '12':
                                $updata['a_12'] = $_get['num'];
                                break;
                        }
                    }
                }
                if (!empty($updata)) {
                    wampModels::getInstance()->update('sl_gold_egg', $updata, ['member_id' => $_row['member_id']]);
                }
                $id = $_row['member_id'];
            }
            echo $id . '<br>';
        }
        die;
        //参与用户数（定义：完成赚金矿的某一项日常任务或加入大区或参与组队pk即算参与）

        /*$sql = "select price_rule_id,goods_id from srm_goods where STATUS = 1";
        $rows = example2Models::getInstance()->aa($sql);
        foreach ($rows as $_row) {
            if (isset($data[$_row['price_rule_id']])) {
                $data[$_row['price_rule_id']] .= ','.$_row['goods_id'];
            } else {
                $data[$_row['price_rule_id']] = $_row['goods_id'];
            }

        }
        echo '<table border = "1">';
        foreach ($data as $_k => $_v) {
            $_tmp = exampleModels::getInstance()->aa("select sum(real_sales) num from sl_goods_data where goods_id in ({$_v}) limit 1");
            echo '<tr>';
            echo '<td>'.$_k.'</td>';
            echo '<td>'.$_tmp[0]['num'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
        var_dump($data);
        die;*/
        /*
        $sql = "select rpl.member_id,count(rpl.id) as c from sl_gold_miner_red_packets_log rpl
left join sl_member_plus mp on mp.member_id = rpl.member_id
where rpl.packet_type = 1 and create_time >= UNIX_TIMESTAMP('2020-11-01') and rpl.create_time < UNIX_TIMESTAMP('2020-11-10 22:00') 
and mp.role >= 3
GROUP by rpl.member_id";
        $rows = exampleModels::getInstance()->aa($sql);
        $t1 = 0;
        foreach ($rows as $_row) {
            if ($_row['c'] <= 5) {
                if (isset($data[$t1][$_row['c']])) {
                    $data[$t1][$_row['c']]++;
                } else {
                    $data[$t1][$_row['c']] = 1;
                }
            } elseif ($_row['c'] >= 6 && $_row['c'] <= 10) {
                if (isset($data[$t1][6])) {
                    $data[$t1][6]++;
                } else {
                    $data[$t1][6] = 1;
                }
            } elseif ($_row['c'] >= 10 && $_row['c'] <= 20) {
                if (isset($data[$t1][7])) {
                    $data[$t1][7]++;
                } else {
                    $data[$t1][7] = 1;
                }
            } elseif ($_row['c'] > 20 && $_row['c'] <= 30) {
                if (isset($data[$t1][8])) {
                    $data[$t1][8]++;
                } else {
                    $data[$t1][8] = 1;
                }
            } elseif ($_row['c'] > 30 && $_row['c'] <= 40) {
                if (isset($data[$t1][9])) {
                    $data[$t1][9]++;
                } else {
                    $data[$t1][9] = 1;
                }
            } elseif ($_row['c'] > 40 && $_row['c'] <= 50) {
                if (isset($data[$t1][10])) {
                    $data[$t1][10]++;
                } else {
                    $data[$t1][10] = 1;
                }
            } else {
                if (isset($data[$t1][11])) {
                    $data[$t1][11]++;
                } else {
                    $data[$t1][11] = 1;
                }
            }
        }
        echo '<table border = "1">';
        for ($i = 1; $i <= 11; $i++) {
            echo '<tr>';
            echo '<td>'. ($data[0][$i] ?? 0) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        die;*/
        /*
        $t1 = strtotime(date('2020-11-01'));
        $t0 = $t1;
        while ($t1 < strtotime(date('2020-11-11'))) {
            $t2 = $t1 + 86400;
            $rows = exampleModels::getInstance()->aa("select member_id,count(id) AS c from sl_gold_miner_red_packets_log 
where packet_type = 1 and create_time >= {$t1} and create_time < {$t2} GROUP by member_id");
            foreach ($rows as $_row) {
                if ($_row['c'] <= 5) {
                    if (isset($data[$t1][$_row['c']])) {
                        $data[$t1][$_row['c']]++;
                    } else {
                        $data[$t1][$_row['c']] = 1;
                    }
                } elseif ($_row['c'] >= 6 && $_row['c'] <= 10) {
                    if (isset($data[$t1][6])) {
                        $data[$t1][6]++;
                    } else {
                        $data[$t1][6] = 1;
                    }
                } elseif ($_row['c'] >= 10 && $_row['c'] <= 20) {
                    if (isset($data[$t1][7])) {
                        $data[$t1][7]++;
                    } else {
                        $data[$t1][7] = 1;
                    }
                } elseif ($_row['c'] > 20 && $_row['c'] <= 30) {
                    if (isset($data[$t1][8])) {
                        $data[$t1][8]++;
                    } else {
                        $data[$t1][8] = 1;
                    }
                } elseif ($_row['c'] > 30 && $_row['c'] <= 40) {
                    if (isset($data[$t1][9])) {
                        $data[$t1][9]++;
                    } else {
                        $data[$t1][9] = 1;
                    }
                } elseif ($_row['c'] > 40 && $_row['c'] <= 50) {
                    if (isset($data[$t1][10])) {
                        $data[$t1][10]++;
                    } else {
                        $data[$t1][10] = 1;
                    }
                } else {
                    if (isset($data[$t1][11])) {
                        $data[$t1][11]++;
                    } else {
                        $data[$t1][11] = 1;
                    }
                }
            }
            $t1 = $t2;
        }

        //var_dump($data);
        echo '<table border = "1">';
        for ($i = 1; $i <= 11; $i++) {
            echo '<tr>';
            for ($j = 0; $j <= 10; $j ++) {
                echo '<td>'. ($data[$t0 + (86400 * $j)][$i] ?? 0) . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        die;
        */
        /*while ($rows = exampleModels::getInstance()->aa(
            "select mam.member_id,mam.area_id,mam.create_time,mp.role from sl_gold_miner_area_member mam
left join sl_member_plus mp on mp.member_id = mam.member_id where mam.member_id > {$id} limit 100"
        )) {
            foreach ($rows as $_row) {
                if (empty($_row['role'])) {
                    $key2 = 0;
                } elseif ($_row['role'] >= 3) {
                    $key2 = 3;
                } else {
                    $key2 = $_row['role'];
                }
                $day = date('d', $_row['create_time']);
                if (isset($data[$_row['area_id']][$key2][$day])) {
                    $data[$_row['area_id']][$key2][$day]++;
                } else {
                    $data[$_row['area_id']][$key2][$day] = 1;
                }
                $id = $_row['member_id'];
            }
        }

        //var_dump($data);
        echo '<table>';
        foreach ($data as $_k => $_v) {
            echo '<tr><td>'.$_k.'</td></tr>';
            for ($i = 0; $i <= 3; $i++) {
                echo '<tr>';
                for ($j = 1; $j <= 10; $j++) {
                    if ($j < 10) {
                        echo '<td>'. ($data[$_k][$i]['0'.$j] ?? 0) . '</td>';
                    } else {
                        echo '<td>'. ($data[$_k][$i][$j] ?? 0) . '</td>';
                    }
                }
                echo '</tr>';
            }
        }
        echo '</table>';
        die;*/
        /*while ($rows = exampleModels::getInstance()->aa(
            "select mml.member_id,mml.level,mp.role,mml.full_level_time from sl_gold_miner_member_level mml
left join sl_member_plus mp on mp.member_id = mml.member_id
where mml.member_id > {$id} and mml.level > 14 and mml.level <= 19 limit 100"
        )) {
            $member_ids = implode(',', array_column($rows, 'member_id'));
            $sql = "select DISTINCT member_id,create_time from sl_gold_miner_red_packets_log ".
                    "where member_id IN({$member_ids}) and level_type = 3 group by member_id order by id desc ";
            $times = exampleModels::getInstance()->aa($sql);
            foreach ($times as $_time) {
                $keyDays[$_time['member_id']] = date('d', $_time['create_time'] + 3600 * 8);
            }
            foreach ($rows as $_row) {
                if ($_row['level'] <= 12) {
                    $key1 = 1;
                } elseif ($_row['level'] >= 13 && $_row['level'] <= 14) {
                    $key1 = 2;
                } elseif ($_row['level'] >= 15 && $_row['level'] <= 19) {
                    $key1 = 3;
                } elseif ($_row['level'] == 20) {
                    $key1 = 4;
                }
                if (empty($_row['role'])) {
                    $key2 = 0;
                } elseif ($_row['role'] >= 3) {
                    $key2 = 3;
                } else {
                    $key2 = $_row['role'];
                }
                if (isset($data[$key1][$key2]['num'])) {
                    $data[$key1][$key2]['num']++;
                } else {
                    $data[$key1][$key2]['num'] = 1;
                }
                $num = $keyDays[$_row['member_id']] ?? 10;
//                if ($num == 0) {
//                    echo $_row['member_id'].'==='.$_row['level'].'<br>';
//                }
                if (isset($data[$key1][$key2][$num])) {
                    $data[$key1][$key2][$num]++;
                } else {
                    $data[$key1][$key2][$num] = 1;
                }
                switch ($key1) {
                    case 1:
                        break;
                    case 2:
                        break;
                    case 3:
                        break;
                    case 4:
                        $num = date('d', $_row['full_level_time']);
                        if (isset($data[$key1][$key2][$num])) {
                            $data[$key1][$key2][$num]++;
                        } else {
                            $data[$key1][$key2][$num] = 1;
                        }
                        break;
                }

                $id = $_row['member_id'];
            }
        }*/
        $path = 'wjk.csv';
        $csv = new \hl\library\Tools\Excel\HLCsvReader();
        $data = $csv->getData($path);
        $i = 0;
        foreach ($data as $_list) {
//            if ($i >= 4) {
//                break;
//            }
            $fixamount = $_list[2];
            echo '-- ' . $_list[0] . '___' . $i;
            echo '<br>';
            //拉新
            $sql1 = "select id,packet_num,packet_type,packet_amount,create_time from sl_gold_miner_red_packets_log " .
                "where member_id = '{$_list[0]}' and level_type = 1 and packet_status = 1 and packet_type = 1 order by id asc";
            $list1 = exampleModels::getInstance()->aa($sql1);
            //var_dump($list1);
            //非拉新
            $sql2 = "select id,packet_num,packet_type,packet_amount,create_time from sl_gold_miner_red_packets_log " .
                "where member_id = '{$_list[0]}' and level_type = 1 and packet_status = 1 and packet_type = 0 order by id asc";
            $list2 = exampleModels::getInstance()->aa($sql2);
            //var_dump($list2);
            $openTime = end($list2)['create_time'];
            if ($list1) {
                foreach ($list1 as $_list1) {
                    if ($openTime < 1604207488) { //0.88
                        echo "update sl_gold_miner_red_packets_log set packet_amount = " . 0.88 * $_list1['packet_num'] . " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (0.88 * $_list1['packet_num']);
                    } elseif ($openTime >= 1604207488 && $openTime < 1604207504) { // 1.68
                        echo "update sl_gold_miner_red_packets_log set packet_amount = " . 1.68 * $_list1['packet_num'] . " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (1.68 * $_list1['packet_num']);
                    } elseif ($openTime >= 1604207504) { // 1.26
                        echo "update sl_gold_miner_red_packets_log set packet_amount = " . 1.26 * $_list1['packet_num'] . " where id = '{$_list1['id']} limit 1';<br>";
                        $fixamount -= (1.26 * $_list1['packet_num']);
                    }
                }
            }
            $num = array_sum(array_column($list2, 'packet_num'));
            $unit = floor($fixamount * 100 / $num) / 100;
            foreach ($list2 as $_list2) {
                if ($num == $_list2['packet_num']) {
                    echo "update sl_gold_miner_red_packets_log set packet_amount = " . $fixamount . " where id = '{$_list2['id']} limit 1';<br>";
                } else {
                    echo "update sl_gold_miner_red_packets_log set packet_amount = " . $unit * $_list2['packet_num'] . " where id = '{$_list2['id']} limit 1';<br>";
                    $fixamount -= ($unit * $_list2['packet_num']);
                }
                $num -= $_list2['packet_num'];
            }
            unset($openTime);
            unset($list1);
            unset($list2);
            $i++;
        }
        //var_dump($data);

    }

    public function test112Action()
    {
        $sql = "select data from sl_store_update_aptitude where status >= 0 limit 300";
        $list = exampleModels::getInstance()->aa($sql);
        $data = [];
        foreach ($list as $_list) {
            $a = json_decode($_list['data'], true);
            foreach ($a['other_qualification'] as $_v) {
                if (strpos($_v, '/G0/')) {
                    $data[] = $_v;
                    echo $_v . '<br>';
                }
            }
            foreach ($a['qualification'] as $__v) {
                if (strpos($__v['aptitude_image'], '/G0/')) {
                    $data[] = $__v['aptitude_image'];
                    echo $__v['aptitude_image'] . '<br>';
                }
            }
        }
        var_dump($data);
    }

    public function test3Action()
    {
        $p2 = [];
        $p3 = [];
        $p4 = [];
        $p5 = [];
        $w2 = [];
        $w3 = [];
        $w4 = [];
        $w5 = [];
        $sp2 = [];
        $sp3 = [];
        $sp4 = [];
        $sp5 = [];
        $sw2 = [];
        $sw3 = [];
        $sw4 = [];
        $sw5 = [];
        $sql = "select id,supplier_goods_id,supplier_store_id,goods_id,title,shipping from srm_goods where is_delete = 0 and goods_id >0";
        $list = exampleModels::getInstance()->aa($sql);
        $data = [];
        foreach ($list as $_list) {
            if (empty($_list['shipping'])) {
                continue;
            }
            $ship = json_decode($_list['shipping'], true);
            if (!isset($ship['postage_default']) || !isset($ship['district'])) {
                continue;
            }
            //var_dump($ship, $_list);
            if ($ship['type'] == 'pcs') {
                if (!empty($ship['district'])) {
                    foreach ($ship['district'] as $_v) {
                        if ($_v['postage'] >= 20) {
                            $data[] = [
                                '供应链商品id' => $_list['supplier_goods_id'] . "\t",
                                '商品id' => $_list['goods_id'],
                                '商品名称' => $_list['title'],
                                '件数' => $_v['start'],
                                '钱' => $_v['postage'],
                                '区域' => $_v['to_province'],
                                '首重' => '',
                                '区域2' => '',
                                '钱2' => '',
                            ];
                        }
                    }
                }
            } elseif ($shop['type'] = 'weight') {
                if (!empty($ship['district'])) {
                    foreach ($ship['district'] as $_v) {
                        if ($_v['postage'] >= 20) {
                            $data[] = [
                                '供应链商品id' => $_list['supplier_goods_id'] . "\t",
                                '商品id' => $_list['goods_id'],
                                '商品名称' => $_list['title'],
                                '件数' => '',
                                '区域' => '',
                                '钱' => '',
                                '首重' => $_v['start'],
                                '区域2' => $_v['to_province'],
                                '钱2' => $_v['postage'],
                            ];
                        }
                    }
                }
            }
            //var_dump($ship);
        }
        //var_dump($data);
        die;
        //实例化类
        $csv = new \hl\library\Tools\Excel\HLPutoutCsv();
        //设置表名
        $csv->setTableName('202091');
        //设置表头
        $csv->setTableHead(['code', 'zi_gou', 'title', 'pcs', 'fee', 'zero', 'weg', 'fee', 'zero']);
        //导出数据
        $csv->putout($data);
        /*
        echo "p2== ".count(array_unique($p2))."<br>";
        echo "p3== ".count(array_unique($p3))."<br>";
        echo "p4== ".count(array_unique($p4))."<br>";
        echo "p5== ".count(array_unique($p5))."<br>";
        echo "w2== ".count(array_unique($w2))."<br>";
        echo "w3== ".count(array_unique($w3))."<br>";
        echo "w4== ".count(array_unique($w4))."<br>";
        echo "w5== ".count(array_unique($w5))."<br>";
        echo "sp2== ".count(array_unique($sp2))."<br>";
        echo "sp3== ".count(array_unique($sp3))."<br>";
        echo "sp4== ".count(array_unique($sp4))."<br>";
        echo "sp5== ".count(array_unique($sp5))."<br>";
        echo "sw2== ".count(array_unique($sw2))."<br>";
        echo "sw3== ".count(array_unique($sw3))."<br>";
        echo "sw4== ".count(array_unique($sw4))."<br>";
        echo "sw5== ".count(array_unique($sw5))."<br>";*/
        die;
    }

    public function test2Action()
    {

        echo '这里写测试代码';
        //\hl\library\Functions\Helper::message();
        echo \hl\library\Functions\Helper::getClientIP();
        echo \hl\library\Functions\Helper::execTime();

        die;
        //亲求的时间
        \hl\library\Functions\Helper::dump(REQUEST_TIME_FLOAT);

        $html = <<<HTML
<html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

     <title>PHP: Hypertext Preprocessor</title>

 <link rel="shortcut icon" href="http://php.net/favicon.ico">
 <link rel="search" type="application/opensearchdescription+xml" href="http://php.net/phpnetimprovedsearch.src" title="Add PHP.net search">
 <link rel="alternate" type="application/atom+xml" href="http://php.net/releases/feed.php" title="PHP Release feed">
 <link rel="alternate" type="application/atom+xml" href="http://php.net/feed.atom" title="PHP: Hypertext Preprocessor">

 <link rel="canonical" href="http://php.net/index.php">
 <link rel="shorturl" href="http://php.net/index">
 <link rel="alternate" href="http://php.net/index" hreflang="x-default">
   </head>
   <body>       
    <ul class="nav">
      <li class=""><a href="/downloads">Downloads</a></li>
      <li class=""><a href="/docs.php">Documentation</a></li>
      <li class=""><a href="/get-involved" >Get Involved</a></li>
      <li class=""><a href="/support">Help</a></li>
    </ul>
    <table>
        <tr>
            <th>a</th>
            <th>b</th>
            <th>e</th>
            <th>d</th>
            <th>c</th>
        </tr>
        <tr>
            <td>sdf</td>
            <td>ssdfdf</td>
            <td>sfgdf</td>
            <td>svbdf</td>
            <td>sbndf</td>
        </tr>
        <tr>
            <td>s士大夫df</td>
            <td>sd士大夫f</td>
            <td>s法的规定df</td>
            <td>s法国和df</td>
            <td>s房管局df</td>
        </tr>
    </table>
   </body>
</html>
HTML;
        //$html = file_get_contents('http://tablesorter.com/docs/');
        $hta = new \hl\library\Tools\Html2Array\HLHtmlToArray($html);
        \hl\library\Functions\Helper::dump($hta->toJson());
        \hl\library\Functions\Helper::dump($hta->toArray());
        /**
         * Get html source from tablesorter.com
         */
        echo '<hr>';
        /**
         * Print array of table rows for each table
         */
        print_r($hta->getArrayOfTr());
        echo '<hr>';
        /**
         * Print array of table columns for each table
         */
        print_r($hta->getArrayOfTd(true));
        echo '<hr>';
        /**
         * Print array of table headers for each table
         */
        print_r($hta->getArrayOfTh(true));
        echo '<hr>';
        /**
         * Returns array of tables
         *
         * @param bool $get_only_text (optional)
         * @return array
         */
        print_r($hta->getArrayOfTables(false));
        echo '<hr>';
        $str = exampleServices::getInstance()->todo();

        $str = \hl\library\Functions\Helper::alert('sdfsdf', 'sfsdfsd', 'http://mysweet95.com');
        //传递值到模板
        \hl\HLView::param('out', $str);
//        \hl\library\Functions\Helper::dump('sdf');
    }

    public function test624Action()
    {
        $time = time();
        $cates = exampleModels::getInstance()->aa(
            "select DISTINCT member_id from sl_mtree_award"
        );
        $memberIds = array_column($cates, 'member_id');
        $memberIdStr = implode(',', $memberIds);
        echo time() - $time;
        echo '<br>';
        $orderList = exampleModels::getInstance()->aa(
            "select o.member_id,o.shareid,og.price,og.qty_remain,og.qty,og.real_amount,og.promotion_type,og.goods_id,o.create_time from sl_order o
left join sl_order_goods og on og.order_id = o.id
where o.pay_status = 1 and og.promotion_type <> 13 and og.qty_remain > 0 and o.order_type = 0 and o.create_time between UNIX_TIMESTAMP('2021-06-18') and UNIX_TIMESTAMP('2021-06-19')
"
        );
        echo time() - $time;
        echo '<br>';
        $self = []; //自购
        $son = []; //儿子
        $person = [];
        $amount = 0;
        if (!empty($orderList)) {
            //排除超级爆品
            $orderList = array_filter($orderList, function ($row) {
                if ($row['promotion_type'] == 12) {
                    return false;
                }
                return true;
            });
            echo time() - $time;
            echo '<br>';
            //排除指定积分商品
            $configList = exampleModels::getInstance()->aa(
                "select goods_id,started_at,end_at from sl_point_activity_config where started_at < UNIX_TIMESTAMP('2021-06-19') and end_at > UNIX_TIMESTAMP('2021-06-18') and status = 1"
            );
            echo time() - $time;
            echo '<br>';
            if (!empty($configList)) {
                $orderList = array_filter($orderList, function ($row) use ($configList) {
                    foreach ($configList as $config) {
                        if ($row['goods_id'] == $config['goods_id']) {
                            //判断时间
                            if ($row['create_time'] >= $config['started_at']
                                && $row['create_time'] < $config['end_at']
                            ) {
                                return false;
                            }
                        }
                    }
                    return true;
                });
            }
            echo time() - $time;
            echo '<br>';
            $memberIdsKey = array_fill_keys($memberIds, '1');
            echo time() - $time;
            echo '<br>';
            foreach ($orderList as $order) {
                if (isset($memberIdsKey[$order['member_id']])) {
                    $person[] = $order['member_id'];
                    if (isset($self[$order['member_id']])) {
                        $self[$order['member_id']] += $order['price'] * $order['qty_remain'];
                    } else {
                        $self[$order['member_id']] = $order['price'] * $order['qty_remain'];
                    }
                }
                if (isset($memberIdsKey[$order['shareid']])) {
                    $person[] = $order['shareid'];
                    $person[] = $order['member_id'];
                    if (isset($son[$order['shareid']])) {
                        $son[$order['shareid']] += $order['price'] * $order['qty_remain'];
                    } else {
                        $son[$order['shareid']] = $order['price'] * $order['qty_remain'];
                    }
                    if (isset($self[$order['member_id']])) {
                        $self[$order['member_id']] += $order['price'] * $order['qty_remain'];
                    } else {
                        $self[$order['member_id']] = $order['price'] * $order['qty_remain'];
                    }
                }
                $amount += $order['price'] * $order['qty_remain'];
            }
            echo time() - $time;
            echo '<br>';
        }
        $person = array_unique($person);
        $data = [
            'self' => $self,
            'son' => $son,
            'num' => count($person),
            'amount' => $amount,
            'person' => $person
        ];
        var_dump($data);
        die;
    }

    public function test618Action()
    {
        $list = wampModels::getInstance()->aa(
            "select * from sl_goods_3"
        );
        $data = [];
        foreach ($list as $_list) {
            if (isset($data[$_list['cate_3']])) {
                $data[$_list['cate_3']]['attr'] = array_unique(
                    array_merge($data[$_list['cate_3']]['attr'], explode(',', $_list['attr']))
                );
            } else {
                $data[$_list['cate_3']] = [
                    'cate_1_name' => $_list['cate_1_name'],
                    'cate_2_name' => $_list['cate_2_name'],
                    'cate_3_name' => $_list['cate_3_name'],
                    'attr' => explode(',', $_list['attr'])
                ];
            }
        }
        foreach ($data as $_data) {
            $_data['attr'] = implode(',', $_data['attr']);
            $out[] = $_data;
        }
        //var_dump($data);
        //实例化类
        $csv = new \hl\library\Tools\Excel\HLPutoutCsv();
        //设置表名
        $csv->setTableName('2021616');
        //设置表头
        $csv->setTableHead(['cate_1', 'cate_2', 'cate_3', 'attr']);
        //导出数据
        $csv->putout($out);
        //var_dump($data);
        die;
    }

    public function test6126Action()
    {
        ini_set('max_execution_time', '3600');
        $cates = exampleModels::getInstance()->aa(
            "select id,name from sl_goods_categories"
        );
        $cates = array_column($cates, 'name', 'id');
        $id = 17611;
        while ($rows = exampleModels::getInstance()->aa(
            "select seller_id,store_id from sl_seller where web_site = 'SRM' and seller_id > {$id} order by seller_id asc limit 10"
        )) {
            foreach ($rows as $row) {
                $goods = exampleModels::getInstance()->aa(
                    "select id,cate_1,cate_2,cate_3 from sl_goods where seller_id = {$row['seller_id']} and store_id = {$row['store_id']}"
                );
                if (!empty($goods)) {
                    foreach ($goods as $_goods) {
                        $attr = exampleModels::getInstance()->aa(
                            "select attrs from sl_goods_body where goods_id = {$_goods['id']}"
                        );
                        $attrs = json_decode($attr[0]['attrs'], true);
                        $outattr = [];
                        foreach ($attrs as $_attr) {
                            $outattr = array_merge($outattr, array_keys($_attr));
                        }

                        $has = wampModels::getInstance()->aa("select id,attr where cate_1 = {$_goods['cate_1']} and cate_2 = {$_goods['cate_2']} and cate_3 = {$_goods['cate_3']}");
                        if ($has) {
                            wampModels::getInstance()->update(
                                'sl_goods_3',
                                ['attr' => implode(',', array_unique(array_merge(explode(',', $has[0]['attr']), $outattr)))],
                                ['id' => $has[0]['id']]
                            );
                        } else {
                            wampModels::getInstance()->insert(
                                'sl_goods_3',
                                [
                                    'cate_1' => $_goods['cate_1'],
                                    'cate_1_name' => $cates[$_goods['cate_1']] ?? '',
                                    'cate_2' => $_goods['cate_2'],
                                    'cate_2_name' => $cates[$_goods['cate_2']] ?? '',
                                    'cate_3' => $_goods['cate_3'],
                                    'cate_3_name' => $cates[$_goods['cate_3']] ?? '',
                                    'attr' => implode(',', $outattr)
                                ]
                            );
                        }
                    }
                }
                $id = $row['seller_id'];
            }
            echo '===>' . $id . '<===<br>';
        }

    }

    public function test616Action()
    {
        ini_set('max_execution_time', '3600');
        $stores = [];
        $s_c = [];
        $s_c_n = [];
        $s_c_2 = [];
        $s_c_2_n = [];
        $id = 0;
        $cates = exampleModels::getInstance()->aa(
            "select id,name from sl_goods_categories where top_id = 0"
        );
        $cates = array_column($cates, 'name', 'id');

        while ($rows = exampleModels::getInstance()->aa(
            "select * from sl_goods where id > {$id} and status = 1 and is_delete = 0 order by id asc limit 100"
        )) {
            foreach ($rows as $row) {
                if (!isset($s_c[$row['store_id']])) {
                    $store = exampleModels::getInstance()->aa("select sc_id,store_name from sl_store where store_id = {$row['store_id']}");
                    $stores[$row['store_id']] = $store[0]['store_name'];
                    $s_c[$row['store_id']] = $store[0]['sc_id'];
                    $s_c_n[$row['store_id']] = $cates[$store[0]['sc_id']] ?? '';
                    $bind = exampleModels::getInstance()->aa("select class1_id from sl_store_bind_class where store_id = {$row['store_id']}");
                    if ($bind) {
                        foreach ($bind as $_bind) {
                            $s_c_2[$row['store_id']][] = $_bind['class1_id'];
                            $s_c_2_n[$row['store_id']][] = $cates[$_bind['class1_id']] ?? '';
                        }
                    }
                }
                if ($row['cate_1'] != $s_c[$row['store_id']] && !in_array($row['cate_1'], $s_c_2[$row['store_id']])) {
                    $data = [
                        'store_id' => $row['store_id'],
                        'goods_id' => $row['id'],
                        'title' => $row['title'],
                        'cate_1' => $row['cate_1'],
                        'store_name' => $stores[$row['store_id']] ?? '',
                        'cate_1_name' => $cates[$row['cate_1']] ?? '',
                        's_cate_name' => $s_c_n[$row['store_id']] ?? '',
                        's_cate' => implode(',', $s_c_2_n[$row['store_id']] ?? [])
                    ];
                    //var_dump($data);
                    wampModels::getInstance()->insert('sl_goods_2', $data);
                }
                $id = $row['id'];
            }
        }
    }
    public function test79Action()
    {
        ini_set('max_execution_time', '3600');
        $id = 77668;
        while ($rows = exampleModels::getInstance()->aa(
            "select id,play_time,member_id,helper_number_ids from sl_mtree_help where helper_number_ids != '' and id > {$id} limit 10"
        )) {
            foreach ($rows as $row) {
                $data = [
                    'play_time' => $row['play_time'],
                    'member_id' => $row['member_id'],
                    'helper_number_ids' => $row['helper_number_ids'],
                    'create_time' => count(explode(',', $row['helper_number_ids']))
                ];
                wampModels::getInstance()->insert('sl_mtree_help', $data);
                $id = $row['id'];
            }
        }
    }


    public function test6282Action()
    {
        ini_set('max_execution_time', '3600');
        $id = 97445257;
        while ($rows = exampleModels::getInstance()->aa(
            "select member_id from sl_mtree_member_level where member_id > {$id} limit 100"
        )) {
            foreach ($rows as $row) {
                $member = exampleModels::getInstance()->aa(
                    "select member_id,level_type,FROM_UNIXTIME(create_time, '%d') as t from sl_mtree_red_packets_log where member_id = {$row['member_id']} and level_type in (1,2,3)"
                );
                if (!empty($member)) {
                    $data = [];
                    foreach ($member as $_v) {
                        $data['member_id'] = $_v['member_id'];
                        $data['cate_'.$_v['level_type']] = $_v['t'];
                    }

                }
                $id = $row['member_id'];
            }
        }
    }

    public function testAction()
    {
        ini_set('max_execution_time', '3600');
        $id = 968027;
        while ($rows = exampleModels::getInstance()->aa(
            "select id,store_id,brand_id,first_sell_time from sl_goods 
where id > {$id} and status = 1 and is_delete = 0 order by id asc limit 1000"
        )) {
            foreach ($rows as $row) {
                if ($row['brand_id'] > 0) {
                    $data = $row;
                    $order = exampleModels::getInstance()->aa("select count(DISTINCT o.id) num from sl_order_goods og 
left join sl_order o on o.id = og.order_id
where og.goods_id = {$row['id']} and o.create_time between UNIX_TIMESTAMP('2021-06-15') and UNIX_TIMESTAMP('2021-07-16')");
                    if (isset($order[0])) {
                        $data['order_num'] = $order[0]['num'] ?? 0;
                    }
                    $order2 = exampleModels::getInstance()->aa("select count(DISTINCT o.id) num from sl_order_goods og 
left join sl_order o on o.id = og.order_id
where og.goods_id = {$row['id']} and o.create_time between UNIX_TIMESTAMP('2021-06-15') and UNIX_TIMESTAMP('2021-07-16') and pay_status = 1");
                    if (isset($order2[0])) {
                        $data['pay_order_num'] = $order2[0]['num'] ?? 0;
                    }
                    $favourite = exampleModels::getInstance()->aa("select count(id) num from sl_member_favorite_goods where goods_id = {$row['id']} and create_time between UNIX_TIMESTAMP('2021-06-15') and UNIX_TIMESTAMP('2021-07-16')");
                    if (isset($favourite[0])) {
                        $data['favorite_num'] = $favourite[0]['num'];
                    }
                    $order3 = exampleModels::getInstance()->aa("select count(DISTINCT o.member_id) num from sl_order_goods og 
left join sl_order o on o.id = og.order_id
where og.goods_id = {$row['id']} and o.create_time between UNIX_TIMESTAMP('2021-01-01') and UNIX_TIMESTAMP('2021-07-01') and pay_status = 1");
                    if (isset($order3[0])) {
                        $data['buy_num'] = $order3[0]['num'];
                    }
                    $order4 = exampleModels::getInstance()->aa("select o.member_id,count(o.id) num from sl_order_goods og 
left join sl_order o on o.id = og.order_id
where og.goods_id = {$row['id']} and o.create_time between UNIX_TIMESTAMP('2021-01-01') and UNIX_TIMESTAMP('2021-07-01') and pay_status = 1 GROUP BY o.member_id HAVING count(o.id) > 1");
                    if (isset($order4[0])) {
                        $data['buy_2_num'] = count($order4);
                    }
                    wampModels::getInstance()->insert('sl_goods_data', $data);
                }
                $id = $row['id'];
            }
        }
       // var_dump($rows);
        echo 'ok';
        die;
    }

    public function test716Action()
    {
        ini_set('max_execution_time', '3600');
        $stores = [];
        $cates = [];
        $id = 985592;
        $time = time();
        $act = exampleModels::getInstance()->aa(
            "select goods_id,prom_type,prom_id from sl_activity_summary where status = 1 and end_time > {$time} and prom_type in (5,6)"
        );
        $act = array_combine(array_column($act, 'goods_id'), $act);
                //var_dump($act);
        //单独设置利润点
        $storeCate = exampleModels::getInstance()->aa(
            "select store_id,cate_2,profit from sl_store_cate_profit where status = 1 and end_time > {$time} and start_time < {$time}"
        );
        $storeCates = [];
        if (!empty($storeCate)) {
            foreach ($storeCate as $_cate) {
                $storeCates[$_cate['store_id']][$_cate['cate_2']] = $_cate['profit'];
            }
        }

        while ($rows = exampleModels::getInstance()->aa(
            "select * from sl_goods where id > {$id} and status = 1 and is_delete = 0 order by id asc limit 100"
        )) {
            foreach ($rows as $row) {
                if (!isset($stores[$row['store_id']])) {
                    $store = exampleModels::getInstance()->aa("select store_name,store_profit from sl_store where store_id = {$row['store_id']}");
                    $stores[$row['store_id']] = $store[0];
                }
                if (!isset($cates[$row['cate_2']])) {
                    $cate = exampleModels::getInstance()->aa("select id,name,profit from sl_goods_categories where id in ({$row['cate_1']},{$row['cate_2']})");
                    if (!empty($cate)) {
                        foreach ($cate as $_cate) {
                            $cates[$_cate['id']] = $_cate;
                        }
                    }
                }
                $p = [bcmul(bcdiv(bcsub($row['price'], $row['cost_price'], 2), $row['price'], 2), 100, 2)];
                $sku = exampleModels::getInstance()->aa("select * from sl_goods_sku where goods_id = {$row['id']}");
                if (!empty($sku)) {
                    foreach ($sku as $_sku) {
                        $p[] = bcmul(bcdiv(bcsub($_sku['price'], $_sku['cost_price'], 2), $_sku['price'], 2), 100, 2);
                    }
                }
                $c_p = min($p);
                if ((isset($storeCates[$row['store_id']][$row['cate_2']]) && $c_p < $storeCates[$row['store_id']][$row['cate_2']]) ||
                    (!isset($storeCates[$row['store_id']][$row['cate_2']]) && $c_p < $cates[$row['cate_2']]['profit'])) {
                    if (isset($act[$row['id']])) {
                        $prom_type = $act[$row['id']]['prom_type'];
                        $prom_id = $act[$row['id']]['prom_id'];
                        if ($prom_type == 5) {
                            $every = exampleModels::getInstance()->aa(
                                "select act_time from sl_activity_every_day_special_entry where id = {$prom_id}"
                            );
                            $act_title = date('Y-m-d', $every[0]['act_time']);
                        } elseif ($prom_type == 6)  {
                            $com1 = exampleModels::getInstance()->aa(
                                "select act_id from sl_activity_common_entry where id = {$prom_id}"
                            );
                            $com2 = exampleModels::getInstance()->aa(
                                "select act_title from sl_activity_common where id = {$com1[0]['act_id']}"
                            );
                            $act_title = $com2[0]['act_title'];
                        }
                    } else {
                        $prom_type = 0;
                        $prom_id = 0;
                        $act_title = '';
                    }
//                    if (!in_array($row['store_id'], [5973, 5974, 5975, 5983, 5984, 5994, 5997, 6001, 6002, 6003, 6004, 6006, 6080, 6081])) {
//
//                    }
                    $data = [
                        'store_id' => $row['store_id'],
                        'store_name' => $stores[$row['store_id']]['store_name'] ?? '',
                        'cate_1' => $row['cate_1'],
                        'cate_2' => $row['cate_2'],
                        'cate_1_name' => $cates[$row['cate_1']]['name'] ?? '',
                        'cate_2_name' => $cates[$row['cate_2']]['name'] ?? '',
                        'goods_id' => $row['id'],
                        'title' => $row['title'],
                        'g_profit' => $c_p,
                        's_profit' => $stores[$row['store_id']]['store_profit'] ?? 0,
                        'c_profit' => $cates[$row['cate_2']]['profit'] ?? '',
                        'prom_type' => $prom_type,
                        'prom_id' => $prom_id,
                        'act_title' => $act_title,
                    ];
                    wampModels::getInstance()->insert('sl_goods', $data);
                }
                $id = $row['id'];
            }
        }



       // var_dump($rows);
        echo 'ok';
        die;
    }

    /*
    ** 兆骏用程序
    */
    public function test202162Action()
    {
        $out = [];
        $path = 'lrd.csv';
        $csv = new \hl\library\Tools\Excel\HLCsvReader();
        $data = $csv->getData($path);
        foreach ($data as $k => $v) {
            //echo $v[0].'-'.$v[3];
            //echo '<br>';
            $sql = "select AVG((sku.price-sku.cost_price)/sku.price ) as 'yongjin',AVG((sku.cost_price-sku.seller_cost_price)/sku.cost_price ) as 'lirun' from srm_goods_sku as sku 
left join srm_goods  on sku.goods_id=srm_goods.id
 where srm_goods.store_id= {$v[0]} and srm_goods.cate_1 = {$v[3]}";
            $row = example2Models::getInstance()->aa($sql);
            $out[] = [
                'store_id' => $v[0],
                'cate_1' => $v[3],
                'yj' => $row[0]['yongjin'],
                'lr' => $row[0]['lirun']
            ];
            //var_dump($row);
        }
        //实例化类
        $csv = new \hl\library\Tools\Excel\HLPutoutCsv();
        //设置表名
        $csv->setTableName('202091');
        //设置表头
        $csv->setTableHead(['store_id', 'cate_1', 'yj', 'lr']);
        //导出数据
        $csv->putout($out);
        //var_dump($data);
        die;
    }
}
