<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiles Stock Page</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
        <div class="row clearfix">
                <div class="col-xs-12 col-md-12" style="padding-top:10px">
                    @if(count($data) >0)
                    <table style="width:100%" class="stock-available-table table table-bordered" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <td colspan="2" class="bg-primary" style="padding:15px;">
                                    <div class="row">
                                        <div class="col-md-7 text-right"><span>Stock and Transit Details</span></div>
                                        <div class="col-md-5 text-right"><span>Last Update: {{$data[0]->updated_at}}</span></div>

                                    </div>


                                </td>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                        <td colspan="2" class="text-center" style="padding-left:0;padding-right:0;padding-top:0;">
                                        <p style="font-size:3em;margin-bottom:0px;" class="text-center">Stock: <blinks class="font-weight-bold text-center">{{$data[0]->stock_quantity}}</blinks></p>

                                        </td>
                                    </tr>
                            <tr>
                                <td colspan="2" class="text-center" style="border:0px !important;padding:2px;">
                                <img src="http://www.kagtech.net/KAGAPP/Partsupload/{{$data[0]->product_image}}" class="prodimg">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <table style="width:100%;" class="product-specs-table table table-bordered" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <td colspan="2" class="bg-primary text-center" style="padding:15px;color:#fff;">
                                        Product Specification
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Brand</td>
                                    <td class="font-weight-bold">KAG</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                <td class="font-weight-bold">{{$data[0]->product_name}}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td class="font-weight-bold">{{$data[0]->product_description}} </td>
                                </tr>
                                {{-- <tr>
                                    <td>Category</td>
                                    <td class="font-weight-bold">Floor</td>
                                </tr> --}}
                                <tr>
                                    <td>Size</td>
                                    <td class="font-weight-bold">{{$data[0]->width}}</td>
                                </tr>
                                <tr>
                                    <td>Weight</td>
                                    <td class="font-weight-bold">{{$data[0]->weight}}</td>
                                </tr>
                                <tr>
                                    <td>No of Pieces</td>
                                    <td class="font-weight-bold">{{$data[0]->items}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @else
                        <h2 style="text-align:center">Product Not Found</h2>
                        @endif
                </div>

        </div>
</div>
</body>
</html>
