@extends('components.master-index')
@section('content')
    <div class="pagetitle">
        <h1>Subscription</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Monthly</a></li>
                <li class="breadcrumb-item">Cancel anytime</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">

                <form class="row g-3" id="paymentForm" accept-charset="UTF-8" class="form-horizontal" role="form">
                    @csrf
                    <h5 class="card-title">Subscribe <span>| Send many</span></h5>

                    <div id="message"></div>

                    <div class="col-md-6">
                        <label for="firstName" class="form-label">Firstname</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" value="{{$user->firstName}}">
                     </div>

                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" value="{{$user->lastName}}">
                     </div>

                     <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                     </div>

                    <div class="col-md-6">
                        <label for="amount" class="form-label">Amount GHS</label>
                        <input type="number" class="form-control" name="amount" id="amount" value="5">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success w-25" type="submit" onclick="payWithPaystack(event)"><i class="bi bi-plus-circle"></i> Subscribe Now</button>
                    </div>
                </form><!-- End Customer form -->

            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: '{{env('PAYSTACK_PUBLIC_KEY')}}',
    first_name: document.getElementById("firstName").value,
    last_name: document.getElementById("lastName").value,
    email: document.getElementById("email").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1),
    plan: '{{env('PAYSTACK_PLAN')}}',
    onClose: function(){
      $('#message').html('<div class="alert alert-danger" role="alert">Payment cancelled!</div>');
    },
    callback: function(response){
      let reference = response.reference;
      $.ajax({
          type: 'GET',
          url: "{{URL::to('/payment/verification')}}/" + reference,
          success: function(response) {

            let result = JSON.parse(response);
            console.log(result.data.authorization);
            if (result.status) {
                window.location.href = "{{URL::to('/dashboard')}}";
            }
          },
      });
    }
  });

  handler.openIframe();
}
</script>

@endsection
