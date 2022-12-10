<div>    
	<input type="hidden" name="id" value="{{ @$product->id }}" class="form-control product-id" />
	{{-- Description --}}
	<div class="mt-60px">
		<span class="fw-bold h2 m-0">Description</span>
	</div>
	<span class="fw-bold text-green pointer" data-src="{{ config('shop.product.video.description_and_faqs.description') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
	<div class="">
		Briefly Describe Your Service
	</div>
	<hr />
	<div class="border">
		<div class="gig-pkg" id="overview">
			<textarea class="form-control summernote" name="description" rows="10">@if(isset($product)) {{ $product->description }} @endif</textarea>
		</div>
	</div>

	{{-- FAQs --}}
	<div class="add-gig-faq">
		<div class="mt-60px clearfix">
			<span class="pull-left fw-bold h2 m-0">FAQs</span>
			<span class="pull-right pointer" id="add-faqs"><i class="fa fa-plus mr-2"></i>Add FAQ</span>
		</div>
		<span class="fw-bold text-green pointer" data-src="{{ config('shop.product.video.description_and_faqs.faqs') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
		<div class="">
			Add Questions & Answers for Your Buyers.
		</div>
		<hr />
		<div id="add-new-faq-field" class="w-100 d-none">
			<div class="panel-body px-0">
				<input type="text" class="form-control mb-4" id="newFaqQuestion" placeholder="Add a Question: Do you transalte to English?" />
				<textarea class="form-control" id="newFaqAnswer" rows="5" placeholder="Add a Anwser: i.e. Yes, I can translate from English to Urdu"></textarea>
			</div>
			<div class="mt-2 mb-3 clearfix">
				<div class="pull-right">
					<span id="cancel-add-new-faq" class="btn btn-lg btn-outline-secondary">Cancel</span>
					<button type="button" id="addNewFaqButon" class="btn btn-lg btn-success">Add</button>
				</div>
			</div>
		</div>
		<div class="" id="allFaqsShow">
			@if(isset($product) && is_array($product->product_faqs))
				@foreach($product->product_faqs as $faqs)
						<div class="panel-group" id="faqAccordion{{ $faqs->id }}">
						<div class="panel panel-default">
								<div class="panel-heading accordion-toggle question-toggle collapsed pointer" data-toggle="collapse" data-parent="#faqAccordion{{ $faqs->id }}" data-target="#question{{ $faqs->id }}">
								<h4 class="panel-title">
										{{ $faqs->question }}
								</h4>
								</div>
								<div id="question{{ $faqs->id }}" class="panel-collapse collapse" style="height: 0px;">
								<div class="panel-body">
										<input type="text" class="form-control mb-4" name="faq[{{ $faqs->id }}][question]" value="{{ $faqs->question }}" />
										<textarea class="form-control" name="faq[{{ $faqs->id }}][answer]" rows="5">{{ $faqs->answer }}</textarea>
								</div>
								<div class="mt-2 mb-3 clearfix mx-4">
										<div class="pull-left pt-2 deleteFaq pointer">
										<i class="fa fa-times-circle mr-2"></i> Delete
										</div>
										<div class="pull-right">
										<!--span href="" class="btn btn-lg btn-outline-secondary">Cancel</span-->
										<!--button type="button" class="btn btn-lg btn-success">Save</button-->
										</div>
								</div>
								</div>
						</div>
						</div>
				@endforeach
			@endif
		</div>
	</div>

	{{-- SEO --}}
	<div class="mt-60px">
		<span class="fw-bold h2 m-0">SEO Detail</span>
	</div>
	<span class="fw-bold text-green pointer" data-src="{{ config('shop.product.video.description_and_faqs.seo_detail') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
	<div class="">
		Describe Your SEO detail
	</div>
	<hr />
	<div class="form-group">
		{!! Form::label('meta_title', trans('app.form.meta_title'), ['class' => 'with-help']) !!}
		{{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.meta_title') }}"></i> --}}
		{!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_title')]) !!}
		<div class="help-block with-errors"></div>
	</div>

	<div class="form-group">
		{!! Form::label('meta_description', trans('app.form.meta_description'), ['class' => 'with-help']) !!}
		{{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.meta_description') }}"></i> --}}
		{!! Form::text('meta_description', null, ['class' => 'form-control', 'maxlength' => config('seo.meta.description_character_limit', '160'), 'placeholder' => trans('app.placeholder.meta_description')]) !!}
		<div class="help-block with-errors"><small><i class="fa fa-info-circle"></i> {{ trans('help.max_chat_allowed', ['size' => config('seo.meta.description_character_limit', '160')]) }}</small></div>
	</div>

	<div class="my-5 clearfix">
		<span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
		<button type="submit" class="btn btn-gig btn-success pull-right" from="description-faqs">Save</button>
	</div>
</div>