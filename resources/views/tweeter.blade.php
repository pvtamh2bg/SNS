@extends('layouts.app')

@section('title', 'tweeter')

@section('content')
<div class="result-content" id="detail-gallery" :class="{active: loadingData}">
	<div class="row list-row">
		<div class="body-title">
			<b><span class="date-time" v-text="date"></span> all posts</b>
		</div>
	</div>

	<div class="row thumbnail-row" style="display: none;">
		<div class="body-title">
			<b><span class="date-time" v-text="date"></span> all thumbnails</b>
		</div>
	</div>
	<div class="row button-row" style="display: none;">
		<div class="body-button" style="margin: 0 auto; margin-top: 5px;">
			<a type="button" target="_blank" :href="'/api/twdownload?username=' + username + '&date_req=' + date" v-if="showDownload" class="btn btn-warning mb-2" style="color: #fff; font-size: 13px; font-weight: 600;">Download</a>
		</div>
	</div>
	<tweets :tweets="tweets" :messages="messages"></tweets>
	<div class="err-show alert alert-danger text-center border border-danger" role="alert" :class="{active: ERR}">
		Some Things went wrong! Sorry!
	</div>
	<h2 :class="{active: (tweets.length == 0 && !loadingData && !loadingLogin && !ERR)}" :style="{ opacity: 0.8 }" class="text-center no-data">“No data available”</h2>
</div>
@endsection

<style type="text/css">
	.result-content.active{
		opacity: 0.2;
	}
</style>

