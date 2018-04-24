<template>
    <div class="row">
        <div class="col-lg-4 col-md-6" v-for="post in mu_posts">
            <article class="feature feature-1">
                <a href="#" class="block">
                    <img style="width: 100%;height: 200px;" :alt="post.title" :src="'/uploads/' + post.image" />
                </a>
                <div class="feature__body boxed boxed--border">
                    <span>{{ post.created_at }}</span>
                    <h5>{{ post.title }}</h5>
                    <a :href="'/post/' + post.slug"> Read More </a>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['posts'],
        data () {
            return {
                mu_posts: [],
            }
        },
        mounted() {
            this.mu_posts = this.posts;
            Event.listen('search-results', (posts) => {
                this.mu_posts = posts;
            });
        }
    }
</script>
