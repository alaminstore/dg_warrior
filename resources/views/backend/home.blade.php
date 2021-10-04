<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="author" content="DG WARRIOR">
		<meta name="keywords" content="">
        <!-- Favicon -->
		<link rel="icon" href="{{asset('logo.svg')}}" type="image/x-icon"/>
		<!-- Title -->
        <title>@yield('title','DG Warrior')</title>
		<!-- Bootstrap css-->
		<link href="{{asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
		<!-- Icons css-->
		<link href="{{asset('backend/assets/plugins/web-fonts/icons.css')}}" rel="stylesheet"/>
		<link href="{{asset('backend/assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet"/>
		<!-- Style css-->
		<link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet">
		<link href="{{asset('backend/assets/css/skins.css')}}" rel="stylesheet">
		<link href="{{asset('backend/assets/css/dark-style.css')}}" rel="stylesheet">
		<link href="{{asset('backend/assets/css/colors/default.css')}}" rel="stylesheet">
		<!-- Color css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('backend/assets/css/colors/color.css')}}">
		<!---Select2 css-->
		<link href="{{asset('backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
		<!-- Mutipleselect css-->
		<link rel="stylesheet" href="{{asset('backend/assets/plugins/multipleselect/multiple-select.css')}}">
		<link rel="stylesheet" href="{{asset('backend/assets/js/jquery-toast-plugin/jquery.toast.min.css')}}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		@yield('style')
	</head>
    <body class="horizontalmenu dark-theme">
        {{-- oncontextmenu="return false;"         use this in body tag --}}

		@include('backend.inc.header')
		@yield('content')
        <div class="gap"></div>
        <style>.hide{display: none;}</style>
		@include('backend.inc.footer')
		<!-- Back-to-top -->
		<a href="#top" id="back-to-top" style="display: flex;justify-content: center;align-items: flex-end;"><i class="fa fa-arrow-up"></i></a>
		<!-- Jquery js-->
		<script src="{{asset('backend/assets/plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap js-->
		<script src="{{asset('backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Chart.Bundle js-->
		<script src="{{ asset('backend/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
		<!-- Flot Chart js-->
		<script src="{{ asset('backend/assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
		<script src="{{ asset('backend/assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('backend/assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
		<!-- Peity js-->
		<script src="{{asset('backend/assets/plugins/peity/jquery.peity.min.js')}}"></script>
		<!-- Jquery-Ui js-->
		<script src="{{asset('backend/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
		<!-- Select2 js-->
		<script src="{{asset('backend/assets/plugins/select2/js/select2.min.js')}}"></script>
		<!--MutipleSelect js-->
		<script src="{{asset('backend/assets/plugins/multipleselect/multiple-select.js')}}"></script>
		<script src="{{asset('backend/assets/plugins/multipleselect/multi-select.js')}}"></script>
		<!-- Internal Morris js -->
		<script src="{{asset('backend/assets/plugins/raphael/raphael.min.js')}}"></script>
		<script src="{{asset('backend/assets/plugins/morris.js/morris.min.js')}}"></script>
		<!-- Sidebar js-->
		<script src="{{asset('backend/assets/plugins/sidebar/sidebar.js')}}"></script>
		<!-- Perfect-scrollbar js-->
		<script src="{{asset('backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
		<!-- Sticky js-->
		<script src="{{asset('backend/assets/js/sticky.js')}}"></script>
		{{-- sweetalert2 --}}
		<script src="{{asset('backend')}}/vendors/sweetalert/sweetalert.min.js"></script>
        <!-- Circle Progress js-->
		<script src="{{ asset('backend/assets/js/circle-progress.min.js') }}"></script>
		<!-- Custom js-->
		<script src="{{asset('backend/assets/js/custom.js')}}"></script>
		<script src="{{asset('backend/assets/js/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
		<script>

            //View================
            $(document).on('click', '.viewData', function () {
                let id = $(this).attr('data-id');
                console.log('id--', id);
                $.ajax({
                    url: "{{url('jobdetails')}}/" + id,
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (response) {
                        let url = window.location.origin;
                        console.log('data', response.data);
                        $('#viewTitle').html(response.data.job_title);
						let jType = response.data.job_type == 1 ? "Director Task" : "Normal";
						let jvisibility = response.data.job_visibility == 1 ? "All Public" : response.data.job_visibility == 2 ? "Only My Team":response.data.job_visibility == 3 ? "Subscribed Users Only":"DG Manager task Only";
                        $('#viewType').html(jType);
                        $('#viewVisibility').html(jvisibility);
                        $('#viewWorkers').html(response.data.job_worker);
                        $('#viewDetails').html(response.data.job_description);
                        if(response.data.job_visibility != "4"){
                          $('#viewPrice').html('$'+ response.data.job_price);
                        }else{
                            $('#viewPrice').html('Top Up Percentage');
                        }
                        $('#jobpostId').val(response.data.id);
                        if(response.data.job_status == 1){
                            $('.jobPermit').addClass( "hide" );
                        }else{
                            $('.jobPermit').removeClass( "hide" );
                        }
                    },
                    error: function (error) {
                        if (error.status == 404) {
                            toastr.error('Not found!');
                        }
                    }
                });
            });

			$('#ActiveJob').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('activejob.store')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    console.log('save', response);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };
					if(response.status = true){
						$('#myModalSave').modal('hide');
						toastr.success(response.message);
						$("#BalanceRechange").load(location.href + " #BalanceRechange>*", "");
						$(".bellReff").load(location.href + " .bellReff>*", "");

					}
                }

            });

        });
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "10000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if(Session::has('message'))
            let type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

                case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

                case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

                case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
            }
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        //Full view Screenshot
        $(document).on('click', '.viewScreenshot', function () {
            let id = $(this).attr('data-id');
            // console.log('id:',id);
            $.ajax({
                url: "{{url('pscreen')}}/" + id + '/edit',
                method: "get",
                data: {},
                dataType: 'json',
                success: function (response) {
                    let url = window.location.origin;
                    // console.log('data', response);
                    $('#screenShotImage').html('');
                    var img_url = '{!!URL::to('/')!!}' + "/" + response.data.image;
                    $('#screenShotImage').html('<img src=" ' + img_url + '">')
                },
                error: function (error) {
                    if (error.status == 404) {
                        toastr.error('Not found!');
                    }
                }
            });
        });
        $(document).on('click', '.usdt_pay', function (e) {
            $("#ChoosePayment").modal('hide');
            setTimeout(function(){
                $('#usdtQrModal').modal('show');
            }, 1000);
        });
        $(document).on('click', '.alipay_pay', function (e) {
            $("#ChoosePayment").modal('hide');
            setTimeout(function(){
                $('#alipayQrModal').modal('show');
            }, 1000);
        });
        $(document).on('click', '.airtm_pay', function (e) {
            $("#ChoosePayment").modal('hide');
            setTimeout(function(){
                $('#airtmTopupSectionM').modal('show');
            }, 1000);
        });
        $("#UsdtModelBalances").validate({
            rules: {
                usdtbalanceCopy: {
                    required:true,
                },
            }
        });
        $(document).on('click', '.transactionIdSubmission', function (e) {
             let dat = $('#usdtbalanceCopy').val();
             if (dat == "") {
                alert("Top Up Amount must be filled out");
                return false;
            }else{
                $("#usdtQrModal").modal('hide');
                setTimeout(function(){
                    $('#usdtAmountVerify').modal('show');
                    $('#balance').val(dat);
                }, 1000);
            }
        });
        $(document).on('click', '.alipaytransactionIdSubmission', function (e) {
            $("#alipayQrModal").modal('hide');
            setTimeout(function(){
                $('#alipayAmountVerify').modal('show');
            }, 1000);
        });



        $("#trxidWithBalance").validate({
            rules: {
                trxid: {
                    required:true,
                },
                image: {
                    required:true,
                }
            }
        });
        $("#trxidWithBalanceTwo").validate({
            rules: {
                trxid: {
                    required:true,
                },
                balance: {
                    required:true,
                },
                image: {
                    required:true,
                }
            }
        });

        // TrxID justify
        $('#trxidWithBalance').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('trxid.justify')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log('update', data);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };

                    if(data.status == 0){
                        $.each(data.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(data.status == 2){
                            toastr.warning(data.msg);
                        }else{
                            if(data.status == true){
                                $('#trxidWithBalance').trigger('reset');
                                $(".modal").modal('hide');
                                // $('.modal').removeClass('show');
                                setTimeout(function () {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Please Wait for a while until our admin check and update the amount of Balance!',
                                        showConfirmButton: true,
                                        })
                                }, 500);

                            }
                        }
                    }
                }
            });
        });
        // Alipay Trxid justify
        $('#trxidWithBalanceTwo').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('trxid.justify')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log('update', data);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };

                    if(data.status == 0){
                        $.each(data.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(data.status == 2){
                            toastr.warning(data.msg);
                        }else{
                            if(data.status == true){
                                $('#trxidWithBalanceTwo').trigger('reset');
                                $(".modal").modal('hide');
                                // $('.modal').removeClass('show');
                                setTimeout(function () {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Please Wait for a while until our admin check and update the amount of Balance!',
                                        showConfirmButton: true,
                                        })
                                }, 500);

                            }
                        }
                    }
                }
            });
        });
        function cnyCalculator() {
            let txtFirstNo = document.getElementById('balanceTop').value;
            let txtSecondNo = 6.8;
            let result = parseFloat(txtFirstNo) * parseFloat(txtSecondNo);
            if (!isNaN(result)) {
                document.getElementById('cnyValue').value = "CNY ¥"+result.toFixed(2);
            }else{
                document.getElementById('cnyValue').value = "";
            }
        }

        // document.onkeydown = function(e) {
        //     if(event.keyCode == 123) {
        //     return false;
        //     }
        //     if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
        //     return false;
        //     }
        //     if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
        //     return false;
        //     }
        //     if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
        //     return false;
        //     }
        // }
    </script>
	@yield('js')
    <script>
        $('.topupBalance').select2();
    </script>
	</body>
</html>
