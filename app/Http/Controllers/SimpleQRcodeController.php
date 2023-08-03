<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SimpleQRcodeController extends Controller
{
    public function generate(){
        $qrcode = QRCode::size(200)->generate("je suis un QR code");

        return view('/simple-qrcode', compact('qrcode'));
    }
}
