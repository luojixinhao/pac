<?php

namespace luojixinhao\pac;

/**
 * @author Jason
 * @date 2017-09-14
 * @version 1.0
 */
class pac {

	protected $_base = 'abcdefghijklmnopqrstuvwxyz0123456789';

	public function __construct($base = null) {
		$this->setBase($base);
	}

	/**
	 * 设置源字符
	 * @param type $base
	 */
	public function setBase($base = null) {
		if (is_scalar($base) || is_array($base)) {
			$this->_base = $base;
		}
	}

	/**
	 * 获取源字符
	 */
	private function getBase() {
		return is_array($this->_base) ? $this->_base : preg_split('##u', $this->_base, -1, PREG_SPLIT_NO_EMPTY);
	}

	/**
	 * 获取指定长度的组合总数
	 * @param type $length 长度
	 * @param type $repeat 是否重复（false当前长度的总组合|true包含当前及以前长度之和）
	 */
	public function getCount($length = 1, $repeat = true) {
		static $bases;
		$length = intval($length);
		$length < 1 and $length = 1;
		$md5 = md5(json_encode($this->_base));
		if (!isset($bases[$md5][$length])) {
			$list = $this->getBase();
			$count = is_array($list) ? count($list) : strlen($list);
			$bases[$md5][$length] = pow($count, $length);
		}
		$count = $bases[$md5][$length];
		if ($repeat && $length > 1) {
			$count += $this->getCount( --$length, $repeat);
		}
		return $count;
	}

	/**
	 * 获取排列组合指定位置的值
	 * @param type $index 该组合的位置
	 * @param type $maxlength 最大长度
	 * @param type $repeat 是否重复
	 * @param type $normal 普通计数方式
	 */
	public function get($index, $maxlength = 1, $repeat = true, $normal = true) {
		$pac = '';

		$count = $this->getCount(1);
		if (!$repeat && $maxlength > 1) {
			$rep = $this->getCount($maxlength - 1);
			$index += $rep;
		}
		$indexs = $this->genIndexs($count, $index, $normal);
		$length = count($indexs);
		if ($length > $maxlength) {
			return '{end}';
		}
		$list = $this->getBase();
		$indexs = array_reverse($indexs);
		foreach ($indexs as $i) {
			$pac .= $list[$i];
		}
		return $pac;
	}

	/**
	 * 生成索引列表(需要反序)
	 * @param type $count
	 * @param type $index
	 * @param type $normal
	 */
	protected function genIndexs($count, $index, $normal = true, $indexs = []) {
		$count = intval($count);
		$index = intval($index);
		$zs = floor($index / $count);
		$ys = $index % $count;
		$indexs[] = $ys;
		if ($normal) {
			if ($zs > 0) {
				$indexs = $this->genIndexs($count, --$zs, $normal, $indexs);
			}
		} else {
			if ($zs >= $count) {
				$indexs = $this->genIndexs($count, $zs, $normal, $indexs);
			} elseif ($zs > 0) {
				$indexs[] = $zs;
			}
		}
		return $indexs;
	}

}