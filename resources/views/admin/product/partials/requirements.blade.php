<div>
	<input type="hidden" name="id" value="{{ @$product->id }}" class="form-control product-id" />
	<div class="bg-white border mt-60px p-5 add-gig-requirement">
		<div class="h4 fw-bold">Get all the information you need from buyers to get started</div>
		<p>Add questions to help buyers provide you with exactly what you need to start working on their order.</p>

		<div class="text-center my-5">
			<span class="fw-bold h3">Your Questions</span>
			<span class="fw-bold text-green d-block pointer" data-src="{{ config('shop.product.video.requirements.question') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span>
		</div>
		<div id="allQuestionsShow">
			@if(isset($product) && is_array($product->product_questions))
				@foreach($product->product_questions as $questions)
				<div class="panel-group" id="qaAccordion{{ $questions->id }}">
					<div class="panel panel-default">
						<div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#qaAccordion{{ $questions->id }}" data-target="#qa{{ $questions->id }}">
							<div class="type-text" id="typeText">
								@if($questions->type == 'textarea')
									Free Text
								@else
									Attachement
								@endif
							</div>
							<h4 class="panel-title fw-bold">{{ $questions->question }}</h4>
						</div>
						<div id="qa{{ $questions }}" class="panel-collapse collapse" style="height: 0px;">
							<div class="panel-body">
								<div class="form-group">
									<div class="input-group">
										{{-- <input name="question[0][required]" type="hidden" value="0"> --}}
										<input type="checkbox" name="question[{{ $questions->id }}][required]" class="" @if($questions->is_requried) checekd @endif/>
										<label>{{ trans('app.form.required') }}</label>
									</div>
								</div>
								<input type="text" class="form-control mb-4" name="question[{{ $questions->id }}][question]" value="{{ $questions->question }}" />
								<div class="form-group">
									{{-- {!! Form::label('type', trans('app.form.type') . '*') !!} --}}
									<label>{{ trans('app.form.type') }}</label>
									<select class="form-control" name="question[{{ $questions->id }}][type]" id="type">
										<option value=""></option>
										<option value="textarea" @if($questions->type == 'textarea') selecetd @endif>Free Text</option>
										<option value="file" @if($questions->type == 'file') selecetd @endif>Attachement</option>
									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="mt-2 mb-3 clearfix mx-4">
								<div class="pull-left pt-2 deleteQuestion pointer">
									<i class="fa fa-times-circle mr-2"></i> Delete
								</div>
								<div class="pull-right">
									<span id="cancelQuestion" href="" class="btn btn-lg btn-outline-secondary">Cancel</span>
									<button id="saveQuestion" class="btn btn-lg btn-success">Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			@endif
		</div>
		<div id="add-new-question-field" class="w-100 border px-4 pb-4 mb-4 d-none">
			<div class="panel-body px-0">
				<div class="text-center h3 fw-bold">New Question</div>
				<div class="form-group">
					<div class="input-group">
						<input id="addNewQueReq" name="question[0][required]" type="checkbox" />
						<label> {{ trans('app.form.required') }}</label>
					</div>
				</div>
				<input type="text" class="form-control mb-4" id="addNewQueQue" value="Q: What is Lorem Ipsum?" />
				<div class="form-group">
					{!! Form::label('type', trans('app.form.type') . '*') !!}
					<select name="type" class="form-control" id="addNewQueType">
						<option value=""></option>
						{{-- <option value="multiple">Multiple Inputs</option> --}}
						<option value="textarea">Free Text</option>
						<option value="file">Attachement</option>
					</select>
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="mt-2 mb-3 clearfix">
				<div class="pull-right">
					<span id="cancel-add-question" class="btn btn-lg btn-outline-secondary">Cancel</span>
					<button type="button" id="addNewQuestionButon" class="btn btn-lg btn-success">Add</button>
				</div>
			</div>
		</div>
		<button type="button" class="btn btn-outline-primary" id="add-question"><i class="fa fa-plus mr-2"></i>Add New Question</button>
	</div>
	<div class="my-5 clearfix">
		<span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
		<button type="submit" class="btn btn-gig btn-success pull-right" form="requirements-form">Save</button>
	</div>
</div>