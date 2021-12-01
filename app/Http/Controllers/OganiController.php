<?php

namespace App\Http\Controllers;

use App\Comment;
use App\InvoiceSequence;
use App\Model\OnlineStore\Category;
use App\OnlineCustomer;
use App\OnlineProduct;
use App\OnlineSale;
use App\OnlineTransaction;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;

class OganiController extends Controller
{
    public function index()
    {
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        $products = OnlineProduct::all()->take(4);
        return view('ogani.index', compact('categories', 'products'));

    }

    public function shop()
    {
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        $products = OnlineProduct::orderBy('name','asc')->get();
        return view('ogani.shop', compact('categories', 'products'));

    }

    public function item($id)
    {
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        $product = OnlineProduct::where('id','=',$id)->get();
        $productCategory = Category::where('id','=', $product[0]->category_id)->get();
        $relatedProducts = OnlineProduct::where('category_id','=',$product[0]->category_id)->get();
        $comments = Comment::where('product_id','=', $id)->get();
        return view('ogani.item', compact('categories', 'product', 'productCategory', 'relatedProducts', 'comments'));

    }

    public function category($id)
    {
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        $products = OnlineProduct::where('category_id','=',$id)->orderBy('name','asc')->get();
        $category = Category::where('id','=',$id)->get();
        //dd($category->count());
        return view('ogani.category', compact('categories', 'products', 'category'));
    }

    public function contact()
    {
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return view('ogani.contact', compact('categories'));
    }

    public function handleForm(Request $request)
    {

        $this->validate($request, ['name' => 'required', 'email' => 'required|email', 'message_body' => 'required|min:20']);

        $data = ['name' => $request->get('name') , 'email' => $request->get('email') , 'messageBody' => $request->get('message_body') ];

        Mail::send('email', $data, function ($message) use ($data)
        {
            $message->from($data['email'], $data['name']);
            $message->to('mabusamedusa@gmail.com', 'Admin')
                ->subject('The Embroidery Shop Website Feedback');
        });

        return redirect()
            ->back()
            ->with('success', 'Thank you for your feedback');

    }

    public function cart()
    {
        $cartCollection = \Cart::getContent();
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return view('ogani.cart', compact('categories'))->with(['cartCollection' => $cartCollection]);
    }

    public function update(Request$request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            ));
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return redirect()->route('ogani-cart', compact('categories'))->with('success', 'Cart updated!');
    }

    public function clear(){
        \Cart::clear();
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return redirect()->route('ogani-cart', compact('categories'))->with('success', 'Cart cleared!');
    }

    public function remove(Request $request){
        \Cart::remove($request->id);
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return redirect()->route('ogani-cart', compact('categories'))->with('success', 'Item removed!');
    }

    public function add(Request$request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                'slug' => $request->slug
            )
        ));
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return redirect()->route('ogani-cart', compact('categories'))->with('success', 'Product Added to Cart!');
    }

    public function checkout(){
        $cartCollection = \Cart::getContent();
        //dd($cartCollection);
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return view('ogani.checkout', compact('categories'))->with(['cartCollection' => $cartCollection]);
    }

    public function search(Request $request)
    {
        $products = OnlineProduct::where('name','LIKE', '%' . $request->term . '%')
            ->orWhere('description','LIKE', '%' . $request->term . '%')
            ->orWhere('details','LIKE', '%' . $request->term . '%')
            ->paginate(21);
        $term = $request->term;
        $categories = Category::orWhere('status','=',1)->orderBy('name','asc')->get();
        return view('ogani.search', compact('products', 'categories', 'term'));
    }

    public function orderOriginal(Request $request)
    {
        //dd($request->all());

        $buyer = new OnlineCustomer();
        $buyer->fname = $request->fname;
        $buyer->sname = $request->sname;
        $buyer->email = $request->email;
        $buyer->phoneNumber = $request->phone;
        $buyer->address1 = $request->address1;
        $buyer->address2 = $request->address2;
        $buyer->city = $request->city;
        $buyer->country = $request->country;

        if($buyer->save()){

        $sale = new OnlineSale();
        $sale->email = $request->email;
        $sale->invoiceNumber = Carbon::now()->timestamp;
        $sale->paymentMethod = $request->paymentMethod;
        $sale->subtotal = $request->subtotal;
        $sale->shipping_cost = $request->shipping_cost;
        $sale->total = $request->total;
        $sale->status = 'Pending';
        $sale->date = date("Y-m-d");
        $sale->orderNotes = $request->notes;
        $sale->paymentMethod = $request->payment;

        if($sale->save()){
            //dd(isset($_POST['my_product']));
            if(isset($_POST['my_product'])){
                foreach ($_POST['my_product'] as $key=>$id_raw_product):
                    $transaction = new OnlineTransaction();

                    $transaction->invoiceNumber = $sale->invoiceNumber;
                    $transaction->sale_id = $sale->id;
                    $transaction->product_id = $_POST['itemID'][$key];
                    $transaction->quantity = $_POST['quantity'][$key];
                    $transaction->price = $_POST['price'][$key];

                    $transaction->save();
                endforeach;

                $currentTransaction = OnlineTransaction::where('invoiceNumber','=',$sale->invoiceNumber )->get();

                \Cart::clear();

                $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
                return view('ogani.invoice', compact('categories', 'sale','currentTransaction','buyer'));
            }
        }

    }

    }

    public function order(Request $request)
    {
        //dd($request->all());

        $buyer = new OnlineCustomer();
        $buyer->fname = $request->fname;
        $buyer->sname = $request->sname;
        $buyer->email = $request->email;
        $buyer->phoneNumber = $request->phone;
        $buyer->address1 = $request->address1;
        $buyer->address2 = $request->address2;
        $buyer->city = $request->city;
        $buyer->province = $request->province;
        $buyer->country = $request->country;

        if($buyer->save()){

            $sale = new OnlineSale();
            $sale->email = $request->email;
            //$sale->invoiceNumber = Carbon::now()->timestamp;

            //create Invoice number/////////////////////////////////////////////////
            //$invoice = new InvoiceSequence();
            //$invoice->prefix = 'INV';
            //$invoice->save();
            //end index number creation////////////////////////////////////////////

            //call latest saved invoice and drop////////////////////////////////////
            //$invoice = DB::table('invoice_sequences')->latest()->first();
            //DB::delete("DELETE FROM invoice_sequences WHERE id=".$invoice->id);
            //end call latest saved invoice////////////////////////////////////////

            $sale->invoiceNumber = $this->createInvoice()->prefix.$this->createInvoice()->id;
            //dd($sale->invoiceNumber);

            $this->flashInvoiceDB();

            $sale->paymentMethod = $request->paymentMethod;
            $sale->subtotal = $request->subtotal;
            $sale->shipping_cost = $request->shipping_cost;
            $sale->total = $request->total;
            $sale->status = 0;
            $sale->date = date("Y-m-d");
            $sale->orderNotes = $request->notes;
            $sale->paymentMethod = $request->payment;



            if($sale->save()){
                //add transaction ID to customer record
                $this->addTransactionID($buyer->id, $sale->id);

                //dd(isset($_POST['my_product']));
                if(isset($_POST['my_product'])){
                    foreach ($_POST['my_product'] as $key=>$id_raw_product):
                        $transaction = new OnlineTransaction();

                        $transaction->invoiceNumber = $sale->invoiceNumber;
                        $transaction->sale_id = $sale->id;
                        $transaction->product_id = $_POST['itemID'][$key];
                        //dd($transaction->product_id);
                        $transaction->quantity = $_POST['quantity'][$key];
                        $transaction->price = $_POST['price'][$key];

                        $transaction->save();
                    endforeach;

                    $currentTransaction = OnlineTransaction::where('invoiceNumber','=',$sale->invoiceNumber )->get();

                    $email = $request->email;

                    \Cart::clear();

                    $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
                    $this->emailInvoice($currentTransaction, $email, $sale, $buyer);

                    //return redirect()->action('OganiController@complete', ['email' => $email]);
                    return redirect('ogani-complete/'.$email);

                }
            }

        }

    }

    public function emailInvoice( $currentTransaction, $email, $sale, $buyer){

        $data = [

        ];

        $transaction = $currentTransaction;
        //dd($transaction);
        $saleInfo = $sale;
        $buyerInfo = $buyer;
        $data["email"] = $email;
        $data["title"] = "Online Purchase Invoice";
        $data["body"] = "This is an Invoice for your online purchase.";
        $data['currentTransaction'] = $transaction;
        $data['sale'] = $saleInfo;
        $data['buyer'] = $buyerInfo;

        //dd($data);

        $pdf = PDF::loadView('invoice.invoicev3', $data );

        //dd($saleInfo);

        Mail::send('mail.invoice', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "invoice.pdf");
        });

    }

    public function complete($email){
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return view('ogani.purchaseComplete', compact('categories', 'email'));
    }

    protected function createInvoice(){
        $invoice = new InvoiceSequence();
        $invoice->prefix = 'INV';
        $invoice->save();

        $invoice = DB::table('invoice_sequences')->latest()->first();

        return $invoice;
    }

    protected function flashInvoiceDB(){
        $invoice = InvoiceSequence::getQuery()->delete();
        //$invoice->delete();

    }

    protected function addTransactionID($id, $transaction_id){
        $customer = OnlineCustomer::find($id);

        $customer->transaction_id = $transaction_id;

        $customer->save();

    }

    public function search2(Request $request){

        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        $data = OnlineProduct::where('name', 'LIKE', "%{$request->term}%")->get();

        return view('store.serach', compact('categories', 'data'));

    }
}
