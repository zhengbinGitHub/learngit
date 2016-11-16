<?php
//冒泡排序，插入排序，选择排序，快速排序
//http://www.php100.com/html/dujia/2015/0210/8604.html
class sortList {	
	/**
	 * 冒泡
	 * Enter description here ...
	 * 在要排序的一组数中，对当前还未排好的序列，从前往后对相邻的两个数依次进行比较和调整，让较大的数往下沉，较小的往上冒。
	 * 即，每当两相邻的数比较后发现它们的排序与排序要求相反时，就将它们互换。
	 * 2940.1679039001ms
	 */
	public static function bubbleSort($datas){
		$dataLength = count($datas);
		if($dataLength == 1) return $datas;
		//该层循环控制 需要冒泡的轮数
		for($i=0; $i<$dataLength; $i++){
			for($j=0; $j<$dataLength-1; $j++){//冒出一个数 需要比较的次数
				if($datas[$j] > $datas[$j+1]){
					$tmp = $datas[$j+1];
					$datas[$j+1] = $datas[$j];
					$datas[$j] = $tmp;
					unset($tmp);
				}
			}
		}
		return $datas;
	}
	
	/**
	 * 快速排序 效率比冒泡高
	 * Enter description here ...
	 * @param unknown_type $datas
	 * 选择一个基准元素，通常选择第一个元素或者最后一个元素。
	 * 通过一趟扫描，将待排序列分成两部分，一部分比基准元素小，一部分大于等于基准元素。
	 * 此时基准元素在其排好序后的正确位置，然后再用同样的方法递归地排序划分的两部分。
	 * 123.00705909729ms
	 */
	public static function quickSort($datas){
		$dataLength = count($datas);
		if($dataLength == 1) return $datas;
		$firstData = $datas[0];
		$leftArray = array();
		$rightArray = array();
		for($i=0; $i<$dataLength; $i++){
			if($datas[$i] < $firstData){
				$leftArray[] = $datas[$i];
			}
			else if($datas[$i] > $firstData){
				$rightArray[] = $datas[$i];
			}
		}
		if(count($leftArray) > 0){
			$leftArray = sortList::quickSort($leftArray);
		}
		if(count($rightArray) > 0){
			$rightArray = sortList::quickSort($rightArray);
		}
		return array_merge($leftArray, array($firstData), $rightArray);
	}
	
	/**
	 * 选择排序
	 * Enter description here ...
	 * @param unknown_type $datas
	 * 选择排序法思路： 每次选择一个相应的元素，然后将其放到指定的位置
	 * 实现思路 双重循环完成，外层控制轮数，当前的最小值。内层 控制的比较次数
	 * 988.05594444275ms
	 */
	public static function selectSort($datas){
		$dataLength = count($datas);
		if($dataLength == 1) return $datas;
		for($i=0; $i<$dataLength; $i++){
			$p = $i;//当前最小值的位置， 需要参与比较的元素
			for($j=$i+1; $j < $dataLength; $j++){
				if($datas[$p] > $datas[$j]){ //$datas[$p] 是 当前已知的最小值
					$p = $j;//发现更小的,记录下最小值的位置；并且在下次比较时， 应该采用已知的最小值进行比较。
				}
			}
			if($p != $i){
				$tmp = $datas[$p];
				$datas[$p] = $datas[$i];
				$datas[$i] = $tmp;
			}
		}
		return $datas;
	}
	
	/**
	 * 插入排序法 
	 * Enter description here ...
	 * @param unknown_type $datas
	 * 插入排序法思路：将要排序的元素插入到已经 假定排序号的数组的指定位置。
	 * 区分 哪部分是已经排序好的
	 * 哪部分是没有排序的
	 * 找到其中一个需要排序的元素
	 * 这个元素 就是从第二个元素开始，到最后一个元素都是这个需要排序的元素
	 * 利用循环就可以标志出来
	 * i循环控制 每次需要插入的元素，一旦需要插入的元素控制好了,
	 * 间接已经将数组分成了2部分，下标小于当前的（左边的），是排序好的序列
	 * 845.04890441895ms
	 */
	public static function insertSort($datas){
		$dataLength = count($datas);
		if($dataLength == 1) return $datas;
		for($i=1; $i<$dataLength; $i++){
			$tmp = $datas[$i];//获得当前需要比较的元素值。
			//内层循环控制 比较 并 插入
			for($j=$i-1; $j>=0; $j--){
				//$datas[$i];需要插入的元素; $datas[$j];需要比较的元素
				if($tmp < $datas[$j]){//发现插入的元素要小，交换位置，将后边的元素与前面的元素互换
					$datas[$j+1] = $datas[$j];
					$datas[$j] = $tmp;
				}
				else{					
           			//如果碰到不需要移动的元素由于是已经排序好是数组，则前面的就不需要再次比较了。
					break;
				}
			}
		}
		return $datas;
	}
}


$dataArray = array_rand(range(1, 3000), 1500);
shuffle($dataArray);

$t1 = microtime(true);
sortList::bubbleSort($dataArray);
$t2 = microtime(true);
echo (($t2-$t1)*1000).'ms<br/>';
echo "<br />";

$t1 = microtime(true);
sortList::quickSort($dataArray);
$t2 = microtime(true);
echo (($t2-$t1)*1000).'ms<br/>';
echo "<br />";

$t1 = microtime(true);
sortList::selectSort($dataArray);
$t2 = microtime(true);
echo (($t2-$t1)*1000).'ms<br/>';
echo "<br />";

$t1 = microtime(true);
sortList::insertSort($dataArray);
$t2 = microtime(true);
echo (($t2-$t1)*1000).'ms<br/>';
echo "<br />";
?>