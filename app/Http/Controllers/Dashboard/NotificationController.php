<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications->where('id', $id)->first();
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }

    public function markAllAsRead()
    {
        // $notification = Admin::first()->unreadNotifications->markAsRead();
        $notification = auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function loadMore($type, $next)
    {
        if ($type == 'unread-load-more')
            // $notifications = Admin::first()->unreadNotifications();
            $notifications = auth()->user()->unreadNotifications();
        else
            // $notifications = Admin::first()->notifications();
            $notifications = auth()->user()->notifications();

        $notifications = $notifications->skip($next)->take(10)->get()->map(function ($notification) {
            return [
                'id' => $notification->id,
                'color' => $notification->data['color'],
                'icon' => $notification->data['icon'],
                'title' => $notification->data['title'],
                'description' => $notification->data['description'],
                'created_at' => $notification->created_at->diffForHumans(),
            ];
        });


        return response()->json([
            'data' => $notifications,
            'isMoreExist' => $notifications->skip($next)->count() > 0,
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function saveToken(Request $request)
    {

        auth()->user()->update(['device_token' => $request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function changeSoundStatus(Request $request)
    {
        Setting::setExtraColumns([
            'user_id' => auth()->id()
        ]);

        setting(['notification_status' => $request->status == "true"])->save();

        if (setting('notification_status'))
        {
            return response()->json("تم تفعيل صوت الاشعارات بنجاح");
        } else
        {
            return response()->json("تم إيقاف صوت الاشعارات بنجاح");
        }


    }
}
