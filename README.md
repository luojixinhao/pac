关于
-----

用于遍历字符串组合，传统方式慢，内存占用高，使用该库能快速定位和遍历各种组合。
可用于生成域名等

需求
----
PHP 5.3 +

安装
----
composer require luojixinhao/pac:*

联系
--------
Email: lx_2010@qq.com<br>


## 示例

```php

/*纯数字的组合*/
$pac = new \luojixinhao\pac\pac('0123456789');

//获取长度1的组合总数（其实就是0,1,2,3,4,5,6,7,8,9这10个数的总数）
echo $pac->getCount(1);
//==返回10

//获取长度2的组合总数（其实就是00,01,02,....98,99这100个数的总数）
echo $pac->getCount(2, false);
//==返回100
echo $pac->getCount(2);
//==返回110 (包含了长度1的总数)

//获取长度3的组合总数（其实就是000,001,002,....998,999这1000个数的总数）
echo $pac->getCount(3, false);
//==返回1000
echo $pac->getCount(3);
//==返回1110 (包含了长度1和长度2的总数)

//获取组合长度为1，排在第5位置的数字
echo $pac->get(5, 1);
//==返回5

//获取组合长度为2，排在第5位置的数字
echo $pac->get(5, 2);
//==返回5
echo $pac->get(5, 2, false);
//==返回05

//获取组合长度为2，各种返回值
for ($i = 0; $i < 110; $i++) {
	echo '<br>';
	echo $pac->get($i, 2, true, true);
	echo ' | ';
	echo $pac->get($i, 2, false, true);
	echo ' | ';
	echo $pac->get($i, 2, true, false);
	echo ' | ';
	echo $pac->get($i, 2, false, false);
}
//==返回
//0 | 00 | 0 | 10
//1 | 01 | 1 | 11
//2 | 02 | 2 | 12
//3 | 03 | 3 | 13
//4 | 04 | 4 | 14
//5 | 05 | 5 | 15
//6 | 06 | 6 | 16
//7 | 07 | 7 | 17
//8 | 08 | 8 | 18
//9 | 09 | 9 | 19
//00 | 10 | 10 | 20
//01 | 11 | 11 | 21
//    ......
//78 | 88 | 88 | 98
//79 | 89 | 89 | 99
//80 | 90 | 90 | {end}
//81 | 91 | 91 | {end}
//82 | 92 | 92 | {end}
//83 | 93 | 93 | {end}
//84 | 94 | 94 | {end}
//85 | 95 | 95 | {end}
//86 | 96 | 96 | {end}
//87 | 97 | 97 | {end}
//88 | 98 | 98 | {end}
//89 | 99 | 99 | {end}
//90 | {end} | {end} | {end}
//91 | {end} | {end} | {end}
//92 | {end} | {end} | {end}
//93 | {end} | {end} | {end}
//94 | {end} | {end} | {end}
//95 | {end} | {end} | {end}
//96 | {end} | {end} | {end}
//97 | {end} | {end} | {end}
//98 | {end} | {end} | {end}
//99 | {end} | {end} | {end}

/*纯字母的组合*/
$pac = new pac('abcdefghijklmnopqrstuvwxyz');

//获取组合总数
echo $pac->getCount(1);
//==返回26
echo $pac->getCount(2);
//==返回702
echo $pac->getCount(3);
//==返回18278
echo $pac->getCount(4);
//==返回475254

//获取组合长度为2，各种返回值
for ($i = 0; $i < 702; $i++) {
	echo '<br>';
	echo $pac->get($i, 2, true, true);
	echo ' | ';
	echo $pac->get($i, 2, false, true);
	echo ' | ';
	echo $pac->get($i, 2, true, false);
	echo ' | ';
	echo $pac->get($i, 2, false, false);
}
//==返回
//a | aa | a | ba
//b | ab | b | bb
//c | ac | c | bc
//d | ad | d | bd
//e | ae | e | be
//f | af | f | bf
//    ......
//xx | yx | yx | zx
//xy | yy | yy | zy
//xz | yz | yz | zz
//ya | za | za | {end}
//yb | zb | zb | {end}
//    ......
//yx | zx | zx | {end}
//yy | zy | zy | {end}
//yz | zz | zz | {end}
//za | {end} | {end} | {end}
//zb | {end} | {end} | {end}
//zc | {end} | {end} | {end}
//    ......
//zy | {end} | {end} | {end}
//zz | {end} | {end} | {end}

/*自定义的组合*/
$pac = new pac(['sun', 'moon', 'star', 'earth']);

//获取组合总数
echo $pac->getCount(1);
//==返回4
echo $pac->getCount(2);
//==返回20
echo $pac->getCount(3);
//==返回84
echo $pac->getCount(4);
//==返回340

//获取组合长度为3，各种返回值
for ($i = 0; $i < 84; $i++) {
	echo '<br>';
	echo $pac->get($i, 3, true, true);
	echo ' | ';
	echo $pac->get($i, 3, false, true);
	echo ' | ';
	echo $pac->get($i, 3, true, false);
	echo ' | ';
	echo $pac->get($i, 3, false, false);
}
//==返回
//sun | sunsunsun | sun | moonmoonsun
//moon | sunsunmoon | moon | moonmoonmoon
//star | sunsunstar | star | moonmoonstar
//earth | sunsunearth | earth | moonmoonearth
//sunsun | sunmoonsun | moonsun | moonstarsun
//sunmoon | sunmoonmoon | moonmoon | moonstarmoon
//    ......
//moonmoonearth | starstarearth | starstarearth | earthearthearth
//moonstarsun | starearthsun | starearthsun | {end}
//    ......
//starstarearth | earthearthearth | earthearthearth | {end}
//starearthsun | {end} | {end} | {end}
//    ......
//earthearthearth | {end} | {end} | {end}
```