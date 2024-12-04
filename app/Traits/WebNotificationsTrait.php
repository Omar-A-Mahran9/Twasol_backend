<?php

namespace App\Traits;

use App\Enums\OrderStatus;
use App\Models\User;
use App\Notifications\NewNotification;

trait WebNotificationsTrait
{
    protected static function newVendorNotification($vendor)
    {
        $titleAr       = "هناك تاجر قام بالإنضمام";
        $titleEn       = "There is a merchant who joined";
        $descriptionAr = "لقد انضم تاجر جديد للتو إلى منصتنا.";
        $descriptionEn = "A new merchant has just joined our platform.";
        $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="black"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="black"/>
          </svg>';
        $color         = "danger";
        storeAndPushNotificationAdmin(1, $titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('dashboard.vendors.show', $vendor->id));
    }

    protected static function newOrderNotification($order)
    {
        $titleAr       = "هناك طلب جديد";
        $titleEn       = "There is a new Order";
        $descriptionAr = "لقد تم تقديم طلب جديد للتو. تحقق من التفاصيل وقم بمعالجته على الفور.";
        $descriptionEn = "A fresh order has just been placed. Check the details and process it promptly.";
        $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="black"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="black"/>
          </svg>';
        $color         = "danger";
        storeAndPushNotificationAdmin(1, $titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('dashboard.orders.show', $order->id), $order->orderItems->pluck('vendor_id'));
    }
    protected static function newOrderVendorNotification($order)
    {
        $titleAr       = "هناك طلب جديد";
        $titleEn       = "There is a new Order";
        $descriptionAr = "لقد تم تقديم طلب جديد للتو. تحقق من التفاصيل وقم بمعالجته على الفور.";
        $descriptionEn = "A fresh order has just been placed. Check the details and process it promptly.";
        $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="black"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="black"/>
          </svg>';
        $color         = "danger";
        storeAndPushNotificationAdmin(0, $titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('vendor.orders.show', $order->id), $order->orderItems->pluck('vendor_id'));
    }

    protected static function CancelRefundOrderNotification($order)
    {
        if ($order->status == OrderStatus::Canceled->name) {
            $titleAr       = "تم إلغاء الطلب";
            $titleEn       = "Order Canceled";
            $descriptionAr = "لقد تم إلغاء الطلب. يرجى التحقق من التفاصيل وإجراء اللازم.";
            $descriptionEn = "The order has been canceled. Please check the details and take the necessary action.";
        } elseif ($order->status == OrderStatus::Refund->name) {
            $titleAr       = "طلب استرداد";
            $titleEn       = "Refund Request";
            $descriptionAr = "تم طلب استرداد للطلب. يرجى التحقق من التفاصيل ومعالجة الطلب.";
            $descriptionEn = "A refund request has been made for the order. Please check the details and process the request.";
        }

        $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="black"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="black"/>
          </svg>';
        $color         = "danger";
        storeAndPushNotificationAdmin(1, $titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('dashboard.refund-cancel-orders.index'), null, 'order_refund_cancel');
    }
}
