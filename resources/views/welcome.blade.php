@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">MapleNime</h1>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores earum temporibus optio
                esse ut nisi. Quas natus dicta excepturi asperiores?</p>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped" id="list">
            <tr>
                <th>ID</th>
                <th>Donor Name</th>
                <th>Amount</th>
                <th>Donation Type</th>
                <th>Status</th>
                <th style="text-align: center;"></th>
            </tr>
            @foreach ($donations as $donation)
                <tr>
                    <td><code>{{ $donation->id }}</code></td>
                    <td>{{ $donation->donor_name }}</td>
                    <td>Rp. {{ number_format($donation->amount) }},-</td>
                    <td>{{ ucwords(str_replace('_', ' ', $donation->donation_type)) }}</td>
                    <td>{{ ucfirst($donation->status) }}</td>
                    <td style="text-align: center;">
                        @if ($donation->status == 'pending')
                            <button class="btn btn-success btn-sm" onclick="snap.pay('{{ $donation->snap_token }}')">Complete
                                Payment</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">{{ $donations->links() }}</td>
            </tr>
        </table>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script
        src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
@endsection
