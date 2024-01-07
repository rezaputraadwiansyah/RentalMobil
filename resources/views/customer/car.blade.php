@extends('customer.layouts')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('../customer/images/bg_3.jpg')"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <h1 class="mb-3 bread">Mobil Yang Tersedia</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            @foreach ($car as $c)
            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate">
                    <div class="img rounded d-flex align-items-end" style="background-image: url({{$c->image}})">
                    </div>
                    <div class="text">
                        <h2 class="mb-0">
                            <a href="car-single.html">{{$c->name}}</a>
                        </h2>
                        <div class="d-flex mb-3">
                            <span class="cat" style="color: #000">{{$c->merk}}</span>
                            <p class="price ml-auto">Rp. {{number_format($c->price, '0', ',', '.')}} <span
                                    style="color: #000">/day</span></p>
                        </div>
                        <p class="d-flex mb-0 d-block">
                            <button class="btn btn-primary py-2 mr-1 rental-car" data-id="{{$c->id}}"
                                data-toggle="modal" data-target="#rentalModal">Rental</button>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<div class="modal fade" id="rentalModal" tabindex="-1" role="dialog" aria-labelledby="rentalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rentalModalLabel">Rental Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formRental">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal Sewa</label>
                                <input type="date" name="rent_date" class="form-control datepicker" required="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal Kembali</label>
                                <input type="date" name="back_date" class="form-control datepicker" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Rental</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.rental-car').click(function(){
            var id = $(this).data('id');
            $('#rentalModal').modal('show');
            $('#formRental').attr('action', '/transaction/' + id);
        })
    });
</script>
@endsection