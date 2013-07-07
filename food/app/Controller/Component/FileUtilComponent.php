<?php
App::uses ( 'Component', 'Controller' );
class FileUtilComponent extends Component {
	/**
	 * 原始文件名
	 */
	public $name = "";
	/**
	 * 新文件名
	 */
	public $fileName = "";
	/**
	 * 新文件地址
	 */
	private $filePath = "";
	private $largePath="";
	public $smallPath="";
	/**
	 * 新文件绝对地址(服务器)
	 */
	private $fileFullPath = "";
	/**
	 * 上传的文件类型
	 */
	public $type = "";
	/**
	 * 允许上传的文件类型
	 */
	public $allowType = array (
			'application/octet-stream',
			'image/pjpeg',
			'image/jpeg',
			'image/jpg',
			'image/gif',
			'image/png',
			'image/x-png' 
	);
	/**
	 * 文件后缀
	 */
	private $ext = "";
	
	private $suffix = "";
	/**
	 * 允许上传的文件后缀
	 */
	public $fileExts = array (
			'.apk',
			'.mpk',
			'.swf',
			'.jpg',
			'.gif',
			'.png',
			'.JPG',
			'.GIF',
			'.PNG' 
	);
	/**
	 * 上传文件夹
	 */
	public $uploadDir = "images";
	/**
	 * 相对文件夹
	 */
	private $uploadFloder = "";
	/**
	 * 服务器绝对文件夹地址
	 */
	private $uploadFullFloder = "";
	/**
	 * 临时文件地址
	 */
	private $tmpName = "";
	/**
	 * 上传是否错误
	 */
	public $error = "0";
	/**
	 * 上传文件大小
	 */
	public $size = "";
	/**
	 * 上传文件尺寸限制
	 */
	public $fileSize = "*";
	/**
	 * 上传文件最大 大小
	 */
	public $maxSize = 2000000;
	/**
	 * 上传结果
	 */
	public $result = array ();
	/**
	 * 构造函数，可以直接设置$settings，==上面的public参数
	 *
	 * @example $settings=array("name"=>"this is name")
	 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct ( $collection, $settings );
	}
	/**
	 * 上传入口
	 */
	public function upload($file = array()) {
		if (! empty ( $file )) {
			$this->name = $file ["name"];
			$this->type = $file ["type"];
			$this->tmpName = $file ["tmp_name"];
			$this->size = $file ["size"];
			$this->__upload ();
			unset ( $file );
		}
		return $this->result;
	}
	/**
	 * 上传文件
	 */
	private function __upload() {
		$this->ext = $this->getfilesuffix ( $this->name );
		if (empty ( $this->ext ) || $this->ext === ".") {
			return;
		}
		$this->__beforeUpload ();
		$result = $this->uploadfile ();
		// 设置上传结果
		$this->result = array (
				"error" => $this->error,
				"filePath" => $this->filePath,
				"size" => $this->size,
				"suffix" => $this->suffix,
				"message" => $result 
		);
	
	}
	/**
	 * 上传之前，初始化上传文件夹和命名文件名字
	 */
	private function __beforeUpload() {
		$times = time ();
		list ( $floder1, $floder2 ) = explode ( "-", date ( "Ym-d", $times ) );
		$fileFloder= $floder1 . "/" . $floder2;
		$this->uploadFloder = $this->uploadDir . "/" . "original" ."/" .$fileFloder;
		$this->uploadFullFloder = WWW_ROOT . "/" . $this->uploadFloder;
		$this->fileName = $times . "_" . rand ( 1000, 9999 ) . "_" . rand ( 1000, 9999 ) . $this->ext;
		$this->filePath = $fileFloder . "/" . $this->fileName;
		$this->smallPath=$this->uploadDir . "/" . "small" ."/" . $fileFloder;
		$this->largePath=$this->uploadDir . "/" . "large" . "/" .$fileFloder ;
		$this->fileFullPath = $this->uploadFullFloder . "/" . $this->fileName;
	}
	/**
	 * 上传处理
	 *
	 * @return string 上传结果
	 */
	function uploadfile() {
		if (! is_dir ( $this->uploadFullFloder )) {
			if (! $this->mkdirs ( $this->uploadFullFloder )) {
				$this->error = 1;
				return (__ ( "File upload directory does not exist and can not create file upload directory" ));
			}
			if (! chmod ( $this->uploadFullFloder, 0755 )) {
				$this->error = 2;
				return (__ ( "File upload directory permissions can not be set as readable and writable" ));
			}
		}
		// 判断文件尺寸2013-05-10
		if ($this->fileSize != "*") {
			list ( $width, $height ) = getimagesize ( $this->tmpName );
			$fileSizeArr = explode ( ";", $this->fileSize );
			foreach ( $fileSizeArr as $k => $v ) {
				if ($width . "*" . $height != $v) {
					$this->error = 7;
					unlink ( $this->tmpName ); // 移除临时文件
					return sprintf ( __ ( "Image size must be %s, please re-upload" ), implode ( " or ", $fileSizeArr ) );
				}
			}
		}
		
		if ($this->size > $this->maxSize) {
			$this->error = 3;
			return (__ ( "Upload the file size exceeds the specified size" ));
		}
		if ($this->size == 0) {
			$this->error = 4;
			return (__ ( "Please select upload file" ));
		}
		// 没有验证上传文件的类型
		if (! in_array ( $this->ext, $this->fileExts )) {
			$this->error = 5;
			return (__ ( "Please upload the file types to meet the requirements of the" ));
		}
		if (! move_uploaded_file ( $this->tmpName, $this->fileFullPath )) {
			$this->error = 6;
			return (__ ( "Copying files failed, please re-upload" ));
		}
		$this->image_resize ( $this->fileFullPath, $this->smallPath,$this->fileName, 200, 200 );
		$this->image_resize ( $this->fileFullPath, $this->largePath,$this->fileName, 400, 400 );
		return __ ( "uploaded successfully" );
	}
	/**
	 * 获取文件后缀
	 */
	public function getfilesuffix($filestr) {
		$suffixarray = explode ( '.', $filestr ); // 用点号分隔文件名到数组
		$suffixarray = array_reverse ( $suffixarray ); // 把上面数组倒序
		$this->suffix = $suffixarray [0];
		return "." . $this->suffix; // 返回倒序数组的第一个值
	}
	/**
	 * 创建多级目录
	 */
	function mkdirs($dir, $mode = 0755) {
		if (is_dir ( $dir ) || @mkdir ( $dir, $mode ))
			return TRUE;
		
		if (! $this->mkdirs ( dirname ( $dir ), $mode ))
			return FALSE;
		
		return @mkdir ( $dir, $mode );
	}
	/**
	 * 移动文件
	 * $newpath["floder"].$newpath["filename"]
	 */
	public function move($oldpath, $newpath) {
		$oldpath = ROOT . DS . "../" . $oldpath;
		$newpath ["floder"] = ROOT . DS . "../" . $newpath ["floder"];
		if (! $this->mkdirs ( $newpath ["floder"], 777 )) {
			$this->log ( "创建文件夹失败==>" . $newpath ["floder"], "movefile" );
			$this->error = 1;
			return false;
		}
		// 复制文件
		if (rename ( $oldpath, $newpath ["floder"] . $newpath ["filename"] )) {
			// return unlink ( $oldpath );
			return true;
		}
		$this->log ( "复制文件失败==>" . $oldpath . "--->" . $newpath ["floder"] . $newpath ["filename"], "movefile" );
		return false;
	}
	/*
	 * 说明：函数功能是把一个图像裁剪为任意大小的图像，图像不变形 参数说明：输入 需要处理图片的
	 * 文件名，生成新图片的保存文件名，生成新图片的宽，生成新图片的高 written by smallchicken time 2008-12-18
	 * my_image_resize ( "img.jpg", "02.jpg", 45, 45 );
	 */
	function image_resize($src_file, $new_file_path,$file_name, $new_width, $new_height) {
		$dst_file=$new_file_path."/".$file_name;
		if ($new_width < 1 || $new_height < 1) {
			echo "params width or height error !";
			exit ();
		}
		if (! file_exists ( $src_file )) {
			echo $src_file . " is not exists !";
			exit ();
		}
		// 图像类型
		$image_size = getimagesize ( $src_file );
		
		$type = $image_size ["2"];
		// $type=getimagesize($src_file);
		$support_type = array (
				IMAGETYPE_JPEG,
				IMAGETYPE_PNG,
				IMAGETYPE_GIF 
		);
		if (! in_array ( $type, $support_type, true )) {
			echo "This type of image is not supported! Only supports JPG, gif or png";
			exit ();
		}
		// Load image
		switch ($type) {
			case IMAGETYPE_JPEG :
				$src_img = imagecreatefromjpeg ( $src_file );
				break;
			case IMAGETYPE_PNG :
				$src_img = imagecreatefrompng ( $src_file );
				break;
			case IMAGETYPE_GIF :
				$src_img = imagecreatefromgif ( $src_file );
				break;
			default :
				echo "Load image error!";
				exit ();
		}
		$w = imagesx ( $src_img );
		$h = imagesy ( $src_img );
		$ratio_w = 1.0 * $new_width / $w;
		$ratio_h = 1.0 * $new_height / $h;
		$ratio = 1.0;
		// 生成的图像的高宽比原来的都小，或都大 ，原则是 取大比例放大，取大比例缩小（缩小的比例就比较小了）
		if (($ratio_w < 1 && $ratio_h < 1) || ($ratio_w > 1 && $ratio_h > 1)) {
			if ($ratio_w < $ratio_h) {
				$ratio = $ratio_h; // 情况一，宽度的比例比高度方向的小，按照高度的比例标准来裁剪或放大
			} else {
				$ratio = $ratio_w;
			}
			// 定义一个中间的临时图像，该图像的宽高比 正好满足目标要求
			$inter_w = ( int ) ($new_width / $ratio);
			$inter_h = ( int ) ($new_height / $ratio);
			$inter_img = imagecreatetruecolor ( $inter_w, $inter_h );
			imagecopy ( $inter_img, $src_img, 0, 0, 0, 0, $inter_w, $inter_h );
			// 生成一个以最大边长度为大小的是目标图像$ratio比例的临时图像
			// 定义一个新的图像
			$new_img = imagecreatetruecolor ( $new_width, $new_height );
			imagecopyresampled ( $new_img, $inter_img, 0, 0, 0, 0, $new_width, $new_height, $inter_w, $inter_h );
			$floder=$new_file_path;
			if (! is_dir ( $floder )) {
				if (! $this->mkdirs ( $floder )) {
					return (__ ( "File upload directory does not exist and can not create file upload directory" ));
				}
				if (! chmod ( $floder, 0755 )) {
					return (__ ( "File upload directory permissions can not be set as readable and writable" ));
				}
			}
			switch ($type) {
				case IMAGETYPE_JPEG :
					imagejpeg ( $new_img, $dst_file, 100 ); // 存储图像
					break;
				case IMAGETYPE_PNG :
					imagepng ( $new_img, $dst_file, 100 );
					break;
				case IMAGETYPE_GIF :
					imagegif ( $new_img, $dst_file, 100 );
					break;
				default :
					break;
			}
		} 		// end if 1
		  // 2 目标图像 的一个边大于原图，一个边小于原图 ，先放大平普图像，然后裁剪
		  // =if( ($ratio_w < 1 && $ratio_h > 1) || ($ratio_w >1 && $ratio_h <1) )
		else {
			$ratio = $ratio_h > $ratio_w ? $ratio_h : $ratio_w; // 取比例大的那个值
			                                                    // 定义一个中间的大图像，该图像的高或宽和目标图像相等，然后对原图放大
			$inter_w = ( int ) ($w * $ratio);
			$inter_h = ( int ) ($h * $ratio);
			$inter_img = imagecreatetruecolor ( $inter_w, $inter_h );
			// 将原图缩放比例后裁剪
			imagecopyresampled ( $inter_img, $src_img, 0, 0, 0, 0, $inter_w, $inter_h, $w, $h );
			// 定义一个新的图像
			$new_img = imagecreatetruecolor ( $new_width, $new_height );
			imagecopy ( $new_img, $inter_img, 0, 0, 0, 0, $new_width, $new_height );
			switch ($type) {
				case IMAGETYPE_JPEG :
					imagejpeg ( $new_img, $dst_file, 100 ); // 存储图像
					break;
				case IMAGETYPE_PNG :
					imagepng ( $new_img, $dst_file, 100 );
					break;
				case IMAGETYPE_GIF :
					imagegif ( $new_img, $dst_file, 100 );
					break;
				default :
					break;
			}
		} // if3
	} // end function
}