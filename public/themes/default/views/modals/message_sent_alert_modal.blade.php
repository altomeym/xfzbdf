<div class="modal fade" id="messageSentModal" tabindex="-1" role="dialog" aria-labelledby="contactSupportModal" aria-hidden="true">
    <div class="modal-dialog-wrap" role="document">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-3">
                </div>
                <div class="modal-body p-0">
                <div class="form-title mb-0 px-3">
                    <div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <div class="w-100 text-center mb-5 p-3 text-black">
                    <img class="my-5" width="100px" height="100px" src="https://fiverr-res.cloudinary.com/npm-assets/@fiverr/gig_page_perseus/paper-plane.5907351.svg" />
                    <h3 class="font-weight-bold mb-3">{{ trans('messages.message_sent') }}</h3>
                    <p class="mb-3">{{ trans('messages.message_sent_more') }}</p>
                </div>
                </div>

                <div class="modal-footer pt-0 px-3 mt-0 -right">
                <div class="float-right">
                    <div class="form-group">
                    <button class='btn btn-primary btn-lg btn-block flat' data-dismiss="modal"><i class="fas fa-paper-plane"></i> {{ trans('theme.button.got_it') }}</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>