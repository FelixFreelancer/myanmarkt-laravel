@extends('basic.master')
@section('content')
    <link rel="stylesheet" href="{{asset('./assets/css/user-ads.css')}}">
    <div class="row user-ads-section">
        <div class="col-md-3">
            <div class="user-ads-info">

                user-ads-info
            </div>
        </div>
        <div class="col-md-9 user-ads-list">
            <div class="user-ads-title">
                user-ads-info
            </div>
            {{--<div class="">--}}
                @foreach($user_ads as $key=>$user_ads_one)
                    <div class="user-ads-one">
                        <div class="b-card--el-header">
                            <a href="/user-ads/edit/{{$user_ads_one->id}}">
                                <img class="b-card--el-view img-responsive" src="../upload/{{isset($user_ads_images[$key]->ads_image) ? $user_ads_images[$key]->ads_image : 'Lincoln.jpg'}} " alt="">
                                <span class="b-card--el-featured-label">Promoted</span>
                            </a>

                        </div>
                        <div class="b-card--el-details">
                            <p class="b-ad-excerpt b-par-mod-clear b-line-mod-thin--mix-vehicle">
                                {{$ads_categories[$key][0]->name}}, Fereej Bin Mahmoud
                                <span class="ads-delete-button" ads-id="{{$user_ads_one->id}}" onclick="adsDelete(event);">delete</span>
                            </p>

                            <a href="/user-ads/edit/{{$user_ads_one->id}}" class="b-card--el-brand">
                                <p class="b-card--el-description">{{$user_ads_one->ads_main_name}}</p>
                            </a>
                            <p style="display: none;" class="b-card--el-brief-details">96,000 km </p>
                            <div style="display: none;" class="b-card--el-vehicle-price" >63,000
                                <span >QAR</span>
                            </div>
                            <div class="b-card--el-agency" style="display: none;">
                                <a href="">
                                    <img src="" alt="" class="b-card--el-agency-logo">
                                </a>
                                <div class="b-card--el-agency-info">
                                    <p class="b-card--el-agency-time">about 10 hours ago</p>
                                    <p class="b-card--el-agency-title">&nbsp; by</p>
                                    <a href="" class="b-card--el-agency-title">&nbsp; user name</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            {{--</div>--}}
        </div>
    </div>
    <script>
        function adsDelete(event){
         var ads_id =  event.target.getAttribute('ads-id');

         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $.post('{{route('user.ads.delete')}}', {
             //UserAdsController@deleteAds
             ads_id: ads_id
         }, function (data) {
             if (data == 0){
                 location.reload();
             }
         })

        }
    </script>
@endsection
