<?php
/**
 * @brief                PhpExcel
 * @package              
 * @subpackage           
 * @author               $Author:   zhangjianying <zhangjianying@ganji.com>$
 * @file                 $HeadURL$
 * @version              $Rev$
 * @lastChangeBy         $LastChangedBy$
 * @lastmodified         $LastChangedDate$
 * @copyright            Copyright (c) 2015, www.ganji.com
 */
require_once dirname(__FILE__) . '/../../../vendor/phpexcel/Classes/PHPExcel.php';
class Gj_Lib_Phpexcel_PHPExcel extends  PHPExcel{

    public function __construct(){
        parent::__construct();
        // Set document properties
        $this->getProperties()->setCreator("Haozu")  //创建者
            ->setLastModifiedBy("Haozu")  //最后修改人
            ->setTitle("Office 2007 XLSX Document")   //标题
            ->setSubject("Office 2007 XLSX Document") //主题
            ->setDescription("Office 2007 XLSX Document, generated using PHP classes.") //描述
            ->setKeywords("office 2007 openxml php") //标记
            ->setCategory("Result file"); //类别
    }

    /**
     * @biref 直接输出生成的xlsx
     * @param $fileName 输出的文件名
     * @param $hasCharts 是否有图形
     */
    public function echoXlsx($fileName,$hasCharts=false){
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel2007');
        if($hasCharts){
            $objWriter->setIncludeCharts(TRUE);
        }
        $objWriter->save('php://output');
        exit();
    }
}
