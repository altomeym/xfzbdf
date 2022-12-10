<?php

namespace App\Services;

use FPDF;

// define('FPDF_FONTPATH','fonts/NotoMono');

class PdfInvoice extends FPDF
{
    const ICONV_CHARSET_INPUT = 'UTF-8';
    const ICONV_CHARSET_OUTPUT_A = 'ISO-8859-1//TRANSLIT//IGNORE';
    const ICONV_CHARSET_OUTPUT_B = 'windows-1252//TRANSLIT//IGNORE';

    public $angle = 0;
    public $font = 'helvetica';        /* Font Name : See inc/fpdf/font for all supported fonts */
    public $columnOpacity = 0.06;            /* Items table background color opacity. Range (0.00 - 1) */
    public $columnSpacing = 0.3;                /* Spacing between Item Tables */
    public $referenceformat = ['.', ',', 'left', false];    /* Currency formater */
    public $margins = [
        'l' => 15,
        't' => 15,
        'r' => 15,
    ]; /* l: Left Side , t: Top Side , r: Right Side */
    public $fontSizeProductDescription = 10;                /* font size of product description */

    public $document;
    public $type;
    public $reference;
    public $logo;
    public $signature;
    public $signatureX;
    public $signatureY;
    public $color;
    public $badgeColor;
    public $date;
    public $time;
    public $due;
    public $from;
    public $to;
    public $items;
    public $totals;
    public $badge;
    public $paymentStatusName; // added by hassan00942
    public $customerId; // added by hassan00942
    public $qrImageUrl; // added by hassan00942
    public $addText;
    public $footernote;
    public $dimensions;
    public $display_tofrom = true;
    protected $displayToFromHeaders = true;
    protected $columns;

    public function __construct($size = 'A4', $currency = '$')
    {
        $this->items = [];
        $this->totals = [];
        $this->addText = [];
        $this->firstColumnWidth = 70;
        $this->currency = $currency;
        $this->maxImageDimensions = [230, 130];
        $this->setDocumentSize($size);
        $this->setColor('#222222');

        $this->recalculateColumns();

        parent::__construct('P', 'mm', [$this->document['w'], $this->document['h']]);

        $this->AliasNbPages();
        //$this->AddPage();
        $this->SetMargins($this->margins['l'], $this->margins['t'], $this->margins['r']);
    }

    public function setDocumentSize($dsize)
    {
        switch ($dsize) {
            case 'A4':
                $document['w'] = 210;
                $document['h'] = 297;
                break;
            case 'letter':
                $document['w'] = 215.9;
                $document['h'] = 279.4;
                break;
            case 'legal':
                $document['w'] = 215.9;
                $document['h'] = 355.6;
                break;
            default:
                $document['w'] = 210;
                $document['h'] = 297;
                break;
        }

        $this->document = $document;
    }

    private function resizeToFit($image)
    {
        list($width, $height) = getimagesize($image);
        $newWidth = $this->maxImageDimensions[0] / $width;
        $newHeight = $this->maxImageDimensions[1] / $height;
        $scale = min($newWidth, $newHeight);

        return [
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height)),
        ];
    }

    private function pixelsToMM($val)
    {
        $mm_inch = 25.4;
        $dpi = 96;

        return ($val * $mm_inch) / $dpi;
    }

    private function hex2rgb($hex)
    {
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = [$r, $g, $b];

        return $rgb;
    }

    private function br2nl($string)
    {
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    }

    public function isValidTimezoneId($zone)
    {
        try {
            new DateTimeZone($zone);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function setTimeZone($zone = '')
    {
        if (!empty($zone) and $this->isValidTimezoneId($zone) === true) {
            date_default_timezone_set($zone);
        }
    }

    public function setType($title)
    {
        $this->title = $title;
    }

    public function setColor($rgbcolor)
    {
        $this->color = $this->hex2rgb($rgbcolor);
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function setDue($date)
    {
        $this->due = $date;
    }

    public function setLogo($logo = 0, $maxWidth = 0, $maxHeight = 0)
    {
        if ($maxWidth and $maxHeight) {
            $this->maxImageDimensions = [$maxWidth, $maxHeight];
        }
        $this->logo = $logo;
        $this->dimensions = $this->resizeToFit($logo);
    }

    public function setSignature($signature = 0, $maxWidth = 0, $maxHeight = 0, $positionX = 0, $positionY = 0)
    {
        if ($maxWidth and $maxHeight) {
            $this->maxImageDimensions = [$maxWidth, $maxHeight];
        }
        $this->signature = $signature;
        $this->signatureX = $positionX;
        $this->signatureY = $positionY;
        $this->dimensions = $this->resizeToFit($signature);
    }

    public function hide_tofrom()
    {
        $this->display_tofrom = false;
    }

    public function hideToFromHeaders()
    {
        $this->displayToFromHeaders = false;
    }

    public function setFrom($data)
    {
        $this->from = $data;
    }

    public function setTo($data)
    {
        $this->to = $data;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function setNumberFormat($decimals = '.', $thousands_sep = ',', $alignment = 'left', $space = true)
    {
        $this->referenceformat = [$decimals, $thousands_sep, $alignment, $space];
    }

    public function setFontSizeProductDescription($data)
    {
        $this->fontSizeProductDescription = $data;
    }

    public function flipflop()
    {
        $this->flipflop = true;
    }

    public function price($price)
    {
        $amount = get_formated_decimal($price, false, 2);
        // commented by hassan00942
        /* $currency = get_currency_code();
        $space = config('system_settings.show_space_after_symbol') ? ' ' : '';
        
        commented by hassan00942
        if (config('system_settings.currency.symbol_first')) {
            return $currency . $space . $amount;
        } */

        // 2 lines added by hassan00942
        $currency = config('system_settings.currency.symbol');
        $space = ' ';

        return $amount . $space . $currency;
    }

    // public function addItem($item, $description = "", $quantity, $vat, $price, $discount = 0, $total)
    // {
    //     $p['item']        = $item;
    //     $p['description'] = $this->br2nl($description);

    //     if ($vat !== false) {
    //         $p['vat'] = $vat;
    //         if (is_numeric($vat)) {
    //             $p['vat'] = $this->price($vat);
    //         }
    //         $this->vatField = true;
    //         $this->recalculateColumns();
    //     }
    //     $p['quantity'] = $quantity;
    //     $p['price']    = $price;
    //     $p['total']    = $total;

    //     if ($discount !== false) {
    //         $this->firstColumnWidth = 58;
    //         $p['discount']          = $discount;
    //         if (is_numeric($discount)) {
    //             $p['discount'] = $this->price($discount);
    //         }
    //         $this->discountField = true;
    //         $this->recalculateColumns();
    //     }
    //     $this->items[] = $p;
    // }

    public function addItem($item, $description, $quantity, $price)
    {
        $p['item'] = $item;
        $p['description'] = $this->br2nl($description);
        $p['price'] = $price;
        $p['quantity'] = $quantity;
        $p['total'] = $quantity * $price;

        $this->items[] = $p;
    }

    public function addSummary($name, $value = 0, $colored = false)
    {
        $t['name'] = $name;
        $t['value'] = $value;
        if (is_numeric($value)) {
            $t['value'] = $this->price($value);
        }
        $t['colored'] = $colored;
        $this->totals[] = $t;
    }

    public function addTitle($title)
    {
        $this->addText[] = ['title', $title];
    }

    public function addParagraph($paragraph)
    {
        $paragraph = $this->br2nl($paragraph);
        $this->addText[] = ['paragraph', $paragraph];
    }

    // added by hassan00942
    public function addPaymentStatusName($paymentStatusName)
    {
        $this->paymentStatusName = $paymentStatusName;
    }

    // added by hassan00942
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    // added by hassan00942
    public function setQrImageUrl($qrImageUrl)
    {
        $this->qrImageUrl = $qrImageUrl;
    }

    public function addBadge($badge, $color = false)
    {
        $this->badge = $badge;

        if ($color) {
            $this->badgeColor = $this->hex2rgb($color);
        } else {
            $this->badgeColor = $this->color;
        }
    }

    public function setFooternote($note)
    {
        $this->footernote = $note;
    }

    public function render($name = '', $destination = '')
    {
        $this->AddPage();
        $this->Body();
        $this->AliasNbPages();

        return $this->Output($destination, $name);
    }

    public function Header()
    {
        if (isset($this->logo) and !empty($this->logo)) {
            $this->Image(
                $this->logo,
                $this->margins['l'],
                $this->margins['t'],
                $this->dimensions[0],
                $this->dimensions[1]
            );
        }

        //Title
        /*
        commented by hassan0942
        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->font, 'B', 20);
        if (isset($this->title) and !empty($this->title)) {
            $this->Cell(0, 5, $this->str_iconv($this->title, true), 0, 1, 'R');
        }
        $this->SetFont($this->font, '', 9);
        $this->Ln(5);
        */

        $lineheight = 4;
        
        // left side added by hassan00942
        $this->Ln(20);
        $positionX = $this->document['w'] - $this->margins['l'] - $this->margins['r'];
        $this->SetFont($this->font, '', 8);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, $lineheight, $this->str_iconv(trans(get_platform_title().' Radelandstraße 38, 13589 Berlin Germany'), false), 0, 1, 'L');

        $this->Ln(5);
        $this->SetFont($this->font, 'B', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, $lineheight, $this->str_iconv(trans('To,'), false), 0, 1, 'L');

        for ($i = 0, $iMax = max($this->from === null ? 0 : count($this->from), $this->to === null ? 0 : count($this->to)); $i < $iMax; $i++) {
            // check if the TO or FROM array value is not empty.
            $to = isset($this->to[$i]) ? $this->to[$i] : '';
            $this->SetFont($this->font, '', 10);
            $this->Cell(0, $lineheight, $this->str_iconv($to), 0, 0, 'L');
            $this->Ln(5);
        }
        
        // $this->SetFont($this->font, '', 10);
        // $this->SetTextColor(50, 50, 50);
        // $this->Cell(0, $lineheight, $this->str_iconv(trans('Julia Voge'), false), 0, 1, 'L');

        // $this->SetFont($this->font, '', 10);
        // $this->SetTextColor(50, 50, 50);
        // $this->Cell(0, $lineheight, $this->str_iconv(trans('Katzwagner Steig 36a'), false), 0, 1, 'L');

        // $this->SetFont($this->font, '', 10);
        // $this->SetTextColor(50, 50, 50);
        // $this->Cell(0, $lineheight, $this->str_iconv(trans('14089 Berlin'), false), 0, 1, 'L');

        // $this->SetFont($this->font, '', 10);
        // $this->SetTextColor(50, 50, 50);
        // $this->Cell(0, $lineheight, $this->str_iconv(trans('Germany'), false), 0, 1, 'L');

        //Calculate position of strings
        $this->SetFont($this->font, 'B', 9);
        $positionX = $this->document['w'] - $this->margins['l'] - $this->margins['r'] - max(
            mb_strtoupper($this->GetStringWidth(trans('invoice.number'), self::ICONV_CHARSET_INPUT)),
            mb_strtoupper($this->GetStringWidth(trans('invoice.date'), self::ICONV_CHARSET_INPUT)),
            mb_strtoupper($this->GetStringWidth(trans('invoice.due'), self::ICONV_CHARSET_INPUT))
        ) - 44;

        $this->Ln(-50);
        //Number
        if (!empty($this->reference)) {
            $this->Cell($positionX, $lineheight);
            $this->SetFont($this->font, '', 10);
            // $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
            // $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.number'), true) . ':', 0, 0, 'L');
            $this->SetTextColor(50, 50, 50);
            $this->Cell(20, $lineheight, $this->str_iconv(trans('invoice.number', ['no' => '']), false), 0, 0, 'L');
            $this->SetTextColor(50, 50, 50);
            $this->SetFont($this->font, 'B', 10);
            $this->Cell(0, $lineheight, $this->reference, 0, 1, 'L');
        }
        //Date
        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, '', 10);
        // $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
        // $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.date'), true) . ':', 0, 0, 'L');
        $this->SetTextColor(50, 50, 50);
        $this->Cell(22, $lineheight, $this->str_iconv(trans('invoice.date', ['date' => '']), false), 0, 0, 'L');
        $this->SetTextColor(50, 50, 50);
        $this->SetFont($this->font, 'B', 10);
        $this->Cell(0, $lineheight, $this->date, 0, 1, 'L');

        //Time
        if (!empty($this->time)) {
            $this->Cell($positionX, $lineheight);
            $this->SetFont($this->font, 'B', 10);
            $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
            $this->Cell(
                32,
                $lineheight,
                $this->str_iconv(trans('invoice.time'), true) . ':',
                0,
                0,
                'L'
            );
            $this->SetTextColor(50, 50, 50);
            $this->SetFont($this->font, '', 10);
            $this->Cell(0, $lineheight, $this->time, 0, 1, 'R');
        }

        //Due date
        if (!empty($this->due)) {
            $this->Cell($positionX, $lineheight);
            $this->SetFont($this->font, 'B', 10);
            $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
            $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.due'), true) . ':', 0, 0, 'L');
            $this->SetTextColor(50, 50, 50);
            $this->SetFont($this->font, '', 10);
            $this->Cell(0, $lineheight, $this->due, 0, 1, 'R');
        }

        $this->Ln(4);

        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, 'B', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.customer_support'), false) . ':', 0, 1, 'L');

        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.tel', ['no' => config('company.address.tel')]), false), 0, 1, 'L');

        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.email', ['email' => config('company.address.support_email')]), false), 0, 1, 'L');

        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.website', ['website' => config('company.address.website')]), false), 0, 1, 'L');

        $this->Ln(4);
        
        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, 'B', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.ust_idnr', ['ust_idnr' => config('company.bank.ust_idnr')]), false), 0, 1, 'L');

        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.company_owner', ['company_owner' => config('company.company_owner')]), false), 0, 1, 'L');

        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.bank', ['bank' => config('company.bank.name')]), false), 0, 1, 'L');

        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.iban', ['iban' => config('company.bank.iban')]), false), 0, 1, 'L');

        $this->Cell($positionX, $lineheight);
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.bic', ['bic' => config('company.bank.bic')]), false), 0, 1, 'L');
        
        $this->Ln(-17);

        // $this->Cell(0, $lineheight);

        //         :
        // Tel: +4915166545422
        // E-Mail: support@tiejet.com
        // 
        // 
        // 
        // 
        // 
        // 


        // First page
        if ($this->PageNo() == 1) {
            // \Log::info('1111');
            $ymargin = $this->GetY() + 10;

            if (isset($this->margins['t']) && isset($this->dimensions[1])) {
                if (($this->margins['t'] + $this->dimensions[1]) > $this->GetY()) {
                    $ymargin = $this->margins['t'] + $this->dimensions[1] + 5;
                }
            }

            $this->SetY($ymargin);

            $this->Ln(5);
            $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
            $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);

            $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);
            $this->SetFont($this->font, 'B', 10);
            $width = ($this->document['w'] - $this->margins['l'] - $this->margins['r']) / 2;

            $to_lang = trans('invoice.to');
            $from_lang = trans('invoice.from');

            if (isset($this->flipflop)) {
                $to_lang = trans('invoice.from');
                $from_lang = trans('invoice.to');
                $to = $this->to;
                $from = $this->from;
                $this->to = $from;
                $this->from = $to;
            }

            // lines added by hassan00942 start
            $this->Ln(5);

            $this->SetFont($this->font, '', 9);
            $this->SetTextColor(50, 50, 50);
            $this->Cell(0, $lineheight, $this->str_iconv(trans('invoice.your_customer_no', ['no' => $this->customerId]), false), 0, 1, 'L');
    
            $this->Ln(1);

            $this->SetDrawColor(50, 50, 50);
            $this->Rect($this->GetX() + 1, $this->GetY(), 22, 22, 'D');

            $this->Image(
                $this->qrImageUrl,
                // $this->margins['l'],
                // null,
                $this->GetX() + 3.5, // 1 + 2.5
                $this->GetY() + 2.5,
                17,
                17
            );

            $this->Ln(28);

            $this->SetFont($this->font, 'B', 14);
            $this->SetTextColor(50, 50, 50);
            $this->Cell(0, $lineheight, $this->str_iconv(trans('invoice.number', ['no' => $this->reference]), false), 0, 1, 'L');
            
            $this->Ln(5);
            
            $this->SetFont($this->font, '', 10);
            $this->SetTextColor(50, 50, 50);
            $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.respected', ['name' => $this->to[0].',']), false), 0, 1, 'L');
            
            $this->Ln(4);
    
            $this->SetFont($this->font, '', 10);
            $this->SetTextColor(50, 50, 50);
            $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.thank_you_very_much'), false), 0, 1, 'L');
            
            $this->SetFont($this->font, '', 10);
            $this->SetTextColor(50, 50, 50);
            $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.we_herby_invoice'), false), 0, 1, 'L');

            $this->Ln(4);
            // lines added by hassan00942 end
    

            if ($this->display_tofrom === true) {
                if ($this->displayToFromHeaders === true) {
                    $this->Cell($width, $lineheight, $this->str_iconv($from_lang, true), 0, 0, 'L');
                    $this->Cell(0, $lineheight, $this->str_iconv($to_lang, true), 0, 0, 'L');
                    $this->Ln(7);
                    $this->SetLineWidth(0.4);
                    $this->Line($this->margins['l'], $this->GetY(), $this->margins['l'] + $width - 10, $this->GetY());
                    $this->Line(
                        $this->margins['l'] + $width,
                        $this->GetY(),
                        $this->margins['l'] + $width + $width,
                        $this->GetY()
                    );
                } else {
                    $this->Ln(2);
                }

                //Information
                $this->Ln(5);
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, 'B', 10);
                $this->Cell($width, $lineheight, $this->from[0] ?? '', 0, 0, 'L');
                $this->Cell(0, $lineheight, $this->str_iconv($this->to[0] ?? ''), 0, 0, 'L');
                $this->SetFont($this->font, '', 8);
                $this->SetTextColor(100, 100, 100);
                $this->Ln(7);

                for ($i = 1, $iMax = max($this->from === null ? 0 : count($this->from), $this->to === null ? 0 : count($this->to)); $i < $iMax; $i++) {
                    // check if the TO or FROM array value is not empty.
                    $to = isset($this->to[$i]) ? $this->to[$i] : '';
                    $from = isset($this->from[$i]) ? $this->from[$i] : '';

                    $this->Cell($width, $lineheight, $this->str_iconv($from), 0, 0, 'L');
                    $this->Cell(0, $lineheight, $this->str_iconv($to), 0, 0, 'L');
                    $this->Ln(5);
                }
                $this->Ln(-6);
                $this->Ln(5);
            } else {
                $this->Ln(-10);
            }
        }

        //Table header
        if (!isset($this->productsEnded)) {
            $width_other = ($this->document['w'] - $this->margins['l'] - $this->margins['r'] - $this->firstColumnWidth - ($this->columns * $this->columnSpacing)) / ($this->columns - 1);
            $width_other -= 10; // odl value is 32/4 added by hassan00942
            $this->SetTextColor(50, 50, 50);
            $this->Ln(12);
            
            // 4 lines added by hassan00942
            $this->SetFont($this->font, 'B', 9);
            $this->SetFillColor(233, 233, 233);
            $this->Cell(12, 10, $this->str_iconv("invoice.pos", false), 0, 0, 'L', 1);
            $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 1);
            
            // 4 lines added by hassan00942
            $this->SetFont($this->font, 'B', 9);
            $this->SetFillColor(233, 233, 233);
            $this->Cell(20, 10, $this->str_iconv("invoice.image", false), 0, 0, 'L', 1);
            $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 1);

            $this->SetFont($this->font, 'B', 9);
            $this->SetFillColor(233, 233, 233);
            $this->Cell(1, 10, '', 0, 0, 'L', 1 /* old value 0 new 1 + hassan00942 */);
            $this->Cell(
                $this->firstColumnWidth,
                10,
                $this->str_iconv(trans('invoice.description'), false),
                0,
                0,
                'L',
                1 /* old value 0 new 1 + hassan00942 */
            );
            $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 1 /* old value 0 new 1 + hassan00942 */);

            $this->Cell($width_other, 10, $this->str_iconv(trans('invoice.qty'), false), 0, 0, 'C', 1 /* old value 0 new 1 + hassan00942 */);
            if (isset($this->vatField)) {
                $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 1 /* old value 0 new 1 + hassan00942 */);
                $this->Cell(
                    $width_other,
                    10,
                    $this->str_iconv(trans('invoice.vat'), false),
                    0,
                    0,
                    'C',
                    1 /* old value 0 new 1 + hassan00942 */
                );
            }
            $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 1 /* old value 0 new 1 + hassan00942 */);
            $this->Cell($width_other, 10, $this->str_iconv(trans('invoice.price'), false), 0, 0, 'C', 1 /* old value 0 new 1 + hassan00942 */);
            if (isset($this->discountField)) {
                $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 1 /* old value 0 new 1 + hassan00942 */);
                $this->Cell(
                    $width_other,
                    10,
                    $this->str_iconv(trans('invoice.discount'), true),
                    0,
                    0,
                    'C',
                    1 /* old value 0 new 1 + hassan00942 */
                );
            }
            $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 1 /* old value 0 new 1 + hassan00942 */);
            $this->Cell($width_other, 10, $this->str_iconv(trans('invoice.total'), false), 0, 0, 'C', 1 /* old value 0 new 1 + hassan00942 */);
            $this->Ln();
            // four lines commneted by hassan0094
            // $this->SetLineWidth(0.3);
            // $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);
            // $this->Line($this->margins['l'], $this->GetY(), $this->document['w'] - $this->margins['r'], $this->GetY());
            // $this->Ln(2);
        } else {
            $this->Ln(12);
        }
    }

    public function Body()
    {
        $width_other = ($this->document['w'] - $this->margins['l'] - $this->margins['r'] - $this->firstColumnWidth - ($this->columns * $this->columnSpacing)) / ($this->columns - 1);
        $width_other -= 10; // old valie is 32/4 added by hassan00942
        $cellHeight = 6; // original value is 8 + hassan00942
        // $bgcolor = (1 - $this->columnOpacity) * 255; // commented by hassan00942

        if ($this->items) {
            foreach ($this->items as $index => $item) {
                // if else added by hassan00942
                if($index % 2 == 0){
                    $bgcolor = 253;
                }else{
                    $bgcolor = 233;
                }

                if ((empty($item['item'])) || (empty($item['description']))) {
                    $this->Ln($this->columnSpacing);
                }

                if ($item['description']) {
                    //Precalculate height
                    $calculateHeight = new self;
                    $calculateHeight->addPage();
                    $calculateHeight->setXY(0, 0);
                    $calculateHeight->SetFont($this->font, '', 7);
                    $calculateHeight->MultiCell(
                        $this->firstColumnWidth,
                        3,
                        $this->str_iconv($item['description']),
                        0,
                        'L',
                        1
                    );
                    $descriptionHeight = $calculateHeight->getY() + $cellHeight + 2;
                    $pageHeight = $this->document['h'] - $this->GetY() - $this->margins['t'] - $this->margins['t'];
                    if ($pageHeight < 35) {
                        $this->AddPage();
                    }
                }

                $cHeight = $cellHeight;
                $this->SetFont($this->font, 'b', 8);
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(1, $cHeight, '', 0, 0, 'L', 1);
                $x = $this->GetX();

                // 2 lines added by hassan00942
                $this->Cell(12, $cHeight, $index + 1, 0, 0, 'L', 1);
                $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                
                // 2 lines added by hassan00942
                $this->Cell(20, $cHeight, "N/A", 0, 0, 'L', 1);
                $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                

                
                $this->Cell(
                    $this->firstColumnWidth,
                    $cHeight,
                    $this->str_iconv($item['item']),
                    0,
                    0,
                    'L',
                    1
                );

                if ($item['description']) {
                    $resetX = $this->GetX();
                    $resetY = $this->GetY();
                    $this->SetTextColor(120, 120, 120);
                    $this->SetXY($x, $this->GetY() + 8);
                    $this->SetFont($this->font, '', $this->fontSizeProductDescription);
                    $this->MultiCell(
                        $this->firstColumnWidth,
                        floor($this->fontSizeProductDescription / 2),
                        $this->str_iconv($item['description']),
                        0,
                        'L',
                        1
                    );
                    //Calculate Height
                    $newY = $this->GetY();
                    $cHeight = $newY - $resetY + 2;
                    //Make our spacer cell the same height
                    $this->SetXY($x - 1, $resetY);
                    $this->Cell(1, $cHeight, '', 0, 0, 'L', 1);
                    //Draw empty cell
                    $this->SetXY($x, $newY);
                    $this->Cell($this->firstColumnWidth, 2, '', 0, 0, 'L', 1);
                    $this->SetXY($resetX, $resetY);
                }

                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 8);
                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell($width_other, $cHeight, $item['quantity'], 0, 0, 'C', 1);
                if (isset($this->vatField)) {
                    $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                    if (isset($item['vat'])) {
                        $this->Cell($width_other, $cHeight, iconv(self::ICONV_CHARSET_INPUT, self::ICONV_CHARSET_OUTPUT_B, $item['vat']), 0, 0, 'C', 1);
                    } else {
                        $this->Cell($width_other, $cHeight, '', 0, 0, 'R' /* original value C + hassan00942 */, 1);
                    }
                }
                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell($width_other, $cHeight, iconv(self::ICONV_CHARSET_INPUT, self::ICONV_CHARSET_OUTPUT_B, $this->price($item['price'])), 0, 0, 'R' /* original value C + hassan00942 */, 1);
                if (isset($this->discountField)) {
                    $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                    if (isset($item['discount'])) {
                        $this->Cell(
                            $width_other,
                            $cHeight,
                            iconv(self::ICONV_CHARSET_INPUT, self::ICONV_CHARSET_OUTPUT_B, $item['discount']),
                            0,
                            0,
                            'R' /* original value C + hassan00942 */,
                            1
                        );
                    } else {
                        $this->Cell($width_other, $cHeight, '', 0, 0, 'R' /* original value C + hassan00942 */, 1);
                    }
                }
                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell($width_other, $cHeight, iconv(self::ICONV_CHARSET_INPUT, self::ICONV_CHARSET_OUTPUT_B, $this->price($item['total'])), 0, 0, 'R' /* original value C + hassan00942 */, 1);
                $this->Ln();
                $this->Ln($this->columnSpacing);
            }
        }

        //#SingatureO
        if (isset($this->signature) and !empty($this->signature)) {
            $this->Image(
                $this->signature,
                $this->signatureX,
                $this->signatureY,
                $this->dimensions[0],
                $this->dimensions[1]
            );
        }

        $badgeX = $this->getX();
        $badgeY = $this->getY();

        //Add totals
        if ($this->totals) {
            foreach ($this->totals as $index => $total) {
                $this->SetTextColor(50, 50, 50);

                // if else added by hassan00942
                if($index % 2 == 0){
                    $bgcolor = 253;
                }else{
                    $bgcolor = 233;
                }

                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);

                // commented by hassan00942
                // $this->Cell(1 + $this->firstColumnWidth + $width_other, $cellHeight, '', 0, 0, 'L', 0);
                // for ($i = 0; $i < $this->columns - 3; $i++) {
                //     $this->Cell($width_other, $cellHeight, '', 0, 0, 'L', 0);
                //     $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                // }                

                // 2 lines added by hassan00942
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(12, $cellHeight, '', 0, 0, 'L', 1);

                // 2 lines added by hassan00942
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(22, $cellHeight, '', 0, 0, 'L', 1);
                
                $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                if ($total['colored']) {
                    // commented by hassan00942
                    // $this->SetTextColor(255, 255, 255);
                    // commented by hassan00942
                    // $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                    // commented by hassan00942
                    // $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                }
                $this->SetFont($this->font, 'b', 8);
                $this->Cell(1, $cellHeight, '', 0, 0, 'L', 1);
                $this->Cell(
                    $this->firstColumnWidth - 1 + $width_other * 2/* original value is $width_other - 1 + hassan00942*/,
                    $cellHeight,
                    iconv(self::ICONV_CHARSET_INPUT, self::ICONV_CHARSET_OUTPUT_B, $total['name']),
                    0,
                    0,
                    'L',
                    1
                );
                $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                $this->SetFont($this->font, 'b', 8);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                if ($total['colored']) {
                    // commented by hassan00942
                    // $this->SetTextColor(255, 255, 255);
                    // commented by hassan00942
                    // $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                    // commented by hassan00942
                    // $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                }
                $this->Cell($width_other, $cellHeight, iconv(self::ICONV_CHARSET_INPUT, self::ICONV_CHARSET_OUTPUT_B, $total['value']), 0, 0, 'R' /*original value is C + hassan00942 */, 1);
                $this->Ln();
                $this->Ln($this->columnSpacing);
            }
        }
        $this->productsEnded = true;
        $this->Ln();
        $this->Ln(3);

        //Badge
        /*
        commented by hassan00942
        if ($this->badge) {
            $badge = ' ' . mb_strtoupper($this->badge, self::ICONV_CHARSET_INPUT) . ' ';
            $resetX = $this->getX();
            $resetY = $this->getY();
            $this->setXY($badgeX, $badgeY + 15);
            $this->SetLineWidth(0.4);
            $this->SetDrawColor($this->badgeColor[0], $this->badgeColor[1], $this->badgeColor[2]);
            $this->setTextColor($this->badgeColor[0], $this->badgeColor[1], $this->badgeColor[2]);
            $this->SetFont($this->font, 'b', 15);
            $this->Rotate(10, $this->getX(), $this->getY());
            $this->Rect($this->GetX(), $this->GetY(), $this->GetStringWidth($badge) + 2, 10);
            $this->Write(10, iconv(self::ICONV_CHARSET_INPUT, self::ICONV_CHARSET_OUTPUT_B, mb_strtoupper($badge, self::ICONV_CHARSET_INPUT)));
            $this->Rotate(0);

            if ($resetY > $this->getY() + 20) {
                $this->setXY($resetX, $resetY);
            } else {
                $this->Ln(18);
            }
        }
        */

        //Add information
        /*
        commented by hassan00942
        foreach ($this->addText as $text) {
            if ($text[0] == 'title') {
                $this->SetFont($this->font, 'b', 9);
                $this->SetTextColor(50, 50, 50);
                $this->Cell(0, 10, $this->str_iconv($text[1], true), 0, 0, 'L', 0);
                $this->Ln();
                $this->SetLineWidth(0.3);
                $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Line(
                    $this->margins['l'],
                    $this->GetY(),
                    $this->document['w'] - $this->margins['r'],
                    $this->GetY()
                );
                $this->Ln(4);
            }
            if ($text[0] == 'paragraph') {
                $this->SetTextColor(80, 80, 80);
                $this->SetFont($this->font, '', 8);
                $this->MultiCell(0, 4, $this->str_iconv($text[1]), 0, 'L', 0);
                $this->Ln(4);
            }
        }
        */

        // $this->Ln(4);

        $lineheight = 4;
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.if_you_have_not_pay'), false), 0, 1, 'L');
        
        $this->Ln(5);

        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.order_status', ['status' => $this->paymentStatusName]), false), 0, 1, 'L');
        
        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.order_completed', ['date' => $this->date]), false), 0, 1, 'L');

        $this->Ln(5);

        $this->SetFont($this->font, 'B', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.need_any_help', ['email' => config('company.address.support_email')]), false), 0, 1, 'L');

        $this->Ln(5);

        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(trans('invoice.yours_sincerely'), false), 0, 1, 'L');

        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(32, $lineheight, $this->str_iconv(config('company.name'), false), 0, 1, 'L');
        
    }

    public function Footer()
    {
        $this->SetY(-$this->margins['t']);
        $this->SetFont($this->font, '', 8);
        $this->SetTextColor(50, 50, 50);
        
        $width = $this->document['w'] - $this->margins['l'] - $this->margins['r'];
        $width_cell = $width/4;

        // footer line 1
        $this->Cell($width_cell, 0, config('company.address.line1'), 0, 0, 'L');
        $this->Cell($width_cell, 0, trans('invoice.tel', ['no' => config('company.address.tel')]), 0, 0, 'L');
        $this->Cell($width_cell, 0, trans('invoice.vat_id', ['id' => config('company.vat_id')]), 0, 0, 'L');
        $this->Cell($width_cell, 0, trans('invoice.bank', ['bank' => config('company.address.website')]), 0, 1, 'L');
        
        $this->Ln(3);

        // footer line 2
        $this->Cell($width_cell, 0, config('company.address.line2'), 0, 0, 'L');
        $this->Cell($width_cell, 0, trans('invoice.email', ['email' => config('company.address.email')]), 0, 0, 'L');
        $this->Cell($width_cell, 0, trans('invoice.managing_director', ['name' => config('company.managment.director.first_name')]), 0, 0, 'L');
        $this->Cell($width_cell, 0, trans('invoice.iban'), 0, 0, 'L');

        $this->Ln(3);

        // footer line 2
        $this->Cell($width_cell, 0, config('company.address.line3'), 0, 0, 'L');
        $this->Cell($width_cell, 0, trans('invoice.website', ['website' => config('company.address.website')]), 0, 0, 'L');
        $this->Cell($width_cell, 0, config('company.managment.director.last_name'), 0, 0, 'L');
        $this->Cell($width_cell, 0, config('company.bank.iban'), 0, 0, 'L');

        $this->Ln(3);

        // footer line 2
        $this->Cell($width_cell, 0, config('company.address.line4'), 0, 0, 'L');
        $this->Cell($width_cell, 0, "", 0, 0, 'L');
        $this->Cell($width_cell, 0, "", 0, 0, 'L');
        $this->Cell($width_cell, 0, trans('invoice.bic', ['bic' => config('company.bank.bic')]), 0, 0, 'L');

        // $this->Cell(0, 10, $this->footernote, 0, 0, 'L');
        // $this->Cell(
        //     0,
        //     10,
        //     iconv('UTF-8', 'ISO-8859-1', trans('invoice.page')) . ' ' . $this->PageNo() . ' ' . trans('invoice.page_of') . ' {nb}',
        //     0,
        //     0,
        //     'R'
        // );
    }

    public function Rotate($angle, $x = -1, $y = -1)
    {
        if ($x == -1) {
            $x = $this->x;
        }
        if ($y == -1) {
            $y = $this->y;
        }
        if ($this->angle != 0) {
            $this->_out('Q');
        }
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf(
                'q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',
                $c,
                $s,
                -$s,
                $c,
                $cx,
                $cy,
                -$cx,
                -$cy
            ));
        }
    }

    public function _endpage()
    {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    private function recalculateColumns()
    {
        $this->columns = 4;

        if (isset($this->vatField)) {
            $this->columns += 1;
        }

        if (isset($this->discountField)) {
            $this->columns += 1;
        }
    }

    private function str_iconv($str = '', $toupper = false)
    {
        $str = $toupper ? mb_strtoupper($str, self::ICONV_CHARSET_INPUT) : $str;

        return iconv(self::ICONV_CHARSET_INPUT, self::ICONV_CHARSET_OUTPUT_A, $str);
    }
}
