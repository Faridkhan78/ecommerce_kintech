@include('frontend.header')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">

            @if (!empty($datas))
                {{-- @dd($datas); --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>                       
                                               
                        {{-- @if(session()->has('user'))   --}}
                        @if(!Auth::check())
                        @php
                            $t_price = [];
                        @endphp
                         @foreach (Session('cart',[]) as $data) 
                         {{-- @dd(Session('cart',[])); --}}

                         {{-- @foreach (Session::get('cart') as $data)  --}}
                        {{-- @dd(Session::get('cart')) --}}
                        
                         {{-- @if(Session::get('cart')) --}}
                         {{-- @if (Session::has('cart')) --}}
                        {{-- @if(session('cart', []) as $datas) --}}
                         {{-- // @dd(cart) --}}
                            {{-- @foreach ($datas as $data) --}}
                                  {{-- @dd($data)            --}}
                                <tr id="cart_row_{{ $data['prodid'] }}">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            {{-- <img src="{{ asset('user/img/vegetable-item-3.png') }}" --}}
                                            {{-- if(@isset($datas['image'])
                                                
                                            @endisset)
                                            <img src="{{ asset('product_images/' .$data ['image']) }}"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                alt=""> --}}

                                                @if(isset($data['image']) && !empty($data['image']))
                                                <img src="{{ asset('product_images/' . $data['image']) }}" alt="Image" class="img-fluid">
                                                @else
                                                <img src="{{ asset('product_images') }}" alt="Default Image" class="img-fluid">
                                                @endif   
                                                  {{-- @dd($data['image']); --}}
                                        </div>
                                    </th>
                                    
                                    <td>
                                        <p class="mb-0 mt-4">{{ $data['name']}}</p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">{{ $data['price'] }}</p>
                                    </td>

                                    <td>
                                                                                {{-- @dd($data) --}}
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border"
                                                    onclick="decrementSession({{ $data['prodid'] }})">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm text-center border-0"
                                                value="{{ $data['quantity'] }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border"
                                                    onclick="incrementSession({{ $data['prodid'] }})">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                            $t_price[] = $totalPrice = $data['quantity'] * $data['price'];
                                    @endphp 

                                    <td>
                                        {{-- <td>{{ $item->quantity * $item->product->price }}</td> --}}
                                        <p class="mb-0 mt-4">{{ $totalPrice }}</p>

                                    </td>
                                   {{-- <td><a href="/removecart{{$data->id}}"class="btn btn-warning" >Remove From Cart</a></td>  --}}
                                    {{-- <td><a href="{{ route('removecart', $data->id)}}" class="btn btn-warning" >Remove From Cart</a></td>   --}}
                                    

                                    {{-- // start  --}}
                                    {{-- <form action="{{ route('session.delete') }}" method="POST">
                                        @csrf
                                        <td>
                                            {{-- @dd($data) --}}
                                            {{-- <input type="hidden" name="id" value="{{ $data['prodid']}}">
                                            
                                            <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4 delete-cart">
                                                <i class="fa fa-times text-danger"></i>    
                                            </button>
                                        </td>
                                    </form>  --}} 

                                       {{-- end --}}

                                            {{-- session delete --}}
                                            
                                       {{-- <form id="cart_row_{{ $data['prodid'] }}">
                                        {{-- <td>{{ $data['name'] }}</td>
                                        <td>{{ $data['price'] }}</td> --}}
                                        {{-- @csrf --}}
                                        {{-- <td> --}}
                                            {{-- <form class="delete-cart-form" data-url="{{ route('session.delete') }}" method="POST"> --}}
                                                {{-- @csrf --}}
                                                {{-- <input type="hidden" name="id" value="{{ $data['prodid'] }}">

                                                <button type="button" class="btn btn-md rounded-circle bg-light border mt-4 delete-cart" data-prodid="{{ $data['prodid'] }}">
                                                    <i class="fa fa-times text-danger"></i>    
                                                </button> --}}

                                            {{-- </form> --}}

                                        {{-- </td> --}}
                                       {{-- </form>  --}}

                                       {{-- <form id="cart_row_{{ $data['prodid'] }}" data-id="{{ $data['prodid'] }}"  class="delete-cart-form" action="{{ route('session.delete') }}" method="POST"> --}}
                                             {{-- @csrf --}}
                                             {{-- @method('DELETE') --}}
                                             <td>
                                            <input type="hidden" name="id" value="{{ $data['prodid'] }}">

                                            <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4 delete-cart" data-id="{{ $data['prodid'] }}">
                                                <i class="fa fa-times text-danger"></i>    
                                            </button>
                                             </td>
                                        {{-- </form> --}}
                                    

                                    {{-- <form id="cart_row_{{ $data['prodid'] }}">
                                        {{-- <td>{{ $data['product_name'] }}</td> --}}
                                        {{-- <td>
                                            <button type="button" class="btn btn-md rounded-circle bg-light border mt-4 delete-cart" 
                                                data-id="{{ $data['prodid'] }}">
                                                <i class="fa fa-times text-danger"></i>    
                                            </button>
                                        </td> --}}
                                    {{-- </form> --}} 

                                    {{-- <form method="post" action="{{ route('delete_cartlist', $data->id) }}">
                                        {{-- <form> --}}
                                         {{-- @csrf
                                        @method('DELETE') <!-- Spoof DELETE method -->
                                        <td> --}}
                                            {{-- <button type="submit"
                                                class="btn btn-md rounded-circle bg-light border mt-4">
                                                <i class="fa fa-times text-danger"></i>
                                            </button> --}}
                                        {{-- </td>  --}}
                                     {{-- </form>    --}}

                                    {{-- <form method="post" action="">
                                    <td>
                                        <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                </form> --}}

                                    {{-- "{{url('delete-user',$user->id)}}" --}}

                                </tr>
                            @endforeach
                        @else
                        {{-- if user login --}}
                        @php
                            $t_price = [];
                        @endphp
                         {{-- @foreach (Session::get('cart') as $data) --}}

                        @foreach ($datas as $data)
                         {{-- @dd($data) --}}
                        <tr> 
                             <th scope="row">
                                <div class="d-flex align-items-center">
                                     {{-- <img src="{{ asset('user/img/vegetable-item-3.png') }}"  --}}
                                     <img src="{{ asset('product_images/' .$data->image) }}"
                                        class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                        alt=""> 
                                 </div> 
                             </th>
                            <td>
                                <p class="mb-0 mt-4">{{ $data->name }}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{ $data->price }}</p>
                            </td> 
                            {{-- @dd($data) --}}
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border"
                                         onclick="decrementSession({{ $data->cartid }})"
                                        >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    {{-- @dd($data) --}}
                                    <input type="text"
                                        class="form-control form-control-sm text-center border-0"
                                        id="quantity-{{ $data->prodid}}" 
                                        value="{{$data->quantity}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border"
                                        onclick="incrementSession({{ $data->cartid}})"
                                        >
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        {{-- @dd($data->cartid) --}}
                                    </div>
                                </div>
                            </td> 
                            <td>
                                 @php
                                     $t_price[] = $totalPrice = $data->quantity * $data->price;
                                @endphp 

                                 {{-- <td>{{ $item->quantity * $item->product->price }}</td>  --}}
                                 <p class="mb-0 mt-4">{{ $totalPrice }}</p>
                            </td>
                                                        
                             <form method="post" action="{{ route('delete_cartlist',$data->cartid)}}"> 
                                {{-- <form>  --}}
                                 @csrf
                                 @method('DELETE') 
                                <td>
                                     <button type="button"
                                        class="btn btn-md rounded-circle bg-light border mt-4">
                                        <i class="fa fa-times text-danger"></i>
                                    </button> 

                                    {{-- <button type="button" class="btn btn-md rounded-circle bg-light border delete-cart"
                                         data-prodid="{{ $data['prodid'] }}" data-url="{{ route('session.delete') }}">
                                          <i class="fa fa-times text-danger"></i>
                                    </button> --}}
                                    {{-- <a href="{{ route('delete_cartlist',['id'=>$data->prodid])}}"class="btn btn-danger" >x</a> --}}
                                </td>   
                              </form>
                                
                              {{-- @dd($data->cartid)  --}}
                              {{-- @dd($data->prodid)         --}}

                               {{-- <form method="post" action="">
                            <td>
                                <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>
                        </form>   --}}

                            {{-- "{{url('delete-user',$user->id)}}" --}}

                        </tr>
                         @endforeach
                           
                        @endif

                    </tbody>
                </table>
        </div>
        
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Grandtotal:</h5>

                            {{-- <p class="mb-0"> {{ array_sum(array_column($datas, 'quantity')) }}</p> --}}
                             {{-- <p class="mb-0"> {{array_sum($totalPrice)}}</p> --}}

                             @php
                                $totalPrice = array_sum($t_price);
                            @endphp 

                             <p class="mb-0">
                                 {{-- <b>{{ $datas->sum(fn($data) => $data->quantity * $data->price) }}</b>  --}}
                                 <b>{{ $totalPrice }}</b>
                                 {{-- @dd($totalPrice) --}}
                            </p>  

                        </div>                    

                    @endif
                    {{-- <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                        type="button">Proceed Checkout</button> --}}
                    <div class="">
                        <a class="btn btn-success" href="/checkout">Continue</a>
                        {{-- <a class="btn btn-success" href="/orderplace">Continue</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  Cart sesstion Page End -->
@include('frontend.footer')
<script>
function incrementSession(prodid) {
    // dd(1);
    // console.log(prodid);
    fetch("{{ route('cart.increment') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json",
        },

        body: JSON.stringify({ prodid: prodid }),

    })
        .then((response) => response.json())
        // dd(response);

        .then((data) => {
            if (data.success) {
                location.reload(); // Reload the page to update the quantity
            }
        })

        .catch((error) => console.error("Error:", error));
}
// function incrementSession(prodid) {
//     fetch("{{ route('cart.increment') }}", {
//         method: "POST",
//         headers: {
//             "X-CSRF-TOKEN": "{{ csrf_token() }}",
//             "Content-Type": "application/json",
//         },
//         body: JSON.stringify({ prodid: prodid }),
//     })
//     .then((response) => response.json())
//     .then((data) => {
//         if (data.success) {
//             // Update the quantity dynamically without reloading
//             let quantityElement = document.getElementById(`quantity-${prodid}`);
//             if (quantityElement) {
//                 quantityElement.innerText = data.new_quantity; // Update quantity
//             }
//         }
//     })
//     .catch((error) => console.error("Error:", error));
// }

function decrementSession(prodid) {
    fetch("{{ route('cart.decrement') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ prodid: prodid }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                location.reload(); // Reload the page to update the quantity
            }
        })
        .catch((error) => console.error("Error:", error));
}

</script>
{{-- login  --}}
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
        // Increment quantity
        document.querySelectorAll(".btn-plus").forEach(button => {
            button.addEventListener("click", function () {
                const prodId = this.dataset.prodid;
    
                fetch("{{ route('quantity.increment_l') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({ prodid: prodId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`quantity-${prodId}`).value = data.quantity;
                        } else {
                            alert(data.message || "Error incrementing quantity");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    
        // Decrement quantity
        document.querySelectorAll(".btn-minus").forEach(button => {
            button.addEventListener("click", function () {
                const prodId = this.dataset.prodid;
    
                fetch("{{ route('quantity.decrement_l') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({ prodid: prodId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`quantity-${prodId}`).value = data.quantity;
                        } else {
                            alert(data.message || "Error decrementing quantity");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    });

</script> --}}

{{-- session deleting recores --}}

{{-- "<script type='text/javascript'>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
  </script>"; --}}

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- // original --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
 <script>
    $(document).ready(function() {

     $(document).on('click','.delete-cart', function(event) {
            // event.preventDefault(); 
           
            let prodId = $(this).data('id'); // Get product ID
                // alert(prodId);
                $.ajax({
                    type: "POST",
                    url: "{{ route('session.delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: prodId
                    },
                    success: function(response) {
                            //  alert(response);
                        if (response) {
                          $('#cart_row_' + prodId).remove(); // Remove row from UI   

                            //  console.log('removeItem',$removedItem)
                            // $(id).remove();
                        } else {
                            alert("Failed to delete item1.");
                        }
                    },
                    error: function(xhr) {
                        alert("Something went wrong.");
                    }

                });
        });
    });
    // $(document).ready(function() {
    // $(document).on('click', '.delete-cart', function(event) {
    //     event.preventDefault();
    //     let prodId = $(this).data('prodid'); 
    //     // console.log(prodId);
    //     alert(1);
    //     $.ajax({
    //         type: "POST",
    //         url: "{{ route('session.delete') }}", 
    //         data: {
    //             _token: "{{ csrf_token() }}", 
    //             id: prodId
    //         },
    //         success: function(response) {
    //             if (response.success) {
    //                 $('#cart_row_' + prodId).fadeOut("slow", function() { 
    //                     $(this).remove(); 
    //                 });
    //             } else {
    //                 alert("Failed to delete item.");
    //             }
    //         },
    //         error: function(xhr) {
    //             console.error("Error:", xhr.responseText); // Debugging
    //             alert("Something went wrong.");
    //         }
    //     });
    // });
// });

    // $(document).ready(function() {
    //     $(document).on('click', '.delete-cart', function(event) {
    //         event.preventDefault(); // Prevent page reload

    //         let prodId = $(this).data('prodid'); // Get product ID
    //         let url = "{{ route('session.delete') }}"; // Route to delete item

    //         $.ajax({
    //             url: url,
    //             type: "POST",
    //             data: {
    //                 _token: "{{ csrf_token() }}",
    //                 id: prodId
    //             },
    //             success: function(response) {
    //                 if (response.success) {
    //                     // Remove row smoothly without page refresh
    //                     $("#cart_row_" + prodId).fadeOut("slow", function() {
    //                         $(this).remove();
    //                     });
    //                 } else {
    //                     alert("Failed to delete item.");
    //                 }
    //             },
    //             error: function(xhr) {
    //                 alert("Something went wrong.");
    //             }
    //         });
    //     });
    // });
</script>
{{-- end original --}}
{{-- <form id="cartForm">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="prodId" value="">
</form> --}}

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".delete-btn").on("click", function() {
            var prodId = $(this).data("prodid"); // Get product ID from button data
            $("#prodId").val(prodId); // Set product ID in hidden input

            $.ajax({
                url: "your-delete-url-here", // Replace with your actual delete URL
                type: "POST",
                data: $("#cartForm").serialize(), // Serialize form data
                success: function(response) {
                    if (response.success) {
                        $("#cart_row_" + prodId).remove(); // Remove row from UI
                    } else {
                        alert("Failed to delete item.");
                    }
                },
                error: function(xhr) {
                    alert("Something went wrong.");
                }
            });
        });
    });
</script> --}}

{{-- <script>
    $(document).ready(function() {
    $('.delete-cart').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        let form = $(this);
        let prodId = form.find('input[name="id"]').val(); // Get product ID
        let url = form.data('url'); // Get AJAX URL
        let token = $('meta[name="csrf-token"]').attr('content'); // CSRF token (ensure it's in <head>)

        if (confirm("Are you sure you want to remove this item?")) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: token,
                    id: prodId
                },
                success: function(response) {
                    if (response.success) {
                        $('#cart_row_' + prodId).remove(); // Remove the row dynamically
                    } else {
                        alert("Failed to delete item.");
                    }
                },
                error: function(xhr) {
                    alert("Something went wrong.");
                }
            });
        }
    });
});

</script> --}}
{{-- <script>
$(document).ready(function () {
    $(document).on('submit', '.delete-cart-form', function (event) {
        event.preventDefault(); // Prevent form submission
        
        let form = $(this);
        let prodId = form.find('input[name="id"]').val(); // Get product ID
        alert(prodId);  // undefined
        let url = form.attr('action'); // Get form action URL
        
        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(), // Serialize form data including CSRF token
            // alert(data);
            success: function (response) {
                // alert(response);
                if (response.success) {
                    $('#cart_row_' + prodId).fadeOut(500, function () {
                        $(this).remove(); // Remove row from UI
                    });
                } else {
                    alert("Failed to delete item.");
                }
            },
            error: function () {
                alert("Something went wrong.");
            }
        });
    });
});

</script> --}}

    
