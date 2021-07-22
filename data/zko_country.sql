/*
Navicat MySQL Data Transfer

Source Server         : 预发
Source Server Version : 50718
Source Host           : 10.253.97.0:3306
Source Database       : zko

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2021-07-22 14:58:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zko_country
-- ----------------------------
DROP TABLE IF EXISTS `zko_country`;
CREATE TABLE `zko_country` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zh_name` varchar(100) NOT NULL COMMENT '中文名',
  `en_name` varchar(100) NOT NULL COMMENT '英文名',
  `code` varchar(100) NOT NULL,
  `flag` varchar(100) NOT NULL DEFAULT '' COMMENT '旗帜',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4 COMMENT='国家';

-- ----------------------------
-- Records of zko_country
-- ----------------------------
INSERT INTO `zko_country` VALUES ('1', '阿尔巴尼亚', 'Albania', 'ALB', 'AL.png');
INSERT INTO `zko_country` VALUES ('2', '阿尔及利亚', 'Algeria', 'DZA', 'DZ.png');
INSERT INTO `zko_country` VALUES ('3', '阿富汗', 'Afghanistan', 'AFG', 'AF.png');
INSERT INTO `zko_country` VALUES ('4', '阿根廷', 'Argentina', 'ARG', 'AR.png');
INSERT INTO `zko_country` VALUES ('5', '阿拉伯联合酋长国', 'The United Arab Emirates', 'ARE', 'AE.png');
INSERT INTO `zko_country` VALUES ('6', '阿鲁巴', 'Aruba', 'ABW', 'AW.png');
INSERT INTO `zko_country` VALUES ('7', '阿曼', 'Oman', 'OMN', 'OM.png');
INSERT INTO `zko_country` VALUES ('8', '阿塞拜疆', 'Azerbaijan', 'AZE', 'AZ.png');
INSERT INTO `zko_country` VALUES ('9', '阿森松岛', 'Ascension', 'ASC', 'AC.png');
INSERT INTO `zko_country` VALUES ('10', '埃及', 'Egypt', 'EGY', 'EG.png');
INSERT INTO `zko_country` VALUES ('11', '埃塞俄比亚', 'Ethiopia', 'ETH', 'ET.png');
INSERT INTO `zko_country` VALUES ('12', '爱尔兰', 'Ireland', 'IRL', 'IE.png');
INSERT INTO `zko_country` VALUES ('13', '爱沙尼亚', 'Estonia', 'EST', 'EE.png');
INSERT INTO `zko_country` VALUES ('14', '安道尔', 'Andorra', 'AND', 'AD.png');
INSERT INTO `zko_country` VALUES ('15', '安哥拉', 'Angola', 'AGO', 'AO.png');
INSERT INTO `zko_country` VALUES ('16', '安圭拉', 'Anguilla', 'AIA', 'AI.png');
INSERT INTO `zko_country` VALUES ('17', '安提瓜岛和巴布达', 'Antigua and Barbuda', 'ATG', 'AG.png');
INSERT INTO `zko_country` VALUES ('18', '奥地利', 'Austria', 'AUT', 'AT.png');
INSERT INTO `zko_country` VALUES ('19', '奥兰群岛', 'Oran Islands', 'ALA', 'AX.png');
INSERT INTO `zko_country` VALUES ('20', '澳大利亚', 'Australia', 'AUS', 'AU.png');
INSERT INTO `zko_country` VALUES ('21', '巴巴多斯岛', 'Barbados', 'BRB', 'BB.png');
INSERT INTO `zko_country` VALUES ('22', '巴布亚新几内亚', 'papua ew guinea', 'PNG', 'PG.png');
INSERT INTO `zko_country` VALUES ('23', '巴哈马', 'Bahamas', 'BHS', 'BS.png');
INSERT INTO `zko_country` VALUES ('24', '巴基斯坦', 'Pakistan', 'PAK', 'PK.png');
INSERT INTO `zko_country` VALUES ('25', '巴拉圭', 'Paraguay', 'PRY', 'PY.png');
INSERT INTO `zko_country` VALUES ('26', '巴勒斯坦', 'Palestine', 'PSE', 'PS.png');
INSERT INTO `zko_country` VALUES ('27', '巴林', 'Bahrain', 'BHR', 'BH.png');
INSERT INTO `zko_country` VALUES ('28', '巴拿马', 'Panama', 'PAN', 'PA.png');
INSERT INTO `zko_country` VALUES ('29', '巴西', 'Brazil', 'BRA', 'BR.png');
INSERT INTO `zko_country` VALUES ('30', '白俄罗斯', 'Belarus', 'BLR', 'BY.png');
INSERT INTO `zko_country` VALUES ('31', '百慕大', 'Bermuda', 'BMU', 'BM.png');
INSERT INTO `zko_country` VALUES ('32', '保加利亚', 'Bulgaria', 'BGR', 'BG.png');
INSERT INTO `zko_country` VALUES ('33', '北马里亚纳群岛', 'Northern Mariana Islands', 'MNP', 'MP.png');
INSERT INTO `zko_country` VALUES ('34', '贝宁', 'Benin', 'BEN', 'BJ.png');
INSERT INTO `zko_country` VALUES ('35', '比利时', 'Belgium', 'BEL', 'BE.png');
INSERT INTO `zko_country` VALUES ('36', '冰岛', 'Iceland', 'ISL', 'IS.png');
INSERT INTO `zko_country` VALUES ('37', '波多黎各', 'Puerto Rico', 'PRI', 'PR.png');
INSERT INTO `zko_country` VALUES ('38', '波兰', 'poland', 'POL', 'PL.png');
INSERT INTO `zko_country` VALUES ('39', '波斯尼亚和黑塞哥维那', 'Bosnia and Herzegovina', 'BIH', 'BA.png');
INSERT INTO `zko_country` VALUES ('40', '玻利维亚', 'bolivia', 'BOL', 'BO.png');
INSERT INTO `zko_country` VALUES ('41', '伯利兹', 'Belize', 'BLZ', 'BZ.png');
INSERT INTO `zko_country` VALUES ('42', '博茨瓦纳', 'botswana', 'BWA', 'BW.png');
INSERT INTO `zko_country` VALUES ('43', '不丹', 'Bhutan', 'BTN', 'BT.png');
INSERT INTO `zko_country` VALUES ('44', '布基纳法索', 'burkina faso', 'BFA', 'BF.png');
INSERT INTO `zko_country` VALUES ('45', '布隆迪', 'burundi', 'BDI', 'BI.png');
INSERT INTO `zko_country` VALUES ('46', '布韦岛', 'Bouvet Island', 'BVT', 'ZW.png');
INSERT INTO `zko_country` VALUES ('47', '朝鲜', 'North Korea', 'PRK', 'KP.png');
INSERT INTO `zko_country` VALUES ('48', '丹麦', 'Denmark', 'DNK', 'DK.png');
INSERT INTO `zko_country` VALUES ('49', '德国', 'Germany', 'DEU', 'DE.png');
INSERT INTO `zko_country` VALUES ('50', '东帝汶', 'Timor-Leste', 'TLS', 'TL.png');
INSERT INTO `zko_country` VALUES ('51', '多哥', 'Togo', 'TGO', 'TG.png');
INSERT INTO `zko_country` VALUES ('52', '多米尼加', 'Dominican', 'DMA', 'DM.png');
INSERT INTO `zko_country` VALUES ('53', '多米尼加共和国', 'Dominican Republic', 'DOM', 'DO.png');
INSERT INTO `zko_country` VALUES ('54', '俄罗斯', 'Russia', 'RUS', 'RU.png');
INSERT INTO `zko_country` VALUES ('55', '厄瓜多尔', 'Ecuador', 'ECU', 'EC.png');
INSERT INTO `zko_country` VALUES ('56', '厄立特里亚', 'Eritrea', 'ERI', 'ER.png');
INSERT INTO `zko_country` VALUES ('57', '法国', 'France', 'FRA', 'FR.png');
INSERT INTO `zko_country` VALUES ('58', '法罗群岛', 'Faroe Islands', 'FRO', 'FO.png');
INSERT INTO `zko_country` VALUES ('59', '法属波利尼西亚', 'French Polynesia', 'PYF', 'PF.png');
INSERT INTO `zko_country` VALUES ('60', '法属圭亚那', 'French Guiana', 'GUF', 'GF.png');
INSERT INTO `zko_country` VALUES ('61', '法属南部领地', 'French Southern Territories', 'ATF', '');
INSERT INTO `zko_country` VALUES ('62', '梵蒂冈', 'Vatican', 'VAT', 'VA.png');
INSERT INTO `zko_country` VALUES ('63', '菲律宾', 'The Philippines', 'PHL', 'PH.png');
INSERT INTO `zko_country` VALUES ('64', '斐济', 'Fiji', 'FJI', 'FJ.png');
INSERT INTO `zko_country` VALUES ('65', '芬兰', 'Finland', 'FIN', 'FI.png');
INSERT INTO `zko_country` VALUES ('66', '佛得角', 'Cape Verde', 'CPV', 'CV.png');
INSERT INTO `zko_country` VALUES ('67', '弗兰克群岛', 'Frank Islands', 'FLK', '');
INSERT INTO `zko_country` VALUES ('68', '冈比亚', 'Gambia', 'GMB', 'GM.png');
INSERT INTO `zko_country` VALUES ('69', '刚果', 'Congo', 'COG', 'CD.png');
INSERT INTO `zko_country` VALUES ('70', '刚果民主共和国', 'Democratic Republic of Congo', 'COD', 'CG.png');
INSERT INTO `zko_country` VALUES ('71', '哥伦比亚', 'Columbia', 'COL', 'CO.png');
INSERT INTO `zko_country` VALUES ('72', '哥斯达黎加', 'Costa Rica', 'CRI', 'CR.png');
INSERT INTO `zko_country` VALUES ('73', '格恩西岛', 'guernsey', 'GGY', '');
INSERT INTO `zko_country` VALUES ('74', '格林纳达', 'Grenada', 'GRD', 'GD.png');
INSERT INTO `zko_country` VALUES ('75', '格陵兰', 'Greenland', 'GRL', 'GL.png');
INSERT INTO `zko_country` VALUES ('76', '古巴', 'Cuba', 'CUB', 'CU.png');
INSERT INTO `zko_country` VALUES ('77', '瓜德罗普', 'Gua de Ropp', 'GLP', 'GP.png');
INSERT INTO `zko_country` VALUES ('78', '关岛', 'Guam', 'GUM', 'GU.png');
INSERT INTO `zko_country` VALUES ('79', '圭亚那', 'Guyana', 'GUY', 'GY.png');
INSERT INTO `zko_country` VALUES ('80', '哈萨克斯坦', 'Kazakhstan', 'KAZ', 'KZ.png');
INSERT INTO `zko_country` VALUES ('81', '海地', 'Haiti', 'HTI', 'HT.png');
INSERT INTO `zko_country` VALUES ('82', '韩国', 'The Republic of Korea', 'KOR', 'KR.png');
INSERT INTO `zko_country` VALUES ('83', '荷兰', 'Netherlands', 'NLD', 'NL.png');
INSERT INTO `zko_country` VALUES ('84', '荷属安地列斯', 'netherlands antilles', 'ANT', '');
INSERT INTO `zko_country` VALUES ('85', '赫德和麦克唐纳群岛', 'Heard And Mcdonald Islands', 'HMD', 'HM.png');
INSERT INTO `zko_country` VALUES ('86', '洪都拉斯', 'Honduras', 'HND', 'HN.png');
INSERT INTO `zko_country` VALUES ('87', '基里巴斯', 'Kiribati', 'KIR', 'KI.png');
INSERT INTO `zko_country` VALUES ('88', '吉布提', 'Djibouti', 'DJI', 'DJ.png');
INSERT INTO `zko_country` VALUES ('89', '吉尔吉斯斯坦', 'Kyrgyzstan', 'KGZ', 'KG.png');
INSERT INTO `zko_country` VALUES ('90', '几内亚', 'Guinea', 'GIN', 'GN.png');
INSERT INTO `zko_country` VALUES ('91', '几内亚比绍', 'Guinea-Bissau', 'GNB', 'GW.png');
INSERT INTO `zko_country` VALUES ('92', '加拿大', 'Canada', 'CAN', 'CA.png');
INSERT INTO `zko_country` VALUES ('93', '加纳', 'Ghana', 'GHA', 'GH.png');
INSERT INTO `zko_country` VALUES ('94', '加蓬', 'Gabon', 'GAB', 'GA.png');
INSERT INTO `zko_country` VALUES ('95', '柬埔寨', 'Cambodia', 'KHM', 'KH.png');
INSERT INTO `zko_country` VALUES ('96', '捷克共和国', 'Czech Republic', 'CZE', 'CZ.png');
INSERT INTO `zko_country` VALUES ('97', '津巴布韦', 'zimbabwe', 'ZWE', 'ZW.png');
INSERT INTO `zko_country` VALUES ('98', '喀麦隆', 'Cameroon', 'CMR', 'CM.png');
INSERT INTO `zko_country` VALUES ('99', '卡塔尔', 'Qatar', 'QAT', 'QA.png');
INSERT INTO `zko_country` VALUES ('100', '开曼群岛', 'Cayman Islands', 'CYM', 'KY.png');
INSERT INTO `zko_country` VALUES ('101', '科科斯群岛', 'Cocos Islands', 'CCK', 'CC.png');
INSERT INTO `zko_country` VALUES ('102', '科摩罗', 'Comoros', 'COM', 'KM.png');
INSERT INTO `zko_country` VALUES ('103', '科特迪瓦', 'Cote d\'Ivoire', 'CIV', 'CI.png');
INSERT INTO `zko_country` VALUES ('104', '科威特', 'Kuwait', 'KWT', 'KW.png');
INSERT INTO `zko_country` VALUES ('105', '克罗地亚', 'Croatia', 'HRV', 'HR.png');
INSERT INTO `zko_country` VALUES ('106', '肯尼亚', 'Kenya', 'KEN', 'KE.png');
INSERT INTO `zko_country` VALUES ('107', '库克群岛', 'Cook Islands', 'COK', 'CK.png');
INSERT INTO `zko_country` VALUES ('108', '拉脱维亚', 'Latvia', 'LVA', 'LV.png');
INSERT INTO `zko_country` VALUES ('109', '莱索托', 'Lesotho', 'LSO', 'LS.png');
INSERT INTO `zko_country` VALUES ('110', '老挝', 'Laos', 'LAO', 'LA.png');
INSERT INTO `zko_country` VALUES ('111', '黎巴嫩', 'Lebanon', 'LBN', 'LB.png');
INSERT INTO `zko_country` VALUES ('112', '立陶宛', 'Lithuania', 'LTU', 'LT.png');
INSERT INTO `zko_country` VALUES ('113', '利比里亚', 'Liberia', 'LBR', 'LR.png');
INSERT INTO `zko_country` VALUES ('114', '利比亚', 'Libya', 'LBY', 'LY.png');
INSERT INTO `zko_country` VALUES ('115', '列支敦士登', 'Liechtenstein', 'LIE', 'LI.png');
INSERT INTO `zko_country` VALUES ('116', '留尼旺岛', 'Reunion', 'REU', 'RE.png');
INSERT INTO `zko_country` VALUES ('117', '卢森堡', 'Luxembourg', 'LUX', 'LU.png');
INSERT INTO `zko_country` VALUES ('118', '卢旺达', 'Rwanda', 'RWA', 'RW.png');
INSERT INTO `zko_country` VALUES ('119', '罗马尼亚', 'Romania', 'ROU', 'RO.png');
INSERT INTO `zko_country` VALUES ('120', '马达加斯加', 'Madagascar', 'MDG', 'MG.png');
INSERT INTO `zko_country` VALUES ('121', '马尔代夫', 'Maldives', 'MDV', 'MV.png');
INSERT INTO `zko_country` VALUES ('122', '马耳他', 'Malta', 'MLT', 'MT.png');
INSERT INTO `zko_country` VALUES ('123', '马拉维', 'Malawi', 'MWI', 'MW.png');
INSERT INTO `zko_country` VALUES ('124', '马来西亚', 'Malaysia', 'MYS', 'MY.png');
INSERT INTO `zko_country` VALUES ('125', '马里', 'Mali', 'MLI', 'ML.png');
INSERT INTO `zko_country` VALUES ('126', '马其顿', 'Macedonia', 'MKD', 'MK.png');
INSERT INTO `zko_country` VALUES ('127', '马绍尔群岛', 'Marshall Islands', 'MHL', 'MH.png');
INSERT INTO `zko_country` VALUES ('128', '马提尼克', 'Martinique', 'MTQ', 'MQ.png');
INSERT INTO `zko_country` VALUES ('129', '马约特岛', 'Mayotte', 'MYT', 'YT.png');
INSERT INTO `zko_country` VALUES ('130', '曼岛', 'The Isle of man', 'IMN', 'IM.png');
INSERT INTO `zko_country` VALUES ('131', '毛里求斯', 'Mauritius', 'MUS', 'MU.png');
INSERT INTO `zko_country` VALUES ('132', '毛里塔尼亚', 'Mauritania', 'MRT', 'MR.png');
INSERT INTO `zko_country` VALUES ('133', '美国', 'U.S.A', 'USA', 'US.png');
INSERT INTO `zko_country` VALUES ('134', '美属萨摩亚', 'American Samoa', 'ASM', 'AS.png');
INSERT INTO `zko_country` VALUES ('135', '美属外岛', 'The outlying islands', 'UMI', 'VI.png');
INSERT INTO `zko_country` VALUES ('136', '蒙古', 'Mongolia', 'MNG', 'MN.png');
INSERT INTO `zko_country` VALUES ('137', '蒙特塞拉特', 'Montserrat', 'MSR', 'MS.png');
INSERT INTO `zko_country` VALUES ('138', '孟加拉', 'Bengal', 'BGD', 'BD.png');
INSERT INTO `zko_country` VALUES ('139', '秘鲁', 'Peru', 'PER', 'PE.png');
INSERT INTO `zko_country` VALUES ('140', '密克罗尼西亚', 'Micronesia', 'FSM', 'FM.png');
INSERT INTO `zko_country` VALUES ('141', '缅甸', 'Myanmar', 'MMR', 'MM.png');
INSERT INTO `zko_country` VALUES ('142', '摩尔多瓦', 'Moldova', 'MDA', 'MD.png');
INSERT INTO `zko_country` VALUES ('143', '摩洛哥', 'Morocco', 'MAR', 'MA.png');
INSERT INTO `zko_country` VALUES ('144', '摩纳哥', 'Monaco', 'MCO', 'MC.png');
INSERT INTO `zko_country` VALUES ('145', '莫桑比克', 'Mozambique', 'MOZ', 'MZ.png');
INSERT INTO `zko_country` VALUES ('146', '墨西哥', 'Mexico', 'MEX', 'MX.png');
INSERT INTO `zko_country` VALUES ('147', '纳米比亚', 'Namibia', 'NAM', 'NA.png');
INSERT INTO `zko_country` VALUES ('148', '南非', 'South Africa', 'ZAF', 'ZA.png');
INSERT INTO `zko_country` VALUES ('149', '南极洲', 'Antarctica', 'ATA', 'AQ.png');
INSERT INTO `zko_country` VALUES ('150', '南乔治亚和南桑德威奇群岛', 'South Georgia and the South Sandwich Islands', 'SGS', 'GS.png');
INSERT INTO `zko_country` VALUES ('151', '瑙鲁', 'Nauru', 'NRU', 'NR.png');
INSERT INTO `zko_country` VALUES ('152', '尼泊尔', 'Nepal', 'NPL', 'NP.png');
INSERT INTO `zko_country` VALUES ('153', '尼加拉瓜', 'Nicaragua', 'NIC', 'NI.png');
INSERT INTO `zko_country` VALUES ('154', '尼日尔', 'Niger', 'NER', 'NE.png');
INSERT INTO `zko_country` VALUES ('155', '尼日利亚', 'Nigeria', 'NGA', 'NG.png');
INSERT INTO `zko_country` VALUES ('156', '纽埃', 'Niue', 'NIU', 'NU.png');
INSERT INTO `zko_country` VALUES ('157', '挪威', 'Norway', 'NOR', 'NO.png');
INSERT INTO `zko_country` VALUES ('158', '诺福克', 'Norfolk', 'NFK', 'NF.png');
INSERT INTO `zko_country` VALUES ('159', '帕劳群岛', 'Palau', 'PLW', 'PW.png');
INSERT INTO `zko_country` VALUES ('160', '皮特凯恩', 'Pitcairn', 'PCN', 'PN.png');
INSERT INTO `zko_country` VALUES ('161', '葡萄牙', 'Portugal', 'PRT', 'PT.png');
INSERT INTO `zko_country` VALUES ('162', '乔治亚', 'Georgia', 'GEO', 'GS.png');
INSERT INTO `zko_country` VALUES ('163', '日本', 'Japan', 'JPN', 'JP.png');
INSERT INTO `zko_country` VALUES ('164', '瑞典', 'Sweden', 'SWE', 'SE.png');
INSERT INTO `zko_country` VALUES ('165', '瑞士', 'Switzerland', 'CHE', 'CH.png');
INSERT INTO `zko_country` VALUES ('166', '萨尔瓦多', 'Salvatore', 'SLV', 'SV.png');
INSERT INTO `zko_country` VALUES ('167', '萨摩亚', 'Samoa', 'WSM', 'WS.png');
INSERT INTO `zko_country` VALUES ('168', '塞尔维亚,黑山', 'Montenegro, Serbia', 'SCG', 'RS.png');
INSERT INTO `zko_country` VALUES ('169', '塞拉利昂', 'sierra leone', 'SLE', 'SL.png');
INSERT INTO `zko_country` VALUES ('170', '塞内加尔', 'Senegal', 'SEN', 'SN.png');
INSERT INTO `zko_country` VALUES ('171', '塞浦路斯', 'Cyprus', 'CYP', 'CY.png');
INSERT INTO `zko_country` VALUES ('172', '塞舌尔', 'Seychelles', 'SYC', 'SC.png');
INSERT INTO `zko_country` VALUES ('173', '沙特阿拉伯', 'Saudi Arabia', 'SAU', 'SA.png');
INSERT INTO `zko_country` VALUES ('174', '圣诞岛', 'Christmas Island', 'CXR', 'CX.png');
INSERT INTO `zko_country` VALUES ('175', '圣多美和普林西比', 'Sao Tome and Principe', 'STP', 'ST.png');
INSERT INTO `zko_country` VALUES ('176', '圣赫勒拿', 'Helena', 'SHN', 'SH.png');
INSERT INTO `zko_country` VALUES ('177', '圣基茨和尼维斯', 'Saint Kitts and evis', 'KNA', 'KN.png');
INSERT INTO `zko_country` VALUES ('178', '圣卢西亚', 'Saint Lucia', 'LCA', 'LC.png');
INSERT INTO `zko_country` VALUES ('179', '圣马力诺', 'San Marino', 'SMR', 'SM.png');
INSERT INTO `zko_country` VALUES ('180', '圣皮埃尔和米克隆群岛', 'San Pierre and M Islands', 'SPM', 'PM.png');
INSERT INTO `zko_country` VALUES ('181', '圣文森特和格林纳丁斯', 'Saint Vincent and the Grenadines', 'VCT', 'VC.png');
INSERT INTO `zko_country` VALUES ('182', '斯里兰卡', 'Sri Lanka', 'LKA', 'LK.png');
INSERT INTO `zko_country` VALUES ('183', '斯洛伐克', 'Slovakia', 'SVK', 'SK.png');
INSERT INTO `zko_country` VALUES ('184', '斯洛文尼亚', 'Slovenia', 'SVN', 'SI.png');
INSERT INTO `zko_country` VALUES ('185', '斯瓦尔巴和扬马廷', 'J Val Ba and Yang Ting Ting', 'SJM', 'SJ.png');
INSERT INTO `zko_country` VALUES ('186', '斯威士兰', 'Swaziland', 'SWZ', 'SZ.png');
INSERT INTO `zko_country` VALUES ('187', '苏丹', 'Sultan', 'SDN', 'SD.png');
INSERT INTO `zko_country` VALUES ('188', '苏里南', 'Suriname', 'SUR', 'SR.png');
INSERT INTO `zko_country` VALUES ('189', '所罗门群岛', 'Solomon Islands', 'SLB', 'SB.png');
INSERT INTO `zko_country` VALUES ('190', '索马里', 'Somalia', 'SOM', 'SO.png');
INSERT INTO `zko_country` VALUES ('191', '塔吉克斯坦', 'Tajikistan', 'TJK', 'TJ.png');
INSERT INTO `zko_country` VALUES ('192', '泰国', 'Thailand', 'THA', 'TH.png');
INSERT INTO `zko_country` VALUES ('193', '坦桑尼亚', 'Tanzania', 'TZA', 'TZ.png');
INSERT INTO `zko_country` VALUES ('194', '汤加', 'Tonga', 'TON', 'TO.png');
INSERT INTO `zko_country` VALUES ('195', '特克斯和凯克特斯群岛', 'The Turks and Kaiketesi Islands', 'TCA', 'TC.png');
INSERT INTO `zko_country` VALUES ('196', '特里斯坦达昆哈', 'Tristan Da khuon ha', 'TAA', 'TA.png');
INSERT INTO `zko_country` VALUES ('197', '特立尼达和多巴哥', 'Trinidad and Tobago', 'TTO', 'TT.png');
INSERT INTO `zko_country` VALUES ('198', '突尼斯', 'Tunisia', 'TUN', 'TN.png');
INSERT INTO `zko_country` VALUES ('199', '图瓦卢', 'Tuvalu', 'TUV', 'TV.png');
INSERT INTO `zko_country` VALUES ('200', '土耳其', 'Turkey', 'TUR', 'TR.png');
INSERT INTO `zko_country` VALUES ('201', '土库曼斯坦', 'Turkmenistan', 'TKM', 'TM.png');
INSERT INTO `zko_country` VALUES ('202', '托克劳', 'Tokelau', 'TKL', 'TK.png');
INSERT INTO `zko_country` VALUES ('203', '瓦利斯和福图纳', 'Wallis and Futuna', 'WLF', 'WF.png');
INSERT INTO `zko_country` VALUES ('204', '瓦努阿图', 'Vanuatu', 'VUT', 'VU.png');
INSERT INTO `zko_country` VALUES ('205', '危地马拉', 'Guatemala', 'GTM', 'GT.png');
INSERT INTO `zko_country` VALUES ('206', '维尔京群岛，美属', 'Virgin Islands, American', 'VIR', 'VI.png');
INSERT INTO `zko_country` VALUES ('207', '维尔京群岛，英属', 'Virgin Islands, British', 'VGB', 'VG.png');
INSERT INTO `zko_country` VALUES ('208', '委内瑞拉', 'Venezuela', 'VEN', 'VE.png');
INSERT INTO `zko_country` VALUES ('209', '文莱', 'Brunei', 'BRN', 'BN.png');
INSERT INTO `zko_country` VALUES ('210', '乌干达', 'Uganda', 'UGA', 'UG.png');
INSERT INTO `zko_country` VALUES ('211', '乌克兰', 'Ukraine', 'UKR', 'UA.png');
INSERT INTO `zko_country` VALUES ('212', '乌拉圭', 'Uruguay', 'URY', 'UY.png');
INSERT INTO `zko_country` VALUES ('213', '乌兹别克斯坦', 'Uzbekistan', 'UZB', 'UZ.png');
INSERT INTO `zko_country` VALUES ('214', '西班牙', 'Spain', 'ESP', 'ES.png');
INSERT INTO `zko_country` VALUES ('215', '希腊', 'Greece', 'GRC', 'GR.png');
INSERT INTO `zko_country` VALUES ('216', '新加坡', 'Singapore', 'SGP', 'SG.png');
INSERT INTO `zko_country` VALUES ('217', '新喀里多尼亚', 'New Caledonia', 'NCL', 'NC.png');
INSERT INTO `zko_country` VALUES ('218', '新西兰', 'New Zealand', 'NZL', 'NZ.png');
INSERT INTO `zko_country` VALUES ('219', '匈牙利', 'Hungary', 'HUN', 'HU.png');
INSERT INTO `zko_country` VALUES ('220', '叙利亚', 'Syria', 'SYR', 'SY.png');
INSERT INTO `zko_country` VALUES ('221', '牙买加', 'Jamaica', 'JAM', 'JM.png');
INSERT INTO `zko_country` VALUES ('222', '亚美尼亚', 'Armenia', 'ARM', 'AM.png');
INSERT INTO `zko_country` VALUES ('223', '也门', 'Yemen', 'YEM', 'YE.png');
INSERT INTO `zko_country` VALUES ('224', '伊拉克', 'Iraq', 'IRQ', 'IQ.png');
INSERT INTO `zko_country` VALUES ('225', '伊朗', 'Iran', 'IRN', 'IR.png');
INSERT INTO `zko_country` VALUES ('226', '以色列', 'Israel', 'ISR', 'IL.png');
INSERT INTO `zko_country` VALUES ('227', '意大利', 'Italy', 'ITA', 'IT.png');
INSERT INTO `zko_country` VALUES ('228', '印度', 'India', 'IND', 'IN.png');
INSERT INTO `zko_country` VALUES ('229', '印度尼西亚', 'Indonesia', 'IDN', 'ID.png');
INSERT INTO `zko_country` VALUES ('230', '英国', 'Britain', 'GBR', 'GB.png');
INSERT INTO `zko_country` VALUES ('231', '英属印度洋领地', 'British India Ocean Territory', 'IOT', 'IO.png');
INSERT INTO `zko_country` VALUES ('232', '约旦', 'Jordan', 'JOR', 'JO.png');
INSERT INTO `zko_country` VALUES ('233', '越南', 'Vietnam', 'VNM', 'VN.png');
INSERT INTO `zko_country` VALUES ('234', '赞比亚', 'Zambia', 'ZMB', 'ZM.png');
INSERT INTO `zko_country` VALUES ('235', '泽西岛', 'Jersey', 'JEY', 'JE.png');
INSERT INTO `zko_country` VALUES ('236', '乍得', 'Chad', 'TCD', 'TD.png');
INSERT INTO `zko_country` VALUES ('237', '直布罗陀', 'Gibraltar', 'GIB', 'GI.png');
INSERT INTO `zko_country` VALUES ('238', '智利', 'Chile', 'CHL', 'CL.png');
INSERT INTO `zko_country` VALUES ('239', '中国', 'China', 'PRC', 'CN.png');
INSERT INTO `zko_country` VALUES ('240', '中非共和国', 'Central African Republic', 'CAF', 'CF.png');
