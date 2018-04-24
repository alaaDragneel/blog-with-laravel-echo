<template>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="comments">
                        <h3>{{ comments.length }} Comments</h3>
                        <ul class="comments__list">
                            <li v-for="(c, index) in mu_comments">
                                <div class="comment">
                                    <div class="comment__avatar">
                                        <img alt="Image" :src="'/uploads/' + c.user.image" />
                                    </div>
                                    <div class="comment__body">
                                        <h5 class="type--fine-print">{{ c.user.name }}</h5>
                                        <div class="comment__meta">
                                            <span>{{ c.created_at }}</span>
                                        </div>
                                        <p>
                                            {{ c.body }}
                                            <a href="#" @click="deleteComment($event, index, c.id)">delete</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--end comments-->
                    <div class="comments-form">
                        <h4>Leave a comment</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Comment:</label>
                                <textarea rows="4" v-model="comment" placeholder="Comment ... "></textarea>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn--primary" @click="AddComment()" type="submit">Submit Comment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
</template>

<script>
    export default {
        props: ['comments', 'post_id'],
        data () {
            return {
                comment: '',
                mu_comments: []
            }
        },
        mounted() {
            this.mu_comments = this.comments;
        },
        methods: {
            AddComment () {
                if (this.comment == '') {
                    return;
                }
                var self = this;
                axios.post('/AddComment', {comment: this.comment, post_id: this.post_id}).then(({data}) => {
                    self.mu_comments.push(data.comment);
                });
                this.comment = '';
            },
            deleteComment ($event, index, id) {
                $event.preventDefault();
                var self = this;
                axios.post('/DeleteComment', {id: id}).then(({data}) => {
                    self.mu_comments.splice(index, 1);
                });
            }
        }
    }
</script>
