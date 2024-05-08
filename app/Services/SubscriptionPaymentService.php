<?

namespace App\Services;

class SubscriptionPaymentService
{
    private static $apiLicense;
    private static $confirmPaymentUrl;
    private static $finalizePaymentUrl;

    public function __construct()
    {
        self::$apiLicense = "GD01NI";
        self::$confirmPaymentUrl = route("payment.process");
        self::$finalizePaymentUrl = route("payment.finalize");
    }

    public function initiatePayment($orderId, $total)
    {
        return "https://test.satim.guiddini.dz/SATIM-WFGWX-YVC9B4J6C9/" . self::$apiLicense . "/cib.php?order_id={$orderId}&total={$total}&returnUrl=" . self::$confirmUrl;
    }

    public function confirmPayment($request)
    {
        $orderNumber = $request->input('orderNumber');
        $orderId = $request->input('orderId');
        $bool = $request->input('bool');


        //finding transaction
        if ($bool = 0) 
        {
            //logging the details in the transaction
        }
        else 
        {
            $confirmUrl = "https://test.satim.guiddini.dz/SATIM-WFGWX-YVC9B4J6C9/" . self::$apiLicense . "/returnCib.php?gatewayOrderId={$orderId}&returnUrl={$returnUrl}&orderNumber={$orderNumber}&total={$total}";
            return redirect()->to($confirmUrl);
        }
    }

    public function handlePaymentResponse($request)
    {
        dd($request);
    }

}