<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Kiểm tra nếu request POST có dữ liệu
        if ($request->isMethod('post')) {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            // Dữ liệu giao dịch
            $orderInfo = "Thanh toán qua MoMo";
            $amount = "10000";
            $orderId = time(); // Sử dụng timestamp để đảm bảo unique
            $redirectUrl = "http://127.0.0.1:8000/profile";
            $ipnUrl = "http://127.0.0.1:8000/profile";

            // Lấy extraData từ form hoặc để trống
            $extraData = $request->input('extraData', '');

            $requestId = time(); // Sử dụng timestamp
            $requestType = "payWithATM";

            // Tạo signature
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

            // Gửi request đến MoMo
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); // Decode JSON

            // Kiểm tra và chuyển hướng nếu thành công
            if (isset($jsonResult['payUrl'])) {
                return redirect($jsonResult['payUrl']);
            }

            // Trường hợp lỗi
            return back()->withErrors(['msg' => 'Không thể tạo giao dịch. Vui lòng thử lại.']);
        }

        return view('online_checkout'); // Hiển thị form nếu không phải POST
    }

}
