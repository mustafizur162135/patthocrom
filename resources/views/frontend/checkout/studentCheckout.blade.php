@extends('frontend.front_app')

@section('title', 'Course')

@section('css')

    
@endsection

@section('frontend-content')

    	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Checkout</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Shop Checkouts Content -->
	<section class="shop-checkouts">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-8 col-xl-8">
					<div class="checkout_form">
						
						<div class="checkout_coupon ui_kit_button">
							
						    <h4 class="mb15">Billing Details</h4>
                            <form class="form2" id="checkout_form" action="{{ route('student.checkout.process') }}" method="post" novalidate="novalidate">
                                @csrf <!-- Add a CSRF token for security -->
                                
                                <input type="hidden" name="student_id" value="{{ $studentUserData['user_id'] }}">
                                <input type="hidden" name="studentpackage_id" value="{{ $studentPackage_id }}">
                                <input type="hidden" name="studentpackage_name" value="{{ $studentpackage_name }}">
                                <input type="hidden" name="studentpackage_price" value="{{ $studentpackage_price }}">
                                {{-- <input type="hidden" name="studentorder_tran_id" value="1"> --}}

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name </label>
                                            <input id="name" name="studentorder_name" value="{{ $studentUserData['name'] }}" class="form-control" required="required" type="text" readonly>
                                        </div>
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Phone *</label>
                                            <input id="phone" name="studentorder_phone" class="form-control" required="required" type="number">
                                        </div>
                                    </div>
                            
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email">Your Email</label>
                                            <input id="email" name="studentorder_email" value="{{ $studentUserData['email'] }}" class="form-control required email" required="required" type="email" readonly>
                                        </div>
                                    </div>
                            
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" name="studentorder_address" id="address" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="zipcode">Postcode / ZIP</label>
                                            <input id="zipcode" name="studentorder_zipcode" class="form-control" required="required" type="number">
                                        </div>
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city">Town / City</label>
                                            <input id="city" name="studentorder_city" class="form-control" required="required" type="text">
                                        </div>
                                    </div>
                                </div>
                            
                               
                          
                            
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-xl-4">
					<div class="order_sidebar_widget mb30">
						<h4 class="title">Your Order</h4>
						<ul>
							<li class="subtitle"><p>{{ $studentpackage_name }} </p></li>
							
							<li class="subtitle"><p>Price <span class="float-right totals color-orose">৳ {{ $studentpackage_price }}</span></p></li>
						</ul>
					</div>
                    <div class="payment_widget">
                        <div class="ui_kit_checkbox style2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="studentorder_card_type" value="bkash">Bkash
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="studentorder_card_type" value="nagad">Nagad
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="studentorder_card_type" value="cash">Cash Payment
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="bkash_transaction" style="display: none;">
                        <div class="form-group">
                            <label for="bkash_transaction_id">Bkash Transaction ID</label>
                            <input type="text" name="bkashTranId" class="form-control">
                        </div>
                        <p class="mobile-number-instructions">Use this <b style="color: red">01711111111</b> mobile number associated with your Bkash account for payment.</p>
                    </div>
                    
                    <div id="nagad_transaction" style="display: none;">
                        <div class="form-group">
                            <label for="nagad_transaction_id">Nagad Transaction ID</label>
                            <input type="text" name="nagadTranId"  class="form-control">
                        </div>
                        <p class="mobile-number-instructions">Use this <b style="color: red">01811111111</b> mobile number associated with your Nagad account for payment.</p>

                    </div>
                    
					<div class="ui_kit_button payment_widget_btn">
						<button type="submit" value="submit" name="submit" class="btn dbxshad btn-lg btn-thm3 circle btn-block">Place Order</button>
					</div>
				</div>

                {{-- <div class="col-lg-6 col-xl-6">
                    <button type="submit" class="btn btn-block buy_now_btn dbxshad btn-lg btn-thm3 mt20">Place Order</button>

                </div> --}}


            </form>
			</div>
		</div>
	</section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var bkashTransactionField = document.getElementById("bkash_transaction");
            
            var nagadTransactionField = document.getElementById("nagad_transaction");
    
            var paymentRadioButtons = document.getElementsByName("studentorder_card_type");
    
            for (var i = 0; i < paymentRadioButtons.length; i++) {
                paymentRadioButtons[i].addEventListener("change", function () {
                    if (this.value === "bkash") {
                        bkashTransactionField.style.display = "block";
                        nagadTransactionField.style.display = "none";
                    } else if (this.value === "nagad") {
                        nagadTransactionField.style.display = "block";
                        bkashTransactionField.style.display = "none";
                    } else {
                        bkashTransactionField.style.display = "none";
                        nagadTransactionField.style.display = "none";
                    }
                });
            }
        });
    </script>

@endsection

@section('js')



    
@endsection
