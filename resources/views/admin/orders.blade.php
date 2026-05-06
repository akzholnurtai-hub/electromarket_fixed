@extends('layout')

@section('content')

<h2 class="fw-bold mb-4">📋 {{ __('lang.all_orders') }}</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($orders->isEmpty())
    <div class="alert alert-info">{{ __('lang.no_orders') }}</div>
@else

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>{{ __('lang.customer') }}</th>
                    <th>{{ __('lang.phone') }}</th>
                    <th>{{ __('lang.city') }}</th>
                    <th>{{ __('lang.total') }}</th>
                    <th>{{ __('lang.payment_method') }}</th>
                    <th>{{ __('lang.status') }}</th>
                    <th>{{ __('lang.date') }}</th>
                    <th>{{ __('lang.action') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        <strong>{{ $order->full_name }}</strong><br>
                        <small class="text-muted">{{ $order->user->email }}</small>
                    </td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->city }}</td>
                    <td>{{ number_format($order->total_price, 0, '.', ' ') }} тг</td>
                    <td>
                        @if($order->payment_method === 'cash') 💵
                        @elseif($order->payment_method === 'card') 💳
                        @else 📱
                        @endif
                        {{ $order->payment_method }}
                    </td>
                    <td>
                        @php
                            $badge = match($order->status) {
                                'pending'    => 'warning',
                                'processing' => 'info',
                                'delivered'  => 'success',
                                'cancelled'  => 'danger',
                                default      => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $order->status }}</span>
                    </td>
                    <td>{{ $order->created_at->format('d.m.Y') }}</td>
                    <td>
                        {{-- Статусты тікелей өзгерту — select таңдаған кезде форма жіберіледі --}}
                        <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                            @csrf
                            <select name="status" class="form-select form-select-sm"
                                onchange="this.form.submit()">
                                <option value="pending"    {{ $order->status==='pending'    ? 'selected' : '' }}>pending</option>
                                <option value="processing" {{ $order->status==='processing' ? 'selected' : '' }}>processing</option>
                                <option value="delivered"  {{ $order->status==='delivered'  ? 'selected' : '' }}>delivered</option>
                                <option value="cancelled"  {{ $order->status==='cancelled'  ? 'selected' : '' }}>cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>

                {{-- Тапсырысқа кіретін өнімдер тізімі --}}
                @if($order->items->count())
                <tr class="table-light">
                    <td colspan="9">
                        <small>
                        @foreach($order->items as $item)
                            📦 {{ $item->product->name }} ×{{ $item->quantity }}
                            ({{ number_format($item->price * $item->quantity, 0, '.', ' ') }} тг)
                            @if(!$loop->last) &nbsp;|&nbsp; @endif
                        @endforeach
                        </small>
                    </td>
                </tr>
                @endif

            @endforeach
            </tbody>
        </table>
    </div>

@endif

@endsection
