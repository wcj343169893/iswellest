<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->library('excel');
        define('EXCELFILE_PATH','ExcelFile/');	//定义Excel路径
        header("Content-type: text/html; charset=utf-8");
	}
     function index()
     {
        $this->load->view('upload_form');  
     }
    /**
     * 
     * 上传Excel
     * 
     */
     function do_upload()
     {  
        
        $filename = $_FILES['userfile']['name'];  //上传文件的名称
        $this->issetFile(EXCELFILE_PATH,$filename);
       
        $config['upload_path'] = EXCELFILE_PATH;
        $config['allowed_types'] = 'gif|jpg|png|xlsx';
        $config['max_size'] = 0;
        $type = $_FILES['userfile']['type'];
        $this->load->library('upload', $config);   
        if ($this->upload->do_upload('userfile'))
        {   
            echo '上传成功'.'<br>';
            $this->read();     
        } 
        else
        {
             echo '上传失败';
        }
        
     } 
	/**
     * 
     *读取excel 
     *导入或修改到DB中
     */
	function read()
	{  
       $rows = array('uid','uname','usex','utel');
       $KeyWord =  'utel';    //修改标识
	   $fileName   = EXCELFILE_PATH.'MyExcel.xlsx';
       $Exsel_data  = $this->excel->read($fileName,$rows);        //返回excel中的数据 
       $this->FilterExsel($Exsel_data,$KeyWord);  
       $DB_data    =    $this->mexcel->selUsers();                //查询DB中的全部数据
                                                        
       if(!empty($DB_data))
       {
            $DataKeyArray   =  $this->getKeyValue($DB_data,$KeyWord);//筛选所有的标识并组装成数组
            $dataChange     =  $this->dataChange($DB_data,$KeyWord);   
       }

    
       foreach($Exsel_data as $Ekey =>$Evalue)
       {    
            if(!$this->arrayEmpty($Evalue))
            {
                //判断excel中的数据在DB中时候存在 有则判断是否修改 反之增加
                if(!empty($DB_data) && $this->isExist($Evalue,$KeyWord,$DataKeyArray))
                {   
                    //判断是否相同 相同则跳过，不相同则修改
                    if(!$this->isChange($Evalue,$dataChange,$KeyWord))
                    {   
                        if($this->updExcel($Evalue))
                        echo '修改标识位：'.$Evalue[$KeyWord].' 成功'.'<br>';
                    }
                }
                else
                {   
                    if($this->addExcel($Evalue))
                    echo '添加标识位：'.$Evalue[$KeyWord].' 成功'.'<br>';    
                }
                
                
            }
       }
       echo '数据导入成功';
  
    }
    
    /**
     * 
     *写入excel 
     * 
     */
     function write()
     {
          $title = array('title','body');
          $data = array(
					  array('title' => 'Title 1', 'body' => 'Body 1'),
					  array('title' => 'Title 2', 'body' => 'Body 2'),
					  array('title' => 'Title 3', 'body' => 'Body 3'),
					  array('title' => 'Title 4', 'body' => 'Body 4'),
					  array('title' => 'Title 5', 'body' => 'Body 5')
		  );
		  $filename = '马征的评分统计表';
          $this->excel->writer($title,$data,$filename);    //读取excel  
     }
     
    ////////////////////////////////////////////工具方法//////////////////////////////////////////////////////////////////////////////// 
     /**
      * 增加方法
      * 
      */
     function addExcel($value='')
     {  
        return $this->mexcel->add_Excel($value);   
     }
     /**
      * 更新方法
      * 
      */
     function updExcel($value='')
     {  
        return $this->mexcel->upd_Excel($value);  
     }
    /**
    *筛选所有的标识并组装成数组    
    *@param   DB数据
    *@param   筛选标识
    *@return  array
    */
    function getKeyValue($DB_data='',$KeyWord='')
    {   
        
        foreach ($DB_data as $key =>$value)
        {
            $keyArray[$value[$KeyWord]] = $value[$KeyWord];
        }
        return $keyArray;
    } 
    /**
    *判断数据是否存在 
    *@param  Excel 数据
    *@param  DB    数据
    *@return 存在 true
    *@return 不存在 false 
    */ 
    function isExist($Evalue='',$KeyWord='',$DataKeyArray='')
    {   
        $isBool = array_search($Evalue[$KeyWord],$DataKeyArray);
        
        if($isBool)
        {   
            return true;    
        }
        else
        {     
            return false;
        }    
    }  
    /**
    *判断数据是否相同 
    *@param  Excel 数据
    *@param  DB    数据
    *@return 相同 true
    *@return 不同 false  
    */
    function isChange($Evalue='',$DB_data='',$KeyWord='')
    {   
       $diff = array_diff_assoc($Evalue,$DB_data[$Evalue[$KeyWord]]);
       
       if(empty($diff))
       {
            return true;
       }
       else
       {    
            return false;
       }       
    }
    
    /**
    *数组格式化
    */
    function dataChange($DB_data='',$KeyWord='')
    {
        foreach($DB_data as $key =>$value)
        {
           $data[$value[$KeyWord]] = $value;
        } 
        return  $data;  
    }
    
    /**
     *判断数组是否为空 
     *@param Excel数据
     *@return 为空   true
     *@return 不为空 false 
     */ 
    function arrayEmpty($arr='')
    {   
        foreach($arr as $key =>$value)
        {
            if(empty($value))
            {
                return true;
            }    
        }
        return false;
   
    }
   /**
    * 过滤Excel数据 是否有重复
    * 
    */
    function FilterExsel($Exsel_data='',$KeyWord='')
    {   
        if(!$this->arrayEmpty($Exsel_data))
        {   
            foreach ($Exsel_data as $key=>$value )
            {
               $arr[] = $value[$KeyWord];    
            }
            if(count($arr) <> count(array_unique($arr)))
            {
                echo '标识位重复';
                die;
            }
        }
    }  
    /**
     *判断文件夹中是否有相同的文件.
     * 有则覆盖 
     * 
     */
    function issetFile($dir='',$filename='')
    {   
        $handle = opendir($dir."."); 
        $array_file = array();
        while (false !== ($file = readdir($handle))) 
        { 
            if ($file != "." && $file != "..")
            { 
            $array_file[] = $file; //输出文件名 
            } 
        } 
        closedir($handle);
        
        foreach($array_file as $key =>$value)
        {
            if($value == $filename)
            {
                if(!unlink($dir.$filename))
                {
                    echo "删除$filename失败";
                    die;  
                }    
            }
        }
        return ; 
    }  
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */