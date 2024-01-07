<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Car;
use App\Customer;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->car = new Car();
        $this->customer = new Customer();
        $this->transaction = new Transaction();
    }

    public function index()
    {
        $data['transaction'] = Transaction::join('cars', 'cars.id', '=', 'transactions.car_id')
            ->join('users', 'users.id', '=', 'transactions.customer_id')
            ->select('transactions.*', 'cars.name as car_name', 'users.name as customer_name')
            ->where('transactions.status', 'proses')->get();
        return view('backend.transaction.index', $data);
    }

    public function history()
    {
        $data['transaction'] = Transaction::join('cars', 'cars.id', '=', 'transactions.car_id')
            ->join('users', 'users.id', '=', 'transactions.customer_id')
            ->select('transactions.*', 'cars.name as car_name', 'users.name as customer_name')
            ->where('transactions.status', 'selesai')->get();
        return view('backend.transaction.history', $data);
    }

    public function store(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug' => $request->name]);
            $customer_id = auth()->id();

            $car = $this->car->find($id);
            $data_transaction = [
                'invoice_no' => $this->generateInvoice(date('Y-m-d')),
                'car_id' => $id,
                'customer_id' => $customer_id,
                'rent_date' => $request->rent_date,
                'back_date' => $request->back_date,
                'price' => $car->price,
                'amount' => Carbon::parse($request->rent_date)->diffInDays($request->back_date) * $car->price,
                'status' => 'proses',
            ];

            $transaction = $this->transaction->create($data_transaction);
            $car->update(['status' => 'terpakai']);
            DB::commit();
            return redirect(url()->previous())->with('message', 'Berhasil Rental Kendaraan');
            // return redirect()->route('transaction.print',$transaction->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data = $this->transaction->find($id);
        return $data;
    }

    public function edit($id)
    {
        $data = $this->transaction->find($id);
        return view('backend.transaction.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug' => str_slug($request->name)]);
            $this->transaction->find($id)->update($request->all());
            DB::commit();
            return redirect()->route('transaction.index')->with('success-message', 'Data telah d irubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->transaction->destroy($id);
        return redirect()->route('transaction.index')->with('success-message', 'Data telah dihapus');
    }

    public function print($id)
    {
        $data = $this->transaction->join('users', 'users.id', '=', 'transactions.customer_id')->select('transactions.*', 'users.name')->find($id);
        $pdf = PDF::loadView('backend.transaction.cetak', compact(['data']));
        return $pdf->stream($data->invoice_no . '.pdf');
    }

    public function complete(Request $request, $id)
    {
        $transaction = $this->transaction->find($id);
        $transaction->update([
            'return_date' => $request->return_date,
            'status' => 'selesai',
            'penalty' => Carbon::parse($transaction->back_date)->diffInDays($request->return_date) * $transaction->car->penalty,
            'amount' => Carbon::parse($transaction->back_date)->diffInDays($request->return_date) * $transaction->car->penalty + $transaction->amount

        ]);
        $this->car->find($transaction->car_id)->update(['status' => 'tersedia']);
        return redirect()->route('transaction.index')->with('success-message', 'Data telah disimpan');
    }

    private function generateInvoice($date)
    {
        $tanggal = substr($date, 8, 2);
        $bulan = substr($date, 5, 2);
        $tahun = substr($date, 2, 2);
        $transaction = $this->transaction->whereDate('created_at', $date)->get();
        $no = 'TRX-' . $tanggal . $bulan . $tahun . '-' . sprintf('%05s', $transaction->count() + 1);
        return $no;
    }

    public function export(Request $request)
    {
        $transaction = new TransactionExport();
        $transaction->setDate($request->from, $request->to);
        return Excel::download($transaction, 'laporan_trx_' . $request->from . '_' . $request->to . '.xlsx');
    }
}
