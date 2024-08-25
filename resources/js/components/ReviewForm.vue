<template>
    <div>
        <form @submit.prevent="postReview">

            <div class="form-group">
                <label for="">Rate It</label>
                <div class="d-flex justify-content-center">
                    <star-rating :increment="0.01" :max-rating="5" :fixed-points="2" :star-size="40" :read-only="false" text-class="justify-content-center"  v-model:rating="reviewFormData.rating"></star-rating>
                </div>
            </div>

            <div class="form-group">
                <label for="">Title</label>
                <input id="title" name="title" type="text" class="form-control" placeholder="Review Title" minlength="10" maxlength="250" v-model="reviewFormData.title" required>
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Review Description" minlength="10" maxlength="500" style="min-height: 150px" v-model="reviewFormData.description" required ></textarea>
            </div>

            <div id="empty_star_error">

            </div>

            <button id="reviewSubmitButton" type="submit" class="btn btn-success text-white" >Submit</button>

        </form>
    </div>
</template>

<script>
    export default {
        props:['blog', 'user', 'post_url'],
        data(){
            return {
                reviewFormData: {
                    rating: 0,
                    title: '',
                    description: '',
                    blog_id: '',
                    user_id: '',
                    user_name: ''
                }
            }
        },

        methods:{
            async postReview(){

                //clean the previous notifications
                $("#notification_area").html('');
                $('#empty_star_error').html('');

                if( this.reviewFormData.rating <= 0){
                    setTimeout(function(){
                        $('#empty_star_error').html('<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Please put star rating!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="top: -7px;"></button></div>');
                    }, 500);
                    return;
                }

                // close the popup
                $("#writeReviewModalClose").click();

                $("#notification_area").html('<div class="alert alert-warning alert-dismissible fade show" role="alert">Please wait, we are processing your data...<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="top: -7px;"></button></div>');

                $('#writeReviewButton').prop('disabled', true);
                $('#reviewSubmitButton').prop('disabled', true);

                this.reviewFormData.blog_id = this.blog.id;
                this.reviewFormData.user_id = this.user.id;
                this.reviewFormData.user_name = this.user.name;

                // console.log(this.reviewFormData.rating);

                setTimeout(() => {

                axios.post( this.post_url, this.reviewFormData)
                    .then(data=>{
                        // alert(data.data);
                        //   location.reload();
                        $("#notification_area").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+data.data+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="top: -7px;"></button></div>');
                        this.reviewFormData.rating = 0;
                        this.reviewFormData.title = '';
                        this.reviewFormData.description = '';

                        $('#writeReviewButton').prop('disabled', false);
                        $('#reviewSubmitButton').prop('disabled', false);

                    })
                    .catch(error=>{
                        // alert('Something went wrong. Please Contact us!');
                        // console.log(error);
                        $("#notification_area").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Something went wrong. Please Contact us!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="top: -7px;"></button></div>');

                        $('#writeReviewButton').prop('disabled', false);
                        $('#reviewSubmitButton').prop('disabled', false);

                    });

                }, 1000);
            }
        },
    }
</script>
