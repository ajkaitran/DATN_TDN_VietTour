<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OnlineCheckoutController extends Controller
{
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        return $result;
    }

    public function online_checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            $oderCode = $request->input('oder_code'); // Lấy mã đơn hàng từ form
            $order = Order::where('oder_code', $oderCode)->first(); // Sử dụng đúng tên cột

            if (!$order) {
                return back()->withErrors(['msg' => 'Không tìm thấy đơn hàng. Vui lòng thử lại.']);
            }

            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = "Thanh toán qua MoMo";
            $amount = $order->price; // Lấy giá trị từ cơ sở dữ liệu
            $orderId = $oderCode; // Sử dụng `oder_code` làm mã đơn hàng
            $redirectUrl = route('payment.callback');
            $ipnUrl = route('payment.callback');
            $extraData = "";

            $requestId = time();
            $requestType = "payWithATM";

            $rawHash = "accessKey=" . $accessKey .
                "&amount=" . $amount .
                "&extraData=" . $extraData .
                "&ipnUrl=" . $ipnUrl .
                "&orderId=" . $orderId .
                "&orderInfo=" . $orderInfo .
                "&partnerCode=" . $partnerCode .
                "&redirectUrl=" . $redirectUrl .
                "&requestId=" . $requestId .
                "&requestType=" . $requestType;

            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = [
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            ];

            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);

            if (isset($jsonResult['payUrl'])) {
                return redirect($jsonResult['payUrl']);
            }

            return back()->withErrors(['msg' => 'Không thể tạo giao dịch. Vui lòng thử lại.']);
        }

        return view('online_checkout');
    }


    public function paymentCallback(Request $request)
    {
        $data = $request->all();

        Log::info('MoMo Callback Data:', $data);

        $resultCode = $data['resultCode'];

        if ($resultCode == 0) { // Giao dịch thành công
            $order = Order::where('oder_code', $data['orderId'])->first(); // Sử dụng đúng `oder_code`

            if ($order) {
                $order->status = 2; // Trạng thái "Đang chờ xử lý"
                $order->save();
                return redirect()->route('home.profile')->with('success', 'Thanh toán thành công!');
            }

            return redirect()->route('home.profile')->with('error', 'Không tìm thấy đơn hàng. Vui lòng thử lại.');
        }

        return redirect()->route('home.profile')->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
    }
}
