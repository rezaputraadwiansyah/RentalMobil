@extends('customer.layouts')

@section('content')
<div class="hero-wrap ftco-degree-bg" style="background-image: url('../customer/images/fortuner.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
            <div class="col-lg-8 ftco-animate">
                <div class="text w-100 text-center mb-md-5 pb-md-5">
                    <h1 class="mb-4">Cepat &amp; Mudah Untuk Rental Mobil</h1>
                    <p style="font-size: 18px;">Anda membutuhkan kendaraan untuk liburan? mari ke Rental Mobil Reza,
                        harga murah, proses cepat dan sangat mudah, jadi tunggu apalagi.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <span class="subheading">Yang Kami Tawarkan</span>
                <h2 class="mb-2">Mobil Yang Tersedia</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($car as $c)
            <div class="col-md-4">
                <div class="item">
                    <div class="car-wrap rounded ftco-animate">
                        <div class="img rounded d-flex align-items-end" style="background-image: url({{$c->image}});">
                        </div>
                        <div class="text">
                            <h2 class="mb-0"><a href="#">{{$c->name}}</a></h2>
                            <div class="d-flex mb-3">
                                <span class="cat" style="color: #000">{{$c->merk}}</span>
                                <p class="price ml-auto">Rp. {{number_format($c->price, '0', ',', '.')}}
                                    <span style="color: #000">/day</span>
                                </p>
                            </div>
                            <p class="d-flex mb-0 d-block">
                                <button class="btn btn-primary py-2 mr-1 rental-car" data-id="{{$c->id}}"
                                    data-toggle="modal" data-target="#rentalModal">Rental</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <a href="/car" class="btn btn-primary py-3 px-4">Lebih Banyak</a>
        </div>
    </div>
</section>

<section class="ftco-section ftco-about">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center"
                style="background-image: url(../customer/images/about.jpg);">
            </div>
            <div class="col-md-6 wrap-about ftco-animate">
                <div class="heading-section heading-section-white pl-md-5">
                    <span class="subheading">About us</span>
                    <h2 class="mb-4">Selamat Datang di Rental Mobil Reza</h2>

                    <p>Selamat datang di Rental Mobil Reza - Mitra Terpercaya untuk Perjalanan Anda!
                        <br>
                        Kami di Rental Mobil Reza berkomitmen untuk menyediakan layanan sewa mobil yang berkualitas
                        tinggi, aman, dan handal untuk memenuhi kebutuhan perjalanan Anda. Dengan pengalaman
                        bertahun-tahun dalam industri ini, kami telah menjadi pilihan utama pelanggan yang menghargai
                        pelayanan prima dan armada mobil yang terawat dengan baik.
                    </p>
                    <p>Rental Mobil Reza adalah solusi transportasi yang andal dan efisien. Percayakan perjalanan Anda
                        kepada kami, dan nikmati pengalaman berkendara yang tanpa khawatir. Kami bangga menjadi bagian
                        dari setiap perjalanan Anda, karena keamanan dan kenyamanan Anda adalah yang utama bagi kami.
                        <br>
                        Selamat menikmati perjalanan Anda dengan Rental Mobil Reza!
                    </p>
                    <p><a href="/car" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
                </div>
            </div>
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