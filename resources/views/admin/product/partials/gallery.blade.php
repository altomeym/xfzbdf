<div>
	<input type="hidden" name="id" value="{{ @$product->id }}" class="form-control product-id" />
	<div class="mt-60px">
		<span class="fw-bold h2 m-0">Showcase Your Services In A Gallery</span>
	</div>
	<div class="my-5 p-5 border bg-light">
		To comply with Fiverr’s terms of service, make sure to upload only content you either own or you have the permission or license to use.
	</div>
	<hr />

	<div class="my-4 mb-2">
		<span class="fw-bold h4">Images (up to {{ getMaxNumberOfImgsForInventory() }})</span>
		<span class="fw-bold text-green d-block pointer" data-src="{{ config('shop.product.video.gallery.images') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
	</div>
	<p class="">
		Get noticed by the right buyers with visual examples of your services.
	</p>
	<div class="form-group">
		<div class="file-loading">
			<input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
		</div>
		{{-- <span class="small"><i class="fa fa-info-circle"></i> {{ trans('help.multi_img_upload_instruction', ['size' => getAllowedMaxImgSize(),'number' => getMaxNumberOfImgsForInventory()]) }}</span> --}}
	</div>
	<hr />

	{{-- <div class="my-4 mb-2">
		<span class="fw-bold h4">Outsource Link</span>
		<span class="fw-bold text-green d-block pointer" data-src="{{ config('shop.product.video.gallery.outsource') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
	</div>
	<p class="">
		Get noticed by the right buyers with visual examples of your services.
	</p>
	<input type="text" name="out_source_link" value="{{ @$product->out_source_link }}" class="form-control" />
	<hr /> --}}

	<div class="my-4 mb-2">
		<span class="fw-bold h4">Youtube Video Link</span>
		<span class="fw-bold text-green d-block pointer" data-src="{{ config('shop.product.video.gallery.video') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
	</div>
	<p class="">
		Get noticed by the right buyers with visual examples of your services.
	</p>
	<input type="text" name="video_link" value="{{ @$product->video_link }}" class="form-control" />
	<hr />

	<div class="my-5 clearfix">
		<span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
		<button type="submit" class="btn btn-gig btn-success pull-right" id="gallery-form">Save</button>
	</div>
</div>