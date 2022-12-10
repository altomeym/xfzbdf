@php
$tags = \App\Models\Tag::get()->pluck('name','id');
@endphp
<div class="">
	<div class="" id="overview">
		{{-- <form action="{{ route('admin.catalog.product.update', $product->id) }}" method="post" class="proposal-form-" id="overview-form"> --}}
		{{-- @csrf --}}
			<div class="bg-white border mt-60px p-5">
				<input type="hidden" name="active" value="1" />
				<div class="form-group row mb-5"><!--- form-group row Starts --->
					<div class="col-md-4">
						<span class="fw-bold d-block">{!! Form::label('name', trans('app.form.service_title') . '*') !!}</span>
						<span class="fw-bold d-block mb-2 text-green pointer" data-src="{{ config('shop.product.video.overview.title') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
						<span>Your title is the most important place to include keywords that buyers would likely use to search.</span>
					</div>
					<div class="col-md-8">
						{!! Form::textarea('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.title'), 'rows' => '3', 'required']) !!}
						{{-- <div class="help-block with-errors"></div> --}}
						{{-- <textarea name="proposal_title" rows="3" required="" placeholder="I Will" class="form-control"></textarea> --}}
					</div>
					<small class="form-text text-danger"></small>
				</div><!--- form-group row Ends --->

				<div class="form-group row mb-5"><!--- form-group row Starts --->
					<div class="col-md-4">
						<span class="fw-bold d-block mb-2">{!! Form::label('category_list[]', trans('app.form.categories') . '*') !!}</span>
						<span class="fw-bold d-block mb-2 text-green pointer" data-src="{{ config('shop.product.video.overview.categories') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
						<span>Choose the most suitable category for your service.</span>
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6 nopadding-right">
								<div class="form-group">
									@php
										// $categories = \App\Helpers\ListHelper::categories();
										// $cc = \App\Models\Category::find($product->category->id);
										$cat_groups = \App\Helpers\ListHelper::categoryGrps();
										if(@$product->categories){
											$category_id = $product->categories[0]->id;
											$category_sub_group_id = $product->categories[0]->category_sub_group_id;

											$catgory_sub_group = \App\Models\CategorySubGroup::find($category_sub_group_id);
											$category_group_id = $catgory_sub_group->category_group_id;

											$cat_sub_groups =  \App\Models\CategorySubGroup::where('category_group_id',$category_group_id)->get();
											$categories_ =  \App\Models\Category::where('category_sub_group_id',$category_sub_group_id)->get();
										}else{
											$category_id = 0;
											$category_sub_group_id = 0;
											$category_group_id = 0;
											$cat_sub_groups = [];
											$categories_ = [];
										}
									// $categories = array_merge(['name' => 'Select category'],$categories);
									@endphp
									{{-- {!! Form::select('category_list', $categories, null, ['class' => 'form-control select2-', 'id' => 'catGrps', 'required']) !!} --}}
									<select name="category_list" id="catGrps" class="form-control select2-" required="" style="">
										<option value="">Select a Category</option>
										@foreach($cat_groups as $index => $category)
											<option value="{{ $index }}" @if($category_group_id == $index) selected @endif>{{ $category }}</option>
										@endforeach
									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							{{-- <small class="form-text text-danger"></small> --}}
							<div class="col-md-6 nopadding-left">
								{{-- {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], !isset($product) ? 1 : null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!} --}}
								<select name="proposal_child_id" id="catSubGrps" class="form-control select2-" required="" style="">
									<option value="">Select a Subcategory</option>
									@foreach($cat_sub_groups as $index => $category)
										<option value="{{ $category->id }}" @if($category_sub_group_id == $category->id) selected @endif>{{ $category->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row mb-5">
					<div class="col-md-4">
						<span class="fw-bold d-block mb-2">Service Type</span>
						<span class="fw-bold d-block mb-2 text-green pointer" data-src="{{ config('shop.product.video.overview.service_type') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
						<span>You can choose the multiple services.</span>
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6 nopadding-right">
								<div class="form-group">
									<select name="category_list[]" id="categories" class="form-control" required="" style="">
										<option value="">Select a Service Type</option>
										@foreach($categories_ as $index => $category)
											<option value="{{ $category->id }}" @if($category_id == $category->id) selected @endif>{{ $category->name }}</option>
										@endforeach
									</select>
									{{-- {!! Form::select('category_list', $categories, null, ['class' => 'form-control', 'required']) !!} --}}
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
					</div>
				</div><!--- form-group row Ends --->

				<div class="form-group row mb-5"><!--- form-group row Starts --->
					<div class="col-md-4">
						<span class="fw-bold d-block mb-2">Search Tags</span>
						<span class="fw-bold d-block mb-2 text-green pointer" data-src="{{ config('shop.product.video.overview.search_tags') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
						<span>Enter the tags that are relevant to your service.</span>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							{!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' => 'multiple']) !!}
						</div>
						<small class="form-text text-danger"></small>
					</div>
				</div><!--- form-group row Ends --->
			</div>
			<div class="my-5 clearfix">
				<span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
				<button type="submit" class="btn btn-gig btn-success pull-right" form="overview-form">Save</button>
			</div>
	</div>
</div>