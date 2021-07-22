<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\{Box};
use Illuminate\Http\JsonResponse;
use App\Helpers\{WalletHelpers};
use App\Http\Requests\Api\Frontend\CurrencyConvertRequest;


class FrontendController extends Controller
{

    /**
     * @param $cryptocurrency
     * @return JsonResponse
     */
    public function getRateCurrency($cryptocurrency): JsonResponse
    {
        try {
            return response()->json(['price' => WalletHelpers::RateCurrency($cryptocurrency)]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param CurrencyConvertRequest $request
     * @return JsonResponse
     */
    public function convertToBTC(CurrencyConvertRequest $request): JsonResponse
    {
        try {
            return response()->json(['price' => WalletHelpers::convert('btc', $request->rate, $request->currency)]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param CurrencyConvertRequest $request
     * @return JsonResponse
     */
    public function convertToETH(CurrencyConvertRequest $request): JsonResponse
    {
        try {
            return response()->json(['price' => WalletHelpers::convert('eth', $request->rate, $request->currency)]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @return JsonResponse
     */
    public function seedList(): JsonResponse
    {
        return response()->json(['items' => Box::seeds()]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \EthereumRPC\Exception\ConnectionException
     * @throws \EthereumRPC\Exception\GethException
     * @throws \HttpClient\Exception\HttpClientException
     */
    public function totalBalance(Request $request): JsonResponse
    {
        return response()->json(['balance' => WalletHelpers::totalBalance($request->cryptocurrency)]);
    }
}
