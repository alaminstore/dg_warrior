@extends('backend.home')
@section('title','DG Warrior | User Management')
@section('style')
{{-- datatable --}}
<link href="{{ asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection
<style>
    .swal2-icon.swal2-warning{font-size:15px!important}.media-body:hover{background:#141313}.swal2-container{z-index:9999999999999999999999999999999999999!important}.checkbox{position:relative;cursor:pointer;appearance:none;width:60px;height:25px;border-radius:20px;border:2px solid #ccc;outline:0;transition:.3s}.checkbox::before{content:"";position:absolute;height:15px;width:15px;border-radius:50%;background:#ccc;top:3px;left:1px;transition:.3s ease-in-out}.checkbox:checked::before{transform:translateX(37px);background:#39f}.checkbox:checked{border-color:#39f}.select2-container .select2-selection--single .select2-selection__rendered{border:1px solid;border-radius:6px}.d-flex {display: flex !important;justify-content: center;}
</style>
@section('content')
<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">
        <div class="inner-body">

<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Total User List </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">DG Warrior</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Management</li>
        </ol>
    </div>
    @if (Auth::user()->role_id == 1)
    <div class="d-flex">
        <div class="justify-content-center">
            <button type="button" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#adminview">
                <i class="fa fa-list"></i> Admin List
            </button>
            <button type="button" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="modal" data-target="#staticBackdrop">
                <i class="fa fa-plus"></i> Create Admin
            </button>
        </div>
    </div>
    @endif
</div>
<br>
<div class="row row-sm">
    <div class="col-md-12 col-lg-12">
        <div class="">
            <div>
                <h6 class="main-content-label mb-1 text-center">Hey, {{ Auth::user()->name }}</h6>
                <p class="text-muted card-sub-title text-center">Here is the list of all posted job by you. You can view the details and history of your jobs. You can also delete these job if you want.  </p>
            </div>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered text-nowrap">
                <thead>
                    <tr class="text-center">
                        <th width="15%">Name</th>
                        <th width="10%">UserName</th>
                        <th width="10%">Referrer</th>
                        <th width="10%">Gender</th>
                        <th width="10%">Email</th>
                        <th width="10%">Level</th>
                        <th width="10%">User Type</th>
                        <th width="10%">Country</th>
                        <th width="10%">Balance-$</th>
                        <th width="10%">Withdrawable-$</th>
                        <th width="15%">Last Login</th>
                        @if(Auth::user()->role_id==1)
                        <th width="10%">Action</th>
                        @else
                         @if (Auth::user()->role_id == 2 && $DeletePermissionOfAdmin == true)
                         <th width="10%">Action</th>
                         @endif
                        @endif
                    </tr>
                </thead>
                <tbody id="loadBalance">
                    @foreach ($userLists as $list)

                    @php
                    $subscribe = $list->subscription == 0 ? "Normal":"Premium";
                    @endphp
                    <tr class="text-center item{{$list->id}}">
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->username}}</td>
                        <td>{{ $list->referrer ? $list->referrer->username:"" }}</td>
                        <td>{{ $list->gender}}</td>
                        <td>{{ $list->email}}</td>
                        <td>{{ $list->level == null ? "0" : $list->level}}</td>
                        <td>{{ $subscribe}}</td>
                        <td>{{ $list->country}}</td>
                        <td>{{$list->balance==null ? "0": $list->balance}}</td>
                        <td>{{$list->withdrawable==null ? "0": $list->withdrawable}}</td>
                        <td>{{ \Carbon\Carbon::parse($list->last_login)->format('jS F, Y') }}</td>
                        @if(Auth::user()->role_id==1)
                            <td>
                                <button type="button" class="btn btn-warning balance-edit" data-toggle="modal" data-target="#editUserBalance" data-id="{{ $list->id }}" title="$_edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                <a class="deleteuser" data-id="{{$list->id}}">
                                    <button class="btn ripple btn-danger category-delete"
                                    title="Delete">
                                    <i class="fa fa-trash" data-toggle="tooltip" title="delete" data-original-title="delete"></i>
                                    </button>
                                </a>
                            </td>
                        @else
                         @if (Auth::user()->role_id == 2 && $DeletePermissionOfAdmin == true)
                            <td>
                                <button type="button" class="btn btn-warning balance-edit" data-toggle="modal" data-target="#editUserBalance" data-id="{{ $list->id }}" title="$_edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                <a class="deleteuser" data-id="{{$list->id}}">
                                    <button class="btn ripple btn-danger category-delete"
                                    title="Delete">
                                    <i class="si si-trash" data-toggle="tooltip" title="" data-original-title="delete"></i>
                                    </button>
                                </a>
                            </td>
                         @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>

  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">__Add New Admin__</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span class="font-weight:300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
          {!!Form::open(['class' => 'form-horizontal','id'=>'adminSave'])!!}
            @csrf
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Admin Name">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationDefault02">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Unique Username">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationDefault03">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Here...">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationDefault04">Country</label>
                    <select class="custom-select form-control" style="width: 100%"  name="country" id="countries">
                      <option selected disabled value="">Select Country...</option>
                        <option value="Afganistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bonaire">Bonaire</option>
                        <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Canary Islands">Canary Islands</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Channel Islands">Channel Islands</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos Island">Cocos Island</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote DIvoire">Cote DIvoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Curaco">Curacao</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="East Timor">East Timor</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands">Falkland Islands</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Ter">French Southern Ter</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Great Britain">Great Britain</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="India">India</option>
                        <option value="Iran">Iran</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea North">Korea North</option>
                        <option value="Korea Sout">Korea South</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Laos">Laos</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libya">Libya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macau">Macau</option>
                        <option value="Macedonia">Macedonia</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Midway Islands">Midway Islands</option>
                        <option value="Moldova">Moldova</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Nambia">Nambia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherland Antilles">Netherland Antilles</option>
                        <option value="Netherlands">Netherlands (Holland, Europe)</option>
                        <option value="Nevis">Nevis</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau Island">Palau Island</option>
                        <option value="Palestine">Palestine</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Phillipines">Philippines</option>
                        <option value="Pitcairn Island">Pitcairn Island</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Republic of Montenegro">Republic of Montenegro</option>
                        <option value="Republic of Serbia">Republic of Serbia</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russia">Russia</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="St Barthelemy">St Barthelemy</option>
                        <option value="St Eustatius">St Eustatius</option>
                        <option value="St Helena">St Helena</option>
                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                        <option value="St Lucia">St Lucia</option>
                        <option value="St Maarten">St Maarten</option>
                        <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                        <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                        <option value="Saipan">Saipan</option>
                        <option value="Samoa">Samoa</option>
                        <option value="Samoa American">Samoa American</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syria">Syria</option>
                        <option value="Tahiti">Tahiti</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania">Tanzania</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Erimates">United Arab Emirates</option>
                        <option value="United States of America">United States of America</option>
                        <option value="Uraguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Vatican City State">Vatican City State</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                        <option value="Wake Island">Wake Island</option>
                        <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zaire">Zaire</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationDefault05">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationDefault06">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                    <label class="form-check-label" for="invalidCheck2">
                      Agree to create admin
                    </label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Create New Admin</button>
            {!!Form::close()!!}
        </div>

      </div>
    </div>
  </div>
{{--  --}}
<!-- Modal -->
<div class="modal fade" id="adminview" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Admin's Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span class="font-weight:300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="">
                        <div class="">
                            <div>
                                <h6 class="main-content-label mb-1 text-center">All Admin's Information</h6>
                                <p class="text-muted card-sub-title text-center">You can remove or add admins as well as change the role or power of the admins.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="example1">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="wd-20p">Name</th>
                                            <th class="wd-25p">Username</th>
                                            <th class="wd-20p">Email</th>
                                            <th class="wd-15p">User Control Power</th>
                                            <th class="wd-20p">Job Power</th>
                                            <th class="wd-20p">Job Price Power</th>
                                            <th class="wd-20p">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadnow">
                                        @foreach ($adminInfo as $admin)
                                        <tr class="text-center item{{$admin->id}}">
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->username}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td><input type="checkbox" data-ofid="0" data-onid="1" data-jobid="{{$admin->id}}" class="checkbox {{$admin->getAdminRole->user_delete_power == 1 ? 'userDeleteActive':'userDeleteDeactive'}}" {{$admin->getAdminRole->user_delete_power == 1 ? "checked":""}} /></td>
                                            <td><input type="checkbox" data-ofid="0" data-onid="1" data-jobid="{{$admin->id}}" class="checkbox {{$admin->getAdminRole->job_power == 1 ? 'jobPowerActive':'jobPowerDeactive'}}" {{$admin->getAdminRole->job_power == 1 ? "checked":""}} /></td>
                                            <td><input type="checkbox" data-ofid="0" data-onid="1" data-jobid="{{$admin->id}}" class="checkbox {{$admin->getAdminRole->job_price_power == 1 ? 'jobPriceActive':'jobPriceDeactive'}}" {{$admin->getAdminRole->job_price_power == 1 ? "checked":""}} /></td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-info admin-edit"
                                                    data-toggle="modal" data-target="#editModal"
                                                    data-id="{{$admin->id}}" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <a class="deleteuser" data-id="{{$admin->id}}">
                                                    <button class="btn btn-danger category-delete"
                                                    title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Admin Informations</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span class="font-weight:300;">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
            {!!Form::open(['class' => 'form-horizontal','id'=>'adminUpdate'])!!}
            @csrf
           <div class="form-group row">
               <label for="name" class="col-sm-3 col-form-label">Name</label>
               <div class="col-sm-9">
                   <input class="form-control" type="text" name="name" id="name">
                   <input class="form-control" type="hidden" name="admin_id" id="admin_id">
               </div>
           </div>
           <div class="form-group row">
               <label for="name" class="col-sm-3 col-form-label">User Name</label>
               <div class="col-sm-9">
                   <input class="form-control" type="text" id="username" name="username">
               </div>
           </div>
           <div class="form-group row">
               <label for="name" class="col-sm-3 col-form-label">Email</label>
               <div class="col-sm-9">
                   <input class="form-control" type="email" id="email" name="email">
               </div>
           </div>
            <div class="form-group m-b-0">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update Here...
                    </button>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="editUserBalance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalLabel">$_Balance Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><span style="font-weight: 300">&times;</span></span>
          </button>
        </div>
        <div class="modal-body">
            {!!Form::open(['class' => 'form-horizontal','id'=>'balanceEditing'])!!}
            @csrf
           <div class="form-group row">
               <label for="name" class="col-sm-3 col-form-label">$_Balance</label>
               <div class="col-sm-9">
                   <input class="form-control" type="number" min="1" step="any" name="balance" id="balanceChangesOption" placeholder="Total Balance">
                   <input class="form-control" type="hidden" name="old_balance" id="old_balance" placeholder="Total Balance">
                   <input class="form-control" type="hidden" name="user_id" id="user_id">
                   <input class="form-control" type="hidden" id="old_withdrawable" name="old_withdrawable" placeholder="Only withdrawable">
               </div>
           </div>

            <div class="form-group m-b-0">
                <div class="text-right">
                    <button type="submit" class="btn btn-sm  btn-primary">
                        <i class="fa fa-dollar"></i> Update $_Balance...
                    </button>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>

@endsection
@section('js')
<script src="{{asset('backend/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/fileexport/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/assets/js/table-data.js') }}"></script>
<script>
    $('#countries').select2();
    // add form validation
        // $("#adminSave").validate({
        //     rules: {
        //         name: {
        //             required:true,
        //             maxlength: 50,
        //         },
        //         username: {
        //             required:true,
        //             maxlength: 50,
        //         },
        //         email: {
        //             required:true,
        //         },
        //         country: {
        //             required:true,
        //         },
        //         password: {
        //             required:true,
        //             minlength:8
        //         },
        //         password_confirmation: {
        //             required:true,
        //             equalTo: "#password"
        //         },
        //     },
        //     errorPlacement: function(label, element) {
        //         label.addClass('mt-2 text-danger');
        //         label.insertAfter(element);
        //     },
        // });
        $("#adminUpdate").validate({
            rules: {
                name: {
                    required:true,
                    maxlength: 50,
                },
                username: {
                    required:true,
                    maxlength: 50,
                },
                email: {
                    required:true,
                }
            },
            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
        });
        //end
    $(document).ready( function () {

    //edit data
    $(document).on('click', '.admin-edit', function () {
        let id = $(this).attr('data-id');
        $.ajax({
            url: "{{url('admindetails')}}/" + id + '/edit',
            method: "get",
            data: {},
            dataType: 'json',
            success: function (response) {
                let url = window.location.origin;
                // console.log('data', response);
                $('#name').val(response.data.name);
                $('#username').val(response.data.username);
                $('#email').val(response.data.email);
                $('#admin_id').val(response.data.id);
            },
            error: function (error) {
                if (error.status == 404) {
                    toastr.error('Not found!');
                }
            }
        });
    });
    $(document).on('click', '.balance-edit', function () {
        let id = $(this).attr('data-id');
        $.ajax({
            url: "{{url('userbalancedetails')}}/" + id + '/edit',
            method: "get",
            data: {},
            dataType: 'json',
            success: function (response) {
                let url = window.location.origin;
                let currentBalance = response.data.balance == null ? "0" : response.data.balance;
                $('#balanceChangesOption').val(currentBalance);
                $('#old_balance').val(response.data.balance);
                $('#old_withdrawable').val(response.data.withdrawable);
                $('#user_id').val(response.data.id);
            },
            error: function (error) {
                if (error.status == 404) {
                    toastr.error('Not found!');
                }
            }
        });
    });

    //Delete data
    $(document).on('click', '.deleteuser', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then(result => {
                    if (result.value) {
                        $.ajax({
                            url: "{!! route('user.destroy') !!}",
                            type: "get",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log('tt',response);
                                toastr.options = {
                                    "debug": false,
                                    "positionClass": "toast-bottom-right",
                                    "onclick": null,
                                    "fadeIn": 200,
                                    "fadeOut": 3000,
                                    "timeOut": 5000,
                                    "extendedTimeOut": 1000,
                                };
                                if (response.status === false) {
                                    // toastr.warning(response.message);
                                    Swal.fire(
                                    'Really you want to delete?',
                                    'Please remove this user\'s tier\'s users first!',
                                    'warning'
                                    )
                                }
                                if (response.status === true) {
                                    toastr.success('Admin removed successfully');
                                    setTimeout(function(){
                                        $('#example2').DataTable().row('.item' + response.data.id)
                                        .remove()
                                        .draw();
                                    }, 1500);

                                }
                            }
                        });
                    }
                }
            )
        });
    //save data
    $('#adminSave').on('submit', function (e) {
            e.preventDefault();
            // var $form = $(this);
            // if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('admin.create')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    // console.log('save', response.data);
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                    };

                    if(response.status == 0){
                        $.each(response.error,function(key,value){
                            toastr.error(value);
                        })
                    }else{
                        if(response.status == true){
                            $('#userSave').trigger('reset');
                            $('#staticBackdrop').modal('hide');
                            toastr.success(response.message);
                            setTimeout(function(){
                                window.location.reload();
                            }, 1500);
                        }
                    }
                }
            });
        });
        // //Update data
        $('#adminUpdate').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('admin.updated')}}",
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
                        if(data.status = true){
                            $('#editModal').modal('hide');
                            toastr.success('Admin\'s Information Updated Successfully!');
                            $('#adminUpdate').trigger('reset');
                            setTimeout(function () {
                                $("#loadnow").load(location.href + " #loadnow>*", "");
                            }, 1000);

                        }
                    }
                }
            });
        });
        // Balance Editing
        $('#balanceEditing').on('submit', function (e) {
            e.preventDefault();
            // var $form = $(this);
            // if(! $form.valid()) return false;
            $.ajax({
                url: "{{route('balance.editing')}}",
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
                        if(data.status = true){
                            $('#editUserBalance').modal('hide');
                            toastr.success('User\'s $_Balance Updated Successfully!');
                            $('#balanceEditing').trigger('reset');
                            setTimeout(function () {
                                $("#loadBalance").load(location.href + " #loadBalance>*", "");
                            }, 1000);

                        }
                    }
                }
            });
        });
        //=======================
        //  User Delete Power
        // ======================
        $(document).on('click','.userDeleteDeactive',function(){
          var id = $(this).data('onid');
          var jobid = $(this).data('jobid');
          console.log('jobid',jobid);
          $(this).removeClass('userDeleteDeactive');
          $(this).addClass('userDeleteActive');
          $.ajax({
            url: "{!! route('jobdelete.status') !!}",
            type: "get",
            data: {
              id: id,
              jobid: jobid,

            },
            success: function(data) {
              console.log(data);
              toastr.options = {
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "fadeIn": 300,
                            "fadeOut": 1000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000
                  };
                if(data.status == true){
                    toastr.success('Power Activated Successfully');
                }
            },

          });
        });

        $(document).on('click','.userDeleteActive',function(){
          var id = $(this).data('ofid');
          var jobid = $(this).data('jobid');
          $(this).removeClass('userDeleteActive');
          $(this).addClass('userDeleteDeactive');
          $.ajax({
            url: "{!! route('jobdelete.status') !!}",
            type: "get",
            data: {
              id: id,
              jobid: jobid,

            },
            success: function(data) {
              console.log(data);
              toastr.options = {
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "fadeIn": 300,
                            "fadeOut": 1000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000
                  };
                if(data.status == true){
                    toastr.success('Power Deactivated Successfully');
                }
            },

          });
        });

        //=======================
        //  Job Power
        // ======================
        $(document).on('click','.jobPowerDeactive',function(){
          var id = $(this).data('onid');
          var jobid = $(this).data('jobid');
          console.log('jobid',jobid);
          $(this).removeClass('jobPowerDeactive');
          $(this).addClass('jobPowerActive');
          $.ajax({
            url: "{!! route('jobpower.status') !!}",
            type: "get",
            data: {
              id: id,
              jobid: jobid,

            },
            success: function(data) {
              console.log(data);
              toastr.options = {
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000
                  };
                if(data.status == true){
                    toastr.success('Power Activated Successfully');
                }
            },

          });
        });

        $(document).on('click','.jobPowerActive',function(){
          var id = $(this).data('ofid');
          var jobid = $(this).data('jobid');
          $(this).removeClass('jobPowerActive');
          $(this).addClass('jobPowerDeactive');
          $.ajax({
            url: "{!! route('jobpower.status') !!}",
            type: "get",
            data: {
              id: id,
              jobid: jobid,

            },
            success: function(data) {
              console.log(data);
              toastr.options = {
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "fadeIn": 300,
                            "fadeOut": 1000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000
                  };
                if(data.status == true){
                    toastr.success('Power Deactivated Successfully');
                }
            },

          });
        });
        //=======================
        //  Job Price Power
        // ======================
        $(document).on('click','.jobPriceDeactive',function(){
          var id = $(this).data('onid');
          var jobid = $(this).data('jobid');
          console.log('jobid',jobid);
          $(this).removeClass('jobPriceDeactive');
          $(this).addClass('jobPriceActive');
          $.ajax({
            url: "{!! route('jobprice.status') !!}",
            type: "get",
            data: {
              id: id,
              jobid: jobid,

            },
            success: function(data) {
              console.log(data);
              toastr.options = {
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "fadeIn": 300,
                            "fadeOut": 1000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000
                  };
                if(data.status == true){
                    toastr.success('Power Activated Successfully');
                }
            },

          });
        });

        $(document).on('click','.jobPriceActive',function(){
          var id = $(this).data('ofid');
          var jobid = $(this).data('jobid');
          $(this).removeClass('jobPriceActive');
          $(this).addClass('jobPriceDeactive');
          $.ajax({
            url: "{!! route('jobprice.status') !!}",
            type: "get",
            data: {
              id: id,
              jobid: jobid,

            },
            success: function(data) {
              console.log(data);
              toastr.options = {
                            "debug": false,
                            "positionClass": "toast-bottom-right",
                            "onclick": null,
                            "fadeIn": 300,
                            "fadeOut": 1000,
                            "timeOut": 5000,
                            "extendedTimeOut": 1000
                  };
                if(data.status == true){
                    toastr.success('Power Deactivated Successfully');
                }
            },

          });
        });
    });
</script>
@endsection
