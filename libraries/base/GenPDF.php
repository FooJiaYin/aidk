<?php

namespace libraries\base;

require_once('libraries/vendor/tcpdf/tcpdf.php');

// 自訂頁首與頁尾
class GenPDF extends \TCPDF
{
    //Page header
    public function Header()
    {
        // Set font
        $this->SetFont('DroidSansFallback', '', 10);

        // 公司與報表名稱
        $title = '
        <h4 style="font-size: 20pt; font-weight: normal; text-align: center;">AIDK AI智能輔助學群學系推薦系統</h4>

        <table>
            <tr>
                <td style="width: 30%;"></td>
                <td style="border-bottom: 2px solid black; font-size: 20pt; font-weight: normal; text-align: center; width: 40%;">課程證書</td>
                <td style="width: 30%;"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
        </table>';


        /**
         * 標題欄位
         *
         * 所有欄位的 width 設定值均與「資料欄位」互相對應，除第一個 <td> width 須向左偏移 5px，才能讓後續所有「標題欄位」與「資料欄位」切齊
         * 最後一個 <td> 必須設定 width: auto;，才能將剩餘寬度拉至最寬
         * style 屬性可使用 text-align: left|center|right; 來設定文字水平對齊方式
         */

        // 設定不同頁要顯示的內容 (數值為對應的頁數)
        switch ($this->getPage()) {
            default:
                $this->SetMargins(1, 35, 1);
                $html = $title;
        }

        // Title
        $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('DroidSansFallback', 'I', 8);
        // Page number
        $this->Cell(0, 10, '列印日期：' . date('Y/m/d'), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
