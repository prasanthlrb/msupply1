<div class="table_wrap">
    <table class="table_type_1">
										<thead>
											<tr>
                                                <th>Product Name </th>
												<th>No.of Kgs</th>
												<th>No.of Rods</th>
												<th>No.of Bundles</th>
                                            </tr>
                                            {{-- <a href="javascript:void(null)" id="popupClose" data-action="close" >X</a> --}}
                                            	<button class="close arcticmodal-close"></button>
										</thead>
                                        <tbody>
                                        
                                            @foreach($product as $pro)
											<tr>
                                            <td data-title="Heading 1">{{$pro->product_name}}</td>
                                                <td>
                                                <input type="text" onkeyup="noofkg({{$pro}})" id="noofkg{{$pro->id}}">
                                                </td>
                                                <td>
                                                <input type="text" onkeyup="noofrods({{$pro}})" id="noofrods{{$pro->id}}">
                                                </td>
                                                <td>
                                                <input type="text" onkeyup="noofbundle({{$pro}})" id="noofbundle{{$pro->id}}">
                                                </td>
                                            </tr>
                                            @endforeach
										

                                        </tbody>
                                                </table>
                                                        </div></div>
                                                              