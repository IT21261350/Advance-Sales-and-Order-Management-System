<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Validation\Rule;
use App\Models\Customer;
use App\Models\Product;
use App\Models\FreeIssue;
use App\Models\Order;
use App\Models\Discount;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrderController extends Controller
{

    // ------------------------------- Functions of Discount View -------------------------------

    public function discountView() {
        $discount = Discount::all();
        return view('discounts.dView', ['discount' => $discount]);

    }


    public function Discount() {
        $products = Product::all();
        return view('discounts.Discount', ['products' => $products]);
    }

    public function disStore(Discount $discount,Request $request) {

        //dd( $request );

        $request->validate([
            'disLabel' => 'required|string',
            'pro' => ['required', Rule::unique('discounts', 'product')->ignore($discount->id)],
            'proQuan' => 'required|numeric',
            'dAmt' => 'nullable|numeric'
        ], [
            'required' => 'The :attribute field is required.', 
            'numeric' => 'The :attribute must be a number.', 
            'unique' => 'The :attribute has already been taken.'
        ]);

        $disLabel =  $request->input('disLabel');
        $pro =  $request->input('pro');
        $proQuan =  $request->input('proQuan');
        $dAmt = $request->input('dAmt');

        // Create a FreeIssue model instance
        $discount = new Discount();
        
        // Assign other input data to the model attributes
        $discount->disLabel = $disLabel;
        $discount->product = $pro;
        $discount->proQuan = $proQuan;
        $discount->dAmount = $dAmt;
        $discount->lowLimit = $proQuan;

        // Save the model to the database
        $discount->save();

        return redirect(route('oRder.discountView'))->with('success', 'Free Issue Added successfully');

    }

    public function edit(Discount $discount) {
        //dd($customer);
        return view('discounts.dEdit', ['discount' => $discount]);
    }

    public function update(Discount $discount, Request $request) {
        // Validate incoming request if needed
    
        // Retrieve the specific FreeIssue record by its ID
        $discountToUpdate = Discount::find($discount->id);
    
        // Update the fields with the new values from the request
        $discountToUpdate->disLabel = $request->input('disLabel');
        $discountToUpdate->product = $request->input('pro');
        $discountToUpdate->proQuan = $request->input('proQuan');
        $discountToUpdate->dAmount = $request->input('dAmt');
        $discountToUpdate->lowLimit = $request->input('proQuan');
    
        // Save the updated record to the database
        $discountToUpdate->save();
    
        return redirect()->route('oRder.discountView')->with('success', 'Free Issue Updated Successfully');
    }

    public function delete(Discount $discount) {
        $discount -> delete();
        return redirect(route('oRder.discountView'))->with('success', 'Free Issue Deleted Successfully');
    }










    // ------------------------------- Functions of Order View -------------------------------

    public function oView() {
        // Logic to fetch orders or other necessary data
        $orders = Order::all(); // Example: Fetch orders from your database
    
        $netAmo = DB::table('orders')->sum('totalAmt');
    
        return view('orders.oView', [
            'orders' => $orders,
            'netAmo' => $netAmo // Adding netAmo variable to the data passed to the view
        ]);
    }

    public function placingOrder(Request $request) {

        //dd( $request );
        $products = Product::all();
        $customers = Customer::all();

        return view('orders.placingOrder', [
            'products' => $products,
            'customers' => $customers
        ]);

    }

    public function getProductCode(Request $request)
    {

        // dd($request->all());
        $selectedProduct = $request->input('product');
        $productCode = Product::where('proName', $selectedProduct)->value('proCode');  

            if ($productCode) {
                return response()->json($productCode);
            } else {
                return response()->json('Product not found', 404);
            }
    }

    public function getProductPrice(Request $request)
    {

        // dd($request->all());
        $selectedProduct = $request->input('product');
        $productPrice = Product::where('proName', $selectedProduct)->value('price');  

            if ($productPrice) {
                return response()->json($productPrice);
            } else {
                return response()->json('Product not found', 404);
            }
    }

    public function getDiscountLimit(Request $request)
    {

        // dd($request->all());
        $selectedProduct = $request->input('product');
        $discountLimit = Discount::where('product', $selectedProduct)->value('lowLimit');  

            if ($discountLimit) {
                return response()->json($discountLimit);
            } else {
                return response()->json('Product not found', 404);
            }
    }

    public function getProductDiscount(Request $request)
    {

        // dd($request->all());
        $selectedProduct = $request->input('product');
        $productDiscount = Discount::where('product', $selectedProduct)->value('dAmount');  

            if ($productDiscount) {
                return response()->json($productDiscount);
            } else {
                return response()->json('Product not found', 404);
            }
    }

    public function getFreeQuantity(Request $request)
    {

        // dd($request->all());
        $selectedProduct = $request->input('product');
        $freeQuan = FreeIssue::where('pro', $selectedProduct)->value('fQuan');  

            if ($freeQuan) {
                return response()->json($freeQuan);
            } else {
                return response()->json('Product not found', 404);
            }
    }

    public function getLowerLimit(Request $request)
    {

        // dd($request->all());
        $selectedProduct = $request->input('product');
        $lowLimit = FreeIssue::where('pro', $selectedProduct)->value('lLimit');  

            if ($lowLimit) {
                return response()->json($lowLimit);
            } else {
                return response()->json('Product not found', 404);
            }
    }

    public function getUpperLimit(Request $request)
    {

        // dd($request->all());
        $selectedProduct = $request->input('product');
        $upLimit = FreeIssue::where('pro', $selectedProduct)->value('uLimit');  

            if ($upLimit) {
                return response()->json($upLimit);
            } else {
                return response()->json('Product not found', 404);
            }
    }
    
    public function store(Request $request)
    {
        // dd( $request );

        if ($request->has('save')) {

            $x = 1;
            
            $count = DB::table('orders')->count();
            $som0 = $count - 1;
            
            $result2 = DB::table('orders')->orderBy('orderCode')->skip($som0)->take(1)->get();
            $som3 = $result2->isEmpty() ? null : $result2[0]->orderCode;
            
            if ($som3 !== null) {
                $x = $som3 + 1;
            } else {
                $x = 1;
            }

            foreach ($request->input('no') as $i => $value) {
                $name = $request->input('name');
                $prod = $request->input('prod')[$i];
                $price = $request->input('price')[$i];
                $discountLimit = $request->input('discountLimit')[$i];
                $discount = $request->input('discount')[$i];
                $quantity = $request->input('pQuan')[$i];
                $freeQty = $request->input('freeQuan')[$i];
                $totalAmt = $request->input('amount')[$i];
                
                $naMe = end($name);
                
                date_default_timezone_set('Asia/Colombo');
                $currentDateTime = now();

                $saveData = [
                    'orderCode' => $x,
                    'cName' => $naMe,
                    'pProduct' => $prod,
                    'order_date' => $currentDateTime,
                    'order_time' => $currentDateTime,
                    'price' => $price,
                    'discountLimit' => $discountLimit,
                    'discount' => $discount,
                    'quantity' => $quantity,
                    'freeQty' => $freeQty,
                    'totalAmt' => $totalAmt,
                ];

                DB::table('orders')->insert($saveData);
            }

            return redirect(route('order.oView'))->with('success', 'Order have Added successfully');
        }
    }

    public function convertEx(Request $request)
    {
        if ($request->has("submit")) {
            $orders = Order::all();

            if ($orders->isNotEmpty()) {
                $fileName = 'Order_Reports.csv';
                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename=' . $fileName,
                ];

                $output = fopen('php://temp', 'w');

                // Write CSV headers
                fputcsv($output, [
                    'Customer Name',
                    'Product Name',
                    'Order ID',
                    'Price',
                    'Product Quantity',
                    'Free Quantity',
                    'Amount',
                ]);

                // Write CSV rows
                foreach ($orders as $order) {
                    fputcsv($output, [
                        $order->cName,
                        $order->pProduct,
                        $order->orderCode,
                        $order->price,
                        $order->quantity,
                        $order->freeQty,
                        $order->totalAmt,
                    ]);
                }

                rewind($output);
                $csv = stream_get_contents($output);
                fclose($output);

                return response($csv, 200, $headers);
            } else {
                return "<h3 style='color:red'>No Data Found!</h3>";
            }
        }
    }

    public function orderView()
    {
        $orders = Order::all();
        return view('orders.orderView', ['orders' => $orders]);
    }

    public function generateHTMLContentForOrder($selectedOrders)
    {
        $orders = Order::whereIn('orderCode', $selectedOrders)->get();

        if ($orders->isNotEmpty()) {
            $htmlContent = '<html><head><style>
                    .total-amount-box {
                        border: 1px solid #000;
                        padding: 1.5px;
                    }
                    .bold-text {
                        font-weight: bold;
                    }
                    .centered-text {
                        text-align: center;
                    }
                    .page {
                        border: 1px solid #000; /* Add border style for each page */
                        padding: 10px; /* Optional: Add padding to the page */
                    }
                    </style></head><body>';

            $groupedOrders = $orders->groupBy('orderCode');

            foreach ($groupedOrders as $orderGroup) {
                $htmlContent .= '<div class="page">'; // Change <page> to <div class="page">
                $htmlContent .= '<div class="centered-text"><h1>Order Number : ' . $orderGroup[0]->orderCode . '</h1></div>';
                $htmlContent .= '<p><strong class="bold-text">Customer Name : </strong> <span class="total-amount-box"> ' . $orderGroup[0]->cName . ' </span></p>';
                $htmlContent .= '<p><strong class="bold-text">Order Date : </strong> <span class="total-amount-box"> ' . $orderGroup[0]->order_date . ' </span></p>';
                $htmlContent .= '<p><strong class="bold-text">Order Time : </strong> <span class="total-amount-box"> ' . $orderGroup[0]->order_time . ' </span></p>';
                $htmlContent .= '<table border="1">';
                $htmlContent .= '<thead><tr><th>Count</th><th> Product Name </th><th> Price </th><th> Discount (%)</th><th> Quantity </th><th> Free Quantity </th><th> Amount </th></tr></thead>';
                $htmlContent .= '<tbody>';

                $rowCount = 1; // Initialize row count for each order group

                $totalAmount = 0; // Initialize total amount for each order group

                foreach ($orderGroup as $order) {
                    $htmlContent .= '<tr>';
                    $htmlContent .= '<td>' . $rowCount++ . '</td>'; // Display row count
                    $htmlContent .= '<td>' . $order->pProduct . '</td>';
                    $htmlContent .= '<td>' . $order->price . '</td>';
                    $htmlContent .= '<td>' . $order->discount . '</td>';
                    $htmlContent .= '<td>' . $order->quantity . '</td>';
                    $htmlContent .= '<td>' . $order->freeQty . '</td>';
                    $htmlContent .= '<td>Rs. ' . $order->totalAmt . '.00</td>';
                    $htmlContent .= '</tr>';
                    
                    $totalAmount += $order->totalAmt; // Accumulate total amount
                }
                
                $htmlContent .= '</tbody></table>';
                
                // Display total amount for the order group inside a box with bold text
                $htmlContent .= '<p><strong class="bold-text">Total Amount for this Order:</strong> <span class="total-amount-box"> Rs. ' . $totalAmount . '.00 </span></p>';
                
                $htmlContent .= '</page>';
                $htmlContent .= '</div>'; // Close the page div

                // Add a page break between orders (optional)
                $htmlContent .= '<div style="page-break-after: always;"></div>';
            }
            
            $htmlContent .= '</body></html>';

            return $htmlContent;
        }
        
        return null; // Return null if no orders are found
    }

        public function generateHTMLContentForSummary($selectedOrders)
        {
            $orders = Order::whereIn('orderCode', $selectedOrders)->get();
        
            if ($orders->isNotEmpty()) {
                $htmlContent = '<html><head><style>
                    .total-amount-box {
                        border: 1px solid #000;
                        padding: 1.5px;
                    }
                    .bold-text {
                        font-weight: bold;
                    }
                    .centered-text {
                        text-align: center;
                    }
                    .page {
                        border: 1px solid #000; /* Add border style for each page */
                        padding: 10px; /* Optional: Add padding to the page */
                    }
                    </style></head><body>';
        
                $groupedOrders = $orders->groupBy('orderCode');
        
                $htmlContent .= '<div class="centered-text"><h1>Order Summary</h1></div>';
                $htmlContent .= '<hr>';
        
                $allOrderCodes = [];
                $allCustomerNames = [];
                $allOrderDates = [];
                $totalAmount = 0; // Initialize total amount for all orders
                $rowCount = 0; // Initialize row count for all orders
                $totalCountQuantity = 0; // Initialize total count for quantity
                $totalCountFreeQty = 0;
                $totalNetAmount = 0;
        
                foreach ($groupedOrders as $orderGroup) {
                    $orderCode = $orderGroup[0]->orderCode;
                    $customerNames = [];
                    $orderDates = [];
        
                    foreach ($orderGroup as $order) {
                        $customerNames[] = $order->cName;
                        $orderDates[] = $order->order_date;
        
                        // Increment row count for each order
                        $rowCount++;
                        $totalAmount += $order->totalAmt; // Accumulate total amount for each order
                        $totalCountQuantity += $order->quantity; // Accumulate total count for quantity
                        $totalCountFreeQty += $order->freeQty; 
                    }
        
                    $allOrderCodes[] = $orderCode;
                    $allCustomerNames[] = implode(', ', array_unique($customerNames));
                    $allOrderDates[] = implode(', ', array_unique($orderDates));
                }
        
                $htmlContent .= '<p><strong class="bold-text">Order Code(s): </strong>';
                $htmlContent .= '<span class=""> ' . implode(', ', $allOrderCodes) . ' </span></p>';
        
                $htmlContent .= '<p><strong class="bold-text">Customer Name(s): </strong>';
                $htmlContent .= '<span class=""> ' . implode(', ', $allCustomerNames) . ' </span></p>';
        
                $htmlContent .= '<p><strong class="bold-text">Order Date(s): </strong>';
                $htmlContent .= '<span class=""> ' . implode(', ', $allOrderDates) . ' </span></p>';
        
                $htmlContent .= '<hr>';
                $htmlContent .= '<br>';

                $productPrices = [];

                foreach ($orders as $order) {
                    $productName = $order->pProduct;
                    if (!isset($productPrices[$productName])) {
                        // Replace 'YourProductModel' with the appropriate model name for your products
                        $product = Product::where('proName', $productName)->first();

                        if ($product) {
                            $productPrices[$productName] = $product->price; // Assuming 'price' is the column for product price in your database
                        } else {
                            $productPrices[$productName] = 'N/A';
                        }
                    }
                }

                // Calculate total quantity and free quantity for each product
                $productQuantities = [];
                $productFreeQuantities = [];

                foreach ($orders as $order) {
                    $productName = $order->pProduct;
                    $quantity = $order->quantity;
                    $freeQty = $order->freeQty;

                    if (!isset($productQuantities[$productName])) {
                        $productQuantities[$productName] = 0;
                        $productFreeQuantities[$productName] = 0;
                    }

                    $productQuantities[$productName] += $quantity;
                    $productFreeQuantities[$productName] += $freeQty;
                }

                // Display total quantity and free quantity for each product in the table
                $htmlContent .= '<div class="centered-text">';
                $htmlContent .= '<h3>Total Quantity, Free Quantity, and Net Amount for Each Product</h3>';
                $htmlContent .= '<div style="overflow-x:auto;">'; 
                $htmlContent .= '<table border="1" style="margin: 0 auto;">'; 
                $htmlContent .= '<thead><tr><th>Count</th><th>Product Name</th><th>Price</th><th>Total Quantity Sold</th><th>Total Free Quantity</th><th>Net Amount</th></tr></thead>';
                $htmlContent .= '<tbody>';

                $rowCounts = 1;

                foreach ($productQuantities as $product => $totalQuantity) {
                    $price = isset($productPrices[$product]) ? $productPrices[$product] : 'N/A';
                    $totalFreeQty = isset($productFreeQuantities[$product]) ? $productFreeQuantities[$product] : 0;
                    $netAmount = $price !== 'N/A' ? $price * $totalQuantity : 0;

                    $totalNetAmount += $netAmount;

                    $htmlContent .= '<tr>';
                    $htmlContent .= '<td>' . $rowCounts++ . '</td>';
                    $htmlContent .= '<td>' . $product . '</td>';
                    $htmlContent .= '<td>';

                    if ($price !== 'N/A') {
                        $htmlContent .= 'Rs. ' . $price . '.00';
                    } else {
                        $htmlContent .= $price;
                    }

                    $htmlContent .= '</td>';
                    $htmlContent .= '<td>' . $totalQuantity . '</td>';
                    $htmlContent .= '<td>' . $totalFreeQty . '</td>';
                    $htmlContent .= '<td>';

                    if ($netAmount !== 'N/A') {
                        $htmlContent .= 'Rs. ' . number_format($netAmount ?? '', 2) . '' ;
                    } else {
                        $htmlContent .= $netAmount;
                    }

                    $htmlContent .= '</td>';
                    $htmlContent .= '</tr>';
                }

                $htmlContent .= '</tbody></table>';
                $htmlContent .= '</div>'; 
                $htmlContent .= '</div>';

                $htmlContent .= '<br>';

                $discount = $totalNetAmount - $totalAmount;

                $htmlContent .= '<p><strong>Total Quantity : </strong> ' . $totalCountQuantity . '</p>';
                $htmlContent .= '<p><strong>Total Free Quantity : </strong> ' . $totalCountFreeQty . '</p>';
                $htmlContent .= '<p><strong>Total of the net amount - Discount : </strong> Rs.  ' . number_format($totalNetAmount ?? '', 2) . ' - Rs. ' . number_format($discount ?? '', 2) . '</p>';
                $htmlContent .= '<p><strong>Calculated Total Amount for Orders : </strong> Rs. ' . number_format($totalAmount ?? '', 2) . '</p>';

                $htmlContent .= '</body></html>';

                return $htmlContent;
            }
        
            return null;
        }

    public function generatePDFs(Request $request)
    {
        if ($request->isMethod('post')) {
            $selectedOrders = $request->input('selected_orders');

            if ($selectedOrders && count($selectedOrders) > 0) {
                $htmlContent = $this->generateHTMLContentForOrder($selectedOrders);

                if ($htmlContent) {
                    $options = new Options();
                    $options->set('isRemoteEnabled', true);
                    $dompdf = new Dompdf($options);

                    $dompdf->loadHtml($htmlContent);
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();

                    return $dompdf->stream('Orders_Details.pdf');
                }
            }

            return redirect()->back()->with('error', 'No orders selected or found!');
        }

        // If it's not a POST request, do something else, maybe redirect somewhere
        return redirect('orders.orderView'); // Redirect to home or appropriate page
    }

    public function generatePDFsSummary(Request $request)
    {
        if ($request->isMethod('post')) {
            $selectedOrders = $request->input('selected_orders');

            if ($selectedOrders && count($selectedOrders) > 0) {
                $htmlContent = $this->generateHTMLContentForSummary($selectedOrders);

                if ($htmlContent) {
                    $options = new Options();
                    $options->set('isRemoteEnabled', true);
                    $dompdf = new Dompdf($options);

                    $dompdf->loadHtml($htmlContent);
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();

                    return $dompdf->stream('Order_Summary.pdf');
                }
            }

            return redirect()->back()->with('error', 'No orders selected or found!');
        }

        // If it's not a POST request, do something else, maybe redirect somewhere
        return redirect('orders.orderView'); // Redirect to home or appropriate page
    }

    public function detailedView($orderCode) {
        // Fetch the details of the specific orders based on the orderCode
        $orders = Order::where('orderCode', $orderCode)->get();
        
        if ($orders->isEmpty()) {
            // Handle the case when no orders are found for the given orderCode
            return redirect()->back()->with('error', 'Orders not found');
        }
        
        // Return the view with the order details
        return view('orders.detailedView', ['orders' => $orders]);
    }

}
