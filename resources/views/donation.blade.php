@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">MapleNime</h1>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi alias nostrum iste dolorem
                ipsa exercitationem eligendi odit officia reprehenderit sit!</p>
        </div>
    </div>

    <div class="container">
        <form action="#" id="donation_form">
            <legend>Donation</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="donor_name" class="form-control" id="donor_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="email" name="donor_email" class="form-control" id="donor_email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">kosong</label>
                        <select name="donation_type" class="form-control" id="donation_type">
                            <option value="--">kosong</option>
                            <option value="--">kosong</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="number" name="amount" class="form-control" id="amount">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Catatan (Opsional)</label>
                        <textarea name="note" cols="30" rows="3" class="form-control" id="note"></textarea>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Kirim</button>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script
        src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        $("#donation_form").submit(function(event) {
            event.preventDefault();

            $.post("/api/donation", {
                    _method: 'POST',
                    _token: '{{ csrf_token() }}',
                    donor_name: $('input#donor_name').val(),
                    donor_email: $('input#donor_email').val(),
                    donation_type: $('select#donation_type').val(),
                    amount: $('input#amount').val(),
                    note: $('textarea#note').val(),
                },

                function(data, status) {
                    console.log(data);
                    snap.pay(data.snap_token, {
                        // Optional
                        onSuccess: function(result) {
                            console.log(JSON.stringify(result, null, 2));
                            location.replace('/');
                        },
                        // Optional
                        onPending: function(result) {
                            console.log(JSON.stringify(result, null, 2));
                            location.replace('/');
                        },
                        // Optional
                        onError: function(result) {
                            console.log(JSON.stringify(result, null, 2));
                            location.replace('/');
                        }
                    });
                    return false;
                });
        })
    </script>
@endsection
