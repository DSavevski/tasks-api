<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function daily($date)
    {
        $high = static::with('category')->where([['date', '=', $date], ['priority', '=', 'High'], ['completed', '=', '0']])->orderBy('created_at')->get();
        $medium = static::with('category')->where([['date', '=', $date], ['priority', '=', 'Medium'], ['completed', '=', '0']])->orderBy('created_at')->get();
        $low = static::with('category')->where([['date', '=', $date], ['priority', '=', 'Low'], ['completed', '=', '0']])->orderBy('created_at')->get();
        $completed = static::with('category')->where([['date', '=', $date],['completed', '=', '1']])->get();


        return response()->json([
            'high' => $high,
            'medium' => $medium,
            'low' => $low,
            'completed' => $completed
        ]);
    }

    public static function helper($date)
    {
        return static::where('date', '=', $date)->orderBy('completed')->orderBy('priority', 'desc')->get();
    }

    public static function weekly($date)
    {
        $data = array();
        $currentDay = Carbon::createFromFormat('Y-m-d', $date);
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            array_push($days, $currentDay->toDateString());
            $daily = self::helper($currentDay->toDateString());
            array_push($data, $daily);
            $currentDay->addDay(1);
        }
        return response()->json([
            'data' => $data,
            'days' => $days
        ]);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
