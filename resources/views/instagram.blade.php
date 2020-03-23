@extends('layouts.app')

@section('title', 'instagram')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    	<div class="modal-content" style="width: 280px;">
      		<div class="modal-header">
        		<h7 class="modal-title" id="exampleModalLabel" style="font-weight: 600;">Choose Page</h7>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
      			<label class="dropdown-item select-menu-item assignment-name chooseName checkbox-item" role="checkbox" aria-checked="false" tabindex="0" aria-labelledby="chk1-label" style="">
                	<svg class="octicon octicon-check select-menu-item-icon" width="12" height="16" viewBox="0 0 12 16" aria-hidden="true" style="margin-right: 7px; margin-top: 2px;">
			            <path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z" />
			        </svg>
			        <input style="display: none;" type="checkbox" name="page" value="" data-id="" class="edit-check-assignee" data-name="" data-avatar="">
			        <div class="page-image-container">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </div>
			        <div class="page-text" style="">
			        	<span class="page-name" style="font-size: 14px;">TMH TechLab</span>
			        </div>
                </label>

                <label class="dropdown-item select-menu-item assignment-name chooseName checkbox-item" role="checkbox" aria-checked="false" tabindex="0" aria-labelledby="chk1-label" style=" ">
                	<svg class="octicon octicon-check select-menu-item-icon" width="12" height="16" viewBox="0 0 12 16" aria-hidden="true" style="margin-right: 7px; margin-top: 2px;">
			            <path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z" />
			        </svg>
			        <input style="display: none;" type="checkbox" name="page" value="" data-id="" class="edit-check-assignee" data-name="" data-avatar="">
			        <div class="page-image-container">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </div>
			        <div class="page-text" style="">
			        	<span class="page-name" style="font-size: 14px;">TMH TechLab</span>
			        </div>
                </label>

                <label class="dropdown-item select-menu-item assignment-name chooseName checkbox-item" role="checkbox" aria-checked="false" tabindex="0" aria-labelledby="chk1-label" style=" ">
                	<svg class="octicon octicon-check select-menu-item-icon" width="12" height="16" viewBox="0 0 12 16" aria-hidden="true" style="margin-right: 7px; margin-top: 2px;">
			            <path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z" />
			        </svg>
			        <input style="display: none;" type="checkbox" name="page" value="" data-id="" class="edit-check-assignee" data-name="" data-avatar="">
			        <div class="page-image-container">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </div>
			        <div class="page-text" style="">
			        	<span class="page-name" style="font-size: 14px;">TMH TechLab</span>
			        </div>
                </label>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        		<button type="button" class="btn btn-primary btn-sm">Submit</button>
      		</div>
		</div>
  	</div>
</div>
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
			<a type="button" target="_blank" href="" class="btn btn-warning mb-2" style="color: #fff; font-size: 13px; font-weight: 600;">Download</a>
		</div>
	</div>

	<div class="wrapper" style="padding: 30px 50px 50px 50px;">
		<div class="box">
			<div class="content-container">
				<div class="top-content">
                    <div class="icon-container">
						<span class="sns-icon">
							<img src='img/instagram.png' alt="Image">
						</span>
                    </div>
                    <div class="text-top-content">
                        <div class="sns-name">
                            <p><b>Instagram</b></p>
                        </div>
                        <div class="sns-account">
                            <p>Trang.it.93</p>
                        </div>
                    </div>
                </div>
                <div class="image-content">
                    <div class="date-area" style="display: none;">
                        <div class="text-date-area">
                            2019-12-01-01
                        </div>
                    </div>
                    <a href="" target="_blank">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </a>
                </div>
				<div class="icon-function-area">
					<div class="row" style="margin: 0 auto;">
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-heart-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-comment-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
					</div>
				</div>
				<div class="description-content">
					<p>This is instagram post This is instagram post is is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post
					 This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post</p>
				</div>
				<div class="date-time-area">
					01:37 . 07/01/2020
				</div>
			</div>
		</div>
		<div class="box">
			<div class="content-container">
				<div class="top-content">
                    <div class="icon-container">
						<span class="sns-icon">
							<img src='img/instagram.png' alt="Image">
						</span>
                    </div>
                    <div class="text-top-content">
                        <div class="sns-name">
                            <p><b>Instagram</b></p>
                        </div>
                        <div class="sns-account">
                            <p>Trang.it.93</p>
                        </div>
                    </div>
                </div>
                <div class="image-content">
                    <div class="date-area" style="display: none;">
                        <div class="text-date-area">
                            2019-12-01-01
                        </div>
                    </div>
                    <a href="" target="_blank">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </a>
                </div>
				<div class="icon-function-area">
					<div class="row" style="margin: 0 auto;">
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-heart-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-comment-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
					</div>
				</div>
				<div class="description-content">
					<p>This is instagram post This is instagram post is is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post
					 This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post</p>
				</div>
				<div class="date-time-area">
					01:37 . 07/01/2020
				</div>
			</div>
		</div>
		<div class="box">
			<div class="content-container">
				<div class="top-content">
                    <div class="icon-container">
						<span class="sns-icon">
							<img src='img/instagram.png' alt="Image">
						</span>
                    </div>
                    <div class="text-top-content">
                        <div class="sns-name">
                            <p><b>Instagram</b></p>
                        </div>
                        <div class="sns-account">
                            <p>Trang.it.93</p>
                        </div>
                    </div>
                </div>
                <div class="image-content">
                    <div class="date-area" style="display: none;">
                        <div class="text-date-area">
                            2019-12-01-01
                        </div>
                    </div>
                    <a href="" target="_blank">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </a>
                </div>
				<div class="icon-function-area">
					<div class="row" style="margin: 0 auto;">
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-heart-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-comment-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
					</div>
				</div>
				<div class="description-content">
					<p>This is instagram post This is instagram post is is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post
					 This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post</p>
				</div>
				<div class="date-time-area">
					01:37 . 07/01/2020
				</div>
			</div>
		</div>
		<div class="box">
			<div class="content-container">
				<div class="top-content">
                    <div class="icon-container">
						<span class="sns-icon">
							<img src='img/instagram.png' alt="Image">
						</span>
                    </div>
                    <div class="text-top-content">
                        <div class="sns-name">
                            <p><b>Instagram</b></p>
                        </div>
                        <div class="sns-account">
                            <p>Trang.it.93</p>
                        </div>
                    </div>
                </div>
                <div class="image-content">
                    <div class="date-area" style="display: none;">
                        <div class="text-date-area">
                            2019-12-01-01
                        </div>
                    </div>
                    <a href="" target="_blank">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </a>
                </div>
				<div class="icon-function-area">
					<div class="row" style="margin: 0 auto;">
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-heart-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-comment-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
					</div>
				</div>
				<div class="description-content">
					<p>This is instagram post This is instagram post is is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post
					 This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post</p>
				</div>
				<div class="date-time-area">
					01:37 . 07/01/2020
				</div>
			</div>
		</div>
		<div class="box">
			<div class="content-container">
				<div class="top-content">
                    <div class="icon-container">
						<span class="sns-icon">
							<img src='img/instagram.png' alt="Image">
						</span>
                    </div>
                    <div class="text-top-content">
                        <div class="sns-name">
                            <p><b>Instagram</b></p>
                        </div>
                        <div class="sns-account">
                            <p>Trang.it.93</p>
                        </div>
                    </div>
                </div>
                <div class="image-content">
                    <div class="date-area" style="display: none;">
                        <div class="text-date-area">
                            2019-12-01-01
                        </div>
                    </div>
                    <a href="" target="_blank">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </a>
                </div>
				<div class="icon-function-area">
					<div class="row" style="margin: 0 auto;">
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-heart-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-comment-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
					</div>
				</div>
				<div class="description-content">
					<p>This is instagram post This is instagram post is is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post
					 This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post</p>
				</div>
				<div class="date-time-area">
					01:37 . 07/01/2020
				</div>
			</div>
		</div>
		<div class="box">
			<div class="content-container">
				<div class="top-content">
                    <div class="icon-container">
						<span class="sns-icon">
							<img src='img/instagram.png' alt="Image">
						</span>
                    </div>
                    <div class="text-top-content">
                        <div class="sns-name">
                            <p><b>Instagram</b></p>
                        </div>
                        <div class="sns-account">
                            <p>Trang.it.93</p>
                        </div>
                    </div>
                </div>
                <div class="image-content">
                    <div class="date-area" style="display: none;">
                        <div class="text-date-area">
                            2019-12-01-01
                        </div>
                    </div>
                    <a href="" target="_blank">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </a>
                </div>
				<div class="icon-function-area">
					<div class="row" style="margin: 0 auto;">
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-heart-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-comment-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
					</div>
				</div>
				<div class="description-content">
					<p>This is instagram post This </p>
				</div>
				<div class="date-time-area">
					01:37 . 07/01/2020
				</div>
			</div>
		</div>
		<div class="box">
			<div class="content-container">
				<div class="top-content">
                    <div class="icon-container">
						<span class="sns-icon">
							<img src='img/instagram.png' alt="Image">
						</span>
                    </div>
                    <div class="text-top-content">
                        <div class="sns-name">
                            <p><b>Instagram</b></p>
                        </div>
                        <div class="sns-account">
                            <p>Trang.it.93</p>
                        </div>
                    </div>
                </div>
                <div class="image-content">
                    <div class="date-area" style="display: none;">
                        <div class="text-date-area">
                            2019-12-01-01
                        </div>
                    </div>
                    <a href="" target="_blank">
                        <img src='img/IMG_2308.JPG' alt="Image">
                    </a>
                </div>
				<div class="icon-function-area">
					<div class="row" style="margin: 0 auto;">
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-heart-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
						<div class="col-4 col-md-3 reaction">
							<i class="fa fa-comment-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
							<div class="number-like">12345</div>
						</div>
					</div>
				</div>
				<div class="description-content">
					<p>This is instagram post This is instagram post is is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post
					 This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post This is instagram post</p>
				</div>
				<div class="date-time-area">
					01:37 . 07/01/2020
				</div>
			</div>
		</div>
	</div>
@endsection

<style type="text/css">
	.result-content.active{
		opacity: 0.2;
	}
</style>

