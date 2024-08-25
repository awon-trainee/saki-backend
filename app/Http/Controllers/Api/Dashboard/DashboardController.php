<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Http\Requests\Api\PurchaseRequest;
use App\Http\Resources\DashboardResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\MarketResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\WalletResource;
use App\Http\Services\BarcodeService;
use App\Http\Services\DaleelStoreService;
use App\Http\Services\ResalService;
use App\Models\Category;
use App\Models\Item;
use App\Models\Market;
use App\Models\ResalVariant;
use App\Models\TrackingBeneficiary;
use GuzzleHttp\Exception\ClientException;
use Illuminate\View\View;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\TokenRepository;


class DashboardController extends Controller
{


    public function dashboard()
    {
        return $this->apiResponse(null, false, Response::HTTP_OK, new DashboardResource(auth()->user()));
    }


    public function categoryProduct(Category $category)
    {
        $this->authorize('view', $category);

        return $this->apiResponse(null, false, Response::HTTP_OK, MarketResource::collection($category->activeMarket()->get()));
    }


    public function MarketItems(Market $market)
    {
        $this->authorize('view', $market->category->first());

        // return $this->apiResponse(null, false, Response::HTTP_OK, ItemResource::collection($market->items));
        return $this->apiResponse(null, false, Response::HTTP_OK, ItemResource::collection($market->resalProduct->resalVariants));
    }

    // public function purchase(PurchaseRequest $purchaseRequest, DaleelStoreService $daleelStoreService)
    // {
    //     $item = Item::query()->findOrFail($purchaseRequest->input('item_id'));
    //     $balance = auth()->user()->balance;
    //     if ($balance->amount >= $item->daleelStoreMarket->price) {
    //         $purchase = \DB::transaction(function () use ($item, $balance, $daleelStoreService) {
    //             auth()->user()->trackingBalanceBeneficiares()->create([
    //                 'market_id' => $item->market_id,
    //                 'operation' => TrackingBeneficiary::PURCHASE,
    //                 'old_balance' => $balance->amount,
    //                 'new_balance' => ($balance->amount - $item->daleelStoreMarket->price),
    //                 'amount' => $item->daleelStoreMarket->price
    //             ]);
    //
    //             $balance->decrement('amount', $item->daleelStoreMarket->price);
    //
    //             $response = $daleelStoreService->request('post', DaleelStoreService::PURCHASE, ['item_id' => $item->daleelStoreMarket->daleel_store_id, 'qty' => 1]);
    //
    //             return auth()->user()->purchase()->create([
    //                 'item_id' => $item->id,
    //                 'qty' => 1,
    //                 'status' => 'completed',
    //                 'amount' => $item->daleelStoreMarket->price,
    //                 'purchase_daleel_id' => $response['purchase_id'],
    //                 'expiry_date' => $response['item'][0]['expiry_date'],
    //                 'barcode_link' => $response['item'][0]['barcode_link'],
    //                 'amount_detect' => $balance->amount - $item->daleelStoreMarket->price,
    //             ]);
    //
    //         });
    //
    //         return $this->apiResponse(trans('api/dashboard.purchase_successfully'), false, Response::HTTP_OK, new PurchaseResource($purchase));
    //     } else {
    //         return $this->apiResponse(trans('api/dashboard.not_have_enough_balance'), true, Response::HTTP_BAD_REQUEST);
    //     }
    // }

    public function purchase(PurchaseRequest $purchaseRequest, ResalService $resalService)
    {
        $item = ResalVariant::query()->findOrFail($purchaseRequest->input('item_id'));
        $balance = auth()->user()->balance;

        if (!$balance->amount >= $item->price_with_vat)
            return $this->apiResponse(trans('api/dashboard.not_have_enough_balance'), true, Response::HTTP_BAD_REQUEST);

        try {
            $purchase = \DB::transaction(function () use ($item, $balance, $resalService) {
                auth()->user()->trackingBalanceBeneficiares()->create([
                    'market_id' => Market::query()->where('resal_product_id', $item->resalProduct->id)->first()->id,
                    'operation' => TrackingBeneficiary::PURCHASE,
                    'old_balance' => $balance->amount,
                    'new_balance' => ($balance->amount - $item->price_with_vat),
                    'amount' => $item->price_with_vat
                ]);

                $balance->decrement('amount', $item->price_with_vat);

                $response = $resalService->quickOrder($item->id, auth()->user()->name);

                return auth()->user()->purchase()->create([
                    'item_id' => $item->id,
                    'qty' => 1,
                    'status' => 'completed',
                    'amount' => $item->price_with_vat,
                    'purchase_resal_id' => $response->order->id,
                    'expiry_date' => $response->order->egift_line_items[0]->expire_on,
                    'code' => $response->order->egift_line_items[0]->code,
                    'resal_order_id' => $response->order->id,
                    'resal_redemption_id' => $response->order->egift_line_items[0]->redemption_id,
                    'amount_detect' => $balance->amount - $item->price_with_vat,
                ]);
            });
        } catch (ClientException $exception) {
            return $this->apiResponse(trans('api/dashboard.not_available'), true, Response::HTTP_BAD_REQUEST);
        }

        return $this->apiResponse(trans('api/dashboard.purchase_successfully'), false, Response::HTTP_OK, new PurchaseResource($purchase));
    }


    public function purchaseDashboard()
    {
        return $this->apiResponse(null, false, Response::HTTP_OK, PurchaseResource::collection(auth()->user()->purchase()->orderByDesc('id')->get()));
    }


    public function profile()
    {
        return $this->apiResponse(null, false, Response::HTTP_OK, new ProfileResource(auth()->user()));
    }


    public function wallet()
    {
        return $this->apiResponse(null, false, Response::HTTP_OK, new WalletResource(auth()->user()->load('trackingBalanceBeneficiares')));
    }

    public function updateProfile(ProfileRequest $profileRequest)
    {
        auth()->user()->update($profileRequest->validated());
        return $this->apiResponse(null, false, Response::HTTP_OK, new ProfileResource(auth()->user()));
    }

    public function logout()
    {
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken(auth()->user()->tokens->first()->id);

        return $this->apiResponse(null, false, Response::HTTP_OK);
    }

    public function delete()
    {
        auth()->user()->delete();
        return $this->apiResponse(null, false, Response::HTTP_OK);
    }

    public function barcode(string $text): View
    {
        return view('barcode', [
            'text' => $text,
        ]);
    }
}
