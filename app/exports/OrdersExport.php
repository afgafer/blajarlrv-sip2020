<?php

namespace App\Exports;

use App\models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

//class OrdersExport implements FromCollection
class OrdersExport implements FromView
{
    public function __construct(string $wStatus,string  $date1,string  $date2,string  $hotel_id)
    {
        $this->wStatus = $wStatus;
        $this->date1 = $date1;
        $this->date2 = $date2;
        $this->hotel_id = $hotel_id;
    }
    // public function collection()
    // {
    //     return Order::selectRaw("id, name, cin, bill")->whereRaw("month(cin)=4 AND status=2")->get();
    // }
    public function view(): View
    {
        $date1=$this->date1;
        $date2=$this->date2;
        $where="(".$this->wStatus.") AND (cin BETWEEN'".$this->date1."' AND '".$this->date2."') AND (hotel_id=".$this->hotel_id.")";
        $orders=Order::whereRaw($where)->orderByRaw('cin','DESC')->get();                
        return view('order.export',compact('orders','date1','date2'));
    }
}