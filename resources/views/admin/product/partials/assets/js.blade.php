
<script src="{{ asset('js/toastr.js') }}"></script>
<script>
  // add active class on nav link on page back

  // add active class on nav link on page load
  $(window).on( "load", function() {
    var hash = window.location.hash;
    if(hash){
      $('.add-gig-nav').find('[href="'+hash+'"]').parent().trigger("click");
      $('.tab-pane').removeClass('in').removeClass('active');
      $(hash).addClass('in').addClass('active');
    }
    // alert(hash);
  });

  
  // add active class on nav link on click
  $('.add-gig-nav .nav-link').on('click',function(){
    $('.add-gig-nav .nav-link').removeClass('active');
    $(this).addClass('active');

    // setting url
    $folder = $(this).find('a').attr('href');
    url = new URL(window.location.href);
    url.hash = "";
    window.history.pushState("", "",  url + $folder); 
  });

  $('#catGrps').on('change',function(){
    catId = $(this).val();
    url = `{{ route('admin.ajax.categorySubGroup') }}?id=${catId}`;
    $.ajax({
      url: url,
      type: "GET",
    })
    .done(function(result) {
      html = '<option value="">Select Subcatgory</option>';
      $.each(result, function(key, input) {
        html += `<option value="${input.id}">${input.name}</option>`;
      });
      $("#catSubGrps").html(html);
    })
    .fail(function(xhr) {
      console.log(xhr);
    });
  });

  $('#catSubGrps').on('change',function(){
    catId = $(this).val();
    url = `{{ route('admin.ajax.categories') }}?id=${catId}`;
    $.ajax({
      url: url,
      type: "GET",
    })
    .done(function(result) {
      html = '<option value="">Select Subcatgory</option>';
      $.each(result, function(key, input) {
        html += `<option value="${input.id}">${input.name}</option>`;
      });
      $("#categories").html(html);
    })
    .fail(function(xhr) {
      console.log(xhr);
    });
  });
  
  $('#overview-form, #pricing-form, #description-faqs, #requirements-form, #gallery-form').on('submit',function(e){
    e.preventDefault();
    formId = $(this).attr("id");

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      dataType: 'json',
      data: new FormData(this),
      processData: false,
      contentType: false,
    })
    .done(function(result) {
      console.log(formId);
      if(formId == 'overview-form'){
        $('.product-id').val(result.id);
        editUrl = `/admin/catalog/product/${result.id}/edit`;
        window.history.replaceState("", "", editUrl); 

        $('.add-gig-nav').find('[href="#pricing"]').parent().trigger("click");
      }

      if(formId == 'pricing-form'){
        $('.add-gig-nav').find('[href="#description"]').parent().trigger("click");
      }

      if(formId == 'description-faqs'){
        $('.add-gig-nav').find('[href="#requirements"]').parent().trigger("click");
      }

      if(formId == 'requirements-form'){
        $('.add-gig-nav').find('[href="#gallery"]').parent().trigger("click");
      }

      if(formId == 'gallery-form'){
        // $('.add-gig-nav').find('[href="#pricing"]').parent().trigger("click");
      }

      toastr['success']('Save Successfuly');
    })
    .fail(function(xhr) {
      console.log(xhr);
      if (xhr.status == 422) {
        $.each(xhr.responseJSON.errors,function(field_name,error){
          findFiled = $(this).find('[name='+field_name+']');
          var errorELementId = 'ajErrorDiv'+field_name;
          if ($("#"+errorELementId).length > 0){
            $("#"+errorELementId).text(error);
          }else{
            findFiled.after('<div class="text-strong text-danger" id="' +errorELementId+ '">' +error+ '</div>')
          }
          toastr["error"](error);
        })
      }else{
        toastr['error']('Something went wrong');
      }
    });
    return false;
  });
  


  // pricing page
  $('#no_of_inventories').on('change',function(){
    isChecked = $('#no_of_inventories').is(':checked');
    if(isChecked){
      // show other packages
      $('#pricingtable td:nth-child(3)').css('visibility','visible');
      $('#pricingtable td:nth-child(4)').css('visibility','visible');
    }else{
      // hide other packages
      $('#pricingtable td:nth-child(3)').css('visibility','hidden');
      $('#pricingtable td:nth-child(4)').css('visibility','hidden');
    }
  });


  // add a new faq
  $('#add-faqs, #cancel-add-new-faq').on('click',function(){
    // alert('1');
    $('#add-new-faq-field').toggleClass('d-none');
  });

  $('#addNewFaqButon').on('click',function(){
    question = $('#newFaqQuestion').val();
    answer = $('#newFaqAnswer').val();
    time = $.now();
    $('#add-new-faq-field').addClass('d-none');
    html = `<div class="panel-group" id="faqAccordion${time}">
              <div class="panel panel-default">
                <div class="panel-heading accordion-toggle question-toggle collapsed pointer" data-toggle="collapse" data-parent="#faqAccordion${time}" data-target="#faq${time}">
                  <h4 class="panel-title">
                    Q: ${question}
                  </h4>
                </div>
                <div id="faq${time}" class="panel-collapse collapse" style="height: 0px;">
                  <div class="panel-body">
                    <input type="text" class="form-control mb-4" name="faq[${time}][question]" value="${question}" />
                    <textarea class="form-control" name="faq[${time}][answer]" rows="5">${answer}</textarea>
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
            </div>`;
    $('#allFaqsShow').append(html);
  });
  
  $('#allFaqsShow').on('click', '.deleteFaq', function(){
    $(this).closest('.panel-group').remove();
  });
  

  // add a new faq
  $('#add-question, #cancel-add-question').on('click',function(){
    // alert('1');
    $('#add-new-question-field').toggleClass('d-none');
  });
  
  $('#addNewQuestionButon').on('click', function(){
    isChecked = $('#addNewQueReq').is(':checked');
    if(isChecked){is_required = 'checked'; }else{is_required = '';}
    question = $('#addNewQueQue').val();
    type = $('#addNewQueType').val();
    typeText = $("#addNewQueType option:selected" ).text();

    time = $.now();
    $('#add-new-question-field').addClass('d-none');
    html = `<div class="panel-group" id="qaAccordion${time}">
            <div class="panel panel-default">
              <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#qaAccordion${time}" data-target="#qa${time}">
                <div class="type-text" id="typeText">${typeText}</div>
                <h4 class="panel-title fw-bold">${question}</h4>
              </div>
              <div id="qa${time}" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="checkbox" name="question[${time}][required]" class="icheckbox_line" ${is_required} />
                      <label>Required</label>
                    </div>
                  </div>
                  <input type="text" class="form-control mb-4" name="question[${time}][question]" value="Q: What is Lorem Ipsum?" />
                  <div class="form-group">
                    <label>{{ trans('app.form.type') }}</label>
                    <select name="question[${time}][type]" class="form-control" id="type">
                      <option value=""></option>
                      <option value="textarea">Free Text</option>
                      <option value="file">Attachement</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="mt-2 mb-3 clearfix mx-4">
                  <div class="pull-left pt-2 deleteQuestion pointer">
                    <i class="fa fa-times-circle mr-2"></i> Delete
                  </div>
                  <div class="pull-right">
                    <span id="cancelQuestion" class="btn btn-lg btn-outline-secondary">Cancel</span>
                    <button type="button" id="saveQuestion" class="btn btn-lg btn-success">Save</button>
                  </div>
                </div>
              </div>
            </div>
          </div>`;
    $('#allQuestionsShow').append(html);

    $(`#qaAccordion${time}`).find("#type").val(type);
    // unset form
    $('#addNewQueReq').prop('checked',false);
    $('#addNewQueQue').val('');
    $('#addNewQueType').val('');
  });
  
  $('#allQuestionsShow').on('click', '#saveQuestion', function(){
    typeText = $(this).closest('.panel-group').find("#type option:selected" ).text();
    $(this).closest('.panel-group').find("#typeText").text(typeText);
    $(this).closest('.panel-collapse').removeClass('in');
  });

  $('#allQuestionsShow').on('click', '#cancelQuestion', function(){
    $(this).closest('.panel-collapse').removeClass('in');
  });
  

  $('#allQuestionsShow').on('click', '.deleteQuestion', function(){
    $(this).closest('.panel-group').remove();
  });
  

  // video modal on visible
  $('#videoModal').on('shown.bs.modal', function (event) {
    var tt = $(event.relatedTarget);
    var src = tt.data('src');
    $("#videoModal").find('iframe').attr('src', src);
  })

</script>