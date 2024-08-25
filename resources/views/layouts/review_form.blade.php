<div>
    <div class="modal fade" id="writeReviewModal" tabindex="-1" aria-labelledby="writeReviewModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="downloadModal">Customer Review</h1>
                    <button type="button" id="writeReviewModalClose" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <review-form :blog="{{ $blog }}" :user="{{ auth()->user() }}" post_url="{{ route('reviews.store') }}"></review-form>
                </div>
            </div>
        </div>
    <div>
</div>