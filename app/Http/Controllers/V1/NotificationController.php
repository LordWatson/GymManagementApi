<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        //
    }

    public function all()
    {
        $notifications = Auth::user()->notifications;
        $data = [];

        if(!isset($notifications))
        {
            return response([
                'message' => 'No unread notifications'
            ], 200);
        }

        foreach($notifications as $key => $notification)
        {
            $data[$key] = $notification->data;
            $data[$key]['id'] = $notification->id;
            $data[$key]['read_at'] = $notification->read_at;
        }

        return response($data, 200);
    }

    public function unread()
    {
        $notifications = Auth::user()->unreadNotifications;
        $data = [];

        if(!isset($notifications))
        {
            return response([
                'message' => 'No unread notifications'
                ], 200);
        }

        foreach($notifications as $key => $notification)
        {
            $data[$key] = $notification->data;
            $data[$key]['id'] = $notification->id;
        }

        return response($data, 200);
    }

    public function destroy($id)
    {
        $notification = Notification::find($id)->delete();

        if($notification == 1)
        {
            return response([
                'message' => 'Notification deleted successfully',
            ], 201);
        }

        return $notification;
    }

    public function markAsRead($id)
    {
        // Effectively a soft delete on a Notification
        // When read_at !null, it will not be returned in an unread get request
        $notification = Notification::find($id);
        $notification->read_at = date('Y-m-d H:i:s');

        try
        {
            $notification->update();

            return response([
                'message' => 'Notification deleted successfully',
            ], 200);

        }catch(\Exception $e)
        {
            return response([
                'message' => 'Something went wrong',
            ], 400);
        }
    }

    public function markAllAsRead()
    {
        // Get only IDs from unread notifications
        $notifications = Auth::user()->unreadNotifications->pluck('id');
        $count = 0;

        // Mark each notification as read
        // If one fails, it will return on failed result
        foreach($notifications as $notificationId)
        {
            try
            {
                $notification = Notification::find($notificationId);
                $notification->read_at = date('Y-m-d H:i:s');
                $notification->update();
                $count++;

            }catch(\Exception $e)
            {
                return response([
                    'message' => 'Something went wrong',
                ], 400);
            }
        }

        return response([
            'message' => $count . ' notifications marked as read',
        ], 200);
    }
}
