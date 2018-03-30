<?php
/**
 * @brief                图表创建类
 * @package              
 * @subpackage           
 * @author               $Author:   zhangjianying <zhangjianying@ganji.com>$
 * @file                 $HeadURL$
 * @version              $Rev$
 * @lastChangeBy         $LastChangedBy$
 * @lastmodified         $LastChangedDate$
 * @copyright            Copyright (c) 2015, www.ganji.com
 */
class Gj_Lib_Phpexcel_ChartFactory
{

    // {{{ 饼状图1
    /**
     * @brief 创建饼状图1
     * @param Object $objWorksheet sheet对象
     * @param array $data 
                 array(
                     array('','标题'),
                     array('类型1',34),
                     array('类型2',35),
                     array('类型3',36),
                     array('类型4',37),
                     array('类型5',38),
                     array('类型6',39),
                     array('类型7',40),
                     array('类型8',41),
                 )
     * @param array option 图表配置
     * @return array($topLeftPosition,$bottomRightPosition)
     */
    public static function createPie1($objWorksheet,$data,$option=array()){
        //至少有数据
        if(!isset($data[1][1])){
            return array();
        }
        //饼状图标题
        $chartTitle = empty($option['chartTitle']) ? 'Pie Chart 1' : $option['chartTitle'];
        //数据起始点
        $startCell  = empty($option['startCell']) ? 'A1' : $option['startCell'];
        $sheetTitle = $objWorksheet->getTitle();
        $objWorksheet->fromArray(
                $data,
                null,
                $startCell,
                true
                );
        //  Set the Labels for each data series we want to plot
        //    Datatype
        //    Cell reference for data
        //    Format Code
        //    Number of datapoints in series
        //    Data values
        //    Data Marker
        $labelCell = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('B1',$startCell,'A1'));
        $dataseriesLabels = array(
                new PHPExcel_Chart_DataSeriesValues(PHPExcel_Chart_DataSeriesValues::DATASERIES_TYPE_STRING, $sheetTitle.'!'.$labelCell, NULL, 1),
                );
        //  Set the X-Axis Labels
        //    Datatype
        //    Cell reference for data
        //    Format Code
        //    Number of datapoints in series
        //    Data values
        //    Data Marker
        $xAxisStart = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('A2',$startCell,'A1'));
        $xAxisEnd = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('A'.count($data),$startCell,'A1'));
        $xAxisTickValues = array(
                new PHPExcel_Chart_DataSeriesValues(PHPExcel_Chart_DataSeriesValues::DATASERIES_TYPE_STRING, $sheetTitle.'!'.$xAxisStart.':'.$xAxisEnd, NULL, count($data)-1),
                );
        //  Set the Data values for each data series we want to plot
        //    Datatype
        //    Cell reference for data
        //    Format Code
        //    Number of datapoints in series
        //    Data values
        //    Data Marker
        $dataStart = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('B2',$startCell,'A1'));
        $dataEnd = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('B'.count($data),$startCell,'A1'));
        $dataSeriesValues = array(
                new PHPExcel_Chart_DataSeriesValues(PHPExcel_Chart_DataSeriesValues::DATASERIES_TYPE_STRING, $sheetTitle.'!'.$dataStart.':'.$dataEnd, NULL, count($data)-1),
                );

        //  Build the dataseries
        $series = new PHPExcel_Chart_DataSeries(
                PHPExcel_Chart_DataSeries::TYPE_PIECHART,       // plotType
                PHPExcel_Chart_DataSeries::GROUPING_STANDARD,     // plotGrouping
                range(0, count($dataSeriesValues)-1),          // plotOrder
                $dataseriesLabels,                   // plotLabel
                $xAxisTickValues,                    // plotCategory
                $dataSeriesValues                    // plotValues
                );

        //  Set up a layout object for the Pie chart
        $layout = new PHPExcel_Chart_Layout();
        if(isset($option['setShowVal'])){
            $layout->setShowVal($option['setShowVal']);
        }
        if(isset($option['setShowPercent'])){
            $layout->setShowPercent($option['setShowPercent']);
        }
        if(isset($option['setShowLegendKey'])){
            $layout->setShowLegendKey($option['setShowLegendKey']);
        }
        if(isset($option['setShowCatName'])){
            $layout->setShowCatName($option['setShowCatName']);
        }

        //  Set the series in the plot area
        $plotarea = new PHPExcel_Chart_PlotArea($layout, array($series));
        //  Set the chart legend
        $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

        $title = new PHPExcel_Chart_Title($chartTitle);

        //  Create the chart
        $chart = new PHPExcel_Chart(
                'chart1',   // name
                $title,    // title
                $legend,   // legend
                $plotarea,   // plotArea
                true,     // plotVisibleOnly
                0,        // displayBlanksAs
                NULL,     // xAxisLabel
                NULL      // yAxisLabel   - Pie charts don't have a Y-Axis
                );

        //  Set the position where the chart should appear in the worksheet
        $topLeftPosition = self::getRelativeOffsetCell('D1',$startCell,'A1');
        $bottomRightPosition = self::getRelativeOffsetCell('K15',$startCell,'A1');
        $chart->setTopLeftPosition($topLeftPosition);
        $chart->setBottomRightPosition($bottomRightPosition);
        //  Add the chart to the worksheet
        $objWorksheet->addChart($chart);
        return array($topLeftPosition,$bottomRightPosition);
    }
    // }}}

    // {{{ 条形图1
    /**
     * @brief 创建条形图1
     * @param Object $objWorksheet sheet对象
     * @param array $data 
             array(
                 array('',   2010,   2011,   2012 , 2013 , 2014),
                 array('Q1',   12,   15,     21 , 25 , 37),
                 array('Q2',   56,   73,     86 , 28 , 59),
                 array('Q3',   52,   61,     69 , 31 , 50),
                 array('Q4',   32,   32,     0 , 33 , 54),
                 array('Q5',   36,   32,     29 , 35 , 43),
                 array('Q6',   50,   39,     49 , 33 , 38),
                 array('Q7',   66,   36,     42 , 37 , 41),
                 array('Q8',   40,   42,     19 , 38 , 44),
             );

     * @param array option 图表配置
     *
     * @return array array($topLeftPosition,$bottomRightPosition)  图形的左上角、右下角在excel中的位置
     */
    public static function createColumn1($objWorksheet,$data,$option=array()){
        //至少有数据
        if(!isset($data[1][1])){
            return array();
        }
        //图标题
        $chartTitle = empty($option['chartTitle']) ? 'Cloumn Chart 1' : $option['chartTitle'];
        //y轴标题
        $startCell  = empty($option['startCell']) ? 'A1' : $option['startCell'];
        //数据起始点
        $yAxisTitle = empty($option['yAxisTitle']) ? '' : $option['yAxisTitle'];

        $sheetTitle = $objWorksheet->getTitle();
        $objWorksheet->fromArray(
                $data,
                null,
                $startCell,
                true
                );
        //  Set the Labels for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $dataseriesLabels = array();
        $labelStartColumn = 'B';
        $labelStartRow = '1';
        for($i = 1; $i < count($data[0]) ; $i++){
            $cell = $labelStartColumn . $labelStartRow;
            $labelCell = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell($cell,$startCell,'A1'));
            $dataseriesLabels[] = new PHPExcel_Chart_DataSeriesValues('String', $sheetTitle.'!'.$labelCell, NULL, 1);
            ++$labelStartColumn;
        }
        //  Set the X-Axis Labels
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $xAxisStart = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('A2',$startCell,'A1'));
        $xAxisEnd = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('A'.count($data),$startCell,'A1'));
        $xAxisTickValues = array(
                new PHPExcel_Chart_DataSeriesValues('String', $sheetTitle.'!'.$xAxisStart.':'.$xAxisEnd, NULL, count($data[0])-1), 
                );
        //  Set the Data values for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $dataSeriesValues = array();
        $dataStartColumn = 'B';
        for($i = 1; $i < count($data[0]) ; $i++){
            $dataStart = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell($dataStartColumn . '2',$startCell,'A1'));
            $dataEnd = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell($dataStartColumn . count($data),$startCell,'A1'));
            $dataSeriesValues[] = new PHPExcel_Chart_DataSeriesValues('Number', $sheetTitle.'!'.$dataStart.':'.$dataEnd, NULL, count($data)-1);
            ++$dataStartColumn;
        }

        //  Build the dataseries
        $series = new PHPExcel_Chart_DataSeries(
                PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
                PHPExcel_Chart_DataSeries::GROUPING_STANDARD,   // plotGrouping
                range(0, count($dataSeriesValues)-1),           // plotOrder
                $dataseriesLabels,                              // plotLabel
                $xAxisTickValues,                               // plotCategory
                $dataSeriesValues                               // plotValues
                );
        //  Set additional dataseries parameters
        //      Make it a vertical column rather than a horizontal bar graph
        $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

        //  Set the series in the plot area
        $plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
        //  Set the chart legend
        $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

        $title = new PHPExcel_Chart_Title($chartTitle);
        $yAxisLabel = new PHPExcel_Chart_Title($yAxisTitle);


        //  Create the chart
        $chart = new PHPExcel_Chart(
                'chart1',       // name
                $title,         // title
                $legend,        // legend
                $plotarea,      // plotArea
                true,           // plotVisibleOnly
                0,              // displayBlanksAs
                NULL,           // xAxisLabel
                $yAxisLabel     // yAxisLabel
                );

        //  Set the position where the chart should appear in the worksheet
        $topLeftPosition = PHPExcel_Cell::stringFromColumnIndex(count($data[0]) + 1) . '1';
        $bottomRightPosition = self::getRelativeOffsetCell($topLeftPosition,'K16','A1');
        $chart->setTopLeftPosition(self::getRelativeOffsetCell($topLeftPosition,$startCell,'A1'));
        $chart->setBottomRightPosition(self::getRelativeOffsetCell($bottomRightPosition,$startCell,'A1'));

        //  Add the chart to the worksheet
        $objWorksheet->addChart($chart);
        return array($topLeftPosition,$bottomRightPosition);
    }
    // }}}

    // {{{ 折线图1
    /**
     * @brief 创建条形图1
     * @param Object $objWorksheet sheet对象
     * @param array $data 
             array(
                 array('',   2010,   2011,   2012 , 2013 , 2014),
                 array('Q1',   12,   15,     21 , 25 , 37),
                 array('Q2',   56,   73,     86 , 28 , 59),
                 array('Q3',   52,   61,     69 , 31 , 50),
                 array('Q4',   32,   32,     0 , 33 , 54),
                 array('Q5',   36,   32,     29 , 35 , 43),
                 array('Q6',   50,   39,     49 , 33 , 38),
                 array('Q7',   66,   36,     42 , 37 , 41),
                 array('Q8',   40,   42,     19 , 38 , 44),
             );

     * @param array option 图表配置
     *
     * @return array array($topLeftPosition,$bottomRightPosition)  图形的左上角、右下角在excel中的位置
     */
    public static function createLine1($objWorksheet,$data,$option=array()){
        //至少有数据
        if(!isset($data[1][1])){
            return array();
        }
        //图标题
        $chartTitle = empty($option['chartTitle']) ? 'Line Chart 1' : $option['chartTitle'];
        //y轴标题
        $startCell  = empty($option['startCell']) ? 'A1' : $option['startCell'];
        //数据起始点
        $yAxisTitle = empty($option['yAxisTitle']) ? '数量' : $option['yAxisTitle'];

        $sheetTitle = $objWorksheet->getTitle();
        $objWorksheet->fromArray(
                $data,
                null,
                $startCell,
                true
                );
        //  Set the Labels for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $dataseriesLabels = array();
        $labelStartColumn = 'B';
        $labelStartRow = '1';
        for($i = 1; $i < count($data[0]) ; $i++){
            $cell = $labelStartColumn . $labelStartRow;
            $labelCell = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell($cell,$startCell,'A1'));
            $dataseriesLabels[] = new PHPExcel_Chart_DataSeriesValues('String', $sheetTitle.'!'.$labelCell, NULL, 1 );
            ++$labelStartColumn;
        }
        //  Set the X-Axis Labels
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $xAxisStart = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('A2',$startCell,'A1'));
        $xAxisEnd = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell('A'.count($data),$startCell,'A1'));
        $xAxisTickValues = array(
                new PHPExcel_Chart_DataSeriesValues('String', $sheetTitle.'!'.$xAxisStart.':'.$xAxisEnd, NULL, count($data)-1), 
                );
        //  Set the Data values for each data series we want to plot
        //      Datatype
        //      Cell reference for data
        //      Format Code
        //      Number of datapoints in series
        //      Data values
        //      Data Marker
        $dataSeriesValues = array();
        $dataStartColumn = 'B';
        for($i = 1; $i < count($data[0]) ; $i++){
            $dataStart = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell($dataStartColumn . '2',$startCell,'A1'));
            $dataEnd = PHPExcel_Cell::absoluteReference(self::getRelativeOffsetCell($dataStartColumn . count($data),$startCell,'A1'));
            $dataSeriesValues[] = new PHPExcel_Chart_DataSeriesValues('Number', $sheetTitle.'!'.$dataStart.':'.$dataEnd, NULL, count($data)-1);
            ++$dataStartColumn;
        }

        //  Build the dataseries
        $series = new PHPExcel_Chart_DataSeries(
                PHPExcel_Chart_DataSeries::TYPE_LINECHART,      // plotType
                PHPExcel_Chart_DataSeries::GROUPING_STACKED,    // plotGrouping
                range(0, count($dataSeriesValues)-1),           // plotOrder
                $dataseriesLabels,                              // plotLabel
                $xAxisTickValues,                               // plotCategory
                $dataSeriesValues                               // plotValues
                );

        //  Set the series in the plot area
        $plotarea = new PHPExcel_Chart_PlotArea(NULL, array($series));
        //  Set the chart legend
        $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_TOPRIGHT, NULL, false);

        $title = new PHPExcel_Chart_Title($chartTitle);
        $yAxisLabel = new PHPExcel_Chart_Title($yAxisTitle);


        //  Create the chart
        $chart = new PHPExcel_Chart(
                'chart1',       // name
                $title,         // title
                $legend,        // legend
                $plotarea,      // plotArea
                true,           // plotVisibleOnly
                0,              // displayBlanksAs
                NULL,           // xAxisLabel
                $yAxisLabel     // yAxisLabel
                );

        //  Set the position where the chart should appear in the worksheet
        $topLeftPosition = PHPExcel_Cell::stringFromColumnIndex(count($data[0]) + 1) . '1';
        $bottomRightPosition = self::getRelativeOffsetCell($topLeftPosition,'K16','A1');
        $chart->setTopLeftPosition(self::getRelativeOffsetCell($topLeftPosition,$startCell,'A1'));
        $chart->setBottomRightPosition(self::getRelativeOffsetCell($bottomRightPosition,$startCell,'A1'));

        //  Add the chart to the worksheet
        $objWorksheet->addChart($chart);
        return array($topLeftPosition,$bottomRightPosition);
    }
    // }}}

    /**
     * @brief 计算相对偏移后的excel位置 仅支持往右下偏移 左上肯定出错!!
     * @param string $cell 需要计算偏移的位置 eg: A2
     * @param string $to 相对偏移的结果       eg: B3
     * @param string $from 相对偏移的起点     eg: A1
     * @return string                         eg: B4
     */
    public static function getRelativeOffsetCell($cell,$to,$from='A1'){
        // start coordinate
        list ($cellStartColumn, $cellStartRow) = PHPExcel_Cell::coordinateFromString($cell);
        list ($fromStartColumn, $fromStartRow) = PHPExcel_Cell::coordinateFromString($from);
        list ($toStartColumn, $toStartRow) = PHPExcel_Cell::coordinateFromString($to);
        for($i = $fromStartColumn ; $i < $toStartColumn ; $i++){
            ++$cellStartColumn;
        }
        for($j = $fromStartRow ; $j < $toStartRow ; $j++){
            ++$cellStartRow;
        }
        return $cellStartColumn.$cellStartRow;
    }
}
