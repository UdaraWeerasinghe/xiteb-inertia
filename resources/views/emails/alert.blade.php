<h1> Your Quetation is created</h1>
<p> Pls check the system for more details...</p>

<table>
    <thead style="width: 100%">
        <tr>
            <th class="px-2" align="left">Drug</th>
            <th class="px-2" align="right">Quantity</th>
            <th class="px-2" align="right">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prescription->quetation as $products)
            <tr>
                <th>{{ $products->product->name }}</th>
                <th>{{ $products->qty }}</th>
                <th>{{ $products->qty*$products->amount }}</th>
            </tr>
        @endforeach
    </tbody>
</table>