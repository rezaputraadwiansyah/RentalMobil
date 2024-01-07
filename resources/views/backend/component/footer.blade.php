<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{App\Setting::where('slug','nama-toko')->get()->first()->description}} {{date('Y')}} | Repost by <a href='https://valcoding.com/' title='valcoding.com' target='_blank'>valcoding.com</a>
            </span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
