
<body>
    $(if chap-id)
    <form name="sendin" action="$(link-login-only)" method="post">
        <input type="hidden" name="username" />
        <input type="hidden" name="password" />
        <input type="hidden" name="dst" value="$(link-orig)" />
        <input type="hidden" name="popup" value="true" />
    </form>

    <script type="text/javascript">
        function doLogin() {
            document.sendin.username.value = document.login.username.value;
            document.sendin.password.value = hexMD5('$(chap-id)' + document.login.password.value + '$(chap-challenge)');
            document.sendin.submit();
            return false;
        }
    </script>
    $(endif)
    <header class="masthead shadow mb-3">
    </header>
    <div class="container">
        <div class="row mb-3 justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-4">
                <div class="row shadow mx-0">

                    <div style="height: 54px;" class="d-inline-block  col-12 mb-2 bg-dark rounded-top">
                        <div class="text-center">
                            <img class="py-2" src="assets/img/logo.png" alt="NetMe">
                        </div>
                    </div>

                    <div class="col-12 border border-light bg-white rounded-bottom">

                        <div class="row shadow mx-0">
                            <div class="col-12 bg-white text-center border"><p class="h6 text-dark my-2">SILAHKAN LOGIN</p></div>
                        </div>
                        <div class="row justify-content-center text-center my-2">
                            <div id="member" class="col-6"><button type="button" class="btn btn-secondary btn-block rounded-right"></i>MEMBER</button></div>
                            <div id="voucher" class="col-6"><button type="button" class="btn btn-info btn-block">VOUCHER</button></div>
                        </div>


                        <form id="form-member" name="" action="$(link-login-only)" method="post" $(if chap-id) onSubmit="return doLogin()" $(endif)>
                            <div class="form-row">
                                <input type="hidden" name="dst" value="$(link-orig)" />
                                <input type="hidden" name="popup" value="true" />
                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <div class="w-25 input-group-prepend">
                                            <div class="w-100 input-group-text justify-content-center"><i class="fas fa-user fa-2x"></i></div>
                                        </div>
                                        <input name="username" type="text" class="form-control form-control-lg" id="muname" placeholder="Username" value="$(username)" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <div class="w-25 input-group-prepend">
                                            <div class="w-100 input-group-text justify-content-center"><i class="fas fa-key fa-2x"></i></div>
                                        </div>
                                        <input name="password" type="password" class="form-control form-control-lg" id="inlineFormInputGroup" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" value="OK" class="btn btn-success btn-block mb-3"><i class="pr-2 fas fa-sign-in-alt"></i> LOGIN</button>
                                    $(if trial == 'yes')<p class="col-12 text-center mb-2"><a class="text-light bg-secondary rounded px-2 py-1" href="$(link-login-only)?dst=$(link-orig-esc)&amp;username=T-$(mac-esc)">Coba Gratis</a></p>$(endif)
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        $(if error)<p class="bg-danger text-light mb-2 rounded"> $(error)</p>$(endif)
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form style="display:none;" id="form-voucher" name="" action="$(link-login-only)" method="post" $(if chap-id) onSubmit="return doLogin()" $(endif)>
                            <div class="form-row">
                                <input type="hidden" name="dst" value="$(link-orig)" />
                                <input type="hidden" name="popup" value="true" />
                                <div class="col-md-12">
                                    <div class="input-group mt-3 mb-4">
                                        <div class="w-25 input-group-prepend">
                                            <div class="w-100 input-group-text justify-content-center"><i class="fas fa-id-card-alt fa-2x"></i></div>
                                        </div>
                                        <input name="username" type="text" class="form-control form-control-lg" id="vuname" placeholder="Code Voucher" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input name="password" type="hidden" class="form-control" id="vpass" placeholder="Password" required>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" value="OK" class="btn btn-success btn-block mb-5"><i class="pr-2 fas fa-sign-in-alt"></i> LOGIN</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center mb-2">
                                        <p class="bg-danger text-light my-3 rounded"> </p>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Kalau mau rubah mulai dari baris bawah-->
            <div class="col-12 col-md-10 col-lg-8">
                <div class="row shadow mx-0">
                    <div style="height:53px;" class="col-12 bg-dark text-center rounded-top mb-1">
                        <p style="line-height:53px;"class="h5 text-white">HARGA PAKET INTERNET</p>
                    </div>
                    <div class="col-12 col-lg-6 bg-white">
                        <div class="row mx-0 my-1" >
                            <div class="col-4 bg-info rounded-left text-center text-light">
                                <p class="h6 mt-2"><i class="fas fa-comments fa-3x"></i></p>
                                <p class="h6">Chating</p>
                            </div>
                            <div class="col-8 border border-info text-left text-info">
                                <p class="h4">Rp. 3.000</p>
                                <p class="m-0">Durasi : 12 Jam (12h)</p>
                                <p class="m-0">Masa aktif : 1 Hari (1d)</p>
                            </div>
                        </div>
                        <div class="row mx-0 my-1" >
                            <div class="col-4 bg-secondary rounded-left text-center text-light">
                                <p class="h6 mt-2"><i class="fab fa-internet-explorer fa-3x"></i></p>
                                <p class="h6">Browsing</p>
                            </div>
                            <div class="col-8 border border-secondary text-left text-secondary">
                                <p class="h4">Rp. 5.000</p>
                                <p class="m-0">Durasi : 1 Hari (1d)</p>
                                <p class="m-0">Masa aktif : 2 Hari (2d)</p>
                            </div>
                        </div>
                        <div class="row mx-0 my-1" >
                            <div class="col-4 bg-warning rounded-left text-center text-light">
                                <p class="h6 mt-2"><i class="fas fa-video fa-3x"></i></p>
                                <p class="h6">Streaming</p>
                            </div>
                            <div class="col-8 border border-warning text-left text-warning">
                                <p class="h4">Rp. 10.000</p>
                                <p class="m-0">Durasi : 3 Hari (3d)</p>
                                <p class="m-0">Masa aktif : 1 Minggu (1w)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3 bg-white">
                        <div class="row mx-0 my-1" >
                            <div class="col-4 bg-primary rounded-left text-center text-light">
                                <p class="h6 mt-2"><i class="fas fa-gamepad fa-3x"></i></p>
                                <p class="h6">Games</p>
                            </div>
                            <div class="col-8 border border-primary text-left text-primary">
                                <p class="h4">Rp. 25.000</p>
                                <p class="m-0">Durasi : 1 Minggu (1w)</p>
                                <p class="m-0">Masa aktif : 10 Hari (10d)</p>
                            </div>
                        </div>
                        <div class="row mx-0 my-1" >
                            <div class="col-4 bg-danger rounded-left text-center text-light">
                                <p class="h6 mt-2"><i class="fab fa-youtube-square fa-3x"></i></p>
                                <p class="h6">YouTube</p>
                            </div>
                            <div class="col-8 border border-danger text-left text-danger">
                                <p class="h4">Rp. 50.000</p>
                                <p class="m-0">Durasi : 2 Minggu (2w)</p>
                                <p class="m-0">Masa aktif : 1 Bulan (30d)</p>
                            </div>
                        </div>
                        <div class="row mx-0 my-1" >
                            <div class="col-4 bg-success rounded-left text-center text-light">
                                <p class="h6 mt-2"><i class="fas fa-cloud-download-alt fa-3x"></i></p>
                                <p class="h6">Download</p>
                            </div>
                            <div class="col-8 border border-success text-left text-success">
                                <p class="h4">Rp. 100.000</p>
                                <p class="m-0">Durasi : 1 Bulan (30d)</p>
                                <p class="m-0">Masa aktif : 1 Bulan (30d)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center mx-0 mb-2 border-bottom border-white shadow">
            <div style="background: rgb(230, 236, 255);" class="col-12 col-md-10 col-lg-4 pb-3">
                <div class="row bg-primary text-center rounded-top text-light">
                    <div class="col"><p class="h5 pt-1">LAYANAN</p></div>
                </div>
                <div class="row">
                    <div class="col-12"><p class="h6 pt-1">NetMe menyediakan berbagai perlengkapan dan jasa, di antaranya : </p></div>
                </div>
                <div class="row">
                    <div class="col-1"><i class="fas fa-long-arrow-alt-right"></i></div>
                    <div class="col-10">Pemasangn internet untuk rumah, kantor, warkop dan sekolahan.</div>
                </div>
                <div class="row">
                    <div class="col-1"><i class="fas fa-long-arrow-alt-right"></i></div>
                    <div class="col">Menyediakan Voucher wifi Hotspot.</div>
                </div>
                <div class="row">
                    <div class="col-1"><i class="fas fa-long-arrow-alt-right"></i></div>
                    <div class="col">Warung Kopi.</div>
                </div>
                <div class="row">
                    <div class="col-1"><i class="fas fa-long-arrow-alt-right"></i></div>
                    <div class="col">Aneka jajanan dan minuman.</div>
                </div>
                <div class="row">
                    <div class="col-12"><p class="h6 pt-1">Silahkan datang atau kontak kami langsung untuk info selengkapnya.</p></div>
                </div>
            </div>
            <div style="background: rgb(230, 255, 230);" class="col-12 col-md-10 col-lg-4 pb-3">
                <div class="row bg-success text-center rounded-top text-light">
                    <div class="col"><p class="h5 pt-1">KONTAK</p></div>
                </div>
                <div class="row">
                    <div class="col-1"><p class="h5"><i class="fas fa-id-card"></i></p></div>
                    <div class="col-10"><p><b>Bang Andi</b></p></div>
                </div>
                <div class="row">
                    <div class="col-1"><p class="h5"><i class="fas fa-map-marked-alt"></i></p></div>
                    <div class="col-10"><p><b>NetMe Internet Services</b><br>Jl. Adi purnama No 5<br>Kel/Kp Mundu manca, Kec. Babakan<br>Kb. Indramayu - Jawa Barat.</p></div>
                </div>
                <div class="row">
                    <div class="col-1"><p class="h5"><i class="fab fa-whatsapp"></i></p></div>
                    <div class="col-10"><p><b>0852 21554 652</b></p></div>
                </div>
                <div class="row">
                    <div class="col-1"><p class="h5"><i class="fas fa-globe"></i></p></div>
                    <div class="col-10"><p>https://www.netme.id</p></div>
                </div>
            </div>
            <div style="background: rgb(255, 230, 230);" class="col-12 col-md-10 col-lg-4 pb-3">
                <div class="row bg-danger text-center rounded-top text-light">
                    <div class="col"><p class="h5 pt-1">PETUNJUK</p></div>
                </div>
                <div class="row">
                    <div class="col-1"><i class="fas fa-check"></i></div>
                    <div class="col">Untuk pembelian langganan internet member / Voucher silahkan datang ke tempat kami.</div>
                </div>
                <div class="row">
                    <div class="col-1"><i class="fas fa-check"></i></div>
                    <div class="col">Silahkan <b>Login</b> dengan paket internet yang anda beli.</div>
                </div>
                <div class="row">
                    <div class="col-1"><i class="fas fa-check"></i></div>
                    <div class="col">Catat keterangan error jika ada masalah, kemudian lapor ke kami mengenai user atau kode voucher.</div>
                </div>
                <div class="row">
                    <div class="col-1"><i class="fas fa-check"></i></div>
                    <div class="col">Jangan membagikan data ke orang lain.</div>
                </div>
            </div>
        </div>
